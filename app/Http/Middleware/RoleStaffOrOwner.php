<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleStaffOrOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Jika belum login, tolak
        if (!$user) {
            abort(403, 'Unauthorized (not logged in)');
        }

        // Hanya boleh Staff atau Owner
        if (!in_array($user->role, ['Staff', 'Owner'])) {
            abort(403, 'Unauthorized (role: ' . $user->role . ')');
        }

        return $next($request);
    }
}
