<?php

namespace App\Http\Controllers\Admin;

use App\Pegawai;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
            'username.unique' => 'Username yang anda tambahkan sudah tersedia, masukan username lain!.',
        ]);

        $employee = Pegawai::find($request->id_pegawai);

        $user =  User::create([
            'username' => $request->username,
            'nama_user' => $employee->nama,
            'password' => bcrypt($request->password),
            'password_a' => $request->password,
            'email_user' => $employee->email,
            'foto' => $employee->foto,
            'type' => $request->hak_akses,
            'created_by' => Auth::user()->nama_user,
        ]);

        $employee->update([
           'user_id' => $user->id,
            'status_user' => $user->type,
        ]);

        return redirect()->route('um-home')->with('sukses', $user->nama_user . ' berhasil ditambahkan sebagai ' . $user->type . ' dengan username ' . $user->username . '.');
    }

    public function edit(Request $request){
        $userM = User::find($request->id);
        return view('admin.user-management.m-a-edit', compact('userM'));

    }

    public function update(Request $request, $id){

        $request->validate([
            'username' => "required|unique:users,username,$id",
            'password' => 'required|min:6|required_with:cpassword|same:cpassword',
            'cpassword' => 'required|min:6',
        ],[
            'username.unique' => 'Username yang anda tambahkan sudah tersedia, masukan username lain!.',
        ]);

        $employee = Pegawai::find($request->id_pegawai);

        $user = User::find($request->id);

        $user->update([
            'username' => $request->username,
            'nama_user' => $employee->nama,
            'password' => bcrypt($request->password),
            'password_a' => $request->password,
            'email_user' => $employee->email,
            'foto_user' => $employee->foto,
            'type' => $request->hak_akses,
            'updated_by' => Auth::user()->nama_user,
        ]);

        $employee->update([
            'user_id' => $user->id,
        ]);

        //dd($user->email);
        return redirect()->route('um-home')->with('edit','Username ' . $user->username . ' berhasil diubah.');

    }

    public function destroy($id){
        $user = User::find($id);
        $user->delete();

        return redirect()->route('um-home')->with('hapus','Username ' . $user->username . ' berhasil dihapus.');

    }
}
