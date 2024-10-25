<?php
include '../../config/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // CREATE penjualan
        if ($action == 'create') {
            $jumlah_penjualan = $_POST['jumlah_penjualan'];
            $harga_jual = $_POST['harga_jual'];
            $id_pengguna = $_POST['id_pengguna'];

            $query = "INSERT INTO penjualan (jumlah_penjualan, harga_jual, id_pengguna) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("idi", $jumlah_penjualan, $harga_jual, $id_pengguna); // 'i' untuk int, 'd' untuk decimal
            $stmt->execute();
            header('Location: indexPenjualan.php');
            exit();
        }

        // UPDATE penjualan
        elseif ($action == 'update') {
            $id_penjualan = $_POST['id_penjualan'];
            $jumlah_penjualan = $_POST['jumlah_penjualan'];
            $harga_jual = $_POST['harga_jual'];
            $id_pengguna = $_POST['id_pengguna'];

            $query = "UPDATE penjualan SET jumlah_penjualan=?, harga_jual=?, id_pengguna=? WHERE id_penjualan=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("idii", $jumlah_penjualan, $harga_jual, $id_pengguna, $id_penjualan);
            $stmt->execute();
            header('Location: indexPenjualan.php');
            exit();
        }

        // DELETE penjualan
        elseif ($action == 'delete') {
            $id_penjualan = $_POST['id_penjualan'];

            $query = "DELETE FROM penjualan WHERE id_penjualan=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id_penjualan);
            $stmt->execute();
            header('Location: indexPenjualan.php');
            exit();
        }
    }
}

// Function to fetch all penjualan data
function getPenjualan($conn) {
    $query = "SELECT * FROM penjualan";
    $result = $conn->query($query);

    $penjualan_list = array();
    while ($row = $result->fetch_assoc()) {
        $penjualan_list[] = $row;
    }
    return $penjualan_list;
}
?>
