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
        Schema::create('suchikrit_users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('client_id')->nullable();
            $table->string('full_name_np')->nullable();
            $table->string('full_name_en')->nullable();
            $table->string('email')->unique();
            $table->bigInteger('mobile_no')->unique()->nullable();
            $table->string('user_name')->unique()->nullable();
            $table->string('register_date_bs')->nullable();
            $table->date('register_date_ad')->nullable();
            $table->string('password')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('password_status')->default(false);
            $table->integer('otp_code')->nullable();
            $table->integer('otp_count')->nullable();
            $table->string('otp_token')->nullable();
            $table->dateTime('otp_created_date_ad')->nullable();
            $table->string('otp_created_date_bs')->nullable();
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
        Schema::dropIfExists('suchikrit_users');
    }
};
