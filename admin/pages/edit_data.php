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

// Ambil siswa_id dari URL dan lakukan validasi
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID siswa tidak ditemukan.");
}
$siswa_id = $_GET['id'];

// Query untuk mendapatkan data orang tua dan siswa berdasarkan siswa_id
$sql = "SELECT o.id AS orang_tua_id, o.nama_ayah, o.alamat_ayah, o.telepon_ayah, o.pekerjaan_ayah, o.nama_ibu, o.alamat_ibu, o.telepon_ibu, o.pekerjaan_ibu, 
        s.id AS siswa_id, s.nama AS nama_siswa, s.nomor_induk, s.nisn, s.tempat_lahir, s.tanggal_lahir, s.jenis_kelamin, s.agama, 
        s.status_dalam_keluarga, s.anak_ke, s.alamat, s.telepon_hp, s.sekolah_asal
        FROM orang_tua o
        JOIN siswa s ON o.siswa_id = s.id
        WHERE o.siswa_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $siswa_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
} else {
    die("Data siswa atau orang tua tidak ditemukan.");
}

// Proses update data jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_siswa = $_POST['nama_siswa'];
    $nomor_induk = $_POST['nomor_induk'];
    $nisn = $_POST['nisn'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $status_dalam_keluarga = $_POST['status_dalam_keluarga'];
    $anak_ke = $_POST['anak_ke'];
    $alamat = $_POST['alamat'];
    $telepon_hp = $_POST['telepon_hp'];
    $sekolah_asal = $_POST['sekolah_asal'];

    $nama_ayah = $_POST['nama_ayah'];
    $alamat_ayah = $_POST['alamat_ayah'];
    $telepon_ayah = $_POST['telepon_ayah'];
    $pekerjaan_ayah = $_POST['pekerjaan_ayah'];

    $nama_ibu = $_POST['nama_ibu'];
    $alamat_ibu = $_POST['alamat_ibu'];
    $telepon_ibu = $_POST['telepon_ibu'];
    $pekerjaan_ibu = $_POST['pekerjaan_ibu'];

    // Update data siswa
    $sql_siswa = "UPDATE siswa SET nama=?, nomor_induk=?, nisn=?, tempat_lahir=?, tanggal_lahir=?, jenis_kelamin=?, agama=?, status_dalam_keluarga=?, anak_ke=?, alamat=?, telepon_hp=?, sekolah_asal=? WHERE id=?";
    $stmt_siswa = $conn->prepare($sql_siswa);
    $stmt_siswa->bind_param("ssssssssssssi", $nama_siswa, $nomor_induk, $nisn, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $agama, $status_dalam_keluarga, $anak_ke, $alamat, $telepon_hp, $sekolah_asal, $siswa_id);
    $stmt_siswa->execute();

    // Update data orang tua
    $sql_orang_tua = "UPDATE orang_tua SET nama_ayah=?, alamat_ayah=?, telepon_ayah=?, pekerjaan_ayah=?, nama_ibu=?, alamat_ibu=?, telepon_ibu=?, pekerjaan_ibu=? WHERE id=?";
    $stmt_orang_tua = $conn->prepare($sql_orang_tua);
    $stmt_orang_tua->bind_param("ssssssssi", $nama_ayah, $alamat_ayah, $telepon_ayah, $pekerjaan_ayah, $nama_ibu, $alamat_ibu, $telepon_ibu, $pekerjaan_ibu, $row['orang_tua_id']);
    $stmt_orang_tua->execute();

    // Redirect setelah update
    header("Location: index.php?page=detail_siswa&id=" . $siswa_id);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
    <link rel="icon" href="../../assets/img/icon.png" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="content">
            <h2 class="mb-4">Edit Data Siswa: <?= htmlspecialchars($row['nama_siswa']) ?></h2>
            <hr>
            <form method="POST">
                <div class="mb-4">
                    <a href="index.php?page=detail_siswa&id=<?= $siswa_id ?>" class="btn btn-secondary"><i class="fa-solid fa-arrow-rotate-left"></i> Kembali ke Detail Siswa</a>
                </div>
                <h3>Data Siswa</h3>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_siswa" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?= htmlspecialchars($row['nama_siswa']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nomor_induk" class="form-label">Nomor Induk</label>
                        <input type="text" class="form-control" id="nomor_induk" name="nomor_induk" value="<?= htmlspecialchars($row['nomor_induk']) ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nisn" class="form-label">NISN</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" value="<?= htmlspecialchars($row['nisn']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= htmlspecialchars($row['tempat_lahir']) ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= htmlspecialchars($row['tanggal_lahir']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="Laki-laki" <?= $row['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= $row['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="agama" class="form-label">Agama</label>
                        <input type="text" class="form-control" id="agama" name="agama" value="<?= htmlspecialchars($row['agama']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status_dalam_keluarga" class="form-label">Status Dalam Keluarga</label>
                        <input type="text" class="form-control" id="status_dalam_keluarga" name="status_dalam_keluarga" value="<?= htmlspecialchars($row['status_dalam_keluarga']) ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="anak_ke" class="form-label">Anak ke</label>
                        <input type="number" class="form-control" id="anak_ke" name="anak_ke" value="<?= htmlspecialchars($row['anak_ke']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= htmlspecialchars($row['alamat']) ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="telepon_hp" class="form-label">Telepon/Hp</label>
                        <input type="text" class="form-control" id="telepon_hp" name="telepon_hp" value="<?= htmlspecialchars($row['telepon_hp']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sekolah_asal" class="form-label">Sekolah Asal</label>
                        <input type="text" class="form-control" id="sekolah_asal" name="sekolah_asal" value="<?= htmlspecialchars($row['sekolah_asal']) ?>" required>
                    </div>
                </div>

                <h3>Data Orang Tua</h3>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_ayah" class="form-label">Nama Ayah</label>
                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="<?= htmlspecialchars($row['nama_ayah']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="alamat_ayah" class="form-label">Alamat Ayah</label>
                        <input type="text" class="form-control" id="alamat_ayah" name="alamat_ayah" value="<?= htmlspecialchars($row['alamat_ayah']) ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="telepon_ayah" class="form-label">Telepon Ayah</label>
                        <input type="text" class="form-control" id="telepon_ayah" name="telepon_ayah" value="<?= htmlspecialchars($row['telepon_ayah']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                        <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" value="<?= htmlspecialchars($row['pekerjaan_ayah']) ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_ibu" class="form-label">Nama Ibu</label>
                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="<?= htmlspecialchars($row['nama_ibu']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="alamat_ibu" class="form-label">Alamat Ibu</label>
                        <input type="text" class="form-control" id="alamat_ibu" name="alamat_ibu" value="<?= htmlspecialchars($row['alamat_ibu']) ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="telepon_ibu" class="form-label">Telepon Ibu</label>
                        <input type="text" class="form-control" id="telepon_ibu" name="telepon_ibu" value="<?= htmlspecialchars($row['telepon_ibu']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                        <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" value="<?= htmlspecialchars($row['pekerjaan_ibu']) ?>" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="index.php?page=detail_siswa&id=<?= $siswa_id ?>" class="btn btn-secondary">Batal</a>
            </form>
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