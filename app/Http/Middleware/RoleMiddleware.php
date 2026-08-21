<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        // 1. Cek jika user belum login
        if (!$request->user()) {
            return redirect()->route('login')
                ->withErrors(['Silahkan login terlebih dahulu.']);
        }

        // 2. Ambil role user (aman dari error jika relasi/kolom berbentuk object maupun string)
        $user = $request->user();
        $userRole = is_object($user->role) ? $user->role->name : $user->role;

        // Jika user tidak memiliki role sama sekali
        if (!$userRole) {
            abort(403, 'Unauthorized - User tidak memiliki role.');
        }

        // 3. Pecah string roles jika dikirim dengan format 'admin,kasir'
        $allowedRoles = [];
        foreach ($roles as $role) {
            foreach (explode(',', $role) as $r) {
                $allowedRoles[] = strtolower(trim($r));
            }
        }

        // 4. Pengecekan role (dipaksa ke lowercase agar tidak bermasalah karena huruf kapital)
        if (!in_array(strtolower($userRole), $allowedRoles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}