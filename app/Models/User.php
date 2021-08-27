<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable, Followable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'avatar',
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
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function tweet()
    {
        return $this->hasMany(Tweet::class)->latest();
    }

    public function getAvatarAttribute($value)
    {
        //since an avatar slot has been created and the image path stored in the database. This is no longer needed
        #return "https://i.pravatar.cc/200?u=" .$this->email;
        return asset($value ?: '/images/avat.jpg');
    }

    public function timeline()
    {
       #return Tweet::where('user_id', $this->id)->latest()->get();
        $friends = $this->follows()->pluck('id');

        return Tweet::whereIn('user_id', $friends)
            ->orWhere('user_id', $this->id)
            ->latest()->get();

    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class);
    }

    public function path($append = '')
    {
        $path = route('profile', $this->username);

        return $append ? "{$path}/{$append}" : $path;
    }

    //added this attribute mutator to prevent it from remembering the hashed password
    //logging in was not going through on updating the user's profile. 'This solved the problem'
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }


    /*
     public function getRouteKeyName()
     {
         return 'name';
     }*/
}
