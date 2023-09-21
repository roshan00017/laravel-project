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
        Schema::create('complaints', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('fy_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('complaint_no')->nullable();
            $table->integer('form_category_id')->nullable();
            $table->text('description')->nullable();
            $table->integer('complaint_source_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('severity_type_id')->nullable();
            $table->string('province_code')->nullable();
            $table->string('district_code')->nullable();
            $table->string('local_government_code')->nullable();
            $table->string('ward')->nullable();
            $table->string('tole')->nullable();
            $table->string('name_ne')->nullable();
            $table->string('name_en')->nullable();
            $table->string('mobile_no')->nullable();
            $table->integer('gender_id')->nullable();
            $table->string('email')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('skype_username')->nullable();
            $table->boolean('disclose_complainer_info')->nullable();
            $table->boolean('is_password_protected')->nullable();
            $table->integer('default_response_id')->nullable();
            $table->boolean('is_directly_closed')->nullable();
            $table->boolean('is_public')->nullable();
            $table->integer('office_id')->nullable();
            $table->boolean('require_follow_up')->nullable();
            $table->date('follow_up_date_ad')->nullable();
            $table->string('follow_up_date_bs')->nullable();
            $table->text('csd_response')->nullable();
            $table->text('csd_response_public')->nullable();
            $table->boolean('solved_by_call_center')->nullable();
            $table->boolean('directly_closed')->nullable();
            $table->boolean('office_unknown')->nullable();
            $table->boolean('assign_jst_for_improvement')->nullable();
            $table->text('file_name')->nullable();
            $table->integer('status')->nullable();
            $table->string('complaint_date_np')->nullable();
            $table->date('complaint_date_en')->nullable();
            $table->integer('complaint_month_code')->nullable();
            $table->string('appointment_no')->nullable();
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
        Schema::dropIfExists('complaints');
    }
};
