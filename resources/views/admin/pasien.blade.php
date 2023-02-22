@extends('layouts.admin.app')

@section('content-header')
<h1>pasien</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">DataTable with default features</h3>
        {{-- {{dd($data)}} --}}
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
                @php($no = 0)
                @foreach($data as $record)
                @php($no++)
                <tr>
                    <td>{{$no}}</td>
                    <td>{{$record['name']}}</td>
                    @if($record['status']>0)
                    <td>code rekamedik</td>
                    @else
                    <td><button type="button" data-toggle='modal' data-target='#modal-rs' class="btn btn-block btn-success btn-xs">Tambahkan no rs</button></td>
                    @endif
                    <td>{{$record['gender']}}</td>
                    <th>{{$record['address']}}</th>
                    <th>
                        <div class="row">
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-detail' class="col detail btn btn-block btn-primary btn-sm">Detail</button></div>
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-delete' class=" col btn btn-block btn-danger btn-sm">Danger</button></div>
                        </div>
                    </th>
                </tr>
                @endforeach
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
    <form action="store" method="post">
        @csrf
        <form class="p-5 w-100" action="" method="POST">
            @csrf
            <div class="my-5">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCitizen" class="text-trouth">Kewarganegaraan</label>
                        <select id="inputCitizen" class="form-control" name="citizen" onchange="">
                            <option selected value="WNI">Indonesia</option>
                            <option value="WNA">Warga Negara Asing</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <div id="nik" class="d-block">
                            <label for="inputNik" class="text-trouth">NIK <span class="text-sm font-weight-normal">( Nomor Induk Kependudukan )</span></label>
                            <input type="text" class="form-control py-4" id="inputNik" name="nik" placeholder="Ketikkan nomor induk kependudukan" value="-" autofocus required>
                        </div>
                        <div id="paspor" class="d-none">
                            <label for="inputPaspor" class="text-trouth">Nomor Paspor</label>
                            <input type="text" class="form-control py-4" id="inputPaspor" name="no_paspor" placeholder="Ketikkan nomor paspor" value="-" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNama" class="text-trouth">Nama lengkap</label>
                        <input type="text" class="form-control py-4" id="inputNama" name="fullname" placeholder="Ketikkan nama lengkap" required>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPlaceBirth" class="text-trouth">Tempat Lahir</label>
                                <input type="text" class="form-control py-4" id="inputPlaceBirth" name="place_birth" placeholder="Ketikkan tempat lahir" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputBirthDate" class="text-trouth">Tanggal Lahir</label>
                                <input type="text" class="form-control datepicker py-4 pl-3" id="inputBirthDate" name="date_birth" placeholder="Hari-Bulan-Tahun" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputGender" class="text-trouth">Jenis Kelamin</label>
                                <select id="inputGender" class="form-control" name="gender">
                                    <option selected value="male">Laki-Laki</option>
                                    <option value="female">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputBloodGroup" class="text-trouth">Golongan Darah</label>
                                <select id="inputBloodGroup" class="form-control" name="blood_group">
                                    <option selected value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPekerjaan" class="text-trouth">Pekerjaan</label>
                        <input type="text" class="form-control py-4" id="inputPekerjaan" name="profession" placeholder="Ketikkan nama pekerjaan" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="address" class="text-trouth">Alamat</label>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputRT" class="text-trouth font-weight-light">RT</label>
                                <input type="text" class="form-control py-4" id="inputRT" name="address_RT" placeholder="Ketikkan nomor RT" oninput="numberOnly(this)" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputRW" class="text-trouth font-weight-light">RW</label>
                                <input type="text" class="form-control py-4" id="inputRW" name="address_RW" placeholder="Ketikkan nomor RW" oninput="numberOnly(this)" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputDusun" class="text-trouth font-weight-light">Dusun</label>
                                <input type="text" class="form-control py-4" id="inputDusun" name="address_dusun" placeholder="Ketikkan nama dusun" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputDesa" class="text-trouth font-weight-light">Desa</label>
                                <input type="text" class="form-control py-4" id="inputDesa" name="address_desa" placeholder="Ketikkan nama desa" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputKecamatan" class="text-trouth font-weight-light">Kecamatan</label>
                        <input type="text" class="form-control py-4" id="inputKecamatan" name="address_kecamatan" placeholder="Ketikkan nama kecamatan" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputKabupaten" class="text-trouth font-weight-light">Kabupaten</label>
                        <input type="text" class="form-control py-4" id="inputKabupaten" name="address_kabupaten" placeholder="Ketikkan nama kabupaten" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNoTelp" class="text-trouth">Nomor Telepon</label>
                        <input type="text" class="form-control py-4" id="inputNoTelp" name="no_telp" oninput="" placeholder="Ketikkan nomor telepon" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail" class="text-trouth">Email</label>
                        <input type="text" class="form-control py-4" id="inputEmail" name="email" placeholder="Ketikkan email" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword" class="text-trouth">Kata Sandi</label>
                        <input type="text" class="form-control py-4" id="inputPassword" name="password" placeholder="Ketikkan kata sandi" required>
                    </div>
                </div>
            </div>
        <button type="submit">Submit</button>
    </form>
