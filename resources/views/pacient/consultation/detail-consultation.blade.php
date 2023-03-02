<x-app-pacient title="Detail Konsultasi">
    @slot('styles')
    <style>
<<<<<<< HEAD
        select,
        button {
            height: 50px !important;
        }

        #back-page-1 {
            display: none;
        }

        #back-page-2 {
            display: block;
        }

        #confirmation-payment {
            width: 100%;
        }

        iframe {
            height: 600px;
            border : none;
        }

        @media (min-width: 991.98px) {
            #back-page-1 {
                display: block;
            }

            #back-page-2 {
                display: none;
            }

            #confirmation-payment {
                width: 50%;
            }
        }
    </style>
    @endslot
    <div class="container wrapper-pacient my-5">
        <div class="card shadow-lg rounded-lg w-100 mx-auto">
            <div class="card-body">
                <div class="p-5 d-flex">
                    @if (!$live_consultation)
=======
        button,select{height:50px!important}#back-page-1{display:none}#back-page-2{display:block}#confirmation-payment{width:100%}iframe{height:600px;border:none}@media (min-width:991.98px){#back-page-1{display:block}#back-page-2{display:none}#confirmation-payment{width:50%}}
    </style>
    @endslot
    <div class="{{ $live_consultation ? "container-fluid p-3" : "container my-5" }} wrapper-pacient">
        <div class="card shadow-lg rounded-lg w-100 mx-auto">
            <div class="card-body">
                <div class="p-5 d-flex">
                    @if (!$live_consultation)   
>>>>>>> origin/backend
                        <a id="back-page-1" class="mr-3" href="/dashboard">
                            <svg role="button" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M38 24H10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M24 38L10 24L24 10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    @endif
                    <div class="w-100">
                        @if ($live_consultation)
                            <x-pacient-consultation.live-consultation>
                                <x-slot:id>
                                    {{ $id }}
                                </x-slot:id>
                                <x-slot:name_pacient>
                                    {{ $name_pacient }}
                                </x-slot:name_pacient>
                                <x-slot:doctor>
                                    {{ $doctor }}
                                </x-slot:doctor>
                                <x-slot:polyclinic>
                                    {{ $polyclinic }}
                                </x-slot:polyclinic>
                                <x-slot:end_consultation>
                                    {{ $end_consultation }}
                                </x-slot:end_consultation>
                            </x-pacient-consultation.live-consultation>
                        @else
                            <div class="detail-consultation">
                                <div class="d-flex align-items-center">
                                    <a id="back-page-2" class="mr-3" href="/dashboard">
                                        <svg role="button" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M38 24H10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M24 38L10 24L24 10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </a>
                                    <h1 class="font-weight-bold text-bunting text-xl">{{ $id }}</h1>
                                </div>
                                @if ($status == "confirmed-consultation-payment")
