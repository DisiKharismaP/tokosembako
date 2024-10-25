<?php
include 'controllerPenjualan.php';
session_start(); // Pastikan session dimulai untuk memeriksa akses pengguna
$penjualan_list = getPenjualan($conn); // Panggil fungsi untuk mendapatkan data penjualan
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Sidebar and Content Styling */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 120px;
            background-color: #003C43;
            padding-top: 90px;
        }
        .sidebar-item { padding: 10px 20px; color: white; }
        .sidebar-item:hover { background-color: #135D66; color: white; }
        .content { margin-left: 150px; padding: 20px; padding-top: 50px; }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link sidebar-item" href="../dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-item" href="../barang/indexBarang.php">Barang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-item" href="../pembelian/indexPembelian.php">Pembelian</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-item" href="../supplier/indexSupplier.php">Supplier</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-item" href="">Penjualan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-item" href="../pelanggan/indexPelanggan.php">Pelanggan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">LOG OUT</a> <!-- Tautan Logout -->
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        <h1>Data Penjualan</h1>
        <div class="container-fluid">
            <?php if ($_SESSION['id_akses'] == 1): ?> <!-- Hanya tampilkan tombol Add jika id_akses = 1 -->
            <div class="row mb-2 float-right">
                <div class="col-auto">
                    <button type="button" class="btn btn-success" onclick="addNewPenjualan()">Add Penjualan</button>
                </div>
            </div>
            <?php endif; ?>
            <div>
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id No.</th>
                            <th>Jumlah Penjualan</th>
                            <th>Harga Jual</th>
                            <th>Id Pengguna</th>
                            <?php if ($_SESSION['id_akses'] == 1): ?> <!-- Tampilkan kolom Aksi jika id_akses = 1 -->
                            <th>Aksi</th> 
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($penjualan_list as $penjualan): ?>
                        <tr>
                            <td><?= $penjualan['id_penjualan'] ?></td>
                            <td><?= $penjualan['jumlah_penjualan'] ?></td>
                            <td><?= $penjualan['harga_jual'] ?></td>
                            <td><?= $penjualan['id_pengguna'] ?></td>
                            <?php if ($_SESSION['id_akses'] == 1): ?> <!-- Hanya tampilkan tombol Edit/Delete jika id_akses = 1 -->
                            <td>
                                <form action="controllerPenjualan.php" method="POST" style="display:inline-block;">
                                    <input type="hidden" name="id_penjualan" value="<?= $penjualan['id_penjualan'] ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a href="viewPenjualan.php?id_penjualan=<?= $penjualan['id_penjualan'] ?>" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add New Item Button Script -->
        <script>
            function addNewPenjualan() {
                window.location.href = "viewPenjualan.php";
            }
        </script>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
