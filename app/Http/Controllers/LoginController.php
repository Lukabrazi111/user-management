<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * Show login page.
     *
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Authenticate user in the system.
     *
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $field_type = filter_var($validated['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (!Auth::attempt([$field_type => $validated['email'], 'password' => $validated['password']])) {
            return redirect()->back()->with('error', 'incorrect credentials');
        }

        return redirect()->route('todo.index')->with('success', 'You logged in successfully');
    }

    /**
     * User logout from the system.
     *
     */
    public function logout()
    {
        session()->flush();
        auth()->logout();
        return redirect()->route('login.index')->with('success', 'Logged out');
    }
}
