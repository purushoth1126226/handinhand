<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vitals', function (Blueprint $table) {
            $table->id();
            $table->string('enrollment_id')->nullable();
            $table->string('enrollment_uuid')->nullable();
            $table->string('enrollment_uniqid')->nullable();
            // Personal info
            $table->string('name');
            $table->integer('age')->nullable();
            $table->string('sexuality')->nullable();
            $table->string('fatherorhusband')->nullable();
            $table->string('phone')->nullable();
            $table->integer('village_id')->nullable();
            $table->date('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('aadharorrational')->nullable();
            //Vitals
            $table->string('temperature')->nullable();
            $table->string('bloodpressure')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('pulserate')->nullable();
            $table->string('respiratoryrate')->nullable();
            $table->string('spo_two')->nullable();
            $table->integer('painscaleone')->nullable();
            $table->integer('painscaletwo')->nullable();
            $table->string('location')->nullable();
            $table->string('character')->nullable();
            // psychosocial History
            $table->boolean('alcohol')->nullable();
            $table->boolean('tobacco')->nullable();
            $table->boolean('smoking')->nullable();
            $table->string('others')->nullable();
            // Doctor
            $table->string('doctors_name')->nullable();
            $table->integer('doctors_id')->nullable();

            $table->text('morbidity')->nullable();
            $table->text('diagnosis_note')->nullable();
            $table->text('prescription_note')->nullable();
            $table->text('laboratory_note')->nullable();
            $table->text('illness_note')->nullable();
            $table->text('allergy_note')->nullable();




            // Token Id
            $table->string('token_id')->nullable();
            $table->string('nextvisit')->nullable();
            $table->string('referral')->nullable();
            //allergy
            $table->boolean('is_allergy')->nullable();

            $table->timestamp('is_doctor')->nullable();
            $table->timestamp('is_labarotary')->nullable();
            $table->timestamp('is_labarotaryattended')->nullable();
            $table->timestamp('is_pharmacy')->nullable();
            $table->timestamp('is_pharmacyattended')->nullable();

            $table->integer('pharmacystatus')->nullable(); // 0-open 1-partially done, 2-done
            $table->integer('labarotarystatus')->nullable(); // 0-open 1-partially done, 2-done

            $table->text('doctorremark')->nullable();
            $table->text('pharmacyremarks')->nullable();
            $table->text('labarotaryremark')->nullable();

            $table->text('remarks')->nullable();
            $table->string('sys_id')->unique();
            $table->string('uniqid')->unique();
            $table->string('uuid')->unique();
            $table->integer('sequence_id');
            $table->integer('user_id');
            $table->string('created_by');
            $table->string('updated_id')->nullable();
            $table->string('updated_by')->nullable();
            $table->integer('status')->nullable();
            $table->boolean('active')->defalut(0);
            $table->string('flag')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('illness_vital', function (Blueprint $table) {
            $table->bigInteger('vital_id')->unsigned()->index();
            $table->bigInteger('illness_id')->unsigned()->index();
            $table->foreign('vital_id')->references('id')->on('vitals')->onDelete('cascade');
            $table->timestamps();
        });

        // Schema::create('allergy_vital', function (Blueprint $table) {
        //     $table->bigInteger('vital_id')->unsigned()->index();
        //     $table->bigInteger('allergy_id')->unsigned()->index();
        //     $table->foreign('vital_id')->references('id')->on('vitals')->onDelete('cascade');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vitals');
    }
}
