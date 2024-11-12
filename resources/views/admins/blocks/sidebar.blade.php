<!-- Left Sidebar Start -->
<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">
                <a class='logo logo-light' href='index.html'>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/clients/img/logo-index.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/clients/img/logo-index.png') }}" alt="" height="40">
                    </span>
                </a>
                <a class='logo logo-dark' href='index.html'>
                    <span class="logo-sm">
                        <img src="{{ asset('assets/clients/img/logo-index.png') }}" alt="" height="60">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/clients/img/logo-index.png') }}" alt="" height="80">
                    </span>
                </a>
            </div>

            <ul id="side-menu">

                <li class="menu-title">Quản lý</li>

                <li>
                    <a class='tp-link' href='{{ route('admin.dashboard') }}'>
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="menu-title">Kinh doanh</li>

                <li>
                    <a class='tp-link' href='{{ route('admin.danhmucs.index') }}'>
                        <i data-feather="align-center"></i>
                        <span> Danh mục sản phẩm </span>
                    </a>
                </li>

                <li>
                    <a class='tp-link' href='{{ route('admin.sanphams.index') }}'>
                        <i data-feather="package"></i>
                        <span> Sản phẩm </span>
                    </a>
                </li>

                {{-- <li>
                    <a class='tp-link' href='{{ route('admin.donhangs.index') }}'>
                        <i data-feather="shopping-bag"></i>
                        <span> Đơn hàng </span>
                    </a>
                </li> --}}

                <li>
                    <a class='tp-link' href='{{ route('admin.users.index') }}'>
                        <i data-feather="user"></i>
                        <span> Người dùng </span>
                    </a>
                </li>

                <li>
                    <a class='tp-link' href='{{ route('admin.vouchers.index') }}'>
                        <i data-feather="tag"></i>
                        <span> Mã giảm giá </span>
                    </a>
                </li>

                <li>
                    <a class='tp-link' href='{{ route('admin.invoices.index') }}'>
                        <i data-feather="file-minus"></i>
                        <span> Hóa đơn </span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>
<!-- Left Sidebar End -->
