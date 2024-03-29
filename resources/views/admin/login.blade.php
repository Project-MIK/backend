<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="{{asset('images/logo-rshusada.png')}}" alt="" srcset="">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="/admin/login/login" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" autocomplete="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" autocomplete="current-password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>

    @if(session('message'))
    {{-- {{dd(session('message'))}} --}}
    <script>
        $(function() {
            $(document).ready(function() {
                $(document).Toasts('create', {
                    class: 'bg-success'
                    , title: 'success'
                    , autohide: true
                    , delay: 2000
                    , body: "{{ session('message')}}"
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
</body>
</html>
