<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OwnersTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Owner::factory(10)->create();
    }
}
