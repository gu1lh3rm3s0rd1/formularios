<?php include 'conn.php'?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="10;">
    <link rel="stylesheet" href="style.css">
    <title>VISUALIZAÇÃO</title>
</head>

<header class="top auto ctr2">
        <img class="ctr2" src="img/logo-chiaperini.png" alt="img"><p class="white" style="margin-left: 10px; font-size: 1.2vw;">RELATÓRIO DE ORDEM DE<br> SERVIÇO MANUTENÇÃO</p>
</header>

<body>

<div class="mg"></div>

<br><br>

<table>
  <tr>
    <th colspan="8">MANUTENÇÃO CORRETIVA EMERGENCIAL</th>
  </tr>
  <tr class="topo-table">
    <th class="topow">Nº SOLICITAÇÃO</th>
    <th class="topow">Nº MÁQUINA</th>
    <th class="topow">EQUIPAMENTO</th>
    <th class="topow">SETOR</th>
    <th class="topow">TIPO</th>
    <th class="topow">PRIORIDADE</th>
    <th class="topow">STATUS</th>
    <th class="topow">DATA SOLICITAÇÃO</th>
  </tr>

  <?php
    try{
      //acessa o banco de dados
      $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                        
      $sql = "SELECT * FROM form_manut WHERE tipo_servico = 'CORRETIVA EMERGENCIAL' AND status NOT IN ('CONCLUIDA', 'CONCLUÍDA')";

      foreach($myPDO->query($sql)as $row){

      $num_solicit = $row['num_solicitacao'];
      $num_solicit = $row['num_solicitacao'];
      $tamanho = $row['num_solicitacao'];
      $tamanho = strlen($tamanho);

      if ($tamanho == 1){
        $num_solicit = '0000'.$num_solicit;

      }

      else if ($tamanho == 2){
          $num_solicit = '000'.$num_solicit;

      }

      else if ($tamanho == 3){
          $num_solicit = '00'.$num_solicit;

      }

      else if ($tamanho == 4){
          $num_solicit = '0'.$num_solicit;

      }
      $setor = $row['setor_solicitante'];
      $num_equipamento = $row['num_equipamento'];
      $equipamento = $row['nome_equipamento'];
      $status = $row['status'];
      $tipo = $row['tipo_servico'];
      $prioridade = $row['prioridade'];
      $dt_solicit = $row['data_solicitacao'];

      $dt_solicit = date("d-m-Y",strtotime($dt_solicit));
      $dt_solicit = str_replace('-', '/', $dt_solicit);
                       
     echo '<tr>';
     if ($status == 'NÃO CONCLUÍDA' or $status == 'NAO CONCLUIDA') {
      echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$num_solicit.'</td>';
      echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$num_equipamento.'</td>';
      echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$equipamento.'</td>';
      echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$setor.'</td>';
      echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$tipo.'</td>';
      echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$prioridade.'</td>';
      echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$status.'</td>';
      echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$dt_solicit.'</td>';
     }else {
      echo '<td class="andamento" style="padding: 10px 20px;">'.$num_solicit.'</td>';
     echo '<td class="andamento" style="padding: 10px 20px;">'.$num_equipamento.'</td>';
     echo '<td class="andamento" style="padding: 10px 20px;">'.$equipamento.'</td>';
     echo '<td class="andamento" style="padding: 10px 20px;">'.$setor.'</td>';
     echo '<td class="andamento" style="padding: 10px 20px;">'.$tipo.'</td>';
     echo '<td class="andamento" style="padding: 10px 20px;">'.$prioridade.'</td>';
     echo '<td class="andamento" style="padding: 10px 20px;">'.$status.'</td>';
     echo '<td class="andamento" style="padding: 10px 20px;">'.$dt_solicit.'</td>';
     }
      }
      echo '</tr>';
                                            
      }catch(PDOException $e){

        echo $e->getMEssage();
                                            
      }

    ?>
  
</table>


