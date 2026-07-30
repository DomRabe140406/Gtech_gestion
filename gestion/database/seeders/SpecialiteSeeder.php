<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialite;

class SpecialiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    //les seeder permettent de remplir la base de données avec des données initiales ou de test.
    //Dans ce cas, le seeder SpecialiteSeeder est utilisé pour insérer des spécialités dans la table "specialites" de la base de données.
    public function run(): void
    {
        Specialite::insert([

            [
                'nom_specialite' => 'Développement Web',
            ],

            [
                'nom_specialite' => 'Développement Python et Intelligence Artificielle',
            ],

            [
                'nom_specialite' => 'Réseaux informatiques et Cybersécurité',
            ],

            [
                'nom_specialite' => 'Robotique',
            ],

            [
                'nom_specialite' => 'UI/UX Design',
            ],

            [
                'nom_specialite' => 'Call Center',
            ],

        ]);
    }
}
