<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Keputusan Instruktur Madya</title>
    <style type="text/css">
        /*@font-face {*/
            /*font-family: 'Calibri';*/
            /*font-weight: normal;*/
            /*font-style: normal;*/
            /*font-variant: normal;*/
            /*src: url("font url");*/
        /*}*/

        body, html {
            height: 100%;
            margin: 0;
            border: 0;
        }

        .bg {
            /* The image used */
            background-image: url("/images/sertifikat/s-depan.jpg");

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .bck {
            /* The image used */
            background-image: url("/images/sertifikat/s-belakang.jpg");

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .margin-top{
            margin-top: 113px
        }

        .margin-left{
            margin-left: 30px;
        }

        .margin-right{
            margin-right: 90px;
        }

        table#konten, tr#konten, td#konten{
            border: 1px solid black;
            border-collapse: collapse;
        }

        .text{
            font-family: Arial;
            font-size: 26px;
        }
    </style>
</head>

<body class="bg">
<div>
    <table width="100%" style="margin-left: 64px"  class="margin-top margin-left margin-right">
        <tr>
            <td align="center" style="width: 100%;">
                <p style="font-size: 23px">Learning English Through</p><br>
                <strong style="font-size: 30px">ACTIVATED HOLISTIC MIND</strong>
            </td>
        </tr>
    </table>
    <table width="100%" style="margin-left: 64px"  class="margin-top margin-left margin-right">
        <tr>
            <td align="center" style="width: 100%;">{{$nilai->nomor_nilai}}</td>
        </tr>
        <tr>
            <td align="center" style="width: 100%;">{{$nilai->tgl_dicatat}}</td>
        </tr>
        <tr>
            <td align="center" style="width: 100%;">{{$nilai->program}}</td>
        </tr>
        <tr>
            <td align="center" style="width: 100%;">{{$nilai->nilai_grammar}}</td>
        </tr>
        <tr>
            <td align="center" style="width: 100%;">{{$nilai->nilai_comprehension}}</td>
        </tr>
        <tr>
            <td align="center" style="width: 100%;">{{$nilai->nilai_conversation}}</td>
        </tr>
        <tr>
            <td align="center" style="width: 100%;">{{$nilai->keterangan}}</td>
        </tr>
    </table>
    {{--isi dan penutup--}}
    {{--<table width="84%" style="margin-top: 20px" class="text margin-left margin-right">--}}
        {{--<tr>--}}
            {{--<td class="clean" align="justify">Berdasarkan rapat yang dilaksanakan bersama Direktur Quali International pada hari Senin, tanggal 6 Oktober 2014,--}}
            {{--</td>--}}
        {{--</tr>--}}
        {{--<tr><td></td></tr>--}}
        {{--<tr><td></td></tr>--}}
        {{--<tr>--}}
            {{--<td align="justify">saya yang bertanda tangan di bawah ini</td>--}}
        {{--</tr>--}}
        {{--<tr><td></td></tr>--}}
        {{--<tr><td></td></tr>--}}
    {{--</table>--}}
</div>
</body>
<body class="bck">
</body>
</html>