<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        return view('front.login');
    }
}
