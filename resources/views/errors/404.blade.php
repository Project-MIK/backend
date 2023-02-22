<?php 

// Get first path at routes
$route = $_SERVER['REQUEST_URI'];
$first_path = explode("/", $route)[1];

if($first_path != "admin"){
?>
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Tidak Ditemukan | Rumah Sakit Citra Husada Jember</title>
    <link href="{{ asset('images/favicon.ico') }}" rel="shortcut icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/appuser.css') }}">
  </head>
  <body>
  <main class="wrapper">
    <div class="container wrapper-pacient my-5">
        <div class="card shadow-lg rounded-lg w-100 mx-auto">
            <div class="card-body">  
                <div class="p-5 w-100 text-center">
                    <h1 class="font-weight-bold text-trouth display-1">404</h1>
                    <p class="text-trouth mb-4">Ops, Halaman yang anda cari tidak tersedia</p>
                    <a href="/" class="btn btn-bunting px-5 text-white font-weight-bold">Kembali</a>
                </div>
            </div>
        </div>
    </div>
  </main>
  </body>
</html>
<?php
}else{
    // When path not admin
    echo "ADMIN PAGE ERROR - 404 (/views/errors/404)";
    // write code
}
?>