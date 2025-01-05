<?php

require 'functions.php';

$mahasiswa = query("SELECT * FROM mahasiswa");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>

<body>
    <h1>Daftar Mahasiswa</h1>

    <a href="create.php">Tambah Data Mahasiswa</a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>NPM</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($mahasiswa as $mhs): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><img src="img/<?= $mhs["gambar"]; ?>" width="50"></td>
                <td><?= $mhs["npm"]; ?></td>
                <td><?= $mhs["nama"]; ?></td>
                <td><?= $mhs["email"]; ?></td>
                <td><?= $mhs["jurusan"]; ?></td>
                <td>
                    <a href="update.php?id=<?= $mhs["id"]; ?>">update</a> |
                    <a href="delete.php?id=<?= $mhs["id"]; ?>" onclick="return confirm('Data akan dihapus?')">delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>