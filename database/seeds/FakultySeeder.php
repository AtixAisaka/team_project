<?php

use Illuminate\Database\Seeder;

class FakultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fakulty')->insert([
            'name' => 'Fakulta prírodných vied',
            'created_at' => '2020-11-07 23:06:32',
            'updated_at' => '2020-11-07 23:06:32',
        ]);
        DB::table('fakulty')->insert([
            'name' => 'Fakulta sociálnych vied a zdravotníctva',
            'created_at' => '2020-11-07 23:06:32',
            'updated_at' => '2020-11-07 23:06:32',
        ]);
        DB::table('fakulty')->insert([
            'name' => 'Fakulta stredoeurópskych štúdií',
            'created_at' => '2020-11-07 23:06:32',
            'updated_at' => '2020-11-07 23:06:32',
        ]);
        DB::table('fakulty')->insert([
            'name' => 'Filozofická fakulta',
            'created_at' => '2020-11-07 23:06:32',
            'updated_at' => '2020-11-07 23:06:32',
        ]);
        DB::table('fakulty')->insert([
            'name' => 'Pedagogická fakulta',
            'created_at' => '2020-11-07 23:06:32',
            'updated_at' => '2020-11-07 23:06:32',
        ]);
    }
}
