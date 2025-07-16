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

        $hasRestrictedContract = Contract::where('user_id', Auth::user()->user_id)
            ->whereIn('verification_contract', ['pending', 'completed'])
            ->exists();
        // dd($hasRestrictedContract);

        if ($hasRestrictedContract) {
            // Blokir akses, bisa redirect atau response error
            notyf()->error('Anda tidak bisa sewa lagi karena masih memiliki kontrak yang sedang diproses atau aktif.');
            return redirect()->back();
        }

        return $next($request);
    }
}
