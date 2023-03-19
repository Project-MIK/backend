@extends('layouts.admin.app')
@section('content-header')
<h1><a href="/admin/pasien">Patient</a>/Tambah</h1>
@endsection
@section('content')
<div class="container">
    <form action="/admin/pasien/store" method="post">
        @csrf
        <form class="p-5 w-100" action="" method="POST">
            @csrf
            <div class="my-5">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCitizen" class="text-trouth">Kewarganegaraan</label>
                        <select id="inputCitizen" class="form-control" name="citizen" onchange="setNIK(this)">
                            <option selected value="WNI">Warga Negara Indonesia</option>
                            <option value="WNA">Warga Negara Asing</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <div id="nik" class="d-block">
                            <label for="inputNik" id="labelNik"  class="text-trouth">NIK <span class="text-sm font-weight-normal">( Nomor Induk Kependudukan )</span></label>
                            <input type="number" value="{{old('nik')}}" class="form-control py-4" id="inputNik" name="nik" placeholder="Ketikkan nomor induk kependudukan" value="-" autofocus required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNama" class="text-trouth">Nama lengkap</label>
                        <input type="text" value="{{ old('fullname') }}" class="form-control py-4" id="inputNama" name="fullname" placeholder="Ketikkan nama lengkap" required>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPlaceBirth" class="text-trouth">Tempat Lahir</label>
                                <input type="text" class="form-control py-4" {{ old('place_birth') }} id="inputPlaceBirth" name="place_birth" placeholder="Ketikkan tempat lahir" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputBirthDate" class="text-trouth">Tanggal Lahir</label>
                                <input type="text" class="form-control datepicker py-4 pl-3" id="inputBirthDate" {{ old('date_birth') }} name="date_birth" placeholder="Hari-Bulan-Tahun" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputGender" class="text-trouth">Jenis Kelamin</label>
                                <select id="inputGender" class="form-control" name="gender" >
                                    <option selected value="M">Laki-Laki</option>
                                    <option {{old('gender') == "W" ? 'selected' : ''}} value="W">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputBloodGroup" class="text-trouth">Golongan Darah</label>
                                <select id="inputBloodGroup" class="form-control" name="blood_group">
                                    <option selected value="-">-</option>
                                    <option value="B" {{ old('blood_group') == "B" ? 'selected' : '' }}>B</option>
                                    <option value="AB" {{ old('blood_group') == "AB" ? 'selected' : '' }}>AB</option>
                                    <option value="O" {{ old('blood_group') == "O" ? 'selected' : '' }}>O</option>
                                    <option value="A" {{ old('blood_group') == "A" ? 'selected' : '' }}>A</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPekerjaan" class="text-trouth">Pekerjaan</label>
                        <input type="text" class="form-control py-4" value="{{ old('profession') }}" id="inputPekerjaan" name="profession" placeholder="Ketikkan nama pekerjaan" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="address" class="text-trouth">Alamat</label>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputRT" class="text-trouth font-weight-light">RT</label>
                                <input type="text" class="form-control py-4" id="inputRT" value="{{ old('address_RT') }}" name="address_RT" placeholder="Ketikkan nomor RT" oninput="numberOnly(this)" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputRW" class="text-trouth font-weight-light">RW</label>
                                <input type="text" class="form-control py-4" id="inputRW" value="{{ old('address_RW') }}" name="address_RW" placeholder="Ketikkan nomor RW" oninput="numberOnly(this)" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputDusun" class="text-trouth font-weight-light">Dusun</label>
                                <input type="text" class="form-control py-4" id="inputDusun" value="{{ old('address_dusun') }}" name="address_dusun" placeholder="Ketikkan nama dusun" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputDesa" class="text-trouth font-weight-light">Desa</label>
                                <input type="text" class="form-control py-4" id="inputDesa" value="{{ old('address_desa') }}" name="address_desa" placeholder="Ketikkan nama desa" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputKecamatan" class="text-trouth font-weight-light">Kecamatan</label>
                        <input type="text" class="form-control py-4" id="inputKecamatan" value="{{ old('address_kecamatan') }}" name="address_kecamatan" placeholder="Ketikkan nama kecamatan" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputKabupaten" class="text-trouth font-weight-light">Kabupaten</label>
                        <input type="text" class="form-control py-4" id="inputKabupaten" value="{{ old('address_kabupaten') }}" name="address_kabupaten" placeholder="Ketikkan nama kabupaten" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNoTelp" class="text-trouth">Nomor Telepon</label>
                        <input type="text" class="form-control py-4" id="inputNoTelp" name="phone_number" value="{{ old('phone_number') }}" placeholder="Ketikkan nomor telepon" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputNoTelp" class="text-trouth">Nomor Rekamedik</label>
                        <input type="text" class="form-control py-4" id="inputNoTelp" name="medical_record_id" value="{{ old('medical_record_id') }}" placeholder="Ketikkan nomor telepon" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail" class="text-trouth">Email</label>
                        <input type="text" class="form-control py-4" id="inputEmail" name="email" value="{{ old('email') }}" placeholder="Ketikkan email" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword" class="text-trouth">Kata Sandi</label>
                        <input type="text" class="form-control py-4" id="inputPassword" name="password" value="{{ old('password') }}" placeholder="Ketikkan kata sandi" required>
                    </div>
                </div>
            </div>
            <input hidden value="1" name="id_registration_officer">
            <button type='submit' class='ml-auto col-2 btn btn-block btn-success'>Tambah</button>
        </form>
</div>
@endsection
@section('after-js')
<script>
    function setNIK(params) {
        console.log("setNik trigered");
        input = document.getElementById('inputNik');
        label = document.getElementById('labelNik');

        switch (params.value) {
            case "WNA":
                label.innerHTML = "Paspor";
                input.name = "paspor"
                console.log("chnge to paspor");
                break;
            case "WNI":
                label.innerHTML = "NIK";
                input.name = "nik"
                console.log("change to NIK");
                break;
            default:
                console.log("bothing happen");
                break;
        }
    }

</script>
@endsection
