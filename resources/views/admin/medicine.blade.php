@extends('layouts.admin.app')
@section('content-header')
<h1>Medicine</h1>
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
                <button type='button' data-toggle='modal' data-target='#modal-tambah' class='ml-auto col-2 btn btn-block btn-default'>Tambah</button>
                <tr>
                    <th>no</th>
                    <th>nama</th>
                    <th>harga</th>
                    <th>stok</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Paracetamol</td>
                    <td>5000</td>
                    <td>10</td>
                    <td>
                        <div class="row">
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-detail' class="col detail btn btn-block btn-primary btn-sm">Detail</button></div>
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-delete' class=" col btn btn-block btn-danger btn-sm">Danger</button></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>peniciline</td>
                    <td>1000</td>
                    <td>50</td>
                    <td>
                        <div class="row">
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-detail' class="col detail btn btn-block btn-primary btn-sm">Detail</button></div>
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-delete' class=" col btn btn-block btn-danger btn-sm">Danger</button></div>
                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>no</th>
                    <th>nama</th>
                    <th>harga</th>
                    <th>stok</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<x-modals.modal id-modal="modal-tambah" modal-size="" modal-bg="">
    <x-slot:header><h3>Tambah Obat</h3></x-slot:Header>
    <x-slot:footer></x-slot:footer>
    <form action="" method="post">
        @csrf
        <div class="form-group">
            <label for="form-name">Nama</label>
            <input id="form-name" type="text" id="form-name" class="form-control" name="name" placeholder="Nama" required>
        </div>

        <div class="form-group">
            <label for="form-harga">harga</label>
            <input id="form-harga" type="number" class="form-control" name="telp" placeholder="08xx" required >
        </div>
        <div class="form-group">
            <label for="form-stok">stok</label>
            <input id="form-stok" type="number" class="form-control" name="poliklinik" placeholder="poli" required>
        </div>
        <button type="submit" class="col-5 btn btn-block btn-success ml-auto">Simpan</button>
    </form>
</x-modals.modal>

<x-modals.modal id-modal="modal-detail" modal-size="" modal-bg="">
    <x-slot:header><h3>Detail Obat</h3></x-slot:Header>
    <x-slot:footer></x-slot:footer>
    <form action="" method="post">
        @csrf
        <div class="form-group">
            <label for="detail-name">Nama</label>
            <input id="datail-name" type="text" id="form-name" class="form-control" name="name" placeholder="Nama" required>
        </div>

        <div class="form-group">
            <label for="datail-harga">harga</label>
            <input id="detail-harga" type="number" class="form-control" name="telp" placeholder="08xx" required >
        </div>
        <div class="form-group">
            <label for="datail-stok">stok</label>
            <input id="detail-stok" type="number" class="form-control" name="poliklinik" placeholder="poli" required>
        </div>
        <button type="submit" class="col-5 btn btn-block btn-success ml-auto">Simpan</button>
    </form>
</x-modals.modal>


<x-modals.modal id-modal="modal-delete" modal-size="modal-sm" modal-bg="bg-danger">
    <x-slot:header><h3>Warning</h3></x-slot:Header>
    <x-slot:footer></x-slot:footer>
    <h5>apakah anda yakin ingin menghapus data ini?</h5>
    <form action="" method="post">
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
    @endsection
