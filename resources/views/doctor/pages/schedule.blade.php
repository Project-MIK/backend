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
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                $no= 1;
                @endphp
                @foreach($data as $item)
                @php
                $date =  \Carbon\Carbon::createFromTimestamp($item['start'])->format('d-m-Y');
                $start = \Carbon\Carbon::createFromTimestamp($item['start'])->format('H:i:s');
                $end =\Carbon\Carbon::createFromTimestamp($item['end'])->format('H:i:s');
                @endphp
                <tr>
                    <td>{{$no}}</td>
                    <td hidden>{{$item['id']}}</td>
                    <td>{{$date}}</td>
                    <td>{{$start}}</td>
                    <td>{{$end}}</td>
                    <td>
                        <div class="row">
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-edit' onclick="setEdit(this)" class="col detail btn btn-block btn-primary btn-sm">Detail</button></div>
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-delete' onclick="setDelete(this)" class=" col btn btn-block btn-danger btn-sm">Danger</button></div>
                        </div>
                    </td>
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
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- /.card-body -->

<x-modals.modal id-modal="modal-tambah">
    <x-slot:header>
        <h2>Tambah Jadwal</h2>
    </x-slot:header>

    <form action="/doctor/schedule/store" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label>Start</label>
                    <div class="input-group date" id="reservationdatetimestart" data-target-input="nearest">
                        <input type="text" name="start" data-format="YYYY-MM-DD HH:mm" data-date="1990-01-01" data-date-format="YYYY-MM-DD" class="form-control datetimepicker-input" data-target="#reservationdatetimestart">
                        <div class="input-group-append" data-target="#reservationdatetimestart" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label>End</label>
                    <div class="input-group date" id="reservationdatetimeend" data-target-input="nearest">
                        <input type="text" name="end" class="form-control datetimepicker-input" data-target="#reservationdatetimeend">
                        <div class="input-group-append" data-target="#reservationdatetimeend" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-block btn-default">simpan</button>
    </form>
    <x-slot:footer>

    </x-slot:footer>



</x-modals.modal>

<x-modals.modal-danger-sm>
    <x-slot:id>modal-delete</x-slot:id>
    <x-slot:title>Warning</x-slot:title>
    <h3>Apakah Anda Yakin Ingin menghapus data ini?</h3>
    <form action="destroy" method="POST">
        @csrf
        @method('delete')
        <input hidden name="id_category" id="delete-id" value="1">
        <button type="submit" class="btn btn-block btn-danger btn-sm">Delete</button>
    </form>
</x-modals.modal-danger-sm>

<x-modal>
    <x-slot:modalid>modal-edit</x-slot:modalid>
    <x-slot:judul>Edit Kategori</x-slot:judul>
    <form action="update" method="post">
        @csrf
        @method('put')

        <button type="submit" class="col-4 btn btn-block btn-primary btn-sm">Submit</button>
    </form>
</x-modal>
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
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
            'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date picker
        $('#reservationdate').datetimepicker({
            format: 'L'
        });

        //Date and time picker

        $('#reservationdatetimestart').datetimepicker({
            icons: {
                time: 'far fa-clock'
            }
            , format: 'DD-MM-YYYY HH:mm', // format waktu yang diinginkan
            use24hours: true

        });

        $('#reservationdatetimeend').datetimepicker({
            icons: {
                time: 'far fa-clock'
            }
            , format: 'DD-MM-YYYY HH:mm', // format waktu yang diinginkan
            use24hours: true
        });

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true
            , timePickerIncrement: 30
            , locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        });
        $('#reservationtimeEnd').daterangepicker({
            timePicker: true
            , timePickerIncrement: 30
            , locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()]
                    , 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')]
                    , 'Last 7 Days': [moment().subtract(6, 'days'), moment()]
                    , 'Last 30 Days': [moment().subtract(29, 'days'), moment()]
                    , 'This Month': [moment().startOf('month'), moment().endOf('month')]
                    , 'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
                , startDate: moment().subtract(29, 'days')
                , endDate: moment()
            }
            , function(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'LT'
        })

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        })
    })

</script>

@endsection
