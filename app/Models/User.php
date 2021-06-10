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
    public function posts()
    // Plural porque un usuario puede tener muchos posts
    {
        // Un usuario tiene muchos Posts
        return $this->hasMany(Post::class );
    }
    //Tiene que comenzar por get y terminar por Attribute,
    //Lo que va en el medio es el nombre del metodo
    //Para implementar seria get_name
    public function getGetNameAttribute()
    {
        return strtoupper($this->name);
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value) ;
    }
}
