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
        Schema::create('dc_regd_book', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->string('regd_no')->nullable();
            $table->string('regd_date_bs')->nullable();
            $table->date('regd_date_ad')->nullable();
            $table->string('letter_no')->nullable();
            $table->string('letter_date_bs')->nullable();
            $table->date('letter_date_ad')->nullable();
            $table->string('dispatch_no')->nullable();
            $table->boolean('is_foreign')->nullable();
            $table->integer('country_id')->nullable();
            $table->boolean('is_person')->nullable();
            $table->integer('from_off_id')->nullable();
            $table->string('from_office_name')->nullable();
            $table->string('from_office_address')->nullable();
            $table->string('letter_sub')->nullable();
            $table->integer('to_branch_id')->nullable();
            $table->integer('first_person_id')->nullable();
            $table->integer('regd_by_id')->nullable();
            $table->boolean('fee_applicable')->nullable();
            $table->double('reg_fee')->nullable();
            $table->string('notes')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('entry_date_bs')->nullable();
            $table->date('entry_date_ad')->nullable();
            $table->boolean('is_sms_sent')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('contact_address')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('fiscal_year_id')->nullable();
            $table->integer('letter_status')->nullable();
            $table->integer('ward_no')->nullable();
            $table->string('reg_receipt')->nullable();
            $table->string('reg_name')->nullable();
            $table->integer('document_types')->nullable();
            $table->boolean('received_office_person')->nullable();
            $table->string('received_office_name')->nullable();
            $table->string('received_contact_person')->nullable();
            $table->string('received_contact_address')->nullable();
            $table->string('received_contact_mobile')->nullable();
            $table->string('letter_upload')->nullable();
            $table->integer('confidentiality')->nullable();
            $table->integer('priority')->nullable();
            $table->integer('added_by')->nullable();
            $table->integer('register_month_code')->nullable();
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
        Schema::dropIfExists('dc_regd_book');
    }
};
