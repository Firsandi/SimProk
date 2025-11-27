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
            $user = Auth::user();

            return $user->isAdmin()
                ? redirect()->route('admin.dashboard')
                : redirect()->route('user.dashboard');
        }

        return view('pages.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username'   => 'required|string',
            'password'   => 'required|string|min:6',
            'user_type'  => 'required|in:user,admin',
        ]);

        // Cari user by username/email
        $user = User::where('username', $validated['username'])
                    ->orWhere('email', $validated['username'])
                    ->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            $this->logActivity('login_failed', $user ?? new User(['username'=>$validated['username']]), $validated['user_type']);
            return back()->withErrors([
                'loginError' => '❌ Username atau password tidak valid.',
            ])->withInput($request->except('password'));
        }

        if (!$user->is_active) {
            return back()->withErrors([
                'loginError' => '⚠️ Akun Anda tidak aktif. Hubungi administrator.',
            ])->withInput($request->except('password'));
        }

        // Validasi role sesuai tab
        if ($validated['user_type'] === 'admin' && !$user->isAdmin()) {
            return back()->withErrors([
                'loginError' => '❌ Anda tidak memiliki akses sebagai Admin. Silakan pilih tab "User".',
            ])->withInput($request->except('password'));
        }

        if ($validated['user_type'] === 'user' && $user->isAdmin()) {
            return back()->withErrors([
                'loginError' => '❌ Akun Admin tidak bisa login sebagai User. Silakan pilih tab "Admin".',
            ])->withInput($request->except('password'));
        }

        // Login sukses
        Auth::login($user);
        $request->session()->regenerate();

        $this->logActivity('login_success', $user, $validated['user_type']);

        return $validated['user_type'] === 'admin'
            ? redirect()->route('admin.dashboard')->with('success', '✅ Selamat datang, Admin ' . $user->name . '!')
            : redirect()->route('user.dashboard')->with('success', '✅ Selamat datang, ' . $user->name . '!');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        $this->logActivity('logout', $user, $user?->isAdmin() ? 'admin' : 'user');

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', '👋 Anda telah logout.');
    }

    /**
     * Log user activity
     */
    private function logActivity(string $activity, ?User $user, string $userType)
    {
        \Log::info("Activity: $activity", [
            'user_id'   => $user?->id,
            'username'  => $user?->username,
            'role'      => $user?->role,
            'login_as'  => $userType,
            'ip'        => request()->ip(),
            'user_agent'=> request()->userAgent(),
            'timestamp' => now(),
        ]);
    }
}
