<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminRTSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => "superadmin@gmail.com"],
            [
                'name' => 'Admin RT',
                'password' => Hash::make('adminrt123'),
                'role' => 'superAdmin',
            ]
        );
    }
}
