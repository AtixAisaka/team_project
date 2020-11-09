<?php

use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'name' => 'test',
            'user_id' => '1',
            'created_at' => '2020-11-07 23:06:32',
            'updated_at' => '2020-11-07 23:06:32',
        ]);
        DB::table('tags')->insert([
            'name' => 'test1',
            'user_id' => '1',
            'created_at' => '2020-11-07 23:06:32',
            'updated_at' => '2020-11-07 23:06:32',
        ]);
        DB::table('tags')->insert([
            'name' => 'test2',
            'user_id' => '1',
            'created_at' => '2020-11-07 23:06:32',
            'updated_at' => '2020-11-07 23:06:32',
        ]);
        DB::table('tags')->insert([
            'name' => 'test3',
            'user_id' => '1',
            'created_at' => '2020-11-07 23:06:32',
            'updated_at' => '2020-11-07 23:06:32',
        ]);
    }
}
