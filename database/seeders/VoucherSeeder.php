<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($i = 1 ; $i<= 5; $i++)
        {
            DB::table('vouchers')->insert(
                [
                    [
                        'code' => Str::uuid()->toString(),
                        'discount_amount' => 123143,
                        'discount_type' => $i%2 ? 'percentage' : 'fixed',
                        'start_date' =>  now(),
                        'end_date' => now()->addDays(30),
                        'usage_limit' => $i % 2 ? 12 :3,
                        'minimum_order_amount' => 12,
                        'san_pham_id' => $i % 2 ? 2 : 3
                    ],
                ]
            );
        }
    }
}