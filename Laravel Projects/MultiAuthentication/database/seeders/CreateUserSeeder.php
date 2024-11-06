<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@itsolutionstuff.com',
                'type' => 0,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'manager',
                'email' => 'manager@itsolutionstuff.com',
                'type' => 1,
                'password' => bcrypt('password')
            ],
            [
                'name' => 'user',
                'email' => 'user@itsolutionstuff.com',
                'type' => 2,
                'password' => bcrypt('password')
            ]
        ];


        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
