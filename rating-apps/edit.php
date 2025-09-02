<?php
require 'koneksi.php';

if (!isset($_GET['id'])) {
  echo "ID Tidak Ditemukan";
  exit;
}

$id = intval($_GET['id']);
$query = mysqli_query($con, "SELECT * FROM rating WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
  echo "Data Tidak Ditemukan";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Rating</title>
</head>
<body>
  <h2>Edit Rating</h2>
  <form action="update.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">

    <label>Rating 1-5:</label><br>
    <input type="number" name="rating_value" min="1" max="5" value="<?= $data['rating_value'] ?>" required><br><br>

    <label>Ulasan:</label><br>
    <textarea name="comment" rows="4" cols="50" required><?= htmlspecialchars($data['comment']) ?></textarea><br><br>

    <?php if ($data['media_file']) : ?>
      <p>Media Saat Ini:</p>
      <?php if ($data['media_type'] === 'image') : ?>
        <img src="uploads/<?= htmlspecialchars($data['media_file']) ?>" width="200">
      <?php elseif ($data['media_type'] === 'video') : ?>
        <video controls width="300">
          <source src="uploads/<?= htmlspecialchars($data['media_file']) ?>" type="video/mp4">
        </video>
      <?php endif; ?>

      <!-- Tambahkan checkbox untuk hapus media -->
      <br>
      <label>
        <input type="checkbox" name="delete_media" value="1">
        Hapus Media Saat Ini
      </label>
      <br><br>
    <?php endif; ?>

    <label>Ganti Media (Opsional):</label><br>
    <input type="file" name="media" accept="image/*,video/*"><br><br>

    <button type="submit">Update</button>
  </form>

  <br>
  <a href="index.php">← Kembali ke Beranda</a>
</body>
</html>
