<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TELEMEDICINE | Admin</title>
    <link rel="icon" type="image/png" href="{{asset('images/logo-rshusada.png')}}">
    <x-admin-prerendered-assets />
</head>
<body >

    @yield('content')


    <x-admin-postrendered-assets />

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
    @yield('after-js')
</body>
</html>
