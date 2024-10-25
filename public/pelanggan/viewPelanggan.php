<?php
include '../../config/db_connection.php';

if (isset($_GET['id_pelanggan'])) {
    $id_pelanggan = $_GET['id_pelanggan'];
    $query = "SELECT * FROM pelanggan WHERE id_pelanggan=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_pelanggan);
    $stmt->execute();
    $result = $stmt->get_result();
    $pelanggan = $result->fetch_assoc();
} else {
    $pelanggan = [
        'nama_pelanggan' => '',
        'alamat' => '',
        'no_hp' => '',
        'email' => '',
        'quantity' => '',
        'total_harga' => '',
        'id_penjualan' => ''
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data Pelanggan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="mb-4"><?= isset($_GET['id_pelanggan']) ? 'Edit' : 'Tambah' ?> Data Pelanggan</h2>
                <form action="controllerPelanggan.php" method="POST">
                    <input type="hidden" name="action" value="<?= isset($_GET['id_pelanggan']) ? 'update' : 'create' ?>">
                    <?php if (isset($_GET['id_pelanggan'])): ?>
                        <input type="hidden" name="id_pelanggan" value="<?= $_GET['id_pelanggan'] ?>">
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="nama_pelanggan">Nama Pelanggan:</label>
                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?= htmlspecialchars($pelanggan['nama_pelanggan']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat:</label>
                        <textarea class="form-control" id="alamat" name="alamat" required><?= htmlspecialchars($pelanggan['alamat']) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No HP:</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= htmlspecialchars($pelanggan['no_hp']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($pelanggan['email']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="<?= htmlspecialchars($pelanggan['quantity']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="total_harga">Total Harga:</label>
                        <input type="text" class="form-control" id="total_harga" name="total_harga" value="<?= htmlspecialchars($pelanggan['total_harga']) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="id_penjualan">Id Penjualan:</label>
                        <input type="number" class="form-control" id="id_penjualan" name="id_penjualan" value="<?= htmlspecialchars($pelanggan['id_penjualan']) ?>" required>
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
