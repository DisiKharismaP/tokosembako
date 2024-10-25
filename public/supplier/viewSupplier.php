<?php
include '../../config/db_connection.php';

if (isset($_GET['id_supplier'])) {
    $id_supplier = $_GET['id_supplier'];
    $query = "SELECT * FROM supplier WHERE id_supplier=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_supplier);
    $stmt->execute();
    $result = $stmt->get_result();
    $supplier = $result->fetch_assoc(); // Menggunakan $supplier untuk data yang diambil
} else {
    $supplier = [
        'nama_supplier' => '',
        'alamat' => '',
        'no_hp' => '',
        'email' => '',
        'harga_satuan' => '',
        'total_harga' => '',
        'id_pembelian' => ''
    ]; // Default values untuk supplier baru
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data Supplier</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="mb-4"><?= isset($_GET['id_supplier']) ? 'Edit' : 'Tambah' ?> Data Supplier</h2>
                <form action="controllerSupplier.php" method="POST">
                    <input type="hidden" name="action" value="<?= isset($_GET['id_supplier']) ? 'update' : 'create' ?>">
                    <?php if (isset($_GET['id_supplier'])): ?>
                        <input type="hidden" name="id_supplier" value="<?= $_GET['id_supplier'] ?>">
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="nama_supplier">Nama Supplier:</label>
                        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="<?= htmlspecialchars($supplier['nama_supplier']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <textarea class="form-control" id="alamat" name="alamat" required><?= htmlspecialchars($supplier['alamat']) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No HP:</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= htmlspecialchars($supplier['no_hp']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($supplier['email']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_satuan">Harga Satuan:</label>
                        <input type="text" class="form-control" id="harga_satuan" name="harga_satuan" value="<?= htmlspecialchars($supplier['harga_satuan']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="total_harga">Total Harga:</label>
                        <input type="text" class="form-control" id="total_harga" name="total_harga" value="<?= htmlspecialchars($supplier['total_harga']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="id_pembelian">ID Pembelian:</label>
                        <input type="number" class="form-control" id="id_pembelian" name="id_pembelian" value="<?= htmlspecialchars($supplier['id_pembelian']) ?>" required>
                    </div>
                    <div class="form-group row justify-content-center">
                        <div class="col-auto">
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
