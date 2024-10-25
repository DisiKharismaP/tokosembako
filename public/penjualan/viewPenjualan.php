<?php
include '../../config/db_connection.php';

if (isset($_GET['id_penjualan'])) {
    $id_penjualan = $_GET['id_penjualan'];
    $query = "SELECT * FROM penjualan WHERE id_penjualan=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_penjualan);
    $stmt->execute();
    $result = $stmt->get_result();
    $penjualan = $result->fetch_assoc(); // Menggunakan $penjualan, bukan $barang
} else {
    $penjualan = ['jumlah_penjualan' => '', 'harga_jual' => '', 'id_pengguna' => '']; // Sesuaikan dengan nama kolom di tabel
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="mb-4"><?= isset($_GET['id_penjualan']) ? 'Edit' : 'Tambah' ?> Data Penjualan</h2>
                <form action="controllerPenjualan.php" method="POST">
                    <input type="hidden" name="action" value="<?= isset($_GET['id_penjualan']) ? 'update' : 'create' ?>">
                    <?php if (isset($_GET['id_penjualan'])): ?>
                        <input type="hidden" name="id_penjualan" value="<?= $_GET['id_penjualan'] ?>">
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="jumlah_penjualan">Jumlah Penjualan:</label>
                        <input type="number" class="form-control" id="jumlah_penjualan" name="jumlah_penjualan" value="<?= htmlspecialchars($penjualan['jumlah_penjualan']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_jual">Harga Jual:</label>
                        <input type="text" class="form-control" id="harga_jual" name="harga_jual" value="<?= htmlspecialchars($penjualan['harga_jual']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="id_pengguna">ID Pengguna:</label>
                        <input type="number" class="form-control" id="id_pengguna" name="id_pengguna" value="<?= htmlspecialchars($penjualan['id_pengguna']) ?>" required>
                    </div>
                    <div class="form-group row justify-content-center">
                        <div class ="col-auto">
                            <a href="javascript:history.back()" class="btn btn-secondary">Back</a>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
