<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\Specie;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'raza' => $this->faker->word(),
            'color' => $this->faker->colorName(),
            'specie_id' => Specie::all()->random()->id,
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'adoptable' => false
        ];
    }

    public function on_adoption() {
        return $this->state(function (array $attributes) {
            return [
                'adoptable' => true,
            ];
        });
    }
}
