<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>P3-BD</title>
</head>

<body>
<?php
  $newTelefone = $_REQUEST["newTelefone"];
  $newDataChamada = $_REQUEST["newDataChamada"];

  $newNome = $_REQUEST["newNome"];
  $newLocal = $_REQUEST["newLocal"];
  $newPS = $_REQUEST["newPS"];

  $delTelefone = $_REQUEST["delTelefone"];
  $delNome = $_REQUEST["delNome"];

  try{

    if ($newTelefone && $newDataChamada && $newNome && $newLocal && $newPS){
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "INSERT INTO EventoEmergencia VALUES (:newTelefone,:newDataChamada, :newNome, :newLocal, :newPS);";

      $result = $db->prepare($sql);
      $result->execute([':newTelefone' => $newTelefone, ':newDataChamada' => $newDataChamada, ':newNome' => $newNome, ':newLocal' => $newLocal,':newPS' =>$newPS]);

      $db = null;

      header('Location: EE.html');
    }

    if ($delTelefone && $delDataChamada){
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "DELETE FROM EventoEmergencia WHERE (numTelefone = :delTelefone AND instanteChamada = :delDataaChamada);";

      $result = $db->prepare($sql);
      $result->execute([':delTelefone' => $delTelefone, ':delDataChamada' => $delDataChamada]);

      $db = null;

      header('Location: EE.html');
    }
  }
  catch (PDOException $e) {
    echo("<p>ERROR: {$e->getMessage()}</p>");
    header('Location: EE.html');
  }
?>

</body>

</html>
