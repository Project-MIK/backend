@extends('layouts.admin.app')
@section('content-header')
<h1>Medical Record</h1>
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
                <tr>
                    <th>no</th>
                    <th>no medrec</th>
                    <th>pasien</th>
                    <th>complain</th>
                    <th>officer</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>xx-xx-xx</td>
                    <td>slamet</td>
                    <td>dada sakit</td>
                    <td>prily latuconsina</td>
                    <td>
                        <div class="row">
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-detail' class="col detail btn btn-block btn-primary btn-sm">Detail</button></div>
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-delete' class=" col btn btn-block btn-danger btn-sm">Delete</button></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>xx-xx-xx</td>
                    <td>Dedi</td>
                    <td>pilek</td>
                    <td>Agus Salim</td>
                    <td>
                        <div class="row">
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-detail' class="col detail btn btn-block btn-primary btn-sm">Detail</button></div>
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-delete' class=" col btn btn-block btn-danger btn-sm">Delete</button></div>
                        </div>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>no</th>
                    <th>no medrec</th>
                    <th>pasien</th>
                    <th>complain</th>
                    <th>officer</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<x-modals.modal id-modal="modal-detail" modal-size="modal-lg" modal-bg="">
    <x-slot:header><h3>Detail Medical Record</h3></x-slot:Header>
    <x-slot:footer></x-slot:footer>
    <div class="form-group">
        <label for="form-petugas">Petugas</label>
        <input id="form-petugas" type="text" id="form-name" class="form-control" name="name" placeholder="Nama" required>
    </div>

    <h3>Patient</h3>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="detail-name">Nama</label>
                <p>Bachtiar Arya Habibie</p>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="detail-name">Tempat tanggal lahir</label>
                <p>Madiun. 18 January 2003</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="detail-email">Email</label>
                <p>Example@polije.com</p>
            </div>
        </div>
        <div class="col">

            <div class="form-group">
                <label for="form-telp">no telpon</label>
                <p>08xx xxxx xxxx</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>Gender</label>
                <p>Laki laki</p>
            </div>
        </div>
        <div class="col">
            <label for="">Blode type</label>
            <p>A</p>
        </div>
    </div>
    <div class="form-group">
        <label for="form-alamat">Alamat</label>
        <textarea id="form-alamat" class="form-control" name="address" rows="3" placeholder="Alamat ......" required></textarea>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="form-citizen">Citizen</label>
                <p>Indonesia</p>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="form-profesion">Profesion</label>
                <p>Programer</p>
            </div>
        </div>
    </div>
    <hr>
    <h3>Record</h3>
    <div class="form-group">
        <label for="form-profesion">Complaint</label>
        <p>ppusing</p>
    </div>
    <div class="form-group">
        <label for="form-profesion">Description</label>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis et ea odit at, quis veniam quidem molestias deserunt labore iure cum aspernatur accusantium, ex dolorum voluptatibus ad id esse numquam.</p>
    </div>
    <hr>
    <h3>Receipt</h3>
    <div class="form-group">
        <label for="form-profesion">Description</label>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis et ea odit at, quis veniam quidem molestias deserunt labore iure cum aspernatur accusantium, ex dolorum voluptatibus ad id esse numquam.</p>
    </div>
    <table class="table table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">obat</th>
                <th scope="col">jumlah</th>
                <th scope="col">Harga</th>
                <th scope="col">total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>bodrex</td>
                <td>1</td>
                <td>2000</td>
                <td>2000</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>obat tidur</td>
                <td>5</td>
                <td>1000</td>
                <td>5000</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td >yakult</td>
                <td>5</td>
                <td>2000</td>
                <td>10000</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>total :</td>
                <td>17000</td>
            </tr>
        </tbody>
    </table>
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
