<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jadwal Pelajaran {{$lemb->nama_lembaga}}</title>
    {{--<link href="{{asset('css/lib/bootstrap/bootstrap.min.css')}}" rel="stylesheet">--}}
    {{--<!-- Bootstrap tether Core JavaScript -->--}}
    {{--<script src="{{asset('js/lib/bootstrap/js/popper.min.js')}}"></script>--}}
    {{--<script src="{{asset('js/lib/bootstrap/js/bootstrap.min.js')}}"></script>--}}
    <style>
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
    <h4 class="m-b-0 text-black-50"><u>JADWAL PELAJARAN LEMBAGA</u><br>{{strtoupper($lemb->nama_lembaga)}}</h4>
    <hr style="margin-bottom: .5em">
</div>
{{--info nilai--}}
@if($lemb->id == 2)
    @foreach(\App\JadwalPelajaran::where('lembaga_id', 2)->get() as $index => $qis)
        <table>
            <tbody>
            <tr>
                <td>Nama Jadwal</td>
                <td>:</td>
                <td> {{ucfirst($qis->nama_jadwal)}}</td>
            </tr>
            <tr>
                <td>Tanggal Dicatat</td>
                <td>:</td>
                <td> {{$qis->tgl_dicatat}}</td>
            </tr>
            </tbody>
        </table>
        <hr style="margin-bottom: .5em">
        <table border="1px" align="center" style="text-align: left; border-collapse: collapse;" id="data-table">
            <thead>
            <tr>
                <th width="5%" >No</th>
                <th width="10%">Hari</th>
                <th width="15%">Waktu Mulai</th>
                <th width="15%">Waktu Akhir</th>
                <th width="20%">Kegiatan</th>
                <th width="35%">Keterangan</th>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Jadwal::where('jadwal_id', $qis->id)->get() as $index => $value)
                <tr>
                    <td id="td">{{$index + 1}}</td>
                    <td>{{$value->hari}}</td>
                    <td>{{$value->waktu_mulai}}</td>
                    <td>{{$value->waktu_akhir}}</td>
                    <td>{{$value->kegiatan}}</td>
                    <td>{{$value->keterangan == null ? '-' : $value->keterangan}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr style="margin-bottom: .5em">
    @endforeach
@elseif($lemb->id == 3)
    @foreach(\App\JadwalPelajaran::where('lembaga_id', 3)->get() as $index => $mdc)
        <table>
            <tbody>
            <tr>
                <td>Nama Jadwal</td>
                <td>:</td>
                <td> {{ucfirst($mdc->nama_jadwal)}}</td>
            </tr>
            <tr>
                <td>Tanggal Dicatat</td>
                <td>:</td>
                <td> {{$mdc->tgl_dicatat}}</td>
            </tr>
            </tbody>
        </table>
        <hr style="margin-bottom: .5em">
        <table width="100%" border="1px" align="center" style="text-align: left; border-collapse: collapse;" id="data-table">
            <thead>
            <tr>
                <th width="5%" >No</th>
                <th width="15%">Waktu Mulai</th>
                <th width="15%">Waktu Akhir</th>
                <th width="20%">Kegiatan</th>
                <th width="10%">Ruangan</th>
                <th width="35%">Keterangan</th>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Jadwal::where('jadwal_id', $mdc->id)->get() as $index => $value)
                <tr>
                    <td id="td">{{$index + 1}}</td>
                    <td>{{$value->waktu_mulai}}</td>
                    <td>{{$value->waktu_akhir}}</td>
                    <td>{{$value->kegiatan}}</td>
                    <td>{{$value->ruangan}}</td>
                    <td>{{$value->keterangan == null ? '-' : $value->keterangan}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr style="margin-bottom: .5em">
    @endforeach
@elseif($lemb->id == 4)
    @foreach(\App\JadwalPelajaran::where('lembaga_id', 4)->get() as $index => $abk)
        <table>
            <tbody>
            <tr>
                <td>Nama Jadwal</td>
                <td>:</td>
                <td> {{ucfirst($abk->nama_jadwal)}}</td>
            </tr>
            <tr>
                <td>Tanggal Dicatat</td>
                <td>:</td>
                <td> {{$abk->tgl_dicatat}}</td>
            </tr>
            </tbody>
        </table>
        <hr style="margin-bottom: .5em">
        <table width="100%" border="1px" align="center" style="text-align: left; border-collapse: collapse;" id="data-table">
            <thead>
            <tr>
                <th width="5%" >No</th>
                <th width="10%">Hari</th>
                <th width="15%">Waktu Mulai</th>
                <th width="15%">Waktu Akhir</th>
                <th width="20%">Kegiatan</th>
                <th width="35%">Keterangan</th>
            </tr>
            </thead>
            <tbody>
            @foreach(\App\Jadwal::where('jadwal_id', $abk->id)->get() as $index => $value)
                <tr>
                    <td id="td">{{$index + 1}}</td>
                    <td>{{$value->hari}}</td>
                    <td>{{$value->waktu_mulai}}</td>
                    <td>{{$value->waktu_akhir}}</td>
                    <td>{{$value->kegiatan}}</td>
                    <td>{{$value->keterangan == null ? '-' : $value->keterangan}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr style="margin-bottom: .5em">
    @endforeach
@endif
</body>
</html>