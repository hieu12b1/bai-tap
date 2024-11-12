<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Models\SanPham;
use App\Http\Services\VoucherService;
use Illuminate\Http\Request;
use App\Http\Requests\VoucherRequest;

class VoucherController extends Controller
{
    protected $voucherService;
    public function __construct(VoucherService $voucherService)
    {
        $this->voucherService = $voucherService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Mã giảm giá sản phẩm";
        $params = [
            'per_page' => $request->input('per_page', Voucher::DEFAULT_LIMIT),
            'code' => $request->input('code'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date')
        ];
        
        $listVoucher = $this->voucherService->index($params);
        return view('admins.vouchers.index', compact('title', 'listVoucher'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm mã giảm giá sản phẩm";

        $data = [
            'discount_types' => [
                ['id' => 'percentage', 'name' => 'Giảm giá theo phần trăm'],
                ['id' => 'fixed', 'name' => 'Giảm giá cố định'],
            ],
            'products' => SanPham::all(),
        ];

        return view('admins.vouchers.create', compact('title', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VoucherRequest $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->except('_token');
            $this->voucherService->store($params, $request->all());
            return redirect()->route('admin.vouchers.index')->with('success', 'Thêm mã giảm giá thành công!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Sửa thông tin mã sản phẩm sản phẩm";

        $voucher = $this->voucherService->show($id);
        $data = [
            'discount_types' => [
                ['id' => 'percentage', 'name' => 'Giảm giá theo phần trăm'],
                ['id' => 'fixed', 'name' => 'Giảm giá cố định'],
            ],
            'products' => SanPham::all(),
        ];
        return view('admins.vouchers.edit', compact('title', 'voucher', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VoucherRequest $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');
            $this->voucherService->edit($params, $id);
            return redirect()->route('admin.vouchers.index')->with('success', 'Chỉnh sửa mã giảm giá thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->voucherService->delete($id);
        return redirect()->route('admin.vouchers.index')->with('success', 'Xóa mã giảm giá thành công!');
    }
}
