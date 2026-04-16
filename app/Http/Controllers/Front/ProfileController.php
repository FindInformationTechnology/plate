<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Emirate;
use App\Models\Plate;
use App\Models\PlateView;
use App\Models\User;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

    use ImageUploadTrait;

    public function dashboard()
    {
        $user = Auth::user();

        // Replace the viewsCount placeholder with this:
        $viewsCount = PlateView::whereHas('plate', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        // Get user's plates statistics
        $myPlatesCount   = Plate::where('user_id', $user->id)->count();
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
        $lowestPrice  = $priceStats->lowest_price ? number_format($priceStats->lowest_price, 0) . ' AED' : 'N/A';

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
        $user = $request->user();

        
        // Normalize inputs BEFORE validation
        $request->merge([
            'phone' => $this->processPhoneNumber($request->phone),
            'whatsapp' => $request->whatsapp
                ? $this->processPhoneNumber($request->whatsapp)
                : null,
            ]);
            
            // Validate
            $validated = $request->validate([
                'phone' => [
                'required',
                'digits:12', // 971XXXXXXXXX
                Rule::unique('users', 'phone')->ignore($user->id),
            ],
            'whatsapp' => [
                'nullable',
                'digits:12',
                Rule::unique('users', 'whatsapp')->ignore($user->id),
            ],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);
        
    
        // Handle photo upload
        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->uploadImage($request->file('photo'), 'photos');
        }
    
        $user->update($validated);
    
        return back()->with(
            'profile_success',
            app()->isLocale('ar')
                ? 'تم تحديث الملف الشخصي بنجاح!'
                : 'Profile updated successfully!'
        );
    }

    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            // 'current_password' => ['required', 'string'],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        // Check if current password matches
        // if (! Hash::check($request->current_password, $user->password)) {
        //     return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        // }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        $message = (app()->getLocale() == 'ar') ? 'تم تحديث كلمة المرور بنجاح!' : 'Password updated successfully!';

        return back()->with('password_success', $message);
    }

    public function edit()
    {
    }

    private function processPhoneNumber($phone)
    {
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);

        // Remove country code if exists
        if (substr($cleanPhone, 0, 3) === '971') {
            $cleanPhone = substr($cleanPhone, 3);
        }

        // Remove leading zero
        $cleanPhone = ltrim($cleanPhone, '0');

        // Ensure exactly 9 digits
        $cleanPhone = str_pad(substr($cleanPhone, -9), 9, '0', STR_PAD_LEFT);

        return '971' . $cleanPhone;
    }
}
