<?php require 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Rating Apps</title>
</head>
<body>
  <h2>Berikan Rating</h2>
  <form action="save.php" method="POST" enctype="multipart/form-data">
    <label>Rating 1-5:</label>
    <input type="number" name="rating_value" min="1" max="5" required><br>

    <label>Komentar:</label>
    <textarea name="comment" required></textarea><br>

    <label>Media (opsional):</label>
    <input type="file" name="media"><br>

    <button type="submit">Kirim</button>
  </form>

  <hr>

  <h2>Filter Rating</h2>
  <form method="GET" action="">
    <label>Filter Rating:</label>
    <select name="rating_filter">
      <option value="">Semua</option>
      <option value="5">Bintang 5</option>
      <option value="4">Bintang 4</option>
      <option value="3">Bintang 3</option>
      <option value="2">Bintang 2</option>
      <option value="1">Bintang 1</option>
    </select>

    <label>Media:</label>
    <select name="media_filter">
      <option value="">Semua</option>
      <option value="with">Hanya yang Ada Media</option>
      <option value="without">Hanya yang Tanpa Media</option>
    </select>

    <button type="submit">Terapkan Filter</button>
  </form>

  <hr>

  <h2>Daftar Rating</h2>
  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>ID</th>
      <th>Rating</th>
      <th>Komentar</th>
      <th>Media</th>
      <th>Aksi</th>
    </tr>

    <?php
    // Filter logic
    $where = [];

    // Filter rating
    if (!empty($_GET['rating_filter'])) {
      $rating = intval($_GET['rating_filter']);
      $where[] = "rating_value = $rating";
    }

    // Filter media
    if (!empty($_GET['media_filter'])) {
      if ($_GET['media_filter'] === 'with') {
        $where[] = "media_file IS NOT NULL AND media_file != ''";
      } elseif ($_GET['media_filter'] === 'without') {
        $where[] = "(media_file IS NULL OR media_file = '')";
      }
    }

    // Query final
    $sql = "SELECT * FROM rating";
    if (!empty($where)) {
      $sql .= " WHERE " . implode(" AND ", $where);
    }
    $sql .= " ORDER BY id DESC";

    $result = mysqli_query($con, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td>" . $row['rating_value'] . "</td>";
      echo "<td>" . $row['comment'] . "</td>";
      echo "<td>";

      // Tampilkan media jika ada
      if ($row['media_file']) {
        $ext = pathinfo($row['media_file'], PATHINFO_EXTENSION);
        if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
          echo "<img src='uploads/{$row['media_file']}' width='100'>";
        } elseif (in_array(strtolower($ext), ['mp4', 'webm', 'ogg'])) {
          echo "<video width='150' controls><source src='uploads/{$row['media_file']}'></video>";
        } else {
          echo "<a href='uploads/{$row['media_file']}' download>Unduh Media</a>";
        }
      } else {
        echo "-";
      }

      echo "</td>";
      echo "<td>";
      echo "<a href='update.php?id={$row['id']}'>Edit</a> | ";
      echo "<a href='delete.php?id={$row['id']}' onclick='return confirm(\"Yakin ingin hapus?\")'>Hapus</a>";
      echo "</td>";
      echo "</tr>";
    }
    ?>
  </table>
</body>
</html>
