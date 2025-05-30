<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;

class AuthController extends Controller
{
    public function store(Request $request, UserService $userService) {

        // dd($request->all());
        
        $user = $userService->createUser($request->all());

        if ($user) {
            return redirect()->route('login');
        } else {
            return redirect()->back();
        }
    }

    public function update( $id, Request $request ,UserService $userService) {

        $user = $userService->updateUser( $id, $request->all());

        if ($user) {
            return redirect()->route('login');
        } else {
            return redirect()->back();
        }
        
    }

    public function destroy( $id, UserService $userService) {
        $user = $userService->deleteUser( $id); 
        if ($user) {
            return redirect()->route('login');
        } else {
            return redirect()->back();
        }
    }

    public function login(Request $request, UserService $userService) {
        $user = $userService->login($request->all());
        if ($user) {
            return redirect()->route('user.dashboard');
        } else {
            return redirect()->back();
        }
    }

}
