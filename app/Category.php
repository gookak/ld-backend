<?php

namespace App;

class Category extends Model
{
	protected $table = 'category';

	public function product() {
		return $this->hasMany(Product::class);
	}
}
