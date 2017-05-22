<?php

namespace App;

class Address extends Model
{
	protected $table = 'address';

    protected $dates = [
    'created_at',
    'updated_at'
    ];

	public function user() {
		return $this->belongsTo(User::class);
	}

    // protected $fillable = [
    //     'name', 'email', 'password'//, 'firstname', 'lasname', 'tel', 'avatar',
    //     ];

    // protected $hidden = [
    // 'password', 'remember_token',
    // ];
}
