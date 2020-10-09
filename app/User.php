<?php

namespace App;

use App\Notifications\VerifyNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\OTPNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'email', 'password','phoneNo','location','gender','email_verified_at','phone_verified_at','profile_pic_filename','bio','reveal_contact'
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


    public function listing()
    {
        return $this->hasMany('App\Listing')->orderBy('created_at','DESC');
    }

    public function user()
    {
        return $this->belongsTo('App\Listing');
    }

    public function request()
    {
        return $this->hasMany('App\Requests');
    }



    public function sendPasswordResetNotification($token)
{
    $this->notify(new ResetPasswordNotification($token));
}

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyNotification);
    }

    public function socialAccounts()
    {
        return $this->hasMany(Social::class);
    }


    public function otpVerify()
    {
        $this->notify(new OTPNotification);
        
    }

    public function routeNotificationForKarix()
    {
        return $this->phone;
    }


}
