<?php

session_start(); // Mulai sesi
$_SESSION = []; //tambahan biar yakin
session_unset(); // Hapus semua data session
session_destroy(); // Hancurkan session

setcookie('id', '', time() - 3600);
setcookie('key', '', time() - 3600);

header("Location: login.php"); // Redirect ke halaman login
exit();
