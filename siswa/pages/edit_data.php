<?php
include('../koneksi/db.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['users_id']) || $_SESSION['role'] != 'siswa') {
    header("Location: ../../login.php");
    exit;
}
$user_id = $_SESSION['users_id'];

$sql = "SELECT s.id AS siswa_id, s.nama AS siswa_nama, s.nomor_induk AS siswa_nomor_induk, s.nisn AS siswa_nisn, s.tempat_lahir AS siswa_tempat_lahir, s.tanggal_lahir AS siswa_tanggal_lahir, s.jenis_kelamin AS siswa_jenis_kelamin, s.agama AS siswa_agama, s.status_dalam_keluarga AS siswa_status_dalam_keluarga, s.anak_ke AS siswa_anak_ke, s.alamat AS siswa_alamat, s.telepon_hp AS siswa_telepon_hp, s.sekolah_asal AS siswa_sekolah_asal, 
               o.id AS orang_tua_id, o.nama_ayah AS orang_tua_nama_ayah, o.alamat_ayah AS orang_tua_alamat_ayah, o.telepon_ayah AS orang_tua_telepon_ayah, o.pekerjaan_ayah AS orang_tua_pekerjaan_ayah, o.nama_ibu AS orang_tua_nama_ibu, o.alamat_ibu AS orang_tua_alamat_ibu, o.telepon_ibu AS orang_tua_telepon_ibu, o.pekerjaan_ibu AS orang_tua_pekerjaan_ibu
        FROM siswa s
        INNER JOIN orang_tua o ON s.id = o.siswa_id
        WHERE s.users_id = '$user_id'";

