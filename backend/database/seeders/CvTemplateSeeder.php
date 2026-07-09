<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CvTemplate;

class CvTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [

            [
                'name' => 'Vintage',
                'slug' => 'vintage',
                'blade_view' => 'cv.templates.vintage',
                'preview_image' => 'vintage.png',
                'description' => 'Style rétro avec tons terre et élégance intemporelle',
                'is_active' => true,
            ],

            [
                'name' => 'Premium',
                'slug' => 'premium',
                'blade_view' => 'cv.templates.premium',
                'preview_image' => 'premium.png',
                'description' => 'Design moderne et épuré, idéal pour les profils professionnels',
                'is_active' => true,
            ],

            [
                'name' => 'Luxury',
                'slug' => 'luxury',
                'blade_view' => 'cv.templates.luxury',
                'preview_image' => 'luxury.png',
                'description' => 'Design sombre et élégant avec accents dorés, idéal pour les profils prestigieux',
                'is_active' => true,
            ],            

            [
                'name' => 'Terracotta',
                'slug' => 'terracotta',
                'blade_view' => 'cv.templates.terracotta',
                'preview_image' => 'terracotta.png',
                'description' => 'Design chaleureux aux tons terre cuite et élégance intemporelle',
                'is_active' => true,
            ],

            [
                'name' => 'Minimal',
                'slug' => 'minimal',
                'blade_view' => 'cv.templates.minimal',
                'preview_image' => 'minimal.png',
                'description' => 'Design épuré et minimaliste en tons gris',
                'is_active' => true,
            ],

        ];

        foreach ($templates as $template) {
            CvTemplate::updateOrCreate([
                'slug' => $template['slug']
            ], $template);
        }
    }
}