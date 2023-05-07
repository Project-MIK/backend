@php

@endphp
@extends('layouts.admin.app')



@section('content-header')
<h1>Admin</h1>
@endsection
@section('content')
{{-- {{dd($data[0])}} --}}
<div class="card">
    <div class="card-header">
        <h3 class="card-title">DataTable with default features</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {{-- {{dd($data)}} --}}
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <button type='button' data-toggle='modal' data-target='#modal-tambah' class='ml-auto col-2 btn btn-block btn-default'>Tambah</button>
                <tr>
                    <th>no</th>
                    <th hidden>id</th>
                    <th>nama</th>
                    <th>email</th>
                    <th>alamat</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                @endphp
                @foreach($data as $item)
                <tr>
                    <td>{{$no}}</td>
                    <td hidden>{{$item['id']}}</td>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['email']}}</td>
                    <td>{{$item['address']}}</td>
                    <td>
                        <div data-id="{{$item['id']}}" class="row">
                            <div class="col"><button onclick="setEdit(this)" type="button" data-toggle='modal' data-target='#modal-detail' class="col detail btn btn-block btn-primary btn-sm">Detail</button></div>
                            <div class="col"><button type="button" onclick="setDelete(this)" data-toggle='modal' data-target='#modal-delete' class=" col btn btn-block btn-danger btn-sm">Delete</button></div>
                        </div>
                    </td>
                </tr>
                @php
                $no++;
                @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>no</th>
                    <th hidden>id</th>
                    <th>nama</th>
                    <th>email</th>
                    <th>alamat</th>
                    <th>aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<x-modals.modal id-modal="modal-tambah" modal-size="" modal-bg="">
    <x-slot:header><h3>Tambah Admin</h3></x-slot:Header>
    <x-slot:footer></x-slot:footer>
    <form action="/admin/admin/store" method="post">
        @csrf
        <div class="form-group">
            <label>Nama</label>
            <input type="text"  class="form-control" name="name" placeholder="Nama">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="password" placeholder="Nama">
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" name="address" rows="3" placeholder="Alamat ......"></textarea>
        </div>
        <button type="submit">simpan</button>
    </form>
</x-modals.modal>

<x-modals.modal id-modal="modal-detail" modal-size="" modal-bg="">
    <x-slot:header><h3>Detail Admin</h3></x-slot:Header>
    <x-slot:footer></x-slot:footer>
    <form action="/admin/admin/update" method="post">
        @csrf
        @method('put')
        <input type="text" hidden name="id" id="edit-id">
        <div class="form-group">
            <label>Nama</label>
            <input type="text" id="edit-name"  class="form-control" name="name" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" id="edit-email"  class="form-control" name="email" readonly >
        </div>
        <div class="form-group">
            <label for="detail-alamat">Alamat</label>
            <textarea  id="edit-address" class="form-control" name="address" rows="3" placeholder="Alamat ......" required></textarea>
        </div>
        <button type="submit" class="btn btn-block btn-primary">save</button>
    </form>
</x-modals.modal>



<x-modals.modal id-modal="modal-delete" modal-size="modal-sm" modal-bg="bg-danger">
    <x-slot:header><h3>Warning</h3></x-slot:Header>
    <x-slot:footer></x-slot:footer>
    <h5>apakah anda yakin ingin menghapus data ini?</h5>
    <form action="{{route('admin.destroy')}}" method="post">
        @csrf
        @method('delete')
        <input type="text" hidden name="id">
        <button type="submit" class="btn btn-block btn-danger btn-sm">YA!</button>
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
            , name : rawData[2].innerText
            , email: rawData[3].innerText
            , address: rawData[4].innerText
        };

        return obj;
    }

    function setEdit(params) {
        var data = getData(params);
        var id = document.getElementById('edit-id');
        var name = document.getElementById('edit-name');
        var email = document.getElementById('edit-email');
        var address = document.getElementById('edit-address');

        id.value = data.id;
        name.value = data.name;
        email.value = data.email;
        address.value = data.address;
    }

    function setDelete(params) {
        var data = getData(params);
        var id = document.getElementById('delete-id');
        id.value = data.id;

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
<script>
    console.log('mesage recorded');
    $(function() {
        $(document).ready(function() {
            $(document).Toasts('create', {
                class : 'bg-success'
                ,title: 'success'
                , autohide: true
                , delay: 2000
                , body: '{{ session()->get('message.message') }}'
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
                class : 'bg-danger'
                ,title: 'error'
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
