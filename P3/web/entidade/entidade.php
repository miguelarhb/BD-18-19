<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>P3-BD</title>
</head>

<body>
<?php
  $newEntidade = $_REQUEST["newEntidade"];
  $delEntidade = $_REQUEST["delEntidade"];
  try {
    if ($newEntidade){
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "INSERT INTO EntidadeMeio VALUES (:newEntidade);";

      $result = $db->prepare($sql);
      $result->execute([':newEntidade' => $newEntidade]);

      $db = null;
    }
    if ($delEntidade){
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "DELETE FROM EntidadeMeio WHERE nomeEntidade = (:delEntidade);";

      $result = $db->prepare($sql);
      $result->execute([':delEntidade' => $delEntidade]);

      $db = null;
    }
  header('Location: entidade.html');
  }
  catch (PDOException $e) {
      echo("<p>ERROR: {$e->getMessage()}</p>");
      header('Location: entidade.html');
  }
?>

</body>

</html>
