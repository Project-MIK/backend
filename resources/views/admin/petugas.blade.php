@extends('layouts.admin.app')
@section('content-header')
    Petugas
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
                    <th>email</th>
                    <th>password</th>
                    <th>alamat</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Bachtiar Arya </td>
                    <td>bachtiar@gmail.com</td>
                    <td>*************</td>
                    <th>Banjarejo Degangan Madiun Jawa timur</th>
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
                    <td>aristo@gmail.com</td>
                    <td>*************</td>
                    <th>Banyuwangi Jawatimur</th>
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
@endsection

<x-modal>
    <x-slot:modalid>modal-rs</x-slot:modalid>
    <x-slot:judul>tambah no petugas</x-slot:judul>
    
</x-modal>

@section('after-js')
    
@endsection