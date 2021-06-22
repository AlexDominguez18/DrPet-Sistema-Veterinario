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
            $table->foreignId('owner_id');
            $table->string('nombre',30);
            $table->char('sexo', 1);
            $table->string('raza',50);
            $table->string('color', 25);
            $table->string('especie',30);
            $table->longText('observaciones');
            $table->date('fecha_consulta');
            $table->boolean('adoptable');
            $table->foreignId('vacunas');
            $table->foreignId('medicamentos');
            $table->string("foto");
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
