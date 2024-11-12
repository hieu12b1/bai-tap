@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('css')
    <!-- Quill css -->
    <link href="{{ asset('assets/admins/libs/quill/quill.core.js') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admins/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admins/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Quản lý sản phẩm</h4>
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
                            <form action="{{ route('admin.sanphams.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="ma_san_pham" class="form-label">Mã sản phẩm</label>
                                            <input type="text" id="ma_san_pham" name="ma_san_pham"
                                                class="form-control @error('ma_san_pham') is-invalid @enderror"
                                                value="{{ old('ma_san_pham') }}" placeholder="Mã sản phẩm">
                                            @error('ma_san_pham')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="ten_san_pham" class="form-label">Tên sản phẩm</label>
                                            <input type="text" id="ten_san_pham" name="ten_san_pham"
                                                class="form-control @error('ten_san_pham') is-invalid @enderror"
                                                value="{{ old('ten_san_pham') }}" placeholder="Tên sản phẩm">
                                            @error('ten_san_pham')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="gia_san_pham" class="form-label">Giá sản phẩm</label>
                                            <input type="number" id="gia_san_pham" name="gia_san_pham"
                                                class="form-control @error('gia_san_pham') is-invalid @enderror"
                                                value="{{ old('gia_san_pham') }}" placeholder="Giá sản phẩm">
                                            @error('gia_san_pham')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="gia_khuyen_mai" class="form-label">Giá khuyến mãi</label>
                                            <input type="number" id="gia_khuyen_mai" name="gia_khuyen_mai"
                                                class="form-control @error('gia_khuyen_mai') is-invalid @enderror"
                                                value="{{ old('gia_khuyen_mai') }}" placeholder="Giá khuyến mãi">
                                            @error('gia_khuyen_mai')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="danh_muc_id" class="form-label">Danh mục sản phẩm</label>
                                            <select name="danh_muc_id"
                                                class="form-select @error('danh_muc_id') is-invalid @enderror">
                                                <option selected>Chọn danh mục</option>
                                                @foreach ($listDanhMuc as $danhMuc)
                                                    <option value="{{ $danhMuc->id }}"
                                                        {{ old('danh_muc_id') == $danhMuc->id ? 'selected' : '' }}>
                                                        {{ $danhMuc->ten_danh_muc }}</option>
                                                @endforeach
                                            </select>
                                            @error('danh_muc_id')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="so_luong" class="form-label">Số lượng</label>
                                            <input type="number" id="so_luong" name="so_luong"
                                                class="form-control @error('so_luong') is-invalid @enderror"
                                                value="{{ old('so_luong') }}" placeholder="Số lượng">
                                            @error('so_luong')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="ngay_nhap" class="form-label">Ngày nhập</label>
                                            <input type="date" id="ngay_nhap" name="ngay_nhap"
                                                class="form-control @error('ngay_nhap') is-invalid @enderror"
                                                value="{{ old('ngay_nhap') }}">
                                            @error('ngay_nhap')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="mo_ta_ngan" class="form-label">Mô tả ngắn</label>
                                            <textarea name="mo_ta_ngan" id="mo_ta_ngan" rows="4"
                                                class="form-control @error('mo_ta_ngan') is-invalid @enderror" placeholder="Mô tả ngắn">{{ old('mo_ta_ngan') }}</textarea>
                                            @error('mo_ta_ngan')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="trang_thai" class="form-label">Trang thái</label>
                                            <div class="col-sm-10 d-flex gap-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="trang_thai"
                                                        id="trang_thai_1" value="1" checked>
                                                    <label class="form-check-label text-success" for="trang_thai_1">
                                                        Hiển thị
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="trang_thai"
                                                        id="trang_thai_2" value="0">
                                                    <label class="form-check-label text-danger" for="trang_thai_2">
                                                        Ẩn
                                                    </label>
                                                </div>
                                            </div>
                                            @error('trang_thai')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-switch mb-3 ps-3 d-flex justify-content-between">
                                            <div class="form-check">
                                                <label class="form-check-label" for="is_new">New</label>
                                                <input class="form-check-input bg-danger" type="checkbox" id="is_new"
                                                    name="is_new" checked>
                                            </div>

                                            <div class="form-check">
                                                <label class="form-check-label" for="is_hot">Hot</label>
                                                <input class="form-check-input bg-warning" type="checkbox" id="is_hot"
                                                    name="is_hot" checked>
                                            </div>

                                            <div class="form-check">
                                                <label class="form-check-label" for="is_hot_deal">Hot deal</label>
                                                <input class="form-check-input bg-secondary" type="checkbox"
                                                    id="is_hot_deal" name="is_hot_deal" checked>
                                            </div>

                                            <div class="form-check">
                                                <label class="form-check-label" for="is_show_home">Show home</label>
                                                <input class="form-check-input bg-success" type="checkbox"
                                                    id="is_show_home" name="is_show_home" checked>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="col-lg-8">
                                        <div class="mb-3">
                                            <label for="mo_ta" class="form-label">Mô tả chi tiết</label>
                                            <div id="quill-editor" style="height: 340px;">
                                                <h2>Mô tả chi tiết sản phẩm</h2>
                                            </div>
                                            <textarea id="editor-content" name="mo_ta" style="display: none;"></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="hinh_anh" class="form-label">Hình ảnh</label>
                                            <input class="form-control" type="file" id="hinh_anh" name="hinh_anh"
                                                onchange="showImage(event)">
                                            @error('hinh_anh')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                            <img id="img_san_pham" src="" alt="Hình ảnh danh mục"
                                                style="width: 150px; display: none">
                                        </div>

                                        <div class="mb-3">
                                            <label for="mo_ta" class="form-label">Danh sách hình ảnh</label>
                                            {{-- Nút thêm hình ảnh --}}
                                            <i id="add-row"
                                                class="mdi mdi-plus text-muted fs-18 rounded-2 border p-1 ms-3"
                                                style="cursor: pointer"></i>
                                            {{-- Bảng danh sách hình ảnh --}}
                                            <table class="table align-middle table-nowrap mb-0">
                                                <tbody id="image-table-body">
                                                    <tr>
                                                        <td class="d-flex align-items-center">
                                                            <div class="me-3">
                                                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0Wr3oWsq6KobkPqznhl09Wum9ujEihaUT4Q&s"
                                                                    alt="Hình ảnh" id="preview_0" style="width: 50px;">
                                                            </div>
                                                            <div class="w-100">
                                                                <input class="form-control" type="file"
                                                                    name="list_hinh_anh[id_0]"
                                                                    onchange="previewImage(this, 0)">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <i class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1 ms-3"
                                                                style="cursor: pointer"></i>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>


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
    <!-- Quill Editor Js -->
    <script src="{{ asset('assets/admins/libs/quill/quill.core.js') }}"></script>
    <script src="{{ asset('assets/admins/libs/quill/quill.min.js') }}"></script>

    {{-- Hàm xử lý nhập mô tả chi tiết --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Khởi tạo Quill editor
            var quill = new Quill('#quill-editor', {
                theme: 'snow'
            });

            // Hiển thị nội dung cũ (nếu có)
            var content = `{!! old('mo_ta') !!}`;
            quill.root.innerHTML = content;

            // Cập nhật textarea ẩn khi nội dung Quill editor thay đổi
            quill.on('text-change', function() {
                var html = quill.root.innerHTML;
                document.getElementById('editor-content').value = html;
            });
        });
    </script>

    {{-- Hàm hiển thị hình ảnh thumbnail --}}
    <script>
        function showImage(event) {
            const img_product = document.getElementById('img_san_pham');

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

<script>
        // Hàm để thêm hình ảnh album
        document.addEventListener('DOMContentLoaded', function() {
            var rowCount = 1;

            document.getElementById('add-row').addEventListener('click', function() {
                var tableBody = document.getElementById('image-table-body');

                var newRow = document.createElement('tr');
                newRow.innerHTML = `
                <td class="d-flex align-items-center">
                    <div class="me-3">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0Wr3oWsq6KobkPqznhl09Wum9ujEihaUT4Q&s" alt="Hình ảnh" id="preview_${rowCount}" style="width: 50px;">
                    </div>
                    <div class="w-100">
                        <input class="form-control" type="file" name="list_hinh_anh[id_${rowCount}]" onchange="previewImage(this, ${rowCount})">
                    </div>
                </td>
                <td>
                    <button class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1 ms-3" onclick="removeRow(this)"></button>
                </td>
            `;

                tableBody.appendChild(newRow);
                rowCount++;
            });
        });

        
        // Hàm hiển thị hình ảnh của album
        function previewImage(input, rowIndex) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById(`preview_${rowIndex}`).setAttribute('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeRow(button) {
            var row = button.closest('tr');
            row.remove();
        }
    </script>
@endsection
