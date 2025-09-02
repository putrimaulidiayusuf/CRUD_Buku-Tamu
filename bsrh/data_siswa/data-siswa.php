<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Siswa</title>
</head>
<body style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100vh;">

  <h1>Data Siswa</h1>
  <table border='1' cellspacing='0'>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Umur</th>
      <th>Email</th>
      <th>Action</th>
    </tr>

    <?php
      require_once('koneksi.php');
      $data = mysqli_query($koneksi, "SELECT * FROM table_siswa");

      $i = 1;
      while ($siswa = mysqli_fetch_assoc($data)) :
    ?>

    <tr>
      <td><?= $i++ ?></td>
      <td><?= $siswa['nama_siswa']; ?></td>
      <td><?= $siswa['umur']; ?></td>
      <td><?= $siswa['email']; ?></td>
      <td>
        <a href="edit-siswa.php?id=<?= $siswa['id']; ?>">Update </a>| <a href="delete-siswa.php?id=<?= $siswa['id'];?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini ?')" >Delete</a>
      </td>
    </tr>

    <?php endwhile; ?>

  </table>
</body>
</html>
