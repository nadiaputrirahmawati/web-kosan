<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('user.login');
        }

        $user = Auth::user();

        // Cek apakah user memiliki role yang valid
        if (empty($user->role) || !in_array($user->role, ['admin', 'owner', 'user'])) {
            Auth::logout();
            return redirect()->route('user.login')
                ->with('error', 'Role pengguna tidak valid. Silakan hubungi administrator.');
        }

        // Cek apakah user memiliki salah satu role yang diizinkan
        if (!in_array($user->role, $roles)) {
            // Untuk request AJAX, return JSON error
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Anda tidak memiliki akses ke resource ini.',
                    'error' => 'Forbidden access for role: ' . $user->role
                ], 403);
            }

            // Untuk request web, tampilkan halaman 403 dengan pesan error
            abort(403, 'Akses Ditolak! Anda sebagai ' . ucfirst($user->role) . ' tidak memiliki izin untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
