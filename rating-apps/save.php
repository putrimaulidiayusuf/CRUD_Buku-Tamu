<?php
require 'koneksi.php';

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $rating_value = intval($_POST['rating_value']);
  $comment = htmlspecialchars($_POST['comment']);

  $media_file = null;
  $media_type = null;

  // Cek apakah ada file yang diupload
  if (isset($_FILES['media']) && $_FILES['media']['error'] === UPLOAD_ERR_OK) {
    $file_tmp  = $_FILES['media']['tmp_name'];
    $file_name = basename($_FILES['media']['name']);
    $file_type = mime_content_type($file_tmp);
    $file_ext  = pathinfo($file_name, PATHINFO_EXTENSION);

    // Validasi ekstensi file yang diizinkan
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'mp4', 'webm'];
    if (!in_array(strtolower($file_ext), $allowed_ext)) {
      echo "Tipe file tidak diizinkan!<br>";
      echo "Ekstensi: " . $file_ext;
      exit;
    }

    // Tentukan tipe media
    if (strpos($file_type, 'image') !== false) {
      $media_type = 'image';
    } elseif (strpos($file_type, 'video') !== false) {
      $media_type = 'video';
    } else {
      echo "Tipe media tidak dikenali: " . $file_type;
      exit;
    }

    // Rename file agar unik
    $new_file_name = uniqid() . '.' . strtolower($file_ext);
    $upload_path = 'uploads/' . $new_file_name;

    // Pindahkan file ke folder uploads
    if (move_uploaded_file($file_tmp, $upload_path)) {
      $media_file = $new_file_name;
      // echo "Upload berhasil: $media_file<br>";
    } else {
      echo "❌ Gagal upload file ke folder 'uploads/'<br>";
      echo "Temp file: $file_tmp<br>";
      echo "Path tujuan: $upload_path<br>";
      exit;
    }
  }

  // Simpan ke database
  $stmt = mysqli_prepare($con, "INSERT INTO rating (rating_value, comment, media_file, media_type) VALUES (?, ?, ?, ?)");
  if ($stmt) {
    mysqli_stmt_bind_param($stmt, "isss", $rating_value, $comment, $media_file, $media_type);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Redirect kembali ke halaman utama
    header("Location: index.php");
    exit();
  } else {
    echo "❌ Gagal menyiapkan statement: " . mysqli_error($con);
  }
} else {
  echo "Akses tidak diizinkan!";
}
?>
