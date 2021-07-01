<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string("foto");
            $table->string('nombre',30);
            $table->string('raza',50);
            $table->string('color', 25);
            $table->foreignId('specie_id');
            $table->longText('observaciones');
            $table->date('fecha_consulta');
            $table->char('sexo', 1);
            $table->boolean('adoptable');
            $table->foreignId('owner_id')->nullable();
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
        Schema::dropIfExists('pets');
    }
}
