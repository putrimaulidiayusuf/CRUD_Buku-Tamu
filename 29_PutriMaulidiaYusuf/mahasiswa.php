<?php
require 'koneksi.php';

$id = $_GET['edit'] ?? null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = $_POST;
  $sql = $data['id']
    ? "UPDATE kehadiran_siswa SET nama='$data[nama]', jurusan='$data[jurusan]', nis=$data[nis] WHERE id=$data[id]"
    : "INSERT INTO kehadiran_siswa (nama, jurusan, nis) VALUES ('$data[nama]', '$data[jurusan]', $data[nis])";
  mysqli_query($conn, $sql);
  header("Location: ?page=mahasiswa");
  exit;
}

if (isset($_GET['hapus'])) {
  mysqli_query($conn, "DELETE FROM kehadiran_siswa WHERE id=$_GET[hapus]");
  header("Location: ?page=mahasiswa");
  exit;
}

$edit = $id ? mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM kehadiran_siswa WHERE id=$id")) : null;
?>

<h3>Form Mahasiswa</h3>
<form method="POST">
  <input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">
  <input name="nama" placeholder="Nama" value="<?= $edit['nama'] ?? '' ?>" required>
  <input name="jurusan" placeholder="Jurusan" value="<?= $edit['jurusan'] ?? '' ?>" required>
  <input name="nis" type="number" placeholder="NIS" value="<?= $edit['nis'] ?? '' ?>" required>
  <button><?= $edit ? 'Update' : 'Tambah' ?></button>
</form>

<h3>Daftar Mahasiswa</h3>
<table border="1" cellpadding="5">
  <tr><th>ID</th><th>Nama</th><th>Jurusan</th><th>NIS</th><th>Aksi</th></tr>
  <?php
  $q = mysqli_query($conn, "SELECT * FROM kehadiran_siswa ORDER BY id DESC");
  foreach ($q as $row) {
    echo "<tr><td>$row[id]</td><td>$row[nama]</td><td>$row[jurusan]</td><td>$row[nis]</td>
    <td><a href='?page=mahasiswa&edit=$row[id]'>Edit</a> |
    <a href='?page=mahasiswa&hapus=$row[id]' onclick=\"return confirm('Hapus?')\">Hapus</a></td></tr>";
  }
  ?>
</table>
