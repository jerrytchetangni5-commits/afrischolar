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
                'name' => 'Moderne',
                'slug' => 'modern-blue',
                'blade_view' => 'cv.templates.modern-blue',
                'preview_image' => 'modern-blue.png',
                'description' => 'Design moderne avec accents bleus',
                'is_active' => true,
            ],

            [
                'name' => 'Classique',
                'slug' => 'classic',
                'blade_view' => 'cv.templates.classic',
                'preview_image' => 'classic.png',
                'description' => 'Style traditionnel',
                'is_active' => true,
            ],

            [
                'name' => 'Créatif',
                'slug' => 'creative',
                'blade_view' => 'cv.templates.creative',
                'preview_image' => 'creative.png',
                'description' => 'Pour les profils créatifs',
                'is_active' => true,
            ],

            [
                'name' => 'Minimaliste',
                'slug' => 'minimal',
                'blade_view' => 'cv.templates.minimal',
                'preview_image' => 'minimal.png',
                'description' => 'Simple et élégant',
                'is_active' => true,
            ],

            [
                'name' => 'Professionnel',
                'slug' => 'professional',
                'blade_view' => 'cv.templates.professional',
                'preview_image' => 'professional.png',
                'description' => 'Style professionnel',
                'is_active' => true,
            ],

            [
                'name' => 'Élégant',
                'slug' => 'elegant',
                'blade_view' => 'cv.templates.elegant',
                'preview_image' => 'elegant.png',
                'description' => 'Design élégant',
                'is_active' => true,
            ],

            [
                'name' => 'Tech',
                'slug' => 'tech',
                'blade_view' => 'cv.templates.tech',
                'preview_image' => 'tech.png',
                'description' => 'Développeurs et ingénieurs',
                'is_active' => true,
            ],

            [
                'name' => 'Académique',
                'slug' => 'academic',
                'blade_view' => 'cv.templates.academic',
                'preview_image' => 'academic.png',
                'description' => 'Étudiants et chercheurs',
                'is_active' => true,
            ],

            [
                'name' => 'Coloré',
                'slug' => 'colorful',
                'blade_view' => 'cv.templates.colorful',
                'preview_image' => 'colorful.png',
                'description' => 'Design dynamique',
                'is_active' => true,
            ],

            [
                'name' => 'Executive',
                'slug' => 'executive',
                'blade_view' => 'cv.templates.executive',
                'preview_image' => 'executive.png',
                'description' => 'Cadres dirigeants',
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