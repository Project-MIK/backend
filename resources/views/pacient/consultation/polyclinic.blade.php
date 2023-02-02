<x-app-pacient title="Poliklinik">
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
                    <a href="/konsultasi">
                        <svg role="button" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M38 24H10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M24 38L10 24L24 10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <form class="ml-5 w-100" action="" method="POST">
                        @csrf
                        <h1 class="font-weight-bold text-bunting text-xl">Poliklinik</h1>
                        <div class="mt-4">                  
                            <div class="form-group">
                                <label for="category" class="text-trouth">Poliklinik</label>
                                <select id="category" class="form-control" name="consultation_polyclinic">
                                    <option value="-">POLI PENYAKIT DALAM</option>
                                </select>                                  
                            </div>                            
                        </div>
                        <div class="d-flex mt-5 flex-column align-items-end">
                            <button type="submit" class="btn btn-bunting w-25 text-white font-weight-bold py-2 mb-4">Selanjutnya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-pacient>