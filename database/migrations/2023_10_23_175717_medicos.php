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
        Schema::create('medicos', function (Blueprint $table) {
            $table->id();
            $table->integer('ci');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('direccion');
            $table->string('email');
            $table->integer('telefono');
            $table->string('turno');
            $table->unsignedBigInteger('especialidad_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('especialidad_id')->references('id')->on('especialidads');
            $table->foreign('user_id')->references('id')->on('users');
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
        //
    }
};
