<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\DatabaseException;
use Exception;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    private $firebaseAuth;
    private $database;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(base_path('app/firebase/reach-a3367-firebase-adminsdk-fbsvc-d5dcc96e70.json'))
            ->withDatabaseUri('https://reach-a3367-default-rtdb.firebaseio.com/');

        $this->firebaseAuth = $factory->createAuth();
        $this->database = $factory->createDatabase();
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|same:password',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        try {
            // Create Firebase user
            $createdUser = $this->firebaseAuth->createUser([
                'email' => $email,
                'password' => $password,
                'displayName' => $name,
            ]);

            // Store user data in Realtime Database
            $userRef = $this->database->getReference('users/' . $createdUser->uid);
            $userRef->set([
                'name' => $name,
                'email' => $email,
                'created_at' => now()->toDateTimeString(),
            ]);

            // Store user info in session for immediate certificate access
            Session::put('firebase_user', [
                'uid' => $createdUser->uid,
                'name' => $name,
                'email' => $email
            ]);

            // Session::flash('success', "Registration Successful!");
            // return redirect()->route('certificate.generate'); // Redirect to certificate

        } catch (DatabaseException $e) {
            \Log::error('Firebase Database error: ' . $e->getMessage());
            Session::flash('error', 'Registration failed due to database error.');
        } catch (Exception $e) {
            \Log::error('General error: ' . $e->getMessage());
            Session::flash('error', 'Registration failed. Please try again.');
        }

        return redirect()->route('signIn.index');
    }
}
