<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $available_languages = [
        'en' => 'English',
        'it' => 'Italian',
        'ro' => 'Romanian',
        'fr' => 'French',
        'zh_cn' => 'Chinese',
        'zh_tw' => 'Chinese(Taiwan)',
        'es' => 'Spanish',
        'sk' => 'Slovak',
        'pt_br' => 'Portuguese(Brazil)',
    ];
}
