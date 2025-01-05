<?php

require 'functions.php';

$id = $_GET["id"];

$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

if (isset($_POST["btnSimpan"])) {
    if (update($_POST) > 0) {
        echo "<script>
                alert('Data berhasil diupdate!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data gagal diupdate!');
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
    <title>Update Data Mahasiswa</title>
</head>

<body>
    <h1>Update Data Mahasiswa</h1>

    <form action="" method="post">
        <div>
            <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        </div>
        <div>
            <label for="nama">Nama :</label><br>
            <input type="text" id="nama" name="nama" required value="<?= $mhs["nama"]; ?>">
        </div>
        <div>
            <label for="npm">NPM :</label><br>
            <input type="number" id="npm" name="npm" required value="<?= $mhs["npm"]; ?>">
        </div>
        <div>
            <label for="email">Email :</label><br>
            <input type="email" id="email" name="email" required value="<?= $mhs["email"]; ?>">
        </div>
        <div>
            <label for="jurusan">Jurusan :</label><br>
            <input type="text" id="jurusan" name="jurusan" required value="<?= $mhs["jurusan"]; ?>">
        </div>
        <div>
            <label for="gambar">Gambar :</label><br>
            <input type="text" id="gambar" name="gambar" required value="<?= $mhs["gambar"]; ?>">
        </div><br>
        <div>
            <button type="submit" name="btnSimpan">Simpan</button>
        </div>
    </form>
</body>

</html>