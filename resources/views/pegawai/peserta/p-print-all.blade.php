<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Peserta Didik Yayasan Quali International Surabaya</title>
    <style>
        h1, h2, h3, h4, h5, h6 {
            text-align: center;
        }
        #data-table {
            width: auto;
            border-collapse: collapse;
            margin: 0 auto;
        }
        #data-table td, th {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
        }
        #data-table tr:nth-child(even) {
            background-color: #eee;
        }
    </style>
</head>
<body>
<h2 style="margin-top: 0;margin-bottom: 5px">Daftar Peserta Didik</h2>
<h3 style="margin-top: 0;margin-bottom: 5px">Yayasan Quali Internatonal Surabaya</h3>
<hr style="margin-bottom: .5em">
<table border="0" cellpadding="0" cellspacing="0" align="center" id="data-table">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>TTL</th>
        <th>Jenis Kelamin</th>
        <th width="119px">No. Telp</th>
        <th>Email</th>
        <th>Alamat</th>
        <th>Lembaga</th>
    </tr>
    @foreach($data as $index => $datas)
        <tr>
            <td style="vertical-align: middle;text-align: center">{{$index +1}}</td>
            <td><strong>{{$datas->nama}}</strong></td>
            <td>{{$datas->tempat_lahir}}, {{$datas->tgl_lahir}}</td>
            <td>{{$datas->kelamin}}</td>
            <td>{{$datas->telpon_selular}}</td>
            <td>{{$datas->email}}</td>
            <td>{{$datas->alamat}}</td>
            <td>{{$datas->lembaga->nama_lembaga}}</td>
        </tr>
    @endforeach
</table>
</body>
</html>