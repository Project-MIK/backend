@extends('layouts.admin.app')

@section('content-header')
<h1>pasien</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">DataTable with default features</h3>
        {{-- {{dd($data)}} --}}
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <a href="/admin/pasien/store"><button type='button' class='ml-auto col-2 btn btn-block btn-default'>Tambah</button></a>
                <tr>
                    <th>no</th>
                    <th>nama</th>
                    <th>no rekamedik</th>
                    <th>gender</th>
                    <th>kewarganegaraan</th>
                    <th>email</th>
                    <th>nomer hp</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                @php($no = 0)
                @foreach($data as $record)
                @php($no++)
                <tr>
                    <td>{{$no}}</td>
                    <td>{{$record['name']}}</td>
                    @if(is_null($record['medical_record_id']))
                    <td><button type="button" onclick="setRs(this)" data-toggle='modal' data-target='#modal-rs' class="btn btn-block btn-success btn-xs">Tambahkan no rs</button></td>
                    @else
                    <td>{{$record['medical_record_id']}}</td>
                    @endif
                    <td>{{$record['gender']}}</td>
                    <td>{{$record['citizen']}}</td>
                    <td>{{$record['email']}}</td>
                    <td>{{$record['phone_number']}}</td>
                    <th>
                        <div class="row">
                            <div class="col"><a href="/admin/pasien/detail/{{$record['medical_record_id']}}"><button type="button" data-toggle='modal' data-target='#modal-detail' class="col detail btn btn-block btn-primary btn-sm">Detail</button></a></div>
                        </div>
                    </th>
                </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <th>no</th>
                    <th>nama</th>
                    <th>no rekamedik</th>
                    <th>gender</th>
                    <th>kewarganegaraan</th>
                    <th>email</th>
                    <th>nomer hp</th>
                    <th>aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>


<x-modals.modal id-modal="modal-rs" modal-size="" modal-bg="">
    <x-slot:header>
        Menambahkan nomer rekamedik
    </x-slot:header>
    <form action="/admin/pasien/rs" method="POST">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="inputNama" class="text-trouth">No rekamedik</label>
        <input type="number" class="form-control py-4" id="inputNama" name="medical_record_id" required>
    </div>
    <input type="email" id="email-for-rs" name="email" hidden>
    <button type='submit' class='ml-auto col-2 btn btn-block btn-default'>Update</button>
    </form>
    <x-slot:footer>
    </x-slot:footer>
</x-modals.modal>



@endsection


@section('after-js')
<script>
    function getData(button) {
        tabel = button.parentElement.parentElement.parentElement.parentElement;
        rawData = tabel.getElementsByTagName('td');

        var obj = {
            name: rawData[1].innerText
            , noRek: rawData[2].innerHTML
            , gender: rawData[3].innerText
            , citizen: rawData[4].innerText
            , email: rawData[5].innerHTML
            , phone: rawData[6].innerHTML
        };

        return obj;
    }

    function setRs(params) {
        var data = getData(params);
        var email = document.getElementById('email-for-rs');
        email.value = data.email;
    }


    $(function() {
        $("#example1").DataTable({
            "responsive": true
            , "lengthChange": false
            , "autoWidth": false
            , "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0) ');
    });


    function fillName(name) {
        document.querySelector("#detail-nama").value = name;
    }

    //untuk mengset data nama pada tabel ke form modal ketika btn dengan class detail di klik
    const detailButtons = document.querySelectorAll(".detail");

    for (let i = 0; i < detailButtons.length; i++) {
        detailButtons[i].addEventListener("click", function() {
            const name = this.closest("tr").querySelector("td:nth-child(2)").innerHTML;
            console.log(name);
            fillName(name);
        });
    }

</script>

@if(session('message'))
{{dd(session()->all())}}
<script>
    console.log('mesage recorded');
    $(function() {
        $(document).ready(function() {
            $(document).Toasts('create', {
                class: 'bg-success'
                , title: 'success'
                , autohide: true
                , delay: 2000
                , body: '{{ session('
                message ')}}'
            })
        });
    });

</script>
@endif
@if($errors->any())
<script>
    console.log('mesage recorded');
    $(function() {
        $(document).ready(function() {
            $(document).Toasts('create', {
                class: 'bg-danger'
                , title: 'error'
                , autohide: true
                , delay: 2000
                , body: '@foreach ($errors->all() as $error)<li>{{$error}}</li>@endforeach'
            })
        });
    });

</script>
{{-- {{dd($errors)}} --}}
@endif

@endsection
