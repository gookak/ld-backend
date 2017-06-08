<?php

namespace App;

class PurchaseStatus extends Model
{
	protected $table = 'purchase_status';

	protected $dates = [
	'created_at',
	'updated_at'
	];

	public function purchaseorder() {
		return $this->hasMany(PurchaseOrder::class);
	}

}
