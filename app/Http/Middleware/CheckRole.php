<?php

namespace App\Http\Middleware;

use App\Models\Pelatih;
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
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

    if ($user && in_array($user->role, $roles)) {
        return $next($request);
    }

    // Jika role tidak sesuai, Anda dapat mengarahkan pengguna ke halaman lain atau memberikan respons sesuai kebutuhan.
    return redirect()->route('admin.formLogin')->with('error', 'Unauthorized.');

    }
}
