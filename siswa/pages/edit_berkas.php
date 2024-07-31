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

// Mendapatkan siswa_id berdasarkan users_id
$sql = "SELECT id FROM siswa WHERE users_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $siswa_id = $row['id'];
} else {
    echo "Siswa tidak ditemukan.";
    exit;
}

// Jika ada parameter id yang dikirimkan melalui URL
if (isset($_GET['id'])) {
    $berkas_id = $_GET['id'];

    // Query untuk mengambil data berkas berdasarkan id
    $sql = "SELECT * FROM berkas WHERE id = ? AND siswa_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $berkas_id, $siswa_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $target_dir = "../uploads/";
            $allowed_extensions = array('pdf', 'docx', 'png', 'jpg', 'jpeg');

            // Fungsi untuk mendapatkan ekstensi berkas
            function getFileExtension($filename)
            {
                return pathinfo($filename, PATHINFO_EXTENSION);
            }

            // Mengelola upload berkas untuk setiap jenis berkas yang diubah
            $upload_success = true;
            $updated_files = [];

            // Helper function to handle file upload
            function handleFileUpload($file_key, $target_dir, $allowed_extensions, &$row)
            {
                if (!empty($_FILES[$file_key]['name'])) {
                    $file_name = $_FILES[$file_key]['name'];
                    $file_tmp = $_FILES[$file_key]['tmp_name'];
                    $file_ext = getFileExtension($file_name);

                    if (in_array(strtolower($file_ext), $allowed_extensions)) {
                        $target_file = $target_dir . basename($file_name);
                        if (move_uploaded_file($file_tmp, $target_file)) {
                            return $target_file;
                        }
                    } else {
                        echo "Hanya file dengan ekstensi yang diizinkan untuk $file_key.<br>";
                    }
                }
                return $row[$file_key];
            }

            $updated_files['ijazah'] = handleFileUpload('ijazah', $target_dir, $allowed_extensions, $row);
            $updated_files['skhun'] = handleFileUpload('skhun', $target_dir, $allowed_extensions, $row);
            $updated_files['kk'] = handleFileUpload('kk', $target_dir, $allowed_extensions, $row);
            $updated_files['ktp_ayah'] = handleFileUpload('ktp_ayah', $target_dir, $allowed_extensions, $row);
            $updated_files['ktp_ibu'] = handleFileUpload('ktp_ibu', $target_dir, $allowed_extensions, $row);
            $updated_files['kbs'] = handleFileUpload('kbs', $target_dir, $allowed_extensions, $row);

            if ($upload_success) {
                // Query untuk update data berkas di database
                $sql_update = "UPDATE berkas SET 
                                ijazah = ?, 
                                skhun = ?, 
                                kk = ?, 
                                ktp_ayah = ?, 
                                ktp_ibu = ?, 
                                kbs = ?
                              WHERE id = ? AND siswa_id = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("ssssssii", $updated_files['ijazah'], $updated_files['skhun'], $updated_files['kk'], $updated_files['ktp_ayah'], $updated_files['ktp_ibu'], $updated_files['kbs'], $berkas_id, $siswa_id);

                if ($stmt_update->execute()) {
                    echo "Data berkas berhasil diupdate.";
                    header("Location: index.php?page=display_berkas");
                    exit;
                } else {
                    echo "Error: " . $stmt_update->error;
                }
            }
        }
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Data Berkas</title>
            <link rel="icon" href="../../assets/img/icon.png" type="image/png">
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        </head>

        <body>
            <div class="container">
                <h3 class="mt-4">Edit Data Berkas</h3>
                <form method="post" enctype="multipart/form-data">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center">Jenis Berkas</th>
                                    <th class="text-center">File Saat Ini</th>
                                    <th class="text-center">Unggah Berkas Baru</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ijazah</td>
                                    <td class="text-center"><a href="<?= htmlspecialchars($row['ijazah']) ?>" target="_blank" class="btn btn-success">Lihat</a></td>
                                    <td><input type="file" name="ijazah" accept=".pdf,.docx" class="form-control-file"></td>
                                </tr>
                                <tr>
                                    <td>SKHUN</td>
                                    <td class="text-center"><a href="<?= htmlspecialchars($row['skhun']) ?>" target="_blank" class="btn btn-success">Lihat</a></td>
                                    <td><input type="file" name="skhun" accept=".pdf,.docx" class="form-control-file"></td>
                                </tr>
                                <tr>
                                    <td>KK</td>
                                    <td class="text-center"><a href="<?= htmlspecialchars($row['kk']) ?>" target="_blank" class="btn btn-success">Lihat</a></td>
                                    <td><input type="file" name="kk" accept=".pdf,.png,.jpg,.jpeg" class="form-control-file"></td>
                                </tr>
                                <tr>
                                    <td>KTP Ayah</td>
                                    <td class="text-center"><a href="<?= htmlspecialchars($row['ktp_ayah']) ?>" target="_blank" class="btn btn-success">Lihat</a></td>
                                    <td><input type="file" name="ktp_ayah" accept=".pdf,.png,.jpg,.jpeg" class="form-control-file"></td>
                                </tr>
                                <tr>
                                    <td>KTP Ibu</td>
                                    <td class="text-center"><a href="<?= htmlspecialchars($row['ktp_ibu']) ?>" target="_blank" class="btn btn-success">Lihat</a></td>
                                    <td><input type="file" name="ktp_ibu" accept=".pdf,.png,.jpg,.jpeg" class="form-control-file"></td>
                                </tr>
                                <tr>
                                    <td>Kartu Bantuan Sosial</td>
                                    <td class="text-center"><a href="<?= htmlspecialchars($row['kbs']) ?>" target="_blank" class="btn btn-success">Lihat</a></td>
                                    <td><input type="file" name="kbs" accept=".pdf,.docx" class="form-control-file"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>

        </html>

<?php
    } else {
        echo "Data berkas tidak ditemukan.";
    }
}

$conn->close();
?>