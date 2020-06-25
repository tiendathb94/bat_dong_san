<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AddFirstUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!\DB::table('users')->where('id', 1)->get()) {
            \DB::table('users')->insert([
                [
                    'id' => 1,
                    'email' => 'admin@mailinator.com',
                    'email_verified_at' => '2020-03-23 14:35:38',
                    'created_at' => '2020-03-23 14:35:38',
                    'updated_at' => '2020-03-23 14:35:38',
                    'fullname' => 'admin',
                    'password' => Hash::make('admin'),
                    'gender' => 1,
                    'type' => 1,
                    'tax' => 11232131,
                ],
            ]);
        }
    }
}
