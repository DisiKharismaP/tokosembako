<?php
include '../../config/db_connection.php';

// Jika ada parameter id_barang, artinya sedang mengedit
if (isset($_GET['id_barang'])) {
    $id_barang = $_GET['id_barang'];
    $query = "SELECT * FROM barang WHERE id_barang=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_barang);
    $stmt->execute();
    $result = $stmt->get_result();
    $barang = $result->fetch_assoc();
} else {
    // Jika tidak ada id_barang, artinya tambah data baru
    $barang = ['nama_barang' => '', 'harga_satuan' => ''];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="mb-4"><?= isset($_GET['id_barang']) ? 'Edit' : 'Tambah' ?> Data Barang</h2>
                <form action="controllerBarang.php" method="POST">
                    <input type="hidden" name="action" value="<?= isset($_GET['id_barang']) ? 'update' : 'create' ?>">
                    <?php if (isset($_GET['id_barang'])): ?>
                        <input type="hidden" name="id_barang" value="<?= $_GET['id_barang'] ?>">
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="nama_barang">Nama Barang:</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $barang['nama_barang'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="harga_satuan">Harga Satuan:</label>
                        <input type="text" class="form-control" id="harga_satuan" name="harga_satuan" value="<?= $barang['harga_satuan'] ?>" required>
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
