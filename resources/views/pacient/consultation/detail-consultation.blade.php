<x-app-pacient title="Poliklinik">
    @slot('styles')
        <style>
            select, button {
                height: 50px !important;
            }
            #back-page-1{
                display: none;
            }
            #back-page-2{
                display: block;
            }
            #confirmation-payment{
                width: 100%;
            }
            @media (min-width: 991.98px) {
                #back-page-1{
                    display: block;
                }
                #back-page-2{
                    display: none;
                }
                #confirmation-payment{
                    width: 50%;
                }
            }
        </style>
    @endslot
    <div class="container wrapper-pacient my-5">
        <div class="card shadow-lg rounded-lg w-100 mx-auto">
            <div class="card-body">
                <div class="p-5 d-flex">
                    <a id="back-page-1" class="mr-3" href="/dashboard">
                        <svg role="button" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M38 24H10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M24 38L10 24L24 10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <form class="w-100" action="" method="POST">
                        @csrf
                        <div class="d-flex align-items-center">
                            <a id="back-page-2" class="mr-3" href="/dashboard">
                                <svg role="button" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M38 24H10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M24 38L10 24L24 10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <h1 class="font-weight-bold text-bunting text-xl">{{ $id }}</h1>
                        </div>
                        <div class="mt-4">
                            <div class="d-flex flex-column flex-lg-row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group col-12">
                                        <label for="complaint" class="text-trouth">Keluhan</label>
                                        <textarea class="form-control" id="complaint" cols="30" rows="5" readonly>Excepteur esse officia nostrud laborum tempor mollit dolore qui consequat magna mollit ut. Consequat est laborum ullamco et adipisicing anim eu reprehenderit laborum officia adipisicing ea.</textarea>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="polyclinic" class="text-trouth">Kategori</label>
                                        <input type="text" class="form-control py-4" id="polyclinic" value="Nisi tempor nisi et dolor sint." readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group col-12">
                                        <label for="polyclinic" class="text-trouth">Poliklinik</label>
                                        <input type="text" class="form-control py-4" id="polyclinic" value="POLIKLINIK PENYAKIT DALAM (INTERNA)" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="doctor" class="text-trouth">Dokter</label>
                                        <input type="text" class="form-control py-4" id="doctor" value="DR. H. M. Pilox Kamacho H., S.pb" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="consultation-schedule" class="text-trouth">Jadwal Konsultasi <span class="font-weight-light">( WIB )</span></label>
                                        <input type="text" class="form-control py-4" id="consultation-schedule" value="29 / Januari / 2023  15:30:00 - 16:30:00 " readonly>
                                    </div>
                                    <div id="status-payment-consultation" class="d-none">
                                        <div class="form-group col-12">
                                            <label for="price-consultation" class="text-trouth">Nominal Bayar Konsultasi</label>
                                            <input type="text" class="form-control py-4 text-bunting font-weight-bold" id="price-consultation" value="RP.90.000" readonly>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="status-payment" class="text-trouth">Status Pembayaran</label>
                                            <input type="text" class="form-control py-4" id="status-payment" value="BELUM TERKONFIRMASI/ PROSES VERIFIKASI / TERKONFIRMASI / PEMBAYARAN TIDAK VALID / KADALUARSA" readonly>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="bankPayment" class="text-trouth">Bank Pembayaran</label>
                                            <select id="bankPayment" class="form-control" name="consultation_bank_payment" onchange="setBankPayment(this)">
                                                <option selected value="BCA">BCA ( Bank Central Asia )</option>
                                                <option selected value="BRI">BRI ( Bank Rakyat Indonesia )</option>
                                            </select>
                                            <div class="d-flex flex-column mt-5">
                                                <div class="d-flex flex-column flex-lg-row align-items-center">
                                                    <div class="col-12 col-md-5">
                                                        <img id="image-bank" src="{{ asset('/images/bca-logo.png') }}" alt="logo-bca" width="150">
                                                    </div>
                                                    <div id="information-bank" class="col-12 col-md-8">
                                                        <p id="number-bank" class="font-weight-bold text-trouth">NO. REK : 435793455</p>
                                                        <p id="name-account-bank" class="font-weight-bold text-trouth">RS. CITRA HUSADA JEMBER</p>
                                                    </div>
                                                </div>
                                                <div class="text-sm mt-4">
                                                    <p>Harap melakukan pembayaran sesuai nominal yang tertera.</p>
                                                    <p>Pembayaran berlaku sampai 
                                                        <span class="font-weight-bold">
                                                            4 - Februari - 2023 23:00:00.
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="input-group my-3">
                                                    <div class="custom-file">
                                                      <input type="file" class="custom-file-input" id="upload-proof-payment" aria-describedby="inputGroupFileAddon01">
                                                      <label class="custom-file-label" for="upload-proof-payment">Unggah bukti pembayaran</label>
                                                    </div>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="status-payment-medical-prescription" class="d-none">
                                        <div class="form-group col-12">
                                            <label for="medical-consultation" class="text-trouth">Nominal Bayar Resep Obat</label>
                                            <input type="text" class="form-control py-4 text-bunting font-weight-bold" id="medical-consultation" value="RP.90.000" readonly>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="status-payment" class="text-trouth">Status Pembayaran</label>
                                            <input type="text" class="form-control py-4" id="status-payment" value="BELUM TERKONFIRMASI/ PROSES VERIFIKASI / TERKONFIRMASI / PEMBAYARAN TIDAK VALID / KADALUARSA" readonly>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="bankPayment" class="text-trouth">Bank Pembayaran</label>
                                            <select id="bankPayment" class="form-control" name="consultation_bank_payment" onchange="setBankPayment(this)">
                                                <option selected value="BCA">BCA ( Bank Central Asia )</option>
                                                <option selected value="BRI">BRI ( Bank Rakyat Indonesia )</option>
                                            </select>
                                            <div class="d-flex flex-column mt-5">
                                                <div class="d-flex flex-column flex-lg-row align-items-center">
                                                    <div class="col-12 col-md-5">
                                                        <img id="image-bank" src="{{ asset('/images/bca-logo.png') }}" alt="logo-bca" width="150">
                                                    </div>
                                                    <div id="information-bank" class="col-12 col-md-8">
                                                        <p id="number-bank" class="font-weight-bold text-trouth">NO. REK : 435793455</p>
                                                        <p id="name-account-bank" class="font-weight-bold text-trouth">RS. CITRA HUSADA JEMBER</p>
                                                    </div>
                                                </div>
                                                <div class="text-sm mt-4">
                                                    <p>Harap melakukan pembayaran sesuai nominal yang tertera.</p>
                                                    <p>Pembayaran berlaku sampai 
                                                        <span class="font-weight-bold">
                                                            4 - Februari - 2023 23:00:00.
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="input-group my-3">
                                                    <div class="custom-file">
                                                      <input type="file" class="custom-file-input" id="upload-proof-payment" aria-describedby="inputGroupFileAddon01">
                                                      <label class="custom-file-label" for="upload-proof-payment">Unggah bukti pembayaran</label>
                                                    </div>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="set-delivery-medical-prescription" class="">
                                        <div class="form-group col-12">
                                            <label for="medical-prescription" class="text-trouth">Nominal Bayar Resep Obat</label>
                                            <input type="text" class="form-control py-4 text-bunting font-weight-bold" id="medical-prescription" value="RP.90.000" readonly>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="status-payment" class="text-trouth">Status Pembayaran</label>
                                            <input type="text" class="form-control py-4" id="status-payment" value="BELUM TERKONFIRMASI/ PROSES VERIFIKASI / TERKONFIRMASI / PEMBAYARAN TIDAK VALID / KADALUARSA" readonly>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="bankPayment" class="text-trouth">Bank Pembayaran</label>
                                            <select id="bankPayment" class="form-control" name="consultation_bank_payment" onchange="setBankPayment(this)">
                                                <option selected value="BCA">BCA ( Bank Central Asia )</option>
                                                <option selected value="BRI">BRI ( Bank Rakyat Indonesia )</option>
                                            </select>
                                            <div class="d-flex flex-column mt-5">
                                                <div class="d-flex flex-column flex-lg-row align-items-center">
                                                    <div class="col-12 col-md-5">
                                                        <img id="image-bank" src="{{ asset('/images/bca-logo.png') }}" alt="logo-bca" width="150">
                                                    </div>
                                                    <div id="information-bank" class="col-12 col-md-8">
                                                        <p id="number-bank" class="font-weight-bold text-trouth">NO. REK : 435793455</p>
                                                        <p id="name-account-bank" class="font-weight-bold text-trouth">RS. CITRA HUSADA JEMBER</p>
                                                    </div>
                                                </div>
                                                <div class="text-sm mt-4">
                                                    <p>Harap melakukan pembayaran sesuai nominal yang tertera.</p>
                                                    <p>Pembayaran berlaku sampai 
                                                        <span class="font-weight-bold">
                                                            4 - Februari - 2023 23:00:00.
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="input-group my-3">
                                                    <div class="custom-file">
                                                      <input type="file" class="custom-file-input" id="upload-proof-payment" aria-describedby="inputGroupFileAddon01">
                                                      <label class="custom-file-label" for="upload-proof-payment">Unggah bukti pembayaran</label>
                                                    </div>
                                                  </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <div class="d-flex mt-5 flex-column align-items-end">
                            <button id="confirmation-payment" type="submit" class="btn btn-bunting text-white font-weight-bold py-2 mb-4">Selanjutnya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @slot('scripts')
        <script>
            setBankPayment(document.getElementById("bankPayment"));
            function setBankPayment(e) {
                const imageBank = document.getElementById("image-bank");
                const numberBank = document.getElementById("number-bank");
                const nameAccountBank = document.getElementById("name-account-bank");
                if(e.value == "BCA"){
                    imageBank.src = "/images/bca-logo.png";
                    numberBank.textContent = "NO. REK : 534534";
                    nameAccountBank.textContent = "RS. CITRA HUSADA JEMBER";
                }else if(e.value == "BRI"){
                    imageBank.src = "/images/bri-logo.png";
                    numberBank.textContent = "NO. REK : 8765453";
                    nameAccountBank.textContent = "RS. CITRA HUSADA JEMBER";
                }
            }
        </script>
    @endslot
</x-app-pacient>