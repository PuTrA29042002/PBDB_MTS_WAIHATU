<?php
include('../koneksi/db.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['users_id']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../../login.php");
    exit;
}

// Tampilkan pesan jika ada
if (isset($_SESSION['upload_message'])) {
    $message = $_SESSION['upload_message'];
    unset($_SESSION['upload_message']);
} else {
    $message = '';
}

$user_id = $_SESSION['users_id'];

// Prepare the statement
$stmt = $conn->prepare("SELECT b.id, s.nama AS siswa_nama, b.ijazah, b.skhun, b.kk, b.ktp_ayah, b.ktp_ibu, b.kbs
                        FROM berkas b
                        INNER JOIN siswa s ON b.siswa_id = s.id
                        WHERE s.users_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Berkas</title>
    <link rel="icon" href="../../assets/img/icon.png" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <h3 class="mb-4">Data Berkas</h3>
        <a href="index.php?page=form_data_berkas" class="btn btn-primary mb-3"><i class="fa-solid fa-square-plus"></i> Upload Berkas</a>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Ijazah</th>
                        <th>SKHUN</th>
                        <th>Kartu Keluarga</th>
                        <th>KTP Ayah</th>
                        <th>KTP Ibu</th>
                        <th>Kartu Bantuan Sosial</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0) : ?>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><a href="<?= htmlspecialchars($row['ijazah']) ?>" target="_blank" class="btn btn-link">Lihat</a></td>
                                <td><a href="<?= htmlspecialchars($row['skhun']) ?>" target="_blank" class="btn btn-link">Lihat</a></td>
                                <td><a href="<?= htmlspecialchars($row['kk']) ?>" target="_blank" class="btn btn-link">Lihat</a></td>
                                <td><a href="<?= htmlspecialchars($row['ktp_ayah']) ?>" target="_blank" class="btn btn-link">Lihat</a></td>
                                <td><a href="<?= htmlspecialchars($row['ktp_ibu']) ?>" target="_blank" class="btn btn-link">Lihat</a></td>
                                <td><a href="<?= htmlspecialchars($row['kbs']) ?>" target="_blank" class="btn btn-link">Lihat</a></td>
                                <td>
                                    <a href="index.php?page=edit_berkas&id=<?= htmlspecialchars($row['id']) ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    <form action="index.php?page=hapus_berkas" method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus berkas ini?')"><i class="fa-solid fa-trash-can"></i> Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data berkas yang diupload.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <?php if ($message) : ?>
                <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="messageModalLabel">Informasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><?php echo htmlspecialchars($message); ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    var messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
                    messageModal.show();
                </script>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>

</html>

<?php
$stmt->close();
$conn->close();
?>