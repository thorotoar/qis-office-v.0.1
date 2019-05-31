<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Jadwal {{$pes->lembaga->nama_lembaga}} Peserta Didik</title>
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
<h2 style="margin-top: 0;margin-bottom: 5px">Jadwal Monitoring Pengasuhan {{$pes->nama}}</h2>
<h3 style="margin-top: 0;margin-bottom: 5px"></h3>
<hr style="margin-bottom: .5em">
<table border="0" cellpadding="0" cellspacing="0" align="center" id="data-table">
    <thead>
    <tr>
        <th width="80px">No</th>
        <th>Waktu Mulai</th>
        <th>Waktu Akhir</th>
        <th>Kegiatan</th>
        <th>Ruangan</th>
        <th>Keterangan</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $index => $datas)
        <tr>
            <td>{{$index +1}}</td>
            <td>{{$datas->waktu_mulai}}</td>
            <td>{{$datas->waktu_akhir}}</td>
            <td>{{$datas->kegiatan}}</td>
            <td>{{$datas->ruangan}}</td>
            <td>{{$datas->keterangan}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>