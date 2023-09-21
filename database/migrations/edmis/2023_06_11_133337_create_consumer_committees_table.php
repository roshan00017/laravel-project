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
        Schema::create('consumer_committees', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('form_date_bs')->nullable();
            $table->date('form_date_ad')->nullable();
            $table->integer('ward_no')->nullable();
            $table->boolean('status')->nullable();
            $table->string('bank')->nullable();
            $table->string('bank_acc_num')->nullable();
            $table->string('bank_address')->nullable();
            $table->integer('present_number')->nullable();
            $table->integer('members_number')->nullable();
            $table->string('witness_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('name')->nullable();
            $table->string('consumer_committee_type')->nullable();
            $table->integer('regd_no')->nullable();
            $table->string('regd_date_bs')->nullable();
            $table->date('regd_date_ad')->nullable();
            $table->string('office')->nullable();
            $table->string('other_details')->nullable();
            $table->integer('per_province_code')->nullable();
            $table->integer('per_district_code')->nullable();
            $table->integer('per_local_body_code')->nullable();
            $table->integer('per_ward_no')->nullable();
            $table->string('per_street_name')->nullable();
            $table->integer('temp_province_code')->nullable();
            $table->integer('temp_district_code')->nullable();
            $table->integer('temp_local_body_code')->nullable();
            $table->integer('temp_ward_no')->nullable();
            $table->string('temp_street_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->integer('fax')->nullable();
            $table->string('email')->nullable();
            $table->string('post_address')->nullable();
            $table->string('contact_person_full_name')->nullable();
            $table->string('contact_person_name')->nullable();
            $table->string('contact_person_designation')->nullable();
            $table->string('contact_person_phone')->nullable();
            $table->string('contact_person_mobile')->nullable();
            $table->string('remarks ')->nullable();
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
        Schema::dropIfExists('consumer_committees');
    }
};
