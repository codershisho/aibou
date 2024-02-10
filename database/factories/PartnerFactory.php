<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partner>
 */
class PartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'organization_type' => $this->faker->randomElement([1, 2, 3]),
            'basic_contract_flag' => $this->faker->boolean,
            'contact_person' => $this->faker->name,
            'contact' => $this->faker->email,
            'rating' => $this->faker->numberBetween(1, 5),
            'specialty' => $this->faker->text,
            'memo' => $this->faker->text,
        ];
    }
}
