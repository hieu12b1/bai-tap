<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;
    const DEFAULT_LIMIT = 10;
    
    protected $fillable = [
        'danh_muc_id',
        'ten_san_pham',
        'ma_san_pham',
        'hinh_anh',
        'gia_san_pham',
        'gia_khuyen_mai',
        'mo_ta_ngan',
        'mo_ta',
        'luot_xem',
        'so_luong',
        'CURRENT_DATE',
        'trang_thai',
        'is_new',
        'is_hot',
        'is_hot_deal',
        'is_show_home',
    ];

    protected $casts = [
        'trang_thai' => 'boolean',
        'is_new' => 'boolean',
        'is_hot' => 'boolean',
        'is_hot_deal' => 'boolean',
        'is_show_home' => 'boolean',
    ];

    public function danhMuc()
    {
        return $this->belongsTo(DanhMuc::class);
    }

    
    public function hinhAnhSanPhams()
    {
        return $this->hasMany(HinhAnhSanPham::class);
    }
}
