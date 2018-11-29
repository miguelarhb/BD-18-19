<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>P3-BD</title>
</head>

<body>
<?php
  $pairPS = $_REQUEST["pairPS"];
  $pairNumMeio = $_REQUEST["pairNumMeio"];
  $pairEntidade = $_REQUEST["pairEntidade"];
  try {
    if ($pairPS && $pairNumMeio && $pairEntidade){
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "INSERT INTO Acciona VALUES (:pairNumMeio, :pairEntidade, :pairPS);";

      $result = $db->prepare($sql);
      $result->execute([':pairNumMeio' => $pairNumMeio, ':pairEntidade' => $pairEntidade, ':pairPS' => $pairPS]);

      $db = null;
    }
    header('Location: PS.html');
  }
  catch (PDOException $e) {
      echo("<p>ERROR: {$e->getMessage()}</p>");
      header('Location: PS.html');
  }
?>

</body>

</html>
