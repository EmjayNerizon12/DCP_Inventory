<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class SchoolUser extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $table = 'school_users';

    protected $fillable = [
        'pk_school_id',
        'username',
        'email',
        'password',
        'default_password',
        'password_change_at',
        'last_login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'pk_school_id', 'pk_school_id');
    }
    public function getJWTIdentifier()
    {
        return $this->getKey(); // usually the primary key
    }

    /**
     * Return a key value array of custom claims to be added to the JWT.
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
