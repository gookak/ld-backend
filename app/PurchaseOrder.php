<?php

namespace App;

class PurchaseOrder extends Model
{
	protected $table = 'purchase_orders';

    protected $dates = [
    'complete_at',
    'created_at',
    'updated_at'
    ];

    public function admin() {
        return $this->belongsTo(Admin::class);
    }

    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }

    public function purchasestatus() {
        return $this->belongsTo(PurchaseStatus::class, 'purchase_status_id');
    }

    public function purchaseorderdetail() {
        return $this->hasMany(PurchaseOrderDetail::class);
    }

}
