<?php 

// (2) Mulai session

session_start();

session_unset();

// (3) Hapus semua session yang berlangsung

session_destroy();

// (1) Hapus cookie dengan key id 

setcookie("id", "", time() - 3600) ;

// (4) Lakukan redirect ke halaman login awal

header('Location: ../views/login.php');

exit;

?>