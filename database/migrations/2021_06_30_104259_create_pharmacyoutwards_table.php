<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePharmacyoutwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pharmacyoutwards', function (Blueprint $table) {
            $table->id();

            $table->foreignId('enrollment_id')->nullable();
            $table->string('enrollment_uuid')->nullable();
            $table->string('enrollment_uniqid')->nullable();

            $table->foreignId('vital_id')->nullable();
            $table->string('vital_uuid')->nullable();
            $table->string('vital_uniqid')->nullable();
            $table->string('patient_name');
            $table->string('patient_phone')->nullable();

            $table->string('inward_id');
            $table->string('drug_id');
            $table->string('drug_name');
            $table->integer('qty');
            $table->integer('balance');
            $table->string('unit');
            $table->string('variant');
            $table->string('bacth_id');
            $table->timestamp('manufacture_date');
            $table->timestamp('expiry_date')->nullable();
            $table->timestamp('expiry_alertdate')->nullable();
            $table->integer('received_qty');

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
        Schema::dropIfExists('pharmacyoutwards');
    }
}
