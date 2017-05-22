<?php

namespace App;

class TransportStatus extends Model
{
	protected $table = 'transport_status';

    protected $dates = [
    'created_at',
    'updated_at'
    ];

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
