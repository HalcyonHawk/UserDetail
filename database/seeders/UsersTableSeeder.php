<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Str;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'prefixname' => 'Mr',
                'firstname' => 'John',
                'middlename' => 'Doe',
                'lastname' => 'Smith',
                'suffixname' => 'Jr',
                'type' => 'user',
                'email' => 'john.doe@example.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password1234'),
                'remember_token' => 'abcd1234efgh5678',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more users here
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
