<x-app-pacient title="Dashboard">
    @slot('styles')
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/css/bootstrap-datepicker.css') }}">
        <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.id.min.js') }}"></script>
        <style>
            table{display:block;max-width:-moz-fit-content;margin:0 auto;overflow-x:auto}button[id=btn-change-password],select{height:50px!important}#pacient-actions,#pacient-name-tag{column-gap:20px}.text_action{display:none}.icon_action{display:block}#create_consulation{margin-top:20px}#btn-change-profile{width:100%;height:50px}@media (min-width:991.98px){.text_action{display:block}.icon_action{display:none}#pacient-name-tag{column-gap:0}#create_consulation{margin-top:0}#btn-change-profile{width:50%}}
        </style>
    @endslot
    {{-- Modal Change Email --}}
        <div class="modal fade" id="modalChangeEmail" tabindex="-1" aria-labelledby="modalChangeEmailTitle" aria-hidden="true">
            <form action="/dashboard/change-email" method="POST" class="modal-dialog">
                @csrf
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-trouth" id="modalChangeEmailTitle">Ganti Email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-md-12">
                        <label for="inputEmail" class="text-trouth">Email</label>
                        <input type="email" class="form-control py-4" id="inputEmail" name="email" placeholder="Ketikkan email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-bunting text-white">Ya, Ganti Email</button>
                </div>
                </div>
            </form>
        </div>  
    {{-- ### --}}
    {{-- Modal Change Password --}}
        <div class="modal fade" id="modalChangePassword" tabindex="-1" aria-labelledby="modalChangePasswordTitle" aria-hidden="true">
            <form action="/dashboard/change-password" method="POST" class="modal-dialog">
                @csrf
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-trouth" id="modalChangePasswordTitle">Ganti Kata Sandi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-md-12">
                        <label for="inputPassword1" class="text-trouth">Kata Sandi Baru</label>
                        <input type="text" class="form-control py-4" id="inputPassword1" name="password1" placeholder="Ketikkan kata sandi baru" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputPassword2" class="text-trouth">Konfirmasi Kata Sandi Baru</label>
                        <input type="text" class="form-control py-4" id="inputPassword2" name="password2" placeholder="Ketikkan kata sandi baru" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-bunting text-white">Ya, Ganti Kata Sandi</button>
                </div>
                </div>
            </form>
        </div>  
    {{-- ### --}}
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
                                            @if($item["status"] != "consultation-complete" && $item["valid_status"] > time())
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
                                        @foreach ($history_complaints as $item)
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
                            <x-consultation-actions.setting/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    @slot('scripts')
        <script>
            function pacientSelected(e){let t=document.getElementById("pacient-actions"),d=document.getElementById("pacient-contents");for(let i=0;i<t.children.length;i++)t.children[i].id==e.id?(t.children[i].classList.add("btn-bunting","text-white"),t.children[i].classList.remove("border","text-trouth")):(t.children[i].classList.remove("btn-bunting","text-white"),t.children[i].classList.add("border","text-trouth")),d.children[i].id==e.id?(d.children[i].classList.add("d-block"),d.children[i].classList.remove("d-none")):(d.children[i].classList.remove("d-block"),d.children[i].classList.add("d-none"))}$(".datepicker").datepicker({format:"dd-mm-yyyy",autoclose:!0,todayHighlight:!0,language:"id"}),pacientSelected(document.getElementById("consultation"));
        </script>
    @endslot
</x-app-pacient>