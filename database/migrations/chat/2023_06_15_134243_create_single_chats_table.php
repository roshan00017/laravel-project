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
        Schema::create('single_chats', function (Blueprint $table) {
            $table->id();
            $table->integer('fy_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->bigInteger('from_user_id')->unsigned()->nullable();
            $table->foreign('from_user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->bigInteger('to_user_id')->unsigned()->nullable();
            $table->foreign('to_user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->text('message')->nullable();
            $table->string('file')->nullable();
            $table->boolean('seen')->default(false);
            $table->date('msg_date_en')->nullable();
            $table->string('msg_date_np')->nullable();
            $table->bigInteger('deleted_by')->unsigned()->nullable();
            $table->foreign('deleted_by')->references('id')->on('users')->onUpdate('cascade');
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
        Schema::dropIfExists('single_chats');
    }
};