<<<<<<< HEAD
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
                                                    {{ $status_payment_consultation }}
                                                </x-slot:status_payment>
                                                <x-slot:valid_status>
                                                    {{ $valid_status }}
                                                </x-slot:valid_status>
                                                <x-slot:proof_payment_consultation>
                                                    {{ $proof_payment_consultation }}
                                                </x-slot:proof_payment_consultation>
                                            </x-pacient-consultation.status-payment-consultation>
                                            @elseif($status == "confirmed-consultation-payment")
                                            <x-pacient-consultation.confirmed-consultation-payment>
                                                <x-slot:price>
                                                    {{ $price_consultation }}
                                                </x-slot:price>
                                                <x-slot:status_payment>
                                                    {{ $status_payment_consultation }}
                                                </x-slot:status_payment>
                                                <x-slot:proof_payment_consultation>
                                                    {{ $proof_payment_consultation }}
                                                </x-slot:proof_payment_consultation>
                                            </x-pacient-consultation.confirmed-consultation-payment>
                                            @elseif($status == "waiting-medical-prescription-payment")
                                            <x-pacient-consultation.status-payment-medical-prescription>
                                                <x-slot:price>
                                                    {{ $price_medical_prescription }}
                                                </x-slot:price>
                                                <x-slot:status_payment>
                                                    {{ $status_payment_medical_prescription }}
                                                </x-slot:status_payment>
                                                <x-slot:valid_status>
                                                    {{ $valid_status }}
                                                </x-slot:valid_status>
                                                <x-slot:proof_payment_medical_prescription>
                                                    {{ $proof_payment_medical_prescription }}
                                                </x-slot:proof_payment_medical_prescription>
                                            </x-pacient-consultation.status-payment-medical-prescription>
                                            @elseif($status == "confirmed-medical-prescription-payment")
                                            <x-pacient-consultation.set-delivery-medical-prescription>
                                                <x-slot:id>{{ $id }}</x-slot:id>
                                            </x-pacient-consultation.set-delivery-medical-prescription>
                                            @elseif($status == "consultation-complete")
                                            <x-pacient-consultation.confirmed-consultation-and-confirmed-medical-prescription>
                                                <x-slot:id>{{ $id }}</x-slot:id>
                                                <x-slot:price_consultation>
                                                    {{ $price_consultation }}
                                                </x-slot:price_consultation>
                                                <x-slot:status_payment_consultation>
                                                    {{ $status_payment_consultation }}
                                                </x-slot:status_payment_consultation>
                                                <x-slot:proof_payment_consultation>
                                                    {{ $proof_payment_consultation }}
                                                </x-slot:proof_payment_consultation>
    
                                                <x-slot:price_medical_prescription>
                                                    {{ $price_medical_prescription }}
                                                </x-slot:price_medical_prescription>
                                                <x-slot:status_payment_medical_prescription>
                                                    {{ $status_payment_medical_prescription }}
                                                </x-slot:status_payment_medical_prescription>
                                                <x-slot:proof_payment_medical_prescription>
                                                    {{ $proof_payment_medical_prescription }}
                                                </x-slot:proof_payment_medical_prescription>
    
                                                <x-slot:pickup_medical_prescription>
                                                    {{ $pickup_medical_prescription }}
                                                </x-slot:pickup_medical_prescription>
                                                <x-slot:pickup_medical_status>
                                                    {{ $pickup_medical_status }}
                                                </x-slot:pickup_medical_status>
                                                <x-slot:pickup_medical_description>
                                                    {{ $pickup_medical_description }}
                                                </x-slot:pickup_medical_description>
                                                <x-slot:pickup_medical_no_telp_pacient>
                                                    {{ $pickup_medical_no_telp_pacient }}
                                                </x-slot:pickup_medical_no_telp_pacient>
                                                <x-slot:pickup_medical_addreass_pacient>
                                                    {{ $pickup_medical_addreass_pacient }}
                                                </x-slot:pickup_medical_addreass_pacient>
                                                <x-slot:pickup_by>
                                                    {{ $pickup_by_pacient }}
                                                </x-slot:pickup_by>
                                                <x-slot:pickup_datetime>
                                                    {{ $pickup_datetime }}
                                                </x-slot:pickup_datetime>
                                            </x-pacient-consultation.confirmed-consultation-and-confirmed-medical-prescription>
                                            @endif
                                        </div>
                                    </div>
                                </div>
