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
                    <h4 class="fs-18 fw-semibold m-0">Quản lý đơn hàng</h4>
                </div>
            </div>

            <!-- General Form -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title align-content-center mb-0">{{ $title }}: <span
                                    class="fs-4 text-secondary">{{ $donHang->ma_don_hang }}</span></h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered mb-0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Thông tin tài khoản đặt hàng</th>
                                            <th>Thông tin người nhận</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <ul>
                                                    <li>Tên tài khoản: <b>{{ $donHang->user->name }}</b>
                                                    <li>Email: <b>{{ $donHang->user->email }}</b>
                                                    <li>Số điện thoại: <b>{{ $donHang->user->phone }}</b>
                                                    <li>Địa chỉ: <b>{{ $donHang->user->address }}</b>
                                                    <li>Tài khoản: <b>{{ $donHang->user->role }}</b>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>Tên tài người nhận: <b>{{ $donHang->ten_nguoi_nhan }}</b></li>
                                                    <li>Email người nhận: <b>{{ $donHang->email_nguoi_nhan }}</b></li>
                                                    <li>Số điện thoại người nhận:
                                                        <b>{{ $donHang->so_dien_thoai_nguoi_nhan }}</b>
                                                    </li>
                                                    <li>Địa chỉ người nhận: <b>{{ $donHang->dia_chi_nguoi_nhan }}</b></li>
                                                    <li>Ghi chú: <b>{{ $donHang->ghi_chu }}</b></li>
                                                    <li>Trạng thái đơn hàng:
                                                        <b>{{ $trangThaiDonHang[$donHang->trang_thai_don_hang] }}</b>
                                                    </li>
                                                    <li>Trạng thái thanh toán:
                                                        <b>{{ $trangThanhToan[$donHang->trang_thai_thanh_toan] }}</b>
                                                    </li>
                                                    <li>Tiền hàng: <b>{{ number_format($donHang->tien_hang, 0, '', '.') }}
                                                            đ</b></li>
                                                    <li>Tiền ship: <b>{{ number_format($donHang->tien_ship, 0, '', '.') }}
                                                            đ</b></li>
                                                    <li>Tổng tiền: <b
                                                            class="fs-5 text-danger">{{ number_format($donHang->tong_tien, 0, '', '.') }}
                                                            đ</b></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title align-content-center mb-0">Sản phẩm</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Hình ảnh</th>
                                            <th>Mã sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Đơn giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($donHang->chiTietDonHang as $item)
                                            @php
                                                $sanPham = $item->sanPham;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <img class="img-fluid" src="{{ Storage::url($sanPham->hinh_anh) }}"
                                                        alt="Product" width="100px" />
                                                </td>
                                                <td>{{ $sanPham->ma_san_pham }}</td>
                                                <td>{{ $sanPham->ten_san_pham }}</td>
                                                <td>{{ number_format($item->don_gia, 0, '', '.') }} đ</td>
                                                <td>{{ $item->so_luong }}</td>
                                                <td>{{ number_format($item->thanh_tien, 0, '', '.') }} đ</td>
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
