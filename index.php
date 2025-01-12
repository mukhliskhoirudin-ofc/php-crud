<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

//pagination
//konfigurasi
$jumlahDataPerhalaman = 2;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerhalaman");   //ditampilkan dari index 0, dan tampilkan 5 data

if (isset($_POST["btnSearch"])) {
    $mahasiswa = search($_POST["keyword"]);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>

<body>

    <a href="logout.php">Logout</a>

    <h1>Daftar Mahasiswa</h1>

    <a href="create.php">Tambah Data Mahasiswa</a>
    <br><br>

    <form action="" method="post">
        <input type="text" name="keyword" size="25" placeholder="Search..." autofocus autocomplete="off" id="keyword">
        <button type="submit" name="btnSearch" id="btnSearch">Search</button>
    </form>
    <br>

    <!-- navigasi -->
    <?php if ($halamanAktif > 1): ?>
        <a href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if ($i == $halamanAktif) : ?>
            <a href="?halaman=<?= $i; ?>" style="font-weight:bold; color:red;"><?= $i; ?></a>
        <?php else : ?>
            <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($halamanAktif < $jumlahHalaman): ?>
        <a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
    <?php endif; ?>

    <br>
    <div id="container">
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
    </div>

    <script src="js/script.js"></script>

</body>

</html>