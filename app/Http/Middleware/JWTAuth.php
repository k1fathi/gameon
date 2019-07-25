<?php

namespace App\Http\Middleware;

use App\Models\User;
use Cache;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Auth\Guard;


class JWTAuth
{
    /**
     * @var Guard
     */
    protected $auth;

    /**
     * AuthenticateApi constructor.
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $bearer = $request->bearerToken();
//dd($bearer);
        return $next($request);
    }
}
