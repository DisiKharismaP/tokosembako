<?php
include '../../config/db_connection.php';

if (isset($_GET['id_pembelian'])) {
    $id_pembelian = $_GET['id_pembelian'];
    $query = "SELECT * FROM pembelian WHERE id_pembelian=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_pembelian);
    $stmt->execute();
    $result = $stmt->get_result();
    $pembelian = $result->fetch_assoc(); // Menggunakan $pembelian, bukan $barang
} else {
    $pembelian = ['jumlah_pembelian' => '', 'harga_beli' => '']; // Sesuaikan dengan nama kolom di tabel
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data Pembelian</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="mb-4"><?= isset($_GET['id_pembelian']) ? 'Edit' : 'Tambah' ?> Data Pembelian</h2>
                <form action="controllerPembelian.php" method="POST">
                    <input type="hidden" name="action" value="<?= isset($_GET['id_pembelian']) ? 'update' : 'create' ?>">
                    <?php if (isset($_GET['id_pembelian'])): ?>
                        <input type="hidden" name="id_pembelian" value="<?= $_GET['id_pembelian'] ?>">
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="jumlah_pembelian">Jumlah Pembelian:</label>
                        <input type="number" class="form-control" id="jumlah_pembelian" name="jumlah_pembelian" value="<?= htmlspecialchars($pembelian['jumlah_pembelian']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_beli">Harga Pembelian:</label>
                        <input type="text" class="form-control" id="harga_beli" name="harga_beli" value="<?= htmlspecialchars($pembelian['harga_beli']) ?>" required>
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
