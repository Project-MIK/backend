@extends('layouts.admin.app')
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
                <button type='button' data-toggle='modal' data-target='#modal-tambah' class='col-4 btn btn-block btn-default btn-sm'>Tambah</button>
                <tr>
                    <th>no</th>
                    <th hidden>id</th>
                    <th>tanggal</th>
                    <th>mulai</th>
                    <th>akhir</th>
                    <th hidden>id dekoter</th>
                    <th>dokter</th>
                    <th>aksi</th>
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
                    <td>{{ date('d-m-Y', strtotime($schedule['consultation_date'])) }}</td>
                    <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($schedule['time_start']))->format('H:i:s') }}</td>
                    <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($schedule['time_end']))->format('H:i:s') }}</td>
                    <td hidden>{{$schedule['schedule']['doctor_id']}}</td>
                    <td>{{$schedule['schedule']['doctor']['name']}}</td>
                    <td>
                        <div class="row">
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-edit' onclick="setEdit(this)" class="col detail btn btn-block btn-primary btn-sm">Edit</button></div>
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-delete' onclick="setDelete(this)" class=" col btn btn-block btn-danger btn-sm">Delete</button></div>
                        </div>
                    </td>
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
                    <th hidden>id dekoter</th>
                    <th>dokter</th>
                    <th>aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- /.card-body -->

<x-modals.modal id-modal="modal-tambah" modal-bg="" modal-size="">
    <x-slot:header>
        <h2>Tambah Jadwal</h2>
    </x-slot:header>

    <form action="/admin/schedule/store" method="POST">
        @csrf
        <div class="form-group">
            <label>Select</label>
            <select name="doctor_id" class="form-control">
                @foreach($doctors as $doctor)
                    <option value="{{$doctor['id']}}">{{$doctor['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Date:</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" name="consultation_date" class="form-control datetimepicker-input" data-target="#reservationdate">
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>start</label>
                    <div class="input-group date" id="timepickerstart" data-target-input="nearest">
                        <input type="text" name="time_start" class="form-control datetimepicker-input" data-target="#timepickerstart" />
                        <div class="input-group-append" data-target="#timepickerstart" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>end</label>
                    <div class="input-group date" id="timepickerend" data-target-input="nearest">
                        <input type="text" name="time_end" class="form-control datetimepicker-input" data-target="#timepickerend" />
                        <div class="input-group-append" data-target="#timepickerend" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-block btn-default">simpan</button>
    </form>
    <x-slot:footer>

    </x-slot:footer>



</x-modals.modal>

<x-modals.modal id-modal="modal-edit" modal-bg="" modal-size="">
    <x-slot:header>
        <h3>Edit schedule</h3>
    </x-slot:header>
    <form action="/admin/schedule/update" method="POST">
        @csrf
        @method('put')
        <input type="text" id="edit-id" name="id" hidden>
        <div class="form-group">
            <label>Select</label>
            <select name="doctor_id" id="edit-doctor" class="form-control">
                @foreach($doctors as $doctor)
                    <option value="{{$doctor['id']}}">{{$doctor['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Date</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" name="consultation_date" id="edit-date" class="form-control datetimepicker-input" data-target="#reservationdate">
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>start</label>
                    <div class="input-group date" id="timepickerstart" data-target-input="nearest">
                        <input type="text" name="time_start" id="edit-start" class="form-control datetimepicker-input" data-target="#timepickerstart" />
                        <div class="input-group-append" data-target="#timepickerstart" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>end</label>
                    <div class="input-group date" id="timepickerend" data-target-input="nearest">
                        <input type="text" id="edit-end" name="time_end" class="form-control datetimepicker-input" data-target="#timepickerend" />
                        <div class="input-group-append" data-target="#timepickerend" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="far fa-clock"></i></div>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-block btn-default">simpan</button>
    </form>
    <x-slot:footer>
    </x-slot:footer>
</x-modals.modal>

<x-modals.modal id-modal="modal-delete" modal-size="modal-sm" modal-bg="bg-danger">
    <x-slot:header>
        <h4>Delete</h4>
    </x-slot:header>
    <x-slot:footer>
    </x-slot:footer>
    <h5>Apakah anda yakin inging menghapus data ini?</h5>
    <form action="/admin/schedule/destroy" method="POST">
        @csrf
        @method('delete')
        <input type="text" name="id" id="delete-id" hidden>
        <button type="submit" class="btn btn-block btn-danger">delete</button>
    </form>
</x-modals.modal>


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
            , date: rawData[2].innerText
            , start: rawData[3].innerText
            , end: rawData[4].innerText
            , id_doctor: rawData[5].innerText
            , doctor: rawData[6].innerText
        };

        return obj;
    }

    function setEdit(params) {
        var data = getData(params);
        var id = document.getElementById('edit-id');
        var date = document.getElementById('edit-date');
        var start = document.getElementById('edit-start');
        var end = document.getElementById('edit-end');
        var doctor = document.getElementById('edit-doctor');

        id.value = data.id;
        date.value = data.date;
        start.value = data.start;
        end.value = data.end;
        doctor.value = data.id_doctor;
    }

    function setDelete(params) {
        var data = getData(params);
        var id = document.getElementById('delete-id');
        id.value = data.id;

    }

</script>
<script>
    $(function() {
        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });

        $('#timepickerstart').datetimepicker({
            format: 'LT'
            , format: 'HH:mm', // format waktu yang diinginkan
            use24hours: true
        })

        $('#timepickerend').datetimepicker({
            format: 'LT'
            , format: 'HH:mm', // format waktu yang diinginkan
            use24hours: true
        })
    })

</script>

@endsection
