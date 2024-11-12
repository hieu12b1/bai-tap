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
                        <form method="GET" action="{{ route('admin.invoices.index') }}" id="searchForm" class="row m-3">
                            <div class="col-12 col-md-3">
                                <label class="form-label"> Tên người dùng</label>
                                <input type="text" name="user_name" class="form-control"
                                    placeholder="Tìm kiếm tên người dùng">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label"> Trạng thái</label>
                                <select name="status" class="form-select">
                                    <option selected value=""> Chọn trạng thái </option>
                                    @foreach ($invoices as $key => $value)
                                        <option value="{{ $key }}">
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 mt-3">
                                <button type="submit" id="searchButton" disabled class="btn btn-primary ">Tìm kiếm</button>
                                <button type="button" id="resetButton" class="btn btn-outline-danger ">Xóa tìm
                                    kiếm</button>
                            </div>
                        </form>

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
                                            <th scope="col">Mã hóa đơn</th>
                                            <th scope="col">Tên người dùng</th>
                                            <th scope="col">Tổng tiền</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Loại thanh toán</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listInvoice as $index => $invoice)
                                            <tr>
                                                <!-- <th scope="row">{{ \Illuminate\Support\Str::limit($invoice->code, 16, '...') }}</th> -->
                                                <th style="width: 150px" scope="row">{{ $invoice->invoice_number }}</th>
                                                <td>{{ $invoice->user->name }}</td>
                                                <td>{{ $invoice->total_amount }}</td>
                                                <td>{{ $invoice->invoice_date }}</td>
                                                <td>{{ $invoice->payment_method }}</td>
                                                <td style="width: 200px">
                                                    <select disabled name="invoice_status" class="form-select">
                                                        @foreach ($invoices as $key => $value)
                                                            <option value="{{ $key }}"
                                                                {{ $invoice->status === $key ? 'selected' : '' }}>
                                                                {{ $value }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.invoices.show', $invoice->id) }}">
                                                        <i
                                                            class="mdi mdi-eye text-muted fs-18 rounded-2 border p-1 me-1"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- phân trang -->
                                <div class="mt-4">
                                    <ul class="pagination">
                                        <li class="page-item {{ $listInvoice->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $listInvoice->previousPageUrl() }}">«
                                                Previous</a>
                                        </li>

                                        @for ($i = 1; $i <= $listInvoice->lastPage(); $i++)
                                            <li class="page-item {{ $listInvoice->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $listInvoice->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <li class="page-item {{ $listInvoice->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $listInvoice->nextPageUrl() }}">Next »</a>
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
            url.searchParams.delete('user_name');
            url.searchParams.delete('status');

            window.history.replaceState({}, document.title, url);
            location.reload();
        });
    </script>
@endsection
