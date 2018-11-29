<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>P3-BD</title>
</head>

<body>
<?php
  $newNumMeio = $_REQUEST["newNumMeio"];
  $newNomeMeio = $_REQUEST["newNomeMeio"];
  $newEntidade = $_REQUEST["newEntidade"];

  $delNumMeio = $_REQUEST["delNumMeio"];
  $delEntidade = $_REQUEST["delEntidade"];

  try{
    if ($newNumMeio && $newNomeMeio && $newEntidade){
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "INSERT INTO Meio VALUES (:newNumMeio, :newNomeMeio, :newEntidade);";

      $result = $db->prepare($sql);
      $result->execute([':newNumMeio' => $newNumMeio, ':newNomeMeio' => $newNomeMeio,':newEntidade' =>$newEntidade]);

      $db = null;
    }
    if ($delNumMeio && $delEntidade){
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "DELETE FROM Meio WHERE (nummeio = (:delNumMeio) AND nomeentidade = (:delEntidade));";

      $result = $db->prepare($sql);
      $result->execute([':delNumMeio' => $delNumMeio, ':delEntidade' =>$delEntidade]);

      $db = null;
    }
      header('Location: meio.html');
  }
  catch (PDOException $e) {
    echo("<p>ERROR: {$e->getMessage()}</p>");
    header('Location: meio.html');
  }
?>

</body>

</html>
