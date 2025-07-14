<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
['email' => 'dara@example.com'],
            [
                'name' => 'Dara ',
                'password' => Hash::make('dara123'),
                'role' => 'user',
            ]
        );
    }
}

