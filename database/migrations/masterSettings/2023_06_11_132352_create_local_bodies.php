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
        Schema::create('local_bodies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('province_code')->nullable();
            $table->string('district_code')->nullable();
            $table->string('code')->nullable();
            $table->string('name_np')->nullable();
            $table->string('name_en')->nullable();
            $table->string('web_url')->nullable();
            $table->integer('total_ward')->nullable();
            $table->string('area')->nullable();
            $table->string('population')->nullable();
            $table->string('lat')->nullable();
            $table->string('lan')->nullable();
            $table->boolean('status')->default(true);
            $table->bigInteger('local_body_type_id')->unsigned()->nullable();
            $table->foreign('local_body_type_id')->references('id')->on('local_body_types')->onUpdate('cascade');
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
        Schema::dropIfExists('local_bodies');
    }
};
