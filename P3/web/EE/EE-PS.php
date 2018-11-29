<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>P3-BD</title>
</head>

<body>
<?php
  $editPS = $_REQUEST["editPS"];
  $oldTelefone = $_REQUEST["oldTelefone"];
  $oldTempo = $_REQUEST["oldTempo"];

  try{
    if ($editPS && $oldTelefone && $oldTempo){
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "UPDATE EventoEmergencia SET numprocessosocorro=:editPS WHERE numtelefone=:oldTelefone AND instantechamada=:oldTempo;";

      $result = $db->prepare($sql);
      $result->execute([":editPS" => $editPS, ":oldTelefone" => $oldTelefone, ":oldTempo" => $oldTempo]);

      $db = null;
    }
    header('Location: EE.html');
  }
  catch (PDOException $e) {
    echo("<p>ERROR: {$e->getMessage()}</p>");
    header('Location: EE.html');
  }
?>
</body>

</html>
