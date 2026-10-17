<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $ip = $request->ip();
        $attemptKey = "login-attempts:{$ip}";
        $lockKey = "login-lock:{$ip}";

        $maxAttempts = 3;
        // lama lockout
        $lockSeconds = 120;
        // counter kegagalan
        $attemptWindow = 1800;   

        // masih dalam masa lockout?
        if ($lockedUntil = Cache::get($lockKey)) {
            return $this->lockoutResponse($lockedUntil);
        }

        if (Auth::attempt($credentials)) {
            Cache::forget($attemptKey);
            $request->session()->regenerate();
            return redirect()->intended(route('students.index'));
        }

        // gagal: catat percobaan
        Cache::add($attemptKey, 0, $attemptWindow);
        $attempts = Cache::increment($attemptKey);

        if ($attempts >= $maxAttempts) {
            $lockedUntil = now()->addSeconds($lockSeconds)->timestamp;
            Cache::put($lockKey, $lockedUntil, $lockSeconds);
            Cache::forget($attemptKey);
            return $this->lockoutResponse($lockedUntil);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    private function lockoutResponse(int $lockedUntil)
    {
        $seconds = max(1, $lockedUntil - now()->timestamp);

        return back()->with('lockout_seconds', $seconds)->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}