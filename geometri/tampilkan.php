<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$mahasiswa2 = [ //array multidimensi
    [ 'nama' => 'Joko', 'nim' => '123456', 'jurusan' => 'Teknik Informatika' ],
    [ 'nama' => 'Siti', 'nim' => '654321', 'jurusan' => 'Sistem Informasi' ],
    [   'nama' => 'Andi', 'nim' => '789012', 'jurusan' => 'Teknik Komputer' ],
    [   'nama' => 'Dewi', 'nim' => '345678', 'jurusan' => 'Teknik Elektro' ],
    [   'nama' => 'Putri', 'nim' => '901234', 'jurusan' => 'Teknik Sipil']
]; ?>
<!-- // echo "<table border='1' cellspacing='0'> //dengan echo
//     <tr>
//         <th>No</th>
//         <th>Nama</th>
//         <th>NIM</th>
//         <th>Jurusan</th>
//     </tr>";
// foreach ($mahasiswa2 as $index => $mhs) { //looping untuk menampilkan semua elemen
// echo "<tr>
//         <td>" . $index + 1 . "</td>
//         <td>" . $mhs['nama'] . "</td>
//         <td>" . $mhs['nim'] . "</td>
//         <td>" . $mhs['jurusan'] . "</td>
//     </tr>";
//     }
// "</table>"; -->

<table border='1' cellspacing='0'> <!-- //tanpa echo -->
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>NIM</th>
    <th>Jurusan</th>
  </tr>
<?php
  $i = 1;
    foreach ($mahasiswa2 as $a) {
?>

  <tr>
    <td><?= $i++ ?></td>
    <td><?= $a['nama']; ?></td>
    <td><?= $a['nim']; ?></td>
    <td><?= $a['jurusan']; ?></td>
  </tr>
<?php } ?>
</table>
</body>
</html>
