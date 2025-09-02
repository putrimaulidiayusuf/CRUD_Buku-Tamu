<?php
$con = mysqli_connect('localhost', 'root', '', 'latihan_php') or die ('Gagal Koneksi!');
?>
<?php
$con = mysqli_connect('localhost', 'root', '', 'latihan_php');

if (!$con) {
  die("Gagal Koneksi: " . mysqli_connect_error());
}
?>
