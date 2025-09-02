<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Siswa</title>
</head>
<body>

<h1>Tambah Siswa</h1>

<form action="" method="post">
  <input type="text" name="nama_siswa" id="nama_siswa" placeholder="Isi Nama..." required>
  <input type="number" name="umur" id="umur" placeholder="Isi Usia..." required>
  <input type="email" name="email" id="email" placeholder="Isi Email..." required>
  <button type="submit" name="tambah">Tambah</button>
</form>

<?php
if (isset($_POST['tambah'])) {
  // Ambil data dari form
  $nama  = $_POST['nama_siswa'];
  $umur  = $_POST['umur'];
  $email = $_POST['email'];

  // Koneksi ke database
  require_once('koneksi.php');

  $result = mysqli_query($koneksi,
    "INSERT INTO table_siswa (nama_siswa, umur, email) VALUES ('$nama', '$umur', '$email')") or die(mysqli_error($koneksi));

  // Cek apakah data berhasil ditambahkan
  if ($result) {
    echo "<script>alert('Data berhasil ditambahkan!'); window.location='tampil_siswa.php';</script>";
  } else {
    echo "<script>alert('Data gagal ditambahkan!');</script>";
  }
}
?>

</body>
</html>
