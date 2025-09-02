<?php
$conn = mysqli_connect('localhost','root','','kehadiran') or die('Gagal Koneksi!');
function q($sql){
  global $conn;
  return mysqli_query($conn,$sql);
}
function f($sql){
  return mysqli_fetch_assoc(q($sql));
}

$id = $_GET['edit'] ?? null;

if ($_POST) {
  $a = $_POST;
  $sql = $a['id']
    ? "UPDATE kehadiran_siswa SET nama='$a[nama]', jurusan='$a[jurusan]', nis=$a[nis] WHERE id=$a[id]"
    : "INSERT INTO kehadiran_siswa (nama, jurusan, nis) VALUES('$a[nama]', '$a[jurusan]', $a[nis])";
  q($sql);
    header("Location:?");
  exit;
}

if (isset($_GET['hapus'])) {
  q("DELETE FROM kehadiran_siswa WHERE id=$_GET[hapus]");
  header("Location:?");
  exit; }

$edit = $id ? f("SELECT * FROM kehadiran_siswa WHERE id=$id") : null;
?>

<body>
<h1>Data Mahasiswa</h1><hr>

<form method="POST">
  <input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">
  <input name="nama" placeholder="Nama" value="<?= $edit['nama'] ?? '' ?>" required>
  <input name="jurusan" placeholder="Jurusan" value="<?= $edit['jurusan'] ?? '' ?>" required>
  <input name="nis" type="number" placeholder="NIS" value="<?= $edit['nis'] ?? '' ?>" required>
  <button><?= $edit ? 'Update' : 'Tambah' ?></button>
</form>

<h3>Daftar Mahasiswa</h3>

<table border="1" cellpadding="5">
  <tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Jurusan</th>
    <th>NIS</th>
    <th>Aksi</th>
  </tr>

  <?php
  $no = 1;
  foreach(q("SELECT * FROM kehadiran_siswa ORDER BY id DESC") as $c):
  ?>

    <tr>
      <td><?= $no++ ?></td>
      <td><?= $c['nama'] ?></td>
      <td><?= $c['jurusan'] ?></td>
      <td><?= $c['nis'] ?></td>
      <td><a href="?edit=<?= $c['id'] ?>">Edit</a> | <a href="?hapus=<?= $c['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a></td>
    </tr>
  <?php endforeach ?>
</table>
</body>
