<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ekstrakurikuler</title>
    <link rel="icon" href="../../assets/img/icon.png" type="image/png">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
        <h1 class="h3 mb-5 text-center text-black-800">Daftar Ekstrakurikuler</h1>
        <a href="index.php?page=form_ekstrakurikuler" class="btn btn-primary mb-4"><i class="fa-solid fa-square-plus"></i> Tambah Ekstrakurikuler</a>
        <table class="table table-striped table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../koneksi/db.php';
                $result = $conn->query("SELECT * FROM ekstrakurikuler");

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td width='300'>" . $row['nama'] . "</td>";
                    echo "<td><img src='../assets/ekstrakurikuler/" . $row['gambar'] . "' width='300'></td>";
                    echo "<td class='detail text-center'><a href='index.php?page=form_ekstrakurikuler&id=" . $row['id'] . "' class='btn btn-warning btn-sm'><i class='fa-solid fa-pen-to-square'></i> Edit</a> <a href='index.php?page=hapus_ekstrakurikuler&id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ekstrakurikuler ini?\")'><i class='fa-solid fa-trash-can'></i> Hapus</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>