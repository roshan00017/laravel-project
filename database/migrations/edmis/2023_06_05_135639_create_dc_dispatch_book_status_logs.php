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
        Schema::create('dc_dispatch_book_status_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('client_id')->nullable();
            $table->bigInteger('dc_dispatch_book_id')->unsigned()->nullable();
            $table->foreign('dc_dispatch_book_id')->references('id')->on('dc_dispatch_book')->onUpdate('cascade');
            $table->integer('status_id')->unsigned()->nullable();
            $table->string('update_date_np')->nullable();
            $table->date('update_date_en')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('dc_dispatch_book_status_logs');
    }
};
