<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200)->comment('ชื่อผู้ขาย');
            $table->text('address')->nullable()->comment('ที่อยู่');
            $table->string('tel', 100)->nullable()->comment('เบอร์ติดต่อ');
            $table->string('fax', 100)->nullable()->comment('เบอร์ FAX');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
