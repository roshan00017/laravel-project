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
        Schema::create('tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('fy_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->string('module_name')->nullable();
            $table->string('module_service_name')->nullable();
            $table->integer('module_status_id')->nullable();
            $table->string('module_unique_id')->nullable();
            $table->string('token_no')->nullable();
            $table->string('status_title_np')->nullable();
            $table->string('status_title_en')->nullable();
            $table->string('date_np')->nullable();
            $table->date('date_en')->nullable();
            $table->integer('token_month_code')->nullable();
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
        Schema::dropIfExists('tokens');
    }
};
