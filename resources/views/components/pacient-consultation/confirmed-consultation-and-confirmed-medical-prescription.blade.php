<div class="px-2">
<<<<<<< HEAD
    <div class="form-row">
        <div class="form-group col-12">
            <label for="status-payment" class="text-trouth">Konsultasi</label>
        </div>
        <div class="form-group col-12 col-lg-6">
            <label for="price-consultation" class="text-trouth font-weight-normal">Nominal Pembayaran</label>
            <input type="text" class="form-control py-4 font-weight-bold text-bunting" id="price-consultation" value="{{ $price_consultation }}" readonly>
        </div>
        <div class="form-group col-12 col-lg-6">
            <label for="status-payment-consultation" class="text-trouth font-weight-normal">Status Pembayaran</label>
            <input type="text" class="form-control py-4" id="status-payment-consultation" value="{{ $status_payment_consultation }}" readonly>
        </div>
        <div class="form-group col-12 text-right">
            <a href="{{ $proof_payment_consultation }}" target="_blank">CEK BUKTI PEMBAYARAN</a>
        </div>
    </div>
    @if ($price_medical_prescription != "")
    <div class="form-row">
        <div class="form-group col-12">
            <label for="status-payment" class="text-trouth">Resep Obat</label>
        </div>
        <div class="form-group col-12 col-lg-6">
            <label for="price-medical-prescription" class="text-trouth font-weight-normal">Nominal Pembayaran</label>
            <input type="text" class="form-control py-4 font-weight-bold text-bunting" id="price-medical-prescription" value="{{ $price_medical_prescription }}" readonly>
        </div>
        <div class="form-group col-12 col-lg-6">
            <label for="status-payment-medical-prescription" class="text-trouth font-weight-normal">Status Pembayaran</label>
            <input type="text" class="form-control py-4" id="status-payment-medical-prescription" value="{{ $status_payment_medical_prescription }}" readonly>
        </div>
        <div class="form-group col-12 text-right">
            <a href="{{ $proof_payment_medical_prescription }}" target="_blank">CEK BUKTI PEMBAYARAN</a>
        </div>
        <div class="form-group col-12">
            <label for="status-payment" class="text-trouth font-weight-normal">Status Pengambilan / Penerimaan Obat</label>
            <input type="text" class="form-control py-4" id="status-payment" value="{{ $pickup_medical_status }}" readonly>
        </div>
        @if ($pickup_medical_status != "SUDAH DIAMBIL")
            @if ($pickup_medical_prescription == "hospital-pharmacy")
                <div class="form-group mt-2">
                    <div class="col-12 d-flex flex-column mb-4">
                        <label class="text-trouth">Dokumen Pengambilan Obat</label>
                        <a href="" target="_blank" class="mb-2">CETAK DOKUMEN PENGAMBILAN OBAT</a>
                        <small>( Dokumen ini berguna sebagai syarat pengambilan obat )</small>
                    </div>
                    <div class="col-12">
                        <label class="text-trouth">Alamat Pengambilan</label>
                        <p>Jl. Teratai No.22, Gebang Timur, Gebang, Kec. Patrang, Kabupaten Jember, Jawa Timur 68117</p>
                        <a href="https://goo.gl/maps/53QjrwLKXPhQzccf8" target="_blank">LIHAT LOKASI</a>
                    </div>
                </div>
            @else
                <div class="col-12">
                    <label for="pacient-notelp" class="text-trouth">Nomor Telepon</label>
                    <input type="text" class="form-control py-4" id="pacient-notelp" name="pacient-notelp" value="{{ $pickup_medical_no_telp_pacient }}" readonly>
                    
                    <label for="pacient-addreass" class="text-trouth mt-3">Alamat Anda</label>
                    <input type="text" class="form-control py-4" id="pacient-addreass" name="pacient-addreass" value="{{ $pickup_medical_addreass_pacient }}" readonly>
                </div>
                @if ($pickup_medical_status == "GAGAL DIKIRIM")
                    <div class="alert alert-danger mt-3 col-12 p-4 d-flex flex-column" role="alert">
                        <p>{{ $pickup_medical_description }}</p>
                        <b>Silakan anda dapat mengambil obat secara mandiri di Rumah Sakit Citra Husada Jember.</b>
                    </div>    
                @endif
            @endif  
        @else
            <div class="col-12 text-trouth mt-3">
                <p>Obat sudah diambil oleh <strong>{{ strtoupper($pickup_by) }}</strong> pada <strong>{{ $pickup_datetime }}</strong> di Apotek Rumah Sakit Citra Husada Jember.</p>
            </div>
        @endif
    </div>
    @endif
