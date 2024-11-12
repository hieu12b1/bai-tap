<?php

namespace App\Http\Services;

use App\Models\SanPham;
use App\Models\HinhAnhSanPham;
use Exception;
use Illuminate\Support\Facades\Storage;

class SanPhamService
{
    /**
     * Retrieve a list of all SanPham records ordered by their status.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(array $searchParams)
    {
        $query = SanPham::query()->orderByDesc('trang_thai');

        if (!empty($searchParams['ten_san_pham'])) {
            $query->where('ten_san_pham', 'LIKE', '%' . $searchParams['ten_san_pham'] . '%');
        }

        if (!empty($searchParams['ma_san_pham'])) {
            $query->where('ma_san_pham', 'LIKE', '%' . $searchParams['ma_san_pham'] . '%');
        }

        if (!empty($searchParams['danh_muc_id'])) {
            $query->where('danh_muc_id', '=', $searchParams['danh_muc_id']);
        }

        if (!empty($searchParams['gia_san_pham'])) {
            if (is_numeric($searchParams['gia_san_pham'])) {
                $query->where('gia_san_pham', '=', (float)$searchParams['gia_san_pham']);
            }
        }

        if (!empty($searchParams['gia_khuyen_mai'])) {
            if (is_numeric($searchParams['gia_khuyen_mai'])) {
                $query->where('gia_khuyen_mai', '=', (float)$searchParams['gia_khuyen_mai']);
            }
        }

        $perPage = $searchParams['per_page'] ?? SanPham::DEFAULT_LIMIT;

        return $query->paginate($perPage);
    }

    /**
     * Store a new SanPham record along with an optional image.
     *
     * @param array $data The data to create the SanPham record.
     * @param \Illuminate\Http\UploadedFile|null $file The uploaded image file.
     * @return \App\Models\SanPham The created SanPham record.
     */
    public function store(array $data, $request)
    {
        // Chuyển đổi giá trị checkbox thành boolean
        $data['is_new'] = $request->has('is_new') ? 1 : 0;
        $data['is_hot'] = $request->has('is_hot') ? 1 : 0;
        $data['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
        $data['is_show_home'] = $request->has('is_show_home') ? 1 : 0;
        // chuyển đổi giá trị sang int
        $data['danh_muc_id'] = (int) $request->danh_muc_id;

        // check upload file
        if ($request->hasFile('hinh_anh')) {
            $data['hinh_anh'] = $request->file('hinh_anh')->store('uploads/sanpham', 'public');
        } else {
            $data['hinh_anh'] = null;
        }

        // save data san pham database 
        $newData = SanPham::query()->create($data);

        if ($request->has('list_hinh_anh')) {
            foreach ($request->file('list_hinh_anh') as $hinhAnh) {
                if ($hinhAnh) {
                    $path = $hinhAnh->store('uploads/hinhanhsanpham/id_' . $newData->id, 'public');
                    // save data hinh anh san pham database 
                    HinhAnhSanPham::query()->create([
                        'san_pham_id' => $newData->id,
                        'hinh_anh' => $path,
                    ]);
                }
            }
        }

        return $newData;
    }

    /**
     * Update an existing SanPham record identified by its ID, along with an optional new image.
     *
     * @param array $data The updated data for the SanPham record.
     * @param \Illuminate\Http\UploadedFile|null $file The new uploaded image file.
     * @param int $id The ID of the SanPham record to update.
     * @return bool Indicates whether the update was successful.
     * @throws Exception If the SanPham record does not exist.
     */
    public function edit(array $data, $request, $id)
    {
        $sanPham = SanPham::query()->findOrFail($id);
        if (!$sanPham) {
            throw new Exception("san pham does not exist");
        }

        $data['is_new'] = $request->has('is_new') ? 1 : 0;
        $data['is_hot'] = $request->has('is_hot') ? 1 : 0;
        $data['is_hot_deal'] = $request->has('is_hot_deal') ? 1 : 0;
        $data['is_show_home'] = $request->has('is_show_home') ? 1 : 0;
        $data['danh_muc_id'] = (int) $request->danh_muc_id;

        if ($request->hasFile('hinh_anh')) {
            if ($sanPham->hinh_anh && Storage::disk('public')->exists($sanPham->hinh_anh)) {
                Storage::disk('public')->delete($sanPham->hinh_anh);
            }
            $data['hinh_anh'] = $request->file('hinh_anh')->store('uploads/sanpham', 'public');
        } else {
            $data['hinh_anh'] = $sanPham->hinh_anh;
        }

        $currentImages = $sanPham->hinhAnhSanPhams->pluck('id')->toArray();
        $arrayCombine = array_combine($currentImages, $currentImages);

        foreach ($arrayCombine as $key => $value) {
            if (!array_key_exists($key, $request->list_hinh_anh)) {
                $hinhAnhSanPham = HinhAnhSanPham::find($key);
                if ($hinhAnhSanPham && Storage::disk('public')->exists($hinhAnhSanPham->hinh_anh)) {
                    Storage::disk('public')->delete($hinhAnhSanPham->hinh_anh);
                    $hinhAnhSanPham->delete();
                }
            }
        }
        if ($request->has('list_hinh_anh')) {
            foreach ($request->list_hinh_anh as $key => $hinhAnh) {
                if (!array_key_exists($key, $arrayCombine)) {
                    if ($request->hasFile("list_hinh_anh.$key")) {
                        $path = $hinhAnh->store('uploads/hinhanhsanpham/id_' . $id, 'public');
                        $sanPham->hinhAnhSanPhams()->create([
                            'san_pham_id' => $id,
                            'hinh_anh' => $path,
                        ]);
                    }
                } elseif (is_file($hinhAnh) && $request->hasFile("list_hinh_anh.$key")) {
                    $hinhAnhSanPham = HinhAnhSanPham::find($key);
                    if ($hinhAnhSanPham && Storage::disk('public')->exists($hinhAnhSanPham->hinh_anh)) {
                        Storage::disk('public')->delete($hinhAnhSanPham->hinh_anh);
                    }
                    $path = $hinhAnh->store('uploads/hinhanhsanpham/id_' . $id, 'public');
                    $hinhAnhSanPham->update([
                        'hinh_anh' => $path,
                    ]);
                }
            }
        }

        return $sanPham->update($data);
    }

    /**
     * Delete an existing SanPham record identified by its ID, including the associated image.
     *
     * @param int $id The ID of the SanPham record to delete.
     * @return bool Indicates whether the deletion was successful.
     * @throws Exception If the SanPham record does not exist.
     */
    public function delete($id)
    {
        $sanPham = SanPham::query()->findOrFail($id);
        if (!$sanPham) {
            throw new Exception("San pham does not exist");
        }

        if ($sanPham->hinh_anh && Storage::disk('public')->exists($sanPham->hinh_anh)) {
            Storage::disk('public')->delete($sanPham->hinh_anh);
        }
        $sanPham->hinhAnhSanPhams()->delete();

        $hinhAnhFolder = 'uploads/hinhanhsanpham/id_' . $id;
        if (Storage::disk('public')->exists($hinhAnhFolder)) {
            Storage::disk('public')->deleteDirectory($hinhAnhFolder);
        }

        return $sanPham->delete();
    }
}
