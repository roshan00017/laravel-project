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
        Schema::create('hr_designation', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable();
            $table->string('code')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_np')->nullable();
            $table->string('description')->nullable();
            $table->boolean('status')->nullable();
            $table->string('emp_post')->nullable();
            $table->integer('created_by')->nullable();
            $table->dateTime('created_on')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('updated_on')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->dateTime('deleted_on')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->integer('deleted_uq_code')->nullable();
            $table->integer('display_order')->nullable();
            $table->integer('client_ward')->nullable();
            $table->dateTime('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hr_designation');
    }
};
