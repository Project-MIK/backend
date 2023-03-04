@extends('layouts.doctor.app')
@section('content-header')
<h1>Category Complaint</h1>
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
                <button type='button' data-toggle='modal' data-target='#modal-tambah' class='ml-auto col-3 btn btn-block btn-default btn-sm'>Tambah</button>
                <tr>
                    <th>no</th>
                    <th>tanggal</th>
                    <th>mulai</th>
                    <th>akhir</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no= 1;
                @endphp
                @foreach($data as $item)
                @php
                $date = \Carbon\Carbon::createFromTimestamp($item['start'])->format('d-m-Y');
                $start = \Carbon\Carbon::createFromTimestamp($item['start'])->format('H:i:s');
                $end =\Carbon\Carbon::createFromTimestamp($item['end'])->format('H:i:s');
                @endphp
                <tr>
                    <td>{{$no}}</td>
                    <td hidden>{{$item['id']}}</td>
                    <td>{{$date}}</td>
                    <td>{{$start}}</td>
                    <td>{{$end}}</td>
                </tr>
                @php($no++)
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>no</th>
                    <th>tanggal</th>
                    <th>mulai</th>
                    <th>akhir</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- /.card-body -->


@endsection

@section('after-js')

<script>
    function getData(button) {
        tabel = button.parentElement.parentElement.parentElement.parentElement;
        rawData = tabel.getElementsByTagName('td');

        var obj = {
            id: rawData[1].innerText
            , start: rawData[2].innerText
            , end: rawData[3].innerText
        };

        return obj;
    }

    function setEdit(params) {
        var data = getData(params);
        var id = document.getElementById('edit-id');
        var start = document.getElementById('edit-poly');
        var end = document.getElementById('edit-category');

        id.value = data.id;

        category.value = data.category;
    }

    function setDelete(params) {
        var data = getData(params);
        var id = document.getElementById('delete-id');
        console.table(data);
        console.log('delete');

    }

</script>
<script>
    $(function() {
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });

        $('#timepickerstart').datetimepicker({
            format: 'LT',
            format: 'HH:mm', // format waktu yang diinginkan
            use24hours: true
        })

        $('#timepickerend').datetimepicker({
            format: 'LT',
            format: 'HH:mm', // format waktu yang diinginkan
            use24hours: true
        })
    })

</script>

@endsection
