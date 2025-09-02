<?php
$conn = mysqli_connect('localhost', 'root', '', 'TOKO_PUTRI') or die ('Gagal Koneksi!');

$id = $_GET['edit'] ?? null;

if($_POST){
  $a = $_POST;
  $sql = $a['id']
  ? "UPDATE TOKO SET nama_penjual='$a[nama_penjual]', nama_pembeli='$a[nama_pembeli]', alamat_pembeli='$a[alamat_pembeli]', kontak_pembeli=$a[kontak_pembeli], nama_barang='$a[nama_barang]', jumlah_barang=$a[jumlah_barang], harga_barang=$a[harga_barang] WHERE id=$a[id]"
  : "INSERT INTO TOKO (nama_penjual, nama_pembeli, alamat_pembeli, kontak_pembeli, nama_barang, jumlah_barang, harga_barang) VALUES ('$a[nama_penjual]', '$a[nama_pembeli]', '$a[alamat_pembeli]', $a[kontak_pembeli], '$a[nama_barang]', $a[jumlah_barang], $a[harga_barang])";
  mysqli_query($conn, $sql);
  header('Location:' . $_SERVER['PHP_SELF']);
  exit;
}

if(isset($_GET['hapus'])){
  mysqli_query($conn, "DELETE FROM TOKO WHERE id=$_GET[hapus]");
  header('Location:' . $_SERVER['PHP_SELF']);
  exit;
}

$edit = $id
? mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM TOKO WHERE id=$id"))
:[];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD</title>
</head>
<body>
  <form action="" method="post">
    <input type="hidden" name="id" value="<?= $edit['id'] ?? 0 ?>">
    <input type="text" name="nama_penjual" placeholder="Nama Penjual" value="<?= $edit['nama_penjual'] ?? '' ?>" required>
    <input type="text" name="nama_pembeli" placeholder="Nama Pembeli" value="<?= $edit['nama_pembeli'] ?? '' ?>" required>
    <input type="text" name="alamat_pembeli" placeholder="Alamat Pembeli" value="<?= $edit['alamat_pembeli'] ?? '' ?>" required>
    <input type="number" name="kontak_pembeli" placeholder="Kontak Pembeli" value="<?= $edit['kontak_pembeli'] ?? '' ?>" required>
    <input type="text" name="nama_barang" placeholder="Nama Barang" value="<?= $edit['nama_barang'] ?? '' ?>" required>
    <input type="number" name="jumlah_barang" placeholder="Jumlah Barang" value="<?= $edit['jumlah_barang'] ?? '' ?>" required>
    <input type="number" name="harga_barang" placeholder="Harga Barang" value="<?= $edit['harga_barang'] ?? '' ?>" required>
    <button type="submit"><?= $id? 'Update' : 'Tambah' ?></button>
  </form>

  <table border="1" cellpadding="5">
    <tr>
      <td>NO</td>
      <td>Nama Penjual</td>
      <td>Nama Pembeli</td>
      <td>Alamat Pembeli</td>
      <td>Kontak Pembeli</td>
      <td>Nama Barang</td>
      <td>Jumlah Barang</td>
      <td>Harga Barang</td>
      <td>Aksi</td>
    </tr>

    <?php
    $no = 1;
    $result = mysqli_query($conn, "SELECT * FROM TOKO ORDER BY id DESC");
    foreach($result as $c):
    ?>

    <tr>
      <td><?= $no++ ?></td>
      <td><?= $c['nama_penjual'] ?></td>
      <td><?= $c['nama_pembeli'] ?></td>
      <td><?= $c['alamat_pembeli'] ?></td>
      <td><?= $c['kontak_pembeli'] ?></td>
      <td><?= $c['nama_barang'] ?></td>
      <td><?= $c['jumlah_barang'] ?></td>
      <td><?= $c['harga_barang'] ?></td>
      <td><a href="?edit=<?= $c['id']?>">Edit</a> | <a href="?hapus=<?= $c['id']?>" onclick="return confirm('Hapus?')">Hapus</a></td>
    </tr>

    <?php endforeach; ?>
  </table>
</body>
</html>
