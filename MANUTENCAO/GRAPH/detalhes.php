<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="1;">
    <link rel="stylesheet" href="dsgr.css">
    <title>VISUALIZAÇÃO</title>

<header class="top auto ctr2">
        <img class="ctr2" src="img/logo-chiaperini.png" alt="img">
        <p class="white" style="margin-left: 10px; font-size: 1.2vw;">RELATÓRIO DE ORDEM DE SERVIÇO MANUTENÇÃO</p>
</header>

</head>

<body>

<!-- espaço entre a faixa azul e os paineis -->
  <div class="mg2"></div>

  <!-- alinhamento de elemento lado a lado para posicionar os 2 primeiros paineis -->
  <main class="flex">


<!--1° PAINEL ------------------------------------------------------------------------------------------------------>

    <div class="card-pizza align-text">
        <h1 class="title">SITUAÇÃO DAS ORDENS DE SERVIÇO</h1>

        <div class="flex">

          <div class="content-pizza">
            <p class="fonte">EM ABERTO</p>
            <div class="aberto-pizza">

              <!-- mostra o número de solicitações em aberto -->
              <?php

                    try{
                      //acessa o banco de dados
                      $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                                        
                      $sql = "SELECT count(*) as linhas FROM form_manut
                      WHERE data_fechamento IS NULL";

                      foreach($myPDO->query($sql)as $row){

                      $aberto = $row['linhas'];
                      echo $aberto;
                      }
                                                            
                      }catch(PDOException $e){

                        echo $e->getMEssage();
                                                            
                      }

                ?>

              </div>
            </div>

            <div class="content-pizza">
              <p class="fonte">CONCLUÍDA</p>
                <div class="concluida-pizza">

                  <!-- mostra o número de solicitações concluídas -->
                  <?php

                        try{
                          //acessa o banco de dados
                          $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                                            
                          $sql = "SELECT count(*) as linhas FROM form_manut
                          WHERE data_fechamento IS NOT NULL";

                          foreach($myPDO->query($sql)as $row){

                          $concluida = $row['linhas'];
                          echo $concluida;
                          }
                                                                
                          }catch(PDOException $e){

                            echo $e->getMEssage();
                                                                
                          }

                    ?>

                  </div>
                </div>
              </div>

            <br>

        <!-- implementação do gráfico com JavaScript -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
          google.charts.load("current", {packages:["corechart"]});
          google.charts.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['CONCLUÍDA', 'EM ABERTO'],
              ['CONCLUÍDA',    <?php echo $concluida; ?>],
              ['EM ABERTO',    <?php echo $aberto; ?>]
            ]);

            var options = {
              colors: ['rgb(120, 218, 84)', 'rgb(255, 119, 119)'],
              is3D: true,
              backgroundColor: 'transparent',
              legend: 'none'
            }

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
          }
        </script>
    
    <!-- div com id do gráfico para exibição -->
    <div id="piechart_3d" class="pizza-hummm"></div>

  </div>

</div>

<!------------------------------------------------------------------------------------------------------------------->