<br>
<br>
<br>
<table>
  <tr>
    <th colspan="8">MANUTENÇÃO PREVENTIVA PROGRAMADA</th>
  </tr>
  <tr class="topo-table">
  <th class="topow">Nº SOLICITAÇÃO</th>
    <th class="topow">Nº MÁQUINA</th>
    <th class="topow">EQUIPAMENTO</th>
    <th class="topow">SETOR</th>
    <th class="topow">TIPO</th>
    <th class="topow">PRIORIDADE</th>
    <th class="topow">STATUS</th>
    <th class="topow">DATA SOLICITAÇÃO</th>
  </tr>
  <tr>
  <?php
    try{
      //acessa o banco de dados
      $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                        
      $sql = "SELECT * FROM form_manut WHERE tipo_servico = 'PREVENTIVA PROGRAMADA' AND status NOT IN ('CONCLUIDA', 'CONCLUÍDA')";

      foreach($myPDO->query($sql)as $row){

      $num_solicit = $row['num_solicitacao'];
      $tamanho = $row['num_solicitacao'];
      $tamanho = strlen($tamanho);

      if ($tamanho == 1){
        $num_solicit = '0000'.$num_solicit;

      }

      else if ($tamanho == 2){
          $num_solicit = '000'.$num_solicit;

      }

      else if ($tamanho == 3){
          $num_solicit = '00'.$num_solicit;

      }

      else if ($tamanho == 4){
          $num_solicit = '0'.$num_solicit;

      }
      $setor = $row['setor_solicitante'];
      $num_equipamento = $row['num_equipamento'];
      $equipamento = $row['nome_equipamento'];
      $status = $row['status'];
      $tipo = $row['tipo_servico'];
      $prioridade = $row['prioridade'];
      $dt_solicit = $row['data_solicitacao'];

      $dt_solicit = date("d-m-Y",strtotime($dt_solicit));
      $dt_solicit = str_replace('-', '/', $dt_solicit);
                       
      echo '<tr>';
      if ($status == 'NÃO CONCLUÍDA' or $status == 'NAO CONCLUIDA') {
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$num_solicit.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$num_equipamento.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$equipamento.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$setor.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$tipo.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$prioridade.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$status.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$dt_solicit.'</td>';
      }else {
       echo '<td class="andamento" style="padding: 10px 20px;">'.$num_solicit.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$num_equipamento.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$equipamento.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$setor.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$tipo.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$prioridade.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$status.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$dt_solicit.'</td>';
      }
       echo '</tr>';

      }
                                            
      }catch(PDOException $e){

        echo $e->getMEssage();
                                            
      }

    ?>
</table>


<br>
<br>
<br>
<table>
  <tr>
    <th colspan="8">MELHORIAS</th>
  </tr>
  <tr class="topo-table">
  <th class="topow">Nº SOLICITAÇÃO</th>
    <th class="topow">Nº MÁQUINA</th>
    <th class="topow">EQUIPAMENTO</th>
    <th class="topow">SETOR</th>
    <th class="topow">TIPO</th>
    <th class="topow">PRIORIDADE</th>
    <th class="topow">STATUS</th>
    <th class="topow">DATA SOLICITAÇÃO</th>
  </tr>
  <?php
    try{
      //acessa o banco de dados
      $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                        
      $sql = "SELECT * FROM form_manut WHERE tipo_servico = 'MELHORIA' AND status NOT IN ('CONCLUIDA', 'CONCLUÍDA')";

      foreach($myPDO->query($sql)as $row){

      $num_solicit = $row['num_solicitacao'];
      $num_solicit = $row['num_solicitacao'];
      $tamanho = $row['num_solicitacao'];
      $tamanho = strlen($tamanho);

      if ($tamanho == 1){
        $num_solicit = '0000'.$num_solicit;

      }

      else if ($tamanho == 2){
          $num_solicit = '000'.$num_solicit;

      }

      else if ($tamanho == 3){
          $num_solicit = '00'.$num_solicit;

      }

      else if ($tamanho == 4){
          $num_solicit = '0'.$num_solicit;

      }
      $setor = $row['setor_solicitante'];
      $num_equipamento = $row['num_equipamento'];
      $equipamento = $row['nome_equipamento'];
      $status = $row['status'];
      $tipo = $row['tipo_servico'];
      $prioridade = $row['prioridade'];
      $dt_solicit = $row['data_solicitacao'];

      $dt_solicit = date("d-m-Y",strtotime($dt_solicit));
      $dt_solicit = str_replace('-', '/', $dt_solicit);
                       
      echo '<tr>';
      if ($status == 'NÃO CONCLUÍDA' or $status == 'NAO CONCLUIDA') {
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$num_solicit.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$num_equipamento.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$equipamento.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$setor.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$tipo.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$prioridade.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$status.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$dt_solicit.'</td>';
      }else {
       echo '<td class="andamento" style="padding: 10px 20px;">'.$num_solicit.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$num_equipamento.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$equipamento.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$setor.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$tipo.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$prioridade.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$status.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$dt_solicit.'</td>';
      }
       }
       echo '</tr>';
                                            
      }catch(PDOException $e){

        echo $e->getMEssage();
                                            
      }

    ?>
