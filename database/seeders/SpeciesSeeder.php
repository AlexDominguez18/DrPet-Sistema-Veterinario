<?php

namespace Database\Seeders;

use App\Models\Specie;
use Illuminate\Database\Seeder;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Specie::create(['nombre' => 'Perro']);
        Specie::create(['nombre' => 'Gato']);
        Specie::create(['nombre' => 'Conejo']);
        Specie::create(['nombre' => 'Hámster']);
        Specie::create(['nombre' => 'Tortuga']);
        Specie::create(['nombre' => 'Hurón']);
        Specie::create(['nombre' => "Ave"]);
        Specie::create(['nombre' => 'Reptil']);
    }
}
