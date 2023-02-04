<x-app-pacient title="Dashboard">
    @slot('styles')
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}">
        <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js') }}"></script>
        <style>
            table{
                display: block;
                max-width: -moz-fit-content;
                margin: 0 auto;
                overflow-x: auto;
            }
            select, button[id=btn-change-password] {
                height: 50px !important;
            }
            #pacient-name-tag {
                column-gap: 20px;
            }
            #pacient-actions{
                column-gap: 20px;
            }
            .text_action {
                display: none;
            }
            .icon_action {
                display: block;
            }
            #create_consulation{
                margin-top:20px 
            }
            #btn-change-profile{
                width: 100%;
                height: 50px;
            }
            @media (min-width: 991.98px) {
                .text_action {
                    display: block;
                }
                .icon_action {
                    display: none;
                }
                #pacient-name-tag{
                    column-gap: 0px;
                }
                #create_consulation{
                    margin-top:0px 
                }
                #btn-change-profile{
                    width: 50%;
                }
            }
        </style>
    @endslot
    <div class="container wrapper-pacient my-5">
        <div class="card shadow-lg rounded-lg w-100 mx-auto">
            <div class="card-body">
                <div class="d-flex">
                    <div class="p-5 w-100">
                        <div id="pacient-name-tag" class="d-flex align-items-center justify-content-between">
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
                            <button id="consultation" class="btn btn-bunting font-weight-bold text-white py-3 w-100 d-flex justify-content-center" onclick="pacientSelected(this)">
                                <span class="text_action">KONSULTASI</span>     
                                <svg class="icon_action" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                            </button>
                            <button id="history" class="btn btn-bunting font-weight-bold text-white py-3 w-100 d-flex justify-content-center" onclick="pacientSelected(this)">
                                <span class="text_action">RIWAYAT</span>     
                                <svg class="icon_action" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            </button>
                            <button id="setting" class="btn btn-bunting font-weight-bold text-white py-3 w-100 d-flex justify-content-center" onclick="pacientSelected(this)">
                                <span class="text_action">PENGATURAN</span>     
                                <svg class="icon_action" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            </button>
                        </div>
                        <div id="pacient-contents" class="my-5">
                            <div id="consultation">
                                <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-5">
                                    <div class="text-trouth">Nomor Rekam Medis : <strong>00-00-63-04-18</strong></div>
                                    <a id="create_consulation" href="/konsultasi" class="btn btn-bunting text-white font-weight-normal px-5">Buat Konsultasi</a>
                                </div>
                                @if (!empty($complaints))
                                <table class="table table-bordered">
                                    <thead>
                                      <tr class="text-center text-trouth">
                                        <th scope="col">Keluhan</th>
                                        <th scope="col">Status Periksa</th>
                                        <th scope="col">Detail</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($complaints as $item)
                                            @if($item["status"] != "consultation-complete")
                                            <tr class="text-trouth">
                                                <td>{{$item["description"]}}</td>
                                                <td class="text-center">
                                                        @if ($item["status"] == "waiting-consultation-payment")
                                                        <strong>Menunggu pembayaran konsultasi</strong>
                                                        @elseif($item["status"] == "confirmed-consultation-payment")
                                                            <strong>Konsultasi akan berlangsung pada</strong><br>{{$item["schedule"]}}
                                                        @elseif($item["status"] == "waiting-medical-prescription-payment")
                                                            <strong>Menunggu pembayaran resep obat</strong>
                                                        @elseif($item["status"] == "confirmed-medical-prescription-payment")
                                                            <strong>Menunggu pengambilan resep obat</strong>
                                                        @endif
                                                </td>
                                                <td>
                                                    <a href="{{'/konsultasi/'.$item['id']}}" class="btn {{ $item['status'] == "confirmed-consultation-payment" ? "btn-bunting" : "btn-trouth" }} text-white font-weight-normal px-5">CEK</a>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                  </table>
                                @else
                                    <p class="text-center font-weight-bold pt-4">Tidak ada jadwal konsultasi</p>
                                @endif
                            </div>
                            {{-- <div id="history">
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
                            </div> --}}
                            <div id="setting">
                                <form action="" method="post">
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
                                            <label for="inputRT" class="text-trouth">Email</label>
                                            <div class="d-flex">
                                                <div class="w-75">
                                                    <input type="text" class="form-control py-4 mr-2" name="email" placeholder="Ketikkan email" readonly required>
                                                </div>
                                                <button type="button" class="btn btn-trouth text-white w-50 ml-2">
                                                    Ganti Email
                                                </button>
                                            </div>
                                            <small class="text-bunting">Terverifikasi</small>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputKecamatan" class="text-trouth">Kata Sandi</label>
                                                    <button id="btn-change-password" type="button" class="btn btn-trouth text-white w-100">
                                                        Ganti Kata Sandi
                                                    </button>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="createdAt" class="text-trouth">Terdaftar Sejak</label>
                                                    <input id="createdAt" type="text" class="form-control py-4" placeholder="Terdaftar sejak" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end mt-4">
                                        <button id="btn-change-profile" type="submit" class="btn btn-bunting text-white font-weight-bold">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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