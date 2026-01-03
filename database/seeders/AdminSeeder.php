<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::UpdateOrCreate(
            [
                'username' => 'admin'
            ],
            [
                'name' => 'Administrator',
                'password' => Hash::make('Smknusantara1!'),
                'level' => 1
            ]
            );
    }
}
