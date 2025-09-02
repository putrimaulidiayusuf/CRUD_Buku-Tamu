<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Gaya Apung</title>
  <style>
    body {
      font-family: "Segoe UI", sans-serif;
      background: linear-gradient(135deg, #74ebd5, #ACB6E5);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      background: white;
      padding: 30px 40px;
      border-radius: 20px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
      text-align: center;
      width: 380px;
      animation: fadeIn 0.8s ease-in-out;
    }

    h2 {
      margin-bottom: 20px;
      color: #333;
    }

    input {
      width: 80%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 16px;
      transition: 0.3s;
    }

    input:focus {
      border-color: #74ebd5;
      outline: none;
      box-shadow: 0 0 8px #74ebd5;
    }

    button {
      padding: 10px 20px;
      border: none;
      border-radius: 10px;
      background: linear-gradient(45deg, #74ebd5, #ACB6E5);
      color: white;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }

    .hasil {
      margin-top: 20px;
      padding: 15px;
      border-radius: 10px;
      background: #f3f3f3;
      color: #333;
      font-weight: bold;
      text-align: left;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>Hitung Gaya Apung</h2>

    <form method="post">
      <input type="number" step="any" name="p" placeholder="Massa Jenis Fluida (kg/m³)" required>
      <input type="number" step="any" name="V" placeholder="Volume Benda (m³)" required>
      <br>
      <button type="submit" name="hitung">Hitung</button>
    </form>

    <?php
    function hitung($p, $V, $g = 9.8) {
      return $p * $g * $V;
    }

    if (isset($_POST['p'], $_POST['V'])) {
      $p = $_POST['p'];
      $V = $_POST['V'];
      $g = 9.8;

      $Fa = hitung($p, $V, $g);

      echo "<div class='hasil'>
              <strong>Gaya Apung (F<sub>a</sub>) = " . number_format($Fa, 2) . " N</strong>
            </div>";
    }
    ?>
  </div>
</body>

</html>
