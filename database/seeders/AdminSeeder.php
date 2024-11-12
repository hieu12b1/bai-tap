<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Admin',
                    'phone' => '',
                    'email' =>  'admin@gmail.com',
                    'password' => Hash::make('admin@gmail.com'),
                    'role' => User::ROLE_ADMIN,
                ],
            ]
        );
    }
}
