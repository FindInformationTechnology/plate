<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index() {
        return view("front.index");
    }

    public function dashboard() {
        return view("front.dashboard");
    }
    public function settings() {
        return view("front.settings");
    }
    
    public function register()
    {
        return view('front.register');
    }

    public function login(Request $request)
    {
        return view('front.login');
    }
}
