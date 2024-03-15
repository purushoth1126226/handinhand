<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInwarditemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inwarditems', function (Blueprint $table) {
            $table->id();

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
            $table->double('price', 8, 2);

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
        Schema::dropIfExists('inwarditems');
    }
}
