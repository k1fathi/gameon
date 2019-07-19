<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ForgotRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\Request;
use App\Models\Image;
use App\Models\PasswordReset;
use App\Models\Social;
use App\Models\User;
//use App\Socialite\GoogleIdProvider;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
//use Intervention;
//use Laravel\Socialite\AbstractUser;
//use Laravel\Socialite\Facades\Socialite;
//use Laravel\Socialite\Two\GoogleProvider;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Keychain;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = new User($request->input());
        $user->password = $request->input('password');
        $user->save();

        $provider = $request->input('provider');
        $token = $request->input('token');

        if ($provider && $token) {
            try {
                /** @var \Laravel\Socialite\AbstractUser $socialUser */
                if ($provider == 'facebook') {
                    $socialUser = Socialite::driver($provider)
                                           ->scopes(['email', 'user_gender', 'user_birthday'])
                                           ->fields(['name', 'email', 'birthday', 'verified'])
                                           ->userFromToken($token);
                } elseif ($provider == 'google') {
                    /** @var GoogleProvider $socialite */
                    $socialUser = Socialite::driver($provider)
                                           ->userFromToken($token);

                } elseif ($provider == 'googleid') {
                    /** @var GoogleIdProvider $socialite */
                    $socialUser = Socialite::driver($provider)
                                           ->userFromToken($token);
                    $provider = 'google';
                } else {
                    throw new \Exception();
                }
                /** @var AbstractUser $socialUser */

                // Attach social profile
                $social = new Social([
                    'provider'     => $provider,
                    'provider_id'  => $socialUser->getId(),
                    'access_token' => $token,
                ]);
                $social->user()->associate($user);
                $social->save();

            } catch (\Exception $e) {
                // Ignore error
            }

            // Attach Image
            try {
                if ($socialUser && $socialUser->getAvatar()) {
                    $user->image()->save(new Image([
                        'image' => Intervention::make($socialUser->getAvatar()),
                    ]));
                }
            } catch (\Exception $e) {
                // Ignore error
            }
        }

        return $this->respondWithToken($user);
    }

    public function login(LoginRequest $request, Guard $auth)
    {
        $auth->once([
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        /** @var User $user */
        $user = $auth->user();
        if (!$user) {
            return response()->error('auth.invalid');
        }

        return $this->respondWithToken($user);
    }

    public function logout(Request $request)
    {
        return response()->message('auth.logout');
    }

    public function social(Request $request, $provider)
    {
        $token = $request->input('token');
        try {
            /** @var \Laravel\Socialite\AbstractUser $socialUser */
            if ($provider == 'facebook') {
                $socialUser = Socialite::driver($provider)
                                       ->scopes(['email', 'user_gender', 'user_birthday'])
                                       ->fields(['name', 'email', 'birthday', 'verified'])
                                       ->userFromToken($token);
            } elseif ($provider == 'google') {
                /** @var GoogleProvider $socialite */
                $socialUser = Socialite::driver($provider)
                                      ->userFromToken($token);

            } elseif ($provider == 'googleid') {
                /** @var GoogleIdProvider $socialite */
                $socialUser = Socialite::driver($provider)
                                      ->userFromToken($token);
                $provider = 'google';
            } else {
                throw new \Exception();
            }
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json([
                'code'    => 'auth.social.invalid',
                'message' => trans('errors.auth.social.invalid'),
            ], 400);
        }

        // If already logged in before
        $social = Social::whereProvider($provider)->whereProviderId($socialUser->getId())->first();

        if ($social) {
            // Update Token
            $social->access_token = $token;
            $social->save();

            return $this->respondWithToken($social->user);
        }

        // If users email address already registered
        $user = User::where('email', $socialUser->getEmail())->first();
        if ($user) {
            $social = new Social([
                'provider'     => $provider,
                'provider_id'  => $socialUser->getId(),
                'access_token' => $token,
            ]);
            $social->user()->associate($user);
            $social->save();

            return $this->respondWithToken($user);
        }

        // Check Required
        $email = $socialUser->getEmail();
        $name = $socialUser->getName();
        $birthday = $socialUser->user['birthday'] ?? null;
        if ($birthday) {
            $birthday = Carbon::parse($birthday)->toDateString();
        }

        if (!$email || !$name) {
            return response()->json([
                'code'    => 'auth.social.missing',
                'message' => trans('errors.auth.social.missing'),
                'user'    => [
                    'token'    => $token,
                    'email'    => $email,
                    'name'     => $name,
                    'birthday' => $birthday,
                ],
            ], 400);
        }

        if (!$user) {
            $user = new User([
                'email'    => $email,
                'name'     => $name,
                'birthday' => $birthday,
            ]);
            $user->save();

            //            try {
            //                if ($socialUser && $socialUser->getAvatar()) {
            //                    $user->image()->save(new Image([
            //                        'image' => Intervention::make($socialUser->getAvatar()),
            //                    ]));
            //                }
            //            } catch (\Exception $e) {
            //                // Ignore error
            //            }

            //            event(new UserRegistered($user));
        }

        $social = new Social([
            'provider'     => $provider,
            'provider_id'  => $socialUser->getId(),
            'access_token' => $token,
        ]);
        $social->user()->associate($user);
        $social->save();

        return $this->respondWithToken($user);
    }

    public function forgot(ForgotRequest $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            return response()->error('auth.forgot.invalid');
        }

        $recentPasswordReset = PasswordReset::query()
                                            ->where('user_id', $user->id)
                                            ->where('created_at', '>', Carbon::now()->subMinutes(5))
                                            ->first();

        if ($recentPasswordReset) {
            return response()->error('auth.forgot.recent');
        }

        PasswordReset::create([
            'email'   => $user->email,
            'user_id' => $user->id,
        ]);

        return response()->message('auth.forgot');
    }

    protected function respondWithToken($user)
    {
        $token = (new Builder())
            ->setIssuedAt(time())
            ->setExpiration(time() + 365 * 24 * 60 * 60)
            ->setSubject($user->id)
            ->sign(new Sha256(), (new Keychain())->getPrivateKey(config('jwt.private'), config('jwt.passphrase')))
            ->getToken();

        return response()->success([
            'token'  => $token->__toString(),
            'locale' => $user->language,
        ]);
    }
}
