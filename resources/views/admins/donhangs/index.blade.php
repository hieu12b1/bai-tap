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
                <h4 class="fs-18 fw-semibold m-0">Quản lý đơn hàng</h4>
            </div>
        </div>

        <!-- General Form -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title align-content-center mb-0">{{ $title }}</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.donhangs.index') }}" id="searchForm" class="row m-3">
                            <div class="col-12 col-md-3">
                                <label class="form-label"> Tên Người nhận </label>
                                <input type="text"
                                    name="ten_nguoi_nhan"
                                    class="form-control"
                                    placeholder="Tìm kiếm theo tên người nhận">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label"> Mã đơn hàng</label>
                                <input type="text"
                                    name="ma_don_hang"
                                    class="form-control"
                                    placeholder="Tìm kiếm theo mã đơn hàng">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label"> Email người nhận</label>
                                <input type="text"
                                    name="email_nguoi_nhan"
                                    class="form-control"
                                    placeholder="Tìm kiếm theo email người nhận">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label"> Số điện thoại người nhận</label>
                                <input type="text"
                                    name="so_dien_thoai_nguoi_nhan"
                                    class="form-control"
                                    placeholder="Tìm kiếm số điện thoại người nhận">
                            </div>
                            <div class="col-12  mt-1">
                                <button type="submit" id="searchButton" disabled class="btn btn-primary mt-3">Tìm kiếm</button>
                                <button type="button" id="resetButton" class="btn btn-outline-danger mt-3">Xóa tìm kiếm</button>

                            </div>
                        </form>
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
                                        <th>Mã đơn hàng</th>
                                        <th>Tên người nhận</th>
                                        <th>Email người nhận</th>
                                        <th>Số điện thoại ngươi nhận</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($donHangs as $item)
                                    <tr>
                                        <td style="width: 150px">
                                            {{ $item->ma_don_hang }}
                                        </td>
                                        <td>
                                            {{ $item->ten_nguoi_nhan }}
                                        </td>
                                        <td>
                                            {{ $item->email_nguoi_nhan }}
                                        </td>
                                        <td>
                                            {{ $item->so_dien_thoai_nguoi_nhan }}
                                        </td>
                                        <td>
                                            {{ $item->created_at->format('d-m-Y') }}
                                        </td>
                                        <td><span>{{ number_format($item->tong_tien, 0, '', '.') }} đ</span></td>
                                        <td>
                                            <form action="{{ route('admin.donhangs.update', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="trang_thai_don_hang" class="form-select w-75"
                                                    onchange="confirmSubmit(this)"
                                                    data-default-value="{{ $item->trang_thai_don_hang }}">
                                                    @foreach ($trangThais as $key => $value)
                                                    <option value="{{ $key }}"
                                                        {{ $key == $item->trang_thai_don_hang ? 'selected' : '' }}>
                                                        {{ $value }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.donhangs.show', $item->id) }}">
                                                <i
                                                    class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
</div> <!-- content -->
@endsection

@section('js')
<script>
    function confirmSubmit(selectElement) {
        var form = selectElement.form;
        var selectedOption = selectElement.options[selectElement.selectedIndex].text;
        var defaultValue = selectElement.getAttribute('data-default-value');

        if (confirm('Bạn có chắc chắn muốn thay đổi trạng thái đơn hàng thành "' + selectedOption + '" không?')) {
            form.submit();
        } else {
            // Nếu người dùng nhấn "Hủy", set lại giá trị của select về trạng thái ban đầu
            selectElement.value = defaultValue;
        }
    }


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
        url.searchParams.delete('created_at');
        url.searchParams.delete('email_nguoi_nhan');
        url.searchParams.delete('so_dien_thoai_nguoi_nhan');
        url.searchParams.delete('ten_nguoi_nhan');
        url.searchParams.delete('ma_don_hang');

        window.history.replaceState({}, document.title, url);
        location.reload();
    });
</script>
@endsection