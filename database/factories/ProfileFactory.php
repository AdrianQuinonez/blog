<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(){

        $name = $this->faker->unique()->word(15);
        $apellido = $this->faker->unique()->word(15);
        $num = 0;
        
        return [
            'photo' => 'profiles/'.$this->faker->image('public/storage/profiles', 640, 480, null, false),
            'profession' => $this->faker->word(10),
            'about' => $this->faker->realText(55),
            'twitter' => '@'.$name.$apellido,
            'linkedin' => $name.' '.$apellido,
            'facebook' => $name.' '.$apellido,
            'user_id' => User::all()->random()->id,
        ];
    }
}
