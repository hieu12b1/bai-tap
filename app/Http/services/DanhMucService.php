<?php

namespace App\Http\Services;

use App\Models\DanhMuc;
use App\Models\SanPham;
use Exception;
use Illuminate\Support\Facades\Storage;

class DanhMucService
{
    /**
     * Retrieve a list of all DanhMuc records ordered by their status.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(array $searchParams)
    {
        $query = DanhMuc::query()->orderByDesc('trang_thai');

        if (!empty($searchParams['ten_danh_muc'])) {
            $query->where('ten_danh_muc', 'LIKE', '%' . $searchParams['ten_danh_muc'] . '%');
        }

        $perPage = $searchParams['per_page'] ?? DanhMuc::DEFAULT_LIMIT;
        return $query->paginate($perPage);
    }

    /**
     * Store a new DanhMuc record along with an optional image.
     *
     * @param array $data The data to create the DanhMuc record.
     * @param \Illuminate\Http\UploadedFile|null $file The uploaded image file.
     * @return \App\Models\DanhMuc The created DanhMuc record.
     */
    public function store(array $data, $file)
    {
        if ($file) {
            $data['hinh_anh'] = $file->store('uploads/danhmuc', 'public');
        } else {
            $data['hinh_anh'] = null;
        }

        return DanhMuc::query()->create($data);
    }

    /**
     * Update an existing DanhMuc record identified by its ID, along with an optional new image.
     *
     * @param array $data The updated data for the DanhMuc record.
     * @param \Illuminate\Http\UploadedFile|null $file The new uploaded image file.
     * @param int $id The ID of the DanhMuc record to update.
     * @return bool Indicates whether the update was successful.
     * @throws Exception If the DanhMuc record does not exist.
     */
    public function edit(array $data, $file, $id)
    {
        $danhMuc = DanhMuc::query()->findOrFail($id);
        if (!$danhMuc) {
            throw new Exception("danh much does not exist");
        }

        if ($file) {
            if ($danhMuc->hinh_anh) {
                Storage::disk('public')->delete($danhMuc->hinh_anh);
            }

            $data['hinh_anh'] = $file->store('uploads/danhmuc', 'public');
        } else {
            $data['hinh_anh'] = $danhMuc->hinh_anh;
        }

        return $danhMuc->update($data);
    }
}
