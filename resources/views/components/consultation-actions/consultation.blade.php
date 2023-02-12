<div id="consultation">
    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-5">
        <div class="text-trouth">Nomor Rekam Medis : <strong>00-00-63-04-18</strong></div>
        <a id="create_consulation" href="/konsultasi" class="btn btn-bunting text-white font-weight-normal px-5">Buat Konsultasi</a>
    </div>
    @if ($complaint)
    <table class="table table-bordered">
        <thead>
          <tr class="text-center text-trouth">
            <th scope="col">Keluhan</th>
            <th scope="col">Status Periksa</th>
            <th scope="col">Detail</th>
          </tr>
        </thead>
        <tbody>
            @if($complaint["status"] != "consultation-complete" && $complaint["valid_status"] > time())
            <tr class="text-trouth">
                <td>{{$complaint["description"]}}</td>
                <td class="text-center">
                        @if ($complaint["status"] == "waiting-consultation-payment")
                        <strong>Menunggu pembayaran konsultasi</strong>
                        @elseif($complaint["status"] == "confirmed-consultation-payment")
                            <div>
                                <div>
                                    <strong>Konsultasi akan berlangsung pada</strong><br>{{date("d - M - Y", $complaint["schedule"])}}
                                </div>
                                <div>
                                    {{date("h:m:s", $complaint["start_consultation"])}} - {{date("h:m:s", $complaint["end_consultation"])}} WIB
                                </div>
                            </div>
                        @elseif($complaint["status"] == "waiting-medical-prescription-payment")
                            <strong>Menunggu pembayaran resep obat</strong>
                        @elseif($complaint["status"] == "confirmed-medical-prescription-payment")
                            <strong>Menunggu pengambilan resep obat</strong>
                        @endif
                </td>
                <td>
                    <a href="{{'/konsultasi/'.$complaint['id']}}" class="btn {{ $complaint['status'] == "confirmed-consultation-payment" ? "btn-bunting" : "btn-trouth" }} text-white font-weight-normal px-5">CEK</a>
                </td>
            </tr>
            @endif
        </tbody>
      </table>
    @else
        <p class="text-center font-weight-bold pt-4 text-trouth">Tidak ada jadwal konsultasi</p>
    @endif
</div>