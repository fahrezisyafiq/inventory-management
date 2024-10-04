@extends('layouts.main')

@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Barang Keluar</h3>
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
                    <a href="#">Barang Keluar</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">Barang Keluar</h4>
                            <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                data-bs-target="#addRowModal">
                                <i class="fa fa-plus"></i>
                                Tambah Data
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Modal -->
                        <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">
                                            <span class="fw-mediumbold"> Barang</span>
                                            <span class="fw-light"> Keluar </span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="small">
                                            Stok Barang Keluar
                                        </p>
                                        <form>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="dateInput">Tanggal Keluar</label>
                                                        <input type="date" class="form-control" id="dateInput"
                                                            placeholder="Pilih Tanggal" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Kode Barang</label>
                                                        <select class="form-select" id="exampleFormControlSelect1">
                                                            <option>KB01</option>
                                                            <option>KB02</option>
                                                            <option>KB03</option>
                                                            <option>KB04</option>
                                                            <option>KB05</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="namaBarang">Nama Barang</label>
                                                        <input type="text" class="form-control form-control"
                                                            id="namaBarang" placeholder="nama barang" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="jumlahKeluar">Jumlah Barang Keluar</label>
                                                        <input type="text" class="form-control form-control"
                                                            id="jumlahKeluar" placeholder="jumlah Keluar" />
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" id="addRowButton" class="btn btn-primary">
                                            Add
                                        </button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="add-row" class="display table table-head-bg-primary table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th>Tanggal Keluar</th>
                                        <th style="width: 10%">Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Keluar</th>
                                        <th style="width: 10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Keluar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>17-02-2024</td>
                                        <td>KB01</td>
                                        <td>Makanan</td>
                                        <td>30</td>
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
                                    <tr>
                                        <td>2</td>
                                        <td>17-02-2024</td>
                                        <td>KB01</td>
                                        <td>Makanan</td>
                                        <td>30</td>
                                        <td>
                                            <div class="form-button-action">
                                                <button type="button" data-bs-toggle="tooltip" title=""
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Task">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" data-bs-toggle="tooltip" title=""
                                                    class="btn btn-link btn-danger" data-original-title="Remove">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </td>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
