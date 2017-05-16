<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for($i=1;$i<=10;$i++){
    		$c = new \App\Category([
    			'name' => 'ประเภทสินค้า '.$i,
    			'detail' => 'รายละเอียดประเภทสินค้า '.$i
    			]);
    		$c->save();
    	}
    }
}
