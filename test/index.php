<?php
require_once 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CRUD Mahasiswa (Tanpa Database)</title>
</head>
<body>
  <nav>
    <a href="?">Home</a> |
    <a href="?page=mahasiswa">Mahasiswa</a>
  </nav>
  <hr>
  <main>
    <?php
    session_start();
    if (!isset($_SESSION['mahasiswa'])) {
      $_SESSION['mahasiswa'] = [];
    }
    $page = $_GET['page'] ?? 'home';
    include "includes/{$page}.php";
    ?>
  </main>
</body>
</html>
