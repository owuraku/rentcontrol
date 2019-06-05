<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PropertyRatePayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('property_rate_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_id');
            $table->integer('property_id')->unsigned();
            $table->double('amount');
            $table->unsignedSmallInteger('active_year');
            $table->timestamps();

            $table->foreign('property_id')->
            references('id')->
            on('properties')->
            onDelete('restrict')->
            onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::drop('property_rate_payments');
        //
    }
}
