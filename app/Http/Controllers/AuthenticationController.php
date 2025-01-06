<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function login()
    {
        return view('authentication.login');
    }

    public function loginCover()
    {
        return view('authentication.loginCover');
    }

    public function signin()
    {
        return view('authentication.signin');
    }

    public function signinCover()
    {
        return view('authentication.signinCover');
    }

    public function resetPassword()
    {
        return view('authentication.resetPassword');
    }

    public function resetPasswordCover()
    {
        return view('authentication.resetPasswordCover');
    }

    public function verification()
    {
        return view('authentication.verification');
    }
    
    public function verificationCover()
    {
        return view('authentication.verificationCover');
    }
}
