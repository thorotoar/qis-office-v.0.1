<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sertifikat {{$nilai->pesertaDidikQIS->nama}}</title>
    <style type="text/css">
        body, html {
            width: 100%;
            height: 100%;
            margin: 0 auto;
            font-family: 'Dejavu Sans';
            font-style: normal;
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

        .content {
            padding-top: 120px;
            text-align: center;
        }

        .tgl {
            position: absolute;
            bottom: 77px;
            right: 53px;
            font-size: 17px;
        }

        .score-content {
            padding: 250px 150px;
        }

        #score-table {
            width: 100%;
            border-collapse: collapse;
        }

        #score-table td, #score-table th {
            width: 33.33%;
            padding: 8px;
        }
    </style>
</head>

<body class="bg">
<div class="content">
    <p style="line-height: 1">
        <span style="font-size: 23px;">Learning English Through</span><br>
        <strong style="font-size: 30px">ACTIVATED HOLISTIC MIND</strong><br>
        <span style="font-size: 23px;">(AHM Method&trade;)</span><br><br>
        <strong style="font-size: 20px;">&ldquo;AKREDITASI B&rdquo;</strong><br>
        <span style="font-size: 18px;">Oleh BAN Pendidikan Non Formal Nomor. KP 3578 00001 12 2015 Tanggal 8 Desember 2015<br>Izin Dinas Pendidikan Nomor 421.9/2599/436.6.4/2013 Tanggal 21 Maret 2013<br>Perum Pesona Alam Gunung Anyar I Blok B12 No. 25 Surabaya, Phone 085104571548<br>Website : www.qisenglish.co.id E-mail : Info@qisenglish.co.id</span>
    </p>
    <p style="line-height: .7">
        <strong style="font-size: 32px">Number : {{$nilai->nomor_nilai}}</strong><br><br>
        <span style="font-size: 25px;">This is to certify that</span><br><br>
        <strong style="font-size: 35px">{{ucwords($nilai->pesertaDidikQIS->nama)}}</strong><br><br>
        <span style="font-size: 28px;">As</span><br><br>
        <strong style="font-size: 35px">Participant</strong>
    </p>
    <p style="line-height: 1;margin-top: -10px">
        <span style="font-size: 25px;">Achieved the following result in</span><br>
        <strong style="font-size: 25px;">{{$nilai->program}}</strong>
    </p>
    <span class="tgl">Surabaya, {{$nilai->tgl_dicatat}}</span>
</div>
</body>

<body class="score-content">
<table id="score-table">
    <thead>
    <tr>
        <td colspan="2" style="font-size: 23px">Name : {{ucwords($nilai->pesertaDidikQIS->nama)}}</td>
        <td align="right" style="font-size: 23px">Program : {{$nilai->program}}</td>
    </tr>
    <tr>
        <th align="center" style="border: 1px solid #ddd;">GRAMMAR</th>
        <th align="center" style="border: 1px solid #ddd;">COMPREHENSION</th>
        <th align="center" style="border: 1px solid #ddd;">CONVERSATION</th>
    </tr>
    </thead>
    <tbody>
    <tr style="font-size: 72px">
        <td align="center" style="border: 1px solid #ddd;">{{$nilai->nilai_grammar}}</td>
        <td align="center" style="border: 1px solid #ddd;">{{$nilai->nilai_comprehension}}</td>
        <td align="center" style="border: 1px solid #ddd;">{{$nilai->nilai_conversation}}</td>
    </tr>
    </tbody>
</table>
</body>
</html>