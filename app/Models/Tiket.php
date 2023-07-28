<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;
    public function wisata()
    {
        return $this->belongsTo(Wisata::class, 'wisata_id','id')
                        ->withDefault(['wisata_id' => 'Wisata belum dipilih']);
    }
    public function bukti()
    {
        return $this->belongsTo(Bukti::class, 'id','tiket_id')
                        ->withDefault(['tiket_id' => 'Wisata belum dipilih']);
    }
    public function pengguna()
    {
        return $this->belongsTo(User::class, 'users_id','id')
                        ->withDefault(['users_id' => 'Pengguna belum dipilih']);
    }
}
