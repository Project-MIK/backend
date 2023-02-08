@extends('layouts.admin.app')

@section('content-header')
<h1>pasien</h1>
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
                    <th>no rekamedik</th>
                    <th>gender</th>
                    <th>no ktp</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Bachtiar Arya </td>
                    <td>xxx-xxx-xxx</td>
                    <td>laki laki</td>
                    <th>351xxxxxxxxxx</th>
                    <th>
                        <div class="row">
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-detail' class="col detail btn btn-block btn-primary btn-sm">Detail</button></div>
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-delete' class=" col btn btn-block btn-danger btn-sm">Danger</button></div>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Aristo Cessar</td>
                    <td><button type="button" data-toggle='modal' data-target='#modal-rs' class="btn btn-block btn-success btn-xs">Tambahkan no rs</button></td>
                    <td>laki laki</td>
                    <th>351xxxxxxxxxx</th>
                    <th>
                        <div class="row">
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-detail' class="detail col btn btn-block btn-primary btn-sm">Detail</button></div>
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-delete' class=" col btn btn-block btn-danger btn-sm">Danger</button></div>
                        </div>
                    </th>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>no</th>
                    <th>nama</th>
                    <th>no rekamedik</th>
                    <th>gender</th>
                    <th>no ktp</th>
                    <th>aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<x-modal modalid="modal-tambah" judul="Tambah Data Pasien">
    <x-slot:modalid>modal-tambah</x-slot:modalid>
    <x-slot:judul>Tambah Data Pasien</x-slot:judul>
    <form action="{{url('')}}admin/token" method="post">
        <input type="email" name="" id="">
        <button type="submit">simpan</button>
    </form>
</x-modal>

<x-modal>
    <x-slot:modalid>modal-detail</x-slot:modalid>
    <x-slot:judul>Detail Pasien</x-slot:judul>
    <form action="" method="post">
        <input type="text" name="" id="detail-nama">
        <button type="submit">simpan</button>
    </form>
</x-modal>

<x-modal>
    <x-slot:modalid>modal-rs</x-slot:modalid>
    <x-slot:judul>tambah no rekamedis</x-slot:judul>
    <form action="" method="post">
        <input type="text" name="" id="">
        <button type="submit">simpan</button>
    </form>
</x-modal>

<x-sm-modal>
    <x-slot:id>modal-delete</x-slot:id>
    <x-slot:title>Warning</x-slot:title>
    <h5>apakah anda yakin ingin menghapus data ini?</h5>
    <form action="" method="post">
        <button type="submit">ya</button>
    </form>
</x-sm-modal>

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
