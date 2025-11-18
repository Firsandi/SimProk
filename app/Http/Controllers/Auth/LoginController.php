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
            
            // Redirect based on role
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            
            return redirect()->route('user.dashboard');
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

        // Cek user ada dan password cocok
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()->withErrors([
                'username' => 'Username atau password tidak valid.',
            ])->withInput($request->except('password'));
        }

        // Cek apakah akun aktif
        if (!$user->is_active) {
            return back()->withErrors([
                'username' => 'Akun Anda tidak aktif. Hubungi administrator.',
            ])->withInput($request->except('password'));
        }

        // ===== VALIDASI ROLE SESUAI TAB YANG DIPILIH =====
        
        if ($validated['user_type'] === 'admin') {
            // Tab Admin: hanya admin yang boleh login
            if (!$user->isAdmin()) {
                return back()->withErrors([
                    'username' => '❌ Anda tidak memiliki akses sebagai Admin. Silakan pilih tab "As User".',
                ])->withInput($request->except('password'));
            }
        } else {
            // Tab User: hanya user biasa yang boleh login (bukan admin)
            if ($user->isAdmin()) {
                return back()->withErrors([
                    'username' => '❌ Akun Admin tidak bisa login sebagai User. Silakan pilih tab "As Admin".',
                ])->withInput($request->except('password'));
            }
        }

        // Login user
        Auth::login($user);
        $request->session()->regenerate();

        // Log activity
        $this->logActivity('user_login', $user, $validated['user_type']);

        // Redirect berdasarkan user_type
        if ($validated['user_type'] === 'admin') {
            return redirect()->route('admin.dashboard')
                             ->with('success', '✅ Selamat datang, Admin ' . $user->name . '!');
        }

        // Redirect ke user dashboard
        return redirect()->route('user.dashboard')
                         ->with('success', '✅ Selamat datang, ' . $user->name . '!');
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
                         ->with('success', '👋 Anda telah logout.');
    }

    /**
     * Log user activity
     */
    private function logActivity(string $activity, User $user, string $userType)
    {
        \Log::info("Activity: $activity", [
            'user_id' => $user->id,
            'username' => $user->username,
            'role' => $user->role,
            'login_as' => $userType, // 'admin' atau 'user'
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'timestamp' => now(),
        ]);
    }
}
