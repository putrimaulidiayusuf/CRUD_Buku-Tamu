<?php
require_once('koneksi.php');

//cek apakah ada id yang dikirimkan
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = mysqli_query($koneksi, "DELETE FROM table_siswa WHERE id = '$id'");
}

if($query){
  echo"<script>alert('Data berhasil dihapus');
  window.location.href= 'data-siswa.php'</script>";
} else {
  echo"<script>alert('Data id tidak ada');
  window.location.href= 'data-siswa.php'</script>";
}
?>
