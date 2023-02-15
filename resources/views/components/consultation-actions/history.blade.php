<div id="history">
    <table class="table table-bordered">
        <thead>
          <tr class="text-trouth text-center">
            <th scope="col">No</th>
            <th scope="col">Aktifitas</th>
            <th scope="col">Status</th>
            <th scope="col">Detail</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($history_complaints as $item)
            <tr class="text-trouth">
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{$item["description"]}}</td>
                <td class="text-center">
                  @if ($item["status"] == "confirmed-consultation-payment")
                      <strong>Konsultasi Telah Selesai</strong>
                  @elseif($item["valid_status"] < time())
                      <strong>Konsultasi Telah Kadaluarsa</strong>
                  @endif
                </td>
                <td>
                    <a href="{{'/konsultasi/'.$item['id']}}" class="btn btn-bunting text-white font-weight-normal px-5">CEK</a>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
</div>