<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    const DEFAULT_LIMIT = 10;

    const  Invoice = [
        'paid'      => 'Đã được thanh toán',
        'pending'     => 'Đang chờ xử lý',
        'failed'   => 'Thất bại',
        'completed'      => 'Hoàn thành',
        'cancelled'      => 'Bị hủy',
    ];

    protected $fillable = [
        'invoice_number',
        'user_id',
        'voucher_id',
        'total_amount',
        'discount_amount',
        'status',
        'invoice_date',
        'payment_method',
        'payment_status',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
