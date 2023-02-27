<div id="setting">
    @if($errors->any())                   
        <div class="alert alert-danger" role="alert">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
    @endif
    @if ($message = Session::get('message'))    
        <div class="alert alert-success" role="alert">
            {{$message}}
        </div>      
    @endif
    <form action="/dashboard/save-setting" method="post">
        @csrf
        <input class="form-control d-none" type="text" name="id" value="{{$pacient['id']}}">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCitizen" class="text-trouth">Kewarganegaraan</label>
                <input type="text" class="form-control py-4" id="inputCitizen" name="citizen" placeholder="Ketikkan kewarganegaraan" value="{{ strtoupper($pacient['citizen']) }}" readonly required>
            </div>
            <div class="form-group col-md-6">
                @if ($pacient['nik'] != "-")
                    <div id="nik">
                        <label for="inputNik" class="text-trouth">NIK <span class="text-sm font-weight-normal">( Nomor Induk Kependudukan )</span></label>
                        <input type="text" class="form-control py-4" id="inputNik" name="nik" placeholder="Ketikkan nomor induk kependudukan" value="{{ $pacient['nik'] }}" oninput="numberOnly(this)" autofocus required>
                    </div>
                @else
                    <div id="paspor">
                        <label for="inputPaspor" class="text-trouth">Nomor Paspor</label>
                        <input type="text" class="form-control py-4" id="inputPaspor" name="no_paspor" placeholder="Ketikkan nomor paspor" value="{{ $pacient['no_paspor'] }}" autofocus required>
                    </div>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputNama" class="text-trouth">Nama lengkap</label>
                <input type="text" class="form-control py-4" id="inputNama" name="fullname" placeholder="Ketikkan nama lengkap" value="{{$pacient['fullname']}}" required>
            </div>
            <div class="form-group col-md-6">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPlaceBirth" class="text-trouth">Tempat Lahir</label>
                        <input type="text" class="form-control py-4" id="inputPlaceBirth" name="place_birth" placeholder="Ketikkan tempat lahir" value="{{$pacient['place_birth']}}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputBirthDate" class="text-trouth">Tanggal Lahir</label>
                        <input type="text" class="form-control datepicker py-4 pl-3" id="inputBirthDate" name="birth_date" placeholder="Hari-Bulan-Tahun" value="{{$pacient['date_birth']}}" required>
                    </div>
                </div> 
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputGender" class="text-trouth">Jenis Kelamin</label>
                        <select id="inputGender" class="form-control" name="gender" autocomplete="off">
                            <option value="M" {{$pacient['gender'] == "M" ? "selected":""}}>Laki-Laki</option>
                            <option value="W" {{$pacient['gender'] == "W" ? "selected":""}}>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputBloodGroup" class="text-trouth">Golongan Darah</label>
                        <select id="inputBloodGroup" class="form-control" name="blood_group" autocomplete="off">
                            @foreach ($blood_group as $blood)
                                <option value="{{$blood}}" {{$pacient['blood_group'] == $blood ?"selected":""}}>{{$blood}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> 
            </div>
            <div class="form-group col-md-6">
                <label for="inputPekerjaan" class="text-trouth">Pekerjaan</label>
                <input type="text" class="form-control py-4" id="inputPekerjaan" name="profession" placeholder="Ketikkan nama pekerjaan" value="{{$pacient['profession']}}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="address" class="text-trouth">Alamat</label>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputRT" class="text-trouth font-weight-light">RT</label>
                        <input type="text" class="form-control py-4" id="inputRT" name="address_RT" placeholder="Ketikkan nomor RT" oninput="numberOnly(this)" value="{{$addreass[0]}}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputRW" class="text-trouth font-weight-light">RW</label>
                        <input type="text" class="form-control py-4" id="inputRW" name="address_RW" placeholder="Ketikkan nomor RW" oninput="numberOnly(this)" value="{{$addreass[1]}}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputDusun" class="text-trouth font-weight-light">Dusun</label>
                        <input type="text" class="form-control py-4" id="inputDusun" name="address_Dusun" placeholder="Ketikkan nama dusun" value="{{$addreass[2]}}" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputDesa" class="text-trouth font-weight-light">Desa</label>
                        <input type="text" class="form-control py-4" id="inputDesa" name="address_Desa" placeholder="Ketikkan nama desa" value="{{$addreass[3]}}" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputKecamatan" class="text-trouth font-weight-light">Kecamatan</label>
                <input type="text" class="form-control py-4" id="inputKecamatan" name="address_kecamatan" placeholder="Ketikkan nama kecamatan" value="{{$addreass[4]}}" required>
            </div>
            <div class="form-group col-md-6">
                <label for="inputKabupaten" class="text-trouth font-weight-light">Kabupaten</label>
                <input type="text" class="form-control py-4" id="inputKabupaten" name="address_kabupaten" placeholder="Ketikkan nama kabupaten" value="{{$addreass[5]}}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputNoTelp" class="text-trouth">Nomor Telepon</label>
                <input type="text" class="form-control py-4" id="inputNoTelp" name="number_phone" oninput="numberOnly(this)" placeholder="Ketikkan nomor telepon" value="{{$pacient['number_phone']}}" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputRT" class="text-trouth">Email</label>
                <div class="d-flex">
                    <div class="w-75">
                        <input type="text" class="form-control py-4 mr-2" name="email" placeholder="Ketikkan email" value="{{$pacient['email']}}" readonly required>
                    </div>
                    <button type="button" class="btn btn-trouth text-white w-50 ml-2" data-toggle="modal" data-target="#modalChangeEmail">
                        Ganti Email
                    </button>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputKecamatan" class="text-trouth">Kata Sandi</label>
                        <button id="btn-change-password" type="button" data-toggle="modal" data-target="#modalChangePassword" class="btn btn-trouth text-white w-100">
                            Ganti Kata Sandi
                        </button>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="createdAt" class="text-trouth">Terdaftar Sejak</label>
                        <input id="createdAt" type="text" class="form-control py-4" placeholder="Terdaftar sejak" value="{{$pacient['created_at']}}" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-4">
            <button id="btn-change-profile" type="submit" class="btn btn-bunting text-white font-weight-bold">Simpan Perubahan</button>
        </div>
    </form>
</div>