<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id')->unsigned();
            $table->string('title');
            $table->boolean('available')->default(true);
            $table->unsignedTinyInteger('class')->default(1);
            $table->double('amount');
            $table->string('location');
            $table->unsignedTinyInteger('duration')->nullable(true);
            $table->unsignedTinyInteger('type');
            $table->string('description');
            $table->timestamps();

            $table->foreign('owner_id')->
            references('id')->
            on('users')->
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
        //
        Schema::disableForeignKeyConstraints();
        Schema::drop('properties');
    }
}
