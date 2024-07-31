<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Periksa apakah pengguna sudah login dan apakah perannya adalah admin
if (!isset($_SESSION['users_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../../styles.css">
    <link rel="icon" href="../../assets/img/icon.png" type="image/png">
</head>

<body>
    <div class="container">
        <h1>Selamat datang Admin</h1>
        <!-- Konten dashboard lainnya -->
    </div>
</body>

</html>