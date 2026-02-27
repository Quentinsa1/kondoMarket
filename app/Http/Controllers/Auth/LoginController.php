<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->remember)) {

            $request->session()->regenerate();

            $user = auth()->user();

            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors(['email'=>'Compte suspendu']);
            }

            $user->update([
                'last_login_at' => now(),
                'last_login_ip' => $request->ip(),
            ]);

            return $this->redirectByRole($user);
        }

        return back()->withErrors([
            'email' => 'Identifiants invalides',
        ])->onlyInput('email');
    }

    /**
     * 🔥 REDIRECTION INTELLIGENTE PAR ROLE
     */
    private function redirectByRole($user)
    {
        return match($user->role) {

            'super_admin' => redirect()->route('superadmin.dashboard'),

            'admin' => redirect()->route('admin.dashboard'),

            'seller' => redirect()->route('seller.dashboard'),

            default => redirect()->route('home'),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

