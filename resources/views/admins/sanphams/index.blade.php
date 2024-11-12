@extends('layouts.admin')

@section('title')
{{ $title }}
@endsection

@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Quản lý sản phẩm</h4>
            </div>
        </div>


        <!-- General Form -->
        <div class="row">
            <!-- tìm kiếm -->
            <div class="col-12">
                <div class="card">
                    <form method="GET" action="{{ route('admin.sanphams.index') }}" id="searchForm" class="row m-3">
                        <div class="col-12 col-md-3">
                            <label class="form-label"> Tên sản phẩm </label>
                            <input type="text"
                                name="ten_san_pham"
                                class="form-control"
                                placeholder="Tìm kiếm theo tên sản phẩm">
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label"> Mã sản phẩm</label>
                            <input type="text"
                                name="ma_san_pham"
                                class="form-control"
                                placeholder="Tìm kiếm theo mã sản phẩm">
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label"> Gía sản phẩm</label>
                            <input type="number"
                                name="gia_san_pham"
                                class="form-control"
                                placeholder="Tìm kiếm theo giá sản phẩm">
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label"> Gía khyến mãi sản phẩm</label>
                            <input type="number"
                                name="gia_khuyen_mai"
                                class="form-control"
                                placeholder="Tìm kiếm giá khuyến mãi sản phẩm">
                        </div>
                        <div class="col-12 col-md-3 mt-3">
                            <label class="form-label"> Danh mục sản phẩm</label>
                            <select name="danh_muc_id"
                                class="form-select @error('danh_muc_id') is-invalid @enderror">
                                <option selected value="">Chọn danh mục</option>
                                @foreach ($listDanhMuc as $danhMuc)
                                <option value="{{ $danhMuc->id }}"
                                    {{ old('danh_muc_id') == $danhMuc->id ? 'selected' : '' }}>
                                    {{ $danhMuc->ten_danh_muc }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mt-4">
                            <div>
                                <button type="submit" id="searchButton" disabled class="btn btn-primary ">Tìm kiếm</button>
                                <button type="button" id="resetButton" class="btn btn-outline-danger ">Xóa tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title align-content-center mb-0">{{ $title }}</h4>
                        <a href="{{ route('admin.sanphams.create') }}" class="btn btn-success"><i
                                data-feather="plus-square"></i> Thêm sản phẩm</a>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="table-responsive">
                            @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif

                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif

                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Mã sản phẩm</th>
                                        <th scope="col">Hình ảnh</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Danh mục</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Giá khuyến mãi</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listSanPham as $index => $sanPham)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td style="width: 150px">{{ $sanPham->ma_san_pham }}</td>
                                        <td>
                                            @php
                                            $imageUrl = $sanPham->hinh_anh;
                                            @endphp
                                            @if (filter_var($imageUrl, FILTER_VALIDATE_URL) && (strpos($imageUrl, 'http://') === 0 || strpos($imageUrl, 'https://') === 0))
                                            <img src="{{ $imageUrl }}" width="100px" alt="Hình ảnh danh mục sản phẩm">
                                            @else
                                            <img src="{{ Storage::url($sanPham->hinh_anh) }}" width="100px"
                                                alt="Hình ảnh sản phẩm">
                                            @endif

                                        </td>
                                        <td>{{ $sanPham->ten_san_pham }}</td>
                                        <td>{{ $sanPham->danhMuc->ten_danh_muc }}</td>
                                        <td>{{ number_format($sanPham->gia_san_pham) }}</td>
                                        <td>{{ empty($sanPham->gia_khuyen_mai) ? 0 : number_format($sanPham->gia_khuyen_mai) }}</td>
                                        <td class="{{ $sanPham->trang_thai == true ? 'text-success' : 'text-danger' }}">
                                            {{ $sanPham->trang_thai == true ? 'Hiển thị' : 'Ẩn' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.sanphams.edit', $sanPham->id) }}">
                                                <i class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                            </a>
                                            <form action="{{ route('admin.sanphams.destroy', $sanPham->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Xác nhận xóa?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="border-0 bg-white p-0">
                                                    <i
                                                        class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- phân trang -->
                            <div class="mt-4">
                                <ul class="pagination">
                                    <li class="page-item {{ $listSanPham->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $listSanPham->previousPageUrl() }}">« Previous</a>
                                    </li>

                                    @for ($i = 1; $i <= $listSanPham->lastPage(); $i++)
                                        <li class="page-item {{ ($listSanPham->currentPage() == $i) ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $listSanPham->url($i) }}">{{ $i }}</a>
                                        </li>
                                        @endfor
                                        <li class="page-item {{ $listSanPham->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $listSanPham->nextPageUrl() }}">Next »</a>
                                        </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
</div> <!-- content -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('searchForm');
        const button = document.getElementById('searchButton');

        form.addEventListener('input', function() {
            const inputs = form.querySelectorAll('input, select');
            let hasValue = false;

            inputs.forEach(input => {
                if (input.value.trim() !== '') {
                    hasValue = true;
                }
            });

            button.disabled = !hasValue;
        });
    });

    document.getElementById('resetButton').addEventListener('click', function() {
        const url = new URL(window.location);
        url.searchParams.delete('ten_san_pham');
        url.searchParams.delete('ma_san_pham');
        url.searchParams.delete('gia_san_pham');
        url.searchParams.delete('gia_khuyen_mai');
        url.searchParams.delete('danh_muc_id');

        window.history.replaceState({}, document.title, url);
        location.reload();
    });
</script>
@endsection