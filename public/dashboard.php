<!-- DASHBOARD HOME FOR SHOWING KEUNTUNGAN TOKO (HTML, PHP, QUERY)-->
<?php 
session_start(); // Start the session


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/style_menu_page.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="">Dashboard</a></li>
                <li><a href="pembelian/pembelian.php">Pembelian</a></li>
                <li><a href="penjualan/penjualan.php">Penjualan</a></li>
            </ul>
        </nav>

        <main class="content">
            <h1>Dashboard</h1>
            <p>This is the Dashboard page.</p>
        </main>
    </div>
</body>
</html>
