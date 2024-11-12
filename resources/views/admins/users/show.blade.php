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
                <h4 class="fs-18 fw-semibold m-0">Quản lý người dùng</h4>
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
                        <div>
                            <div class="row">
                                <div class=" col-12 col-lg-6">
                                    <div class="mb-3 ">
                                        <label for="name" class="form-label">Tên người dùng</label>
                                        <input disabled type="text" id="name" name="name"
                                            class="form-control"
                                            value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class=" col-12 col-lg-6">
                                    <div class="mb-3 ">
                                        <label for="name" class="form-label">Email</label>
                                        <input disabled type="text" id="name" name="name"
                                            class="form-control"
                                            value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class=" col-12 col-lg-6">
                                    <div class="mb-3 ">
                                        <label for="name" class="form-label">Phone</label>
                                        <input disabled type="text" id="name" name="name"
                                            class="form-control"
                                            value="{{ $user->phone }}">
                                    </div>
                                </div>

                                <div class=" col-12 col-lg-6">
                                    <div class="mb-3 ">
                                        <label for="name" class="form-label">Role</label>
                                        <input disabled type="text" id="name" name="name"
                                            class="form-control"
                                            value="{{ $user->role }}">
                                    </div>
                                </div>

                                <div class=" col-12">
                                    <div class="mb-3 ">
                                        <label for="name" class="form-label">Address</label>
                                        <div id="quill-editor" ></div>
                                        <textarea rows="4" disabled class="form-control" >{{$user->address}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
</div> <!-- content -->
@endsection