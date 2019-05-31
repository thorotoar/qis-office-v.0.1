<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Surat Keluar Quali International Surabaya</title>
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
<h2 style="margin-top: 0;margin-bottom: 5px">Daftar Surat Keluar Quali Internatonal Surabaya</h2>
<h3 style="margin-top: 0;margin-bottom: 5px"></h3>
<hr style="margin-bottom: .5em">
<table border="0" cellpadding="0" cellspacing="0" align="center" id="data-table">
    <tr>
        <th>No</th>
        <th>Nomor Surat</th>
        <th>Tanggal Keluar</th>
        <th>Tanggal Dicatat</th>
        <th>Prihal</th>
        <th>Jenis Surat</th>
    </tr>
    @foreach($datas as $index => $value)
        <tr>
            <td>{{ $index +1 }}</td>
            <td>{{ $value->no_surat }} </td>
            <td>{{ strftime("%d %B %Y", strtotime($value->tgl_keluar)) }}</td>
            <td>{{ strftime("%d %B %Y", strtotime($value->tgl_dicatat)) }}</td>
            <td>{{ $value->perihal == null ? '-' : $value->perihal }}</td>
            <td>{{ $value->jenisSurat->nama_jenis_surat }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>