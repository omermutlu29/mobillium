<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;
    protected $primaryKey='id';

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

    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_roles');
    }

    public function points(){
        return $this->belongsToMany(Article::class,'article_points')->withPivot(['article_id']);
    }

    public function articles(){
        return $this->hasMany(Article::class,'author_id');
    }

    public function hasRole($pRole){
        foreach ($this->roles()->get() as $role){
            if ($role->name == $pRole)
            {
                return true;
            }
        }
        return false;
    }
}
