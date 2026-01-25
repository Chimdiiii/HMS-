<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show registration page
    public function showRegistrationForm()
    {
        return view('auth.registration');
    }

    // Handle registration form submission
    public function registerUser(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Create user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    // Show login page
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login form submission
public function loginUser(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'Email not registered'])->withInput();
    }

    if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors(['password' => 'Incorrect password'])->withInput();
    }

    // Login the user manually
    auth()->login($user);

    return redirect()->intended('/about'); // or your home page
}
public function showAbout() {
    return view('auth.about');
}

}
