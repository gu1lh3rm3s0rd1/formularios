<?php 
    //Variáveis que coletam a data e hora atuais
    $hoje = date('d/m/Y'); date_default_timezone_set('America/Sao_Paulo');
    $time = date('H:i'); 

    //Inicia a sessão conferindo se o usuário fez login
    session_start(); 
    if (!isset($_SESSION['logon']) or $_SESSION['logon'] == 0 or !isset($_SESSION['adm'])){
      header("Location: /FORMS/login/index.php");
      
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ORDEM DE SERVIÇO</title>

     <!-- lib´s bootstrap/javascript -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script language=javascript>
      function confirmacao(){
        if (confirm("Deseja mesmo sair? Sua sessão será desconectada."))
            window.location.href = "/FORMS/login/index.php";
      }

    </script>
    <!-- Faixa azul e logo no topo -->
    <header class="top auto ctr2">
        <img class="ctr2" src="img/logo-chiaperini.png" alt="img"><p class="white" style="margin-left: 10px; font-size: 25px;">RELATÓRIO DE ORDEM DE<br> SERVIÇO MARKETING</p>
    </header>
</head>
<body class="consulta" style="background-color: #d8d8d8; ">

    <!-- card da pagina ordem.php - mostra caixa onde sao exibidos todas as ordens de serviço que foram solicitadas -->
    <div class="cardd" >
      <p>ORDEM DE SERVIÇO EM ANDAMENTO</p>
<br>

      <form method="get" class="scroll">
        <table>
          <tr class="titulico">
              <th style="padding: 10px 20px;">NUMERO SOLICITAÇÃO</th>
              <th style="padding: 10px;">DATA</th>
              <th style="padding: 10px;">SOLICITANTE</th>
              <th style="padding: 10px;">EXECUTANTE</th>
              <th style="padding: 10px 20px;">FINALIZADA</th>
          </tr>
          <?php
              $x = 0;

              try{
                  $func = $_SESSION['funcionario'];

                  //acessa o banco de dados
                  try{
                      $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                        
                      $sql = "SELECT max(num_solicitacao) as num_solicitacao FROM form_mkt";
                            
                      foreach($myPDO->query($sql)as $row){
                            $num = $row['num_solicitacao'];

                      }

                  }catch(PDOException $e){
                      echo $e->getMEssage();
                           
                  }

                  if (!isset($num)){
                      echo '<div class="pedidon"><i>NENHUMA SOLICITAÇÃO EM ANDAMENTO</i></div>';
                            
                  }else{
                      $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                      
                      $adm = $_SESSION['adm'];

                      if ($adm == 0){

                          $where = "WHERE finalizada = 'NAO'";
                          $selecione = "data_solicitacao DESC";
                         
                        $sql = "SELECT x.num_solicitacao, to_char(x.data_solicitacao, 'DD/MM/YYYY') as data_solicitacao,
                        x.hora_solicitacao, x.nome_solicitante,x.setor_solicitante, 
                        x.tipo_servico, x.nome_recebimento, x.nome_executante,x.descricao,x.status,x.obs_exec,x.data_fechamento,
                        x.hora_fechamento,x.nome_responsavel,x.empresa, x.finalizada
                        FROM
                        (
                        SELECT num_solicitacao, data_solicitacao, hora_solicitacao, nome_solicitante,setor_solicitante, tipo_servico, nome_recebimento, 
                                  nome_executante,descricao,status,obs_exec,data_fechamento,hora_fechamento,nome_responsavel,empresa,
                                  CASE WHEN data_fechamento IS NULL THEN 'NAO' ELSE 'SIM' END AS finalizada
                          FROM form_mkt
                          WHERE nome_recebimento = '$func' OR nome_executante = '$func'
                          ORDER BY $selecione
                        ) AS x $where ";

                      }else{

                          $where = "WHERE finalizada = 'NAO'";
                          $selecione = 'data_solicitacao DESC' ;

                        $sql = "SELECT x.num_solicitacao, to_char(x.data_solicitacao, 'DD/MM/YYYY') as data_solicitacao,
                        x.hora_solicitacao, x.nome_solicitante,x.setor_solicitante, 
                        x.tipo_servico, x.nome_recebimento, x.nome_executante,x.descricao,x.status,x.obs_exec,x.data_fechamento,
                        x.hora_fechamento,x.nome_responsavel,x.empresa, x.finalizada
                        FROM
                        (
                        SELECT num_solicitacao, data_solicitacao,hora_solicitacao, nome_solicitante,setor_solicitante, 
                            tipo_servico, nome_recebimento, nome_executante,descricao,status,obs_exec,data_fechamento,
                            hora_fechamento,nome_responsavel,empresa,
                                  CASE WHEN data_fechamento IS NULL THEN 'NAO' ELSE 'SIM' END AS finalizada
                          FROM form_mkt ORDER BY $selecione
                        ) AS x $where";
                      }

                      foreach($myPDO->query($sql)as $row){
                              
                        //armazenando as colunas necessarias do banco em variaveis
                        $result = $row['num_solicitacao'];
                        $num_solicitacao = $row['num_solicitacao'];
                        $data_solicitacao = $row['data_solicitacao'];
                        $nome_solicitante = $row['nome_solicitante'];
                        $hora_solicitacao = $row['hora_solicitacao'];
                        $setor = $row['setor_solicitante'];
                        $tipo_servico = $row['tipo_servico'];
                        $nome_recebimento = $row['nome_recebimento'];
                        $nome_executante = $row['nome_executante'];
                        $descricao = $row['descricao'];
                        $finalizada = $row['finalizada'];

                        //variavel criada para manipular o preenchimento de zeros a esquerda
                        $tamanho = strlen($result);
                        $linked = $result;

                        //condiçoes que os tamanhos podem receber
                        if ($tamanho == 1){
                            $result = '0000'.$result;
                                  
                        }
                                  
                        else if ($tamanho == 2){
                            $result = '000'.$result;
                                  
                        }
                                  
                        else if ($tamanho == 3){
                            $result = '00'.$result;
                                  
                        }
                                  
                        else if ($tamanho == 4){
                            $result = '0'.$result;
                                  
                        }
 
                            $link2 = "href='alterar.php?id=".$linked."'";
                            echo '
                                  <tr style="padding: 10px 20px;" class="nao" onclick="location.'.$link2.'">
                                      <td style="padding: 10px 20px;">'.$result.'</td>
                                      <td style="padding: 10px 20px;">'.$data_solicitacao.'</td>
                                      <td style="padding: 10px 20px;">'.$nome_solicitante.'</td>
                                      <td style="padding: 10px 20px;">'.$nome_executante.'</td>
                                      <td style="padding: 10px 20px;">'.$finalizada.'</td>
                                  </tr>  
                        ';

                        $GLOBALS['sql'] = (isset($_GET['id']) ? $_GET['id'] : $linked);
                                  
                        if ($result == '' or $result == NULL){
                            echo '<script>
                                window.location.href = "insert.php";
                            </script>';

                        }                           
                      }
                  }
                        
                }catch(PDOException $e){
                    echo $e->getMEssage();

                }
            ?>
        </table>
      </form>
    </div>

    <div class="flex ctr">
      <!-- botao voltar que direciona a pagina de escolha abrir uma nova ou consultar uma ordem de serviço -->
      <a class="sair2" href="/FORMS/MARKETING/index.php">
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 17">
          <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
        </svg> VOLTAR 
      </a>

      <div class="sair2" onclick="return confirmacao()">
        <!-- botao sair que encerra sessao aberta pelo usuario -->
        <a>
          <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
          </svg> SAIR 
        </a>
      </div>
    </div>

</body>
</html>