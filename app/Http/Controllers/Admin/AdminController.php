<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $pegawaiView = Pegawai::all()->count();
        $pegawaiShow = Pegawai::find($request->id);

        return view('admin.admin-home',compact('pegawaiView', 'pegawaiShow'));
    }

    public function changePassAdmin(){
        return view('admin.admin-rpassword');
    }

    public function changeAdmin(Request $request){

//        if (Hash::check(Auth::user()->password, $request->password_lama ) ){
//            Auth::user()->update([
//                'password' => bcrypt($request->password_baru),
//                'password_a' => $request->password_baru,
//            ]);
//        }

        if (!Hash::check($request->password_lama, Auth::user()->password)) {
            return back()->with([
                'error' => 'Password lama anda salah !'
            ]);
        } else {
            if ($request->password_baru !== $request->cpassword_baru) {
                return back()->with([
                    'error' => 'Password baru anda tidak sama !'
                ]);
            } else {
                Auth::user()->update([
                    'password' => bcrypt($request->password_baru),
                    'password_a' => $request->password_baru
                ]);
            }
            return back()->with([
                'sukses' => 'Berhasil Memperbarui Password !'
            ]);
        }
    }
}
