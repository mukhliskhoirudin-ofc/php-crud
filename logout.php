<?php

session_start(); // Mulai sesi
$_SESSION = []; //tambahan biar yakin
session_unset(); // Hapus semua data session
session_destroy(); // Hancurkan session

header("Location: login.php"); // Redirect ke halaman login
exit();
