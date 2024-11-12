<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Illuminate\Http\Request;
use App\Http\Services\DonHangService;

class DonHangController extends Controller
{

    protected $donHangService;
    public function __construct(DonHangService $donHangService)
    {
        $this->donHangService = $donHangService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Thông tin đơn hàng";
        $params = [
            'per_page' => $request->input('per_page', DonHang::DEFAULT_LIMIT),
            'created_at' => $request->input('created_at'),
            'email_nguoi_nhan' => $request->input('email_nguoi_nhan'),
            'so_dien_thoai_nguoi_nhan' => $request->input('so_dien_thoai_nguoi_nhan'),
            'ten_nguoi_nhan' => $request->input('ten_nguoi_nhan'),
            'ma_don_hang' => $request->input('ma_don_hang'),
        ];
        $donHangs = $this->donHangService->index($params);
        $trangThais = DonHang::TRANG_THAI_DON_HANG;

        return view('admins.donhangs.index', compact('title', 'donHangs', 'trangThais'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Thông tin chi tiết đơn hàng";

        $donHang = DonHang::query()->findOrFail($id);
        $trangThaiDonHang = DonHang::TRANG_THAI_DON_HANG;
        $trangThanhToan = DonHang::TRANG_THAI_THANH_TOAN;
        return view('admins.donhangs.show', compact('title', 'donHang', 'trangThaiDonHang', 'trangThanhToan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $donHang = DonHang::findOrFail($id);
        $currentStatus = $donHang->trang_thai_don_hang;
        $newStatus = $request->input('trang_thai_don_hang');

        $statuses = array_keys(DonHang::TRANG_THAI_DON_HANG);
        // Kiểm tra nếu đơn hàng đã bị hủy thì không cho phép thay đổi trạng thái
        if ($currentStatus === 'huy_don_hang') {
            return redirect()->route('admin.donhangs.index')->with('error', 'Đơn hàng đã bị hủy không thể thay đổi trạng thái.');
        }
        // Kiểm tra nếu trạng thái mới không nằm sau trạng thái hiện tại
        if (array_search($newStatus, $statuses) < array_search($currentStatus, $statuses)) {
            return redirect()->route('admin.donhangs.index')->with('error', 'Không thể cập nhật quay lại trạng thái.');
        }
        $donHang->trang_thai_don_hang = $newStatus;
        $donHang->save();
        return redirect()->route('admin.donhangs.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}
