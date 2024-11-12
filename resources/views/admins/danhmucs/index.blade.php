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
                    <h4 class="fs-18 fw-semibold m-0">Quản lý danh mục sản phẩm</h4>
                </div>
            </div>

            <!-- General Form -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form method="GET" id="searchForm" class="row m-3" action="{{ route('admin.danhmucs.index') }}">
                            <div class="form-group col-12 col-md-4">
                                <input type="text" name="ten_danh_muc" class="form-control"
                                    placeholder="Tìm kiếm theo tên danh mục">
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" id="searchButton" disabled class="btn btn-primary ">Tìm kiếm</button>
                                <button type="button" id="resetButton" class="btn btn-outline-danger ">Xóa tìm
                                    kiếm</button>
                            </div>
                        </form>
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title align-content-center mb-0">{{ $title }}</h4>
                            <a href="{{ route('admin.danhmucs.create') }}" class="btn btn-success"><i
                                    data-feather="plus-square"></i> Thêm danh mục</a>
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

                                <table class="table  mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Hình ảnh</th>
                                            <th scope="col">Tên danh mục</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listDanhMuc as $index => $danhMuc)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>
                                                    @php
                                                        $imageUrl = $danhMuc->hinh_anh;
                                                    @endphp
                                                    @if (filter_var($imageUrl, FILTER_VALIDATE_URL) &&
                                                            (strpos($imageUrl, 'http://') === 0 || strpos($imageUrl, 'https://') === 0))
                                                        <img src="{{ $imageUrl }}" width="100px"
                                                            alt="Hình ảnh danh mục sản phẩm">
                                                    @else
                                                        <img src="{{ Storage::url($danhMuc->hinh_anh) }}" width="100px"
                                                            alt="Hình ảnh mặc định">
                                                    @endif
                                                </td>
                                                <td>{{ $danhMuc->ten_danh_muc }}</td>
                                                <td
                                                    class="{{ $danhMuc->trang_thai == true ? 'text-success' : 'text-danger' }}">
                                                    {{ $danhMuc->trang_thai == true ? 'Hiển thị' : 'Ẩn' }}
                                                </td>

                                                <td>
                                                    <a href="{{ route('admin.danhmucs.edit', $danhMuc->id) }}">
                                                        <i
                                                            class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                    </a>
                                                    <form action="{{ route('admin.danhmucs.destroy', $danhMuc->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Bạn có chắc là muốn xóa danh mục?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="border-0 bg-white">
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
                                        <li class="page-item {{ $listDanhMuc->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $listDanhMuc->previousPageUrl() }}">«
                                                Previous</a>
                                        </li>

                                        @for ($i = 1; $i <= $listDanhMuc->lastPage(); $i++)
                                            <li
                                                class="page-item {{ $listDanhMuc->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $listDanhMuc->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <li class="page-item {{ $listDanhMuc->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $listDanhMuc->nextPageUrl() }}">Next »</a>
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
            url.searchParams.delete('ten_danh_muc');

            window.history.replaceState({}, document.title, url);
            location.reload();
        });
    </script>
@endsection
