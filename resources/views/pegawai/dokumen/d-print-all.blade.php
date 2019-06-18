<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Dokumen Yayasan Quali International Surabaya</title>
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
<h2 style="margin-top: 0;margin-bottom: 5px">DAFTAR DOKUMEN</h2>
<h3 style="margin-top: 0;margin-bottom: 5px">Yayasan Quali Internatonal Surabaya</h3>
<hr style="margin-bottom: .5em">
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" style="text-align: left" id="data-table">
    <tr>
        <th>No</th>
        <th>Nama File</th>
        <th>Kategori</th>
        <th>Tanggal File</th>
        <th>Tanggal Dicatat</th>
        <th>Keterangan</th>
    </tr>
    @foreach($data as $index => $datas)
        <tr>
            <td width="5%">{{$index +1}}</td>
            <td width="30%"><strong>{{$datas->nama_dokumen}}</strong></td>
            <td width="30%"><strong>{{$datas->kategori->nama_kategori}}</strong></td>
            <td width="15%">{{strftime("%d %B %Y", strtotime($datas->tgl_file))}}</td>
            <td width="15%">{{strftime("%d %B %Y", strtotime($datas->tgl_dicatat))}}</td>
            <td width="35%">{{$datas->keterangan}}</td>
        </tr>
    @endforeach
</table>
</body>
</html>