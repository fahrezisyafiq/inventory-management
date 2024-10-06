@extends('layouts.main')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Data Pegawai</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Data Pegawai</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Data Pegawai</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Data Pegawai</h4>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success btn-round ms-auto" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="fa fa-plus"></i>
                                Tambah Pegawai
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <!-- Modal Tambah Data-->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold">Tambah</span>
                                            <span class="fw-light">Pegawai</span>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addItemForm" action="{{ route('tambah.pegawai') }}" method="POST">
                                            @csrf <!-- Token CSRF untuk Laravel -->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label for="name">Nama</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        required placeholder="Masukkan nama">

                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        required placeholder="Masukkan email">

                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" id="password"
                                                        name="password" required placeholder="Masukkan password">

                                                </div>

                                                <div class="form-group">
                                                    <label for="phone">No HP</label>
                                                    <input type="text" class="form-control" id="phone" name="phone"
                                                        required placeholder="Masukkan nomor HP">

                                                </div>

                                            </div>
                                            <div id="errorMessage" class="text-danger"></div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="saveItem">Add</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Barang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editItemForm">
                                            @csrf <!-- Token CSRF -->
                                            @method('PUT') <!-- Metode PUT untuk update -->
                                            <input type="hidden" id="editId" name="id">
                                            <div class="mb-3">
                                                <label for="editName" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="editName" name="name"
                                                    required>

                                            </div>

                                            <div class="mb-3">
                                                <label for="editEmail" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="editEmail" name="email"
                                                    required>

                                            </div>

                                            <div class="mb-3">
                                                <label for="editPassword" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="editPassword"
                                                    name="password"
                                                    placeholder="Masukkan password baru (kosongkan jika tidak ingin mengganti)">

                                            </div>

                                            <div class="mb-3">
                                                <label for="editPhone" class="form-label">No HP</label>
                                                <input type="text" class="form-control" id="editPhone" name="phone"
                                                    required>

                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="updateItem">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="add-row" class="display table table-head-bg-primary table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No Hp</th>
                                        <th>Passwoard</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No Hp</th>
                                        <th>Passwoard</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($pegawais as $pegawai)
                                        <tr>
                                            <td>{{ $pegawai->id }}</td>
                                            <td>{{ $pegawai->name }}</td>
                                            <td>{{ $pegawai->email }}</td>
                                            <td>{{ $pegawai->phone }}</td>
                                            <td>{{ $pegawai->password }}</td>
                                            <td>
                                                <div class="form-button-action">
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#editModal" title=""
                                                        class="btn btn-link btn-primary btn-lg edit-btn"
                                                        data-id="{{ $pegawai->id }}" data-nama="{{ $pegawai->name }}"
                                                        data-email="{{ $pegawai->email }}"
                                                        data-phone="{{ $pegawai->phone }}"
                                                        data-password="{{ $pegawai->password }}"
                                                        data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-danger delete-btn"
                                                        data-id="{{ $pegawai->id }}" data-nama="{{ $pegawai->name }}"
                                                        data-original-title="Remove">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Edit data --}}
    <script>
        $(document).on('click', '.edit-btn', function() {
            // Ambil data dari tombol edit
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var email = $(this).data('email');
            var phone = $(this).data('phone');
            var password = $(this).data('password');

            // Isi field di modal edit
            $('#editId').val(id);
            $('#editName').val(nama);
            $('#editEmail').val(email);
            $('#editPhone').val(phone);
            $('#editPassword').val(password);

            // Tampilkan modal edit
            $('#editModal').modal('show');
        });

        $('#updateItem').click(function() {
            var form = $('#editItemForm');

            $.ajax({
                url: '/data-barang/' + $('#editId').val(), // Ganti dengan URL yang sesuai
                type: 'PUT',
                data: form.serialize(), // Mengambil data dari form
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload(); // Reload halaman setelah berhasil
                    });
                },
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.responseJSON.message || 'Terjadi kesalahan!',
                    });
                }
            });
        });
    </script>

    {{-- hapus daata --}}
    <script>
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();

            var pegawaiId = $(this).data('id'); // Ambil id pegawai dari tombol
            var pegawaiNama = $(this).data('nama_barang'); // Ambil nama barang untuk ditampilkan di SweetAlert

            // Tampilkan SweetAlert konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan menghapus pegawai: " + pegawaiNama,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, kirimkan permintaan AJAX untuk menghapus pegawai
                    $.ajax({
                        url: '/data-pegawai/' + pegawaiId, // URL untuk menghapus barang
                        type: 'DELETE', // Method DELETE
                        data: {
                            _token: '{{ csrf_token() }}' // Sertakan token CSRF
                        },
                        success: function(response) {
                            // Jika sukses, tampilkan SweetAlert sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Pegawai berhasil dihapus!',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                // Reload halaman setelah SweetAlert selesai
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            // Jika gagal, tampilkan SweetAlert error
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menghapus Pegawai.',
                            });
                        }
                    });
                }
            });
        });
    </script>

    {{-- tambah data --}}
    <script>
        $(document).ready(function() {
            $('#saveItem').click(function() {
                var modal = $('#exampleModal');

                // Sembunyikan modal
                modal.modal('hide');

                // Lakukan AJAX
                $.ajax({
                    url: '{{ route('tambah.pegawai') }}',
                    type: 'POST',
                    data: $('#addItemForm').serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Pegawai berhasil ditambahkan!',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#addItemForm')[0].reset(); // Mereset form
                                location.reload(); // Reload halaman setelah berhasil
                            }
                        });
                    },
                    error: function(response) {
                        // Menampilkan pesan kesalahan jika validasi gagal
                        if (response.status === 422) {
                            var errors = response.responseJSON.errors;
                            var errorMessage = '';
                            $.each(errors, function(key, value) {
                                errorMessage += value[0] +
                                    '<br>'; // Ambil pesan kesalahan
                            });
                            // Tampilkan SweetAlert untuk error
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                html: errorMessage, // Menggunakan html untuk menampilkan banyak pesan
                                confirmButtonText: 'OK'
                            }).then(() => {
                                // Tidak melakukan reload, hanya menyembunyikan alert
                                modal.modal(
                                    'show'); // Tampilkan kembali modal jika ingin
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.responseJSON.message ||
                                    'Terjadi kesalahan!',
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection
