<?php
include '../koneksi/db.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$gambar = $_FILES['gambar']['name'];

if ($gambar) {
    $target_dir = "../assets/ekstrakurikuler/";
    $target_file = $target_dir . basename($gambar);
    move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
} else {
    $result = $conn->query("SELECT gambar FROM ekstrakurikuler WHERE id=$id");
    $row = $result->fetch_assoc();
    $gambar = $row['gambar'];
}

if ($id) {
    $sql = "UPDATE ekstrakurikuler SET nama='$nama', gambar='$gambar' WHERE id=$id";
} else {
    $sql = "INSERT INTO ekstrakurikuler (nama, gambar) VALUES ('$nama', '$gambar')";
}

if ($conn->query($sql) === TRUE) {
    header("Location: index.php?page=kegiatan");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
