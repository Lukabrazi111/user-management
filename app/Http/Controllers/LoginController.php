<?php

namespace App\Http\Controllers;

use App\Http\Requests\Login\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $validated = $request->validated();
        $field_type = filter_var($validated['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $user = User::where($field_type, $validated['email'])->first();

        if ($user && is_null($user->email_verified_at)) {
            return redirect()->back()->with('error', __('auth.not_verified'));
        }

        if (!Auth::attempt([$field_type => $validated['email'], 'password' => $validated['password']])) {
            return redirect()->back()->with('error', __('auth.bad_credentials'));
        }

        return redirect()->route('todo.index')->with('success', __('auth.logged_in'));
    }

    /**
     * Logout user from the system.
     *
     * @return RedirectResponse
     */
    public function logout()
    {
        session()->flush();
        auth()->logout();
        return redirect()->route('login.index')->with('success', __('auth.logged_out'));
    }
}
