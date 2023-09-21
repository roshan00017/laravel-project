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
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_name')->nullable();
            $table->string('app_name_np')->nullable();
            $table->string('app_short_name')->nullable();
            $table->string('app_short_name_np')->nullable();
            $table->string('app_logo')->nullable();
            $table->boolean('login_attempt_required')->default(false);
            $table->integer('login_attempt_limit')->nullable();
            $table->boolean('login_captcha_required')->default(false);
            $table->boolean('forget_password_required')->default(true);
            $table->string('login_title')->nullable();
            $table->string('login_title_np')->nullable();
            $table->integer('session_expire_time')->nullable();
            $table->integer('api_key_expire_time')->nullable();
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
        Schema::dropIfExists('app_settings');
    }
};
