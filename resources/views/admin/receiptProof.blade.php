@extends('layouts.admin.app')
@section('content-header')
<h1>Persetujuan Pembayaran Resep</h1>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Category</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>no</th>
                    <th>Pasien</th>
                    <th>total</th>
                    <th>status</th>
                    <th>bukti</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>

                @php($no=1)
                @foreach($data as $item)
                {{-- {{dd($item)}} --}}
                <tr>
                    <td>{{$no}}</td>
                    <td>{{$item['patien_name']}}</td>
                    <td hidden>{{$item['id_consul']}}</td>
                    <td hidden>{{$item['id_receipt']}}</td>
                    <td>{{$item['total']}}</td>
                    @if($item['status'] == 0)
                    <td data-id="{{$item['status']}}" class="text-primary">menunggu konfirmasi</td>
                    @elseif($item['status'] == 1)
                    <td data-id="{{$item['status']}}" class="text-danger">tidak disetujui</td>
                    @elseif($item['status']==2)
                    <td data-id="{{$item['status']}}" class="text-success">disetujui</td>
                    @else
                    <td data-id="{{$item['status']}}">?</td>
                    @endif
                    <td hidden>{{(json_encode($item["list_medicine"]));}}</td>
                    <td><img style="max-width: 80px;" src="{{$item['proof']}}" alt="bukti pembayaran"></td>
                    <td>
                        <div class="row">
                            <div class="col"><button type="button" data-toggle='modal' data-target='#modal-detail' onclick="setEdit(this)" class="col detail btn btn-block btn-primary btn-sm">Detail</button></div>
                        </div>
                    </td>
                </tr>
                @php($no++)
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>no</th>
                    <th>Pasien</th>
                    <th>total</th>
                    <th>status</th>
                    <th>bukti</th>
                    <th>action</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<x-modals.modal id-modal='modal-detail' modal-size='modal-lg' modal-bg=''>
    <x-slot:header>
        <h3>Detail Pembayaran</h3>
    </x-slot:header>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <img id="detail-img" style="max-height: 400px" src="https://feb.umri.ac.id/wp-content/uploads/2021/03/Bukti-Pembayaran-Ujian-Skripsi.jpeg" alt="bukti pembayaran">
            </div>
        </div>
        <div class="col">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>obat</th>
                        <th>qty</th>
                        <th>harga</th>
                        <th>subtotal</th>
                    </tr>
                </thead>
                <tbody id="detail-t-body">
                    <tr>
                        <td>asdf</td>
                        <td>asdg</td>
                        <td>asdf</td>
                        <td>asd</td>
                    </tr>
                </tbody>
                <tfoot>
                    <th></th>
                    <th></th>
                    <th>total</th>
                    <th>
                        <p id="detail-total">total</p>
                    </th>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label>Pasien</label>
                <p id="detail-patien">nama pasien</p>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>id konsultasi</label>
                <p id="id-consul">aksdfjjew</p>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>id resep</label>
                <p id="id-receipt">lkh</p>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>Status</label>
                <p id="detail-status">nama pasien</p>
            </div>
        </div>
    </div>
    <div class="mx-auto row">
        <div class="m-1 col-2 mx-auto">
            <form action="/admin/receiptProof/update" method="POST">
                @csrf
                @method('put')
                <input type="text" name="id_receipt" hidden id="form-acc-id_receipt">
                <input type="text" name="id_consul" hidden id="form-acc-id_consul">
                <input name="status" value="disetujui" hidden>
                <button id="tombol-acc" type="submit" class="btn btn-block btn-success btn-sm">acc</button>
            </form>
        </div>
        <div class="m-1 col-2 mx-auto">
            <form action="/admin/receiptProof/update" method="POST">
                @csrf
                @method('put')
                <input type="text" name="id_consul" hidden id="form-dec-id_consul">
                <input type="text" name="id_receipt" hidden id="form-dec-id_receipt">
                <input name="status" value="tidak disetujuti" hidden>
                <button type="submit" id="tombol-dec" class="btn btn-block btn-danger btn-sm">dec</button>
            </form>
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

        var obj = {
            patient: rawData[1].innerText
            , id_consul: rawData[2].innerText
            , id_receipt: rawData[3].innerText
            , total: rawData[4].innerText
            , status: rawData[5].getAttribute("data-id")
            , list_medicine: JSON.parse(rawData[6].innerText)
            , link_proof: rawData[7].querySelector('img').getAttribute('src')
        };

        return obj;
    }

    function setEdit(params) {
        var data = getData(params);
        var idConsul = document.getElementById('id-consul');
        var idReceipt = document.getElementById('id-receipt');
        var patient = document.getElementById('detail-patien');
        var image = document.getElementById('detail-img');
        var status = document.getElementById('detail-status');
        var tbody = document.getElementById('detail-t-body');
        var tombolAcc = document.getElementById('tombol-acc');
        var tombolDec = document.getElementById('tombol-dec');
        var total = document.getElementById('detail-total');
        var idAcc = document.getElementById('form-acc-id_receipt');
        var idDec = document.getElementById('form-dec-id_receipt');
        var idCAcc = document.getElementById('form-acc-id_consul');
        var idCDec = document.getElementById('form-dec-id_consul');


        idCAcc.value = data.id_consul;
        idCDec.value = data.id_consul;
        idAcc.value = data.id_receipt;
        idDec.value = data.id_receipt;
        idConsul.innerText = data.id_consul;
        idReceipt.innerText = data.id_receipt;
        patient.innerText = data.patient;
        image.src = data.link_proof;
        total.innerText = data.total
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

        tbody.innerHTML = '';

        data.list_medicine.forEach(function(item) {
            var row = document.createElement('tr');

            var obatCell = document.createElement('td');
            obatCell.textContent = item.medicine;

            var qtyCell = document.createElement('td');
            qtyCell.textContent = item.qty;

            var hargaCell = document.createElement('td');
            hargaCell.textContent = item.price;

            var subtotalCell = document.createElement('td');
            subtotalCell.textContent = item.sub_total;

            row.appendChild(obatCell);
            row.appendChild(qtyCell);
            row.appendChild(hargaCell);
            row.appendChild(subtotalCell);

            tbody.appendChild(row);
        });
    }

</script>
@endsection
