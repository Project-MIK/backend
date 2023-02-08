<x-app-pacient title="Dashboard">
    @slot('styles')
        <style>
            table{
                display: block;
                max-width: -moz-fit-content;
                margin: 0 auto;
                overflow-x: auto;
            }
            select {
                height: 50px !important;
            }
            #pacient-actions{
                column-gap: 20px;
            }
        </style>
    @endslot
    <div class="container wrapper-pacient my-5">
        <div class="card shadow-lg rounded-lg w-100 mx-auto">
            <div class="card-body">
                <div class="d-flex">
                    <div class="p-5 w-100">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h1 class="font-weight-bold text-bunting text-xl">Halo, Lathisa Maharani</h1>
                                <p class="text-trouth font-weight-light text-sm">Gunakan layanan telemedicine untuk mewujudkan akses kesehatan terjangkau secara online</p>
                            </div>
                            <a href="/keluar">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M18 42H10C8.93913 42 7.92172 41.5786 7.17157 40.8284C6.42143 40.0783 6 39.0609 6 38V10C6 8.93913 6.42143 7.92172 7.17157 7.17157C7.92172 6.42143 8.93913 6 10 6H18" stroke="#003399" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M32 34L42 24L32 14" stroke="#003399" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M42 24H18" stroke="#003399" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>                     
                        <div id="pacient-actions" class="d-flex my-5 justify-content-between">
                            <button id="consultation" class="btn btn-bunting font-weight-bold text-white py-3 w-100" onclick="pacientSelected(this)">KONSULTASI</button>
                            <button id="history" class="btn btn-bunting font-weight-bold text-white py-3 w-100" onclick="pacientSelected(this)">RIWAYAT</button>
                            <button id="setting" class="btn btn-bunting font-weight-bold text-white py-3 w-100" onclick="pacientSelected(this)">PENGATURAN</button>
                        </div>
                        <div id="pacient-contents" class="my-5">
                            <div id="consultation">
                                <div class="d-flex align-items-center justify-content-between mb-5">
                                    <div class="text-trouth">Nomor Rekam Medis : <strong>00-00-63-04-18</strong></div>
                                    <a href="/konsultasi" class="btn btn-bunting text-white font-weight-normal px-5">Buat Konsultasi</a>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                      <tr class="text-center text-trouth">
                                        <th scope="col">No</th>
                                        <th scope="col">Keluhan</th>
                                        <th scope="col">Status Periksa</th>
                                        <th scope="col">Detail</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($complaints as $item)
                                        <tr class="text-trouth">
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{$item["description"]}}</td>
                                            <td class="text-center">
                                                <strong>{{$item["status"]}}</strong><br>{{$item["schedule"]}}
                                            </td>
                                            <td>
                                                <a href="{{'/konsultasi/'.$item['id']}}" class="btn btn-bunting text-white font-weight-normal px-5">CEK</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                  </table>
                            </div>
                            <div id="history">
                                <table class="table table-bordered">
                                    <thead>
                                      <tr class="text-trouth text-center">
                                        <th scope="col">No</th>
                                        <th scope="col">Aktifitas</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Detail</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($complaints as $item)
                                        <tr class="text-trouth">
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{$item["description"]}}</td>
                                            <td class="text-center">
                                                <strong>{{$item["status"]}}</strong><br>{{$item["schedule"]}}
                                            </td>
                                            <td>
                                                <a href="{{'/konsultasi/'.$item['id']}}" class="btn btn-bunting text-white font-weight-normal px-5">CEK</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                  </table>
                            </div>
                            <div id="setting">
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
                                            <input type="text" class="form-control py-4" id="inputPaspor" name="nopaspor" placeholder="Ketikkan nomor paspor" value="-" required>
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
                                                <input type="text" class="form-control datepicker py-4 pl-3" id="inputBirthDate" name="birth_date" placeholder="Hari-Bulan-Tahun" required>
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
                                                <select id="inputBloodGroup" class="form-control" name="blood">
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
                                                <input type="text" class="form-control py-4" id="inputDusun" name="address_Dusun" placeholder="Ketikkan nama dusun" required>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="inputDesa" class="text-trouth font-weight-light">Desa</label>
                                                <input type="text" class="form-control py-4" id="inputDesa" name="address_Desa" placeholder="Ketikkan nama desa" required>
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
                                        <input type="text" class="form-control py-4" id="inputPassword" name="passwor" placeholder="Ketikkan kata sandi" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @slot('scripts')
        <script>
            pacientSelected(document.getElementById("consultation"));
            function pacientSelected(e){
                const actions = document.getElementById("pacient-actions");
                const contents = document.getElementById("pacient-contents");
                for (let index = 0; index < actions.children.length; index++) {
                    // Button selected effect
                    if(actions.children[index].id == e.id){
                        actions.children[index].classList.add("btn-bunting", "text-white");
                        actions.children[index].classList.remove("border", "text-trouth");
                    }else{
                        actions.children[index].classList.remove("btn-bunting", "text-white");
                        actions.children[index].classList.add("border", "text-trouth");
                    }
                    // Content selected effect
                    if(contents.children[index].id == e.id){
                        contents.children[index].classList.add("d-block");
                        contents.children[index].classList.remove("d-none");
                    }else{
                        contents.children[index].classList.remove("d-block");
                        contents.children[index].classList.add("d-none");
                    }
                }
            }
        </script>
    @endslot
</x-app-pacient>