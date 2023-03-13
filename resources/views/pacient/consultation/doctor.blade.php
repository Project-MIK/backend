<x-app-pacient title="Dokter">
    @slot('styles')
        <style>
            button,
            select {
                height: 50px !important
            }

            #back-page-1 {
                display: none
            }

            #back-page-2 {
                display: block
            }

            #next-step {
                width: 100%
            }

            @media (min-width:991.98px) {
                #back-page-1 {
                    display: block
                }

                #back-page-2 {
                    display: none
                }

                #next-step {
                    width: 25%
                }
            }
        </style>
    @endslot
    <div class="container wrapper-pacient my-5">
        <div class="card shadow-lg rounded-lg w-100 mx-auto">
            <div class="card-body">
                <div class="p-5 d-flex">
                    <a id="back-page-1" class="mr-3" href="/konsultasi/poliklinik">
                        <svg role="button" width="48" height="48" viewBox="0 0 48 48" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M38 24H10" stroke="#525666" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M24 38L10 24L24 10" stroke="#525666" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </a>
                    <form class="w-100" action="/konsultasi/dokter" method="POST">
                        @csrf
                        <div class="d-flex align-items-center">
                            <a id="back-page-2" class="mr-3" href="/konsultasi/poliklinik">
                                <svg role="button" width="48" height="48" viewBox="0 0 48 48" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M38 24H10" stroke="#525666" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M24 38L10 24L24 10" stroke="#525666" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </a>
                            <h1 class="font-weight-bold text-bunting text-xl">Dokter</h1>
                        </div>
                        @if ($doctors == null)
                            <div class="alert alert-info mt-4" role="alert">
                                Mohon maaf, jadwal dokter sedang tidak tersedia
                            </div>
                        @else
                            <div class="mt-4">
                                <div class="form-row mb-4">
                                    <div class="form-group col-md-6">
                                        <label for="inputDoctor" class="text-trouth">Dokter</label>
                                        <select id="inputDoctor" class="form-control" name="consultation_doctor"
                                            onchange="getDoctor(this)">
                                            @if (!isset($id))
                                                @foreach ($doctors as $doctor)
                                                    <option id="{{ $doctor['id'] }}"
                                                        value="{{ $doctor['id'] }}-{{ $doctor['name'] }}">
                                                        {{ $doctor['name'] }}</option>
                                                @endforeach
                                            @else
                                                @foreach ($doctors as $doctor)
                                                    <option id="{{ $doctor['id'] }}"
                                                        value="{{ $doctor['id'] }}-{{ $doctor['name'] }}"
                                                        {{ $doctor['id'] == $id ? 'selected' : '' }}>
                                                        {{ $doctor['name'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputPrice" class="text-trouth">Harga konsultasi</label>
                                        <input type="text" class="form-control py-4 text-bunting font-weight-bold"
                                            id="inputPrice" name="consultation_price"
                                            value="{{ $detail_doctor['price_consultation'] }}" readonly required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12">
                                        <label for="schedule" class="text-trouth">Jadwal yang tersedia</label>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputScheduleDate"
                                                    class="text-trouth font-weight-normal">Tanggal</label>
                                                <select id="inputScheduleDate" class="form-control"
                                                    name="consultation_schedule_date" onchange="getDateSchedule(this)">
                                                    @if (!isset($date))
                                                        @if ($detail_doctor['date_schedule'] == null)
                                                            <option value="-">-</option>
                                                        @else
                                                            @foreach ($detail_doctor['date_schedule'] as $date_schedule)
                                                                <option id="{{ $date_schedule['consultation_date'] }}"
                                                                    value="{{ date('d-M-Y', strtotime($date_schedule['consultation_date'])) }}">
                                                                    {{ date('d-M-Y', strtotime($date_schedule['consultation_date'])) }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    @else
                                                        @foreach ($detail_doctor['date_schedule'] as $date_schedule)
                                                            <option
                                                                id="{{ date('d-M-Y', strtotime($date_schedule['consultation_date'])) }}"
                                                                value="{{ date('d-M-Y', strtotime($date_schedule['consultation_date'])) }}"
                                                                {{ date('Y-m-d', strtotime($date_schedule['consultation_date'])) == $date ? 'selected' : '' }}>
                                                                {{ date('d-M-Y', strtotime($date_schedule['consultation_date'])) }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="inputScheduleTime"
                                                    class="text-trouth font-weight-normal">Waktu (Waktu Indonesia
                                                    Barat)</label>
                                                <select id="inputScheduleTime" class="form-control"
                                                    name="consultation_schedule_time">
                                                    @if ($detail_doctor['time_schedule'] == null)
                                                        <option value="-">-</option>
                                                    @else
                                                        @foreach ($detail_doctor['time_schedule'] as $time)
                                                            <option
                                                                value="{{ $time['time_start'] }}-{{ $time['time_end'] }}">
                                                                {{ date('h : i : s', strtotime($time['time_start'])) }}
                                                                - {{ date('h : i : s', strtotime($time['time_end'])) }}
                                                            </option>
                                                        @endforeach
                                                    @endIf
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mt-4 flex-column align-items-end">
                                <button id="next-step" type="submit"
                                    class="btn btn-bunting text-white font-weight-bold py-2 mb-4">Selanjutnya</button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
    @slot('scripts')
        <script>
            function getDoctor(e, redirect = true) {
                for (let i = 0; i < e.children.length; i++) {
                    if (e.children[i].value == e.value) {
                        if (redirect) {
                            location.href = `/konsultasi/dokter/${e[i].id}`;
                        } else {
                            return `/konsultasi/dokter/${e[i].id}`;
                        }
                    }
                }
            }

            function getDateSchedule(e) {
                for (let i = 0; i < e.children.length; i++) {
                    if (e.value == e.children[i].value) {
                        location.href = `${getDoctor(document.getElementById("inputDoctor"), false)}/${e.children[i].id}`;
                    }
                }
            }
        </script>
    @endslot
</x-app-pacient>
