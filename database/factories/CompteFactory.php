<?php

namespace Database\Factories;

use App\Models\Compte;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Compte>
 */
class CompteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->randomElement([
                'Compte courant',
                'Livret A',
                'PEL',
                'Compte joint',
                'Assurance vie',
                'Épargne',
            ]),
            'description' => fake()->sentence(),
            'taux_remuneration' => fake()->randomFloat(2, 0, 8),
            'taux_imposition' => fake()->randomFloat(2, 0, 55),
            'user_id' => User::factory(),
        ];
    }
}
