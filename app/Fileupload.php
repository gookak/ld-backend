<?php

namespace App;

class Fileupload extends Model
{
	protected $table = 'fileupload';

	protected $dates = [
    'created_at',
    'updated_at'
    ];
	
	public function productImage(){
		return $this->hasMany(ProductImage::class);
	}
}
