<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->delete();

        \DB::table('roles')->insert([
            ['name' => 'super_admin', 'id' => 1],
            ['name' => 'add_news', 'id' => 2],
            ['name' => 'approve_news', 'id' => 3],
            ['name' => 'list_user', 'id' => 4],
        ]);
    }
}
