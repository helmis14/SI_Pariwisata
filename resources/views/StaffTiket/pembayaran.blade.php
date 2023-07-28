@extends('StaffTiket.layouts.master')
@section('title','Pembayaran')
@section('judul','Pembayaran')
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Pembayaran') }}</div>
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
                            <th>Waktu</th>
                            <th>Nama Bukti</th>
                            <th>Status</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($pembayaran as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->kode_bukti }}</td>
                                <td>{{ $row->waktu }}</td>
                                <td>@if ($row->gambar_bukti !== null)
                                        <img src="{{ asset('storage/bukti/' . $row->gambar_bukti) }}" width="100px" />
                                    @else
                                        [Gambar tidak tersedia]
                                    @endif</td>
                                <td>{{ $row->status }}</td>
                                <td>
                                    <a href="" class="btn btn-success">Terima</a>
                                    <button class="btn-xs"></button>
                                    <a href="" class="btn btn-warning">Tolak</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

  <!-- TAMBAH DATA -->
 
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
                    url: "{{ url('StaffTiket/ajaxadmin/dataPembaaran') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-kode').val(res.kode_bukti);
                        $('#edit-nama').val(res.nama_bukti);
                        
                        $('#edit-status').val(res.status);
                        $('#edit-id').val(res.id);
                        $('#edit-old-cover').val(res.gambar_bukti);

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
                        url: "pembayaran/delete/" + npm,
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