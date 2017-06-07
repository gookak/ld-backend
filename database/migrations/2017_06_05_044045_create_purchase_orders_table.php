<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->unsigned();
            $table->integer('vendor_id')->unsigned();
            $table->integer('purchase_status_id')->unsigned();
            $table->string('vendor_person', 100)->nullable()->comment('ชื่อผู้ติดต่อ (ยังไม่ใช้)');
            $table->string('code', 10)->comment('เลขที่ใบสั่งซื้อ');
            $table->integer('sumnumber')->nullable()->comment('รวมจำนวนสินค้าทั้งหมด (ยังไม่ใช้)');
            $table->decimal('sumprice', 10, 2)->nullable()->comment('รวมราคาสินค้าทั้งหมด (ยังไม่ใช้)');
            $table->decimal('promotion', 10, 2)->nullable()->comment('ส่วนลด (ยังไม่ใช้)');
            $table->decimal('totalprice', 10, 2)->nullable()->comment('ราคาสุทธิ (ยังไม่ใช้)');
            $table->text('note')->nullable()->comment('หมายเหตุ');
            $table->timestamp('order_at')->nullable()->comment('วันที่สั่งของ');
            $table->timestamp('complete_at')->nullable()->comment('วันที่รับสินค้าเสร็จ');
            $table->timestamps();
        });

        Schema::table('purchase_orders', function($table) {
            $table->foreign('admin_id')->references('id')->on('admins'); 
            $table->foreign('vendor_id')->references('id')->on('vendors'); 
            $table->foreign('purchase_status_id')->references('id')->on('purchase_status'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
}
