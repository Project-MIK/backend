{{--
    TODO: membuat dropdown untuk obat, yang akan mengset harganya dari obatnya juga,
    TODO: mebuat qtynya bisa mengalikan harga dengan dirinya dan mengset valuenya ke sub total
    TODO: membuat fungsi ajax yang akan langsung mengirimkan data obat ke server, dan ke table
    --}}

@extends('layouts.admin.AppOnlyAsset')
<style>
    .select2-results__option[aria-selected=false] {
        color: #343a40;
    }

</style>
@section('content')
<div class="bg-white border m-5 rounded mx-auto">
    <div class="row">
        <div class="col">
            <h3>Dokte : {{$data['doctor']}}</h3>
            <h5>Pasien : {{$data['patien']}}</h5>

        </div>
        <div class="col-3 ml-auto">
            <p class="text-mute">Waktu Konsultasi</p>
            <p id="countdown">00:00</p>
        </div>
    </div>
    <div class="rounded" style="height: 100%">
        <div class="row rounded " style="height: 90%">
            <div class="col-9">
                <div id="meet"></div>
            </div>
            <div class="col-3">
                <div class="card card-primary ">
                    <div class="card-header">
                        <h3 class="card-title">Tambah resep</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="/admin/consul/receipt/store" id="form-medicine" method="POST">
                        @csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label for="medicine">Obat </label>
                                <select id="id_medicine" class="select2 form-control" name="medicine" required>
                                    @foreach($medicine as $item)
                                    <option value="{{$item['id']}}" data-price="{{$item['price']}}">
                                        <p class="text-dark">{{$item['name']}}</p>
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">qty</label>
                                <input type="number" required name="qty" oninput="" class="form-control" id="qty" placeholder="harga obat">
                            </div>
                            <div class="col"><button onclick="submitForm()" type="button" class="btn btn-primary">add</button></div>

                            <div class="alert alert-danger" role="alert" id="af" hidden>
                                Form obat, qty, harga, dan sub total tidak boelh kosong
                            </div>
                            <div class="border-t">
                                <table class="table table-bordered" id="table-med">
                                    <thead>
                                        
                                        <tr>
                                            <th>Obat</th>
                                            <th>qty</th>
                                            <th>harga</th>
                                            <th>total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-value">
                                        @foreach($receipt as $item)
                                        <tr>
                                            <td hidden>{{$item['id']}}</td>
                                            <td>{{$item['name']}}</td>
                                            <td>{{$item['qty']}}</td>
                                            <td>{{$item['price']}}</td>
                                            <td>{{$item['total']}}</td>
                                            <td><button onclick='deleteData(this)' type='button' class='close' aria-label='Close'><span aria-hidden='true'>&times;</span></button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div id="input-container">

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('after-js')
<script>
    var LastRow = 0;

    // Mendapatkan elemen body
    const body = document.body;

    // Menambahkan class ke body
    body.classList.add("bg-primary");
    jitsiParentnode = document.querySelector('#meet');


    const domain = 'meet.jit.si';
    const options = {
        roomName: 'JitsiMeetAPIExample'
        , width: '100%'
        , height: '100%'
        , parentNode: jitsiParentnode
        , lang: 'en'
        , userInfo: {
            displayName: 'Admin'
        }
    };
    const api = new JitsiMeetExternalAPI(domain, options);
    api.on('readyToClose', () => {
        console.log('The readyToClose event has been triggered');
        api.dispose();
        jitsiParentnode.innerHTML = "<div class='mx-auto'><h1>Sesei Konsultasi Telah Berakhir</h1><a href='/admin/consul/'><button class='col detail btn btn-block btn-primary btn-sm'>Kembali ke Page Konsultasi</button></a></div>";

    });


    // Mendapatkan elemen yang akan menampilkan hitung mundur
    const countdown = document.getElementById("countdown");

    // Membuat fungsi yang mengembalikan waktu saat ini
    function getTimeRemaining(endTime) {
        const total = Date.parse(endTime) - Date.parse(new Date());
        const minutes = Math.floor((total / 1000 / 60));
        const seconds = Math.floor((total / 1000) % 60);

        // Mengembalikan waktu tersisa dalam format MM:SS
        return `${minutes < 10 ? '0' + minutes : minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
    }

    // Menetapkan waktu akhir hitung mundur (x menit dari sekarang)
    const minutes = parseInt("{{$data['duration']}}") / 60000;
    // ganti dengan jumlah menit yang diinginkan
    const endTime = new Date(Date.parse(new Date()) + minutes * 60 * 1000);

    // Memperbarui waktu setiap detik
    const countdownInterval = setInterval(() => {
        const timeRemaining = getTimeRemaining(endTime);
        countdown.innerText = timeRemaining;

        // Menghentikan hitung mundur jika waktu habis
        if (timeRemaining === '00:00') {
            clearInterval(countdownInterval);
            api.dispose();
            // jitsiParentnode.innerHTML = "<h1 class='mx-auto'>Sesi Konsultasi Telah Selesai</h1>";
            // console.log(jitsiParentnode);
            jitsiParentnode.innerHTML = "<div class='mx-auto'><h1>Sesei Konsultasi Telah Berakhir</h1><a href='/admin/consul/'><button class='col detail btn btn-block btn-primary btn-sm'>Kembali ke Page Konsultasi</button></a></div>";
        }
    }, 1000);



    function addMed(params) {
        var obj = params;
        var table = document.getElementById("table-value");

        var row = table.insertRow();
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        console.table(params.id);
        cell1.hidden = true;
        cell1.innerHTML = obj.id;
        cell2.innerHTML = obj.name;
        cell3.innerHTML = obj.qty;
        cell4.innerHTML = obj.harga;
        cell5.innerHTML = obj.total;
        cell6.innerHTML = "<button onclick='deleteData(this)' type='button' class='close' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";

        LastRow++;

    }

    function deleteRow(params) {
        row = params.parentNode.parentNode;
        row.remove();
    }

    $(function() {
        //Initialize Select2 Elements
        $(".select2").select2();
    });


    function submitForm() {
        var id_medicine = document.getElementById("id_medicine").value;
        var qty = document.getElementById("qty").value;
        var id_consule = "{{ request()->route('id_consul') }}";

        // Kirim data menggunakan AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', "{{ route('receipt.store') }}", true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', "{{ csrf_token() }}");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                addMed(JSON.parse(xhr.responseText));
            }
        };
        var data = JSON.stringify({
            id_consule: id_consule
            , id_medicine: id_medicine
            , qty: qty
        });
        xhr.send(data);

        console.log("sended");
    }

    function deleteData(params) {
        row = params.parentNode.parentNode;
        items = row.getElementsByTagName('td');
        id = items[0].innerHTML;

        var xhr = new XMLHttpRequest();
        xhr.open('delete', "{{ route('receipt.destroy') }}", true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader('X-CSRF-TOKEN', "{{ csrf_token() }}");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);

                deleteRow(params);
            }
        };
        var data = JSON.stringify({
            id: id
        });
        xhr.send(data);

        console.log("sended");

    }

</script>


@endsection
