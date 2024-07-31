<?php
// Memeriksa status sesi sebelum memulai sesi baru
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Memeriksa status login pengguna
if (!isset($_SESSION['users_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../../login.php");
    exit;
}

include(__DIR__ . '/../../koneksi/db.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ambil siswa_id dari URL
$siswa_id = $_GET['id'];

// Query untuk mendapatkan berkas siswa berdasarkan siswa_id
$sql = "SELECT * FROM berkas WHERE siswa_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $siswa_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Query failed: " . $conn->error);
}

// Ambil data siswa untuk informasi tambahan
$sql_siswa = "SELECT nama FROM siswa WHERE id = ?";
$stmt_siswa = $conn->prepare($sql_siswa);
$stmt_siswa->bind_param("i", $siswa_id);
$stmt_siswa->execute();
$result_siswa = $stmt_siswa->get_result();

if ($result_siswa->num_rows == 1) {
    $row_siswa = $result_siswa->fetch_assoc();
    $nama_siswa = $row_siswa['nama'];
} else {
    die("Data siswa tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Berkas Siswa</title>
    <link rel="icon" href="../../assets/img/icon.png" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="content">
            <h2 class="mb-4">Berkas Siswa: <?= htmlspecialchars($nama_siswa) ?></h2>
            <a href="index.php?page=data_siswa" class="btn btn-secondary mb-3"><i class="fa-solid fa-arrow-rotate-left"></i> Kembali ke Daftar Siswa</a>
            <hr>
            <?php if ($result->num_rows > 0) : ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-centered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Nama Berkas</th>
                                <th scope="col">File</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) : ?>
                                <tr>
                                    <td>Ijazah</td>
                                    <td><a href="<?= htmlspecialchars($row['ijazah']) ?>" target="_blank" class="btn btn-warning"><i class="fa-solid fa-eye"></i> Lihat</a></td>
                                </tr>
                                <tr>
                                    <td>SKHUN</td>
                                    <td><a href="<?= htmlspecialchars($row['skhun']) ?>" target="_blank" class="btn btn-warning"><i class="fa-solid fa-eye"></i> Lihat</a></td>
                                </tr>
                                <tr>
                                    <td>KK</td>
                                    <td><a href="<?= htmlspecialchars($row['kk']) ?>" target="_blank" class="btn btn-warning"><i class="fa-solid fa-eye"></i> Lihat</a></td>
                                </tr>
                                <tr>
                                    <td>KTP Ayah</td>
                                    <td><a href="<?= htmlspecialchars($row['ktp_ayah']) ?>" target="_blank" class="btn btn-warning"><i class="fa-solid fa-eye"></i> Lihat</a></td>
                                </tr>
                                <tr>
                                    <td>KTP Ibu</td>
                                    <td><a href="<?= htmlspecialchars($row['ktp_ibu']) ?>" target="_blank" class="btn btn-warning"><i class="fa-solid fa-eye"></i> Lihat</a></td>
                                </tr>
                                <tr>
                                    <td>KBS</td>
                                    <td><a href="<?= htmlspecialchars($row['kbs']) ?>" target="_blank" class="btn btn-warning"><i class="fa-solid fa-eye"></i> Lihat</a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>
                <p class="mt-3">Tidak ada berkas yang diunggah untuk siswa ini.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>

</html>

<?php
$stmt->close();
$stmt_siswa->close();
$conn->close();
?>