=======
    @if ($statusPaymentConsultation != "DIBATALKAN") 
        <div class="form-row">
            <div class="form-group col-12">
                <label for="status-payment" class="text-trouth">Biaya Konsultasi</label>
            </div>
            <div class="form-group col-12 col-lg-6">
                <label for="price-consultation" class="text-trouth font-weight-normal">Nominal Pembayaran</label>
                <input type="text" class="form-control py-4 font-weight-bold text-bunting" id="price-consultation" value="{{ $priceConsultation }}" readonly>
            </div>
            <div class="form-group col-12 col-lg-6">
                <label for="status-payment-consultation" class="text-trouth font-weight-normal">Status Pembayaran</label>
                <input type="text" class="form-control py-4" id="status-payment-consultation" value="{{ $statusPaymentConsultation }}" readonly>
            </div>
            <div class="form-group col-12 text-right">
                <a href="{{ $proofPaymentConsultation }}" target="_blank">CEK BUKTI PEMBAYARAN</a>
            </div>
        </div>
        @if ($statusPaymentMedicalPrescription != "DIBATALKAN")
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="status-payment" class="text-trouth">Pembelian Obat</label>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <label for="price-medical-prescription" class="text-trouth font-weight-normal">Nominal Pembayaran</label>
                    <input type="text" class="form-control py-4 font-weight-bold text-bunting" id="price-medical-prescription" value="{{ $priceMedicalPrescription }}" readonly>
                </div>
                <div class="form-group col-12 col-lg-6">
                    <label for="status-payment-medical-prescription" class="text-trouth font-weight-normal">Status Pembayaran</label>
                    <input type="text" class="form-control py-4" id="status-payment-medical-prescription" value="{{ $statusPaymentMedicalPrescription }}" readonly>
                </div>
                <div class="form-group col-12 text-right">
                    <a href="{{ $proofPaymentMedicalPrescription }}" target="_blank">CEK BUKTI PEMBAYARAN</a>
                </div>
                <div class="form-group col-12">
                    <label for="status-payment" class="text-trouth font-weight-normal">Status Pengambilan / Penerimaan Obat</label>
                    <input type="text" class="form-control py-4" id="status-payment" value="{{ $pickupMedicalStatus }}" readonly>
                </div>
                @if ($pickupMedicalStatus != "SUDAH DIAMBIL")
                    @if ($pickupMedicalPrescription == "hospital-pharmacy")
                        <div class="form-group mt-2">
                            <div class="col-12 d-flex flex-column mb-4">
                                <label class="text-trouth">Dokumen Pengambilan Obat</label>
                                <a href="/konsultasi/{{$id}}/export" target="_blank" class="mb-2">CETAK DOKUMEN PENGAMBILAN OBAT</a>
                                <small>( Dokumen ini berguna sebagai syarat pengambilan obat )</small>
                            </div>
                            <div class="col-12">
                                <label class="text-trouth">Alamat Pengambilan</label>
                                <p>Jl. Teratai No.22, Gebang Timur, Gebang, Kec. Patrang, Kabupaten Jember, Jawa Timur 68117</p>
                                <a href="https://goo.gl/maps/53QjrwLKXPhQzccf8" target="_blank">LIHAT LOKASI</a>
                            </div>
                        </div>
                    @else
                        <div class="col-12">
                            <label for="pacient-notelp" class="text-trouth">Nomor Telepon</label>
                            <input type="text" class="form-control py-4" id="pacient-notelp" name="pacient-notelp" value="{{ $pickupMedicalPhoneNumberPacient }}" readonly>
                            
                            <label for="pacient-addreass" class="text-trouth mt-3">Alamat Anda</label>
                            <input type="text" class="form-control py-4" id="pacient-addreass" name="pacient-addreass" value="{{ $pickupMedicalAddreassPacient }}" readonly>
                        </div>
                        @if ($pickupMedicalStatus == "GAGAL DIKIRIM")
                            <div class="alert alert-danger mt-3 col-12 p-4 d-flex flex-column" role="alert">
                                <p>{{ $pickupMedicalDescription }}</p>
                                <b>Silakan anda dapat mengambil obat secara mandiri di Rumah Sakit Citra Husada Jember.</b>
                            </div>    
                        @endif
                    @endif  
                @else
                    <div class="col-12 text-trouth mt-3">
                        <p>Obat sudah diambil oleh <strong>{{ strtoupper($pickupByPacient) }}</strong> pada <strong>{{ $pickupDatetime }}</strong> di Apotek Rumah Sakit Citra Husada Jember.</p>
                    </div>
                @endif
            </div>
        @else
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="status-payment" class="text-trouth">Status Pembelian Obat</label>
                    <div class="alert alert-info font-weight-bold">
                        {{$statusPaymentMedicalPrescription}}
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="form-row">
            <div class="form-group col-12">
                <label for="status-payment" class="text-trouth">Status Konsultasi</label>
                <div class="alert alert-info font-weight-bold">
                    {{$statusPaymentConsultation}}
                </div>
            </div>
        </div>
    @endif

>>>>>>> origin/backend
</div>