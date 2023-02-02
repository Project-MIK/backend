<x-app-pacient title="Dokter">
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
                    <a href="/konsultasi/poliklinik">
                        <svg role="button" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M38 24H10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M24 38L10 24L24 10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <form class="ml-5 w-100" action="" method="POST">
                        @csrf
                        <h1 class="font-weight-bold text-bunting text-xl">Dokter</h1>
                        <div class="mt-4">                  
                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="inputDoctor" class="text-trouth">Dokter</label>
                                    <select id="inputDoctor" class="form-control" name="consultation_doctor">
                                        <option selected value="DR. H. M. Pilox Kamacho H., S.pb">DR. H. M. Pilox Kamacho H., S.pb</option>
                                        <option value="DR. H. M. Lili Amora H., S.pb">DR. H. M. Lili Amora H., S.pb</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPrice" class="text-trouth">Harga konsultasi</label>
                                    <input type="text" class="form-control py-4 text-bunting font-weight-bold" id="inputPrice" name="consultation_price" value="Rp.90.000" readonly required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="schedule" class="text-trouth">Jadwal yang tersedia</label>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputScheduleDate" class="text-trouth font-weight-normal">Tanggal</label>
                                        <select id="inputScheduleDate" class="form-control" name="consultation_schedule_date">
                                            <option selected value="5 - Februari - 2023">5 - Februari - 2023</option>
                                        </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputScheduleTime" class="text-trouth font-weight-normal">Waktu (WIB)</label>
                                            <select id="inputScheduleTime" class="form-control" name="consultation_schedule_time">
                                                <option selected value="08 : 30 : 00 - 09 : 30 : 00">08 : 30 : 00 - 09 : 30 : 00</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>              
                        </div>
                        <div class="d-flex mt-4 flex-column align-items-end">
                            <button type="submit" class="btn btn-bunting w-25 text-white font-weight-bold py-2 mb-4">Selanjutnya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-pacient>