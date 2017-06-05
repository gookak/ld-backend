<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_order_id')->unsigned();
            $table->string('name', 200)->comment('ชื่อ');
            $table->text('detail')->nullable()->comment('รายละเอียด');
            $table->integer('number')->comment('จำนวน');
            $table->decimal('price', 10, 2)->comment('ราคาต่อชิ้น');
            $table->timestamps();
        });

        Schema::table('purchase_order_details', function($table) {
           $table->foreign('purchase_order_id')->references('id')->on('purchase_orders');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_order_details');
    }
}