=======
                                    <div class="alert alert-primary mt-3" role="alert">
                                        <p class="font-weight-bold mt-3 text-center">KONSULTASI ANDA AKAN DIMULAI PADA <u>{{ date("d - M - Y", $schedule) }} , {{ date("h : m : s", $start_consultation) }} - {{ date("h : m : s", $end_consultation) }} WIB</u></p>
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
                                                    <label for="consultation-schedule" class="text-trouth">Jadwal Konsultasi</label>
                                                    <input type="text" class="form-control py-4" id="consultation-schedule" value="{{ date("d - M - Y", $schedule) }} , {{ date("h : i : s", $start_consultation) }} - {{ date("h : i : s", $end_consultation) }} WIB" readonly>
                                                </div>
                                                @if ($status == "waiting-consultation-payment")
                                                    <x-pacient-consultation.status-payment-consultation
                                                        id="{{$id}}"
                                                        price="{{$price_consultation}}"
                                                        status="{{$status_payment_consultation}}"
                                                        proofPayment="{{$proof_payment_consultation}}"
                                                        validStatus="{{$valid_status}}"
                                                    />
                                                @elseif($status == "confirmed-consultation-payment") 
                                                    <x-pacient-consultation.confirmed-consultation-payment
                                                        price="{{$price_consultation}}"
                                                        status="{{$status_payment_consultation}}"
                                                        proofPayment="{{$proof_payment_consultation}}"
                                                    />
                                                @elseif($status == "waiting-medical-prescription-payment")
                                                    <x-pacient-consultation.status-payment-medical-prescription
                                                        id="{{$id}}"
                                                        price="{{$price_medical_prescription}}"
                                                        status="{{$status_payment_medical_prescription}}"
                                                        proofPayment="{{$proof_payment_medical_prescription}}"
                                                        validStatus="{{$valid_status}}"
                                                    />
                                                @elseif($status == "confirmed-medical-prescription-payment")
                                                    <x-pacient-consultation.set-delivery-medical-prescription
                                                      id="{{$id}}"
                                                      validStatus="{{$valid_status}}"

                                                      priceConsultation="{{$price_consultation}}"
                                                      statusConsultation="{{$status_payment_consultation}}"
                                                      proofPaymentConsultation="{{$proof_payment_consultation}}"

                                                      priceMedical="{{$price_medical_prescription}}"
                                                      statusMedical="{{$status_payment_medical_prescription}}"
                                                      proofPaymentMedical="{{$proof_payment_medical_prescription}}"
                                                    />
                                                @elseif($status == "consultation-complete")
                                                    <x-pacient-consultation.confirmed-consultation-and-confirmed-medical-prescription
                                                        id="{{$id}}"
                                                        priceConsultation="{{$price_consultation}}"
                                                        statusPaymentConsultation="{{$status_payment_consultation}}"
                                                        proofPaymentConsultation="{{$proof_payment_consultation}}"

                                                        priceMedicalPrescription="{{$price_medical_prescription}}"
                                                        statusPaymentMedicalPrescription="{{$status_payment_medical_prescription}}"
                                                        proofPaymentMedicalPrescription="{{$proof_payment_medical_prescription}}"
                                                        
                                                        pickupMedicalPrescription="{{$pickup_medical_prescription}}"
                                                        pickupMedicalStatus="{{$pickup_medical_status}}"
                                                        pickupMedicalDescription="{{$pickup_medical_description}}"
                                                        pickupMedicalPhoneNumberPacient="{{$pickup_medical_no_telp_pacient}}"
                                                        pickupMedicalAddreassPacient="{{$pickup_medical_addreass_pacient}}"
                                                        pickupByPacient="{{$pickup_by_pacient}}"
                                                        pickupDatetime="{{$pickup_datetime}}"
                                                    />
                                                @endif
                                            </div>
                                        </div>
                                    </div>
>>>>>>> origin/backend
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @slot('scripts')
    <script>
