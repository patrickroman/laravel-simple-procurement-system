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
        Schema::create('request', function (Blueprint $table) {
            $table->increments('request_id');
            $table->integer('requested_by')->unsigned();
            $table->string('department');
            $table->string('control_no');
            $table->integer('item_count')->nullable();
            $table->double('total_price')->nullable();
            $table->integer('approved_item_count')->nullable();
            $table->double('approved_total_price')->nullable();
            $table->string('delivered_to');
            $table->integer('updated_by_id')->nullable()->unsigned();
            $table->tinyInteger('request_status')->nullable();
            $table->string('notes')->nullable();
            $table->string('purpose')->nullable();
            $table->string('budget_source')->nullable();
            $table->string('action_taken')->nullable();
            $table->string('remarks')->nullable();
            $table->string('category')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('updated_by_id')
                ->references('userID')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('requested_by')
                ->references('userID')
                ->on('users')
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
        Schema::dropIfExists('request');
    }
};
