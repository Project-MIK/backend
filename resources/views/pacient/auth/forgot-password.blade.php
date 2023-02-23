<x-app-pacient title="Lupa Kata Sandi">
    <style>
        .card{width:100%}@media (min-width:991.98px){.card{width:75%}}
    </style>
    <div class="container wrapper-pacient my-5">
        <div class="card shadow-lg rounded-lg mx-auto">
            <div class="card-body">
                <div class="d-flex">
                    <div class="img-card-forgot-password w-50 d-none d-lg-block"></div>
                    <form class="form-auth px-4 py-5" action="" method="POST">
                        @csrf
                        <h1 class="font-weight-bold text-bunting text-xl">Lupa Kata Sandi</h1>
                        <p class="text-trouth font-weight-light text-sm">Masukkan e-mail yang terdaftar. Kami akan </br> mengirimkan tautan verifikasi untuk mengatur ulang kata sandi anda.</p>
                        <div class="my-5">
                            @if($errors->any())                   
                                <div class="alert alert-danger" role="alert">
                                    {{$errors->all()->first()}}
                                </div>
                            @endif
                            <div class="form-group mb-4">
                                <label for="email" class="text-trouth">Email</label>
                                <input type="email" class="form-control py-4" name="email" id="email" aria-describedby="email" placeholder="Ketikkan email" value="{{ old('email') }}" autofocus required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-bunting w-100 text-white font-weight-bold py-2 mb-4">Lupa Kata Sandi</button>
                        <p class="text-trouth">Sudah punya akun ? <a href="/masuk" class="text-dogger">Masuk</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-pacient>