</x-modal>

<x-modal>
    <x-slot:modalid>modal-detail</x-slot:modalid>
    <x-slot:judul>Detail Pasien</x-slot:judul>
    <form action="" method="post">
        <div class="d-flex">
            <form class="p-5 w-100" action="" method="POST">
                @csrf
                <div class="my-5">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputCitizen" class="text-trouth">Kewarganegaraan</label>
                            <select id="inputCitizen" class="form-control" name="citizen" onchange="setCitizen(this)">
                                <option selected value="indonesia">Indonesia</option>
                                <option value="WNA">Warga Negara Asing</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <div id="nik" class="d-block">
                                <label for="inputNik" class="text-trouth">NIK <span class="text-sm font-weight-normal">( Nomor Induk Kependudukan )</span></label>
                                <input type="text" class="form-control py-4" id="inputNik" name="nik" placeholder="Ketikkan nomor induk kependudukan" oninput="numberOnly(this)" autofocus required>
                            </div>
                            <div id="paspor" class="d-none">
                                <label for="inputPaspor" class="text-trouth">Nomor Paspor</label>
                                <input type="text" class="form-control py-4" id="inputPaspor" name="no_paspor" placeholder="Ketikkan nomor paspor" value="-" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNama" class="text-trouth">Nama lengkap</label>
                            <input type="text" class="form-control py-4" id="inputNama" name="fullname" placeholder="Ketikkan nama lengkap" required>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputPlaceBirth" class="text-trouth">Tempat Lahir</label>
                                    <input type="text" class="form-control py-4" id="inputPlaceBirth" name="place_birth" placeholder="Ketikkan tempat lahir" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputBirthDate" class="text-trouth">Tanggal Lahir</label>
                                    <input type="text" class="form-control datepicker py-4 pl-3" id="inputBirthDate" name="date_birth" placeholder="Hari-Bulan-Tahun" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputGender" class="text-trouth">Jenis Kelamin</label>
                                    <select id="inputGender" class="form-control" name="gender">
                                        <option selected value="male">Laki-Laki</option>
                                        <option value="female">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputBloodGroup" class="text-trouth">Golongan Darah</label>
                                    <select id="inputBloodGroup" class="form-control" name="blood_group">
                                        <option selected value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPekerjaan" class="text-trouth">Pekerjaan</label>
                            <input type="text" class="form-control py-4" id="inputPekerjaan" name="profession" placeholder="Ketikkan nama pekerjaan" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="address" class="text-trouth">Alamat</label>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputRT" class="text-trouth font-weight-light">RT</label>
                                    <input type="text" class="form-control py-4" id="inputRT" name="address_RT" placeholder="Ketikkan nomor RT" oninput="numberOnly(this)" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputRW" class="text-trouth font-weight-light">RW</label>
                                    <input type="text" class="form-control py-4" id="inputRW" name="address_RW" placeholder="Ketikkan nomor RW" oninput="numberOnly(this)" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputDusun" class="text-trouth font-weight-light">Dusun</label>
                                    <input type="text" class="form-control py-4" id="inputDusun" name="address_dusun" placeholder="Ketikkan nama dusun" required>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="inputDesa" class="text-trouth font-weight-light">Desa</label>
                                    <input type="text" class="form-control py-4" id="inputDesa" name="address_desa" placeholder="Ketikkan nama desa" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputKecamatan" class="text-trouth font-weight-light">Kecamatan</label>
                            <input type="text" class="form-control py-4" id="inputKecamatan" name="address_kecamatan" placeholder="Ketikkan nama kecamatan" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputKabupaten" class="text-trouth font-weight-light">Kabupaten</label>
                            <input type="text" class="form-control py-4" id="inputKabupaten" name="address_kabupaten" placeholder="Ketikkan nama kabupaten" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNoTelp" class="text-trouth">Nomor Telepon</label>
                            <input type="text" class="form-control py-4" id="inputNoTelp" name="no_telp" oninput="numberOnly(this)" placeholder="Ketikkan nomor telepon" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail" class="text-trouth">Email</label>
                            <input type="text" class="form-control py-4" id="inputEmail" name="email" placeholder="Ketikkan email" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword" class="text-trouth">Kata Sandi</label>
                            <input type="text" class="form-control py-4" id="inputPassword" name="password" placeholder="Ketikkan kata sandi" required>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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

@if(session('message'))
<script>
    console.log('mesage recorded');
    $(function() {
        $(document).ready(function() {
            $(document).Toasts('create', {
                class: 'bg-success'
                , title: 'success'
                , autohide: true
                , delay: 2000
                , body: '{{ session()->get('
                message.message ') }}'
            })
        });
    });

</script>
@endif
@if($errors->any())
<script>
    console.log('mesage recorded');
    $(function() {
        $(document).ready(function() {
            $(document).Toasts('create', {
                class: 'bg-danger'
                , title: 'error'
                , autohide: true
                , delay: 2000
                , body: '@foreach ($errors->all() as $error)<li>{{$error}}</li>@endforeach'
            })
        });
    });

</script>
{{-- {{dd($errors)}} --}}
@endif

@endsection
