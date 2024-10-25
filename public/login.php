<?php
session_start();
include '../config/db_connection.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil username dan password dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mendapatkan data pengguna berdasarkan username
    $query = "SELECT * FROM pengguna WHERE username=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek jika pengguna ditemukan
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if ($user['password'] === $password) { // Cek password tanpa hashing
            // Jika password cocok, simpan data pengguna ke dalam sesi
            $_SESSION['username'] = $user['username'];
            $_SESSION['id_pengguna'] = $user['id_pengguna'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            $_SESSION['id_akses'] = $user['id_akses'];

            header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "Password salah.";
        }
    } else {
        $error_message = "Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<style>
    body {
        background-color: #003C43; 
    }
</style>
<body>
    <section class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto rounded shadow bg-white">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="m-5 text-center">
                                <h1>Toko Sembako</h1>
                                <p>Login untuk masuk ke sistem manajemen.</p>
                            </div>
                            <form class="m-5" method="post" action="">
                                <div class="mb-3">
                                    <label class="form-label" for="username">Username</label>
                                    <input class="form-control" type="text" id="username" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="password">Password</label>
                                    <input class="form-control" type="password" id="password" name="password" required>
                                </div>
                                <div class="row mb-3">
                                    <div>
                                        <button type="submit" class="form-control btn btn-dark mt-4"> Submit </button>
                                    </div>
                                </div>
                                <?php if (isset($error_message)): ?>
                                    <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
                                <?php endif; ?>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <img src="../assets/login.png" alt="Login Logo" class="img-fluid p-5"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
