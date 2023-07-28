@extends('StaffOperator.layouts.master')
@section('title','Wisata')
@section('judul','Wisata')
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Wisata') }}</div>
            <div class="card-body">
                <!-- Button Tambah Data -->
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahBukuModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
               
               
                <hr />

                <table id="table-data" class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Nama Wisata</th>
                            <th>Alamat</th>
                            <th>Deskripsi</th>
                            <th>Fasilitas</th>
                            <th>Harga</th>
                            <th>Gambar Wisata</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($wisata as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->nama_wisata }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td>{{ $row->deskripsi }}</td>
                                <td>{{ $row->fasilitas }}</td>
                                <td>{{ $row->harga }}</td>

                                <td>
                                    @if ($row->gambar_wisata !== null)
                                        <img src="{{ asset('storage/wisata/' . $row->gambar_wisata) }}" width="100px" />
                                    @else
                                        [Gambar tidak tersedia]
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-buku" class="btn btn-success"
                                            data-toggle="modal" data-target="#editBukuModal"
                                            data-id="{{ $row->id }}">Edit</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->nama_wisata }}' )">Hapus</button>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Wisata</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('StaffOperator.wisata.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama Wisata</label>
                            <input type="text" class="form-control" name="nama" id="nama" required />
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat" required />
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <input type="text" class="form-control" name="deskripsi" id="deskripsi" required />
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="fasilitas">Fasilitas</label>
                            <input type="text" class="form-control" name="fasilitas" id="fasilitas" required />
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" name="harga" id="harga" required />
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control" name="gambar" id="gambar" />
                        </div>
                        </div>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Wisata</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('StaffOperator.wisata.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-wisata">Nama Wisata</label>
                                    <input type="text" class="form-control" name="nama" id="edit-wisata"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-alamat">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" id="edit-alamat"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-deskripsi">Deskripsi</label>
                                    <input type="text" class="form-control" name="deskripsi" id="edit-deskripsi"
                                        required />
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="edit-fasilitas">Fasilitas</label>
                                    <input type="text" class="form-control" name="fasilitas" id="edit-fasilitas"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="edit-harga">Harga</label>
                                    <input type="number" class="form-control" name="harga" id="edit-harga"
                                        required />
                                </div>
                            
                                <div class="form-group">
                                    <label for="edit-gambar">Gambar</label>
                                    <input type="file" class="form-control" name="gambar" id="edit-gambar" />
                                </div>
                                <div class="form-group" id="image-area"></div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" id="edit-id" />
                    <input type="hidden" name="old_cover" id="edit-old-cover" />
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

                $('#image-area').empty();

                $.ajax({
                    type: "get",
                    url: "{{ url('StaffOperator/ajaxadmin/dataWisata') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-wisata').val(res.nama_wisata);
                        $('#edit-alamat').val(res.alamat);
                        $('#edit-deskripsi').val(res.deskripsi);
                        $('#edit-fasilitas').val(res.fasilitas);
                        $('#edit-harga').val(res.harga);
                        $('#edit-id').val(res.id);
                        $('#edit-old-cover').val(res.gambar_wisata);

                        if (res.gambar_wisata !== null) {
                            $('#image-area').append(
                                "<img src='" + baseurl + "/storage/wisata/" + res
                                .gambar_wisata + "' width='200px'/>"
                            );
                        } else {
                            $('#image-area').append('[Gambar tidak tersedia]');
                        }
                    },
                });
            });

        });

        //DELETE
        function deleteConfirmation(npm, judul) {
            swal.fire({
                title: "Hapus?",
                type: 'warning',
                text: "Apakah anda yakin akan menghapus data Wisata dengan judul " + judul + "?!",

                showCancelButton: !0,
                confirmButtonText: "Ya, lakukan!",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "wisata/delete/" + npm,
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