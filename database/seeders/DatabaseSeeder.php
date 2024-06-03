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




    }
}
