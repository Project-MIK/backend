@extends('layouts.admin.app')
@section('content-header')
<h1>Poliklinik</h1>
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
                    <th hidden>id poly</th>
                    <th>poliklinik</th>
                    <th hidden>id kategori</th>
                    <th>kategori</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                @php($no=1)
                @foreach($polyclinics as $polyclinic)
                <tr>
                    <td>{{$no}}</td>
                    <td hidden>{{$polyclinic['id']}}</td>
                    <td>{{$polyclinic['name']}}</td>
                    <td hidden>{{$polyclinic['record_category_id']}}</td>
                    <td>{{$polyclinic['record_category']['category_name']}}</td>
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
                    <th>poliklinik</th>
                    <th>kategori</th>
                    <th>aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<x-modals.modal id-modal="modal-tambah" modal-size="" modal-bg="" footer="">
    <x-slot:header>
        <h3>Tamabah Poliklinik</h3>
    </x-slot:header>
    <form action="/admin/poly/store" method="post">
        @csrf
        @method('post')
        <div class="form-group">
            <label for="store-category">Poliklinik</label>
            <input type="text" class="form-control" id="store-category" placeholder="Masukan kategori" name="name">
        </div>
        <div class="form-group">
            <label>Kategori</label>
            <select class="form-control" name="record_category_id">
                @foreach($categories as $category)
                    <option value="{{$category['id']}}">{{$category['category_name']}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-block btn-default btn-sm">Simpan</button>
    </form>
</x-modals.modal>

<x-modals.modal id-modal="modal-edit" modal-size="" modal-bg="" footer="">
    <x-slot:header>
        <h3>Edit Poliklinik</h3>
    </x-slot:header>
    <form action="/admin/poly/update" method="post">
        @csrf
        @method('put')
        <input type="text" name="id" id="edit-id" hidden>
        <div class="form-group">
            <label for="store-category">Poliklinik</label>
            <input type="text" class="form-control" id="edit-poly" placeholder="Masukan kategori" name="name">
        </div>
        <div class="form-group">
            <label>Kategori</label>
            <select class="form-control" name="record_category_id" id="edit-category">
                @foreach($categories as $category)
                    <option value="{{$category['id']}}">{{$category['category_name']}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-block btn-default btn-sm">Simpan</button>
    </form>
</x-modals.modal>

<x-modals.modal id-modal="modal-delete" modal-size="modal-sm" modal-bg="bg-danger" footer="">
    <x-slot:header>
        <h3>Warning</h3>
    </x-slot:header>
    <p>Apakah anda yakin ingin menghapus item ini</p>
    <form action="/admin/poly/destroy" method="post">
        @csrf
        @method('delete')
        <input type="text" name="id" id="delete-id" hidden>
        <button type="submit" class="btn btn-block btn-danger btn-sm">Delete</button>
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
            , poly: rawData[2].innerText
            , id_category: rawData[3].innerText
            , category: rawData[4].innerText
        };

        return obj;
    }

    function setEdit(params) {
        var data = getData(params);
        var id = document.getElementById('edit-id');
        var poli = document.getElementById('edit-poly');
        var category = document.getElementById('edit-category');

        id.value = data.id;
        poli.value = data.poly;
        category.value = data.id_category;
    }

    function setDelete(params) {
        var data = getData(params);
        var id = document.getElementById('delete-id');
        id.value = data.id;
    }

</script>
@endsection
