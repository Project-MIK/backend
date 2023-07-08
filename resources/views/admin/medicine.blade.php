@extends('layouts.admin.app')
@section('content-header')
<h1>Obat</h1>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">DataTable with default features</h3>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <button type='button' data-toggle='modal' data-target='#modal-tambah' class='col-4 btn btn-block btn-default'>Tambah</button>
                <tr>
                    <th>no</th>
                    <th hidden>id</th>
                    <th>nama</th>
                    <th>harga</th>
                    <th>stok</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                @php($no=1)
                @foreach($data as $item)
                <tr>
                    <td>{{$no++}}</td>
                    <td hidden>{{$item['id']}}</td>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['price']}}</td>
                    <td>{{$item['stock']}}</td>
                    <td>
                        <div class="row">
                            <div class="col"><button onclick="setEdit(this)" type="button" data-toggle='modal' data-target='#modal-detail' class="col detail btn btn-block btn-primary btn-sm">Detail</button></div>
                            <div class="col"><button onclick="setDelete(this)" type="button" data-toggle='modal' data-target='#modal-delete' class=" col btn btn-block btn-danger btn-sm">Delete</button></div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>no</th>
                    <th hidden>id</th>
                    <th>nama</th>
                    <th>harga</th>
                    <th>stok</th>
                    <th>aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<x-modals.modal id-modal="modal-tambah" modal-size="" modal-bg="">
    <x-slot:header>
        <h3>Tambah Obat</h3>
    </x-slot:Header>
    <x-slot:footer></x-slot:footer>
    <form action="/admin/medicine/store" method="post">
        @csrf
        <div class="form-group">
            <label for="form-name">Nama</label>
            <input id="form-name" type="text" id="form-name" class="form-control" name="name" placeholder="Nama" required>
        </div>

        <div class="form-group">
            <label for="form-harga">harga</label>
            <input id="form-harga" type="number" class="form-control" name="price" required>
        </div>
        <div class="form-group">
            <label for="form-stok">stok</label>
            <input id="form-stok" type="number" class="form-control" name="stock" required>
        </div>
        <button type="submit" class="col-5 btn btn-block btn-success ml-auto">Simpan</button>
    </form>
</x-modals.modal>

<x-modals.modal id-modal="modal-detail" modal-size="" modal-bg="">
    <x-slot:header>
        <h3>Detail Obat</h3>
    </x-slot:Header>
    <x-slot:footer></x-slot:footer>
    <form action="/admin/medicine/update" method="post">
        @csrf
        @method('put')
        <input type="text" hidden name="id" id="detail-id">
        <div class="form-group">
            <label for="detail-name">Nama</label>
            <input id="detail-name" type="text" id="form-name" class="form-control" name="name" placeholder="Nama obat" required>
        </div>

        <div class="form-group">
            <label for="datail-harga">harga</label>
            <input id="detail-price" type="number" class="form-control" name="price" required>
        </div>
        <div class="form-group">
            <label for="datail-stok">stok</label>
            <input id="detail-stock" type="number" class="form-control" name="stock" required>
        </div>
        <button type="submit" class="col-5 btn btn-block btn-success ml-auto">Simpan</button>
    </form>
</x-modals.modal>


<x-modals.modal id-modal="modal-delete" modal-size="modal-sm" modal-bg="bg-danger">
    <x-slot:header>
        <h3>Warning</h3>
    </x-slot:Header>
    <x-slot:footer></x-slot:footer>
    <h5>apakah anda yakin ingin menghapus data ini?</h5>
    <form action="/admin/medicine/destroy" method="post">
        @csrf
        @method('delete')
        <input type="text" hidden name="id" id="delete-id">
        <div class="row">
            <div class="col">
                <div class="d-flex align-items-center justify-content-center"><button type="submit" class=" btn btn-outline-light">Ya!</button></div>
            </div>
            <div class="col">
                <div class="d-flex align-items-center justify-content-center"><button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button></div>
            </div>
        </div>
    </form>

</x-modals.modal>
@endsection
@section('after-js')
<script>
    $("#example1").DataTable({
        "lengthChange": false
        , "autoWidth": false
        , "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0) ');

    function getData(button) {
        tabel = button.parentElement.parentElement.parentElement.parentElement;
        rawData = tabel.getElementsByTagName('td');

        var obj = {
            id: rawData[1].innerText
            , name: rawData[2].innerText
            , price: rawData[3].innerHTML
            , stock: rawData[4].innerHTML
        };

        return obj;
    }

    function setEdit(params) {
        var data = getData(params);
        var id = document.getElementById('detail-id');
        var name = document.getElementById('detail-name');
        var price = document.getElementById('detail-price');
        var stock = document.getElementById('detail-stock');

        id.value = data.id;
        name.value = data.name;
        price.value = data.price;
        stock.value = data.stock;
    }

    function setDelete(params) {
        var data = getData(params);
        var id = document.getElementById('delete-id');
        id.value = data.id;
    }

</script>
@endsection
