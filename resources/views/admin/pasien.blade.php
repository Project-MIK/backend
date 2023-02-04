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
                    <td>Bachtiar Arya Habibie</td>
                    <td>xxx-xxx-xxx</td>
                    <td>laki laki</td>
                    <th>351xxxxxxxxxx</th>
                    <th>
                        <div class="row">
                            <div class="col"><button type="button" class="col btn btn-block btn-primary">Detail</button></div>
                            <div class="col"><button type="button" class=" col btn btn-block btn-danger">Danger</button></div>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Aristo Cessar</td>
                    <td>xxx-xxx-xxx</td>
                    <td>laki laki</td>
                    <th>351xxxxxxxxxx</th>
                    <th>
                        <div class="row">
                            <div class="col"><button type="button" class="col btn btn-block btn-primary">Detail</button></div>
                            <div class="col"><button type="button" class=" col btn btn-block btn-danger">Danger</button></div>
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

</script>

@endsection
