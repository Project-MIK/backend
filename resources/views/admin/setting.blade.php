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
            <label>email</label>
            <input type="email" class="form-control" placeholder="email" name="email" value="{{$data['email']}}">
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
