<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 1; $i <= 10; $i++) {
            DB::table('san_phams')->insert(
                [
                    [
                        'danh_muc_id' => $i%2 ? 1 : 2,
                        'ten_san_pham' => 'Iphone 1'.$i,
                        'ma_san_pham' => Str::uuid()->toString(),
                        'hinh_anh' => 'https://picsum.photos/200',
                        'gia_san_pham' => 1244432130,
                        'gia_khuyen_mai' => $i%2 ? 1231412 : 0,
                    ]
                ]
            );
        }
    }
}
