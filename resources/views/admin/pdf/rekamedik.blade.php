<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DOKUMEN PENGAMBILAN OBAT</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <style>
        @font-face {
            font-family: Arial, Helvetica, sans-serif;
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #241C99;
            text-decoration: none;
        }

        body {
            position: relative;
            width: 100%;
            height: 100%;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
        }

        header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
        }

        #logo {
            float: left;
            margin-top: 8px;
        }

        #logo img {
            height: 70px;
        }

        #company {
            float: right;
            text-align: right;
        }

        #details {
            margin-top: 20px;
            margin-bottom: 50px;
        }

        #client {
            padding-left: 10px;
            border-left: 6px solid #241C99;
            float: left;
        }

        #client .to {
            color: #777777;
        }

        #client h2 {
            margin: 5px 0px;
        }

        h2.name {
            font-size: 1.4em;
            font-weight: bold;
            margin: 0;
        }

        #invoice {
            float: right;
            text-align: right;
        }

        #invoice h1 {
            color: #241C99;
            font-size: 2.4em;
            line-height: 1em;
            font-weight: bold;
            margin: 0 0 10px 0;
        }

        #invoice .date {
            font-size: 1.1em;
            color: #777777;
            margin-bottom: 5px;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        table tr[id=header] {
            background-color: #777777;
            color: white;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        .tanda_tangan {
            margin-top: 100px;
        }

        .tanda_tangan div {
            padding-top: 10px;
            border-top: 1px solid #777777;
        }

        .tanda_tangan #pasien {
            float: left;
            font-weight: bold;
        }

        .tanda_tangan #petugas {
            float: right;
            font-weight: bold;
        }
        .page_break { page-break-before: always; }

    </style>
</head>
<body>
    @for($i = 0; $i < count($documents); $i++)
    @php
        $document = $documents[$i];
    @endphp
    <div>
        <header class="clearfix">
            <div id="logo">
                <img src="{{ public_path('images/logo-rshusada.png') }}">
            </div>
            <div id="company">
                <h2 class="name">RUMAH SAKIT CITA HUSADA</h2>
                <div>Jl. Teratai No.22, Gebang Timur, Gebang,</br>Kec. Patrang, Kabupaten Jember, Jawa Timur 68117</div>
                <div>(+62 331) 486200 </div>
            </div>
            </div>
        </header>
        <main>
            <div id="details" class="clearfix">
                <div id="client">
                    <div class="to">PASIEN</div>
                    <h2 class="name">{{ $document["fullname"] }}</h2>
                    <div class="address">{{ $document["no_medical_record"] }}</div>
                </div>
                <div id="invoice">
                    <h1>{{ $document["id_consultation"] }}</h1>
                    <div class="date">{{ date("d / M / Y", $document["valid_status"]) }}</div>
                </div>
            </div>
            <div>
                <p>
                    {{$document['description']}}
                </p>
            </div>
            <div>
                <table>
                    <tr id="header">
                        <th>Daftar</th>
                        <th>Harga</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td>Konsultasi dengan Dokter {{$document["consultation"]["doctor"]}}</td>
                        <td>{{$document["consultation"]["price"]}}</td>
                        <td>{{$document["consultation"]["status"]}}</td>
                    </tr>
                    <tr>
                        <td>Pembayaran Obat</td>
                        <td>{{$document["medical"]["price"]}}</td>
                        <td>{{$document["medical"]["status"]}}</td>
                    </tr>
                </table>
            
                <div class="tanda_tangan">
                    <div id="pasien">{{ $document["fullname"] }}</div>
                    <div id="petugas">Petugas Apoteker</div>
                </div>
            </div>
        </main>
    </div>
    @if(count($documents)>$i-1)
    <div class="page_break"></div>
    @endif
    @endfor
</body>
</html>
