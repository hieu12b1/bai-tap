<?php

namespace App\Http\Services;

use App\Models\DonHang;
use Exception;
use Illuminate\Support\Facades\Storage;

class DonHangService
{
    /**
     * Retrieve a list of all DonHang records ordered by their status.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(array $searchParams)
    {
        $query = DonHang::query()->orderByDesc('id');

        if (!empty($searchParams['ma_don_hang'])) {
            $query->where('ma_don_hang', 'LIKE', '%' . $searchParams['ma_don_hang'] . '%');
        }

        if (!empty($searchParams['ten_nguoi_nhan'])) {
            $query->where('ten_nguoi_nhan', 'LIKE', '%' . $searchParams['ten_nguoi_nhan'] . '%');
        }

        if (!empty($searchParams['so_dien_thoai_nguoi_nhan'])) {
            $query->where('so_dien_thoai_nguoi_nhan', 'LIKE', '%' . $searchParams['so_dien_thoai_nguoi_nhan'] . '%');
        }

        if (!empty($searchParams['email_nguoi_nhan'])) {
            $query->where('email_nguoi_nhan', 'LIKE', '%' . $searchParams['email_nguoi_nhan'] . '%');
        }

        if (!empty($searchParams['created_at'])) {
            if (strtotime($searchParams['created_at']) !== false) {
                $query->whereDate('created_at', '=', $searchParams['created_at']);
            }
        }

        $perPage = $searchParams['per_page'] ?? DonHang::DEFAULT_LIMIT;
        return $query->paginate($perPage);
    }
}
