<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show the login view
    public function index()
    {
        return view('signIn'); // Make sure this file is in resources/views/signIn.blade.php
    }

    // Handle login form submission
    public function login(Request $request)
    {
        // Validate input fields
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            // Authenticate using Firebase
            $firebaseAuth = Firebase::auth();
            $signInResult = $firebaseAuth->signInWithEmailAndPassword($request->email, $request->password);

            // Get the Firebase user
            $user = $signInResult->data();

            // Add the login email explicitly to the user session array
            $user['email'] = $request->email;

            // Store user info in session
            Session::put('firebase_user', $user);

            // Redirect to home page with user data
            return view('home', ['user' => $user]);

        } catch (\Exception $e) {
            // If login fails, show error message
            Session::flash('error', 'Login Failed. Please Try Again.');
            return redirect()->route('signIn.index');
        }
    }

    // Logout user
    public function logout()
    {
        Auth::logout();
        Session::forget('firebase_user');
        return redirect()->route('signIn.index');
    }

public function showForgotPasswordForm()
{
    return view('auth.forgot-password');
}

public function sendPasswordResetLink(Request $request)
{
    $request->validate(['email' => 'required|email']);

    try {
        $firebaseAuth = Firebase::auth();
        $firebaseAuth->sendPasswordResetLink($request->email);

        Session::flash('success', 'Password reset link sent to your email');
        return back();
    } catch (\Exception $e) {
        Session::flash('error', 'Failed to send password reset link: ' . $e->getMessage());
        return back();
    }
}


}
