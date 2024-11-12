<?php

namespace App\Http\Services;

use App\Models\Invoice;
use Exception;

class InvoiceService
{
    /**
     * Retrieve a list of all User records ordered by their status.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(array $searchParams)
    {
        $query = Invoice::query()
            ->join('users', 'invoices.user_id', '=', 'users.id')
            ->select('invoices.*')
            ->orderByDesc('id');

        if (!empty($searchParams['user_name'])) {
            $query->where('users.name', 'LIKE', '%' . $searchParams['user_name'] . '%');
        }

        if (!empty($searchParams['status'])) {
            $query->where('status', 'LIKE', '%' . $searchParams['status'] . '%');
        }

        $perPage = $searchParams['per_page'] ?? Invoice::DEFAULT_LIMIT;
        return $query->paginate($perPage);
    }

    /**
     * Show an existing Invoice record identified by its ID.
     *
     * @param int $id The ID of the Invoice record to update.
     * @throws Exception If the Invoice record does not exist.
     */
    public function show($id)
    {
        $invoice = Invoice::query()->findOrFail($id);
        if (!$invoice) {
            throw new Exception("invoice does not exist");
        }
        return $invoice;
    }

    /**
     * Update an existing invoice record identified by its ID, along with an optional new image.
     *
     * @param array $data The updated data for the invoice record.
     * @param int $id The ID of the invoice record to update.
     * @return bool Indicates whether the update was successful.
     * @throws Exception If the invoice record does not exist.
     */
    public function edit(array $data, $id)
    {
        $invoice = Invoice::query()->findOrFail($id);
        if (!$invoice) {
            throw new Exception("invoice does not exist");
        }

        return $invoice->update($data);
    }
}
