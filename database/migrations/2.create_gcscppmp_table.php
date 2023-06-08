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
        Schema::create('gcscppmp', function (Blueprint $table) {
            $table->increments('ppmpID');
            $table->string('ItemCode');
            $table->string('ItemDet');
            $table->string('UnitMeas');
            $table->integer('Jan');
            $table->integer('Feb');
            $table->integer('Mar');
            $table->integer('Q1');
            $table->double('Q1Amount');
            $table->integer('Apr');
            $table->integer('May');
            $table->integer('June');
            $table->integer('Q2');
            $table->double('Q2Amount');
            $table->integer('July');
            $table->integer('Aug');
            $table->integer('Sept');
            $table->integer('Q3');
            $table->double('Q3Amount');
            $table->integer('Oct');
            $table->integer('Nov');
            $table->integer('Dec');
            $table->integer('Q4');
            $table->double('Q4Amount');
            $table->double('TotalQ');
            $table->double('Price');
            $table->double('TotalAmount');
            $table->boolean('checkbox')->default(false);
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
        Schema::dropIfExists('gcscppmp');
    }
};
