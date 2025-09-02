<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menghitung Balok</title>
</head>
<body>
<div>
  <h2>Menghitung Keliling & Luas Balok</h2>

  <form method="post">
      <input type="number" name="p" placeholder="Panjang">
    <input type="number" name="l" placeholder="Lebar">
    <input type="number" name="t" placeholder="Tinggi">
    <button type="submit" name="hitung">Hitung</button>
  </form>

  <?php
  if(isset($_POST['hitung'])){
  $p = $_POST['p'];
  $l = $_POST['l'];
  $t = $_POST['t'];
  $volume = $p * $l * $t;
  $luas = 2 * (($p * $l) + ($p * $t) + ($l * $t));
  $keliling = 4 * ($p + $l + $t);

  echo"Volume : $volume <br>
      Luas : $luas <br>
      Keliling : $keliling";
    }
    ?>
</body>
</html>
