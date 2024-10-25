<?php
include '../../config/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // CREATE Supplier
        if ($action == 'create') {
            $nama_supplier = $_POST['nama_supplier'];
            $alamat = $_POST['alamat'];
            $no_hp = $_POST['no_hp'];
            $email = $_POST['email'];
            $harga_satuan = $_POST['harga_satuan'];
            $total_harga = $_POST['total_harga'];
            $id_pembelian = $_POST['id_pembelian'];

            $query = "INSERT INTO supplier (nama_supplier, alamat, no_hp, email, harga_satuan, total_harga, id_pembelian) 
                      VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssddi", $nama_supplier, $alamat, $no_hp, $email, $harga_satuan, $total_harga, $id_pembelian);
            $stmt->execute();
            header('Location: indexSupplier.php');
            exit();
        }

        // UPDATE Supplier
        elseif ($action == 'update') {
            $id_supplier = $_POST['id_supplier'];
            $nama_supplier = $_POST['nama_supplier'];
            $alamat = $_POST['alamat'];
            $no_hp = $_POST['no_hp'];
            $email = $_POST['email'];
            $harga_satuan = $_POST['harga_satuan'];
            $total_harga = $_POST['total_harga'];
            $id_pembelian = $_POST['id_pembelian'];

            $query = "UPDATE supplier 
                      SET nama_supplier=?, alamat=?, no_hp=?, email=?, harga_satuan=?, total_harga=?, id_pembelian=? 
                      WHERE id_supplier=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssddii", $nama_supplier, $alamat, $no_hp, $email, $harga_satuan, $total_harga, $id_pembelian, $id_supplier);
            $stmt->execute();
            header('Location: indexSupplier.php');
            exit();
        }

        // DELETE Supplier
        elseif ($action == 'delete') {
            $id_supplier = $_POST['id_supplier'];

            $query = "DELETE FROM supplier WHERE id_supplier=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $id_supplier);
            $stmt->execute();
            header('Location: indexSupplier.php');
            exit();
        }
    }
}

// Function to get all suppliers
function getSupplier($conn) {
    $query = "SELECT * FROM supplier";
    $result = $conn->query($query);

    $supplier_list = array();
    while ($row = $result->fetch_assoc()) {
        $supplier_list[] = $row;
    }
    return $supplier_list;
}
?>
