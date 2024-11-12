@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lý danh mục sản phẩm</h4>
                </div>
            </div>

            <!-- General Form -->
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">{{ $title }}</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <form action="{{ route('admin.danhmucs.update', $danhMuc->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                @method('PUT')

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="ten_danh_muc" class="form-label">Tên danh mục</label>
                                            <input type="text" id="ten_danh_muc" name="ten_danh_muc"
                                                class="form-control @error('ten_danh_muc') is-invalid @enderror"
                                                value="{{ $danhMuc->ten_danh_muc }}"
                                                placeholder="Tên danh mục">
                                            @error('ten_danh_muc')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="trang_thai" class="form-label">Trang thái</label>
                                            <div class="col-sm-10 d-flex gap-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="trang_thai"
                                                        id="trang_thai_1" value="1" {{ $danhMuc->trang_thai == true ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="trang_thai_1">
                                                        Hiển thị
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="trang_thai"
                                                        id="trang_thai_2" value="0" {{ $danhMuc->trang_thai == false ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="trang_thai_2">
                                                        Ẩn
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="hinh_anh" class="form-label">Hình ảnh</label>
                                            <input class="form-control" type="file" id="hinh_anh" name="hinh_anh"
                                                onchange="showImage(event)">
                                        </div>
                                            @php
                                            $imageUrl = $danhMuc->hinh_anh;
                                            @endphp
                                            @if (filter_var($imageUrl, FILTER_VALIDATE_URL) && (strpos($imageUrl, 'http://') === 0 || strpos($imageUrl, 'https://') === 0))
                                            <img src="{{ $imageUrl }}" width="150px" alt="Hình ảnh danh mục sản phẩm">
                                            @else
                                            <img id="img_danh_muc" src="{{ Storage::url($danhMuc->hinh_anh) }}" alt="Hình ảnh danh mục"
                                            style="width: 150px">
                                            @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div> <!-- content -->
@endsection

@section('js')
    <script>
        function showImage(event) {
            const img_product = document.getElementById('img_danh_muc');

            const file = event.target.files[0];

            const reader = new FileReader();

            reader.onload = function() {
                img_product.src = reader.result;
                img_product.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
