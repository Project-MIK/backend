<div id="set-delivery-medical-prescription">
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