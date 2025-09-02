<?php
$conn = mysqli_connect('localhost', 'root', '', 'kehadiran') or die('Gagal Koneksi!');
$page = $_GET['page'] ?? '';
$id = $_GET['edit'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $a = $_POST;
  $sql = $a['id']
    ? "UPDATE kehadiran_siswa SET nama='$a[nama]', jurusan='$a[jurusan]', nis=$a[nis] WHERE id=$a[id]"
    : "INSERT INTO kehadiran_siswa (nama, jurusan, nis) VALUES ('$a[nama]', '$a[jurusan]', $a[nis])";
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
<!DOCTYPE html>
<html>
<head><title>Aplikasi</title></head>
<body>
  <h1>Data Mahasiswa</h1>
  <nav><a href="?">Home</a> | <a href="?page=mahasiswa">Mahasiswa</a></nav><hr>

  <?php if ($page === 'mahasiswa'): ?>
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
  $b = mysqli_query($conn, "SELECT * FROM kehadiran_siswa ORDER BY id DESC");
    foreach ($b as $c)
      echo "<tr>
              <td>$c[id]</td>
              <td>$c[nama]</td>
              <td>$c[jurusan]</td>
              <td>$c[nis]</td>
              <td>
                <a href='?page=mahasiswa&edit=$c[id]'>Edit</a> |  <a href='?page=mahasiswa&hapus=$c[id]' onclick=\"return confirm('Hapus?')\">Hapus</a>
              </td>
            </tr>";
      ?>
    </table>
  <?php else: ?>
    <h2>Selamat Datang di Aplikasi Mahasiswa</h2>
    <p>Silakan pilih menu di atas.</p>
  <?php endif ?>
</body>
</html>
