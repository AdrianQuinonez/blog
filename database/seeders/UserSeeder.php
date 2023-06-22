<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
        User::create([
            'full_name' => 'Adrian Quiñonez',
            'email' => 'adrian27@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'full_name' => 'Nuvis Acuña',
            'email' => 'nuvis05@gmail.com',
            'password' => Hash::make('87654321'),
        ]);

        User::factory(10)->create();
    }
}
