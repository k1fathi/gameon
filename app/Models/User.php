<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', '
        remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function getUrl($roleName = null)
    {

        $url = '';
        $urlStr='_url';

        if (!is_null($roleName)) {
            //FIXME: put in cache
            $keys = Setting::where('key', 'like', "%$roleName%")->pluck('value', 'key');
            if (count($keys)) {

                switch ($roleName) {
                    case Setting::ROLE_STUDENT:
                        $url = $keys[$roleName . $urlStr];
                    case Setting::ROLE_TEACHER:
                        $url = $keys[$roleName . $urlStr];
                    case Setting::ROLE_ADMIN:
                        $url = $keys[$roleName . $urlStr];
                }
            }
        }
        return $url;
    }
}
