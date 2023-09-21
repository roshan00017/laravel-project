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
        Schema::create('mst_federal_hierarchy', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('master_ref_id')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_np')->nullable();
            $table->integer('parent_id')->nullable();
            $table->integer('federal_level_type_id')->nullable();
            $table->string('description')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('is_current')->default(true);
            $table->boolean('is_deleted')->default(true);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->integer('deleted_uq_code')->nullable();
            $table->integer('client_ward')->nullable();
            $table->string('name_en_backup')->nullable();
            $table->boolean('is_old_data')->default(true);
            $table->dateTime('created_on')->nullable();
            $table->dateTime('updated_on')->nullable();
            $table->dateTime('deleted_on')->nullable();
        });
    }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::dropIfExists('mst_federal_hierarchy');
     }
};
