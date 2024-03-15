<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogininfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logininfos', function (Blueprint $table) {
            $table->id('id');

            $table->string('uuid');
            $table->string('device')->nullable();
            $table->string('robot')->nullable();
            $table->string('browser')->index('browser')->nullable();
            $table->string('browser_v')->nullable();
            $table->string('platform')->nullable();
            $table->string('platform_v')->nullable();
            $table->string('serverIp')->nullable();
            $table->string('clientIp')->nullable();
            $table->string('languages')->nullable();
            $table->string('regexp')->nullable();
            $table->string('user_id');
            $table->string('user_name');
            $table->string('email');

            $table->string('login_status')->nullable();
            $table->integer('status')->default(0);
            $table->integer('flag')->default(0);

            $table->softDeletes();
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
        Schema::dropIfExists('logininfos');
    }
}
