<?php
require '../functions.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM mahasiswa
                WHERE
            nama LIKE '%$keyword%' OR
            npm LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'";

$mahasiswa = query($query);

?>

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