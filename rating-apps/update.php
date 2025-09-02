<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = intval($_POST['id']);
  $rating_value = intval($_POST['rating_value']);
  $comment = htmlspecialchars($_POST['comment']);

  // Ambil data lama
  $query = mysqli_query($con, "SELECT * FROM rating WHERE id = '$id'");
  $old = mysqli_fetch_assoc($query);

  if (!$old) {
    echo "Data Tidak Ditemukan";
    exit;
  }

  $media_file = $old['media_file'];
  $media_type = $old['media_type'];

  // Jika ada file baru di upload
  if (isset($_FILES['media']) && $_FILES['media']['error'] === UPLOAD_ERR_OK) {
    $tmp = $_FILES['media']['tmp_name'];
    $name = basename($_FILES['media']['name']);
    $type = mime_content_type($tmp);
    $ext = pathinfo($name, PATHINFO_EXTENSION);

    // Tentukan tipe baru
    if (strpos($type, 'image') !== false) {
      $media_type = 'image';
    } elseif (strpos($type, 'video') !== false) {
      $media_type = 'video';
    } else {
      echo "Tipe file tidak didukung!";
      exit;
    }

    // Nama file baru & path
    $new_name = uniqid() . '.' . $ext;
    $path = 'uploads/' . $new_name;

    // Hapus media lama jika ada
    if ($media_file && file_exists('uploads/' . $media_file)) {
      unlink('uploads/' . $media_file);
    }

    // Pindahkan file
    if (move_uploaded_file($tmp, $path)) {
      $media_file = $new_name;
    }
  }

  // Update ke Database
  $stmt = mysqli_prepare($con, "UPDATE rating SET rating_value = ?, comment = ?, media_file = ?, media_type = ? WHERE id = ?");
  mysqli_stmt_bind_param($stmt, "isssi", $rating_value, $comment, $media_file, $media_type, $id);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("Location: index.php");
  exit;
} else {
  echo "Akses tidak diizinkan!";
}
?>
