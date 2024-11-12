<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\DonHang;
use Illuminate\Http\Request;
use App\Http\Services\invoiceService;

class InvoiceController extends Controller
{

    protected $invoiceService;
    public function __construct(invoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Thông tin hóa đơn";
        $params = [
            'per_page' => $request->input('per_page', Invoice::DEFAULT_LIMIT),

            'user_name' => $request->input('user_name'),
            'status' => $request->input('status')
        ];
        $invoices = DonHang::TRANG_THAI_THANH_TOAN;
        $listInvoice = $this->invoiceService->index($params);
        return view('admins.invoices.index', compact('title', 'listInvoice', 'invoices'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Thông tin chi tiết hóa đơn";

        $invoice = $this->invoiceService->show($id);
        $invoices = DonHang::TRANG_THAI_THANH_TOAN;
        return view('admins.invoices.show', compact('title', 'invoice', 'invoices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->invoiceService->edit($request->all(), $id);
        return redirect()->route('admin.invoices.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}
