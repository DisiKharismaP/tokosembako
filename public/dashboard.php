<?php
session_start();
if (!isset($_SESSION['id_pengguna'])) {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
include '../config/db_connection.php'; 

// Query untuk mendapatkan total jumlah dan harga dari pembelian
$query_pembelian = "SELECT SUM(jumlah_pembelian) AS total_jumlah_pembelian, SUM(harga_beli) AS total_harga_beli FROM pembelian";
$result_pembelian = $conn->query($query_pembelian);
$data_pembelian = $result_pembelian->fetch_assoc();
$total_jumlah_pembelian = $data_pembelian['total_jumlah_pembelian'] ?? 0;
$total_harga_beli = $data_pembelian['total_harga_beli'] ?? 0;

// Query untuk mendapatkan total jumlah dan harga dari penjualan
// Ambil data dari hasil query penjualan
$query_penjualan = "SELECT SUM(jumlah_penjualan) AS total_jumlah_penjualan, SUM(harga_jual) AS total_harga_jual FROM penjualan";
$result_penjualan = $conn->query($query_penjualan);
$data_penjualan = $result_penjualan->fetch_assoc();
$total_jumlah_penjualan = isset($data_penjualan['total_jumlah_penjualan']) ? $data_penjualan['total_jumlah_penjualan'] : 0;
$total_harga_jual = isset($data_penjualan['total_harga_jual']) ? $data_penjualan['total_harga_jual'] : 0;

// Hitung keuntungan/kerugian berdasarkan perkalian jumlah dan harga
$total_pembelian = $total_jumlah_pembelian * $total_harga_beli;
$total_penjualan = $total_jumlah_penjualan * $total_harga_jual;

$keuntungan = $total_penjualan - $total_pembelian;

if ($keuntungan < 0) {
    // Jika hasil negatif, berarti kerugian
    $kerugian = abs($keuntungan);
    $keuntungan = 0;  
} else {
    $kerugian = 0;  // Tidak ada kerugian jika ada keuntungan
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Styling untuk sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 120px;
            background-color: #003C43;
            padding-top: 90px;
        }
        .sidebar-item {
            padding: 10px 20px;
            color: white;
        }
        .sidebar-item:hover {
            background-color: #135D66;
            color: white;
        }
        .content {
            margin-left: 150px; 
            padding: 20px;
            padding-top: 50px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link sidebar-item" href="">Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link sidebar-item" href="barang/indexBarang.php">Barang</a>
        </li>
        <li class="nav-item">
            <a class="nav-link sidebar-item" href="pembelian/indexPembelian.php">Pembelian</a>
        </li>
        <li class="nav-item">
            <a class="nav-link sidebar-item" href="supplier/indexSupplier.php">Supplier</a>
        </li>
        <li class="nav-item">
            <a class="nav-link sidebar-item" href="penjualan/indexPenjualan.php">Penjualan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link sidebar-item" href="pelanggan/indexPelanggan.php">Pelanggan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">LOG OUT</a> <!-- Tautan Logout -->
        </li>
    </ul>
</div>

<!-- Content -->
<div class="content">
    <h1>Welcome to Dashboard</h1>
    <p>Laba Rugi Toko Sembako</p>

    <div class="row">
        <!-- Total Pembelian Table -->
        <div class="col-12 col-md-6 table-responsive mb-3">
            <table class="table table-bordered">
                <thead>
                    <tr><th colspan="2">Total Pembelian</th></tr>
                </thead>
                <tbody>
                    <tr><td>Jumlah Pembelian</td><td><?= number_format($total_jumlah_pembelian) ?></td></tr>
                    <tr><td>Total Harga Beli</td><td><?= number_format($total_harga_beli, 2) ?></td></tr>
                </tbody>
            </table>
        </div>

        <!-- Total Penjualan Table -->
        <div class="col-12 col-md-6 table-responsive mb-3">
            <table class="table table-bordered">
                <thead>
                    <tr><th colspan="2">Total Penjualan</th></tr>
                </thead>
                <tbody>
                    <tr><td>Jumlah Penjualan</td><td><?= number_format($total_jumlah_penjualan) ?></td></tr>
                    <tr><td>Total Harga Jual</td><td><?= number_format($total_harga_jual, 2) ?></td></tr>
                </tbody>
            </table>
        </div>

        <!-- Keuntungan Table -->
        <div class="col-12 col-md-6 table-responsive mb-3">
            <table class="table table-bordered">
                <thead>
                    <tr><th colspan="2">Keuntungan</th></tr>
                </thead>
                <tbody>
                    <tr><td>Keuntungan</td><td><?= number_format($keuntungan, 2) ?></td></tr>
                </tbody>
            </table>
        </div>

        <!-- Kerugian Table -->
        <div class="col-12 col-md-6 table-responsive mb-3">
            <table class="table table-bordered">
                <thead>
                    <tr><th colspan="2">Kerugian</th></tr>
                </thead>
                <tbody>
                    <tr><td>Kerugian</td><td><?= number_format($kerugian, 2) ?></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
