<?php

namespace App;

class ProductImage extends Model
{
	protected $table = 'product_image';
	
	public function product(){
		return $this->belongsTo(Product::class);
	}

	public function fileupload() {
		return $this->belongsTo(Fileupload::class);
	}
}