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
        DB::table('Employes')->insert([
            [
                'nom'      => 'Ahmed',
                'prenom'         => 'Mohamed val',
                'tel'      => '22303022',
                'adress'    => 'nktt',
				'diplome'          => 'grh master',
                'specialite' => 'GRH',
                'dep_id' => 2,
                'id'=>2
            ],
        ]);
        DB::table('RRH')->insert([
            [
                'employe_id'=>1
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
                'prenom'         => 'salih',
                'tel'      => '22333022',
                'adress'    =>'nktt',
                'id'=>3
            ],
        ]);

        





    }
}
