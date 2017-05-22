<?php

namespace App;

class User extends Model
{
	protected $table = 'users';

    protected $dates = [
    'login_at',
    'created_at',
    'updated_at'
    ];

    public function address() {
        return $this->hasMany(Address::class);
    }

    public function order() {
        return $this->hasMany(Order::class);
    }

    // protected $fillable = [
    //     'name', 'email', 'password'//, 'firstname', 'lasname', 'tel', 'avatar',
    //     ];

    // protected $hidden = [
    // 'password', 'remember_token',
    // ];
}
