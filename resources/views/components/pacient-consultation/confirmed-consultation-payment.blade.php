<div class="form-group col-12">
    <label for="price-consultation" class="text-trouth">Nominal Bayar Konsultasi</label>
    <input type="text" class="form-control py-4 text-bunting font-weight-bold" id="price-consultation" value="{{ $price }}" readonly>
</div>
<div class="form-group col-12">
    <label for="status-payment" class="text-trouth">Status Pembayaran</label>
    <input type="text" class="form-control py-4 mb-3" id="status-payment" value="{{ $status_payment }}" readonly>
    <a href="{{ $proof_payment_consultation }}" target="_blank">CEK BUKTI PEMBAYARAN</a>
</div>