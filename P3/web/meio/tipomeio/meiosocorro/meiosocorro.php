<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>P3-BD</title>
</head>

<body>
<?php
  $newSocorroNumMeio = $_REQUEST["newSocorroNumMeio"];
  $newSocorroEntidade = $_REQUEST["newSocorroEntidade"];

  $delSocorroNumMeio = $_REQUEST["delSocorroNumMeio"];
  $delSocorroEntidade = $_REQUEST["delSocorroEntidade"];

  $oldEditSocorroNumMeio = $_REQUEST["oldEditSocorroNumMeio"];
  $oldEditSocorroEntidade = $_REQUEST["oldEditSocorroEntidade"];
  $newEditSocorroNumMeio = $_REQUEST["newEditSocorroNumMeio"];
  $newEditSocorroEntidade = $_REQUEST["newEditSocorroEntidade"];

  try{
    if ($newSocorroNumMeio && $newSocorroEntidade){
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "INSERT INTO MeioSocorro VALUES (:newSocorroNumMeio, :newSocorroEntidade);";

      $result = $db->prepare($sql);
      $result->execute([':newSocorroNumMeio' => $newSocorroNumMeio,':newSocorroEntidade' =>$newSocorroEntidade]);

      $db = null;
    }
    if ($delSocorroNumMeio && $delSocorroEntidade){
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "DELETE FROM MeioSocorro WHERE (nummeio = (:delSocorroNumMeio) AND nomeentidade = (:delSocorroEntidade));";

      $result = $db->prepare($sql);
      $result->execute([':delSocorroNumMeio' => $delSocorroNumMeio, ':delSocorroEntidade' =>$delSocorroEntidade]);

      $db = null;
    }
    if ($oldEditSocorroNumMeio && $oldEditSocorroEntidade && $newEditSocorroNumMeio && $newEditSocorroEntidade) { #editar o meio todo
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "UPDATE Meio SET nomeentidade=:newEditSocorroEntidade WHERE nummeio=:oldEditSocorroNumMeio AND nomeentidade=:oldEditSocorroEntidade;";

      $result = $db->prepare($sql);
      $result->execute([ ':newEditSocorroEntidade' =>$newEditSocorroEntidade,':oldEditSocorroNumMeio' =>$oldEditSocorroNumMeio,':oldEditSocorroEntidade' =>$oldEditSocorroEntidade]);

      $sql = "UPDATE Meio SET nummeio=:newEditSocorroNumMeio WHERE nummeio=:oldEditSocorroNumMeio AND nomeentidade=:newEditSocorroEntidade;";

      $result = $db->prepare($sql);
      $result->execute([ ':newEditSocorroEntidade' =>$newEditSocorroEntidade,':oldEditSocorroNumMeio' =>$oldEditSocorroNumMeio,':newEditSocorroNumMeio' =>$newEditSocorroNumMeio]);

      $db = null;
    }
    else if ($oldEditSocorroNumMeio && $oldEditSocorroEntidade && $newEditSocorroEntidade) { #editar so o nomeentidade
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "UPDATE Meio SET nomeentidade=:newEditSocorroEntidade WHERE nummeio=:oldEditSocorroNumMeio AND nomeentidade=:oldEditSocorroEntidade;";

      $result = $db->prepare($sql);
      $result->execute([ ':newEditSocorroEntidade' =>$newEditSocorroEntidade,':oldEditSocorroNumMeio' =>$oldEditSocorroNumMeio,':oldEditSocorroEntidade' =>$oldEditSocorroEntidade]);

      $db = null;
    }
    else if ($oldEditSocorroNumMeio && $oldEditSocorroEntidade && $newEditSocorroNumMeio) { #editar so o nummeio
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "UPDATE Meio SET nummeio=:newEditSocorroNumMeio WHERE nummeio=:oldEditSocorroNumMeio AND nomeentidade=:oldEditSocorroEntidade;";

      $result = $db->prepare($sql);
      $result->execute([ ':newEditSocorroNumMeio' =>$newEditSocorroNumMeio,':oldEditSocorroNumMeio' =>$oldEditSocorroNumMeio,':oldEditSocorroEntidade' =>$oldEditSocorroEntidade]);

      $db = null;
    }
      header('Location: meiosocorro.html');
  }

  catch (PDOException $e) {
    echo("<p>ERROR: {$e->getMessage()}</p>");
    header('Location: meiosocorro.html');
  }
?>

</body>

</html>
