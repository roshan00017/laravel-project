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
        Schema::create('elected_persons', function (Blueprint $table) {
            $table->id();
            $table->string('name_np');
            $table->string('name_en');
            $table->enum('halko_bhu_pu', ['pa', 'pre']);
            $table->string('tenure_start_date')->nullable();
            $table->string('tenure_end_date')->nullable();
            $table->string('email');
            $table->bigInteger('mobile');
            $table->boolean('status');
            $table->bigInteger('hr_designation_id')->unsigned()->nullable();
            $table->foreign('hr_designation_id')->references('id')->on('hr_designation')->onUpdate('cascade');
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade');
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
        Schema::dropIfExists('elected_persons');
    }
};
