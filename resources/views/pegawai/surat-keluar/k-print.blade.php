<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--<title>{{ $sKeluar->jenisSurat->nama_jenis_surat  }}</title>--}}
    <style type="text/css">
        body, html {
            height: 100%;
            margin: 0;
            border: 0;
            font-size: 11pt;
        }

        .bg {
            /* The image used */
            @if( $sk->jenisSurat->lembaga->nama_lembaga == 'Yayasan Quali International Surabaya' || $sk->jenisSurat->lembaga->nama_lembaga == 'Quali International Surabaya' )
            background-image: url("/images/kop/kop_qis12.png");
            @elseif( $sk->jenisSurat->lembaga->nama_lembaga == 'Muslim Day Care' )
            background-image: url("/images/kop/kop_mdc.png");
            @elseif( $sk->jenisSurat->lembaga->nama_lembaga == 'Sanggar ABL' )
            background-image: url("/images/kop/kop_abk.png");
            @endif

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        table{
            width: 100%;
        }

        .letter-head{
            margin-top: 121px;
            margin-left: 72px;
            margin-right: 20px;
        }

        .letter-head-2{
            margin-top: 121px;
            margin-left: 72px;
            margin-right: 72px;
        }

        .body-space{
            /*margin-top: 45px;*/
            margin-left: 72px;
            margin-right: 70px;
            text-align: justify;
        }

        /*table.body-space{*/
            /*margin-left: 500px;*/
            /*margin-right: 70px;*/
        /*}*/
    </style>
</head>
<body class="bg">
<header>
    @if( $sk->jenisSurat->template_surat == 'Template 1' )
        <div class="letter-head">
            <table>
                <tr>
                    <td align="left" width="40%">
                        <table>
                            <tr>
                                <td width="15%">Nomor</td>
                                <td width="5%">&nbsp;:</td>
                                <td>{{ $sk->no_surat }}</td>
                            </tr>
                            <tr>
                                <td>Perihal</td>
                                <td>&nbsp;:</td>
                                <td>{{ $sk->perihal }}</td>
                            </tr>
                            <tr>
                                <td>Lampiran</td>
                                <td>&nbsp;:</td>
                                <td>@if($sk->laprian == null)
                                        &nbsp;-
                                    @endif
                                    {{$sk->lampiran}}</td>
                            </tr>
                        </table>
                    </td>
                    <td align="center"></td>
                    <td align="left" width="40%">
                        {{$sk->tempat}}, {{ strftime("%d %B %Y", strtotime($sk->tgl_dicatat)) }}
                    </td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
                @if( $sk->tujuan != "" || $sk->tempat_tujuan != "" || $sk->alamat_tujuan != "" || $sk->kota_tujuan != "")
                    <tr>
                        <td align="left" width="75%">
                            <table cellpadding="5">
                                <tr>
                                    <td width="10%" valign="top"><b>Kepada</b></td>
                                    <td width="5%" valign="top">&nbsp;<b>:</b></td>
                                    <td valign="top"><b>Yth. {{ $sk->tujuan }} <br> {{ $sk->tempat_tujuan }}</b></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $sk->alamat_tujuan }} <br> Di. {{ $sk->kota_tujuan }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    @elseif( $sk->jenisSurat->template_surat == 'Template 2' )
        <div class="letter-head-2">
            <table>
                <tr>
                    <td align="center">
                        <p><u><b><font size="16">{{ strtoupper($sk->jenisSurat->nama_jenis_surat) }}</font></b></u>
                            <br><small><b>No. {{$sk->no_surat}}</b></small></p>
                    </td>
                </tr>
            </table>
        </div>
    @endif
</header>
<section class="body-space">
    <div style="text-align: justify">
        {!! $sk->isi_surat !!}
    </div>
</section>
</body>
</html>