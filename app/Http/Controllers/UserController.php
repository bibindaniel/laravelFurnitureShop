<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }
    public function showLoginForm()
    {
        return view('login');
    }

    public function register(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:4',
        ]);

        Log::info('Validated Data:', $validatedData); // Logging the validated data

        $validatedData['password'] = bcrypt($validatedData['password']);
        Log::info('Data with Encrypted Password:', $validatedData); // Logging after encrypting password
        User::create($validatedData);

        return redirect()->route('register')->with('success', 'User registered successfully!');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
    
        if ($credentials['email'] === 'admin@gmail.com') {
            // Redirect the admin user to a different route
            return redirect()->route('adminDashboard');
        }
    
        $user = User::where('email', $credentials['email'])->first();
    
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('mainPage');
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }    
    public function mainPage()
    {
        return view('main');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/'); // Redirect to the main page after logout
    }
    public function showDashboard()
    {
        return view('admin.main');
    }
    
    public function products(){
        return view('admin.products');
    }
}
