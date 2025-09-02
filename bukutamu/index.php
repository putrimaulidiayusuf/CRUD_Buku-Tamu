<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buku Tamu</title>
</head>
<body>
  <h2>Form Buku Tamu</h2>
  <form action="simpan.php" method="post">
    Nama : <input type="text" name="nama" required>
    Pesan : <textarea name="pesan" rows="4" cols="40" required></textarea>
    <button type="submit">Kirim</button>
  </form>

  <hr>
  <h2>Daftar Pesan</h2>
  <?php
  include 'koneksi.php';
  $result = mysqli_query($con, "SELECT * FROM bukutamu ORDER BY id DESC") or die(mysqli_error($con));

  while($rows= mysqli_fetch_assoc($result)){
    echo"<p><strong>{$rows['nama']}</strong>:{$rows['pesan']}</p><hr>";
  }
  ?>
</body>
</html>
