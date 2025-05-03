<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class UserSettingController extends Controller
{
    public function profile(Request $request)
    {
        
        return view('user.profile');
    }
    
    public function update_profile(Request $request)
    {
        // $user = auth()->user();
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->save();
        return redirect()->back()->with('success', 'Profile updated successfully');
    }
    
    public function security() {
       
        return view('user.settings');
    }
}
