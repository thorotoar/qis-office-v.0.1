<?php

namespace App\Http\Controllers;

use App\Pegawai;
use Illuminate\Http\Request;

class ApiController extends Controller
{
//    public function __construct(){
//        $this->middleware('auth');
//        $this->middleware('api');
//    }

    public function test(Request $request){
        $test = Pegawai::where('id', '1')->get();

        $title = $request->title;
        $desc = $request->desc;
        $time = $request->time;
        $user_id = $request->user_id;

        $api = [
            'title' => $title,
            'desc' => $desc,
            'time' => $time,
            'user_id' => $user_id
        ];

        $fill = [
//          'isi' => $test,
          'title' => $title,
          'desc' => $desc,
          'time' => $time,
          'user_id' => $user_id,
          'api_view' => [
              'href' => "api/v1/1",
              'method' => 'GET'
          ]
        ];

        $resp = [
            'msg' => 'Data berhasil masuk',
            'data' => $fill
        ];

        return response()->json($resp, 201);
    }
}
