<?php

namespace App\Console\Commands;

use App\Models\CvTemplate;
use Illuminate\Console\Command;
use Spatie\Browsershot\Browsershot;

class GenerateCVPreviews extends Command
{
    /**
     * Nom de la commande (à taper dans le terminal)
     */
    protected $signature = 'cv:generate-previews';

    /**
     * Description de la commande (affichée dans la liste)
     */
    protected $description = 'Génère des captures d\'écran des templates CV pour la prévisualisation';

    /**
     * Exécution de la commande
     */
    public function handle()
    {
        // 📋 1. Données de test (un CV fictif complet)
        $testData = [
            'personal_info' => [
                'first_name' => 'Jean',
                'last_name' => 'Dupont',
                'photo' => null,
                'birth_date' => '1995-05-15',
                'gender' => 'Homme',
                'email' => 'jean@mail.com',
                'phone' => '+221 77 123 45 67',
                'address' => 'Dakar, Sénégal',
                'title' => 'Développeur Web',
            ],
            'summary' => 'Développeur web passionné par les technologies innovantes avec 3 ans d\'expérience.',
            'educations' => [
                [
                    'degree' => 'Licence Informatique',
                    'school' => 'UCAD',
                    'city' => 'Dakar',
                    'start_date' => '2020-09',
                    'end_date' => '2023-06',
                    'description' => 'Spécialisation en génie logiciel'
                ]
            ],
            'experiences' => [
                [
                    'position' => 'Développeur Laravel',
                    'company' => 'AfriTech',
                    'city' => 'Dakar',
                    'start_date' => '2023-01',
                    'end_date' => '2024-06',
                    'description' => 'Création d\'API REST et maintenance d\'applications web.'
                ]
            ],
            'skills' => [
                ['name' => 'Laravel'],
                ['name' => 'PHP'],
                ['name' => 'MySQL']
            ],
            'languages' => [
                ['language_name' => 'Français', 'language_level' => 'Natif'],
                ['language_name' => 'Anglais', 'language_level' => 'B2']
            ],
            'interests' => [
                ['name' => 'Lecture'],
                ['name' => 'Sport']
            ],
        ];

        // 🔍 2. Récupérer tous les templates actifs depuis la base de données
        $templates = CvTemplate::where('is_active', true)->get();

        // 📁 3. Créer le dossier de destination s'il n'existe pas
        $destination = public_path('images/cv-templates');
        if (!is_dir($destination)) {
            // 📂 Crée le dossier avec les permissions 0755 (lecture/écriture)
            mkdir($destination, 0755, true);
            $this->info("📁 Dossier créé : {$destination}");
        }

        //  4. Boucle sur chaque template pour générer sa preview
        foreach ($templates as $template) {
            $this->info("📸 Génération de l'aperçu pour : {$template->name} ({$template->slug})");

            try {
                // 🖌️ Générer le HTML du template avec les données de test
                $html = view($template->blade_view, ['data' => $testData])->render();

                // 📷 Prendre une capture d'écran avec Browsershot
                $imageData = Browsershot::html($html)
                    ->setNodeBinary('C:/Program Files/nodejs/node.exe')  // Chemin vers Node.js sur Windows
                    ->setNpmBinary('C:/Program Files/nodejs/npm.cmd')   // Chemin vers npm sur Windows
                    ->windowSize(800, 1000)  // Taille de la fenêtre virtuelle (largeur x hauteur en pixels)
                    ->fullPage()             // Capture toute la page (pas juste la partie visible)
                    ->screenshot();          // Génère un PNG (au lieu de PDF)

                // 💾 Nom du fichier : slug du template + .png (ex: modern-blue.png)
                $filename = $template->slug . '.png';
                $filepath = $destination . '/' . $filename;

                // 📥 Sauvegarder l'image sur le disque
                file_put_contents($filepath, $imageData);

                // 🔗 Mettre à jour la base de données avec le nom du fichier
                $template->update(['preview_image' => $filename]);

                // ✅ Afficher un message de succès
                $this->info("   ✅ Succès : {$filename} (" . round(filesize($filepath) / 1024, 2) . " KB)");

            } catch (\Exception $e) {
                // ❌ En cas d'erreur, afficher le message
                $this->error("   ❌ Erreur pour {$template->slug} : " . $e->getMessage());
            }
        }

        // 🎉 Message de fin
        $this->info('✅ Toutes les prévisualisations ont été générées !');
        $this->info("📁 Dossier : " . $destination);
    }
}