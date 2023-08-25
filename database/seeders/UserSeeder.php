<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'name' => 'superadmin',
            'email' => 'superadmin@demo.com',
            'phone' => '01234567890',
            'role_id' => 1,
            'password' => '$2a$12$LTUNSQxGN9M.K4bITfdBc.C6jnDZLM235LBrIs55O0KNrdwEWucLC',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
