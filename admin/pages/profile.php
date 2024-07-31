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

// Ambil data pengguna berdasarkan ID
$users_id = $_SESSION['users_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $users_id);
$stmt->execute();
$result = $stmt->get_result();
$users = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Jika ada foto profil yang di-upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $file_name = basename($_FILES['profile_picture']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

        // Validasi tipe file
        if (in_array($file_ext, $allowed_ext)) {
            // Gunakan nama file yang unik untuk menghindari bentrokan
            $unique_file_name = uniqid() . '.' . $file_ext;
            $file_path = '../uploads/profile/' . $unique_file_name;

            if (move_uploaded_file($file_tmp, $file_path)) {
                // Hapus foto profil lama jika ada
                if (!empty($users['profile_picture'])) {
                    $old_file_path = '../uploads/profile/' . $users['profile_picture'];
                    if (file_exists($old_file_path)) {
                        unlink($old_file_path);
                    }
                }

                // Update nama file foto baru di database
                $update_query = "UPDATE users SET profile_picture = ? WHERE id = ?";
                $stmt = $conn->prepare($update_query);
                $stmt->bind_param("si", $unique_file_name, $users_id);
                $stmt->execute();
                header("Location: index.php?page=profile");
                exit;
            } else {
                $error = "Failed to upload file.";
            }
        } else {
            $error = "Invalid file type.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="icon" href="../../assets/img/icon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/profile.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Profile</h2>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" enctype="multipart/form-data">
                    <div class="text-center mb-4">
                        <label class="form-label">Profile Picture:</label>
                        <?php if ($users['profile_picture']) : ?>
                            <img src="../uploads/profile/<?php echo htmlspecialchars($users['profile_picture']); ?>" alt="Profile Picture" class="img-thumbnail" width="150">
                        <?php endif; ?>
                        <input type="file" name="profile_picture" accept="image/*" class="form-control mt-3">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Profile Picture</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Link ke JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>