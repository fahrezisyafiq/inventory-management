@extends('layouts.main')

@section('content')
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2">Admin Dashboard</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-primary card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Data Barang</p>
                                    <h4 class="card-title">{{ $totalStok }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-info card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Pegawai</p>
                                    <h4 class="card-title">{{ $totalPegawai }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-success card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-arrow-alt-circle-down"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Laporan Masuk</p>
                                    <h4 class="card-title">{{ $totalBarangMasuk }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-secondary card-round">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5">
                                <div class="icon-big text-center">
                                    <i class="fas fa-arrow-alt-circle-up"></i>
                                </div>
                            </div>
                            <div class="col-7 col-stats">
                                <div class="numbers">
                                    <p class="card-category">Laporan Keluar</p>
                                    <h4 class="card-title">{{ $totalBarangKeluar }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Brang Hampir Habis</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($barangs->isEmpty())
                            <div class="alert alert-warning text-center" role="alert">
                                Stok semua barang masih aman 👍
                            </div>
                        @else
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-head-bg-danger table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">#</th>
                                            <th style="width: 10%">Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Stok</th>
                                            <th>ROP<br>(minimal stok)</th>
                                            <th>status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($barangs as $barang)
                                            <tr>
                                                <td>{{ $barang->id }}</td>
                                                <td>{{ $barang->kode_barang }}</td>
                                                <td>{{ $barang->nama_barang }}</td>
                                                <td>{{ $barang->stok_barang }}</td>
                                                <td>{{ $barang->rop }}</td>
                                                <td><span class="badge bg-warning text-dark">Perlu restock</span></td>

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
@endsection
