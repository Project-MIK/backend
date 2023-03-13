<x-app-pacient title="Poliklinik">
    @slot('styles')
        <style>
            button,select{height:50px!important}#back-page-1{display:none}#back-page-2{display:block}#next-step{width:100%}@media (min-width:991.98px){#back-page-1{display:block}#back-page-2{display:none}#next-step{width:25%}}
        </style>
    @endslot
    {{-- @php
        dd($polyclinics);
    @endphp --}}
    <div class="container wrapper-pacient my-5">
        <div class="card shadow-lg rounded-lg w-100 mx-auto">
            <div class="card-body">
                <div class="p-5 d-flex">
                    <a id="back-page-1" class="mr-3" href="/konsultasi">
                        <svg role="button" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M38 24H10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M24 38L10 24L24 10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <form class="w-100" action="" method="POST">
                        @csrf
                        <div class="d-flex align-items-center">
                            <a id="back-page-2" class="mr-3" href="/konsultasi">
                                <svg role="button" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M38 24H10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M24 38L10 24L24 10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <h1 class="font-weight-bold text-bunting text-xl">Poliklinik</h1>
                        </div>
                        <div class="mt-4">                  
                            <div class="form-group">
                                <label for="category" class="text-trouth">Poliklinik</label>
                                <select id="category" class="form-control" name="consultation_polyclinic">
                                    @if ($polyclinics == null)
                                        <option value="-">-</option>
                                    @else
                                        @foreach ($polyclinics as $id => $polyclinic )
                                            <option value="{{$id}}-{{$polyclinic}}">{{$polyclinic}}</option>
                                        @endforeach
                                    @endif
                                </select>                                  
                            </div>                            
                        </div>
                        <div class="d-flex mt-5 flex-column align-items-end">
                            <button id="next-step" type="submit" class="btn btn-bunting text-white font-weight-bold py-2 mb-4">Selanjutnya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-pacient>