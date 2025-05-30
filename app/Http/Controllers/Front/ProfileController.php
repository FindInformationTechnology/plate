<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\Plate;
use App\Models\Emirate;
use App\Models\PlateView;
use App\Models\User;

class ProfileController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Replace the viewsCount placeholder with this:
        $viewsCount = PlateView::whereHas('plate', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        // Get user's plates statistics
        $myPlatesCount = Plate::where('user_id', $user->id)->count();
        $soldPlatesCount = Plate::where('user_id', $user->id)->where('is_sold', true)->count();

        // This would require a view count implementation - using a placeholder for now
        // You might need to create a PlateView model to track views

        // Get user's recent plates (last 5)
        $recentPlates = Plate::with(['emirate', 'code'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Get popular emirates (with most plates)
        $popularEmirates = Emirate::withCount('plates')
            ->orderBy('plates_count', 'desc')
            ->take(5)
            ->get();

        // Get price statistics for all available plates
        $priceStats = Plate::where('is_sold', false)
            ->where('is_visible', true)
            ->where('is_approved', true)
            ->selectRaw('AVG(price) as average_price, MAX(price) as highest_price, MIN(price) as lowest_price')
            ->first();

        $averagePrice = $priceStats->average_price ? number_format($priceStats->average_price, 0) . ' AED' : 'N/A';
        $highestPrice = $priceStats->highest_price ? number_format($priceStats->highest_price, 0) . ' AED' : 'N/A';
        $lowestPrice = $priceStats->lowest_price ? number_format($priceStats->lowest_price, 0) . ' AED' : 'N/A';

        return view('user.dashboard', compact(
            'myPlatesCount',
            'soldPlatesCount',
            'viewsCount',
            'recentPlates',
            'popularEmirates',
            'averagePrice',
            'highestPrice',
            'lowestPrice'
        ));
    }
    public function index()
    {
        return view('user.profile');
    }
    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'whatsapp' => ['nullable', 'string', 'max:20'],
            'profile_photo' => ['nullable', 'image', 'max:15360'], // 15MB max
        ]);

        // Process phone number to get last 9 digits
        $phoneNumber = $this->processPhoneNumber($request->phone);

        // Check if processed phone number already exists
        // if (User::where('phone', $phoneNumber)->exists()) {
        //     return back()->withErrors(['phone' => 'This phone number is already registered.'])->withInput();
        // }

        

        $validated['phone'] = $phoneNumber; // Update with processed phone number

        if ($request->whatsapp) {

            $validated['whatsapp'] = $this->processPhoneNumber($request->whatsapp);
        }

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Store new photo
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $validated['profile_photo'] = $path;
        }

        $user->update($validated);

        return back()->with('profile_success', 'Profile updated successfully!');
    }

    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('password_success', 'Password updated successfully!');
    }

    public function edit() {}

    private function processPhoneNumber($phone)
    {
        // Remove all non-numeric characters
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);

        // Remove leading zeros
        $cleanPhone = ltrim($cleanPhone, '0');

        // Remove common UAE country code if present
        if (substr($cleanPhone, 0, 3) === '971') {
            $cleanPhone = substr($cleanPhone, 3);
        }

        // Remove leading zero again after country code removal
        $cleanPhone = ltrim($cleanPhone, '0');

        // Get the last 9 digits
        if (strlen($cleanPhone) >= 9) {
            return substr($cleanPhone, -9);
        }

        // If less than 9 digits, pad with leading zeros to make it 9 digits
        return str_pad($cleanPhone, 9, '0', STR_PAD_LEFT);
    }
}
