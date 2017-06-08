<?php

namespace App;

class Seller extends Model
{
	protected $table = 'sellers';

	protected $dates = [
	'created_at',
	'updated_at'
	];

	public function purchaseorder() {
		return $this->hasMany(PurchaseOrder::class);
	}

}
