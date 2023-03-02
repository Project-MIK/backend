<<<<<<< HEAD
<!-- Modal -->
<div class="modal fade" id="cancelPickup" tabindex="-1" role="dialog" aria-labelledby="modalTitleCancelPickup" aria-hidden="true">
    <form method="POST" action="/konsultasi/{{ $id }}/cancel-pickup" class="modal-dialog modal-lg">
        @csrf
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title font-weight-bold text-trouth" id="modalTitleCancelPickup">Batal Menerima Obat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-trouth">
            <p>Anda dapat membatalkan penerimaan obat, tetapi pembayaran obat tidak dapat dikembalikan namun obat masih dapat anda ambil pada Apotek Rumah Sakit Citra Husada Jember dengan menyertakan bukti pembayaran obat.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-bunting text-white">Ya, Batal Menerima</button>
        </div>
        </div>
    </form>
</div>
<form action="/konsultasi/{{ $id }}/pickup-delivery" method="POST" class="form-group col-12">
    @csrf
    <label for="delivery-medical-prescription" class="text-trouth">Opsi Pengiriman Obat</label>
    <select id="delivery-medical-prescription" class="form-control" name="pickup-medical-prescription" onchange="setDeliveryMedicalPrescription(this)">
        <option selected value="hospital-pharmacy" selected>Ambil di Apotek RS. Citra Husada Jember</option>
        <option selected value="delivery-gojek">Dikirim / Delivery menggunakan GOJEK</option>
    </select>
    <div class="d-flex flex-column mt-4">
        <div id="hostipal-pharmacy" class="d-block">
            <div class="d-flex flex-column mb-4">
                <label class="text-trouth">Dokumen Pengambilan Obat</label>
                <a href="" target="_blank" class="mb-2">CETAK DOKUMEN PENGAMBILAN OBAT</a>
                <small>( Dokumen ini berguna sebagai syarat pengambilan obat )</small>
            </div>
            <div>
                <label class="text-trouth">Alamat Pengambilan</label>
                <p>Jl. Teratai No.22, Gebang Timur, Gebang, Kec. Patrang, Kabupaten Jember, Jawa Timur 68117</p>
                <a href="https://goo.gl/maps/53QjrwLKXPhQzccf8" target="_blank">LIHAT LOKASI</a>
            </div>
        </div>
        <div id="delivery-gojek" class="d-none">
            <div class="text-sm">
                <p>Biaya pengiriman menggunakan jasa GOJEK akan dibebankan kepada pasien.</p>
            </div>
            <label for="pacient_addreass" class="text-trouth">Nomor Telepon</label>
            <input type="text" class="form-control py-4" id="pacient-notelp" name="pacient-notelp" placeholder="Ketikkan alamat pengiriman" value="-" oninput="numberOnly(this)" required>
            
            <label for="pacient_addreass" class="text-trouth mt-3">Alamat Anda</label>
            <input type="text" class="form-control py-4" id="pacient-addreass" name="pacient-addreass" placeholder="Ketikkan alamat pengiriman" value="-" required>
        </div>
    </div>
    <div class="text-sm mt-4">
        <p><u>Setelah mengkonfirmasi, opsi pengiriman tidak dapat dirubah.</u></p>
    </div>
    <div class="d-flex mt-4 flex-column align-items-end">
        <button id="confirmation-pickup" type="submit" class="btn btn-bunting text-white font-weight-bold py-2 mb-4 w-100">Konfirmasi Pengambilan Obat</button>
        <button type="button" class="btn btn-danger w-100 font-weight-bold" data-toggle="modal" data-target="#cancelPickup">Batal Menerima Obat</button>
    </div>
