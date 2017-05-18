<?php

namespace App;

class Product extends Model
{
	protected $table = 'product';

	public function category() {
		return $this->belongsTo(Category::class);
	}
	
	public function productImage() {
		return $this->hasMany(ProductImage::class);
	}

	public function orderdetail() {
        return $this->hasMany(OrderDetail::class);
    }
}
