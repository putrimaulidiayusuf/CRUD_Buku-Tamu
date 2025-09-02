<head>
  <title>Aplikasi</title>
</head>
  <body>
    <h1>Data Mahasiswa</h1>
      <nav><a href="?">Home</a> | <a href="?page=mahasiswa">Mahasiswa</a></nav><hr>
  <?php include ($_GET['page']??'home').'.php'; ?>
</body>
