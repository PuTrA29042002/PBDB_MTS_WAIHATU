<?php
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM announcements ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Berkas Siswa</title>
    <link rel="icon" href="../../assets/img/icon.png" type="image/png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        .table td,
        .table th {
            word-wrap: break-word;
            word-break: break-all;
            white-space: normal;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h1 class="h3 mb-5 text-center text-black-800">Daftar Pengumuman</h1>

        <a href="index.php?page=input_pengumuman" class="btn btn-primary mb-4"><i class="fa-solid fa-square-plus"></i> Tambahkan Pengumuman</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Judul</th>
                        <th scope="col">Isi Pengumuman</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td width="100"><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo nl2br(htmlspecialchars($row['content'])); ?></td>
                            <td width="100"><?php echo htmlspecialchars($row['created_at']); ?></td>
                            <td width="100" class="text-center">
                                <a href="index.php?page=delete_pengumuman&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')"><i class="fa-solid fa-trash-can"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>