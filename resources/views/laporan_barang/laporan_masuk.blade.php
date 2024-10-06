@extends('layouts.main')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Laporan Barang Masuk</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Laporan Barang</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Laporan Barang Masuk</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center mb-3">
                            <h4 class="card-title">Laporan Barang Masuk</h4>
                        </div>

                        <!-- Form Filter -->
                        <form id="filterForm" class="mb-4">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="date" name="start_date" id="start_date" class="form-control"
                                        placeholder="Tanggal Mulai" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="date" name="end_date" id="end_date" class="form-control"
                                        placeholder="Tanggal Akhir" required>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success">Filter</button>
                                </div>
                                <div class="col-md-2 ms-auto">
                                    <button type="button" id="printLaporan" class="btn btn-secondary"><i
                                            class="fas fa-print"></i> Print</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Tabel Laporan -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="laporanTable" class="display table table-head-bg-primary table-hover text-center">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 15%">Tanggal Masuk</th>
                                        <th style="width: 10%">Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis Barang</th>
                                        <th>Harga Barang</th>
                                        <th style="width: 5%">Jumlah Masuk</th>
                                    </tr>
                                </thead>
                                <tbody id="laporanTableBody">
                                    @foreach ($laporanMasuk as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->tanggal_masuk }}</td>
                                            <td>{{ $item->dataBarang->kode_barang }}</td>
                                            <td>{{ $item->dataBarang->nama_barang }}</td>
                                            <td>{{ $item->dataBarang->jenis_barang }}</td>
                                            <td>{{ $item->dataBarang->harga_barang }}</td>
                                            <td>{{ $item->jumlah_masuk }}</td>
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
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function() {
        // Event listener untuk form filter
        $('#filterForm').on('submit', function(event) {
            event.preventDefault();
            console.log('Form Filter Submitted'); // Log untuk mengecek

            let startDate = $('#start_date').val();
            let endDate = $('#end_date').val();

            $.ajax({
                url: "{{ route('laporanMasuk.filter') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    start_date: startDate,
                    end_date: endDate
                },
                success: function(response) {
                    $('#laporanTableBody').empty();

                    let laporanHtml = '';
                    response.forEach(function(item, index) {
                        laporanHtml += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.tanggal_masuk}</td>
                                <td>${item.data_barang.kode_barang}</td>
                                <td>${item.data_barang.nama_barang}</td>
                                <td>${item.data_barang.jenis_barang}</td>
                                <td>${item.data_barang.harga_barang}</td>
                                <td>${item.jumlah_masuk}</td>
                            </tr>
                        `;
                    });
                    $('#laporanTableBody').html(laporanHtml);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: xhr.responseJSON.message ||
                            'Terjadi kesalahan saat memuat laporan!',
                    });
                }
            });
        });

    });
</script>

<script>
    $(document).ready(function() {
        // Event listener untuk tombol Print
        $('#printLaporan').on('click', function() {
            let startDate = $('#start_date').val();
            let endDate = $('#end_date').val();

            if (!startDate || !endDate) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tanggal tidak lengkap!',
                    text: 'Silakan pilih tanggal awal dan akhir sebelum mencetak.',
                });
                return;
            }

            // Redirect ke halaman PDF dengan parameter tanggal
            // Membuka tab baru untuk pratinjau PDF
            let url = `{{ route('laporanMasuk.print') }}?start_date=${startDate}&end_date=${endDate}`;
            window.open(url, '_blank');
        });
    });
</script>
