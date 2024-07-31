<?php
include('../koneksi/db.php');

// Periksa apakah pengguna sudah login dan perannya adalah siswa
if (!isset($_SESSION['users_id']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../login.php");
    exit;
}

// Ambil data siswa dari database
$user_id = $_SESSION['users_id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    $user_name = htmlspecialchars($user['username']); // Ganti dengan nama siswa jika ada kolom nama
} else {
    $user_name = "Siswa";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <link rel="icon" href="../../assets/img/icon.png" type="image/png">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        /* CSS untuk break-word */
        .break-word {
            word-break: break-word;
            /* Memecah kata jika terlalu panjang */
            overflow-wrap: break-word;
            /* Memastikan kata panjang dipecah */
        }
    </style>
</head>

<body>
    <h1>Selamat datang, <?php echo $user_name; ?>!</h1>
    <!-- Konten dashboard siswa lainnya -->

    <?php
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM announcements ORDER BY id DESC";
    $result = $conn->query($sql);
    ?>

    <div class="container">
        <br>
        <h3 class="text-center">Pengumuman</h3><br>
        <table>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td class="break-word">
                        <h5><?php echo htmlspecialchars($row['title']); ?></h5>
                        <p>Diposting : <?php echo htmlspecialchars($row['created_at']); ?></p>
                        <h6>Isi Pengumuman: <?php echo htmlspecialchars($row['content']); ?></h6>
                        <hr>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>

</html>