@extends('layouts.admin.app')
@section('content-header')
<h1><a href="/admin/pasien">pasien</a>/Detail</h1>
@endsection

@section('content')
<form class="p-5 w-100" action="/admin/pasien/update" method="POST">
    @csrf
    @method('put')
    <div class="my-5">
        
        @if($data['citizen']=='WNI')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCitizen" class="text-trouth">Kewarganegaraan</label>
                <input type="text" value="{{$data['citizen']}}" class="form-control py-4" id="inputCitizen" name="citizen" placeholder="Ketikkan nomor induk kependudukan" readonly required>

            </div>
            <div class="form-group col-md-6">
                <div id="nik" class="d-block">
                    <label for="inputNik" id="labelNik" class="text-trouth">NIK <span class="text-sm font-weight-normal">( Nomor Induk Kependudukan )</span></label>
                    <input type="text" value="{{$data['nik']}}" class="form-control py-4" id="inputNik" name="nik" placeholder="Ketikkan nomor induk kependudukan" autofocus required>
                </div>
            </div>
        </div>
        @else
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCitizen" class="text-trouth">Kewarganegaraan</label>
                <input type="text" value="{{$data['citizen']}}" class="form-control py-4" id="inputCitizen" name="citizen" placeholder="Ketikkan nomor induk kependudukan" readonly required>

            </div>
            <div class="form-group col-md-6">
                <div id="nik" class="d-block">
                    <label for="inputNik" id="labelNik" class="text-trouth">Nomor Paspor</label>
                    <input type="text" value="{{$data['no_paspor']}}" class="form-control py-4" id="inputNik" name="nik" placeholder="Ketikkan nomor induk kependudukan" autofocus required>
                </div>
            </div>
        </div>
        @endif
        
        </select>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputNama" class="text-trouth">Nama lengkap</label>
                <input type="text" class="form-control py-4" value="{{$data['fullname']}}" id="inputNama" name="fullname" placeholder="Ketikkan nama lengkap" required>
            </div>
            <div class="form-group col-md-6">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPlaceBirth" class="text-trouth">Tempat Lahir</label>
                        <input type="text" class="form-control py-4" value="{{$data['place_birth']}}" id="inputPlaceBirth" name="place_birth" placeholder="Ketikkan tempat lahir" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputBirthDate" class="text-trouth">Tanggal Lahir</label>
                        <input type="text" value="{{$data['date_birth']}}" class="form-control datepicker py-4 pl-3" id="inputBirthDate" name="date_birth" placeholder="Hari-Bulan-Tahun" required>
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
                            {{$data['gender']}}
                            @if($data['gender']=="M")
                            <option selected value="male">Laki-Laki</option>
                            <option value="female">Perempuan</option>
                            @else
                            <option value="male">Laki-Laki</option>
                            <option selected value="female">Perempuan</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputBloodGroup" class="text-trouth">Golongan Darah {{$data['blood_group']}}</label>
                        <select id="inputBloodGroup" class="form-control" name="blood_group">
                            
                            @switch($data['blood_group'])
                                @case("A")
                                    <option selected value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                    <option value="-"></option>
                                    @break
                                @case("B")
                                    <option value="A">A</option>
                                    <option selected value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                    <option value="-"></option>
                                    @break
                                @case("AB")
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option selected value="AB">AB</option>
                                    <option value="O">O</option>
                                    <option value="-"></option>
                                    @break
                                @case("O")
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option selected value="O">O</option>
                                    <option value="-"></option>
                                    @break
                                @default
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                    <option value="O">O</option>
                                    <option selected value="-"></option>
                                    @break
                            @endswitch
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPekerjaan" class="text-trouth">Pekerjaan</label>
                <input type="text" class="form-control py-4" value="{{$data['profession']}}" id="inputPekerjaan" name="profession" placeholder="Ketikkan nama pekerjaan" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="address" class="text-trouth">Alamat</label>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputRT" class="text-trouth font-weight-light">RT</label>
                        <input value="{{$data['address_RT']}}" type="text" class="form-control py-4" id="inputRT" name="address_RT" placeholder="Ketikkan nomor RT" oninput="numberOnly(this)" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputRW" class="text-trouth font-weight-light">RW</label>
                        <input value="{{$data['address_RW']}}" type="text" class="form-control py-4" id="inputRW" name="address_RW" placeholder="Ketikkan nomor RW" oninput="numberOnly(this)" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputDusun" class="text-trouth font-weight-light">Dusun</label>
                        <input value="{{$data['address_desa']}}" type="text" class="form-control py-4" id="inputDusun" name="address_dusun" placeholder="Ketikkan nama dusun" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputDesa" class="text-trouth font-weight-light">Desa</label>
                        <input value="{{$data['address_dusun']}}" type="text" class="form-control py-4" id="inputDesa" name="address_desa" placeholder="Ketikkan nama desa" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputKecamatan" class="text-trouth font-weight-light">Kecamatan</label>
                <input value="{{$data['address_kecamatan']}}" type="text" class="form-control py-4" id="inputKecamatan" name="address_kecamatan" placeholder="Ketikkan nama kecamatan" required>
            </div>
            <div class="form-group col-md-6">
                <label for="inputKabupaten" class="text-trouth font-weight-light">Kabupaten</label>
                <input value="{{$data['address_kabupaten']}}" type="text" class="form-control py-4" id="inputKabupaten" name="address_kabupaten" placeholder="Ketikkan nama kabupaten" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputNoTelp" class="text-trouth">Nomor Telepon</label>
                <input value="{{$data['phone_number']}}" type="text" class="form-control py-4" id="inputNoTelp" name="no_telp" oninput="numberOnly(this)" placeholder="Ketikkan nomor telepon" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputEmail" class="text-trouth">Email</label>
                <input readonly value="{{$data['email']}}" type="text" class="form-control py-4" id="inputEmail" name="email" placeholder="Ketikkan email" required>
            </div>
        </div>
    </div>
    <input type="text" name="medical_record_id" value="{{$data['medical_record_id']}}" hidden>
    <button type='submit' class='ml-auto col-2 btn btn-block btn-primary'>Update</button>
</form>
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
                input.name = "paspor";
                break;
            case "WNI":
                label.innerHTML = "NIK";
                input.name = "nik"
                break;
            default:
                break;
        }
    }

    // $(function() {
    //     $(document).ready(function() {
    //         setNIK(document.getElementById('inputCitizen'));
    //     });
    // });

</script>
@endsection
