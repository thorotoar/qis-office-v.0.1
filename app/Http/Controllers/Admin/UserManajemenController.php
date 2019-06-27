<?php

namespace App\Http\Controllers\Admin;

use App\Pegawai;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Password;

class UserManajemenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $userM = User::all();
        return view('admin.user-management.m-a-home', compact('userM'));
    }

    public function create(){
        return view('admin.user-management.m-a-tambah');
    }

    public function store(Request $request){
        $request->validate([
            'username' => "required|unique:users,username",
            'password' => 'required|min:6',
            'cpassword' => 'required_with:password|same:password|min:6',
        ],[
            'username.required' => 'Username ' . "<b>" . ' belum terisi, ' . "</b>" . 'silahkan isi terlebih dahulu!.',
            'username.unique' => 'Username yang anda tambahkan' . "</b>" . ' sudah tersedia, ' . "<b>" . 'masukan username lain!.',
            'password.required' => 'Password ' . "<b>" . ' belum terisi, ' . "</b>" . 'silahkan isi terlebih dahulu!.',
            'password.min' => 'Password yang anda masukan' . "<b>" . ' kurang ' . "</b>" . 'dari 6 karakter!.',
            'cpassword.required_with' => 'Confirm Password ' . "<b>" . ' belum terisi, ' . "</b>" . 'silahkan isi terlebih dahulu!.',
            'cpassword.same' => "<b>" . 'Password ' . "</b>" . ' dan ' . "<b>" . 'Confirm Password ' . "</b>" . ' harus sama',
        ]);

        $employee = Pegawai::find($request->id_pegawai);

        $user =  User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'type' => $request->hak_akses,
            'created_by' => Auth::user()->pegawai->nama,
        ]);

        $employee->update([
           'user_id' => $user->id,
            'status_user' => $user->type,
        ]);

        return redirect()->route('um-home')->with('sukses', "<b>" . $user->pegawai->nama . "</b>" . ' berhasil ditambahkan sebagai ' . "<b>" . $user->type . "</b>" . ' dengan username ' . "<b>" . $user->username . "</b>" . '.');
    }

    public function edit(Request $request){
        $userM = User::find($request->id);
        return view('admin.user-management.m-a-edit', compact('userM'));

    }

    public function update(Request $request, $id){
        $request->validate([
            'username' => "required|unique:users,username,$id",
            'password' => 'required|min:6',
            'cpassword' => 'required_with:password|same:password|min:6',
        ],[
            'username.required' => 'Username ' . "<b>" . ' belum terisi, ' . "</b>" . 'silahkan isi terlebih dahulu!.',
            'username.unique' => 'Username yang anda tambahkan' . "</b>" . ' sudah tersedia, ' . "<b>" . 'masukan username lain!.',
            'password.required' => 'Password ' . "<b>" . ' belum terisi, ' . "</b>" . 'silahkan isi terlebih dahulu!.',
            'password.min' => 'Password yang anda masukan' . "<b>" . ' kurang ' . "</b>" . 'dari 6 karakter!.',
            'cpassword.required_with' => 'Confirm Password ' . "<b>" . ' belum terisi, ' . "</b>" . 'silahkan isi terlebih dahulu!.',
            'cpassword.same' => "<b>" . 'Password ' . "</b>" . ' dan ' . "<b>" . 'Confirm Password ' . "</b>" . ' harus sama',
        ]);

        $employee = Pegawai::find($request->id_pegawai);

        $user = User::find($request->id);

        $user->update([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'type' => $request->hak_akses,
            'updated_by' => Auth::user()->pegawai->nama,
        ]);

        if (Input::has('id_pegawai')) {
           $pegawai = Pegawai::where('user_id', $user->id)->first();
           $pegawai->update([
               'user_id' => null
           ]);
        }

        $employee->update([
            'user_id' => $user->id,
            'status_user' => $user->type,
        ]);

        //dd($user->email);
        return redirect()->route('um-home')->with('edit','Username ' . "<b>" . $user->username . "</b>" . ' berhasil diubah.');

    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();

        return redirect()->route('um-home')->with('hapus','Username ' . "<b>" . $user->username . "</b>" . ' berhasil dihapus.');

    }
}
