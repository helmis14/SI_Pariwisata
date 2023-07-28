@extends('layouts.app')

@section('content')

<head class="text-center" >
    <h3 style="margin-left:50px">List Pesanan Tiket Anda</h3>
</head>
<main>
  <div class="container-fluid"   >
        <!-- Small boxes (Stat box) -->
        <div class="row">
          @foreach($tiket as $row)
          <div class="col-lg-3 col-6" style="margin-left:30px;margin-top:20px">
            <!-- small box -->
            <div class="small-box bg-warning rounded-5">
              <div class="inner">
<img src="{{ asset('storage/wisata/' . $row->wisata->gambar_wisata) }}" style=" object-fit: cover; width: 100%; height:10vh; margin:0px; position:relative;">
                <img src="" alt="">
                <table>
                  <tr>
                    <td>Nama Wisata</td>
                    <td>:</td>
                    <td>{{$row->wisata->nama_wisata}}</td>
                  </tr>
                  <tr>
                    <td>Kode Tiket</td>
                    <td>:</td>
                    <td>{{$row->kode_tiket}}</td>
                  </tr>
                  <tr>
                    <td>Tanggal Berkunjung</td>
                    <td>:</td>
                    <td>{{$row->tgl_berkunjung}}</td>
                  </tr>
                  <tr>
                    <td>Total Bayar</td>
                    <td>:</td>
                    <td>{{$row->total}}</td>
                  </tr>
                  <tr>
                    <td>No req pembayaran</td>
                    <td>:</td>
                    <td>00635287369263892</td>
                </tr>
                <tr>
                    <td>Status Tiket</td>
                    <td>:</td>
                    <td> @if($row->bukti->status == 0)
                      <span> Belum Diverifikasi</span>
                     @elseif($row->bukti->status == 1)
                    <span>Diterima</span>
                    @else
                    <span>Ditolak</span>
                    @endif
                    </td>
                  </tr>
                </table>
             
                <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              </div>
              @if($row->bukti->tiket_id == $row->id && $row->bukti->status == 1)
              @else
              <button class="btn btn-primary float-right" data-toggle="modal" data-target="#tambahBukuModal"><i class="fa fa-plus "></i>
                   upload bukti</button>
                   @endif
            </div>
          </div>
@endforeach

        </div>
  
 
        <div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Bukti</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('Pengunjung.pembayaran.submit') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="bukti">Bukti</label>
                            <input type="file" class="form-control" name="bukti" id="bukti" required />
                        </div>
                        <div class="form-group">
                        <label for="tiket">Kode Tiket</label>
                            <select name="tiket" id="tiket" class="form-control">
                                <option value="">Pilih Kode</option>
                                @foreach($tiket as $ak)
                            <option value="{{$ak->id}}">{{$ak->kode_tiket}}</option>
                            @endforeach
                            </select>
                        </div>
                       
                        </div>

      
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection