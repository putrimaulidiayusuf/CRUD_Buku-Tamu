<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kelas</title>
</head>
<body style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100vh;">

  <h1>Data Kelas</h1>
<table border='1' cellspacing='0'> <!-- //tanpa echo -->
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Umur</th>
    <th>Email</th>
  </tr>

<?php
  //memanggil data table dari database
  require_once('koneksi.php');
  $data = mysqli_query($koneksi, "SELECT * FROM table_kelas");

  $i = 1; // Inisialisasi variabel untuk nomor urut

  //menampilkan data siswa
  while ($siswa = mysqli_fetch_assoc($data)) :
?>

  <tr>
    <td><?= $i++ ?></td>
    <td><?= $siswa['tingkat']; ?></td>
    <td><?= $siswa['jurusan']; ?></td>
    <td><?= $siswa['rombel']; ?></td>
  </tr>

<?php
  endwhile;
?>

</table>
</body>
</html>
