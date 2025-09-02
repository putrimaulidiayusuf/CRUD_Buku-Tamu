<body>
<form method="post">
  <input type="number" name="p" placeholder="Panjang">
  <input type="number" name="l" placeholder="Lebar">
  <button name="hitung">Hitung</button>
</form>
<?php
if (isset($_POST['p'], $_POST['l'])) {
  $p = $_POST['p']; $l = $_POST['l'];
  echo "Luas: " . ($p * $l) . "<br>Keliling: " . (2 * ($p + $l));
}
?>
</body>
