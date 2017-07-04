<?php

namespace App;

class ProductReceive extends Model
{
	protected $table = 'product_receive';

	protected $dates = [
	'created_at',
	'updated_at'
	];

	public function product() {
		return $this->belongsTo(Product::class);
	}

	public function admins() {
		return $this->belongsTo(Admin::class);
	}
	
}
