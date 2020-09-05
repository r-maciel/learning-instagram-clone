<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //boot method is called when we're booting up User model
    protected static function boot()
    {
        parent::boot();

        // Created is an eloquent event that is fired when a user is created
        // It takes a function (closure) that gives the user has been created, then we create a profile for that user through the realationship, we can do it because every field in or profile is nullable
        static::created(function($user){
            $user->profile()->create([
                'title' => $user->username
            ]);
        });
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function posts()
    {
        /* If you don't want to order the post in the controller you can define here the default actions
        to bring the posts for the user, you can use latest() or orderBy('created_at') */
        return $this->hasMany(Post::class)->latest();
    }
}
