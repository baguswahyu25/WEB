<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsUser
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah sudah login?
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Jika yang login adalah ADMIN dan mencoba akses area USER
        if (Auth::user()->role === 'admin') {
            // Tendang balik ke dashboard admin mereka sendiri
            return redirect()->route('admin.dashboard')->with('error', 'Admin tidak boleh masuk ke area User!');
        }

        // 3. Jika role-nya benar 'user', izinkan lewat
        if (Auth::user()->role === 'user') {
            return $next($request);
        }

        return redirect('/');
    }
}