<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Jika pengguna belum login, arahkan ke halaman login
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        // Ambil data pengguna yang sedang login
        $user = Auth::user();
        // Jika peran pengguna tidak ada dalam daftar peran yang diizinkan, tampilkan halaman 403
        if (!in_array($user->role, $roles)) {
            // Mengarahkan ke route unauthorized pada controller AuthController
            return redirect()->route('unauthorized');
        }
        // Lanjutkan ke route berikutnya jika pengecekan akses berhasil
        return $next($request);
    }
}