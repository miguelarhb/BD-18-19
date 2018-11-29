<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>P3-BD</title>
</head>

<body>
  <h1>Bases de Dados - 3º Projeto</h1>

  <h2>Locais - PS - Meios de Socorro </h2>

  <h4><a href="local.html">Voltar para trás.</a></h4>

  <?php
    $findLocal = $_REQUEST["findLocal"];
    try{
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT distinct nummeio,nomemeio,nomeentidade FROM EventoEmergencia NATURAL JOIN Acciona NATURAL JOIN Meio NATURAL JOIN MeioSocorro WHERE moradalocal=:findLocal;";

      $result = $db->prepare($sql);
      $result->execute([':findLocal' => $findLocal]);

      echo("<p>Lista com os meios de Socorro acionados em Processos de Socorro originados no Local de incêndio escolhido: </p>");
      echo("<table>");
      echo("<tr>");
        echo("<th>ID do Meio</th>");
        echo("<th>Nome do Meio</th>");
        echo("<th>Nome da Entidade </th>");
      echo("</tr>");
      foreach($result as $row) {
        echo("<tr>");
          echo("<td> {$row['nummeio']} </td>");
          echo("<td> {$row['nomemeio']} </td>");
          echo("<td> {$row['nomeentidade']} </td>");
        echo("</tr>");
      }
      echo("</table>");
      $db = null;
    }
    catch (PDOException $e) {
      echo("<p>ERROR: {$e->getMessage()}</p>");
    }
  ?>

</body>
</html>