<?php

namespace App\Console\Commands;

use App\Models\CvTemplate;
use Illuminate\Console\Command;
use Spatie\Browsershot\Browsershot;

class GenerateCVPreviews extends Command
{
    protected $signature = 'cv:generate-previews';
    protected $description = 'Génère des captures d\'écran des templates CV pour la prévisualisation';
    public function handle()
    {
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
        $templates = CvTemplate::where('is_active', true)->get();
        $destination = public_path('images/cv-templates');
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
            $this->info("Dossier créé : {$destination}");
        }
        foreach ($templates as $template) {
            $this->info("📸 Génération de l'aperçu pour : {$template->name} ({$template->slug})");
            try {
                $html = view($template->blade_view, ['data' => $testData])->render();
                $imageData = Browsershot::html($html)
                    ->setNodeBinary('C:/Program Files/nodejs/node.exe')
                    ->setNpmBinary('C:/Program Files/nodejs/npm.cmd')
                    ->windowSize(800, 1000)
                    ->fullPage()
                    ->screenshot();
                $filename = $template->slug . '.png';
                $filepath = $destination . '/' . $filename;
                file_put_contents($filepath, $imageData);
                $template->update(['preview_image' => $filename]);
                $this->info("Succès : {$filename} (" . round(filesize($filepath) / 1024, 2) . " KB)");

            } catch (\Exception $e) {
                $this->error("Erreur pour {$template->slug} : " . $e->getMessage());
            }
        }
        $this->info('Toutes les prévisualisations ont été générées !');
        $this->info("Dossier : " . $destination);
    }
}