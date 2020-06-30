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
        if (!\DB::table('users')->where('id', 1)->count()) {
            \DB::table('users')->insert([
                [
                    'id' => 1,
                    'email' => 'admin@gmail.com',
                    'email_verified_at' => '2020-03-23 14:35:38',
                    'created_at' => '2020-03-23 14:35:38',
                    'updated_at' => '2020-03-23 14:35:38',
                    'fullname' => 'I\'m super admin',
                    'password' => Hash::make('admin@123456789'),
                    'gender' => 1,
                    'type' => 1,
                    'tax' => 123456789,
                    'phone' => '0123456789',
                ],
            ]);
        }
    }
}
