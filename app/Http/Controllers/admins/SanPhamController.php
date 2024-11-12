<?php

namespace App\Http\Controllers\admins;

use App\Models\DanhMuc;
use App\Models\SanPham;
use App\Http\Controllers\Controller;
use App\Http\Requests\SanPhamRequest;
use App\Http\Services\SanPhamService;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{

    protected $sanPhamService;
    public function __construct(SanPhamService $sanPhamService)
    {
        $this->sanPhamService = $sanPhamService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $params = [
            'per_page' => $request->input('per_page', SanPham::DEFAULT_LIMIT),
            'ten_san_pham' => $request->input('ten_san_pham'),
            'ma_san_pham' => $request->input('ma_san_pham'),
            'gia_san_pham' => $request->input('gia_san_pham'),
            'gia_khuyen_mai' => $request->input('gia_khuyen_mai'),
            'danh_muc_id' => $request->input('danh_muc_id'),
        ];

        $title = "Thông tin sản phẩm";
        $listSanPham = $this->sanPhamService->index($params);
        $listDanhMuc = DanhMuc::query()->get();
        return view('admins.sanphams.index', compact('title', 'listSanPham', 'listDanhMuc'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm sản phẩm";

        $listDanhMuc = DanhMuc::query()->get();

        return view('admins.sanphams.create', compact('title', 'listDanhMuc'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SanPhamRequest $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->except('_token');
            $this->sanPhamService->store($params, $request);
            return redirect()->route('admin.sanphams.index')->with('success', 'Thêm sản phẩm thành công!');
        }
        ;
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
        $title = "Cập nhật sản phẩm";

        $listDanhMuc = DanhMuc::query()->get();

        $sanPham = SanPham::query()->findOrFail($id);

        return view('admins.sanphams.edit', compact('title', 'listDanhMuc', 'sanPham'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SanPhamRequest $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');
            $this->sanPhamService->edit($params, $request, $id);
            return redirect()->route('admin.sanphams.index')->with('success', 'Cập nhật sản phẩm thành công!');
        }
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->sanPhamService->delete($id);
        return redirect()->route('admin.sanphams.index')->with('success', 'Xóa danh mục thành công!');
    }
}
