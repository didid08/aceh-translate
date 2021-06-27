<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aceh Translate</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" />
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/toastr/toastr.min.css') }}">
    @yield('custom-css')
</head>

<body>
    @yield('content')
    <!-- Copyright Section-->
    <div class="copyright py-4 text-center text-white">
        <div class="container"><small>Copyright &copy; Muhammad Khairul Ammar 2021</small></div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            @if (session()->has('success'))
                toastr.success('{{ session()->get('success') }}')
            @endif
            @if (session()->has('error'))
                toastr.error('{{ session()->get('error') }}')
            @endif
        });
    </script>
    @yield('custom-script')
</body>

</html>
