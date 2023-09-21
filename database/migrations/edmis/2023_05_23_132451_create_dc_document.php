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
        Schema::create('dc_document', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->string('document_no')->nullable();
            $table->integer('document_type_id')->nullable();
            $table->integer('from_section_id')->nullable();
            $table->integer('to_section_id')->nullable();
            $table->timestamp('added_on')->nullable();
            $table->integer('added_by')->nullable();
            $table->integer('fiscal_year_id')->nullable();
            $table->string('filepath')->nullable();
            $table->integer('employee_id')->nullable();
            $table->integer('file_status_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('ward_no')->nullable();
            $table->integer('document_month_code')->nullable();
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
        Schema::dropIfExists('dc_document');
    }
};
