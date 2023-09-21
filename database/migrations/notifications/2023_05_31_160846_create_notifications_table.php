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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->integer('fy_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->string('notify_date_np');
            $table->string('notify_date_en');
            $table->string('title_en');
            $table->string('title_np');
            $table->integer('notify_id')->nullable();
            $table->integer('notify_to_user_id')->nullable();
            $table->string('notify_url');
            $table->bigInteger('notify_read_by')->nullable();
            $table->foreign('notify_read_by')->references('id')->on('users')->onUpdate('cascade');
            $table->string('notify_type');
            $table->string('notification_read_date_np')->nullable();
            $table->date('notification_read_date_en')->nullable();
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
        Schema::dropIfExists('notifications');
    }
};
