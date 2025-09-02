<?php
include 'koneksi.php';

$nama = $_POST ['nama'];
$pesan = $_POST ['pesan'];

$stmt = $con->prepare('INSERT INTO bukutamu (nama, pesan) VALUES (?, ?)');
$stmt->bind_param('ss', $nama, $pesan);
$stmt->execute();

header('Location: index.php');
exit();
?>
