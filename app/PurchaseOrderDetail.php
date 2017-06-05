<?php

namespace App;

class PurchaseOrderDetail extends Model
{
	protected $table = 'purchase_order_details';

    protected $dates = [
    'created_at',
    'updated_at'
    ];

    public function purchaseorder() {
        return $this->belongsTo(PurchaseOrder::class);
    }

    // public function product() {
    //     return $this->belongsTo(Product::class);
    // }

}
