<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i=1;$i<=10;$i++){
    		$p = new \App\Product([
    			'category_id' => rand(1,10),
    			'code' => str_random(10),
    			'name' => 'สินค้า '.$i,
    			'price' => rand(100,10000),
    			'balance' => rand(1,100),
    			'detail' => 'รายละเอียดสินค้า '.$i
    			]);
    		$p->save();
    	}
    }
}
