<?php
require_once('koneksi.php');
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Siswa</title>
</head>
<body>

<?php
$query = mysqli_query($koneksi, "SELECT * FROM table_siswa WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);
?>

<h1>Edit Siswa</h1>

<form action="" method="post">
  <input type="text" name="nama_siswa" id="nama_siswa" value="<?= $data['nama_siswa']; ?>" placeholder="Isi Nama...">
  <input type="number" name="umur" id="umur" value="<?= $data['umur']; ?>" placeholder="Isi Usia...">
  <input type="email" name="email" id="email" value="<?= $data['email']; ?>" placeholder="Isi Email...">
  <button type="submit" name="Edit">Edit</button>
</form>

<?php
if (isset($_POST['Edit'])) {
  // Ambil data dari form
  $nama  = $_POST['nama_siswa'];
  $umur  = $_POST['umur'];
  $email = $_POST['email'];

  $result = mysqli_query($koneksi,
    "UPDATE table_siswa
    SET nama_siswa = '$nama', umur = '$umur', email = '$email' WHERE id = '$id'") or die(mysqli_error($koneksi));

  // Cek apakah data berhasil diupdate
  if ($result) {
    echo "<script>alert('Data berhasil diedit!'); window.location='tampil_siswa.php';</script>"; // 🔧 Optional redirect
  } else {
    echo "<script>alert('Data gagal diedit!');</script>";
  }
}
?>

</body>
</html>
