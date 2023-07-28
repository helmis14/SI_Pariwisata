@extends('StaffTiket.layouts.master')
@section('title','Tiket')
@section('judul','Tiket')
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Tiket') }}</div>
            <div class="card-body">
                <!-- Button Tambah Data -->
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahBukuModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
               
               
                <hr />

                <table id="table-data" class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Wisata</th>
                            <th>Nama</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($tiket as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->kode_tiket }}</td>
                                <td>{{ $row->tgl_berkunjung }}</td>
                                <td>{{ $row->jumlah_pengunjung }}</td>
                                <td>{{ $row->total }}</td>
                                <td>{{ $row->wisata->nama_wisata }}</td>
                                <td>{{ $row->pengguna->name }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-buku" class="btn btn-success"
                                            data-toggle="modal" data-target="#editBukuModal"
                                            data-id="{{ $row->id }}">Edit</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->kode_tiket }}' )">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- PERMODALAN -->

    <!-- TAMBAH DATA -->
    <div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Tiket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('StaffTiket.tiket.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" required />
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" id="jumlah" required />
                        </div>  
                        <div class="form-group">
                        <label for="wisata">Wisata</label>
                            <select name="wisata" id="wisata" class="form-control">
                                <option value="">Pilih Wisata</option>
                                @foreach($wisata as $ak)
                            <option value="{{$ak->id}}">{{$ak->nama_wisata}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="user">Pengguna</label>
                            <select name="user" id="user" class="form-control">
                                <option value="">Pilih Pengguna</option>
                                @foreach($users as $us)
                            <option value="{{$us->id}}">{{$us->name}}</option>
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

    <!-- UBAH DATA -->
    <div class="modal fade" id="editBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('StaffTiket.tiket.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-tanggal">Tanggal</label>
                            <input type="text" class="form-control" name="tanggal" id="edit-tanggal" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-jumlah">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" id="edit-jumlah" required />
                        </div>  
                        <div class="form-group">
                        <label for="edit-wisata">Wisata</label>
                            <select name="wisata" id="edit-wisata" class="form-control">
                                <option value="">Pilih Wisata</option>
                                @foreach($wisata as $ak)
                            <option value="{{$ak->id}}">{{$ak->nama_wisata}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="edit-user">Pengguna</label>
                            <select name="user" id="edit-user" class="form-control">
                                <option value="">Pilih Pengguna</option>
                                @foreach($users as $us)
                            <option value="{{$us->id}}">{{$us->name}}</option>
                            @endforeach
                            </select>
                        </div>
                       
                        </div>
                <div class="modal-footer">
                    <input type="hidden" name="kode" id="edit-kode" />
                    <input type="hidden" name="id" id="edit-id" />
                    
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

   

@stop

@section('js')
    <script>
        //EDIT
        $(function() {

            $(document).on('click', '#btn-edit-buku', function() {
                let id = $(this).data('id');


                $.ajax({
                    type: "get",
                    url: "{{ url('StaffTiket/ajaxadmin/dataTiket') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-tanggal').val(res.tgl_berkunjung);
                        $('#edit-jumlah').val(res.jumlah_pengunjung);
                        $('#edit-wisata').val(res.wisata_id);
                        $('#edit-user').val(res.users_id);
                        $('#edit-kode').val(res.kode_tiket);
                        $('#edit-id').val(res.id);
                   

                    },
                });
            });

        });

        //DELETE
        function deleteConfirmation(npm, judul) {
            swal.fire({
                title: "Hapus?",
                type: 'warning',
                text: "Apakah anda yakin akan menghapus data tiket dengan kode " + judul + "?!",

                showCancelButton: !0,
                confirmButtonText: "Ya, lakukan!",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "tiket/delete/" + npm,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results.success === true) {
                                swal.fire("Done!", results.message, "success");
                                // refresh page after 2 seconds
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                swal.fire("Error!", results.message, "error");
                            }
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }
    </script>
@stop