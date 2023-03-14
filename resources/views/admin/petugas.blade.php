@extends('layouts.admin.app')
@section('content-header')
<h1>Petugas Pendaftaran</h1>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">DataTable with default features</h3>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <button type='button' data-toggle='modal' data-target='#tambah' class='ml-auto col-2 btn btn-block btn-default'>Tambah</button>
        <table id="tabel-petugas" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>no</th>
                    <th hidden></th>
                    <th>nama</th>
                    <th>email</th>
                    <th>gender</th>
                    <th>alamat</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach($data as $item)
                <tr>
                    <td>{{$no++}}</td>
                    <td hidden>{{$item['id']}}</td>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['email']}}</td>
                    <td>{{$item['gender']}}</td>
                    <td>{{$item['address']}}</td>
                    <td>
                        <div class="row">
                            <div class="col"><button type="button" onclick="setEdit(this)" data-toggle='modal' data-target='#edit' class="col detail btn btn-block btn-primary btn-sm">Detail</button></div>
                            <div class="col"><button type="button" onclick="setDelete(this)" data-toggle='modal' data-target='#delete' class=" col btn btn-block btn-danger btn-sm">Delete</button></div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>no</th>
                    <th hidden></th>
                    <th>nama</th>
                    <th>email</th>
                    <th>gender</th>
                    <th>alamat</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<x-modals.modal id-modal='tambah' modal-size='' modal-bg='' footer=''>
    <x-slot:header>
        <h3>Tambah Data Petugas</h3>
    </x-slot:header>
    <form action="/admin/petugas/store" method="POST">
        @csrf

        <div class="form-group">
            <label for="tambah-name">Nama</label>
            <input type="text" class="form-control" name="name" id="tambah-name" placeholder="Masukan nama">
        </div>
        <div class="form-group">
            <label for="tambah-email">Email</label>
            <input type="email" class="form-control" name="email" id="tambah-name" placeholder="Masukan nama">
        </div>
        <div class="form-group">
            <label for="tambah-gender">gender</label>
            <select class="form-control" id="tambah-gender" name="gender">
                <option value="M">laki laki</option>
                <option value="W">perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" rows="3" placeholder="masukan alamat" name="address"></textarea>
        </div>
        <button type="sumbit" class="btn btn-block btn-success">submit</button>
    </form>
</x-modals.modal>

<x-modals.modal id-modal='edit' modal-size='' modal-bg='' footer=''>
    <x-slot:header>
        <h3>Edit Data Petugas</h3>
    </x-slot:header>
    <form action="/admin/petugas/update" method="POST">
        @csrf
        @method('put')
        <input type="text" id="edit-id" name="id" hidden>
        <div class="form-group">
            <label for="tambah-name">Nama</label>
            <input type="text" class="form-control" name="name" id="edit-name" placeholder="Masukan nama">
        </div>
        <div class="form-group">
            <label for="tambah-email">Email</label>
            <input type="email" class="form-control" name="email" id="edit-email" placeholder="Masukan nama">
        </div>
        <div class="form-group">
            <label for="tambah-gender">gender</label>
            <select class="form-control" id="edit-gender" name="gender">
                <option value="M">laki laki</option>
                <option value="W">perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" rows="3" placeholder="masukan alamat" id="edit-address" name="address"></textarea>
        </div>
        <button type="sumbit" class="btn btn-block btn-success">submit</button>
    </form>
</x-modals.modal>

<x-modals.modal id-modal='delete' modal-size='modal-sm' modal-bg='bg-danger' footer=''>
    <x-slot:header>Warning</x-slot:header>
    <form action="/admin/petugas/destroy" method="POST">
        @csrf
        @method('delete')
        <p>Apakah Anda yakin untuk mengha</p>
        <input type="text" id="delete-id" name="id" hidden>
        <button type="submit" class="btn btn-block btn-danger">Delete</button>
    </form>
</x-modals.modal>
@endsection





@section('after-js')
<script>
    $(function() {
        $("#tabel-petugas").DataTable({
            "responsive": true
            , "lengthChange": false
            , "autoWidth": false
            , 'scrollX': true
            , 'ordering': true
            , "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0) ');
    });

    function getData(button) {
        tabel = button.parentElement.parentElement.parentElement.parentElement;
        rawData = tabel.getElementsByTagName('td');

        var obj = {
            id: rawData[1].innerText
            , name: rawData[2].innerText
            , email: rawData[3].innerHTML
            , gender: rawData[4].innerHTML
            , address: rawData[5].innerHTML
        };

        return obj;
    }

    function setEdit(params) {
        var data = getData(params);
        var id = document.getElementById('edit-id');
        var name = document.getElementById('edit-name');
        var email = document.getElementById('edit-email');
        var gender = document.getElementById('edit-gender');
        var address = document.getElementById('edit-address');

        id.value = data.id;
        name.value = data.name;
        email.value = data.email;
        gender.value = data.gender;
        address.value = data.address;
    }

    function setDelete(params) {
        var data = getData(params);
        var id = document.getElementById('delete-id');
        id.value = data.id;
    }

</script>
@endsection
