<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "tbl_user";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public $incrementing = false;

    public function staff()
    {
        return $this->hasOne(Staff::class, 'user_id', 'id');
    }

    // public function address()
    // {
    //     return $this->hasOne(Address::class);
    // }

    // public function order()
    // {
    //     return $this->hasMany(Order::class);
    // }
}