<!--2° PAINEL ------------------------------------------------------------------------------------------------------>
    
    <div class="card-bar align-text">
        <h1 class="title2">ANÁLISE DOS TIPOS DE SERVIÇO</h1>
        <div class="flex">

            <?php

                  try{
                    //acessa o banco de dados
                    $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                          
                    //$sql = "SELECT count(*) as linhas FROM form_serv WHERE painel = 'MAN'";

                    $sql = "SELECT tipo_servico2, count(*) AS qnt
                    FROM form_manut
                    GROUP BY tipo_servico2
                    HAVING count(*) > 1
                    ORDER BY tipo_servico2";

                    $i = 0;

                    foreach($myPDO->query($sql)as $row){

                      $i = $i + 1;

                    $c = $row['0'];

                    $o = '<div class="content-bar">
                            <p class="fonte">'.$c.'</p>
                          </div>';

                    echo $o;

                    

                    }
                                      
                    }catch(PDOException $e){
                      echo $e->getMEssage();                                 
                    }

            ?>

        </div>

        <div class="flex">

            <?php

                  try{
                    //acessa o banco de dados
                    $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                          
                    //$sql = "SELECT count(*) as linhas FROM form_serv WHERE painel = 'MAN'";

                    $sql = "SELECT tipo_servico2, count(*) AS qnt
                    FROM form_manut
                    GROUP BY tipo_servico2
                    HAVING count(*) > 1
                    ORDER BY tipo_servico2";

                    $i = 0;

                    foreach($myPDO->query($sql)as $row){

                      $i = $i + 1;

                    $c = $row['1'];

                    $corretiva_eletrica = $row['tipo_servico2'];
                    $o = '<div class="cor'.$i.'">'.$c.'</div>';
                    echo $o;

                    }
                                      
                    }catch(PDOException $e){
                      echo $e->getMEssage();                                 
                    }

            ?>

  </div>

        <br>

      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ["TIPO", "QUANTIDADE", { role: "style" } ],


            <?php

              try{
                //acessa o banco de dados
                $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                      
                //$sql = "SELECT count(*) as linhas FROM form_serv WHERE painel = 'MAN'";

                $sql = "SELECT tipo_servico2, count(*) AS qnt
                FROM form_manut
                GROUP BY tipo_servico2
                HAVING count(*) > 1
                ORDER BY tipo_servico2";

                $j = 0;

                foreach($myPDO->query($sql)as $row){

                $nome = $row['0'];
                $qnt = $row['1'];

                $j = $j + 1;

                switch ($j) {
                  case 1:
                      $i = 'rgb(84, 218, 200)';
                      break;
                  case 2:
                    $i = 'rgb(230, 233, 84)';
                      break;
                  case 3:
                      $i = 'rgb(255, 187, 97)';
                      break;
                  case 4:
                      $i = 'rgb(155, 255, 97)';
                      break;
                  case 5:
                      $i = 'rgb(239, 117, 255)';
                      break;
                  case 6:
                      $i = 'rgb(255, 119, 119)';
                      break;
                  case 7:
                      $i = 'rgb(84, 218, 200)';
                      break;
                  case 8:
                      $i = 'rgb(230, 233, 84)';
                      break;
                  case 9:
                      $i = 'rgb(255, 187, 97)';
                      break;
                  case 10:
                      $i = 'rgb(155, 255, 97)';
                      break;
                  case 11:
                      $i = 'rgb(239, 117, 255)';
                      break;
                  case 12:
                      $i = 'rgb(255, 119, 119)';
                      break;
              }

                echo '["'.$nome.'", '.$qnt.', "'.$i.'"],';

                }
                                  
                }catch(PDOException $e){
                  echo $e->getMEssage();                                 
                }

              ?>

          ]);

          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                          { calc: "stringify",
                            sourceColumn: 1,
                            type: "string",
                            role: "annotation" },
                          2]);

          var options = {
            backgroundColor: 'transparent',
            bar: {groupWidth: "45%"},
            legend: { position: "none" },
            annotations: {
                        alwaysOutside: true,
                        style: 'point',
                        textStyle: {
                            fontSize: 20,
                            color: 'black',
                            //auraColor: 'red'
                        }
                    },
            vAxis: {
                    ticks: [{v:0, f:''}],
                    gridlines: {
                      count: 0
                    }
                    }
          };
          var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
          chart.draw(view, options);
      }
      </script>
    <div id="columnchart_values"></div>

  </div>

</div>

</main>
<!------------------------------------------------------------------------------------------------------------------->



<!--3° PAINEL ------------------------------------------------------------------------------------------------------>
<main class="flex mer">

  <div class="card-bar2 align-text">
      <h1 class="title2">ANÁLISE DE ORDENS DE SERVIÇO POR SETORES</h1>
 
      <div class="flex">

<?php

  try{
    //acessa o banco de dados
    $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                      
    $sql = "SELECT setor_solicitante,COUNT(num_solicitacao)
    FROM form_manut
    GROUP BY setor_solicitante
    ORDER BY COUNT(num_solicitacao) DESC";

    $i = 0;

    foreach($myPDO->query($sql)as $row){

      $i = $i + 1;

    $setor = $row['0'];
    $qnt = $row['1'];

    echo '<div class="inline">';

    echo '<div class="content-bar2">
              <p class="fonte3">'.$setor.'</p>
          </div>';

    echo '<div class="content-bar3 oncor'.$i.'">
              <p class="fonte4">'.$qnt.'</p>
          </div>';

    echo '<br></div>';

    }
                                          
    }catch(PDOException $e){
      echo $e->getMEssage();           
    }

?>

