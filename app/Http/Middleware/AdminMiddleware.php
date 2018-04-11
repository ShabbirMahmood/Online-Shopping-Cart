<?php
/**
 * Created by PhpStorm.
 * User: Shabbir Mahmood
 * Date: 10-Apr-18
 * Time: 8:17 PM
 */

namespace App\Http\Middleware;
use Closure;
use App\User;
use Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() && !Auth::user()->isAdmin()) {
            return redirect('/');
        }

        return $next($request);
    }
}