<x-app-pacient title="Daftar">
    @slot('styles')
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}">
        <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js') }}"></script>
        <style>
            select, button {
                height: 50px !important;
            }
        </style>
    @endslot
    <div class="container wrapper-pacient my-5">
        <div class="card shadow-lg rounded-lg w-100 mx-auto">
            <div class="card-body">
                <div class="d-flex">
                    <form class="p-5 w-100" action="" method="POST">
                        @csrf
                        <h1 class="font-weight-bold text-bunting text-xl">Daftar</h1>
                        <p class="text-trouth font-weight-light text-sm">Belum punya akun ? Buat akun anda sekarang dengan melengkapi beberapa informasi data diri dibawah ini </p>                       
                        <div class="my-5">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCitizen" class="text-trouth">Kewarganegaraan</label>
                                    <select id="inputCitizen" class="form-control" name="citizen" onchange="setCitizen(this)">
                                        <option selected value="indonesia">Indonesia</option>
                                        <option value="WNA">Warga Negara Asing</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <div id="nik" class="d-block">
                                        <label for="inputNik" class="text-trouth">NIK <span class="text-sm font-weight-normal">( Nomor Induk Kependudukan )</span></label>
                                        <input type="text" class="form-control py-4" id="inputNik" name="nik" placeholder="Ketikkan nomor induk kependudukan" oninput="numberOnly(this)" autofocus required>
                                    </div>
                                    <div id="paspor" class="d-none">
                                        <label for="inputPaspor" class="text-trouth">Nomor Paspor</label>
                                        <input type="text" class="form-control py-4" id="inputPaspor" name="no_paspor" placeholder="Ketikkan nomor paspor" value="-" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputNama" class="text-trouth">Nama lengkap</label>
                                    <input type="text" class="form-control py-4" id="inputNama" name="fullname" placeholder="Ketikkan nama lengkap" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputPlaceBirth" class="text-trouth">Tempat Lahir</label>
                                            <input type="text" class="form-control py-4" id="inputPlaceBirth" name="place_birth" placeholder="Ketikkan tempat lahir" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputBirthDate" class="text-trouth">Tanggal Lahir</label>
                                            <input type="text" class="form-control datepicker py-4 pl-3" id="inputBirthDate" name="date_birth" placeholder="Hari-Bulan-Tahun" required>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputGender" class="text-trouth">Jenis Kelamin</label>
                                            <select id="inputGender" class="form-control" name="gender">
                                                <option selected value="male">Laki-Laki</option>
                                                <option value="female">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputBloodGroup" class="text-trouth">Golongan Darah</label>
                                            <select id="inputBloodGroup" class="form-control" name="blood_group">
                                                <option selected value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="AB">AB</option>
                                                <option value="O">O</option>
                                            </select>
                                        </div>
                                    </div> 
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPekerjaan" class="text-trouth">Pekerjaan</label>
                                    <input type="text" class="form-control py-4" id="inputPekerjaan" name="profession" placeholder="Ketikkan nama pekerjaan" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="address" class="text-trouth">Alamat</label>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputRT" class="text-trouth font-weight-light">RT</label>
                                            <input type="text" class="form-control py-4" id="inputRT" name="address_RT" placeholder="Ketikkan nomor RT" oninput="numberOnly(this)" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputRW" class="text-trouth font-weight-light">RW</label>
                                            <input type="text" class="form-control py-4" id="inputRW" name="address_RW" placeholder="Ketikkan nomor RW" oninput="numberOnly(this)" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputDusun" class="text-trouth font-weight-light">Dusun</label>
                                            <input type="text" class="form-control py-4" id="inputDusun" name="address_dusun" placeholder="Ketikkan nama dusun" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="inputDesa" class="text-trouth font-weight-light">Desa</label>
                                            <input type="text" class="form-control py-4" id="inputDesa" name="address_desa" placeholder="Ketikkan nama desa" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputKecamatan" class="text-trouth font-weight-light">Kecamatan</label>
                                    <input type="text" class="form-control py-4" id="inputKecamatan" name="address_kecamatan" placeholder="Ketikkan nama kecamatan" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputKabupaten" class="text-trouth font-weight-light">Kabupaten</label>
                                    <input type="text" class="form-control py-4" id="inputKabupaten" name="address_kabupaten" placeholder="Ketikkan nama kabupaten" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputNoTelp" class="text-trouth">Nomor Telepon</label>
                                    <input type="text" class="form-control py-4" id="inputNoTelp" name="no_telp" oninput="numberOnly(this)" placeholder="Ketikkan nomor telepon" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail" class="text-trouth">Email</label>
                                    <input type="text" class="form-control py-4" id="inputEmail" name="email" placeholder="Ketikkan email" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword" class="text-trouth">Kata Sandi</label>
                                    <input type="text" class="form-control py-4" id="inputPassword" name="password" placeholder="Ketikkan kata sandi" required>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-center">
                            <button type="submit" class="btn btn-bunting w-25 text-white font-weight-bold py-2 mb-4">Daftar</button>
                            <p class="text-trouth">Sudah punya akun ? <a href="/masuk" class="text-dogger">Masuk</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @slot('scripts')
        <script>
            $(".datepicker").datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
                language: "id"
            });
            function setCitizen(e) {
                const NIK = document.getElementById("nik");
                const Paspor = document.getElementById("paspor");

                const inputNIK = document.getElementById("inputNik");
                const inputPaspor = document.getElementById("inputPaspor");

                if(e.value == "indonesia"){
                    NIK.classList.remove("d-none");
                    NIK.classList.add("d-block");

                    Paspor.classList.add("d-none");
                    Paspor.classList.remove("d-block");

                    inputNIK.value = "";
                    inputPaspor.value = "-";
                }else{
                    NIK.classList.remove("d-block");
                    NIK.classList.add("d-none");

                    Paspor.classList.remove("d-none");
                    Paspor.classList.add("d-block");

                    inputNIK.value = "-";
                    inputPaspor.value = "";
                }
            }
        </script>
    @endslot
</x-app-pacient>