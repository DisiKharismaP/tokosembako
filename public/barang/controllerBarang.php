<?php
include '../../config/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Tambah barang (CREATE)
        if ($action == 'create') {
            $nama_barang = $_POST['nama_barang'];
            $harga_satuan = $_POST['harga_satuan'];

            $query = "INSERT INTO barang (nama_barang, harga_satuan) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sd", $nama_barang, $harga_satuan); // 's' untuk string, 'd' untuk double (decimal)
            $stmt->execute();
            header('Location: indexBarang.php');
            exit();
        }

        // Update barang (UPDATE)
        elseif ($action == 'update') {
            $id_barang = $_POST['id_barang'];
            $nama_barang = $_POST['nama_barang'];
            $harga_satuan = $_POST['harga_satuan'];

            $query = "UPDATE barang SET nama_barang=?, harga_satuan=? WHERE id_barang=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sdi", $nama_barang, $harga_satuan, $id_barang);
            $stmt->execute();
            header('Location: indexBarang.php');
            exit();
        }

        // Hapus barang (DELETE)
        elseif ($action == 'delete') {
            $id_barang = $_POST['id_barang'];

            $query = "DELETE FROM barang WHERE id_barang=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id_barang);
            $stmt->execute();
            header('Location: indexBarang.php');
            exit();
        }
    }
}

// Ambil data barang (READ)
function getBarang($conn) {
    $query = "SELECT * FROM barang";
    $result = $conn->query($query);

    $barang_list = array();
    while ($row = $result->fetch_assoc()) {
        $barang_list[] = $row;
    }
    return $barang_list;
}
?>
