@extends('layouts.admin.app')
@section('content-header')

@endsection
@section('content')
{{-- nama, email, password, address --}}
<div class="container ">
    <form action="/admin/setting/update" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Id</label>
            <input type="text" name="name" readonly class="form-control" placeholder="Nama" value="{{$data['id']}}">
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" placeholder="Nama" value="{{$data['name']}}">
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" name="address" rows="3" placeholder="alamat">{{$data['address']}}</textarea>
        </div>
        <div class="ml-auto">
            <button type="submit" class="btn btn-block btn-success btn-lg">Save</button>
        </div>
        <br>
    </form>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>email</label>
                <div class="row">
                    <div class="col"><input type="email" class="form-control" readonly placeholder="email" value="{{$data['email']}}"></div>
                    <div class="col">
                        <button type="button" data-toggle='modal' data-target='#modal-email' class="btn btn-block btn-secondary align-bottom">Ganti Email</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="col">
            <div class="form-group">
                <label>password</label>
                <button type="button" data-toggle='modal' data-target='#modal-password' class="btn btn-block btn-secondary align-bottom">Ganti Password</button>
            </div>

        </div>
    </div>
</div>

<x-modals.modal id-modal='modal-password' modal-size='' modal-bg='' footer=''>
    <x-slot:header>
        <h2>Ganti Password</h2>
    </x-slot:header>
    <form id="form_password" action="/admin/setting/update/password" method="POST">
        @csrf
        @method('put')
        <input type="text" name="id" id="password-id" value="{{$data['id']}}" hidden>
        <div class="form-group">
            <label>Password</label>
            <input type="text" class="form-control" required placeholder="password" id="password" name="password">
        </div>
        <div class="form-group">
            <label>Konfirmasi Password</label>
            <p class="text-danger" id="text-password" hidden>Password tidak sama</p>
            <input required type="text" class="form-control" placeholder="konfirmasi password" id="cPassword" name="confirm_password">
        </div>
        <button type="button" onclick="IsSame(this)" class="btn btn-block btn-success btn-sm">Save</button>
    </form>
</x-modals.modal>

<x-modals.modal id-modal='modal-email' modal-size='' modal-bg='' footer=''>
    <x-slot:header>
        <h2>Ganti Email</h2>
    </x-slot:header>
    <form action="/admin/setting/update/email" method="POST">
        @csrf
        @method('put')
        <input type="text" name="id" id="email-id" value="{{$data['id']}}" hidden>
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" placeholder="email" name="email" value="{{$data['email']}}">
        </div>

        <button type="submit" class="btn btn-block btn-success btn-sm">Save</button>
    </form>
</x-modals.modal>

@endsection
@section('after-js')

<script>
    function IsSame(params) {
        var form = document.getElementById("form_password");
        var password = document.getElementById("password");
        var cPassword = document.getElementById("cPassword");
        var button = params;
        var alert = document.getElementById('text-password');

        if (password && cPassword) {
            if ((password.value == cPassword.value)) {
                alert.hidden = true;
                form.submit();
            } else {
                alert.hidden = false;
            }
        }


    }

</script>
@endsection
