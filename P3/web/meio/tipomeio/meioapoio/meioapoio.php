<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>P3-BD</title>
</head>

<body>
<?php
  $newApoioNumMeio = $_REQUEST["newApoioNumMeio"];
  $newApoioEntidade = $_REQUEST["newApoioEntidade"];

  $delApoioNumMeio = $_REQUEST["delApoioNumMeio"];
  $delApoioEntidade = $_REQUEST["delApoioEntidade"];

  $oldEditApoioNumMeio = $_REQUEST["oldEditApoioNumMeio"];
  $oldEditApoioEntidade = $_REQUEST["oldEditApoioEntidade"];
  $newEditApoioNumMeio = $_REQUEST["newEditApoioNumMeio"];
  $newEditApoioEntidade = $_REQUEST["newEditApoioEntidade"];

  try{
    if ($newApoioNumMeio && $newApoioEntidade){
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "INSERT INTO MeioApoio VALUES (:newApoioNumMeio, :newApoioEntidade);";

      $result = $db->prepare($sql);
      $result->execute([':newApoioNumMeio' => $newApoioNumMeio,':newApoioEntidade' =>$newApoioEntidade]);

      $db = null;
    }
    if ($delApoioNumMeio && $delApoioEntidade){
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "DELETE FROM MeioApoio WHERE (nummeio = (:delApoioNumMeio) AND nomeentidade = (:delApoioEntidade));";

      $result = $db->prepare($sql);
      $result->execute([':delApoioNumMeio' => $delApoioNumMeio, ':delApoioEntidade' =>$delApoioEntidade]);

      $db = null;
    }
    if ($oldEditApoioNumMeio && $oldEditApoioEntidade && $newEditApoioNumMeio && $newEditApoioEntidade) {
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "UPDATE Meio SET nomeentidade=:newEditApoioEntidade WHERE nummeio=:oldEditApoioNumMeio AND nomeentidade=:oldEditApoioEntidade;";

      $result = $db->prepare($sql);
      $result->execute([ ':newEditApoioEntidade' =>$newEditApoioEntidade,':oldEditApoioNumMeio' =>$oldEditApoioNumMeio,':oldEditApoioEntidade' =>$oldEditApoioEntidade]);

      $sql = "UPDATE Meio SET nummeio=:newEditApoioNumMeio WHERE nummeio=:oldEditApoioNumMeio AND nomeentidade=:newEditApoioEntidade;";

      $result = $db->prepare($sql);
      $result->execute([ ':newEditApoioEntidade' =>$newEditApoioEntidade,':oldEditApoioNumMeio' =>$oldEditApoioNumMeio,':newEditApoioNumMeio' =>$newEditApoioNumMeio]);

      $db = null;
    }
    else if ($oldEditApoioNumMeio && $oldEditApoioEntidade && $newEditApoioEntidade) {
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "UPDATE Meio SET nomeentidade=:newEditApoioEntidade WHERE nummeio=:oldEditApoioNumMeio AND nomeentidade=:oldEditApoioEntidade;";

      $result = $db->prepare($sql);
      $result->execute([ ':newEditApoioEntidade' =>$newEditApoioEntidade,':oldEditApoioNumMeio' =>$oldEditApoioNumMeio,':oldEditApoioEntidade' =>$oldEditApoioEntidade]);

      $db = null;
    }
    else if ($oldEditApoioNumMeio && $oldEditApoioEntidade && $newEditApoioNumMeio) {
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "UPDATE Meio SET nummeio=:newEditApoioNumMeio WHERE nummeio=:oldEditApoioNumMeio AND nomeentidade=:oldEditApoioEntidade;";

      $result = $db->prepare($sql);
      $result->execute([ ':newEditApoioNumMeio' =>$newEditApoioNumMeio,':oldEditApoioNumMeio' =>$oldEditApoioNumMeio,':oldEditApoioEntidade' =>$oldEditApoioEntidade]);

      $db = null;
    }
    header('Location: meioapoio.html');
  }
  catch (PDOException $e) {
    echo("<p>ERROR: {$e->getMessage()}</p>");
    header('Location: meioapoio.html');
  }
?>

</body>

</html>
