<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert([
            ['role_id' => '2', 'route' => 'pages.user.news'],
            ['role_id' => '3', 'route' => 'pages.user.approve_news'],
            ['role_id' => '3', 'route' => 'news.update_status'],
        ]);
    }
}
