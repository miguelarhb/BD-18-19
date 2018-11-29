<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>P3-BD</title>
</head>

<body>
<?php
  $newLocal = $_REQUEST["newLocal"];
  $delLocal = $_REQUEST["delLocal"];
  try{
    if ($newLocal){
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "INSERT INTO Local VALUES (:newLocal);";

      $result = $db->prepare($sql);
      $result->execute([':newLocal' => $newLocal]);

      $db = null;
    }
    if ($delLocal){
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "DELETE FROM Local WHERE moradaLocal = (:delLocal);";

      $result = $db->prepare($sql);
      $result->execute([':delLocal' => $delLocal]);

      $db = null;
    }
    header('Location: local.html');
  }
  catch (PDOException $e){
    echo("<p>ERROR: {$e->getMessage()}</p>");
    header('Location: local.html');
  }
?>

</body>

</html>
