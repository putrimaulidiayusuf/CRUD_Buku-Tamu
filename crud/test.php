<?php
$conn = mysqli_connect('localhost','root','','kehadiran') or die('Gagal Koneksi!');

$id = $_GET['edit'] ?? null;

if ($_POST) {
  $a = $_POST;
  $sql = $a['id']
    ? "UPDATE kehadiran_siswa SET nama='$a[nama]', jurusan='$a[jurusan]', nis=$a[nis] WHERE id=$a[id]"
    : "INSERT INTO kehadiran_siswa(nama,jurusan,nis) VALUES('$a[nama]','$a[jurusan]',$a[nis])";
  mysqli_query($conn, $sql);
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit;
}

if (isset($_GET['hapus'])) {
  mysqli_query($conn, "DELETE FROM kehadiran_siswa WHERE id=$_GET[hapus]");
  header('Location: ' . $_SERVER['PHP_SELF']);
  exit;
}

$edit = $id
  ? mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM kehadiran_siswa WHERE id=$id"))
  : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>CRUD Mahasiswa</title>
</head>
<body>

<h2>Form Data Mahasiswa</h2>
<form method="post">
    <input type="hidden" name="id" value="<?= $edit['id'] ?? 0 ?>">
    <input name="nama" placeholder="Nama" value="<?= $edit['nama'] ?? '' ?>" required>
    <input name="jurusan" placeholder="Jurusan" value="<?= $edit['jurusan'] ?? '' ?>" required>
    <input name="nis" type="number" placeholder="NIS" value="<?= $edit['nis'] ?? '' ?>" required>
    <button type="submit"><?= $id ? 'Update' : 'Tambah' ?></button>
</form>

<br>

<h2>Data Mahasiswa</h2>
<table border="1" cellpadding="5">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Jurusan</th>
    <th>NIS</th>
    <th>Aksi</th>
</tr>

<?php
$no = 1;
$result = mysqli_query($conn,"SELECT * FROM kehadiran_siswa ORDER BY id DESC");
foreach ($result as $r):
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $r['nama'] ?></td>
    <td><?= $r['jurusan'] ?></td>
    <td><?= $r['nis'] ?></td>
    <td>
      <a href="?edit=<?= $r['id'] ?>">Edit</a> | <a href="?hapus=<?= $r['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

</body>
</html>
