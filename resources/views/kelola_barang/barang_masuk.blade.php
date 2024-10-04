@extends('layouts.main')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Barang Masuk</h3>
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
                    <a href="#">Kelola Barang</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Barang Masuk</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Barang Masuk</h4>
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
                                            <span class="fw-mediumbold"> Barang</span>
                                            <span class="fw-light"> Masuk </span>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formBarangMasuk" action="{{ route('barangMasuk.store') }}" method="POST">
                                            @csrf <!-- Token CSRF untuk Laravel -->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="dateInput">Tanggal Masuk</label>
                                                        <input type="date" class="form-control" id="dateInput"
                                                            name="dateInput" required placeholder="Pilih Tanggal" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="kode_barang">Kode Barang</label>
                                                        <select class="form-control" id="kode_barang" name="kode_barang"
                                                            required>
                                                            <option value="">-- Pilih Kode Barang --</option>
                                                            @foreach ($dataBarangs as $barang)
                                                                <option value="{{ $barang->kode_barang }}">
                                                                    {{ $barang->kode_barang }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="nama_barang">Nama Barang</label>
                                                        <input type="text" class="form-control" id="nama_barang"
                                                            name="nama_barang" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="jumlah_masuk">Jumlah Masuk</label>
                                                        <input type="number" class="form-control" id="jumlah_masuk"
                                                            name="jumlah_masuk" required>
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


                        <div class="table-responsive">
                            <table id="add-row" class="display table table-head-bg-primary table-hover text-center">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th>Tanggal Masuk</th>
                                        <th style="width: 10%">Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Masuk</th>
                                        <th style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Masuk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                @foreach ($barangMasuk as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td> <!-- Menampilkan nomor urut -->
                                        <td>{{ $item->tanggal_masuk }}</td>
                                        <td>{{ $item->kode_barang }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>{{ $item->jumlah_masuk }}</td>
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" data-bs-toggle="tooltip" title=""
                                                    class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-bs-toggle="tooltip" title=""
                                                    class="btn btn-link btn-danger" data-original-title="Remove">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Include Script to handle AJAX --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Saat dropdown kode_barang diubah
        $('#kode_barang').change(function() {
            var kodeBarang = $(this).val(); // Dapatkan kode barang yang dipilih

            // Jika kode barang dipilih, jalankan AJAX untuk ambil nama barang
            if (kodeBarang) {
                $.ajax({
                    url: '/get-nama-barang/' + kodeBarang, // URL untuk request ke controller
                    type: 'GET',
                    success: function(data) {
                        // Isi input nama_barang dengan data yang didapat dari AJAX
                        $('#nama_barang').val(data.nama_barang);
                    },
                    error: function() {
                        alert('Gagal mengambil data barang');
                    }
                });
            } else {
                // Kosongkan input nama_barang jika tidak ada kode barang yang dipilih
                $('#nama_barang').val('');
            }
        });
    </script>

    <script>
        $('#saveItem').click(function() {
            // Ambil data dari form
            var formData = {
                tanggal_masuk: $('#dateInput').val(),
                kode_barang: $('#kode_barang').val(),
                jumlah_masuk: $('#jumlah_masuk').val(),
                _token: $('input[name="_token"]').val() // Token CSRF
            };

            // Kirim data form ke server melalui AJAX
            $.ajax({
                url: '/barang-masuk', // Route ke controller untuk simpan data
                type: 'POST',
                data: formData,
                success: function(response) {
                    alert(response.message); // Tampilkan pesan sukses
                    location.reload(); // Refresh halaman setelah berhasil
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        var errorMessage = '';
                        $.each(errors, function(key, value) {
                            errorMessage += value + '\n';
                        });
                        alert(errorMessage); // Tampilkan pesan error jika ada
                    }
                }
            });
        });
    </script>
@endsection
