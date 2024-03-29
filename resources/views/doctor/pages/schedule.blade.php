@extends('layouts.doctor.app')
@section('content-header')
<h1>Jadwal</h1>
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
                    <th>no</th>
                    <th hidden>id</th>
                    <th>tanggal</th>
                    <th>mulai</th>
                    <th>akhir</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no= 1;
                @endphp
                @foreach($schedules as $schedule)
                <tr>
                    <td>{{$no}}</td>
                    <td hidden>{{$schedule['id']}}</td>
                    <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($schedule['consultation_date']))->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($schedule['time_start']))->format('H:i:s') }}</td>
                    <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($schedule['time_end']))->format('H:i:s') }}</td>
                </tr>
                @php($no++)
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>no</th>
                    <th hidden>id</th>
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
    $(function() {
        $("#example1").DataTable({
            "responsive": true
            , "lengthChange": false
            , "autoWidth": false
            , "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0) ');
    });
    
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
