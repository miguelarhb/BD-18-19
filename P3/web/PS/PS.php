<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>P3-BD</title>
</head>

<body>
<?php
  $newPS = $_REQUEST["newPS"];
  $delPS = $_REQUEST["delPS"];
  try {
    if ($newPS){
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "INSERT INTO ProcessoSocorro VALUES (:newPS);";

      $result = $db->prepare($sql);
      $result->execute([':newPS' => $newPS]);

      $db = null;
    }

    if ($delPS){
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "DELETE FROM ProcessoSocorro WHERE numProcessoSocorro = (:delPS);";

      $result = $db->prepare($sql);
      $result->execute([':delPS' => $delPS]);

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
