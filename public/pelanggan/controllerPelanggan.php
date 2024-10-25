<?php
include '../../config/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action == 'create') {
            $nama_pelanggan = $_POST['nama_pelanggan'];
            $alamat = $_POST['alamat'];
            $no_hp = $_POST['no_hp'];
            $email = $_POST['email'];
            $quantity = $_POST['quantity'];
            $total_harga = $_POST['total_harga'];
            $id_penjualan = $_POST['id_penjualan'];

            $query = "INSERT INTO pelanggan (nama_pelanggan, alamat, no_hp, email, quantity, total_harga, id_penjualan) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssidi", $nama_pelanggan, $alamat, $no_hp, $email, $quantity, $total_harga, $id_penjualan); // 's' untuk string, 'i' untuk integer, 'd' untuk double
            $stmt->execute();
            header('Location: indexPelanggan.php');
            exit();
        }

        elseif ($action == 'update') {
            $id_pelanggan = $_POST['id_pelanggan'];
            $nama_pelanggan = $_POST['nama_pelanggan'];
            $alamat = $_POST['alamat'];
            $no_hp = $_POST['no_hp'];
            $email = $_POST['email'];
            $quantity = $_POST['quantity'];
            $total_harga = $_POST['total_harga'];
            $id_penjualan = $_POST['id_penjualan'];
            
            $query = "UPDATE pelanggan SET nama_pelanggan=?, alamat=?, no_hp=?, email=?, quantity=?, total_harga=?, id_penjualan=? WHERE id_pelanggan=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssidii", $nama_pelanggan, $alamat, $no_hp, $email, $quantity, $total_harga, $id_penjualan, $id_pelanggan);
            $stmt->execute();
            header('Location: indexPelanggan.php');
            exit();
        }

        elseif ($action == 'delete') {
            $id_pelanggan = $_POST['id_pelanggan'];

            $query = "DELETE FROM pelanggan WHERE id_pelanggan=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id_pelanggan);
            $stmt->execute();
            header('Location: indexPelanggan.php');
            exit();
        }
    }
}

function getPelanggan($conn) {
    $query = "SELECT * FROM pelanggan";
    $result = $conn->query($query);

    $pelanggan_list = array();
    while ($row = $result->fetch_assoc()) {
        $pelanggan_list[] = $row;
    }
    return $pelanggan_list;
}
?>
