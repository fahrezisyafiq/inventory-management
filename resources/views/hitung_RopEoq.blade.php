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
                    <a href="#">Hitung EOQ & ROP</a>
                </li>


            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Hitung EOQ & ROP</h4>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success btn-round ms-auto" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                {{-- <i class="fa fa-plus"></i> --}}
                                Hitung
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <!-- Modal Hitung Data-->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold"> Hitung</span>
                                            <span class="fw-light"> EOQ & ROP </span>
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formhitung" action="{{ route('count') }}" method="POST">
                                            @csrf <!-- Token CSRF untuk Laravel -->
                                            <div class="row">

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="kode_barang">Kode Barang</label>
                                                        <select class="form-control" id="kode_barang" name="kode_barang"
                                                            required>
                                                            <option value="">-- Pilih Kode Barang --</option>
                                                            @foreach ($dataBarangs as $barang)
                                                                <option value="{{ $barang->kode_barang }}">
                                                                    {{ $barang->kode_barang }} - {{ $barang->nama_barang }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="permintaan">Permintaan \ tahun</label>
                                                        <input type="number" class="form-control" id="permintaan"
                                                            name="permintaan" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="biaya_pesan">Biaya Pesan</label>
                                                        <input type="number" class="form-control" id="biaya_pesan"
                                                            name="biaya_pesan" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="biaya_simpan">Biaya Simpan</label>
                                                        <input type="number" class="form-control" id="biaya_simpan"
                                                            name="biaya_simpan" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="lead_time">Lead time \ Pengiriman Barang</label>
                                                        <input type="number" class="form-control" id="lead_time"
                                                            name="lead_time" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="penjualan_hari">penjualan \ hari</label>
                                                        <input type="number" class="form-control" id="penjualan_hari"
                                                            name="penjualan_hari" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="errorMessage" class="text-danger"></div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="hitung">Hitung</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
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
                                            <th>Stok</th>
                                            <th>EOQ<br>(rekomendasi pesan)</th>
                                            <th>ROP<br>(minimal stok)</th>
                                            <th style="width: 10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($barangs as $barang)
                                            <tr>
                                                <td>{{ $barang->id }}</td>
                                                <td>{{ $barang->kode_barang }}</td>
                                                <td>{{ $barang->nama_barang }}</td>
                                                <td>{{ $barang->stok_barang ?? 0 }}</td>
                                                <td>{{ $barang->eoq }}</td>
                                                <td>{{ $barang->rop }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <button type="button" data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-danger delete-btn"
                                                            data-kode="{{ $barang->kode_barang }}"
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

    {{-- Hitung Data --}}
    <script>
        $('#hitung').click(function() {
            // Ambil data dari form
            var formData = {
                kode_barang: $('#kode_barang').val(),
                permintaan: $('#permintaan').val(),
                biaya_pesan: $('#biaya_pesan').val(),
                biaya_simpan: $('#biaya_simpan').val(),
                lead_time: $('#lead_time').val(),
                penjualan_hari: $('#penjualan_hari').val(),
                _token: $('input[name="_token"]').val() // Token CSRF
            };

            // Kirim data form ke server melalui AJAX
            $.ajax({
                url: '/count', // Route ke controller untuk simpan data
                type: 'POST',
                data: formData,
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
                error: function(xhr) {
                    let message = 'Terjadi kesalahan!';
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        message = Object.values(errors).map(e => e[0]).join('\n');
                    } else if (xhr.responseJSON?.message) {
                        message = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: message,
                    });
                }
            });
        });
    </script>

    {{-- hapus daata --}}
    <script>
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();

            var barangId = $(this).data('kode'); // Ambil id barang dari tombol
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
                        url: '/hapus-eoqrop/' + barangId, // URL untuk menghapus barang
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
@endsection
