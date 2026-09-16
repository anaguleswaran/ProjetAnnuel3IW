<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Compte;
use App\Models\Revenu;
use App\Models\Depense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory()
        ->count(10)
        ->has(
            Compte::factory()
                ->count(5)
                ->hasRevenus(7)
                ->hasDepenses(5),
            'comptes'
        )
        ->create();
    }
}
