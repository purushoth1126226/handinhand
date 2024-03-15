<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabreportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labreports', function (Blueprint $table) {
            $table->id();

            $table->string('enrollment_id')->nullable();
            $table->string('enrollment_uuid')->nullable();
            $table->string('enrollment_uniqid')->nullable();

            $table->string('vital_id')->nullable();
            $table->string('vital_uuid')->nullable();
            $table->string('vital_uniqid')->nullable();

            $table->string('name')->nullable(); // labinvestigation
            $table->string('result')->nullable();
            $table->text('range')->nullable();
            $table->boolean('sample')->nullable();
            $table->boolean('positive')->nullable();

            $table->text('remarks')->nullable();
            $table->integer('status')->nullable();
            $table->boolean('active')->defalut(0);
            $table->string('flag')->nullable();
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
        Schema::dropIfExists('labreports');
    }
}
