<?php

namespace Database\Factories;

use App\Models\Revenu;
use App\Models\Compte;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Revenu>
 */
class RevenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $revenus = [
            [
                'nom' => 'Salaire',
                'description' => 'Salaire mensuel versé par l’employeur.',
            ],
            [
                'nom' => 'Prime',
                'description' => 'Prime exceptionnelle liée aux objectifs atteints durant l’année.',
            ],
            [
                'nom' => 'Freelance',
                'description' => 'Paiement reçu pour une mission réalisée auprès d’un client.',
            ],
            [
                'nom' => 'Dividendes',
                'description' => 'Versement des dividendes générés par les investissements.',
            ],
            [
                'nom' => 'Intérêts',
                'description' => 'Intérêts versés sur les comptes d’épargne et placements financiers.',
            ],
            [
                'nom' => 'Location immobilière',
                'description' => 'Loyer reçu suite à la location d’un appartement ou d’une maison.',
            ],
            [
                'nom' => 'Remboursement',
                'description' => 'Remboursement reçu suite à une avance de frais ou une dépense partagée.',
            ],
            [
                'nom' => 'Allocation',
                'description' => 'Versement d’une aide financière ou d’une allocation mensuelle.',
            ],
            [
                'nom' => 'Vente occasionnelle',
                'description' => 'Revenu obtenu grâce à la vente d’un objet personnel.',
            ],
            [
                'nom' => 'Héritage',
                'description' => 'Somme reçue suite à une succession familiale.',
            ],
        ];

        $revenu = fake()->randomElement($revenus);
        $frequence = fake()->boolean(70);
        $dateDebut = fake()->dateTimeBetween('2018-01-01', '2030-12-31');
        $dateFin = $frequence ? fake()->dateTimeBetween($dateDebut, '2030-12-31') : null;

        return [
            'nom' => $revenu['nom'],
            'description' => $revenu['description'],
            'duree' => $frequence ? fake()->randomElement([1, 1, 1, 3, 6, 12]) : null,
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
            'frequence' => $frequence,
            'montant' => fake()->randomFloat(2, 50, 5000),
            'compte_id' => Compte::factory(),
        ];
    }
}
