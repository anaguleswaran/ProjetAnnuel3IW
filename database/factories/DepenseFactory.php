<?php

namespace Database\Factories;

use App\Models\Depense;
use App\Models\Compte;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Depense>
 */
class DepenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $depenses = [
            [
                'nom' => 'Loyer',
                'description' => 'Paiement mensuel du loyer du logement principal.',
            ],
            [
                'nom' => 'Courses alimentaires',
                'description' => 'Achats de nourriture et produits nécessaires au quotidien.',
            ],
            [
                'nom' => 'Électricité',
                'description' => 'Facture mensuelle d’électricité liée au logement.',
            ],
            [
                'nom' => 'Internet',
                'description' => 'Abonnement internet et services associés.',
            ],
            [
                'nom' => 'Téléphone',
                'description' => 'Forfait mobile mensuel avec appels et données internet.',
            ],
            [
                'nom' => 'Transport',
                'description' => 'Dépenses liées aux transports en commun ou déplacements.',
            ],
            [
                'nom' => 'Carburant',
                'description' => 'Achat de carburant pour les déplacements en voiture.',
            ],
            [
                'nom' => 'Restaurant',
                'description' => 'Repas pris au restaurant ou commandes de repas occasionnelles.',
            ],
            [
                'nom' => 'Assurance',
                'description' => 'Paiement des cotisations d’assurance habitation ou automobile.',
            ],
            [
                'nom' => 'Santé',
                'description' => 'Frais médicaux, consultations et achats en pharmacie.',
            ],
            [
                'nom' => 'Loisirs',
                'description' => 'Dépenses liées aux sorties, activités culturelles et divertissements.',
            ],
            [
                'nom' => 'Vêtements',
                'description' => 'Achat de vêtements et accessoires personnels.',
            ],
            [
                'nom' => 'Crédit immobilier',
                'description' => 'Remboursement mensuel du prêt immobilier.',
            ],
            [
                'nom' => 'Travaux',
                'description' => 'Dépenses engagées pour des travaux ou améliorations du logement.',
            ],
            [
                'nom' => 'Abonnement',
                'description' => 'Paiement récurrent d’un service numérique ou d’un abonnement.',
            ],
        ];

        $depense = fake()->randomElement($depenses);
        $frequence = fake()->boolean(70);        
        $dateDebut = fake()->dateTimeBetween('2018-01-01', '2030-12-31');
        $dateFin = $frequence ? fake()->dateTimeBetween($dateDebut, '2030-12-31') : null;

        return [
            'nom' => $depense['nom'],
            'description' => $depense['description'],
            'duree' => $frequence ? fake()->randomElement([1, 1, 1, 3, 6, 12]) : null,
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
            'frequence' => $frequence,
            'montant' => fake()->randomFloat(2, 1, 5000),
            'compte_id' => Compte::factory(),
        ];
    }
}
