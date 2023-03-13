@extends('layouts.admin.app')
@section('content-header')
<h1>Dokter</h1>
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
                    <th>gender</th>
                    <th>alamat</th>
                    <th>no telp</th>
                    <th>poliklinik</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Dr. Anis </td>
                    <td>Perempuan</td>
                    <td>Surabaya</td>
                    <td>0812 1213 4546</td>
                    <td>anak</td>
                    <td>
                        <div class="row">
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-detail' class="col detail btn btn-block btn-primary btn-sm">Detail</button></div>
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-delete' class=" col btn btn-block btn-danger btn-sm">Danger</button></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Dr. Adi </td>
                    <td>Laki- Laki</td>
                    <td>Malang</td>
                    <td>0812 1213 4546</td>
                    <td>dalam</td>
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
                    <th>gender</th>
                    <th>alamat</th>
                    <th>no telp</th>
                    <th>poliklinik</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<x-modals.modal id-modal="modal-tambah" modal-size="" modal-bg="">
    <x-slot:header><h3>Tambah Dokter</h3></x-slot:Header>
    <x-slot:footer></x-slot:footer>
    <form action="" method="post">
        @csrf
        <div class="form-group">
            <label for="form-name">Nama</label>
            <input id="form-name" type="text" id="form-name" class="form-control" name="name" placeholder="Nama" required>
        </div>
        <div class="form-group">
            <label>Gender</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="M" type="radio" id="man" name="customRadio" required>
                <label for="man" class="custom-control-label">laki-laki</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="W" type="radio" id="woman" name="customRadio" required>
                <label for="woman" class="custom-control-label">Perempuan</label>
            </div>
        </div>
        <div class="form-group">
            <label for="form-alamat">Alamat</label>
            <textarea  id="form-alamat" class="form-control" name="address" rows="3" placeholder="Alamat ......" required></textarea>
        </div>
        <div class="form-group">
            <label for="form-telp">no telpon</label>
            <input id="form-telp" type="tel" class="form-control" name="telp" placeholder="08xx" required required pattern="[0-9\+]+">
        </div>
        <div class="form-group">
            <label for="form-poli">Poliklinik</label>
            <input id="form-poli" type="text" class="form-control" name="poliklinik" placeholder="poli" required>
        </div>
        <button type="submit" class="col-5 btn btn-block btn-success ml-auto">Simpan</button>
    </form>
</x-modals.modal>


<x-modals.modal id-modal="modal-detail" modal-size="" modal-bg="">
    <x-slot:header><h3>Detail Dokter</h3></x-slot:Header>
    <x-slot:footer></x-slot:footer>
    <form action="" method="put">
        @csrf
        <div class="form-group">
            <label for="form-name">Nama</label>
            <input id="form-name" type="text" id="form-name" class="form-control" name="name" placeholder="Nama" required>
        </div>
        <div class="form-group">
            <label>Gender</label>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="M" type="radio" id="man" name="customRadio" required>
                <label for="man" class="custom-control-label">laki-laki</label>
            </div>
            <div class="custom-control custom-radio">
                <input class="custom-control-input" value="W" type="radio" id="woman" name="customRadio" required>
                <label for="woman" class="custom-control-label">Perempuan</label>
            </div>
        </div>
        <div class="form-group">
            <label for="form-alamat">Alamat</label>
            <textarea  id="form-alamat" class="form-control" name="address" rows="3" placeholder="Alamat ......" required></textarea>
        </div>
        <div class="form-group">
            <label for="form-telp">no telpon</label>
            <input id="form-telp" type="tel" class="form-control" name="telp" placeholder="08xx" required required pattern="[0-9\+]+">
        </div>
        <div class="form-group">
            <label for="form-poli">Poliklinik</label>
            <input id="form-poli" type="text" class="form-control" name="poliklinik" placeholder="poli" required>
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