</form>
=======
@if ($validStatus > time())
    <!-- Modal -->
    <div class="modal fade" id="cancelPickup" tabindex="-1" role="dialog" aria-labelledby="modalTitleCancelPickup" aria-hidden="true">
        <form method="POST" action="/konsultasi/{{ $id }}/cancel-pickup" class="modal-dialog modal-lg">
            @csrf
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-trouth" id="modalTitleCancelPickup">Batal Menerima Obat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-trouth">
                <p>Anda dapat membatalkan penerimaan obat, tetapi pembayaran obat tidak dapat dikembalikan dan pengambilan obat dianggap selesai</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-bunting text-white">Ya, Batal Menerima</button>
            </div>
            </div>
        </form>
    </div>
    <div class="col-12">
        <div class="alert alert-info text-sm mt-4">
            Harap mengkonfirmasi pengambilan obat sampai 
                <span class="font-weight-bold">
                    {{  date("d-M-Y h:i:s", $validStatus) }} WIB
                </span>
            . Jika melebihi batas waktu , maka pengambilan obat dianggap selesai.
        </div>
    </div>
    <form action="/konsultasi/{{ $id }}/pickup-delivery" method="POST" class="form-group col-12">
        @csrf
        <label for="delivery-medical-prescription" class="text-trouth">Opsi Pengiriman Obat</label>
        <select id="delivery-medical-prescription" class="form-control" name="pickup-medical-prescription" onchange="setDeliveryMedicalPrescription(this)" autocomplete="off">
            <option value="hospital-pharmacy" selected>Ambil di Apotek RS. Citra Husada Jember</option>
            <option value="delivery-gojek">Dikirim / Delivery menggunakan GOJEK</option>
        </select>
        <div class="d-flex flex-column mt-4">
            <div id="hostipal-pharmacy" class="d-block">
                <div class="d-flex flex-column mb-4">
                    <label class="text-trouth">Dokumen Pengambilan Obat</label>
                    <a href="/konsultasi/{{$id}}/export" target="_blank" class="mb-2">CETAK DOKUMEN PENGAMBILAN OBAT</a>
                    <small>( Dokumen ini berguna sebagai syarat pengambilan obat )</small>
                </div>
                <div>
                    <label class="text-trouth">Alamat Pengambilan</label>
                    <p>Jl. Teratai No.22, Gebang Timur, Gebang, Kec. Patrang, Kabupaten Jember, Jawa Timur 68117</p>
                    <a href="https://goo.gl/maps/53QjrwLKXPhQzccf8" target="_blank">LIHAT LOKASI</a>
                </div>
            </div>
            <div id="delivery-gojek" class="d-none">
                <div class="text-sm">
                    <p>Biaya pengiriman menggunakan jasa GOJEK akan dibebankan kepada pasien.</p>
                </div>
                <label for="pacient_addreass" class="text-trouth">Nomor Telepon</label>
                <input type="text" class="form-control py-4" id="pacient-notelp" name="pacient-notelp" placeholder="Ketikkan alamat pengiriman" value="-" oninput="numberOnly(this)" required>
                
                <label for="pacient_addreass" class="text-trouth mt-3">Alamat Anda</label>
                <input type="text" class="form-control py-4" id="pacient-addreass" name="pacient-addreass" placeholder="Ketikkan alamat pengiriman" value="-" required>
            </div>
        </div>
        <div class="text-sm mt-4">
            <p><u>Setelah mengkonfirmasi, opsi pengiriman tidak dapat dirubah.</u></p>
        </div>
        <div class="d-flex mt-4 flex-column align-items-end">
            <button id="confirmation-pickup" type="submit" class="btn btn-bunting text-white font-weight-bold py-2 mb-4 w-100">Konfirmasi Pengambilan Obat</button>
            <button type="button" class="btn btn-danger w-100 font-weight-bold" data-toggle="modal" data-target="#cancelPickup">Batal Menerima Obat</button>
        </div>
    </form>
@else
    <div class="form-row col-12">
        <div class="form-group col-12">
            <label for="status-payment" class="text-trouth">Biaya Konsultasi</label>
        </div>
        <div class="form-group col-12 col-lg-6">
            <label for="price-consultation" class="text-trouth font-weight-normal">Nominal Pembayaran</label>
            <input type="text" class="form-control py-4 font-weight-bold text-bunting" id="price-consultation" value="{{$priceConsultation}}" readonly>
        </div>
        <div class="form-group col-12 col-lg-6">
            <label for="status-payment-consultation" class="text-trouth font-weight-normal">Status Pembayaran</label>
            <input type="text" class="form-control py-4" id="status-payment-consultation" value="{{$statusConsultation}}" readonly>
        </div>
        <div class="form-group col-12 text-right">
            <a href="{{$proofPaymentConsultation}}" target="_blank">CEK BUKTI PEMBAYARAN</a>
        </div>
    </div>
    <div class="form-row col-12">
        <div class="form-group col-12">
            <label for="status-payment" class="text-trouth">Biaya Pembelian Obat</label>
        </div>
        <div class="form-group col-12 col-lg-6">
            <label for="price-medical-prescription" class="text-trouth font-weight-normal">Nominal Pembayaran</label>
            <input type="text" class="form-control py-4 font-weight-bold text-bunting" id="price-medical-prescription" value="{{$priceMedical}}" readonly>
        </div>
        <div class="form-group col-12 col-lg-6">
            <label for="status-payment-medical-prescription" class="text-trouth font-weight-normal">Status Pembayaran</label>
            <input type="text" class="form-control py-4" id="status-payment-medical-prescription" value="{{$statusMedical}}" readonly>
        </div>
        <div class="form-group col-12 text-right">
            <a href="{{$proofPaymentMedical}}" target="_blank">CEK BUKTI PEMBAYARAN</a>
        </div>
    </div>
    <div class="col-12">
        <div class="alert alert-info text-sm mt-4">
            Konfirmasi pengambilan obat telah melebihi batas waktu
                <span class="font-weight-bold">
                    {{  date("d-M-Y h:i:s", $validStatus) }} WIB
                </span>
            . Obat tidak dapat diambil serta pembayaran tidak dapat dikembalikan dan penyerahan obat dianggap selesai.
        </div>
    </div>
@endif
>>>>>>> origin/backend
