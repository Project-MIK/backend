<x-app-pacient title="Detail Konsultasi">
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
                    <div class="w-100">
                        <div class="d-flex align-items-center">
                            <a id="back-page-2" class="mr-3" href="/dashboard">
                                <svg role="button" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M38 24H10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M24 38L10 24L24 10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <h1 class="font-weight-bold text-bunting text-xl">{{ $id }}</h1>
                        </div>
                        @if ($status == "confirmed-consultation-payment")
                            <div class="alert alert-primary mt-3" role="alert">
                                <p class="font-weight-bold mt-3 text-center">KONSULTASI ANDA AKAN DIMULAI PADA <u>{{ $schedule }} WIB</u></p>
                            </div>                          
                        @endif
                        <div class="mt-4">
                            <div class="d-flex flex-column flex-lg-row">
                                <div class="col-12 col-lg-6">
                                    <div class="form-group col-12">
                                        <label for="complaint" class="text-trouth">Keluhan</label>
                                        <textarea class="form-control" id="complaint" cols="30" rows="5" readonly>{{ $description }}</textarea>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="polyclinic" class="text-trouth">Kategori</label>
                                        <input type="text" class="form-control py-4" id="polyclinic" value="{{ $category }}" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-group col-12">
                                        <label for="polyclinic" class="text-trouth">Poliklinik</label>
                                        <input type="text" class="form-control py-4" id="polyclinic" value="{{ $polyclinic }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="doctor" class="text-trouth">Dokter</label>
                                        <input type="text" class="form-control py-4" id="doctor" value="{{ $doctor }}" readonly>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="consultation-schedule" class="text-trouth">Jadwal Konsultasi <span class="font-weight-light">( WIB )</span></label>
                                        <input type="text" class="form-control py-4" id="consultation-schedule" value="{{ $schedule }}" readonly>
                                    </div>
                                    @if ($status == "waiting-consultation-payment")
                                        <x-pacient-consultation.status-payment-consultation>
                                            <x-slot:price>
                                                {{ $price_consultation }}
                                            </x-slot:price>
                                            <x-slot:status_payment>
                                                {{ $status_payment }}
                                            </x-slot:status_payment>
                                            <x-slot:valid_status>
                                                {{ $valid_status }}
                                            </x-slot:valid_status>
                                            <x-slot:consultation_proof_payment>
                                                {{ $consultation_proof_payment }}
                                            </x-slot:consultation_proof_payment>
                                        </x-pacient-consultation.status-payment-consultation>
                                    @elseif($status == "confirmed-consultation-payment")
                                        <x-pacient-consultation.confirmed-consultation-payment>
                                            <x-slot:price>
                                                {{ $price_consultation }}
                                            </x-slot:price>
                                            <x-slot:status_payment>
                                                {{ $status_payment }}
                                            </x-slot:status_payment>
                                            <x-slot:consultation_proof_payment>
                                                {{ $consultation_proof_payment }}
                                            </x-slot:consultation_proof_payment>
                                        </x-pacient-consultation.confirmed-consultation-payment>
                                    @elseif($status == "waiting-medical-prescription-payment")
                                        <x-pacient-consultation.status-payment-medical-prescription/>
                                    @elseif($status == "confirmed-medical-prescription-payment")
                                        <x-pacient-consultation.set-delivery-medical-prescription/>
                                    @elseif($status == "consultation-complete")
                                        <p>Consultasi telah berakhir</p>
                                    @endif
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
            function setFileNameUpload(e) {
                const labelInputFile = document.getElementById("label-upload-proof-payment");
                labelInputFile.textContent = e.files[0].name;
            }
        </script>
    @endslot
</x-app-pacient>