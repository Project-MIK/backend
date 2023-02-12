<div class="live-consultation">
    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-center">
        <div class="d-flex flex-column">
            <h1 class="font-weight-bold text-bunting text-xl">{{ $doctor }}</h1>
            <p class="text-trouth">{{ $polyclinic }}</p>
        </div>
        <div class="d-flex flex-column justify-content-end text-right">
            <p class="text-trouth">Waktu Yang Tersisa</p>
            <p id="timetime_remaining" class="text-lg font-weight-bold text-trouth">Sedang Memuat ...</p>
        </div>
    </div>
    <iframe class="w-100 mt-3" allow="camera;microphone" src='https://meet.jit.si/{{$id}}#userInfo.displayName="{{$name_pacient}}"' title="Konsultasi - {{$id}}" onload="setEndTime({{$end_consultation}})"></iframe>
</div>