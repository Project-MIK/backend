@extends('layouts.admin.app')
@section('content-header')

@endsection
@section('content')
{{-- nama, email, password, address --}}
<div class="container d-flex">
    <form action="/admin/setting/update" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" placeholder="Nama" value="{{$data['name']}}">
        </div>
        <div class="form-group">
            <label>email</label>
            <input type="email" class="form-control" placeholder="email" name="email" value="{{$data['email']}}">
        </div>
        <div class="form-group">
            <label>password</label>
            <input type="password" name="password" class="form-control" placeholder="password" value="{{$data['password']}}">
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" name="address" rows="3" placeholder="alamat" >{{$data['address']}}</textarea>
        </div>
        <div class="ml-auto">
            <button type="submit" class="btn btn-block btn-success btn-lg">Save</button>
        </div>
    </form>
</div>
@endsection
@section('after-js')

@endsection
