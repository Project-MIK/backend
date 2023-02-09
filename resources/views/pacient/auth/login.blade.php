<x-app-pacient title="Masuk">
    <div class="container wrapper-pacient my-5">
        <div class="card shadow-lg rounded-lg w-75 mx-auto">
            <div class="card-body">
                <div class="d-flex">
                    <div class="img-card-login w-50 d-none d-lg-block"></div>
                    <form class="form-auth px-4 py-5" action="" method="POST">
                        @csrf
                        <h1 class="font-weight-bold text-bunting text-xl">Masuk</h1>
                        <p class="text-trouth font-weight-light text-sm">Masuk dengan akun anda untuk menggunakan layanan medis</p>
                        <div class="my-5">
                            @if($errors->any())                   
                                <div class="alert alert-danger" role="alert">
                                    {{$errors->all()->first()}}
                                </div>
                            @endif         
                            <div class="form-group mb-4">
                                <label for="noredis" class="text-trouth">Nomor Rekam Medis</label>
                                <input type="text" class="form-control py-4" id="noredis" name="no_medical_records" aria-describedby="noredis" placeholder="Ketikkan nomor rekam medis" value="{{ old('no_medical_records') }}" autofocus required>
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-between">
                                    <label for="password" class="text-trouth">Kata Sandi</label>
                                    <a href="/lupa-sandi" class="text-dogger">Lupa Kata Sandi ?</a>
                                </div>
                                <input type="password" class="form-control py-4" id="password" name="password" aria-describedby="password" placeholder="Ketikkan kata sandi" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-bunting w-100 text-white font-weight-bold py-2 mb-4">Masuk</button>
                        <p class="text-trouth">Belum punya akun ? <a href="/daftar" class="text-dogger">Daftar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-pacient>