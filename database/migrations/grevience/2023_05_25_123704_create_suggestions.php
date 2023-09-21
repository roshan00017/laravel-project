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
        Schema::create('suggestions', function (Blueprint $table) {
            $table->id();
            $table->integer('fy_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->longText('suggestions')->nullable();
            $table->string('files')->nullable();
            $table->string('email')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('suggestion_category_id')->nullable();
            $table->date('submit_date_np')->nullable();
            $table->string('submit_date_en')->nullable();
            $table->integer('suggestion_month_code')->nullable();
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
        Schema::dropIfExists('suggestions');
    }
};
