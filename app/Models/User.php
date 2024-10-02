<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'email',
        'github_id',
        'name',
        'avatar',
        'nickname',
        'github_token',
        'github_refresh_token',
    ];
}