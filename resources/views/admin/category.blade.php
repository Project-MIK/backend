

@extends('layouts.admin.app')
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
                <button type='button' data-toggle='modal' data-target='#tambah-kategori' class='ml-auto col-3 btn btn-block btn-default btn-sm'>Tambah</button>
                <tr>
                    <th>no</th>
                    <th>kategori</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php($no=1)
                @foreach($data as $item)
                <tr>
                    <td>{{$no}}</td>
                    <td hidden>{{$item['id_category']}}</td>
                    <td>{{$item['category']}}</td>
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
                    <th>kategori</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

    <!-- /.card-body -->

    <x-modals.modal id-modal="tambah-kategori" modal-size="" modal-bg="">
        <x-slot:header><h3>Tambah Kategori</h3></x-slot:Header>
        <x-slot:footer></x-slot:footer>
        <form action="store" method="post">
            @csrf
            @method('post')
            <div class="form-group">
                <label for="store-category">Kategori</label>
                <input type="text" class="form-control" id="store-category" placeholder="Masukan kategori" name="category">
            </div>
            <button type="submit" class="btn btn-block btn-default btn-sm">Simpan</button>
        </form>
    </x-modals.modal>

    <x-modals.modal id-modal="modal-delete" modal-size="modal-sm" modal-bg="bg-danger">
        <x-slot:header><h3>Warning</h3></x-slot:Header>
        <x-slot:footer></x-slot:footer>
        <h3>Apakah Anda Yakin Ingin menghapus data ini?</h3>
        <form action="destroy" method="POST">
            @csrf
            @method('delete')
            <input hidden id="delete_id" name="id_category" >
            <button type="submit" class="btn btn-block btn-danger btn-sm">Delete</button>
        </form>
    </x-modals.modal>

    <x-modals.modal id-modal="modal-edit" modal-size="" modal-bg="">
        <x-slot:header><h3>Edit Kategori</h3></x-slot:Header>
        <x-slot:footer></x-slot:footer>
            <form action="update" method="post">
                @csrf
                @method('put')
                <input name="id_category" hidden id="edit-id">
                <div class="form-group">
                    <label for="edit-category">Kategori</label>
                    <input type="text" class="form-control" id="edit-category" placeholder="Masukan kategori" name="category">
                </div>
                <button type="submit" class="col-4 btn btn-block btn-primary btn-sm">Submit</button>
            </form>
    </x-modals.modal>
        @endsection
        @section('after-js')

        <script>
            function getData(button) {
                tabel = button.parentElement.parentElement.parentElement.parentElement;
                rawData = tabel.getElementsByTagName('td');

                var obj = {
                    id: rawData[1].innerText
                    , category: rawData[2].innerText
                    , poly: rawData[3].getAttribute('data-id')
                };

                return obj;
            }

            function setEdit(params) {
                var data = getData(params);
                var id = document.getElementById('edit-id');
                var category = document.getElementById('edit-category');

                id.value = data.id;
                category.value = data.category;
            }

            function setDelete(params) {
                var data = getData(params);
                var id = document.getElementById('delete_id');
                id.value = data.id;
            }

        </script>

        @endsection
