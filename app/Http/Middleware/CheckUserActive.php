<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserActive
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        // USER SUDAH DIHAPUS
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        // JIKA ADA KOLUMN deleted_at ATAU is_active
        if ($user->deleted_at !== null) {
            $user->tokens()->delete();
            return response()->json(['message' => 'Akun dinonaktifkan'], 403);
        }

        return $next($request);
    }
}
