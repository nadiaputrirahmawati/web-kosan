<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (empty(Auth::user()->no_ktp)) {
            notyf()->error('Silahkan Mengisi Profile Terlebih Dahulu');
            return redirect()->route('owner.profile.create');
        }elseif(Auth::user()->status_verification == 'pending') {
            notyf()->error('Profile Anda Belum Terverifikasi');
            return redirect()->route('owner.profile');
        }
        return $next($request);
    }
}
