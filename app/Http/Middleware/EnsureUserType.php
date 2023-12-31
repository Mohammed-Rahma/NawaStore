<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , ...$types): Response
    {
        $user = Auth::user();//Or $request->user();
        if (! in_array($user->type , $types)) {
            abort(403 , 'Unauthorized action.');//OR return redirect('/login'); return view('/login'); بوجه لايا صفحة
        }

        return $next($request);
    }
}
