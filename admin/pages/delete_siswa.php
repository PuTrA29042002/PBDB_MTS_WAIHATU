<?php
session_start();  // Pastikan sesi dimulai

if (!isset($_SESSION['users_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../../login.php");
    exit;
}

include(__DIR__ . '/../../koneksi/db.php');

if (isset($_GET['id'])) {
    $siswa_id = $_GET['id'];

    // Ambil user_id terkait siswa sebelum menghapus data siswa
    $sql_get_user_id = "SELECT users_id FROM siswa WHERE id='$siswa_id'";
    $result_user_id = $conn->query($sql_get_user_id);

    if ($result_user_id->num_rows > 0) {
        $row = $result_user_id->fetch_assoc();
        $user_id = $row['users_id'];

        // Hapus terlebih dahulu data dari tabel berkas yang terkait dengan siswa
        $sql_delete_berkas = "DELETE FROM berkas WHERE siswa_id='$siswa_id'";
        if ($conn->query($sql_delete_berkas) === TRUE) {
            // Hapus data orang tua yang terkait
            $sql_delete_orang_tua = "DELETE FROM orang_tua WHERE siswa_id='$siswa_id'";
            if ($conn->query($sql_delete_orang_tua) === TRUE) {
                // Hapus data siswa
                $sql_delete_siswa = "DELETE FROM siswa WHERE id='$siswa_id'";
                if ($conn->query($sql_delete_siswa) === TRUE) {
                    // Hapus juga pengguna terkait
                    $sql_delete_user = "DELETE FROM users WHERE id='$user_id'";
                    if ($conn->query($sql_delete_user) === TRUE) {
                        echo "Data siswa dan pengguna berhasil dihapus!";
                    } else {
                        echo "Error: " . $sql_delete_user . "<br>" . $conn->error;
                    }
                } else {
                    echo "Error: " . $sql_delete_siswa . "<br>" . $conn->error;
                }
            } else {
                echo "Error: " . $sql_delete_orang_tua . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql_delete_berkas . "<br>" . $conn->error;
        }
    } else {
        echo "ID siswa tidak ditemukan atau siswa tidak memiliki pengguna terkait.";
    }

    header("Location: index.php?page=data_siswa");
    exit;
} else {
    echo "ID siswa tidak ditemukan.";
}
