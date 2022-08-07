<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user() && $request->path() != 'login' && $request->path() != 'signup') {
            return redirect()->route('auth.login')->withFailure(__('You must login.'));
        }
        if (auth()->user()->roles === 0 && ($request->path() =='login' || $request->path() == 'signup' || $request->path() == 'admin/users')) {
            return back();
        }
        // if (auth()->user()->roles === 1 && ($request->path() =='login' || $request->path() == 'signup' || $request->path() == 'admin/users')) {
        //     return back();
        // }


        return $next($request)->header('Cache-Control, no-cache','no-store','max-age=0','must-revalidate')->header('Pragma', 'no-cache')->header('Expires', 'Sat 01 Jan 1970 00:00:00 GMT');
    }
}
