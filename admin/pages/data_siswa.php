<?php
$search = "";

// Jika ada pencarian yang dilakukan
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT siswa.id, siswa.nama, siswa.nisn, users.username
            FROM siswa
            JOIN users ON siswa.users_id = users.id
            WHERE siswa.nama LIKE ? OR siswa.nisn LIKE ? OR users.username LIKE ?";
    $stmt = $conn->prepare($sql);
    $search_param = "%{$search}%";
    $stmt->bind_param("sss", $search_param, $search_param, $search_param);
} else {
    $sql = "SELECT siswa.id, siswa.nama, siswa.nisn, users.username
            FROM siswa
            JOIN users ON siswa.users_id = users.id";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <link rel="icon" href="../../assets/img/icon.png" type="image/png">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container mt-3">
        <h1 class="h3 mb-5 text-center text-black-800">Daftar Siswa</h1>
        <div class="row justify-content-end">
            <div class="col-md-4">
                <form class="d-flex" method="GET" action="index.php?page=data_siswa">
                    <input type="hidden" name="page" value="data_siswa">
                    <input type="text" class="form-control me-2" name="search" placeholder="Pencarian..." value="<?= htmlspecialchars($search) ?>">
                    <button class="btn btn-outline-primary" type="submit">Cari</button>
                </form>
            </div>
        </div>
        <br>
        <table class="table table-striped table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>NISN</th>
                    <th>Detail Lengkap</th>
                    <th>Berkas Di-upload</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['nisn']) ?></td>
                            <td>
                                <a href="index.php?page=detail_siswa&id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-success btn-sm"><i class="fa-solid fa-eye"></i> Detail</a>
                            </td>
                            <td>
                                <a href="index.php?page=lihat_berkas&id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-eye"></i> Lihat Berkas</a>
                            </td>
                            <td>
                                <a href="index.php?page=delete_siswa&id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')"><i class="fa-solid fa-trash-can"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data siswa yang ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>