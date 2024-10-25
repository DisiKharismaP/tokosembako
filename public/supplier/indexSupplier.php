<?php
include 'controllerSupplier.php';
$supplier_list = getSupplier($conn);  // Panggil fungsi untuk mendapatkan data supplier
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier</title>
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
                <a class="nav-link sidebar-item" href="">Supplier</a>
            </li>
            <li class="nav-item">
                <a class="nav-link sidebar-item" href="../penjualan/indexPenjualan.php">Penjualan</a>
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
        <h1> Data Supplier </h1>
        <div class="container-fluid">
            <div class="row mb-2 float-right">
                <div class="col-auto">
                    <button type="button" class="btn btn-success" onclick="addNewSupplier()">Add Supplier</button>
                </div>
            </div>
            <div>
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id No.</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Email</th>
                            <th>Harga Satuan</th>
                            <th>Total Harga</th>
                            <th>Id Pembelian</th>
                            <th>Aksi</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($supplier_list as $supplier): ?>
                        <tr>
                            <td><?= $supplier['id_supplier'] ?></td>
                            <td><?= $supplier['nama_supplier'] ?></td>
                            <td><?= $supplier['alamat'] ?></td>
                            <td><?= $supplier['no_hp'] ?></td>
                            <td><?= $supplier['email'] ?></td>
                            <td><?= $supplier['harga_satuan'] ?></td>
                            <td><?= $supplier['total_harga'] ?></td>
                            <td><?= $supplier['id_pembelian'] ?></td>
                            <td>
                                <form action="../controller/controllerSupplier.php" method="POST" style="display:inline-block;">
                                    <input type="hidden" name="id_supplier" value="<?= $supplier['id_supplier'] ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                <a href="viewSupplier.php?id_supplier=<?= $supplier['id_supplier'] ?>" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add New Item Button Script -->
        <script>
            function addNewSupplier() {
                window.location.href = "viewSupplier.php";
            }
        </script>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>