<<<<<<< HEAD
        moment.locale();
        function setBankPayment(e) {
            const imageBank = document.getElementById("image-bank");
            const numberBank = document.getElementById("number-bank");
            const nameAccountBank = document.getElementById("name-account-bank");
            if (e.value == "BCA") {
                imageBank.src = "/images/bca-logo.png";
                numberBank.textContent = "NO. REK : 534534";
                nameAccountBank.textContent = "RS. CITRA HUSADA JEMBER";
            } else if (e.value == "BRI") {
                imageBank.src = "/images/bri-logo.png";
                numberBank.textContent = "NO. REK : 8765453";
                nameAccountBank.textContent = "RS. CITRA HUSADA JEMBER";
            }
        }

        function setFileNameUpload(e) {
            const buttonSendProof = document.getElementById("confirmation-payment");
            const labelInputFile = document.getElementById("label-upload-proof-payment");
            labelInputFile.textContent = e.files[0].name;
            buttonSendProof.disabled = false;
        }

        function setDeliveryMedicalPrescription(e) {
            const hospitalPharmacy = document.getElementById("hostipal-pharmacy");
            const deliveryGojek = document.getElementById("delivery-gojek");
            const PacientInputNoTelp = document.getElementById("pacient-notelp");
            const PacientInputAddreass = document.getElementById("pacient-addreass");
            if (e.value == "hospital-pharmacy") {
                hospitalPharmacy.classList.remove("d-none");
                hospitalPharmacy.classList.add("d-block");
                deliveryGojek.classList.remove("d-block");
                deliveryGojek.classList.add("d-none");
                PacientInputNoTelp.value = "-";
                PacientInputAddreass.value = "-";
            } else {
                hospitalPharmacy.classList.remove("d-block");
                hospitalPharmacy.classList.add("d-none");
                deliveryGojek.classList.remove("d-none");
                deliveryGojek.classList.add("d-block");
                PacientInputNoTelp.value = "";
                PacientInputAddreass.value = "";
            }
        }
        function setEndTime(time) {
            const timeReaming = document.getElementById("timetime_remaining");
            // time now (milisecond)  to epoch (second)
            const timeNow = Math.round(Date.now() / 1000);
            if(time > timeNow){
                setInterval(() => {
                    // convert timestamp milisecond to second
                    const endTime = new Date(time * 1000).getTime();
                    const distance = endTime - new Date().getTime();

                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    
                    if(distance < 0){
                        location.reload();
                    }else{
                        timeReaming.textContent = hours + " Jam : " + minutes + " Menit : " + seconds + " Detik";
                    }
                }, 1000);
            }else{
                window.location.href = "/dashboard"
            }
        }
=======
        function setBankPayment(e){let t=document.getElementById("image-bank"),n=document.getElementById("number-bank"),a=document.getElementById("name-account-bank");for(let l=0;l<e.children.length;l++)e.value==e.children[l].value&&(t.src=`/images/${e.children[l].getAttribute("data-image")}`,n.textContent=e.children[l].getAttribute("data-no-card"),a.textContent=e.children[l].getAttribute("data-name-card"))}function setFileNameUpload(e){let t=document.getElementById("confirmation-payment"),n=document.getElementById("label-upload-proof-payment");n.textContent=e.files[0].name,t.disabled=!1}function setDeliveryMedicalPrescription(e){let t=document.getElementById("hostipal-pharmacy"),n=document.getElementById("delivery-gojek"),a=document.getElementById("pacient-notelp"),l=document.getElementById("pacient-addreass");"hospital-pharmacy"==e.value?(t.classList.remove("d-none"),t.classList.add("d-block"),n.classList.remove("d-block"),n.classList.add("d-none"),a.value="-",l.value="-"):(t.classList.remove("d-block"),t.classList.add("d-none"),n.classList.remove("d-none"),n.classList.add("d-block"),a.value="",l.value="")}function setEndTime(e){let t=document.getElementById("timetime_remaining"),n=Math.round(Date.now()/1e3);e>n?setInterval(()=>{let n=new Date(1e3*e).getTime(),a=n-new Date().getTime();a<0?location.reload():t.textContent=Math.floor(a%864e5/36e5)+" Jam : "+Math.floor(a%36e5/6e4)+" Menit : "+Math.floor(a%6e4/1e3)+" Detik"},1e3):window.location.href="/dashboard"}
>>>>>>> origin/backend
    </script>
    @endslot
</x-app-pacient>