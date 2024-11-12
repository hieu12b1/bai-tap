<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\DanhMucRequest;
use App\Models\DanhMuc;
use App\Http\Services\DanhMucService;
use Illuminate\Http\Request;

class DanhMucController extends Controller
{
    protected $danhMucService;
    public function __construct(DanhMucService $danhMucService)
    {
        $this->danhMucService = $danhMucService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Danh mục sản phẩm";
        $params = [
            'per_page' => $request->input('per_page', DanhMuc::DEFAULT_LIMIT),
            'ten_danh_muc' => $request->input('ten_danh_muc'),
        ];
        
        $listDanhMuc = $this->danhMucService->index($params);
        return view('admins.danhmucs.index', compact('title', 'listDanhMuc'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm danh mục sản phẩm";

        return view('admins.danhmucs.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DanhMucRequest $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->except('_token');

            if ($request->hasFile('hinh_anh')) {
                $this->danhMucService->store($params, $request->file('hinh_anh'));
            }
            return redirect()->route('admin.danhmucs.index')->with('success', 'Thêm danh mục thành công!');
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
        $title = "Sửa thông tin danh mục sản phẩm";

        $danhMuc = DanhMuc::query()->findOrFail($id);

        return view('admins.danhmucs.edit', compact('title', 'danhMuc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DanhMucRequest $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');
            $this->danhMucService->edit($params,$request->file('hinh_anh'), $id);
            return redirect()->route('admin.danhmucs.index')->with('success', 'Thêm danh mục thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $response = DanhMuc::query()->findOrFail($id);
        if ($response->san_phams->count() > 0) {
            return redirect()->back()->with('error', 'Danh mục này có sản phẩm liên quan. Vui lòng xóa sản phẩm trước khi xóa danh mục.');
        }
        $response->delete();
        return redirect()->route('admin.danhmucs.index')->with('success', 'Xóa danh mục thành công!');
    }
}
