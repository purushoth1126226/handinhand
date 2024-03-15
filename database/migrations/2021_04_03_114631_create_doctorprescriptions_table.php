<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorprescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctorprescriptions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('enrollment_id')->nullable();
            $table->string('enrollment_uuid')->nullable();
            $table->string('enrollment_uniqid')->nullable();

            $table->foreignId('vital_id')->nullable();
            $table->string('vital_uuid')->nullable();
            $table->string('vital_uniqid')->nullable();

            $table->foreignId('drug_id')->nullable();
            $table->string('drugname')->nullable();
            $table->boolean('morning')->nullable();
            $table->boolean('afternoon')->nullable();
            $table->boolean('evening')->nullable();
            $table->boolean('night')->nullable();
            $table->boolean('bf')->nullable();
            $table->boolean('af')->nullable();
            $table->integer('count')->nullable();

            $table->integer('pharmacycount')->nullable();
            $table->integer('tabltstatus')->nullable(); // 0- Not done 1-partially give 2 -done

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
        Schema::dropIfExists('doctorprescriptions');
    }
}
