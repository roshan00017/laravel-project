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
        Schema::create('dc_dispatch_book', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('letter_no')->nullable();
            $table->string('dispatch_no')->nullable();
            $table->string('dispatch_date_bs')->nullable();
            $table->date('dispatch_date_ad')->nullable();
            $table->string('letter_date_bs')->nullable();
            $table->date('letter_date_ad')->nullable();
            $table->integer('from_branch_id')->nullable();
            $table->string('letter_sub')->nullable();
            $table->boolean('is_foreign')->nullable();
            $table->integer('country_id')->nullable();
            $table->boolean('is_person')->nullable();
            $table->integer('to_office_id')->nullable();
            $table->string('to_office_contact')->nullable();
            $table->string('to_office_name')->nullable();
            $table->string('to_office_address')->nullable();
            $table->integer('sent_medium_id')->nullable();
            $table->integer('sign_person_id')->nullable();
            $table->integer('dispatch_by_id')->nullable();
            $table->string('notes')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('entry_date_bs')->nullable();
            $table->date('entry_date_ad')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('contact_address')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('letter_status')->nullable();
            $table->integer('document_types')->nullable();
            $table->integer('fiscal_year_id')->nullable();
            $table->string('letter_upload')->nullable();
            $table->string('file_type')->nullable();
            $table->string('bcc_id')->nullable();
            $table->string('regd_no')->nullable();
            $table->integer('ward_no')->nullable();
            $table->integer('confidentiality')->nullable();
            $table->integer('priority')->nullable();
            $table->integer('template')->nullable();
            $table->boolean('separate_letter')->nullable();
            $table->boolean('letter_sakha_include')->nullable();
            $table->boolean('letterhead_sakha_include')->nullable();
            $table->integer('added_by')->nullable();
            $table->integer('dispatch_month_code')->nullable();
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
        Schema::dropIfExists('dc_dispatch_book');
    }
};
