@extends('layouts.app')

@section('content')
@foreach($wisata as $row)
<head class="text-center" >
<img src="{{ asset('storage/wisata/' . $row->gambar_wisata) }}" style=" object-fit: cover; width: 100%; height:100vh; margin:0px; position:relative;">
   
</head>
<main>
   
    <div class="container">
        <section class="section-stats row justify-content-center" id="stats">
            <div class="col-3 col-md-2 stats-detail">
                <h2>20K</h2>
                <p>Members</p>
            </div>
            <div class="col-3 col-md-2 stats-detail">
                <h2>12</h2>
                <p>Countries</p>
            </div>
            <div class="col-3 col-md-2 stats-detail">
                <h2>3K</h2>
                <p>Hotels</p>
            </div>
            <div class="col-3 col-md-2 stats-detail">
                <h2>72</h2>
                <p>Partners</p>
            </div>
        </section>
    </div>
    <section class="section-popular" id="popular">
        <div class="container">
            <div class="row">
                <div class="col text-center section-popular-heading">
                    <h2>Wisata Popular</h2>
                    <p>
                        Something that you never try
                        <br />
                        before in this world
                    </p>
                </div>
            </div>
            <div class="card" style="width: 40rem; background-color:#051334;">
            <table id="datatable" class="table"  style="color:white">
                   
                        <tbody>
                            <tr>
                                <td>Nama Wisata</td>
                                <td>: {{$row->nama_wisata}}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:{{$row->alamat}}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>:{{$row->deskripsi}}</td>
                            </tr>
                            <tr>
                                <td>Fasilitas</td>
                                <td>:{{$row->fasilitas}}</td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td>:{{$row->harga}}</td>
                            </tr>
                        </tbody>
                       
                    </table>
        </div>
        <div class="btn-group float-md-right" role="group" aria-label="Basic example" >
        <a href="{{ URL::previous() }}" class="btn btn-success"><i class="fa fa-undo"> kembali</i></a>
        <button class="btn "></button>
        <button class="btn btn-warning" data-toggle="modal" data-target="#tambahBukuModal"><i class="fa fa-edit"></i>
                    Pesan</button>
        </div>
        @endforeach
    </section>
    
    <div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Wisata</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('Pengunjung.tiket.submit') }}" enctype="multipart/form-data">
                        @csrf
                        
                     
                        <div class="form-group">
                            <label for="tanggal">Tanggal Berkunjung</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" required />
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah Pengunjung</label>
                            <input type="number" class="form-control" name="jumlah" id="jumlah" required />
                        </div>
                        
                        

                </div>
                <div class="modal-footer">
                @foreach($wisata as $ws)
                <input type="hidden" name="wisata_id" id="edit-wisata_id" value="{{$ws->id}}"/>
                @endforeach
               
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection