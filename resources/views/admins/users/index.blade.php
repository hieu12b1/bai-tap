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
                    <h4 class="fs-18 fw-semibold m-0">Quản lý người dùng</h4>
                </div>
            </div>


            <!-- General Form -->
            <div class="row">
                <!-- tìm kiếm -->
                <div class="col-12">
                    <div class="card">
                        <form method="GET" action="{{ route('admin.users.index') }}" id="searchForm" class="row m-3">
                            <div class="col-12 col-md-3">
                                <label class="form-label"> Tên người dùng </label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Tìm kiếm theo tên người dùng">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label"> Email người dùng</label>
                                <input type="text" name="email" class="form-control"
                                    placeholder="Tìm kiếm theo email người dùng">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="form-label"> Số điện thoại người dùng</label>
                                <input type="number" name="phone" class="form-control"
                                    placeholder="Tìm kiếm theo số điện thoại người dùng">
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" id="searchButton" disabled class="btn btn-primary">Tìm kiếm</button>
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
                                            <th scope="col">#</th>
                                            <th scope="col">Tên người dùng</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Số điện thoại</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($listUser as $index => $user)
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $user->role == 'Admin' ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ $user->role }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.users.show', $user->id) }}">
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
                                        <li class="page-item {{ $listUser->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $listUser->previousPageUrl() }}">« Previous</a>
                                        </li>

                                        @for ($i = 1; $i <= $listUser->lastPage(); $i++)
                                            <li class="page-item {{ $listUser->currentPage() == $i ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $listUser->url($i) }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        <li class="page-item {{ $listUser->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $listUser->nextPageUrl() }}">Next »</a>
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
            url.searchParams.delete('email');
            url.searchParams.delete('name');
            url.searchParams.delete('phone');

            window.history.replaceState({}, document.title, url);
            location.reload();
        });
    </script>
@endsection
