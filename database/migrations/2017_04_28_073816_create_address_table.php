<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('fullname', 200)->comment('ชื่อในการจัดส่ง');
            $table->text('detail')->comment('รายละเอียด');
            $table->string('postcode', 10)->comment('รหัสไปรษณีย์');
            $table->string('tel', 100)->nullable()->comment('เบอร์ติดต่อ');           
            $table->timestamps();
        });

        Schema::table('address', function($table) {
            $table->foreign('user_id')->references('id')->on('users'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address');
    }
}
