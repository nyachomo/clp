<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class QuickPasswordResetController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot_password');
    }

    public function startReset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $email = $request->input('email');

        $user = User::query()
            ->whereNotNull('email')
            ->where('email', $email)
            ->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email address not found.'])->withInput();
        }

        return redirect()
            ->route('quick.password.reset', ['email' => $email])
            ->with('status', 'Email verified. Please set a new password.');
    }

    public function showResetForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('quick.password.forgot')->withErrors($validator)->withInput();
        }

        $email = $request->query('email');

        $user = User::query()
            ->whereNotNull('email')
            ->where('email', $email)
            ->first();

        if (!$user) {
            return redirect()->route('quick.password.forgot')->withErrors(['email' => 'Email address not found.'])->withInput();
        }

        return view('auth.reset_password', ['email' => $email]);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::query()
            ->whereNotNull('email')
            ->where('email', $request->input('email'))
            ->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email address not found.'])->withInput();
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()
            ->route('login')
            ->with('status', 'Password updated successfully. Please log in.');
    }
}
