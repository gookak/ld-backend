<?php

namespace App;

class Category extends Model
{
	protected $table = 'category';

	protected $dates = [
    'created_at',
    'updated_at'
    ];

	public function product() {
		return $this->hasMany(Product::class);
	}
}
