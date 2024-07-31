<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['users_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

include('../koneksi/db.php');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $user_id = $_SESSION['users_id'];

    // Periksa password lama
    $query = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($current_password, $user['password'])) {
                if ($new_password === $confirm_password) {
                    // Update password
                    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                    $update_query = "UPDATE users SET password = ? WHERE id = ?";
                    $stmt = $conn->prepare($update_query);
                    if ($stmt) {
                        $stmt->bind_param("si", $hashed_password, $user_id);
                        if ($stmt->execute()) {
                            $_SESSION['message'] = "Password Telah Diubah.";
                            // Pengalihan ke halaman dashboard
                            header("Location: index.php?page=change_password");
                            exit;
                        } else {
                            $_SESSION['message'] = "Error updating password.";
                        }
                    } else {
                        $_SESSION['message'] = "Error preparing update statement.";
                    }
                } else {
                    $_SESSION['message'] = "New passwords do not match.";
                }
            } else {
                $_SESSION['message'] = "Current password is incorrect.";
            }
        } else {
            $_SESSION['message'] = "User not found.";
        }
    } else {
        $_SESSION['message'] = "Error preparing select statement.";
    }
}

// Jika tidak ada pengalihan, kembali ke halaman form dengan pesan kesalahan
header("Location: index.php?page=change_password");
exit;
