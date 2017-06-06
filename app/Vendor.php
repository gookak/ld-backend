<?php

namespace App;

class Vendor extends Model
{
	protected $table = 'vendors';

	protected $dates = [
	'created_at',
	'updated_at'
	];

	public function purchaseorder() {
		return $this->hasMany(PurchaseOrder::class);
	}

}
