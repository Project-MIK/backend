<x-app-pacient title="Rincian Konsultasi">
    @slot('styles')
        <style>
            select, button {
                height: 50px !important;
            }
        </style>
    @endslot
    <div class="container wrapper-pacient my-5">
        <div class="card shadow-lg rounded-lg w-100 mx-auto">
            <div class="card-body">
                <div class="p-5 d-flex">
                    <a href="/konsultasi/dokter">
                        <svg role="button" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M38 24H10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M24 38L10 24L24 10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <form class="ml-5 w-100" action="" method="POST">
                        @csrf
                        <h1 class="font-weight-bold text-bunting text-xl">Rincian Konsultasi</h1>
                        <div class="mt-4">                  
                            <div class="form-group">
                                <label for="complaint" class="text-trouth">Keluhan</label>
                                <textarea class="form-control" id="complaint" rows="3" readonly>Tempor duis Lorem occaecat cillum velit ea in minim occaecat.
                                </textarea>
                            </div>                            
                            <div class="form-group">
                                <label for="category" class="text-trouth">Kategori</label>
                                <input type="text" id="category" class="form-control py-4" value="Fugiat deserunt dolore" readonly>
                            </div>
                            <div class="form-group">
                                <label for="polyclinic" class="text-trouth">Poliklinik</label>
                                <input type="text" id="polyclinic" class="form-control py-4" value="Mollit qui sit eu sint dolor sunt" readonly>
                            </div>
                            <div class="form-group">
                                <label for="doctor" class="text-trouth">Dokter</label>
                                <input type="text" id="doctor" class="form-control py-4" value="Enim adipisicing ad" readonly>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="schedule" class="text-trouth">Jadwal yang tersedia</label>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="date" class="text-trouth font-weight-light">Tanggal</label>
                                            <input type="text" id="date" class="form-control py-4" value="19 - Agustus - 2023" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="time" class="text-trouth font-weight-light">Jam (WIB)</label>
                                            <input type="text" id="time" class="form-control py-4" value="08:00:00 - 09:00:00" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>                             
                        </div>
                        <div class="d-flex mt-5 flex-column align-items-end">
                            <p class="font-weight-bold">Total Pembayaran</p>
                            <p class="display-4 font-weight-bold mb-5 text-bunting">Rp.90.000</p>
                            <button type="submit" class="btn btn-bunting w-50 text-white font-weight-bold py-2 mb-4">BAYAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-pacient>