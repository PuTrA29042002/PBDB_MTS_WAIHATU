<?php
include '../koneksi/db.php';

$id = $_GET['id'];

$result = $conn->query("SELECT gambar FROM ekstrakurikuler WHERE id=$id");
$row = $result->fetch_assoc();
unlink("../assets/ekstrakurikuler/" . $row['gambar']);

$sql = "DELETE FROM ekstrakurikuler WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php?page=kegiatan");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
