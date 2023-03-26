<div class="modal fade" id="modalCancelMedicalPrescription" tabindex="-1" aria-labelledby="modalCancelMedicalPrescriptionTitle" aria-hidden="true">
    <form action="/konsultasi/{{$id}}/cancel-medical-prescription" method="POST" class="modal-dialog">
        @csrf
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-trouth font-weight-bold" id="modalCancelMedicalPrescriptionTitle">Batalkan Pembalian Obat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p class="text-trouth">Setelah anda membatalkan pembelian obat, maka pembelian obat tidak dapat dilakukan lagi</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-bunting text-white">Ya, Batalkan Pembalian</button>
        </div>
        </div>
    </form>
</div>  
<form action="/konsultasi/{{$id}}/payment-medical-prescription" enctype="multipart/form-data" method="post">
    @csrf
    <div id="status-payment-consultation">
        <input type="text" class="d-none" name="state-payment" value="medical-prescription">
        <div class="form-group col-12">
            <label for="price-consultation" class="text-trouth">Nominal Bayar Obat</label>
            <input type="text" class="form-control py-4 text-bunting font-weight-bold" id="price-consultation" value="{{ $price }}" readonly>
        </div>
        @if ($validStatus > time() || $status == "PROSES VERIFIKASI")    
        <div class="form-group col-12">
            <label for="status-payment" class="text-trouth">Status Pembayaran</label>
            <input type="text" class="form-control py-4" id="status-payment" value="{{ $status }}" readonly>
        </div>
            @if ($status == "BELUM TERKONFIRMASI" || $status == "PEMBAYARAN TIDAK VALID")
                @if ($status == "PEMBAYARAN TIDAK VALID")
                    <div class="alert alert-danger" role="alert">
                        <p class="font-weight-bold">
                            BUKTI PEMBAYARAN ANDA TIDAK SAH, HARAP UNGGAH ULANG BUKTI PEMBAYARAN
                        </p>
                        <a href="{{ $proofPayment }}" target="_blank">CEK BUKTI PEMBAYARAN</a>
                    </div>              
                @endif
                <div class="form-group col-12">
                    @if($errors->any())                   
                        <div class="alert alert-danger" role="alert">
                            {{$errors->all()->first()}}
                        </div>
                    @endif   
                    <label for="bankPayment" class="text-trouth">Bank Pembayaran</label>
                    <select id="bankPayment" class="form-control" name="bank-payment" onchange="setBankPayment(this)">
                        @foreach ($banks as $bank)
                        <option
                            value="{{$bank['id']}}"
                            data-no-card="{{$bank['no_card']}}"
                            data-name-card="{{$bank['name_card']}}"
                            data-image="{{$bank['image']}}"
                        >
                            {{$bank['name']}}
                        </option>
                        @endforeach
                    </select>
                    <div class="d-flex flex-column mt-5">
                        <div class="d-flex flex-column flex-lg-row align-items-center">
                            <div class="col-12 col-md-5">
                                <img id="image-bank" src="/images/{{$banks[0]['image']}}" alt="logo-bank" width="150">
                            </div>
                            <div id="information-bank" class="col-12 col-md-8">
                                <p id="number-bank" class="font-weight-bold text-trouth">{{$banks[0]['no_card']}}</p>
                                <p id="name-account-bank" class="font-weight-bold text-trouth">{{$banks[0]['name_card']}}</p>
                            </div>
                        </div>
                        <div class="text-sm mt-4">
                            <p>Harap melakukan pembayaran sesuai nominal yang tertera.</p>
                            <p>Pembayaran berlaku sampai 
                                <span class="font-weight-bold">
                                    {{  date("d-M-Y h:i:s", $validStatus) }} WIB
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
            @elseif($status == "PROSES VERIFIKASI")
                <div class="form-group col-12 d-flex flex-column">
                    <a href="{{ $proofPayment }}" target="_blank">CEK BUKTI PEMBAYARAN</a>
                    <small class="mt-2">Harap cek secara berkala untuk mengetahui status pembayaran.</small>
                </div>
            @endif
        @else
            <div class="form-group col-12">
                <div class="alert alert-danger">
                    Pembayaran obat telah melebihi batas waktu <strong>{{date("d-M-Y h:i:s", $validStatus)}} WIB</strong>, pembelian obat tidak dapat diulang kembali dan konsultasi dianggap selesai.
                </div>
            </div>
        @endif
    </div>
    @if ($validStatus > time())    
        @if ($status != "PROSES VERIFIKASI")
            <div class="d-flex mt-5 flex-column align-items-end">
                <button id="confirmation-payment" type="submit" class="btn btn-bunting text-white font-weight-bold py-2 mb-4 w-100" disabled>Kirim Bukti Pembayaran</button>
                <button id="cancel-consultation" type="button" data-toggle="modal" data-target="#modalCancelMedicalPrescription" class="btn btn-danger text-white font-weight-bold py-2 mb-4 w-100">Batalkan Pembelian Obat</button>
            </div>
        @endif
    @endif
</form>