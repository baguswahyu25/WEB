<?php

// app/Http/Middleware/IsAdmin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login
        if (Auth::check()) {
            // 2. Cek apakah role user adalah 'admin'
            if (Auth::user()->role === 'admin') {
                return $next($request); // Lanjutkan ke route yang diminta
            }
        }
        
        // Jika user tidak login atau bukan admin, alihkan ke homepage
        return redirect('/')->with('error', 'Akses ditolak. Anda bukan Administrator.');
    }
}