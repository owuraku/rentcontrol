<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PropertyPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('property_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('old_owner')->unsigned();
            $table->integer('property_id')->unsigned();
            $table->double('amount');
            $table->unsignedSmallInteger('expiry');
            $table->timestamps();

            $table->foreign('property_id')->
            references('id')->
            on('properties')->
            onDelete('restrict')->
            onUpdate('cascade');

            $table->foreign('old_owner')->
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
        Schema::drop('property_payments');
        //
    }
}
