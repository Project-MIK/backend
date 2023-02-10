<div id="consultation">
    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-5">
        <div class="text-trouth">Nomor Rekam Medis : <strong>00-00-63-04-18</strong></div>
        <a id="create_consulation" href="/konsultasi" class="btn btn-bunting text-white font-weight-normal px-5">Buat Konsultasi</a>
    </div>
    @if (!empty($complaints))
    <table class="table table-bordered">
        <thead>
          <tr class="text-center text-trouth">
            <th scope="col">Keluhan</th>
            <th scope="col">Status Periksa</th>
            <th scope="col">Detail</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($complaints as $item)
                @if($item["status"] != "consultation-complete" && $item["valid_status"] > time())
                <tr class="text-trouth">
                    <td>{{$item["description"]}}</td>
                    <td class="text-center">
                            @if ($item["status"] == "waiting-consultation-payment")
                            <strong>Menunggu pembayaran konsultasi</strong>
                            @elseif($item["status"] == "confirmed-consultation-payment")
                                <strong>Konsultasi akan berlangsung pada</strong><br>{{$item["schedule"]}}
                            @elseif($item["status"] == "waiting-medical-prescription-payment")
                                <strong>Menunggu pembayaran resep obat</strong>
                            @elseif($item["status"] == "confirmed-medical-prescription-payment")
                                <strong>Menunggu pengambilan resep obat</strong>
                            @endif
                    </td>
                    <td>
                        <a href="{{'/konsultasi/'.$item['id']}}" class="btn {{ $item['status'] == "confirmed-consultation-payment" ? "btn-bunting" : "btn-trouth" }} text-white font-weight-normal px-5">CEK</a>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
      </table>
    @else
        <p class="text-center font-weight-bold pt-4">Tidak ada jadwal konsultasi</p>
    @endif
</div>