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
                    <h4 class="fs-18 fw-semibold m-0">Quản lý hóa đơn</h4>
                </div>
            </div>

            <!-- General Form -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4 class="card-title align-content-center mb-0">{{ $title }}: <span
                                    class="fs-4 text-secondary">{{ $invoice->ma_don_hang }}</span></h4>
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
                                                    <li>Tên tài khoản: <b>{{ $invoice->user->name }}</b>
                                                    <li>Email: <b>{{ $invoice->user->email }}</b>
                                                    <li>Số điện thoại: <b>{{ $invoice->user->phone }}</b>
                                                    <li>Địa chỉ: <b>{{ $invoice->user->address }}</b>
                                                    <li>Tài khoản: <b>{{ $invoice->user->role }}</b>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>Tên tài khoản: <b>{{ $invoice->user->name }}</b>
                                                    <li>Email người nhận: <b>{{ $invoice->user->email }}</b></li>
                                                    <li>Số điện thoại người nhận:
                                                        <b>{{ $invoice->user->phone }}</b>
                                                    </li>

                                                    <li>Ghi chú: <b>{{ $invoice->notes }}</b></li>
                                                    <li>Trạng thái đơn hàng:
                                                        <b>{{ $invoices[$invoice->status] }}</b>
                                                    </li>
                                                    <li>Phương thức thanh toán:
                                                        <b>{{ $invoice->payment_method }}</b>
                                                    </li>
                                                    <li>Trạng thái thanh toán:
                                                        <b>{{ $invoices[$invoice->payment_status] }}</b>
                                                    </li>
                                                    <li class="{{ $invoice->voucher ? 'border p-3' : 'd-none' }}">
                                                        @if ($invoice->voucher)
                                                            <span> Thông tin chi tiết mã giảm giá </span>
                                                            <div>
                                                                Code:
                                                                <b>{{ $invoice->voucher->code }}</b>
                                                            </div>
                                                            <div>
                                                                Số tiền giảm giá:
                                                                <b>{{ number_format($invoice->voucher->discount_amount, 0, '', '.') }}đ</b>
                                                            </div>
                                                            <div>
                                                                Ngày bắt đầu mã giảm giá:
                                                                <b>{{ $invoice->voucher->start_date }}</b>
                                                            </div>
                                                            <div>
                                                                Ngày kết thúc mã giảm giá:
                                                                <b>{{ $invoice->voucher->end_date }}</b>
                                                            </div>
                                                        @else
                                                            <div>
                                                                Không có mã giảm giá áp dụng.
                                                            </div>
                                                        @endif
                                                    </li>
                                                    <li>Tổng tiền: <b
                                                            class="fs-5 text-danger">{{ number_format($invoice->total_amount, 0, '', '.') }}
                                                            đ</b></li>
                                                </ul>
                                            </td>
                                        </tr>
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
