<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class InvoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 1; $i <= 5; $i++) {
            DB::table('invoices')->insert(
                [
                    [
                        'invoice_number' => Str::uuid()->toString(),
                        'user_id' => 1,
                        'voucher_id' => $i % 2 ? 1 : 2,
                        'total_amount' => $i % 2 ? 1122 : 333,
                        'discount_amount' => $i % 2 ? 212 : 32,
                        'status' => $i % 2 ? 'chua_thanh_toan' : 'da_thanh_toan',
                        'invoice_date' => now(),
                        'payment_method' => $i % 2 ? 'MB' : 'VPAY',
                        'payment_status' => $i % 2 ? 'chua_thanh_toan' : 'da_thanh_toan',
                        'notes' => 'app rat chat luong 100d',
                    ],
                ]
            );
        }
    }
}