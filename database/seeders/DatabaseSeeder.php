<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('users')->insert([
            [
                'username'      => 'admin',
                'email'         => 'admin@gmail.com',
                'password'      => bcrypt('12345678'),
                'created_at'    => date("Y-m-d H:i:s"),
				'role'          => 'admin',
                'permission_status' => 'active'
            ],
        ]);
        DB::table('Departements')->insert([
            [
                'nom'      => 'R&D',
                'created_at'    => date("Y-m-d H:i:s"),
            ],
            [
                'nom'      => 'RH',
                'created_at'    => date("Y-m-d H:i:s"),
            ],
            [
                'nom'      => 'Comptabilité et Finances',
                'created_at'    => date("Y-m-d H:i:s"),
            ],
            [
                'nom'      => 'Gestion de Projet',
                'created_at'    => date("Y-m-d H:i:s"),
            ],
            [
                'nom'      => 'Développement Logiciel',
                'created_at'    => date("Y-m-d H:i:s"),
            ],
        ]);

        DB::table('users')->insert([
            [
                'username'      => 'RRH',
                'email'         => 'RRH@gmail.com',
                'password'      => bcrypt('12345678'),
                'created_at'    => date("Y-m-d H:i:s"),
				'role'          => 'RRH',
                'permission_status' => 'active'
            ],
        ]);
        DB::table('users')->insert([
            [
                'username'      => 'DG',
                'email'         => 'DG@gmail.com',
                'password'      => bcrypt('12345678'),
                'created_at'    => date("Y-m-d H:i:s"),
				'role'          => 'DG',
                'permission_status' => 'active'
            ],
        ]);
        DB::table('DG')->insert([
            [
                'nom'      => 'mohamed',
                'prenom'         => 'vadil',
                'tel'      => '22333022',
                'adress'    =>'nktt',
                'user_id'=>3
            ],
        ]);
        DB::table('Contrats')->insert([
            [
                'contenu'      => "Contrat de Travail - Responsable des Ressources Humaines

                1. Parties au Contrat
                
                Employeur: Entreprise XYZ, Rue des Entreprises, Nouakchott, Mauritanie
                Employé(e): Ahmed Mohamed Vall, Rue des Résidents, Nouakchott, Mauritanie
                2. Poste et Missions
                
                Titre du Poste: Responsable des Ressources Humaines
                Missions:
                Gestion du recrutement et de l'intégration des nouveaux employés
                Administration de la paie et des avantages sociaux
                Gestion des relations du travail et résolution des conflits
                Élaboration et mise en œuvre des politiques RH
                Formation et développement des employés
                Suivi de la performance et gestion des évaluations
                3. Durée du Contrat
                
                Type de Contrat: CDI
                Date de Début: 01/06/2015
                4. Rémunération et Avantages
                
                Salaire Mensuel: 200 000 MRO
                Avantages: Assurance santé, tickets restaurant, transport fourni
                5. Horaires de Travail
                
                Jours et Heures de Travail: Lundi à Vendredi, de 9h00 à 17h00
                Possibilité d'Heures Supplémentaires: Oui
                6. Lieu de Travail
                
                Adresse du Lieu de Travail: Siège de l'Entreprise XYZ, Rue des Entreprises, Nouakchott
                7. Période d'Essai
                
                Durée de la Période d'Essai: 3 mois
                8. Confidentialité et Non-Compétition
                
                Clause de Confidentialité: L'employé(e) s'engage à garder confidentielles toutes les informations sensibles de l'entreprise.
                Clause de Non-Compétition: L'employé(e) s'engage à ne pas travailler pour un concurrent pendant une durée de 6 mois après la fin du contrat.
                9. Résiliation du Contrat
                
                Préavis: 1 mois
                Motifs de Résiliation: Non-respect des termes du contrat, faute grave, etc.
                10. Divers
                
                Formation Continue: Possibilités de formation et développement professionnel.
                Évaluation: Processus et fréquence des évaluations de performance.
                Signatures
                
                Mohamed Vadil, Directeur
                [01/06/2015]
                
                Ahmed Mohamed Vall, Responsable des Ressources Humaines
                [01/06/2015]",
                'dg_id'=>1
            ],
        ]);
        DB::table('Employes')->insert([
            [
                'nom'      => 'Ahmed',
                'prenom'         => 'Mohamed val',
                'tel'      => '22303022',
                'adress'    => 'nktt',
				'diplome'          => 'grh master',
                'specialite' => 'GRH',
                'dep_id' => 2,
                'user_id'=>2,
                'contrat_id'=>1,
                'img_profit' => 'img/1.jpg'
            ],
        ]);
        DB::table('RRH')->insert([
            [
                'employe_id'=>1
            ],
        ]);

        
       

        





    }
}
