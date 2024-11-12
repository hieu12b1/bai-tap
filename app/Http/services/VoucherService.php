<?php

namespace App\Http\Services;

use App\Models\Voucher;
use Exception;
use Illuminate\Support\Str;

class VoucherService
{
    /**
     * Retrieve a list of all User records ordered by their status.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(array $searchParams)
    {
        $query = Voucher::query()->orderByDesc('id');

        if (!empty($searchParams['code'])) {
            $query->where('code', 'LIKE', '%' . $searchParams['code'] . '%');
        }

        if (!empty($searchParams['end_date'])) {
            if (strtotime($searchParams['end_date']) !== false) {
                $query->whereDate('end_date', '=', $searchParams['end_date']);
            }
        }

        if (!empty($searchParams['start_date'])) {
            if (strtotime($searchParams['start_date']) !== false) {
                $query->whereDate('start_date', '=', $searchParams['start_date']);
            }
        }

        $perPage = $searchParams['per_page'] ?? Voucher::DEFAULT_LIMIT;
        return $query->paginate($perPage);
    }

    /**
     * Show an existing Voucher record identified by its ID.
     *
     * @param int $id The ID of the Voucher record to update.
     * @throws Exception If the Voucher record does not exist.
     */
    public function show($id)
    {
        $voucher = Voucher::query()->findOrFail($id);
        if (!$voucher) {
            throw new Exception("voucher does not exist");
        }
        return $voucher;
    }

    /**
     * Store a new voucher record along with an optional image.
     *
     * @param array $data The data to create the SanPham record.
     * @return \App\Models\Voucher The created SanPham record.
     */
    public function store(array $data, $request)
    {
        if ((int)$request['count_voucher'] > 0) {
            for ($i = 1; $i <= (int) $request['count_voucher']; $i++) {
                    $data['code'] = $this->generateCodeString();
                    $data['discount_amount'] = floatval($request['discount_amount']);
                    $data['discount_type'] = $request['discount_type'];
                    $data['start_date'] = $request['start_date'];
                    $data['end_date'] = $request['end_date'];
                    $data['usage_limit'] = (int) $request['usage_limit'];
                    $data['minimum_order_amount'] = (int) $request['minimum_order_amount'];
                    $data['san_pham_id'] = (int) $request['san_pham_id'];
                    Voucher::query()->create($data);
            }
        }
    }

    /**
     * Update an existing Voucher record identified by its ID, along with an optional new image.
     *
     * @param array $data The updated data for the Voucher record.
     * @param int $id The ID of the Voucher record to update.
     * @return bool Indicates whether the update was successful.
     * @throws Exception If the Voucher record does not exist.
     */
    public function edit(array $data, $id)
    {
        $voucher = Voucher::query()->findOrFail($id);
        if (!$voucher) {
            throw new Exception("voucher does not exist");
        }

        return $voucher->update($data);
    }

    /**
     * Delete an existing DanhMuc record identified by its ID, including the associated image.
     *
     * @param int $id The ID of the DanhMuc record to delete.
     * @return bool Indicates whether the deletion was successful.
     * @throws Exception If the DanhMuc record does not exist.
     */
    public function delete($id)
    {
        $voucher = Voucher::query()->findOrFail($id);
        if (!$voucher) {
            throw new Exception("voucher does not exist");
        }

        return $voucher->delete();
    }

    /**
     * Generate string type UUID
     */
    public function generateCodeString()
    {
        return Str::uuid()->toString();
    }
}
