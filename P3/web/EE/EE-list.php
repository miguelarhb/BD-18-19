<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>P3-BD</title>
</head>

<body>
  <h1>Bases de Dados - 3º Projeto</h1>

  <h2>Eventos de Emergencia</h2>

  <h4><a href="EE.html">Voltar para trás.</a></h4>

  <?php
    try{
      $host = "db.ist.utl.pt";
      $user ="ist186481";
      $password = "sopa";
      $dbname = $user;

      $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $sql = "SELECT * FROM EventoEmergencia;";

      $result = $db->prepare($sql);
      $result->execute();

      echo("<p>Lista com Todos os Processos de Socorro: </p>");
      echo("<table>");
      echo("<tr>");
        echo("<th>Numero de Telefone </th>");
        echo("<th>Instante da Chamada </th>");
        echo("<th>Nome da Pessoa </th>");
        echo("<th>Morada Local </th>");
        echo("<th>Numero do Processo de Socorro </th>");
      echo("</tr>");
      foreach($result as $row) {
        echo("<tr>");
          echo("<td> {$row['numtelefone']} </td>");
          echo("<td> {$row['instantechamada']} </td>");
          echo("<td> {$row['nomepessoa']} </td>");
          echo("<td> {$row['moradalocal']} </td>");
          echo("<td> {$row['numprocessosocorro']} </td>");
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
