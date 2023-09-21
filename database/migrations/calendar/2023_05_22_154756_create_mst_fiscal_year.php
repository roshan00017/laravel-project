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
        Schema::create('mst_fiscal_year', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('client_id')->nullable();
            $table->string('code')->nullable();
            $table->string('date_from_bs')->nullable();
            $table->date('date_from_ad')->nullable();
            $table->string('date_to_bs')->nullable();
            $table->string('date_to_ad')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('created_by')->nullable();
            $table->dateTime('created_on')->nullable();
            $table->integer('updated_by')->nullable();
            $table->dateTime('updated_on')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->dateTime('deleted_on')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->integer('deleted_uq_code')->nullable();
            $table->integer('client_ward')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_fiscal_year');
    }
};
