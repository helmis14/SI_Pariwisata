<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use App\Models\User;
use App\Models\Hak_akses;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;


class StaffOperatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $user = Auth::user();
        return view('StaffOperator.home', compact( 'user'));
    }

    public function wisata()
    {
        $wisata= Wisata :: all();
        $user = Auth::user();
        return view('StaffOperator.wisata', compact( 'user', 'wisata'));
    }
    public function submit_wisata(Request $req)
    { $validate = $req->validate([
        'nama'=> 'required|max:255',
        'alamat'=> 'required',
        'deskripsi'=> 'required',
        'fasilitas'=> 'required',
        'harga'=> 'required',
        
    ]);
    $wisata = new Wisata;
    $wisata->nama_wisata = $req->get('nama');
    $wisata->alamat = $req->get('alamat');
    $wisata->deskripsi = $req->get('deskripsi');
    $wisata->fasilitas = $req->get('fasilitas');
    $wisata->harga = $req->get('harga');
    $wisata->users_id = auth()->user()->id;
    
    if($req->hasFile('gambar'))
    {
        $extension = $req->file('gambar')->extension();
        $filename = 'wisata'.time().'.'.$extension;
        $req->file('gambar')->storeAS('public/wisata', $filename);
        $wisata->gambar_wisata = $filename;
    }
    $wisata->save();
    Session::flash('status', 'Tambah data wisata berhasil!!!');
    return redirect()->back();
    }

    public function getDataWisata($id)
    {
        $wisata = Wisata::find($id);
        return response()->json($wisata);
    }

    public function update_wisata(Request $req)
    { $validate = $req->validate([
        'nama'=> 'required|max:255',
        'alamat'=> 'required',
        'deskripsi'=> 'required',
        'fasilitas'=> 'required',
        'harga'=> 'required',
        
    ]);
    $wisata= Wisata::find($req->get('id'));
    $wisata->nama_wisata = $req->get('nama');
    $wisata->alamat = $req->get('alamat');
    $wisata->deskripsi = $req->get('deskripsi');
    $wisata->fasilitas = $req->get('fasilitas');
    $wisata->harga = $req->get('harga');
    $wisata->users_id = auth()->user()->id;
    
    if($req->hasFile('gambar'))
    {
        $extension = $req->file('gambar')->extension();
        $filename = 'wisata'.time().'.'.$extension;
        $req->file('gambar')->storeAS('public/wisata', $filename);
        $wisata->gambar_wisata = $filename;
    }
    $wisata->save();
    Session::flash('status', 'Ubah data wisata berhasil!!!');
    return redirect()->back();
    }
   
    public function delete_wisata($id)
    {
        $wisata = Wisata::find($id);
        Storage::delete('public/wisata/'.$wisata->gambar);
        $wisata->delete();
        $success = true;
        $message = "Data Wisata Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function akun()
    {
        $akun= User :: with('akses')->get();
        $user = Auth::user();
        $akses = Hak_akses ::all();
        return view('StaffOperator.akun', compact( 'user', 'akun','akses'));
    }
    public function submit_akun(Request $req)
    { $validate = $req->validate([
        'nama'=> 'required|max:255',
        'username'=> 'required',
        'email'=> 'required',
        'password'=> 'required',
        'hak_akses'=> 'required',
        
    ]);
    $akun = new User;
    $akun->name = $req->get('nama');
    $akun->username = $req->get('username');
    $akun->email = $req->get('email');
    $akun->password = Hash::make($req->get('password'));
    $akun->hak__akses_id = $req->get('hak_akses');
    $akun->email_verified_at = null;
    $akun->remember_token = null;
    $akun->save();
    Session::flash('status', 'Tambah data akun berhasil!!!');
    return redirect()->back();
    }

    public function getDataAkun($id)
    {
        $akun = User::find($id);
        return response()->json($akun);
    }

    public function update_akun(Request $req)
    {   $akun= User::find($req->get('id'));
        $validate = $req->validate([
        'nama'=> 'required|max:255',
        'username'=> 'required',
        'email'=> 'required',
        'password'=> 'required',
        'hak_akses'=> 'required',
        
    ]);
    $akun->name = $req->get('nama');
    $akun->username = $req->get('username');
    $akun->email = $req->get('email');
    $akun->password = Hash::make($req->get('password'));
    $akun->hak__akses_id = $req->get('hak_akses');
    $akun->email_verified_at = null;
    $akun->remember_token = null;
    $akun->save();
    Session::flash('status', 'Ubah data akun berhasil!!!');
    return redirect()->back();

    }
   
    public function delete_akun($id)
    {
        $akun = User::find($id);
        $akun->delete();
        $success = true;
        $message = "Data Akun Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
