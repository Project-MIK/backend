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
                    <td>pasien</td>
                    <td>rekam medik</td>
                    <td>durasi</td>
                    <td>mulai</td>
                    <td>akhir</td>
                    <td>video convern</td>
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
                    <td>{{$item['patient_name']}}</td>
                    <td>{{$item['medrec']}}</td>
                    <td>{{$item['duration']}}</td>
                    <td>{{$start}}</td>
                    <td>{{$end}}</td>
                    <td><a href="{{$item['link']}}" target="blank"><button class="col detail btn btn-block btn-primary btn-sm">Mulai Konsultasi</button></a></td>
                </tr>
                @php($no++)
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>no</td>
                    <td>pasien</td>
                    <td>rekam medik</td>
                    <td>durasi</td>
                    <td>mulai</td>
                    <td>akhir</td>
                    <td>video convern</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
@section('after-js')
@endsection
