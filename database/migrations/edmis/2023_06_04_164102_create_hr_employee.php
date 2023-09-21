<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employee', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_id')->nullable();
            $table->string('code')->nullable();
            $table->string('first_name_np')->nullable();
            $table->bigInteger('hr_designation_id')->unsigned()->nullable();
            $table->foreign('hr_designation_id')->references('id')->on('hr_designation')->onUpdate('cascade');
            $table->string('middle_name_np')->nullable();
            $table->string('last_name_np')->nullable();
            $table->string('first_name_en')->nullable();
            $table->string('middle_name_en')->nullable();
            $table->string('last_name_en')->nullable();
            $table->string('dob_bs')->nullable();
            $table->string('dob_ad')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->integer('ward_no')->nullable();
            $table->integer('branch_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hr_employee');
    }
};
