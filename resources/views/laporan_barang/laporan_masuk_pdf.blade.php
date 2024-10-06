<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang Masuk</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body onload="window.print()"> <!-- Memanggil window.print() saat halaman diload -->
    <h2>Laporan Barang Masuk</h2>
    <p>Tanggal: {{ $startDate }} - {{ $endDate }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal Masuk</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Harga Barang</th>
                <th>Jumlah Masuk</th>
            </tr>
        </thead>
        <tbody>
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
</body>

</html>