</div>

      <br>

      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
      google.charts.load("current", {packages:['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ["TIPO", "QUANTIDADE", { role: "style" } ],
          
          <?php

try{
  //acessa o banco de dados
  $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
        
  //$sql = "SELECT count(*) as linhas FROM form_serv WHERE painel = 'MAN'";

  $sql = "SELECT setor_solicitante,COUNT(num_solicitacao)
                FROM form_manut
                GROUP BY setor_solicitante
                ORDER BY COUNT(num_solicitacao) DESC";

  $j = 0;

  foreach($myPDO->query($sql)as $row){

  $nome = $row['0'];
  $qnt = $row['1'];

  $j = $j + 1;

  switch ($j) {
    case 1:
        $i = 'rgb(73, 89, 235)';
        break;
    case 2:
      $i = 'rgb(106, 155, 42)';
        break;
    case 3:
        $i = 'rgb(194, 110, 0)';
        break;
    case 4:
        $i = 'rgb(129, 65, 167)';
        break;
    case 5:
        $i = 'rgb(214, 42, 42)';
        break;
    case 6:
        $i = 'rgb(1, 168, 76)';
        break;
    case 7:
        $i = 'rgb(126, 126, 126)';
        break;
    case 8:
        $i = 'rgb(204, 19, 133)';
        break;
    case 9:
        $i = 'rgb(197, 89, 39)';
        break;
    case 10:
        $i = 'rgb(63, 165, 4)';
        break;
    case 11:
        $i = 'rgb(153, 0, 102)';
        break;
    case 12:
        $i = 'rgb(142, 145, 0)';
        break;
    case 13:
        $i = 'rgb(29, 55, 175)';
        break;
    case 14:
        $i = 'rgb(255, 72, 179)';
        break;
    case 15:
        $i = 'rgb(0, 172, 202)';
        break;
    case 16:
        $i = 'rgb(0, 175, 152)';
        break;
    case 17:
        $i = 'rgb(168, 0, 184)';
        break;
    case 18:
        $i = 'rgb(192, 0, 80)';
        break;
    case 19:
        $i = 'rgb(180, 96, 0)';
        break;
    case 20:
        $i = 'rgb(76, 150, 42)';
        break;
    case 21:
        $i = 'rgb(150, 42, 145)';
        break;
    case 22:
        $i = 'rgb(143, 150, 42)';
        break;
    case 23:
        $i = 'rgb(42, 150, 136)';
        break;
    case 24:
        $i = 'rgb(150, 42, 42)';
        break;
    case 25:
        $i = 'rgb(55, 150, 42)';
        break;
    case 26:
        $i = 'rgb(150, 107, 42)';
        break;
    case 27:
        $i = 'rgb(132, 42, 150)';
        break;
    case 28:
        $i = 'rgb(42, 76, 150)';
        break;
    case 29:
        $i = 'rgb(139, 150, 42)';
        break;
    case 30:
        $i = 'rgb(76, 150, 42)';
        break;             
                                                                        
}

  echo '["'.$nome.'", '.$qnt.', "'.$i.'"],';

  }
                    
  }catch(PDOException $e){
    echo $e->getMEssage();                                 
  }

?>
          
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
                        { calc: "stringify",
                          sourceColumn: 1,
                          type: "string",
                          role: "annotation" },
                        2]);

        var options = {
          fontSize: 10,
          backgroundColor: 'transparent',
          bar: {groupWidth: "20%"},
          legend: 'none',
          annotations: {
                      alwaysOutside: true,
                      style: 'point',
                      textStyle: {
                        fontSize: 20,
                        color: 'black',
                        //auraColor: 'red'
                    }
                  },
          vAxis: {
                  ticks: [{v:0, f:''}],
                  textStyle: {
                          color: 'black',
                          //auraColor: 'red'
                      },
                  gridlines: {
                    count: 0
                  }
                  }
                  //vAxis: {
                  //      ticks: [{v:0, f:'R$1 M'}, {v:4, f:'R$4 M'}, {v:8, f:'R$8 M'}, {v:12, f:'R$12 M'}, {v:16, f:'R$16 M'}, {v:20, f:'R$20 M'}],
                    //    textStyle: {
                      //  color: 'black'
                   // }
                   // }

        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values2"));
        chart.draw(view, options);
    }
    </script>

      <div id="columnchart_values2"></div>

    </div>

  </div>

</main>
<!------------------------------------------------------------------------------------------------------------------->
</body>
</html>