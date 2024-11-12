<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    const DEFAULT_LIMIT = 10;

    const VOUCHER_TYPE_PERCENTAGE = 'percentage';
    const VOUCHER_TYPE_FIXED = 'fixed';

    protected $fillable = [
        'code',
        'discount_amount',
        'discount_type',
        'usage_limit',
        'start_date',
        'end_date',
        'minimum_order_amount',
        'san_pham_id'
    ];

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class);
    }
}
