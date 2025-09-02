<?php
require 'koneksi.php';

if (isset($_GET['id'])) {
  $id = intval($_GET['id']);

  // Ambil data untuk hapus file media juga
  $query = mysqli_query($con, "SELECT * FROM rating WHERE id = '$id'");
  $data = mysqli_fetch_assoc($query);

  if (!$data) {
    echo "Data Tidak Ditemukan";
    exit;
  }

  // Hapus file media jika ada
  if ($data['media_file'] && file_exists('uploads/' . $data['media_file'])) {
    unlink('uploads/' . $data['media_file']);
  }

  // Hapus dari Database
  $stmt = mysqli_prepare($con, "DELETE FROM rating WHERE id = ?");
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("Location: index.php");
  exit;
} else {
  echo "ID Tidak Valid";
}
?>
