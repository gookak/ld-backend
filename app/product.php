<?php

namespace App;

class Product extends Model
{
	protected $table = 'product';

	protected $dates = [
	'created_at',
	'updated_at'
	];

	public function category() {
		return $this->belongsTo(Category::class);
	}
	
	public function productImage() {
		return $this->hasMany(ProductImage::class);
	}

	public function orderdetail() {
		return $this->hasMany(OrderDetail::class);
	}

	public function productreceive() {
		return $this->hasMany(ProductReceive::class);
	}
}