</table>


<br>
<br>
<br>
<table>
  <tr>
    <th colspan="8">PREDIAL</th>
  </tr>
  <tr class="topo-table">
  <th class="topow">Nº SOLICITAÇÃO</th>
    <th class="topow">Nº MÁQUINA</th>
    <th class="topow">EQUIPAMENTO</th>
    <th class="topow">SETOR</th>
    <th class="topow">TIPO</th>
    <th class="topow">PRIORIDADE</th>
    <th class="topow">STATUS</th>
    <th class="topow">DATA SOLICITAÇÃO</th>
  </tr>
  <?php
    try{
      //acessa o banco de dados
      $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                        
      $sql = "SELECT * FROM form_manut WHERE tipo_servico = 'PREDIAL' AND status NOT IN ('CONCLUIDA', 'CONCLUÍDA')";

      foreach($myPDO->query($sql)as $row){

      $num_solicit = $row['num_solicitacao'];
      $num_solicit = $row['num_solicitacao'];
      $tamanho = $row['num_solicitacao'];
      $tamanho = strlen($tamanho);

      if ($tamanho == 1){
        $num_solicit = '0000'.$num_solicit;

      }

      else if ($tamanho == 2){
          $num_solicit = '000'.$num_solicit;

      }

      else if ($tamanho == 3){
          $num_solicit = '00'.$num_solicit;

      }

      else if ($tamanho == 4){
          $num_solicit = '0'.$num_solicit;

      }
      $setor = $row['setor_solicitante'];
      $num_equipamento = $row['num_equipamento'];
      $equipamento = $row['nome_equipamento'];
      $status = $row['status'];
      $tipo = $row['tipo_servico'];
      $prioridade = $row['prioridade'];
      $dt_solicit = $row['data_solicitacao'];

      $dt_solicit = date("d-m-Y",strtotime($dt_solicit));
      $dt_solicit = str_replace('-', '/', $dt_solicit);
                       
      echo '<tr>';
      if ($status == 'NÃO CONCLUÍDA' or $status == 'NAO CONCLUIDA') {
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$num_solicit.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$num_equipamento.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$equipamento.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$setor.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$tipo.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$prioridade.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$status.'</td>';
       echo '<td class="naoconcluida" style="padding: 10px 20px;">'.$dt_solicit.'</td>';
      }else {
       echo '<td class="andamento" style="padding: 10px 20px;">'.$num_solicit.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$num_equipamento.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$equipamento.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$setor.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$tipo.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$prioridade.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$status.'</td>';
      echo '<td class="andamento" style="padding: 10px 20px;">'.$dt_solicit.'</td>';
      }
       }
       echo '</tr>';
                                            
      }catch(PDOException $e){

        echo $e->getMEssage();
                                            
      }

    ?>
</table>

<div class="none">


<div class="card-pizza align-text">
    <h1 class="title">SITUAÇÃO DAS ORDENS DE SERVIÇO</h1>
    <div class="flex">

            <div class="content-pizza">
                <p>EM ABERTO</p>
                    <div class="aberto-pizza">
                                10
                    </div>
            </div>

            <div class="content-pizza">
                <p>CONCLUÍDA</p>
                    <div class="concluida-pizza">
                                37
                    </div>
            </div>
    </div>
    <br>
    <label class="comum">SITUAÇÃO DAS ORDENS DE SERVIÇO</label>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['CONCLUÍDA', 'EM ABERTO'],
          ['CONCLUÍDA',     37],
          ['EM ABERTO',    10]
        ]);

        var options = {
          colors: ['rgb(120, 218, 84)', 'rgb(255, 119, 119)'],
          is3D: true,
          backgroundColor: 'transparent',
          legend: {position: 'bottom', maxLines: 3},
        }

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
 
 <div id="piechart_3d" class="pizza-hummm"></div>

</div>

</div>

</body>
</html>