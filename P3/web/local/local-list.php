<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>P3-BD</title>
</head>

<body>
  <h1>Bases de Dados - 3º Projeto</h1>

  <h2>Locais</h2>

  <h4><a href="local.html">Voltar para trás.</a></h4>

  <?php
    try{
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT * FROM Local;";

      $result = $db->prepare($sql);
      $result->execute();

      echo("<p>Lista com Todos os Locais: </p>");
      echo("<ul>");
      foreach($result as $row) {
        echo("<li>{$row['moradalocal']}</li>");
      }
      echo("</ul>");
      $db = null;
    }
    catch (PDOException $e) {
        echo("<p>ERROR: {$e->getMessage()}</p>");
    }
  ?>

</body>

</html>
