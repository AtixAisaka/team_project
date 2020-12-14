<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@scheduletap',
            'password' => '$2y$10$kVzMCzcKaRsv4PddAcy9Je71R9OaItBRDGo1lLn34QzddrqwV0Oky',
            'created_at' => '2020-11-07 23:06:32',
            'updated_at' => '2020-11-07 23:06:32',
            'role' => '4',
        ]);
    }
}
