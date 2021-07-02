<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password =Hash::make('1823admin');
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@drpet.com',
            'admin' => '1', 
            'email_verified_at' => now(),
            'password' => $password,
        ]);
    }
}
