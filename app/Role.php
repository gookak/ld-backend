<?php

namespace App;

class Role extends Model
{
	protected $table = 'roles';

	protected $dates = [
    'created_at',
    'updated_at'
    ];

	// public function product() {
	// 	return $this->hasMany(Product::class);
	// }
}
