<form action="" enctype="multipart/form-data" method="post">
    @csrf
    <div id="status-payment-consultation">
        <input type="text" class="d-none" name="state-payment" value="consultations">
        <div class="form-group col-12">
            <label for="price-consultation" class="text-trouth">Nominal Bayar Konsultasi</label>
            <input type="text" class="form-control py-4 text-bunting font-weight-bold" id="price-consultation" value="{{ $price }}" readonly>
        </div>
        <div class="form-group col-12">
            <label for="status-payment" class="text-trouth">Status Pembayaran</label>
            <input type="text" class="form-control py-4" id="status-payment" value="{{ $status_payment }}" readonly>
        </div>
        @if ($status_payment == "BELUM TERKONFIRMASI" || $status_payment == "PEMBAYARAN TIDAK VALID")
            @if ($status_payment == "PEMBAYARAN TIDAK VALID")
                <div class="alert alert-danger" role="alert">
                    <p class="font-weight-bold">
                        BUKTI PEMBAYARAN ANDA TIDAK SAH, HARAP UNGGAH ULANG BUKTI PEMBAYARAN
                    </p>
                    <a href="{{ $proof_payment_consultation }}" target="_blank">CEK BUKTI PEMBAYARAN</a>
                </div>              
            @endif
            <div class="form-group col-12">
                <label for="bankPayment" class="text-trouth">Bank Pembayaran</label>
                <select id="bankPayment" class="form-control" name="bank-payment" onchange="setBankPayment(this)">
                    <option selected value="BCA" selected>BCA ( Bank Central Asia )</option>
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
                                {{ $valid_status }}
                            </span>
                        </p>
                    </div>
                    <div class="input-group my-3">
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" id="upload-proof-payment" aria-describedby="inputGroupFileAddon" name="upload-proof-payment" onchange="setFileNameUpload(this)">
                        <label class="custom-file-label" id="label-upload-proof-payment" for="upload-proof-payment">Unggah bukti pembayaran</label>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($status_payment == "PROSES VERIFIKASI")
            <div class="form-group col-12 d-flex flex-column">
                <a href="{{ $proof_payment_consultation }}" target="_blank">CEK BUKTI PEMBAYARAN</a>
                <small class="mt-2">Harap cek secara berkala untuk mengetahui status pembayaran.</small>
            </div>
        @endif
    </div>
    @if ($status_payment != "PROSES VERIFIKASI")
        <div class="d-flex mt-5 flex-column align-items-end">
            <button id="confirmation-payment" type="submit" class="btn btn-bunting text-white font-weight-bold py-2 mb-4 w-100" disabled>Kirim Bukti Pembayaran</button>
        </div>
    @endif
</form>