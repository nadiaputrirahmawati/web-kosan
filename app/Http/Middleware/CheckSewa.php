<?php

namespace App\Http\Middleware;

use App\Models\Contract;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSewa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika belum login, redirect ke halaman login
        if (!Auth::check()) {
            return redirect()->route('user.login');
        }

        // Jika sudah login tapi no_ktp kosong
        if (empty(Auth::user()->no_ktp)) {
            return redirect()->route('user.profile.update');
        }

        // 3. Cek apakah ada kontrak status pending
        $hasPendingContract = Contract::where('user_id', Auth::user()->user_id)
            ->where('verification_contract', 'pending')
            ->exists();

        if ($hasPendingContract) {
            // Redirect atau tampilkan error/flash message jika perlu
            notyf()->error('Anda masih memiliki kontrak yang belum selesai');
            return redirect()->back();
        }

        return $next($request);
    }
}
