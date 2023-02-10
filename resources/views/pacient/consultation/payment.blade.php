<x-app-pacient title="Pembayaran">
    @slot('styles')
        <style>
            button,select{height:50px!important}#back-page-1{display:none}#back-page-2{display:block}#information-bank{margin-top:30px}#next-step{width:100%}@media (min-width:991.98px){#back-page-1{display:block}#back-page-2{display:none}#information-bank{margin-top:0}#next-step{width:50%}}
        </style>
    @endslot
    <div class="container wrapper-pacient my-5">
        <div class="card shadow-lg rounded-lg w-100 mx-auto">
            <div class="card-body">
                <div class="p-5 d-flex">
                    <a id="back-page-1" class="mr-3" href="/konsultasi/rincian">
                        <svg role="button" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M38 24H10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M24 38L10 24L24 10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                    <form class="w-100" action="" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="d-flex align-items-center">
                            <a id="back-page-2" class="mr-3" href="/konsultasi/rincian">
                                <svg role="button" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M38 24H10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M24 38L10 24L24 10" stroke="#525666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <h1 class="font-weight-bold text-bunting text-xl">Pembayaran</h1>
                        </div>
                        <div class="mt-4">                  
                            <div class="form-row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="totalPrice" class="text-trouth">Total Pembayaran</label>
                                    <input type="text" class="form-control py-4 text-bunting font-weight-bold" id="totalPrice" value="{{$price_consultation}}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="bankPayment" class="text-trouth">Bank Pembayaran</label>
                                    <select id="bankPayment" class="form-control" name="consultation_bank_payment" onchange="setBankPayment(this)">
                                        @foreach ($banks as $bank)
                                            <option
                                                value="{{$bank['id']}}"
                                                data-no-card="{{$bank['no_card']}}"
                                                data-name-card="{{$bank['name_card']}}"
                                                data-image="{{$bank['image']}}"
                                            >
                                                {{$bank['name']}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="d-flex flex-column mt-5">
                                        <div class="d-flex flex-column flex-lg-row align-items-center">
                                            <div class="col-12 col-md-5">
                                                <img id="image-bank" src="/images/{{$banks[0]['image']}}" alt="logo-bank" width="150">
                                            </div>
                                            <div id="information-bank" class="col-12 col-md-8">
                                                <p id="number-bank" class="font-weight-bold text-trouth">{{$banks[0]['no_card']}}</p>
                                                <p id="name-account-bank" class="font-weight-bold text-trouth w-75">{{$banks[0]['name_card']}}</p>
                                            </div>
                                        </div>
                                        <div class="text-sm mt-4">
                                            <p>Harap melakukan pembayaran sesuai nominal yang tertera.</p>
                                            <p>Pembayaran berlaku sampai 
                                                <span class="font-weight-bold">
                                                    {{date('H:i:s d-m-Y', $valid_status)}}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="input-group my-3">
                                            <div class="custom-file">
                                              <input type="file" class="custom-file-input" id="upload-proof-payment" aria-describedby="inputGroupFileAddon01" onchange="setFileNameUpload(this)">
                                              <label id="label-upload-proof-payment" class="custom-file-label" for="upload-proof-payment">Unggah bukti pembayaran</label>
                                            </div>
                                          </div>                                          
                                    </div>
                                </div>
                            </div>        
                        </div>
                        <div class="d-flex mt-4 flex-column align-items-end">
                            <button id="next-step" type="submit" class="btn btn-bunting text-white font-weight-bold py-2 mb-4">Kirim Bukti Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @slot('scripts')
        <script>
             function setBankPayment(e){let t=document.getElementById("image-bank"),n=document.getElementById("number-bank"),a=document.getElementById("name-account-bank");for(let l=0;l<e.children.length;l++)e.value==e.children[l].value&&(t.src=`/images/${e.children[l].getAttribute("data-image")}`,n.textContent=e.children[l].getAttribute("data-no-card"),a.textContent=e.children[l].getAttribute("data-name-card"))}function setFileNameUpload(e){let t=document.getElementById("upload-proof-payment");document.getElementById("label-upload-proof-payment").textContent=e.files[0].name,t.disabled=!1}
        </script>
    @endslot
</x-app-pacient>