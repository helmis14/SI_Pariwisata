@extends('StaffOperator.layouts.master')
@section('title','Akun')
@section('judul','Akun')
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Akun') }}</div>
            <div class="card-body">
                <!-- Button Tambah Data -->
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahBukuModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
               
               
                <hr />

                <table id="table-data" class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Hak Akses</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($akun as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->username }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->akses->name }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-buku" class="btn btn-success"
                                            data-toggle="modal" data-target="#editBukuModal"
                                            data-id="{{ $row->id }}">Edit</button>
                                        <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->name }}' )">Hapus</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('StaffOperator.akun.submit') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="nama">Nama </label>
                            <input type="text" class="form-control" name="nama" id="nama" required />
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" required />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" required />
                        </div>  
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="number" class="form-control" name="password" id="password" required />
                        </div>
                        <div class="form-group">
                        <label for="hak_akses">Hak Akses</label>
                            <select name="hak_akses" id="hak_akses" class="form-control">
                                <option value="">Pilih Hak Akses</option>
                                @foreach($akses as $ak)
                            <option value="{{$ak->id}}">{{$ak->name}}</option>
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
                    <form method="post" action="{{ route('StaffOperator.akun.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-nama">Nama </label>
                            <input type="text" class="form-control" name="nama" id="edit-nama" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-username">Username</label>
                            <input type="text" class="form-control" name="username" id="edit-username" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-email">Email</label>
                            <input type="text" class="form-control" name="email" id="edit-email" required />
                        </div>  
                        <div class="form-group">
                            <label for="edit-password">Password</label>
                            <input type="text" class="form-control" name="password" id="edit-password" required />
                        </div>
                        <div class="form-group">
                        <label for="edit-hak_akses">Hak Akses</label>
                            <select name="hak_akses" id="edit-hak_akses" class="form-control">
                                <option value="">Pilih Hak Akses</option>
                                @foreach($akses as $ak)
                            <option value="{{$ak->id}}">{{$ak->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>
                <div class="modal-footer">
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
                    url: "{{ url('StaffOperator/ajaxadmin/dataAkun') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-nama').val(res.name);
                        $('#edit-username').val(res.username);
                        $('#edit-email').val(res.email);
                        $('#edit-password').val(res.password);
                        $('#edit-hak_akses').val(res.hak__akses_id);
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
                text: "Apakah anda yakin akan menghapus data akun dengan nama " + judul + "?!",

                showCancelButton: !0,
                confirmButtonText: "Ya, lakukan!",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "akun/delete/" + npm,
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