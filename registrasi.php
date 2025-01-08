<?php

require 'functions.php';

if (isset($_POST["btnRegistrasi"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
                alert('User baru berhasil ditambahkan!');
              </script>";
    } else {
        echo mysqli_error($conn);
    }
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
    <form action="" method="post">
        <div>
            <label for="username">Username :</label><br>
            <input type="text" id="username" name="username">
        </div>
        <div>
            <label for="password">Password :</label><br>
            <input type="password" id="password" name="password">
        </div>
        <div>
            <label for="passwordConfirm">Confirm Password :</label><br>
            <input type="password" id="passwordConfirm" name="passwordConfirm">
        </div>
        <br>
        <div>
            <button type="submit" name="btnRegistrasi">Registrasi</button>
        </div>
    </form>
</body>

</html>