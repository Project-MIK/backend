@extends('layouts.admin.AppOnlyAsset')
@section('content')
<div class="bg-white container-xl border rounded  m-5 mx-auto">
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
    <div class="rounded h-80" style="height: 90%">
        <div class="">
            <div class="">
                <div id="meet" class=""></div>
            </div>
            <div class="">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah resep</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" rows="3" placeholder="" name="description"></textarea>
                            </div>
                            <div class="row">
                                <div class="form-group col">
                                    <label for="exampleInputEmail1">Obat</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="nama obat">
                                </div>
                                <div class="form-group col">
                                    <label for="exampleInputPassword1">qty</label>
                                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="harga obat">
                                </div>
                                <div class="form-group col">
                                    <label for="exampleInputPassword1">harga</label>
                                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-group col">
                                    <label for="exampleInputPassword1">sub total</label>
                                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <button type="button" class="btn btn-primary">add</button>

                            </div>
                            <div class="border-t">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Obat</th>
                                            <th>qty</th>
                                            <th>harga</th>
                                            <th>sub indo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>bodrex</td>
                                            <td>4</td>
                                            <td>1000</td>
                                            <td>4000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->

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
    // Mendapatkan elemen body
    const body = document.body;

    // Menambahkan class ke body
    body.classList.add("bg-primary");
    jitsiParentnode = document.querySelector('#meet');


    const domain = 'meet.jit.si';
    const options = {
        roomName: 'JitsiMeetAPIExample'
        , width: '100%'
        , height: 700
        , parentNode: jitsiParentnode
        , lang: 'en'
        , userInfo: {
            displayName: 'Admin'
        }
    };
    const api = new JitsiMeetExternalAPI(domain, options);


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

    api.on('readyToClose', () => {
        console.log('The readyToClose event has been triggered');
        api.dispose();
        jitsiParentnode.innerHTML = "<div class='mx-auto'><h1>Sesei Konsultasi Telah Berakhir</h1><a href='/admin/consul/'><button class='col detail btn btn-block btn-primary btn-sm'>Kembali ke Page Konsultasi</button></a></div>";

    });

    

</script>

@endsection
