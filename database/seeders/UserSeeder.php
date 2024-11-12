<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($i = 1 ; $i<= 5; $i++)
        {
            DB::table('users')->insert(
                [
                    [
                        'name' => 'XziMKTT_09'.$i,
                        'phone' => '09213892',
                        'password' => Hash::make('123456789'),
                        'email' =>  $faker->unique()->safeEmail(),
                        'address' => $i /2 ? 'Hà Nội' : 'Hải Phòng',
                        'role' =>User::ROLE_USER,
                    ],
                ]
            );
        }
    }
}
