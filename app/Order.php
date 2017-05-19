<?php

namespace App;

class Order extends Model
{
	protected $table = 'order';

    protected $dates = [
    'send_at',
    'complete_at',
    'created_at',
    'updated_at'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function transportstatus() {
        return $this->belongsTo(TransportStatus::class);
    }

    public function orderdetail() {
        return $this->hasMany(OrderDetail::class);
    }

    // protected $fillable = [
    //     'name', 'email', 'password'//, 'firstname', 'lasname', 'tel', 'avatar',
    //     ];

    // protected $hidden = [
    // 'password', 'remember_token',
    // ];

}
