@extends('layouts.admin.app')
@section('content-header')
<h1>Konsultasi</h1>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Category</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td>no</td>
                    <td>id konsultasi</td>
                    <td>pasien</td>
                    <td>rekam medik</td>
                    <td>dokter</td>
                    <td>durasi</td>
                    <td>mulai</td>
                    <td>akhir</td>
                    <td>video conferece</td>
                </tr>
            </thead>
            <tbody>
                @php
                $no =1;
                @endphp
                @foreach($data as $item)
                @php
                $start = \Carbon\Carbon::createFromTimestamp($item['start'])->format('Y-m-d H:i:s');
                $end =\Carbon\Carbon::createFromTimestamp($item['end'])->format('Y-m-d H:i:s');
                @endphp
                <tr>
                    <td>{{$no}}</td>
                    <td>{{$item['consul_id']}}</td>
                    <td>{{$item['patient_name']}}</td>
                    <td>{{$item['medrec']}}</td>
                    <td>{{$item['doctor']}}</td>
                    <td>{{$item['duration']/60}} menit</td>
                    <td>{{$start}}</td>
                    <td>{{$end}}</td>
                    <td><a target="blank" href="/admin/consul/vidcon/{{$item['consul_id']}}"><button class="col detail btn btn-block btn-primary btn-sm">Mulai Konsultasi</button></a></td>
                </tr>
                @php($no++)
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>no</td>
                    <td>id konsultasi</td>
                    <td>pasien</td>
                    <td>rekam medik</td>
                    <td>dokter</td>
                    <td>durasi</td>
                    <td>mulai</td>
                    <td>akhir</td>
                    <td>video conferece</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<x-modals.modal id-modal="vc" modal-size="modal-xl" modal-bg="" header="" footer="">
    <div class="container" ></div>
    <x-slot id="jitsi"></x-slot>
</x-modals.modal>
@endsection
@section('after-js')
{{-- <script>
    const domain = 'meet.jit.si';
    const options = {
        roomName: 'JitsiMeetAPIExample'
        , width: 700
        , height: 700
        , parentNode: document.querySelector('#vc')
        , lang: 'id'
    };
    api = new JitsiMeetExternalAPI(domain, options);

</script> --}}
@endsection
