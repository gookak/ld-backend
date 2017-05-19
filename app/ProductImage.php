<?php

namespace App;

class ProductImage extends Model
{
	protected $table = 'product_image';

	protected $dates = [
    'created_at',
    'updated_at'
    ];
	
	public function product(){
		return $this->belongsTo(Product::class);
	}

	public function fileupload() {
		return $this->belongsTo(Fileupload::class);
	}
}