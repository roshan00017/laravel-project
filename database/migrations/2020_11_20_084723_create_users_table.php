<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client_id')->nullable();
            $table->string('full_name');
            $table->string('full_name_np')->nullable();
            $table->string('login_user_name')->unique();
            $table->string('email')->unique();
            $table->string('mobile_no')->unique()->nullable();
            $table->text('address')->nullable();
            $table->string('password');
            $table->bigInteger('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade');
            $table->string('image')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('block_status')->default(false);
            $table->string('password_reset_token')->nullable();
            $table->dateTime('password_reset_created_at')->nullable();
            $table->string('user_module')->nullable();
            $table->rememberToken();
            $table->integer('ward_no')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
            $table->bigInteger('deleted_by')->nullable();
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
        Schema::dropIfExists('users');
    }
}
