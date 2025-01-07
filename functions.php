<?php

require 'db_connect.php';

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function create($data)
{
    global $conn;
    $nama = htmlspecialchars(trim($data["nama"]));
    $npm = htmlspecialchars(trim($data["npm"]));
    $email = htmlspecialchars(trim($data["email"]));
    $jurusan = htmlspecialchars(trim($data["jurusan"]));

    //upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO mahasiswa (nama, npm, email, jurusan, gambar) VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "sssss", $nama, $npm, $email, $jurusan, $gambar);
    mysqli_stmt_execute($stmt);

    return mysqli_affected_rows($conn);
}

function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars(trim($data["nama"]));
    $npm = htmlspecialchars(trim($data["npm"]));
    $email = htmlspecialchars(trim($data["email"]));
    $jurusan = htmlspecialchars(trim($data["jurusan"]));
    $gambarLama = htmlspecialchars(trim($data["gambarLama"]));

    //cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    $query = "UPDATE mahasiswa SET 
                nama = ?, 
                npm = ?, 
                email = ?, 
                jurusan = ?, 
                gambar = ? 
              WHERE id = ?";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "sssssi", $nama, $npm, $email, $jurusan, $gambar, $id);
    mysqli_stmt_execute($stmt);

    return mysqli_affected_rows($conn);
}

function search($keyword)
{
    $query = "SELECT * FROM mahasiswa
                WHERE
            nama LIKE '%$keyword%' OR
            npm LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'";

    return query($query); //kembalikan function query diatas, isi dengan hasil pencarian
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
                alert('Pilih gambar terlebih dahulu!');
             </script>";

        return false;
    }

    //cek apakah yang di upload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) { //cek ekstensi yang diupload ada gk
        echo "<script>
                alert('Yang di upload bukan gambar');
             </script>";

        return false;
    }

    //cek jika ukuran gambar terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar!');
             </script>";

        return false;
    }

    //generate nama baru/uniq
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    //lolos pengecekan/validasi pindahkan
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}
