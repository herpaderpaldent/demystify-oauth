<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        return [
            'client_id' => $this->faker->unique()->isbn13,
            'client_secret' => $this->faker->unique()->sha256,
            'name' => $this->faker->name(),
            'callback_url' => $this->faker->unique()->url,
            'email' => $this->faker->email,
            'description' => $this->faker->text,
        ];
    }


}