$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $siswa_id = $row['siswa_id'];
    $siswa_nama = $row['siswa_nama'];
    $siswa_nomor_induk = $row['siswa_nomor_induk'];
    $siswa_nisn = $row['siswa_nisn'];
    $siswa_tempat_lahir = $row['siswa_tempat_lahir'];
    $siswa_tanggal_lahir = $row['siswa_tanggal_lahir'];
    $siswa_jenis_kelamin = $row['siswa_jenis_kelamin'];
    $siswa_agama = $row['siswa_agama'];
    $siswa_status_dalam_keluarga = $row['siswa_status_dalam_keluarga'];
    $siswa_anak_ke = $row['siswa_anak_ke'];
    $siswa_alamat = $row['siswa_alamat'];
    $siswa_telepon_hp = $row['siswa_telepon_hp'];
    $siswa_sekolah_asal = $row['siswa_sekolah_asal'];

    $orang_tua_id = $row['orang_tua_id'];
    $orang_tua_nama_ayah = $row['orang_tua_nama_ayah'];
    $orang_tua_alamat_ayah = $row['orang_tua_alamat_ayah'];
    $orang_tua_telepon_ayah = $row['orang_tua_telepon_ayah'];
    $orang_tua_pekerjaan_ayah = $row['orang_tua_pekerjaan_ayah'];
    $orang_tua_nama_ibu = $row['orang_tua_nama_ibu'];
    $orang_tua_alamat_ibu = $row['orang_tua_alamat_ibu'];
    $orang_tua_telepon_ibu = $row['orang_tua_telepon_ibu'];
    $orang_tua_pekerjaan_ibu = $row['orang_tua_pekerjaan_ibu'];
} else {
    echo "Data siswa dan orang tua tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_siswa_nama = $_POST['siswa_nama'];
    $new_siswa_nomor_induk = $_POST['siswa_nomor_induk'];
    $new_siswa_nisn = $_POST['siswa_nisn'];
    $new_siswa_tempat_lahir = $_POST['siswa_tempat_lahir'];
    $new_siswa_tanggal_lahir = $_POST['siswa_tanggal_lahir'];
    $new_siswa_jenis_kelamin = $_POST['siswa_jenis_kelamin'];
    $new_siswa_agama = $_POST['siswa_agama'];
    $new_siswa_status_dalam_keluarga = $_POST['siswa_status_dalam_keluarga'];
    $new_siswa_anak_ke = $_POST['siswa_anak_ke'];
    $new_siswa_alamat = $_POST['siswa_alamat'];
    $new_siswa_telepon_hp = $_POST['siswa_telepon_hp'];
    $new_siswa_sekolah_asal = $_POST['siswa_sekolah_asal'];

    $new_orang_tua_nama_ayah = $_POST['orang_tua_nama_ayah'];
    $new_orang_tua_alamat_ayah = $_POST['orang_tua_alamat_ayah'];
    $new_orang_tua_telepon_ayah = $_POST['orang_tua_telepon_ayah'];
    $new_orang_tua_pekerjaan_ayah = $_POST['orang_tua_pekerjaan_ayah'];
    $new_orang_tua_nama_ibu = $_POST['orang_tua_nama_ibu'];
    $new_orang_tua_alamat_ibu = $_POST['orang_tua_alamat_ibu'];
    $new_orang_tua_telepon_ibu = $_POST['orang_tua_telepon_ibu'];
    $new_orang_tua_pekerjaan_ibu = $_POST['orang_tua_pekerjaan_ibu'];

    $sql_update_siswa = "UPDATE siswa SET nama = '$new_siswa_nama', nomor_induk = '$new_siswa_nomor_induk', nisn = '$new_siswa_nisn', tempat_lahir = '$new_siswa_tempat_lahir', tanggal_lahir = '$new_siswa_tanggal_lahir', jenis_kelamin = '$new_siswa_jenis_kelamin', agama = '$new_siswa_agama', status_dalam_keluarga = '$new_siswa_status_dalam_keluarga', anak_ke = '$new_siswa_anak_ke', alamat = '$new_siswa_alamat', telepon_hp = '$new_siswa_telepon_hp', sekolah_asal = '$new_siswa_sekolah_asal' WHERE id = '$siswa_id'";
    if ($conn->query($sql_update_siswa) === TRUE) {
        $sql_update_orang_tua = "UPDATE orang_tua SET nama_ayah = '$new_orang_tua_nama_ayah', alamat_ayah = '$new_orang_tua_alamat_ayah', telepon_ayah = '$new_orang_tua_telepon_ayah', pekerjaan_ayah = '$new_orang_tua_pekerjaan_ayah', nama_ibu = '$new_orang_tua_nama_ibu', alamat_ibu = '$new_orang_tua_alamat_ibu', telepon_ibu = '$new_orang_tua_telepon_ibu', pekerjaan_ibu = '$new_orang_tua_pekerjaan_ibu' WHERE id = '$orang_tua_id'";
        if ($conn->query($sql_update_orang_tua) === TRUE) {
            header("Location: index.php?page=edit_data");
            exit;
        } else {
            echo "Error updating parent data: " . $conn->error;
        }
    } else {
        echo "Error updating student data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
    <link rel="icon" href="../../assets/img/icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit Data Siswa</h2>
        <form method="POST">
            <div class="mb-3">
                <h3>Data Siswa</h3>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="siswa_nama" class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control" id="siswa_nama" name="siswa_nama" value="<?php echo $siswa_nama; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="siswa_nomor_induk" class="form-label">Nomor Induk</label>
                    <input type="text" class="form-control" id="siswa_nomor_induk" name="siswa_nomor_induk" value="<?php echo $siswa_nomor_induk; ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="siswa_nisn" class="form-label">NISN</label>
                    <input type="text" class="form-control" id="siswa_nisn" name="siswa_nisn" value="<?php echo $siswa_nisn; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="siswa_tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" id="siswa_tempat_lahir" name="siswa_tempat_lahir" value="<?php echo $siswa_tempat_lahir; ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="siswa_tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="siswa_tanggal_lahir" name="siswa_tanggal_lahir" value="<?php echo $siswa_tanggal_lahir; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="siswa_jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" id="siswa_jenis_kelamin" name="siswa_jenis_kelamin" required>
                        <option value="">Pilih jenis kelamin</option>
                        <option value="Laki-laki" <?php if ($siswa_jenis_kelamin == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                        <option value="Perempuan" <?php if ($siswa_jenis_kelamin == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="siswa_agama" class="form-label">Agama</label>
                    <select class="form-select" id="siswa_agama" name="siswa_agama" required>
                        <option value="">Pilih agama</option>
                        <option value="Islam" <?php if ($siswa_agama == 'Islam') echo 'selected'; ?>>Islam</option>
                        <option value="Kristen" <?php if ($siswa_agama == 'Kristen') echo 'selected'; ?>>Kristen</option>
                        <option value="Katolik" <?php if ($siswa_agama == 'Katolik') echo 'selected'; ?>>Katolik</option>
                        <option value="Hindu" <?php if ($siswa_agama == 'Hindu') echo 'selected'; ?>>Hindu</option>
                        <option value="Konghucu" <?php if ($siswa_agama == 'Konghucu') echo 'selected'; ?>>Konghucu</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="siswa_status_dalam_keluarga" class="form-label">Status dalam Keluarga</label>
                    <input type="text" class="form-control" id="siswa_status_dalam_keluarga" name="siswa_status_dalam_keluarga" value="<?php echo $siswa_status_dalam_keluarga; ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="siswa_anak_ke" class="form-label">Anak ke</label>
                    <input type="number" class="form-control" id="siswa_anak_ke" name="siswa_anak_ke" value="<?php echo $siswa_anak_ke; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="siswa_alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="siswa_alamat" name="siswa_alamat" required><?php echo $siswa_alamat; ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="siswa_telepon_hp" class="form-label">Telepon HP</label>
                    <input type="text" class="form-control" id="siswa_telepon_hp" name="siswa_telepon_hp" value="<?php echo $siswa_telepon_hp; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="siswa_sekolah_asal" class="form-label">Sekolah Asal</label>
                    <input type="text" class="form-control" id="siswa_sekolah_asal" name="siswa_sekolah_asal" value="<?php echo $siswa_sekolah_asal; ?>" required>
                </div>
            </div>
            <div class="mb-3">
                <h3>Data Ayah</h3>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="orang_tua_nama_ayah" class="form-label">Nama Ayah</label>
                    <input type="text" class="form-control" id="orang_tua_nama_ayah" name="orang_tua_nama_ayah" value="<?php echo $orang_tua_nama_ayah; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="orang_tua_alamat_ayah" class="form-label">Alamat Ayah</label>
                    <textarea class="form-control" id="orang_tua_alamat_ayah" name="orang_tua_alamat_ayah" required><?php echo $orang_tua_alamat_ayah; ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="orang_tua_telepon_ayah" class="form-label">Telepon Ayah</label>
                    <input type="text" class="form-control" id="orang_tua_telepon_ayah" name="orang_tua_telepon_ayah" value="<?php echo $orang_tua_telepon_ayah; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="orang_tua_pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                    <input type="text" class="form-control" id="orang_tua_pekerjaan_ayah" name="orang_tua_pekerjaan_ayah" value="<?php echo $orang_tua_pekerjaan_ayah; ?>" required>
                </div>
            </div>
            <div class="mb-3">
                <h3>Data Ibu</h3>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="orang_tua_nama_ibu" class="form-label">Nama Ibu</label>
                    <input type="text" class="form-control" id="orang_tua_nama_ibu" name="orang_tua_nama_ibu" value="<?php echo $orang_tua_nama_ibu; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="orang_tua_alamat_ibu" class="form-label">Alamat Ibu</label>
                    <textarea class="form-control" id="orang_tua_alamat_ibu" name="orang_tua_alamat_ibu" required><?php echo $orang_tua_alamat_ibu; ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="orang_tua_telepon_ibu" class="form-label">Telepon Ibu</label>
                    <input type="text" class="form-control" id="orang_tua_telepon_ibu" name="orang_tua_telepon_ibu" value="<?php echo $orang_tua_telepon_ibu; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="orang_tua_pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                    <input type="text" class="form-control" id="orang_tua_pekerjaan_ibu" name="orang_tua_pekerjaan_ibu" value="<?php echo $orang_tua_pekerjaan_ibu; ?>" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>