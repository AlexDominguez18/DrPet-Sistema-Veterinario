<?php

namespace Database\Factories;

use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;

class OwnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Owner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'telefono' => $this->faker->numerify('##########'),
            'correo' => $this->faker->unique()->safeEmail(),
            'direccion' => $this->faker->bothify('?????-####')
        ];
    }
}
