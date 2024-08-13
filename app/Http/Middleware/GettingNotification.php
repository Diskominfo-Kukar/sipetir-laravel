<?php

namespace App\Http\Middleware;

use App\Traits\Notifikasi;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GettingNotification
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $userId     = Auth::user()->id;
            $notifikasi = Notifikasi::get($userId);

            session(['notifikasi' => $notifikasi]);
        }

        return $next($request);
    }
}
