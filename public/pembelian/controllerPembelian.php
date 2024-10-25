<?php
include '../../config/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action == 'create') {
            $jumlah_pembelian = $_POST['jumlah_pembelian'];
            $harga_beli = $_POST['harga_beli'];

            $query = "INSERT INTO pembelian (jumlah_pembelian, harga_beli) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("id", $jumlah_pembelian, $harga_beli); // 's' untuk string, 'd' untuk double (decimal)
            $stmt->execute();
            header('Location: indexPembelian.php');
            exit();
        }

        elseif ($action == 'update') {
            $id_pembelian = $_POST['id_pembelian'];
            $jumlah_pembelian = $_POST['jumlah_pembelian'];
            $harga_beli = $_POST['harga_beli'];
            
            $query = "UPDATE pembelian SET jumlah_pembelian=?, harga_beli=? WHERE id_pembelian=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("idi", $jumlah_pembelian, $harga_beli, $id_pembelian);
            $stmt->execute();
            header('Location: indexPembelian.php');
            exit();
        }

        elseif ($action == 'delete') {
            $id_pembelian = $_POST['id_pembelian'];

            $query = "DELETE FROM pembelian WHERE id_pembelian=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id_pembelian);
            $stmt->execute();
            header('Location: indexPembelian.php');
            exit();
        }
    }
}

function getPembelian($conn) {
    $query = "SELECT * FROM pembelian";
    $result = $conn->query($query);

    $pembelian_list = array();
    while ($row = $result->fetch_assoc()) {
        $pembelian_list[] = $row;
    }
    return $pembelian_list;
}
?>
