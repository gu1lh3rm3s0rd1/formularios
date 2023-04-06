<?php include 'conn.php'?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="1;">
    <link rel="stylesheet" href="style.css">
    <title>VISUALIZAÇÃO</title>
</head>

<body>
<main class="flex">

<div class="topo">
  <br><br><br><br><br><br>
<p class="white" style="font-size: 1.2vw; ">RELATÓRIO DE ORDEM DE SERVIÇO MANUTENÇÃO</p>
<img class="imagem" src="img/logo-chiaperini.png" alt="img">
</div>

<table>

<tr>
    <th><p class="rotate">Nº SOLICITAÇÃO</p></th>
  </tr>
  <tr>
    <th><p class="rotate">Nº MÁQUINA</th>
  </tr>
  <tr>
    <th><p class="rotate">EQUIPAMENTO</th>
  </tr>
  <tr>
    <th><p class="rotate">SETOR</th>
  </tr>
  <tr>
    <th><p class="rotate">TIPO</th>
  </tr>
  <tr>
    <th><p class="rotate">PRIORIDADE</th>
  </tr>
  <tr>
    <th><p class="rotate">STATUS</th>
  </tr>
  <tr>
    <th><p class="rotate">DATA SOLICITAÇÃO</th>
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
</main>
</body>
</html>
