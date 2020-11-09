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
            'name' => 'test',
            'email' => 'test@mail.test',
            'password' => '$2y$10$/D.nVUJgkvqCxkSqNiGcuObsvx/CPc81VSDQ3x/nFWBoCRhtlvT/S',
            'created_at' => '2020-11-07 23:06:32',
            'updated_at' => '2020-11-07 23:06:32',
            'role' => '0',
        ]);
    }
}
