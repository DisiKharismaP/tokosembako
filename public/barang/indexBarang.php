<?php
include 'controllerBarang.php';
session_start();
$barang_list = getBarang($conn); // Panggil fungsi untuk mendapatkan data barang
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barang</title>
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
                <a class="nav-link sidebar-item" href="">Barang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-item" href="../pembelian/indexPembelian.php">Pembelian</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-item" href="../supplier/indexSupplier.php">Supplier</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-item" href="../penjualan/indexPenjualan.php">Penjualan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-item" href="../pelanggan/indexPelanggan.php">Pelanggan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">LOG OUT</a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        <h1> Data Barang </h1>
        <div class="container-fluid">
            <div class="row mb-2 float-right">
                <div class="col-auto">
                    <?php if ($_SESSION['id_akses'] == 1): ?> <!-- Hanya tampil jika id_akses = 1 -->
                        <button type="button" class="btn btn-success" onclick="addNewItem()">Add Barang</button>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id No.</th>
                            <th>Nama Barang</th>
                            <th>Harga Satuan</th>
                            <?php if ($_SESSION['id_akses'] == 1): ?> <!-- Tambah kolom Aksi jika id_akses = 1 -->
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($barang_list as $barang): ?>
                        <tr>
                            <td><?= $barang['id_barang'] ?></td>
                            <td><?= $barang['nama_barang'] ?></td>
                            <td><?= $barang['harga_satuan'] ?></td>
                            <?php if ($_SESSION['id_akses'] == 1): ?> <!-- Tombol Edit dan Delete hanya untuk id_akses = 1 -->
                            <td>
                                <form action="controllerBarang.php" method="POST" style="display:inline-block;">
                                    <input type="hidden" name="id_barang" value="<?= $barang['id_barang'] ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a href="viewBarang.php?id_barang=<?= $barang['id_barang'] ?>" class="btn btn-primary btn-sm">Edit</a>
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
            function addNewItem() {
                window.location.href = "viewBarang.php";
            }
        </script>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>