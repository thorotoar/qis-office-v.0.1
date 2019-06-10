@extends('admin.a-surat-keluar.ak-head')
@section('rincian')
    @if( $sk->jenisSurat->template_surat == 'Template 1' )
        <div class="letter_head">
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
        <div class="letter_head_2">
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
@endsection