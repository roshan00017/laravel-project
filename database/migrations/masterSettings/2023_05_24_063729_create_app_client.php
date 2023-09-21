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
        Schema::create('app_client', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('province_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->string('code')->nullable();
            $table->string('name_np')->nullable();
            $table->string('name_en')->nullable();
            $table->string('description')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('created_by')->nullable();
            $table->dateTime('created_on')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('updated_on')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->dateTime('deleted_on')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->integer('deleted_uq_code')->nullable();
            $table->integer('document_store_size')->nullable();
            $table->string('size_type')->nullable();
            $table->string('web_url')->nullable();
            $table->string('api_web_url')->nullable();
            $table->string('display_order')->nullable();
            $table->integer('local_body_mapping_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_client');
    }
};
