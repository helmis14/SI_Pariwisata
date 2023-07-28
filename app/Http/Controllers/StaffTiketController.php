<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\Bukti;
use App\Models\Wisata;
use App\Models\User;
use Session;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class StaffTiketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $user = Auth::user();
        return view('StaffTiket.home', compact( 'user'));
    }

    public function tiket()
    {
        $tiket= Tiket :: all();
        $wisata = Wisata ::all();
        $users = User ::where('hak__akses_id',3)->get();
        $user = Auth::user();
        return view('StaffTiket.tiket', compact( 'user', 'tiket','wisata','users'));
    }
    public function submit_tiket(Request $req)
    { $validate = $req->validate([
        'tanggal'=> 'required|max:255',
        'jumlah'=> 'required',
        'wisata'=> 'required',
        'user'=> 'required',
        
    ]);

        $id = IdGenerator::generate(['table' => 'tikets', 'length' => 8, 'prefix' => date('y')]);
     $harga = Wisata::where('id',$req->get('wisata'))->value('harga');
    $tot=$harga * $req->get('jumlah');
    $tiket = new Tiket;
    $tiket->kode_tiket = $id;
    $tiket->tgl_berkunjung = $req->get('tanggal');
    $tiket->jumlah_pengunjung = $req->get('jumlah');
    $tiket->total = $tot;
    $tiket->wisata_id = $req->get('wisata');
    $tiket->users_id = $req->get('user');
   
    $tiket->save();
    Session::flash('status', 'Tambah data Tiket berhasil!!!');
    return redirect()->back();
    }

    public function getDataTiket($id)
    {
        $tiket = Tiket::find($id);
        return response()->json($tiket);
    }

    public function update_tiket(Request $req)
    {   $tiket= Tiket::find($req->get('id'));
        $validate = $req->validate([
            'tanggal'=> 'required|max:255',
            'jumlah'=> 'required',
            'wisata'=> 'required',
            'user'=> 'required',
        
    ]);
    $harga = Wisata::where('id',$req->get('wisata'))->value('harga');
    $tot=$harga * $req->get('jumlah');
    $tiket->kode_tiket = $req->get('kode');;
    $tiket->tgl_berkunjung = $req->get('tanggal');
    $tiket->jumlah_pengunjung = $req->get('jumlah');
    $tiket->total = $tot;
    $tiket->wisata_id = $req->get('wisata');
    $tiket->users_id = $req->get('user');
    $tiket->save();
    Session::flash('status', 'Ubah data tiket berhasil!!!');
    return redirect()->back();

    }
   
    public function delete_tiket($id)
    {
        $tiket = Tiket::find($id);
        $tiket->delete();
        $success = true;
        $message = "Data Tiket Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }    public function pembayaran()
    {
        $pembayaran= Bukti :: all();
        $user = Auth::user();
        $tiket= Tiket :: all();
        return view('StaffTiket.pembayaran', compact( 'user', 'pembayaran','tiket'));
    }
    public function submit_pembayaran(Request $req)
    { $validate = $req->validate([
        'nama'=> 'required|max:255',
        'alamat'=> 'required',
        'deskripsi'=> 'required',
        'fasilitas'=> 'required',
        'harga'=> 'required',
        
    ]);
    $pembayaran = new Bukti;
    $pembayaran->kode_bukti = $req->get('nama');
    $pembayaran->waktu = $req->get('alamat');
    $pembayaran->nama_bukti = $req->get('deskripsi');
    $pembayaran->status = $req->get('fasilitas');
    $pembayaran->tiket_id = $req->get('harga');
    
    if($req->hasFile('gambar'))
    {
        $extension = $req->file('gambar')->extension();
        $filename = 'bukti'.time().'.'.$extension;
        $req->file('gambar')->storeAS('public/bukti', $filename);
        $pembayaran->gambar_bukti = $filename;
    }
    $pembayaran->save();
    Session::flash('status', 'Tambah data pembayaran berhasil!!!');
    return redirect()->back();
    }

    public function getDataPembayaran($id)
    {
        $pembayaran = Bukti::find($id);
        return response()->json($wisata);
    }

    public function update_pembayaran(Request $req)
    { $validate = $req->validate([
        'nama'=> 'required|max:255',
        'alamat'=> 'required',
        'deskripsi'=> 'required',
        'fasilitas'=> 'required',
        'harga'=> 'required',
        
    ]);
    $pembayaran= Bukti::find($req->get('id'));
    $pembayaran->kode_bukti = $req->get('nama');
    $pembayaran->waktu = $req->get('alamat');
    $pembayaran->nama_bukti = $req->get('deskripsi');
    $pembayaran->status = $req->get('fasilitas');
    $pembayaran->tiket_id = $req->get('harga');
   
    
    if($req->hasFile('gambar'))
    {
        $extension = $req->file('gambar')->extension();
        $filename = 'pembayaran'.time().'.'.$extension;
        $req->file('gambar')->storeAS('public/bukti', $filename);
        $pembayaran->gambar_bukti = $filename;
    }
    $bukti->save();
    Session::flash('status', 'Ubah data pembayaran berhasil!!!');
    return redirect()->back();
    }
   
    public function delete_pembayaran($id)
    {
        $pembayaran = Bukti::find($id);
        Storage::delete('public/bukti/'.$pembayaran->gambar_bukti);
        $pembayaran->delete();
        $success = true;
        $message = "Data pembayaran Berhasil Dihapus";
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
