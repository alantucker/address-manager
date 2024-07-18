<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'company_name' => $this->faker->company(),
            'address_1' => $this->faker->streetAddress(),
            'address_2' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'county' => $this->faker->city(),
            'postcode' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'longitude' => $this->faker->longitude(),
            'latitude' => $this->faker->latitude(),
        ];
    }
}
