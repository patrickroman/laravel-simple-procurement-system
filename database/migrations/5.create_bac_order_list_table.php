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
        Schema::create('bac_order_list', function (Blueprint $table) {
            $table->integer('bac_preriv_id')->unsigned();
            $table->boolean('checkbox')->default(false);
            $table->double('quantity');
            $table->double('updated_quantity')->nullable();
            $table->integer('item_id')->unsigned();
            $table->string('unit');
            $table->double('unit_price');
            $table->timestamps();

            $table->foreign('bac_preriv_id')
                ->references('request_id')
                ->on('request')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('item_id')
                ->references('ppmpID')
                ->on('bac')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bac_order_list');
    }
};
