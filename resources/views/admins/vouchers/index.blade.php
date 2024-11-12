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
                <h4 class="fs-18 fw-semibold m-0">Quản lý mã giảm giá sản phẩm</h4>
            </div>
        </div>

        <!-- General Form -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                <form method="GET" action="{{ route('admin.vouchers.index') }}" id="searchForm" class="row m-3">
                            <div class="col-12 col-md-3">
                                <label class="form-label"> Mã code </label>
                                <input type="text"
                                    name="code"
                                    class="form-control"
                                    placeholder="Tìm kiếm theo mã code">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label"> Ngày bắt đầu </label>
                                <input type="date"
                                    name="start_date"
                                    class="form-control"
                                    placeholder="Tìm kiếm start date">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label"> Ngày kết thúc</label>
                                <input type="date"
                                    name="end_date"
                                    class="form-control"
                                    placeholder="Tìm kiếm end date">
                            </div>
                            <div class="col-12 mt-3">
                            <button type="submit" id="searchButton" disabled class="btn btn-primary ">Tìm kiếm</button>
                            <button type="button" id="resetButton" class="btn btn-outline-danger ">Xóa tìm kiếm</button>
                            </div>
                        </form>
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title align-content-center mb-0">{{ $title }}</h4>
                        <a href="{{ route('admin.vouchers.create') }}" class="btn btn-success"><i
                                data-feather="plus-square"></i> Thêm mã giảm giá</a>
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
                                        <th scope="col">Code</th>
                                        <th scope="col">San Pham</th>
                                        <th scope="col">Số tiền giảm giá</th>
                                        <th scope="col">Loại giảm giá</th>
                                        <th scope="col">Giới hạn sử dụng</th>
                                        <th scope="col">Ngày bắt đầu</th>
                                        <th scope="col">Ngày kết thúc</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listVoucher as $index => $voucher)
                                    <tr>
                                        <!-- <th scope="row">{{ \Illuminate\Support\Str::limit($voucher->code, 16, '...') }}</th> -->
                                        <th style="width: 200px" scope="row">{{ $voucher->code }}</th>                                        
                                        <td>{{ $voucher->sanPham->ten_san_pham }}</td>
                                        <td>{{ $voucher->discount_amount }}</td>
                                        <td>
                                            <span class="badge {{ $voucher->discount_type == 'percentage' ? 'bg-success' : 'bg-secondary' }}">
                                                {{  $voucher->discount_type == 'percentage'
                                                    ? 'Giảm giá cố định'
                                                    : 'Giảm giá theo phần trăm'
                                                }}
                                            </span>
                                        </td>
                                        <td>{{ $voucher->usage_limit }}</td>
                                        <td>{{ $voucher->start_date }}</td>
                                        <td>{{ $voucher->end_date }}</td>
                                        <td>
                                            <a href="{{ route('admin.vouchers.edit', $voucher->id) }}">
                                                <i class="mdi mdi-pencil text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                            </a>
                                            <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Bạn có chắc là muốn xóa mã giảm giá')">
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
                                    <li class="page-item {{ $listVoucher->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $listVoucher->previousPageUrl() }}">« Previous</a>
                                    </li>

                                    @for ($i = 1; $i <= $listVoucher->lastPage(); $i++)
                                        <li class="page-item {{ ($listVoucher->currentPage() == $i) ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $listVoucher->url($i) }}">{{ $i }}</a>
                                        </li>
                                        @endfor
                                        <li class="page-item {{ $listVoucher->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $listVoucher->nextPageUrl() }}">Next »</a>
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
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('searchForm');
        const button = document.getElementById('searchButton');

        form.addEventListener('input', function () {
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

    document.getElementById('resetButton').addEventListener('click', function () {
        const url = new URL(window.location);
        url.searchParams.delete('code');
        url.searchParams.delete('start_date');
        url.searchParams.delete('end_date');
        
        window.history.replaceState({}, document.title, url);
        location.reload();
    });
</script>
@endsection