<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}} &ndash; {{ $sk->jenisSurat->nama_jenis_surat }}</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            border: 0;
            font-size: 12pt;
        }

        table{
            width: 100%;
        }

        .kop_icon {
            margin-top: 20px;
            margin-left: 72px;
            width: 117px;
        }

        .letter_head {
            margin-top: 15px;
            margin-left: 72px;
            margin-right: 20px;
        }

        .letter_head_2 {
            margin-top: 15px;
            margin-left: 72px;
            margin-right: 70px;
        }

        .body_space{
            /*margin-top: 45px;*/
            margin-left: 72px;
            margin-right: 70px;
            text-align: justify;
        }

        .footer_pict {
            position: center;
            margin: 0 auto;
        }

        .footer_icon{
            width: 733px;
            position: absolute;
            bottom: 80px;
            right: 400px;
            left: 40px;
        }

        /*table.body-space{*/
        /*margin-left: 500px;*/
        /*margin-right: 70px;*/
        /*}*/
    </style>
</head>
<body >
<header>
    <div class="kop">
        @if( $sk->jenisSurat->lembaga->id == '1' || $sk->jenisSurat->lembaga->id == '2' )
            <img src="images/kop/kop_qis.jpg" alt="kop" class="img-responsive kop_icon">
        @elseif( $sk->jenisSurat->lembaga->id == '3' )
            <img src="images/kop/kop_mdc.jpg" alt="kop" class="img-responsive kop_icon">
        @elseif( $sk->jenisSurat->lembaga->id == '4' )
            <img src="images/kop/kop_abk.jpg" alt="kop" class="img-responsive kop_icon">
        @endif
    </div>
    <div>
        @yield('rincian')
    </div>
</header>

<section class="body_space">{!! $sk->isi_surat !!}</section>

<footer>
    <div class="footer_pict">
        <img src="images/kop/footer.jpg" alt="kop" class="img-responsive footer_icon">
    </div>
</footer>
</body>
</html>