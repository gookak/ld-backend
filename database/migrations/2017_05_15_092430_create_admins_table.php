<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->string('firstname', 200)->comment('ชื่อ');
            $table->string('lastname', 200)->nullable()->comment('นามสกุล');
            $table->string('card_id', 13)->comment('เลขบัตรประจำตัวประชาชน');
            $table->date('card_build_at')->nullable()->comment('วันออกบัตร');
            $table->date('card_expire_at')->nullable()->comment('บัตรหมดอายุ');
            $table->string('tel', 100)->nullable()->comment('เบอร์ติดต่อ');
            $table->string('avatar', 100)->nullable()->comment('รูปภาพ (ยังไม่ใช้)');
            $table->text('address')->nullable()->comment('ที่อยู่');
            $table->string('gender', 100)->nullable()->comment('เพศ');
            $table->date('birthday')->nullable()->comment('วันเกิด');
            $table->string('title', 200)->nullable()->comment('คำนำหน้า');
            $table->string('extraction', 200)->nullable()->comment('เชื้อชาติ');
            $table->string('nationality', 200)->nullable()->comment('สัญชาติ');
            $table->string('religion', 200)->nullable()->comment('ศาสนา');
            $table->string('blood', 5)->nullable()->comment('กรุ๊ปเลือด');
            $table->string('maritalstatus', 200)->nullable()->comment('สถานภาพสมรส');
            $table->date('work_at')->nullable()->comment('วันเข้างาน');
            $table->string('emergencyperson', 200)->nullable()->comment('บุคคลติดต่อฉุกเฉิน');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('admins', function($table) {
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
