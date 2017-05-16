<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('number')->comment('จำนวน');
            $table->decimal('price', 10, 2)->comment('ราคาต่อชิ้น');
            $table->timestamps();
        });

        Schema::table('order_detail', function($table) {
           $table->foreign('order_id')->references('id')->on('order');
           $table->foreign('product_id')->references('id')->on('product');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_detail');
    }
}
