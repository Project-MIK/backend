@extends('layouts.doctor.app')
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
                    <td>{{$item['duration']/60}} menit</td>
                    <td>{{$start}}</td>
                    <td>{{$end}}</td>
                    <td><a href="/doctor/consul/jitsi/{{$item['consul_id']}}" target="blank"><button class="col detail btn btn-block btn-primary btn-sm">Mulai Konsultasi</button></a></td>
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
                    <td>durasi</td>
                    <td>mulai</td>
                    <td>akhir</td>
                    <td>video conferece</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
@section('after-js')
<script>
     $(function() {
        $("#example1").DataTable({
            "responsive": true
            , "lengthChange": false
            , "autoWidth": false
            , "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0) ');
    });
</script>
@endsection
