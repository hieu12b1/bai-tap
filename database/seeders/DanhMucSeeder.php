<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\DanhMuc;
use Illuminate\Support\Facades\DB;

class DanhMucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1 ; $i<= 2; $i++)
        {
            DB::table('danh_mucs')->insert(
                [
                    [
                        'ten_danh_muc' => 'Danh mục'.$i,
                        'hinh_anh' => 'https://picsum.photos/200',
                        'trang_thai' =>  1,
                    ],
                ]
            );
        }
    }
}
