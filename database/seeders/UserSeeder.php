<?php

namespace Database\Seeders;

use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone_number' => '01751311266',
            'address' => 'Mirpur DOHS',
            'password' => Hash::make('password'),
        ])->assignRole('admin');

        User::Create([
            'name' => 'Admin 2',
            'email' => 'admin2@gmail.com',
            'phone_number' => '01751311277',
            'address' => 'Mirpur DOHS',
            'password' => Hash::make('password'),
        ])->assignRole('admin');

        User::Create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'phone_number' => '01751311288',
            'address' => 'Mirpur DOHS',
            'password' => Hash::make('password'),
        ])->assignRole('customer');

        User::Create([
            'name' => 'User 2',
            'email' => 'user2@gmail.com',
            'phone_number' => '01751311299',
            'address' => 'Mirpur DOHS',
            'password' => Hash::make('password'),
        ])->assignRole('customer');
    }
}
