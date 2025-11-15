<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('pages.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'username'   => 'required|string',
            'password'   => 'required|string|min:6',
            'user_type'  => 'required|in:user,admin',
        ]);

        // Cari user by username atau email
        $user = User::where('username', $validated['username'])
                    ->orWhere('email', $validated['username'])
                    ->first();

        // Cek user ada, password cocok, dan aktif
        if ($user && Hash::check($validated['password'], $user->password) && $user->is_active) {
            
            Auth::login($user);
            $request->session()->regenerate();

            $this->logActivity('user_login', $user);

            // Redirect berdasarkan role
            if ($validated['user_type'] === 'admin' && $user->isAdmin()) {
                return redirect()->route('admin.dashboard')
                                 ->with('success', 'Selamat datang, Admin!');
            }

            // sementara user diarahkan ke dashboard admin juga
            return redirect()->route('admin.dashboard')
                             ->with('success', 'Selamat datang!');
        }

        // Login gagal
        return back()->withErrors([
            'username' => 'Username atau password tidak valid, atau akun tidak aktif.',
        ])->withInput($request->except('password'));
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
                         ->with('success', 'Anda telah logout.');
    }

    /**
     * Log user activity (optional)
     */
    private function logActivity(string $activity, User $user)
    {
        \Log::info("Activity: $activity", ['user_id' => $user->id]);
    }
}
