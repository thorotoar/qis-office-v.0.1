<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jadwal Pelajaran {{$data->lembaga_jp->nama_lembaga}}</title>
    {{--<link href="{{asset('css/lib/bootstrap/bootstrap.min.css')}}" rel="stylesheet">--}}
    {{--<!-- Bootstrap tether Core JavaScript -->--}}
    {{--<script src="{{asset('js/lib/bootstrap/js/popper.min.js')}}"></script>--}}
    {{--<script src="{{asset('js/lib/bootstrap/js/bootstrap.min.js')}}"></script>--}}
    <style>
        table, th, td {
            border: 1px solid black;
        }
        td{
            margin-left: auto;
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
<div align="center">
    <h4 class="m-b-0 text-black-50"><u>{{strtoupper($data->nama_jadwal)}}</u><br>{{strtoupper($data->lembaga_jp->nama_lembaga)}}</h4>
    <hr style="margin-bottom: .5em">
</div>
{{--info nilai--}}
@if($data->lembaga_id == 2)
    <table align="center" style="text-align: left; border-collapse: collapse;" id="data-table">
        <thead>
        <tr>
            <th width="5%">No</th>
            <th width="10%">Hari</th>
            <th width="15%">Waktu Mulai</th>
            <th width="15%">Waktu Akhir</th>
            <th width="20%">Kegiatan</th>
            <th width="35%">Keterangan</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\Jadwal::where('jadwal_id', $data->id)->get() as $index => $value)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$value->hari}}</td>
                <td>{{$value->waktu_mulai}}</td>
                <td>{{$value->waktu_akhir}}</td>
                <td>{{$value->kegiatan}}</td>
                <td>{{$value->keterangan == null ? '-' : $value->keterangan}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@elseif($data->lembaga_id == 3)
    <table width="100%" align="center" style="text-align: left; border-collapse: collapse;" id="data-table">
        <thead>
        <tr>
            <th width="5%">No</th>
            <th width="15%">Waktu Mulai</th>
            <th width="15%">Waktu Akhir</th>
            <th width="15%">Kegiatan</th>
            <th width="15%">Ruangan</th>
            <th width="35%">Keterangan</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\Jadwal::where('jadwal_id', $data->id)->get() as $index => $value)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$value->waktu_mulai}}</td>
                <td>{{$value->waktu_akhir}}</td>
                <td>{{$value->kegiatan}}</td>
                <td>{{$value->ruangan}}</td>
                <td>{{$value->keterangan == null ? '-' : $value->keterangan}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@elseif($data->lembaga_id == 4)
    <table width="100%" align="center" style="text-align: left; border-collapse: collapse;" id="data-table">
        <thead>
        <tr>
            <th width="5%">No</th>
            <th width="15%">Hari</th>
            <th width="15%">Waktu Mulai</th>
            <th width="15%">Waktu Akhir</th>
            <th width="15%">Kegiatan</th>
            <th width="35%">Keterangan</th>
        </tr>
        </thead>
        <tbody>
        @foreach(\App\Jadwal::where('jadwal_id', $data->id)->get() as $index => $value)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$value->hari}}</td>
                <td>{{$value->waktu_mulai}}</td>
                <td>{{$value->waktu_akhir}}</td>
                <td>{{$value->kegiatan}}</td>
                <td>{{$value->keterangan == null ? '-' : $value->keterangan}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
</body>
</html>