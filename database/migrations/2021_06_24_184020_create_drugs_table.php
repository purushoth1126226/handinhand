<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drugs', function (Blueprint $table) {
            $table->id();

            $table->string('name')->index()->unique();
            $table->string('generic_name');
            $table->string('drug_classification');
            $table->string('dosage')->nullable();
            $table->integer('drug_variant');
            $table->string('manufacture_name');

            $table->integer('currentstock')->nullable();

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

        Schema::create('diagnosis_drug', function (Blueprint $table) {
            $table->bigInteger('drug_id')->unsigned()->index();
            $table->bigInteger('diagnosis_id')->unsigned()->index();
            $table->foreign('drug_id')->references('id')->on('drugs')->onDelete('cascade');
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
        Schema::dropIfExists('drugs');
    }
}
