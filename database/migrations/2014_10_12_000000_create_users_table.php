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
            $table->id();

            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('designation')->nullable();
            $table->integer('role_id')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_two')->nullable();
            $table->string('department')->nullable();
            $table->date('dob')->nullable();
            $table->date('doj')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('api_token', 60)->unique()->nullable();

            $table->string('avatar')->nullable();
            $table->string('language')->nullable();

            $table->datetime('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->text('remarks')->nullable();
            $table->string('uuid');
            $table->string('sys_id')->unique()->nullable();
            $table->string('uniqid')->unique()->nullable();
            $table->integer('sequence_id')->unique()->nullable();
            $table->integer('user_id')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->integer('updated_id')->nullable();
            $table->integer('status')->default(0); // active
            $table->string('active')->default(0);
            $table->integer('active_record')->default(0);
            $table->integer('flag')->default(0);
            $table->boolean('condition')->default(0);
            $table->date('date')->nullable();
            $table->softDeletes();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
