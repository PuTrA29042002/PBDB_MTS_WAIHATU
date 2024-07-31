<?php
// input_announcement.php
include('../koneksi/db.php'); // Pastikan koneksi database di-include

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Menggunakan prepared statement untuk menghindari SQL injection
    $stmt = $conn->prepare("INSERT INTO announcements (title, content) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $content);

    if ($stmt->execute()) {
        // Redirect ke halaman pengumuman setelah berhasil menambah pengumuman
        header("Location: index.php?page=pengumuman");
        exit();
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengumuman</title>
    <link rel="icon" href="../../assets/img/icon.png" type="image/png">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .form-label {
            font-size: 1.25rem;
            /* Sesuaikan sesuai ukuran yang diinginkan */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="h3 mb-5 text-center text-black-800">Tambah Pengumuman</h1>
        <a href="index.php?page=pengumuman" class="btn btn-secondary mb-4"><i class="fa-solid fa-arrow-rotate-left"></i> Kembai ke Daftar Pengumuman</a>
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Judul Pengumuman</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Judul Pengumuman" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Isi Pengumuman</label>
                <textarea class="form-control" id="content" name="content" rows="5" placeholder="Isi Pengumuman" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Tambah Pengumuman</button>
        </form>
    </div>
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>