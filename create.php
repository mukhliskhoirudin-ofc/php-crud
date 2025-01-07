<?php

require 'functions.php';

if (isset($_POST["btnSimpan"])) {
    if (create($_POST) > 0) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambahkan!');
                document.location.href = 'index.php';
              </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
</head>

<body>
    <h1>Tambah Data Mahasiswa</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="nama">Nama :</label><br>
            <input type="text" id="nama" name="nama" required>
        </div>
        <div>
            <label for="npm">NPM :</label><br>
            <input type="number" id="npm" name="npm" required>
        </div>
        <div>
            <label for="email">Email :</label><br>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="jurusan">Jurusan :</label><br>
            <input type="text" id="jurusan" name="jurusan" required>
        </div>
        <div>
            <label for="gambar">Gambar :</label><br>
            <input type="file" id="gambar" name="gambar" accept="image/*">
        </div><br>
        <div>
            <button type="submit" name="btnSimpan">Simpan</button>
        </div>
    </form>
</body>

</html>