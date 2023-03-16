@extends('layouts.admin.app')
@section('content-header')
    <h1>Pengiriman Obat</h1>
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
                <tr>
                    <th>no</th>
                    <th>nama</th>
                    <th hidden>id_consule</th>
                    <th hidden>id_receipt</th>
                    <th>metode pengiriman</th>
                    <th>no_telp</th>
                    <th>alamat</th>
                    <th>status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php($no = 0)
                @foreach($data as $item)
                <tr>
                    <td>{{++$no}}</td>
                    <td>{{$item['name']}}</td>
                    <td hidden>{{$item['id_consul']}}</td>
                    <td hidden>{{$item['id_receipt']}}</td>
                    <td>{{$item['delivery_method']}}</td>
                    <td>{{$item['no_telp']}}</td>
                    <td>{{$item['address']}}</td>
                    <td>{{$item['status']}}</td>
                    <th>
                        <div class="row">
                            <div class="col">
                                <button type="button" onclick="setDetail(this)" data-toggle='modal' data-target='#detail' class="col detail btn btn-block btn-primary btn-sm">Detail</button>
                            </div>
                        </div>
                    </th>
                </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <th>no</th>
                    <th>nama</th>
                    <th hidden>id_consule</th>
                    <th hidden>id_receipt</th>
                    <th>metode pengiriman</th>
                    <th>no_telp</th>
                    <th>alamat</th>
                    <th>status</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<x-modals.modal id-modal="detail" modal-size="modal-lg" modal-bg='' footer=''>
    <x-slot:header><h1>Detail</h1></x-slot:header>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>nama pasien</label>
                <p id="detail-name">aksdfjjew</p>
            </div>
            
        </div>
        <div class="col">
            <div class="form-group">
                <label>id konsultasi</label>
                <p id="detail-id-consul">aksdfjjew</p>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>id resep</label>
                <p id="detail-id-resep">aksdfjjew</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>Metode Pengiriman</label>
                <p id="detail-metode">aksdfjjew</p>
            </div>
            
        </div>
        <div class="col">
            <div class="form-group">
                <label>no telpon</label>
                <p id="detail-no-telpon">aksdfjjew</p>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>status</label>
                <p id="detail-status">aksdfjjew</p>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label>Alamat</label>
        <textarea id="detail-address" class="form-control" rows="3" placeholder="Enter ..."></textarea>
      </div>
</x-modals.modal>
@endsection
@section('after-js')
    <script>
        function getData(button) {
        tabel = button.parentElement.parentElement.parentElement.parentElement;
        rawData = tabel.getElementsByTagName('td');

        var obj = {
            patient: rawData[1].innerText
            , id_consul: rawData[2].innerText
            , id_receipt: rawData[3].innerText
            , method: rawData[4].innerText
            , no_telp: rawData[5].innerText
            , address: rawData[6].innerText
            , status: rawData[7].innerText
        };

        return obj;
    }

    function setDetail(params) {
        var data = getData(params);
        var name = document.getElementById('detail-name');
        var id_consul = document.getElementById('detail-id-consul');
        var id_receipt = document.getElementById('detail-id-resep');
        var method = document.getElementById('detail-metode');
        var no_telp = document.getElementById('detail-no-telpon');
        var status = document.getElementById('detail-status');
        var address = document.getElementById('detail-address');

        name.innerText = data.patient;
        id_consul.innerText = data.id_consul;
        id_receipt.innerText = data.id_receipt;
        method.innerText = data.method;
        no_telp.innerText = data.no_telp;
        status.innerText = data.status;
        address.value = data.address;

    }
    </script>
@endsection