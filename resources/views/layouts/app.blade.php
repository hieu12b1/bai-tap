<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Favicon --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/auth/img/favicon.png') }}">
    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/auth/css/bootstrap.min.css') }}">
    {{-- Fontawesome CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/auth/css/fontawesome-all.min.css') }}">
    {{-- Flaticon CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/auth/font/flaticon.css') }}">
    {{-- Google Web Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/auth/style.css') }}">
    {{-- Link Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    @yield('css')
</head>

<body>
    <section class="fxt-template-animation fxt-template-layout9" data-bg-image="{{ asset('assets/auth/img/figure/bg9-l.jpg') }}">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-3">
                    <div class="fxt-header">
                        <a href="login-9.html" class="fxt-logo"><img src="{{ asset('assets/auth/img/logo-9.png') }}" alt="Logo"></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fxt-content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 
        Những thư viện hoặc file JS dùng chung cho toàn bộ dự án
        mới được phép đặt ở đây
    --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    {{-- jquery --}}
    <script src="{{ asset('assets/auth/js/jquery.min.js') }}"></script>
    {{-- Bootstrap js --}}
    <script src="{{ asset('assets/auth/js/bootstrap.min.js') }}"></script>
    {{-- Imagesloaded js --}}
    <script src="{{ asset('assets/auth/js/imagesloaded.pkgd.min.js') }}"></script>
    {{-- Validator js --}}
    <script src="{{ asset('assets/auth/js/validator.min.js') }}"></script>
    {{-- Custom Js --}}
    <script src="{{ asset('assets/auth/js/main.js') }}"></script>

    @yield('js')
</body>

</html>
