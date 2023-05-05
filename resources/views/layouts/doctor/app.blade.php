<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TELEMEDICINE | Dokter</title>
    <link rel="icon" type="image/png" href="{{asset('images/logo-rshusada.png')}}">
    <x-admin-prerendered-assets />
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> --}}

        <x-admin-navbar />

        <x-doctor.layout.sidebar />

        <x-admin-content />
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>


    <x-admin-postrendered-assets />
    @if(session('message'))
    <script>
        console.log('mesage recorded');
        $(function() {
            $(document).ready(function() {
                $(document).Toasts('create', {
                    class: 'bg-success'
                    , title: 'success'
                    , autohide: true
                    , delay: 2000
                    , body: '{{ session('
                    message ')}}'
                })
            });
        });

    </script>
    @endif
    @if($errors->any())
    <script>
        console.log('mesage recorded');
        $(function() {
            $(document).ready(function() {
                $(document).Toasts('create', {
                    class: 'bg-danger'
                    , title: 'error'
                    , autohide: true
                    , delay: 2000
                    , body: '@foreach ($errors->all() as $error)<li>{{$error}}</li>@endforeach'
                })
            });
        });

    </script>
    {{-- {{dd($errors)}} --}}
    @endif
    @yield('after-js')
</body>
</html>
