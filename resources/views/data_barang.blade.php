@extends('layouts.main')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            {{-- <h3 class="fw-bold mb-3">Data Barang</h3> --}}
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
                    <a href="#">Data Barang</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Data Barang</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Data Barang</h4>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success btn-round ms-auto" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <i class="fa fa-plus"></i>
                                Tambah Barang
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
                                            <span class="fw-light">Barang</span>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="addItemForm" action="{{ route('tambah.barang') }}" method="POST">
                                            @csrf <!-- Token CSRF untuk Laravel -->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="kodeBarang">Kode Barang</label>
                                                        <input type="text" class="form-control" id="kodeBarang"
                                                            name="kodeBarang" required placeholder="Masukkan kode barang">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="namaBarang">Nama Barang</label>
                                                        <input type="text" class="form-control" id="namaBarang"
                                                            name="namaBarang" required placeholder="Masukkan nama barang">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="jenisBarang">Jenis Barang</label>
                                                        <input type="text" class="form-control" id="jenisBarang"
                                                            name="jenisBarang" required placeholder="Masukkan jenis barang">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="hargaBarang">Harga Barang</label>
                                                        <input type="number" class="form-control" id="hargaBarang"
                                                            name="hargaBarang" required placeholder="Masukkan harga barang">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="stokBarang">Stok Barang</label>
                                                        <input type="text" class="form-control" id="stokBarang"
                                                            value="0" placeholder="" disabled />
                                                    </div>
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
                                                <label for="editKodeBarang" class="form-label">Kode Barang</label>
                                                <input type="text" class="form-control" id="editKodeBarang"
                                                    name="kode_barang" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editNamaBarang" class="form-label">Nama Barang</label>
                                                <input type="text" class="form-control" id="editNamaBarang"
                                                    name="nama_barang" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editJenisBarang" class="form-label">Jenis Barang</label>
                                                <input type="text" class="form-control" id="editJenisBarang"
                                                    name="jenis_barang" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editHargaBarang" class="form-label">Harga Barang</label>
                                                <input type="number" class="form-control" id="editHargaBarang"
                                                    name="harga_barang" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editStokBarang" class="form-label">Stok Barang</label>
                                                <input type="number" class="form-control" id="editStokBarang" readonly
                                                    name="stok_barang" required>
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

                        @if ($barangs->isEmpty())
                            <div class="alert alert-warning text-center" role="alert">
                                Tidak ada Data Barang.
                            </div>
                        @else
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-head-bg-primary table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">#</th>
                                            <th style="width: 10%">Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th style="width: 10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($barangs as $barang)
                                            <tr>
                                                <td>{{ $barang->id }}</td>
                                                <td>{{ $barang->kode_barang }}</td>
                                                <td>{{ $barang->nama_barang }}</td>
                                                <td>{{ $barang->jenis_barang }}</td>
                                                <td>{{ $barang->harga_barang }}</td>
                                                <td>{{ $barang->stok_barang ?? 0 }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#editModal" title=""
                                                            class="btn btn-link btn-primary btn-lg edit-btn"
                                                            data-id="{{ $barang->id }}"
                                                            data-kode="{{ $barang->kode_barang }}"
                                                            data-nama="{{ $barang->nama_barang }}"
                                                            data-jenis="{{ $barang->jenis_barang }}"
                                                            data-harga="{{ $barang->harga_barang }}"
                                                            data-stok="{{ $barang->stok_barang ?? 0 }}"
                                                            data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-danger delete-btn"
                                                            data-id="{{ $barang->id }}"
                                                            data-nama="{{ $barang->nama_barang }}"
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
                        @endif
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
            var kode = $(this).data('kode');
            var nama = $(this).data('nama');
            var jenis = $(this).data('jenis');
            var harga = $(this).data('harga');
            var stok = $(this).data('stok');

            // Isi field di modal edit
            $('#editId').val(id);
            $('#editKodeBarang').val(kode);
            $('#editNamaBarang').val(nama);
            $('#editJenisBarang').val(jenis);
            $('#editHargaBarang').val(harga);
            $('#editStokBarang').val(stok);

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

            var barangId = $(this).data('id'); // Ambil id barang dari tombol
            var barangNama = $(this).data('nama'); // Ambil nama barang untuk ditampilkan di SweetAlert

            // Tampilkan SweetAlert konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan menghapus barang: " + barangNama,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, kirimkan permintaan AJAX untuk menghapus barang
                    $.ajax({
                        url: '/data-barang/' + barangId, // URL untuk menghapus barang
                        type: 'DELETE', // Method DELETE
                        data: {
                            _token: '{{ csrf_token() }}' // Sertakan token CSRF
                        },
                        success: function(response) {
                            // Jika sukses, tampilkan SweetAlert sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Barang berhasil dihapus!',
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
                                text: 'Terjadi kesalahan saat menghapus barang.',
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
                var form = $('#addItemForm');
                var modal = $('#exampleModal');

                // Reset error states
                form.find('.form-control').removeClass('is-invalid');
                form.find('.invalid-feedback').remove();

                // Lakukan AJAX
                $.ajax({
                    url: '{{ route('tambah.barang') }}',
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        // Jika berhasil
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#addItemForm')[0]
                                    .reset(); // Reset form setelah berhasil
                                location.reload(); // Reload halaman setelah sukses
                            }
                        });
                    },
                    error: function(xhr) {
                        // Jika terjadi kesalahan validasi (kode status 422)
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;

                            // Iterasi setiap error dan tampilkan pesan kesalahan
                            $.each(errors, function(key, value) {
                                var input = $('[name="' + key +
                                    '"]'
                                    ); // Ambil elemen input sesuai dengan nama field

                                input.addClass(
                                    'is-invalid'
                                    ); // Tambahkan kelas 'is-invalid' pada input
                                input.after('<div class="invalid-feedback">' + value[
                                    0] +
                                '</div>'); // Tampilkan pesan kesalahan di bawah input
                            });

                            // Tampilkan modal kembali jika ada error
                            modal.modal('show');
                        } else {
                            // Jika ada error selain validasi
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan!',
                            });

                            // Tampilkan modal kembali jika ada error selain validasi
                            modal.modal('show');
                        }
                    }
                });
            });
        });
    </script>
@endsection
