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
                <h4 class="fs-18 fw-semibold m-0">Quản lý mã giảm giá sản phẩm</h4>
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
                        <form action="{{ route('admin.vouchers.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="discount_amount" class="form-label">Số tiền giảm giá</label>
                                        <input type="text" id="discount_amount" name="discount_amount"
                                            class="form-control @error('discount_amount') is-invalid @enderror"
                                            value="{{ old('discount_amount') }}"
                                            placeholder="Discount amount">
                                        @error('discount_amount')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="usage_limit" class="form-label">Giới hạn số lần sử dụng</label>
                                        <input type="number" id="usage_limit" name="usage_limit"
                                            class="form-control"
                                            value="1">
                                    </div>

                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Ngày bắt đầu</label>
                                        <input type="date" id="start_date" name="start_date"
                                            class="form-control @error('start_date') is-invalid @enderror"
                                            value="{{ old('start_date') }}">
                                        @error('start_date')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="discount_type" class="form-label">Loại giảm giá</label>
                                        <select name="discount_type"
                                            class="form-select @error('discount_type') is-invalid @enderror">
                                            @foreach ($data['discount_types'] as $index => $discount_type)
                                            <option value="{{ $discount_type['id'] }}"
                                                {{ old('discount_type', $index === 0 ? $discount_type['id'] : '') == $discount_type['id'] ? 'selected' : '' }}>
                                                {{ $discount_type['name'] }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="minimum_order_amount" class="form-label">Số tiền tối thiểu để sử dụng</label>
                                        <input type="number" id="minimum_order_amount" name="minimum_order_amount"
                                            class="form-control"
                                            value="1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">Ngày kết thúc</label>
                                        <input type="date" id="end_date" name="end_date"
                                            class="form-control @error('end_date') is-invalid @enderror"
                                            value="{{ old('end_date') }}">
                                        @error('end_date')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="count_voucher" class="form-label">(*) Số lượng tạo ra mã giảm giá</label>
                                        <input type="number" id="count_voucher" name="count_voucher"
                                            class="form-control"
                                            value="1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="san_pham_id" class="form-label">Sản phẩm</label>
                                        <select name="san_pham_id"
                                            class="form-select  @error('san_pham_id') is-invalid @enderror">
                                            <option selected>Chọn sản phẩm</option>
                                            @foreach ($data['products'] as $product)
                                            <option value="{{ $product['id'] }}"
                                                {{ old('product') == $product['id'] ? 'selected' : '' }}>
                                                {{ $product['ten_san_pham'] }}
                                                @endforeach
                                        </select>
                                        @error('san_pham_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
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
<script>
</script>
@endsection