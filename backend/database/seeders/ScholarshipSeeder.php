<?php

namespace Database\Seeders;

use App\Models\Scholarship;
use Illuminate\Database\Seeder;

class ScholarshipSeeder extends Seeder
{
    public function run(): void
    {
        // Tableau contenant plusieurs bourses
        $scholarships = [
            [
                'title' => 'Bourse Eiffel - France',
                'country' => 'France',
                'university' => 'Université Paris-Saclay',
                'field' => 'Informatique',
                'deadline' => '2026-03-15',
                'description' => 'La bourse Eiffel est attribuée aux étudiants internationaux pour des formations en master et doctorat.',
                'benefits' => 'Prise en charge des frais de scolarité, allocation mensuelle de 1 200€',
                'requirements' => 'Excellent dossier académique, projet de recherche cohérent',
                'image' => 'eiffel.jpg',
                'link' => 'https://www.campusfrance.org/fr/bourse-eiffel',
            ],
            [
                'title' => 'Mastercard Foundation Scholars Program',
                'country' => 'Canada',
                'university' => 'University of Toronto',
                'field' => 'Développement durable',
                'deadline' => '2026-04-30',
                'description' => 'Programme destiné aux étudiants africains leaders pour un impact social.',
                'benefits' => 'Bourse complète (frais, logement, livres)',
                'requirements' => 'Engagement communautaire, leadership avéré',
                'image' => null,
                'link' => 'https://mastercardfdn.org/scholars',
            ],
            [
                'title' => 'Bourse DAAD - Allemagne',
                'country' => 'Allemagne',
                'university' => 'Technische Universität Berlin',
                'field' => 'Ingénierie',
                'deadline' => '2026-05-15',
                'description' => 'Le DAAD offre des bourses pour des études supérieures en Allemagne.',
                'benefits' => 'Allocation mensuelle de 850€, assurance maladie',
                'requirements' => 'Diplômé avec 2 ans d\'expérience professionnelle',
                'image' => null,
                'link' => 'https://www.daad.org/en/',
            ],
            [
                'title' => 'Bourse Chevening - Royaume-Uni',
                'country' => 'Royaume-Uni',
                'university' => 'University of Oxford',
                'field' => 'Sciences sociales',
                'deadline' => '2026-06-01',
                'description' => 'Bourse du gouvernement britannique pour les futurs leaders.',
                'benefits' => 'Frais de scolarité, allocation de subsistance, billet d\'avion',
                'requirements' => '3 ans d\'expérience professionnelle, leadership',
                'image' => null,
                'link' => 'https://www.chevening.org/',
            ],
            [
                'title' => 'Bourse Afrique-France',
                'country' => 'France',
                'university' => 'Université Paris 1 Panthéon-Sorbonne',
                'field' => 'Droit',
                'deadline' => '2026-07-01',
                'description' => 'Bourse dédiée aux étudiants africains en Droit.',
                'benefits' => 'Prise en charge à 80% des frais',
                'requirements' => 'Moyenne supérieure à 14/20',
                'image' => null,
                'link' => 'https://exemple.com/afrique-france',
            ],
            [
                'title' => 'Bourse Mandela Rhodes',
                'country' => 'Afrique du Sud',
                'university' => 'University of Cape Town',
                'field' => 'Santé publique',
                'deadline' => '2026-08-15',
                'description' => 'Bourse pour les jeunes africains ayant un potentiel de leadership.',
                'benefits' => 'Frais universitaires, logement, mentorat',
                'requirements' => 'Âge entre 19 et 29 ans, engagement citoyen',
                'image' => null,
                'link' => 'https://www.mandelarhodes.org/',
            ],
        ];

        // Pour chaque bourse, on la crée dans la base de données
        foreach ($scholarships as $scholarship) {
            Scholarship::create($scholarship);
        }

        // Message de confirmation dans le terminal
        $this->command->info('✅ ' . count($scholarships) . ' bourses ajoutées avec succès !');
    }
}