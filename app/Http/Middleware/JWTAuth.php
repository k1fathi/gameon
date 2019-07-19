<?php

namespace App\Http\Middleware;

use App\Models\User;
use Cache;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Keychain;
use Lcobucci\JWT\Signer\Rsa\Sha256;

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
        if ($bearer) {
            $token = (new Parser())->parse((string)$bearer);
            $valid = $token->verify(new Sha256(), (new Keychain())->getPublicKey(config('jwt.public')));

            if ($valid) {
                if ($token->hasClaim('sub')) {
                    // New Token
                    $id = $token->getClaim('sub');
                    $user = Cache::remember(User::getCacheKey('id', $id), Carbon::today()->endOfDay(),
                        function () use ($id) {
                            return User::with('activeSubscriptions')->find($id);
                        });

                } elseif ($token->hasClaim('username')) {
                    // FIXME: Old Token support
                    $username = $token->getClaim('username');
                    $user = Cache::remember(User::getCacheKey('username', $username), Carbon::today()->endOfDay(),
                        function () use ($username) {
                            return User::with('activeSubscriptions')->where('username', $username)->first();
                        });
                } else {
                    $user = null;
                }

                if ($user) {
                    $this->auth->setUser($user);
                }
            }
        }

        return $next($request);
    }
}
