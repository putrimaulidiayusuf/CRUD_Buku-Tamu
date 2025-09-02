<?php
require_once 'koneksi.php';
?>

<?php
$mahasiswa = &$_SESSION['mahasiswa'];
$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'];
  $nim = $_POST['nim'];
  $jurusan = $_POST['jurusan'];

  if ($_POST['id'] === '') {
    $mahasiswa[] = ['nama' => $nama, 'nim' => $nim, 'jurusan' => $jurusan];
  } else {
    $mahasiswa[$_POST['id']] = ['nama' => $nama, 'nim' => $nim, 'jurusan' => $jurusan];
  }
  header("Location: ?page=mahasiswa");
  exit;
}

if ($action === 'delete' && isset($mahasiswa[$id])) {
  unset($mahasiswa[$id]);
  header("Location: ?page=mahasiswa");
  exit;
}

$editData = ['nama' => '', 'nim' => '', 'jurusan' => ''];
if ($action === 'edit' && isset($mahasiswa[$id])) {
  $editData = $mahasiswa[$id];
}
?>

<h2>Data Mahasiswa</h2>

<form method="post">
  <input type="hidden" name="id" value="<?= $id ?>">
  <input type="text" name="nama" placeholder="Nama" required value="<?= $editData['nama'] ?>">
  <input type="text" name="nim" placeholder="NIM" required value="<?= $editData['nim'] ?>">
  <input type="text" name="jurusan" placeholder="Jurusan" required value="<?= $editData['jurusan'] ?>">
  <button type="submit"><?= $action === 'edit' ? 'Update' : 'Tambah' ?></button>
</form>

<hr>

<table border="1" cellpadding="5">
  <tr>
    <th>No</th><th>Nama</th><th>NIM</th><th>Jurusan</th><th>Aksi</th>
  </tr>
  <?php foreach ($mahasiswa as $i => $m): ?>
    <tr>
      <td><?= $i + 1 ?></td>
      <td><?= htmlspecialchars($m['nama']) ?></td>
      <td><?= htmlspecialchars($m['nim']) ?></td>
      <td><?= htmlspecialchars($m['jurusan']) ?></td>
      <td>
        <a href="?page=mahasiswa&action=edit&id=<?= $i ?>">Edit</a> |
        <a href="?page=mahasiswa&action=delete&id=<?= $i ?>" onclick="return confirm('Hapus data?')">Hapus</a>
      </td>
    </tr>
  <?php endforeach ?>
</table>
