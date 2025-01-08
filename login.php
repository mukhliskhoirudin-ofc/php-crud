<?php

require 'functions.php';

if (isset($_POST["btnLogin"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    //cek ada gk username didalam database yg sama di inputkan saat login
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

    //mysqli_num_rows = untuk ngitung ada berapa baris yang dikembalikan dari SELECT atas (ada=1 dan tidak=0)
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) { //cek password yang belum diacak sama gk dengan hash nya (2 parameter)
            header("Location: index.php");
            exit;
        };
    }

    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>

<body>

    <h1>Halaman Login</h1>

    <?php if (isset($error)) : ?>
        <p style="color:red; font-style: italic;"> username / password salah !!! </p>
    <?php endif; ?>

    <form action="" method="post">
        <div>
            <label for="username">Username :</label><br>
            <input type="text" id="username" name="username">
        </div>
        <div>
            <label for="password">Password :</label><br>
            <input type="password" id="password" name="password">
        </div>
        <br>
        <div>
            <button type="submit" name="btnLogin">Login</button>
        </div>
    </form>

</body>

</html>