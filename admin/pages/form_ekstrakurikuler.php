<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Ekstrakurikuler</title>
    <link rel="icon" href="../../assets/img/icon.png" type="image/png">
    <!-- Bootstrap 5 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="h3 mb-5 text-center text-black-800">Tambah Ekstrakurikuler</h1>

        <?php
        include '../koneksi/db.php';

        $id = '';
        $nama = '';
        $gambar = '';

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = $conn->query("SELECT * FROM ekstrakurikuler WHERE id=$id");
            $row = $result->fetch_assoc();
            $nama = $row['nama'];
            $gambar = $row['gambar'];
        }
        ?>
        <a href="index.php?page=kegiatan" class="btn btn-secondary mb-4"><i class="fa-solid fa-arrow-rotate-left"></i> Kembai ke Daftar Ekstrakurikuler</a>
        <form method="post" action="index.php?page=proses_ekstrakurikuler" enctype="multipart/form-data" class="needs-validation" novalidate>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" required>
                <div class="invalid-feedback">Nama harus diisi.</div>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="gambar" name="gambar" <?php if (!$gambar) echo 'required'; ?>>
                <div class="invalid-feedback">Gambar harus diisi.</div>
            </div>
            <?php if ($gambar) : ?>
                <div class="mb-3">
                    <img src="../assets/ekstrakurikuler/<?php echo $gambar; ?>" width="100" class="img-thumbnail"><br>
                </div>
            <?php endif; ?>
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        </form>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>

</html>