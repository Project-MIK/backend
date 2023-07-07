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
                <button type='button' data-toggle='modal' data-target='#modal-tambah' class='col-4 btn btn-block btn-default'>Tambah</button>
                <tr>
                    <th>no</th>
                    <th hidden></th>
                    <th>nama</th>
                    <th>email</th>
                    <th>no_telp</th>
                    <th>gender</th>
                    <th hidden></th>
                    <th>poliklinik</th>
                    <th hidden></th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                @php($no = 1)
                @foreach($doctors as $doctor)
                <tr>
                    <td>{{$no++}}</td>
                    <td hidden>{{$doctor['id']}}</td>
                    <td>{{$doctor['name']}}</td>
                    <td>{{$doctor['email']}}</td>
                    <td>{{$doctor['phone']}}</td>
                    <td>{{$doctor['gender'] == "W" ? "Perempuan" : "Laki-Laki"}}</td>
                    <td hidden>{{$doctor['polyclinic_id']}}</td>
                    <td>{{$doctor['polyclinic']['name']}}</td>
                    <td hidden>{{$doctor['address']}}</td>
                    <td>
                        <div class="row">
                            <div class="col"><button onclick="setEdit(this)" type="button" data-toggle='modal' data-target='#modal-detail' class="col detail btn btn-block btn-primary btn-sm">Detail</button></div>
                            <div class="col"><button onclick="setDelete(this)" type="button" data-toggle='modal' data-target='#modal-delete' class=" col btn btn-block btn-danger btn-sm">Danger</button></div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>no</th>
                    <th hidden></th>
                    <th>nama</th>
                    <th>email</th>
                    <th>no_telp</th>
                    <th>gender</th>
                    <th hidden></th>
                    <th>poliklinik</th>
                    <th hidden></th>
                    <th>aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<x-modals.modal id-modal="modal-tambah" modal-size="" modal-bg="">
    <x-slot:header>
        <h3>Tambah Dokter</h3>
    </x-slot:Header>
    <x-slot:footer></x-slot:footer>
    <form action="/admin/doctor/store" method="post">
        @csrf
        <div class="form-group">
            <label for="form-name">Nama</label>
            <input type="text"  class="form-control" name="name" autocomplete="username"  required>
        </div>
        <div class="form-group">
            <label for="form-name">email</label>
            <input type="email" class="form-control" name="email" autocomplete="email" required>
        </div>
        <div class="form-group">
            <label for="form-name">Password</label>
            <input type="password" autocomplete="current-password" class="form-control" name="password" required>
        </div>
        <div class="form-group">
            <label for="form-telp">no telpon</label>
            <input type="tel" class="form-control" name="phone" placeholder="08xx" required required pattern="[0-9\+]+">
        </div>
        <div class="form-group">
            <label>Gender</label>
            <select class="form-control" name="gender">
                <option value="M">laki laki</option>
                <option value="W">perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label >Poliklinik</label>
            <select class="form-control" name="polyclinic_id">
                @foreach($polyclinics as $polyclinic)
                    <option value="{{$polyclinic['id']}}">{{$polyclinic['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="form-alamat">Alamat</label>
            <textarea  class="form-control" name="address" rows="3" placeholder="Alamat ......" required></textarea>
        </div>
        <button type="submit" class="col-5 btn btn-block btn-success ml-auto">Simpan</button>
    </form>
</x-modals.modal>


<x-modals.modal id-modal="modal-detail" modal-size="" modal-bg="">
    <x-slot:header>
        <h3>Detail Dokter</h3>
    </x-slot:Header>
    <x-slot:footer></x-slot:footer>
    <form action="/admin/doctor/update" method="POST">
        @csrf
        @method('put')
        <input type="text" name="id" id="form-id" hidden>
        <div class="form-group">
            <label for="form-name">Nama</label>
            <input id="form-name" type="text" id="form-name" class="form-control" name="name" placeholder="Nama" required>
        </div>
        <div class="form-group">
            <label for="form-name">email</label>
            <input id="form-email" type="email" id="form-name" class="form-control" name="email" required>
        </div>
        <div class="form-group">
            <label for="form-telp">no telpon</label>
            <input id="form-telp" type="tel" class="form-control" name="phone" placeholder="08xx" required required pattern="[0-9\+]+">
        </div>
        <div class="form-group">
            <label>Gender</label>
            <select class="form-control" id="form-gender" name="gender">
                <option value="M">laki laki</option>
                <option value="W">perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="form-poli">Poliklinik</label>
            <select id="form-poli" class="form-control" id="form-gender" name="polyclinic_id">
                @foreach($polyclinics as $polyclinic)
                    <option value="{{$polyclinic['id']}}">{{$polyclinic['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="form-alamat">Alamat</label>
            <textarea id="form-address" class="form-control" name="address" rows="3" placeholder="Alamat ......" required></textarea>
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
    <form action="/admin/doctor/destroy" method="post">
        @csrf
        @method('delete')
        <input type="text" id="delete-id" hidden name="id">
        <div class="row">
            <div class="col">
                <div class="d-flex align-items-center justify-content-center"><button type="submit" class=" btn btn-outline-light">Ya!</button></div>
            </div>
            <div class="col">
                <div class="d-flex align-items-center justify-content-center"><button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button></div>
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
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });



    function getData(button) {
        tabel = button.parentElement.parentElement.parentElement.parentElement;
        rawData = tabel.getElementsByTagName('td');

        

        var obj = {
            id: rawData[1].innerText
            , name: rawData[2].innerText
            , email: rawData[3].innerHTML
            , telp: rawData[4].innerHTML
            , gender: rawData[5].innerHTML
            , id_poly: rawData[6].innerHTML
            , poly: rawData[7].innerHTML
            , address: rawData[8].innerHTML
        };

        if (obj.gender == 'Laki-Laki') {
            obj.gender = 'M';
        } else if (obj.gender == 'Perempuan') {
            obj.gender = 'W';
        }else{
            obj.gender = '';
        }

        return obj;
    }

    function setEdit(params) {
        var data = getData(params);
        var id = document.getElementById('form-id');
        var name = document.getElementById('form-name');
        var email = document.getElementById('form-email');
        var gender = document.getElementById('form-gender');
        var address = document.getElementById('form-address');
        var telp = document.getElementById('form-telp');
        var poly = document.getElementById('form-poli');

        console.log(data.gender);
        id.value = data.id;
        name.value = data.name;
        email.value = data.email;
        gender.value = data.gender;
        address.value = data.address;
        telp.value = data.telp;
        poly.value = data.id_poly;
    }

    function setDelete(params) {
        var data = getData(params);
        var id = document.getElementById('delete-id');
        id.value = data.id;
    }

</script>
@endsection
