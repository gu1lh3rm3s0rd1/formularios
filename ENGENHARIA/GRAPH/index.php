<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5 /FORMS/FERRAMENTARIA/GRAPH/index.php">
    <link rel="stylesheet" href="estilo.css">
    <title>VISUALIZAÇÃO</title>
</head>

<header class="top auto ctr2">
        <img class="ctr2" src="img/logo-chiaperini.png" alt="img"><p class="white" style="margin-left: 10px; font-size: 1.5vw;">RELATÓRIO DE ORDEM DE SERVIÇO ENGENHARIA</p>
</header>

<body>
<div class="mg"></div>

<table>

  <tr class="topo-table">
    <th class="topow">Nº SOLICITAÇÃO</th>
    <!--th-- class="topow">Nº MÁQUINA</!--th-->
    <th class="topow">SETOR</th>
    <th class="topow">TIPO</th>
    <th class="topow">EXECUTANTE</th>
    <th class="topow">DATA SOLICITAÇÃO</th>
    <th class="topow">TEMPO</th>
  </tr>
 
  <?php
    try{
      //acessa o banco de dados
      $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                        
      $sql = "SELECT 
      num_solicitacao, 
      nome_executante, 
      setor_solicitante,
      tipo_servico, 
      to_char(data_solicitacao, 'DD/MM/YYYY') as data_solicitacao, 
      CASE WHEN data_fechamento IS NULL THEN 'ABERTA' ELSE 'EM EXECUCAO' END as status, CONCAT((CURRENT_DATE - data_solicitacao), ' DIAS') as tempo
      FROM form_eng
      WHERE data_fechamento IS NULL
      ORDER BY num_solicitacao DESC";

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
      //$num_equipamento = $row['num_equipamento'];
      $status = $row['status'];
      $tipo = $row['tipo_servico'];
      $exec = $row['nome_executante'];
      $dt_solicit = $row['data_solicitacao'];
      $tempo = $row['tempo'];
                       
     echo '<tr>';
     if ($status == 'ABERTA') {
        echo '<td class="andamento" style="padding: 10px 0px;">'.$num_solicit.'</td>';
        //echo '<td class="naoconcluida">'.$num_equipamento.'</td>';
        echo '<td class="andamento" style="padding: 10px 10px;">'.$setor.'</td>';
        echo '<td class="andamento" style="padding: 10px 10px;">'.$tipo.'</td>';
        echo '<td class="andamento" style="padding: 10px 10px;">'.$exec.'</td>';
        echo '<td class="andamento" style="padding: 10px 0px;">'.$dt_solicit.'</td>';
        echo '<td class="andamento" style="padding: 10px 0px;">'.$tempo.'</td>';

     }else {
        echo '<td class="andamento" style="padding: 10px 0px;">'.$num_solicit.'</td>';
      //echo '<td class="andamento">'.$num_equipamento.'</td>';
      echo '<td class="andamento" style="padding: 10px 10px;">'.$setor.'</td>';
      echo '<td class="andamento" style="padding: 10px 10px;">'.$tipo.'</td>';
      echo '<td class="andamento" style="padding: 10px 10px;">'.$exec.'</td>';
      echo '<td class="andamento" style="padding: 10px 0px;">'.$dt_solicit.'</td>';
      echo '<td class="andamento" style="padding: 10px 0px;">'.$tempo.'</td>';

      }
      }
      echo '</tr>';
                                            
      }catch(PDOException $e){

        echo $e->getMEssage();
                                            
      }

    ?>

</table>

</body>
</html>