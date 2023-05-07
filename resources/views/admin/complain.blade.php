@extends('layouts.admin.app')
@section('content-header')
<h1>Komplain Pasien</h1>
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
                    <th hidden>id</th>
                    <th>nama</th>
                    <th>categori</th>
                    <th>poli</th>
                    <th>dokter</th>
                    <th>metode pembayaran</th>
                    <th>jumlah pembayaran</th>
                    <th>bukti pembayaran</th>
                    <th hidden>description</th>
                    <th>status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php($no = 0)
                @foreach($data as $record)
                @php($no++)
                <tr>
                    <td>{{$no}}</td>
                    <td hidden>{{$record['id']}}</td>
                    <td>{{$record['name']}}</td>
                    <td>{{$record['category']}}</td>
                    <td>{{$record['poly']}}</td>
                    <td>{{$record['doctor']}}</td>
                    <td>{{$record['payment_method']}}</td>
                    <td>{{$record['payment_amount']}}</td>
                    <td><img src="{{$record['link_foto']}}" style="max-height: 100px; max-width: 100px;" alt="bukti pembayaran"></td>
                    <td hidden>{{$record['description']}}</td>
                    @if($record['status'] == 0)
                    <td data-id="{{$record['status']}}">
                        <p class="text-primary">belum dikonfirmasi</p>
                    </td>
                    @elseif($record['status'] == 1)
                    <td data-id="{{$record['status']}}">
                        <p class="text-danger">tidak disetujui</p>
                    </td>
                    @else
                    <td data-id="{{$record['status']}}">
                        <p class="text-success">disetujui</p>
                    </td>
                    @endif
                    <th>
                        <div class="row">
                            <div class="col">
                                <button type="button" onclick="setDetail(this)" data-toggle='modal' data-target='#detail-modal' class="col detail btn btn-block btn-primary btn-sm">Detail</button>
                            </div>
                        </div>
                    </th>
                </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <th>no</th>
                    <th hidden>id</th>
                    <th>nama</th>
                    <th>categori</th>
                    <th>poli</th>
                    <th>dokter</th>
                    <th>metode pembayaran</th>
                    <th>jumlah pembayaran</th>
                    <th>bukti pembayaran</th>
                    <th>status</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>

<x-modals.modal id-modal="detail-modal" modal-size="modal-lg" modal-bg="">
    <x-slot:header>
        <h2>Detail</h2>
    </x-slot:header>
    <div class="row">
        <div class="col ">
            <img id="detail-img" src="https://images.tokopedia.net/img/cache/500-square/hDjmkQ/2022/2/21/ba348df9-d8a5-459a-9cb9-acc30dc45eda.jpg" alt="bukti pembayaran" style="max-width: 350px; max-height: 350px">
        </div>
        <div class="col">
            <div class="form-group">
                <label>Deskripsi</label>
                <p id="detail-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam alias illo architecto voluptatibus ad suscipit officia, quia est dicta iste blanditiis odit adipisci ea enim voluptates? Vero necessitatibus maiores exercitationem.</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>Nama</label>
                <p id="detail-name">Bachtiar Arya Habibie</p>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>Kategori</label>
                <p id="detail-category">kepala</p>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>Poli</label>
                <p id="detail-poly">anak</p>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>Dokter</label>
                <p id="detail-doctor">Anis</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>Metode Pembayaran</label>
                <p id="detail-payment-method">BRI</p>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>Jumlah Pembayaran</label>
                <p id="detail-payment-amount">90000</p>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>Status</label>
                <p id="detail-status">Menunggu persetujuan</p>
            </div>
        </div>
        <div class="col">
            <div class="m-1">
                <form action="/admin/complain/agreement" method="POST">
                    @csrf
                    @method('put')
                    <input name="id" id="detail-id-setuju" hidden>
                    <input name="status" value="disetujui" hidden>
                    <button type="submit" id="tombol-acc" class="btn btn-block btn-success btn-sm">accept</button>
                </form>
            </div>
            <div class="m-1">
                <form action="/admin/complain/agreement" method="POST">
                    @csrf
                    @method('put')
                    <input name="id" id="detail-id-tidak" hidden>
                    <input name="status" value="tidak disetujuti" hidden>
                    <button type="submit" id="tombol-dec" class="btn tombol btn-block btn-danger btn-sm">decline</button>
                </form>
            </div>
        </div>
    </div>
    <x-slot:footer>
    </x-slot:footer>
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

    function getData(button) {
        tabel = button.parentElement.parentElement.parentElement.parentElement;
        rawData = tabel.getElementsByTagName('td');
        img = rawData[8].children[0];
        src = img.getAttribute('src');

        var obj = {
            id: rawData[1].innerText
            , name: rawData[2].innerHTML
            , category: rawData[3].innerText
            , poly: rawData[4].innerText
            , doctor: rawData[5].innerHTML
            , payment_method: rawData[6].innerHTML
            , payment_amount: rawData[7].innerHTML
            , link_photo: src
            , description: rawData[9].innerHTML
            , status: rawData[10].getAttribute("data-id")
        };

        return obj;
    }



    function setDetail(params) {
        var data = getData(params);
        var img = document.getElementById('detail-img');
        var description = document.getElementById('detail-description');
        var name = document.getElementById('detail-name');
        var category = document.getElementById('detail-category');
        var poly = document.getElementById('detail-poly');
        var doctor = document.getElementById('detail-doctor');
        var payment_method = document.getElementById('detail-payment-method');
        var payment_amount = document.getElementById('detail-payment-amount');
        var status = document.getElementById('detail-status');
        var id1 = document.getElementById('detail-id-setuju');
        var id2 = document.getElementById('detail-id-tidak');
        var tombolAcc = document.getElementById('tombol-acc');
        var tombolDec = document.getElementById('tombol-dec');


        console.table(data);

        img.setAttribute('src', data.link_photo);
        description.innerHTML = data.description;
        name.innerHTML = data.name;
        category.innerHTML = data.category;
        poly.innerHTML = data.poly;
        doctor.innerHTML = data.doctor;
        payment_method = data.payment_method;
        payment_amount = data.payment_amount;
        if (data.status == 0) {
            status.innerHTML = "<p class='text-primary'>belum dikonfirmasi</p>";
            tombolAcc.hidden = false;
            tombolDec.hidden = false;
        } else if (data.status == 1) {
            status.innerHTML = "<p class='text-danger'>tidak disetuji</p>";
            tombolAcc.hidden = true;
            tombolDec.hidden = true;
        } else {
            status.innerHTML = " <p class='text-success'>disetuji</p>";
            tombolAcc.hidden = true;
            tombolDec.hidden = true;
        }
        id1.value = data.id;
        id2.value = data.id;
    }

</script>

@endsection
