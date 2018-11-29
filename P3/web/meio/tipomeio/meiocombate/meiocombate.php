<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>P3-BD</title>
</head>

<body>
<?php
  $newCombateNumMeio = $_REQUEST["newCombateNumMeio"];
  $newCombateEntidade = $_REQUEST["newCombateEntidade"];

  $delCombateNumMeio = $_REQUEST["delCombateNumMeio"];
  $delCombateEntidade = $_REQUEST["delCombateEntidade"];

  $oldEditCombateNumMeio = $_REQUEST["oldEditCombateNumMeio"];
  $oldEditCombateEntidade = $_REQUEST["oldEditCombateEntidade"];
  $newEditCombateNumMeio = $_REQUEST["newEditCombateNumMeio"];
  $newEditCombateEntidade = $_REQUEST["newEditCombateEntidade"];

  try{
    if ($newCombateNumMeio && $newCombateEntidade){
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "INSERT INTO MeioCombate VALUES (:newCombateNumMeio, :newCombateEntidade);";

      $result = $db->prepare($sql);
      $result->execute([':newCombateNumMeio' => $newCombateNumMeio,':newCombateEntidade' =>$newCombateEntidade]);

      $db = null;
    }
    if ($delCombateNumMeio && $delCombateEntidade){
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "DELETE FROM MeioCombate WHERE (nummeio = (:delCombateNumMeio) AND nomeentidade = (:delCombateEntidade));";

      $result = $db->prepare($sql);
      $result->execute([':delCombateNumMeio' => $delCombateNumMeio, ':delCombateEntidade' =>$delCombateEntidade]);

      $db = null;
    }
    if ($oldEditCombateNumMeio && $oldEditCombateEntidade && $newEditCombateNumMeio && $newEditCombateEntidade) { #editar o meio todo
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "UPDATE Meio SET nomeentidade=:newEditCombateEntidade WHERE nummeio=:oldEditCombateNumMeio AND nomeentidade=:oldEditCombateEntidade;";

      $result = $db->prepare($sql);
      $result->execute([ ':newEditCombateEntidade' =>$newEditCombateEntidade,':oldEditCombateNumMeio' =>$oldEditCombateNumMeio,':oldEditCombateEntidade' =>$oldEditCombateEntidade]);

      $sql = "UPDATE Meio SET nummeio=:newEditCombateNumMeio WHERE nummeio=:oldEditCombateNumMeio AND nomeentidade=:newEditCombateEntidade;";

      $result = $db->prepare($sql);
      $result->execute([ ':newEditCombateEntidade' =>$newEditCombateEntidade,':oldEditCombateNumMeio' =>$oldEditCombateNumMeio,':newEditCombateNumMeio' =>$newEditCombateNumMeio]);

      $db = null;
    }
    else if ($oldEditCombateNumMeio && $oldEditCombateEntidade && $newEditCombateEntidade) { #editar so o nomeentidade
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "UPDATE Meio SET nomeentidade=:newEditCombateEntidade WHERE nummeio=:oldEditCombateNumMeio AND nomeentidade=:oldEditCombateEntidade;";

      $result = $db->prepare($sql);
      $result->execute([ ':newEditCombateEntidade' =>$newEditCombateEntidade,':oldEditCombateNumMeio' =>$oldEditCombateNumMeio,':oldEditCombateEntidade' =>$oldEditCombateEntidade]);

      $db = null;
    }
    else if ($oldEditCombateNumMeio && $oldEditCombateEntidade && $newEditCombateNumMeio) { #editar so o nummeio
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "UPDATE Meio SET nummeio=:newEditCombateNumMeio WHERE nummeio=:oldEditCombateNumMeio AND nomeentidade=:oldEditCombateEntidade;";

      $result = $db->prepare($sql);
      $result->execute([ ':newEditCombateNumMeio' =>$newEditCombateNumMeio,':oldEditCombateNumMeio' =>$oldEditCombateNumMeio,':oldEditCombateEntidade' =>$oldEditCombateEntidade]);

      $db = null;
    }
    header('Location: meiocombate.html');
  }
  catch (PDOException $e) {
    echo("<p>ERROR: {$e->getMessage()}</p>");
    header('Location: meiocombate.html');
  }
?>

</body>

</html>
