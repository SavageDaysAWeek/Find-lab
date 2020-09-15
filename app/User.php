<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = [
        'id', 'first_name', 'last_name', 'photo', 'photo_rec', 'hash', 'is_banned', 'is_private', 'is_activated'
    ];

    public function docs()
    {
        return $this->hasMany('App\Doc');
    }
}
