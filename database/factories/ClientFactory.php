<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Gender;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('pt_BR');

        return [
            'name' => $faker->name,
            'cpf' => $faker->cpf,
            'gender_id' => Gender::inRandomOrder()->first()->id,
            'email' => $faker->safeEmail,
        ];
    }
}
