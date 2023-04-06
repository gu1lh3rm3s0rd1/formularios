<?php 
    //Variáveis que coletam a data e hora atuais
    $hoje = date('d/m/Y'); date_default_timezone_set('America/Sao_Paulo');
    $time = date('H:i'); 

    //Inicia a sessão conferindo se o usuário fez login
    session_start(); 
    if (!isset($_SESSION['logon']) or $_SESSION['logon'] == 0){
        header("Location: /FORMS/login/index.php");
    }

    //Chama a conexão com o banco de dados
    include 'conexao.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>RELATÓRIO DE ORDEM DE SERVIÇO MANUTENÇÃO</title>

    <!-- Faixa azul e logo no topo -->
    <header class="top auto ctr2">
        <img class="ctr2" src="img/logo-chiaperini.png" alt="img"><p class="white" style="margin-left: 10px; font-size: 25px;">RELATÓRIO DE ORDEM DE<br> SERVIÇO MANUTENÇÃO</p>
    </header>
</head>

<!--Formulário onde estão os dados que já foram solicitados anteriormente-->
<form method="get">
    <?php
        $sql = $_GET['id'];

        //sql para pegar os dados que serao apresentados para o usuario quando ele abrir abrir um OS em andamento para finaliza-la
        $query = "SELECT 
        num_solicitacao, 
        to_char(data_solicitacao, 'DD/MM/YYYY') as data_solicitacao, 
        hora_solicitacao, 
        nome_solicitante,
        setor_solicitante, 
        tipo_servico, 
        num_equipamento,
        nome_equipamento,
        descricao, 
        nome_recebimento, 
        nome_executante,
        tipo_servico2, 
        prioridade, 
        to_char(data_inicio, 'DD/MM/YYYY') as data_inicio,
        hora_inicio, 
        to_char(data_prevista, 'DD/MM/YYYY') as data_prevista, 
        obs_exec
                FROM form_manut WHERE num_solicitacao = '$sql'";

        $result = pg_query($conexao, $query);
        if (!$result) {
            echo "Erro na consulta.\n";

         exit;

        }

        //variaveis armazenando as colunas do banco de dados
        $arr = pg_fetch_array($result, 0, PGSQL_NUM);
        
        /*num_solicitacao*/      $num_solicit =  $arr[0] . "";
        /*num_solicitacao*/      $num =  $arr[0] . "";
        /*data_solicitacao*/     $dt_solicit = $arr[1] . "";
        /*hora_solicitacao*/     $hr_solicit = $arr[2] . "";
        /*nome_solicitante*/     $nome_solicit = $arr[3] . "";
        /*setor_solicitante*/    $setor = $arr[4] . "";
        /*tipo_servico*/         $tp_serv = $arr[5] . "";
        /*num_equipamento*/      $num_equipamento = $arr[6] . "";
        /*nome_equipamento*/     $nome_equipamento = $arr[7] . "";
        /*descricao*/            $descr = $arr[8] . "";
        /*nome_recebimento*/     $nome_recebimento = $arr[9] . "";
        /*nome_executante*/      $nome_executante = $arr[10] . "";
        /*tipo_servico2*/        $tipo_servico2 = $arr[11] . "";
        /*prioridade*/           $prioridade = $arr[12] . "";
        /*data_inicio*/          $data_inicio = $arr[13] . "";
        /*hora_inicio*/          $hora_inicio = $arr[14] . "";
        /*data_prevista*/        $data_prevista = $arr[15] . "";
        /*obs_exec*/             $obs_exec = $arr[16] . "";

        //variavel criada para manipular o preenchimento de zeros a esquerda
        $tamanho = strlen($num_solicit);

        //condiçoes que os tamanhos podem receber
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

        $_SESISON['num_solicit'] = $nome_solicit; 

    ?>
</form>

<!-- Adequa em uma main para responsividade -->
<main>
    <body class="claro">
        <form method="get" id="initial">
            <div class="disable">
            <div class="mg">
                <h1 style="font-size: 20px; color: #000b49; justify-content: left;">SOLICITAÇÃO</h1>
            </div>

             <div class="horizontal ctr2">
                <div class="align">
                    <div class="box1">
                        <label for="x" class="ali1">Solicitação nº:</label>
                        <input name="n_solicit" readonly type="text" value="<?php echo $num_solicit; ?>" class="input-padrao">
                    </div>

                    <div class="box2">
                        <label for="x" class="ali">Data da solicitação:</label>
                        <input name="dt_solicit" readonly type="text" value="<?php echo $dt_solicit ?>" class="input-padrao">
                    </div>

                    <div class="box3">
                        <label for="x" class="ali">Horário:</label>
                        <input name="hr_solicit" readonly type="text" value="<?php echo $hr_solicit; ?>" class="input-padrao"><br>
                    </div>
                </div>
            </div>

            <div class="horizontal ctr2">
                <div class="align">
                    <div class="box1">
                        <label for="x" class="ali1">Solicitante:</label>
                        <input name="nome_solicit" readonly type="text" value="<?php echo $nome_solicit; ?>" class="input-padrao">
                    </div>

                    <div class="box2">
                        <label for="x" class="ali">Setor:</label>
                        <input name="setor_solicit" readonly type="text" value="<?php echo $setor; ?>" class="input-padrao">
                    </div>

                    <div class="box3">
                        <label for="po" class="ali">Tipo de serviço:</label>
                        <input name="po" readonly type="text" value="<?php echo $tp_serv; ?>" class="input-padrao">
                    </div>
                </div>
            </div>

            <div class="horizontal ctr2">
                <div class="align">
                    <div class="box2">
                        <label for="x" class="ali2">Equipamento Nº:</label>
                        <input name="num_equip" readonly type="text" value="<?php echo $num_equipamento; ?>" class="input-padrao">
                    </div>

                    <div class="box1">
                        <label for="x" class="ali4">Equipamento:</label>
                        <input name="nome_equip" readonly type="text" value="<?php echo $nome_equipamento; ?>" class="input-padrao3">
                    </div>
                </div>
            </div>
            <br>

            <textarea readonly style="resize: none" type="text" name="desc" class="desc" value="<?php echo $descr; ?>"><?php echo $descr; ?></textarea>
            <br><br>
            </div>
        </form>
        <br>
<div class="disable">
        <form id="form1" name="form1">
            <h1 style="font-size: 20px; color: #000b49; justify-content: left;">EXECUÇÃO</h1>
            <div class="horizontal ctr2">
                    <div class="align">
            <div class="box1">
                            <label for="x" class="ali1">RECEBIDA POR:</label>
                            <input name="nome_solicit" readonly class="input-padrao" value="<?php echo $nome_recebimento?>" id="x">
                        </div>
                        <div class="box2" style="opacity: 0;">
                            <label for="x" class="ali">Responsável:</label>
                            <input name="nome_solicit" readonly class="input-padrao" value="<?php echo $nome_recebimento?>" id="x">
                        </div>
                        <div class="box3" style="opacity: 0;">
                            <label for="x" class="ali">Responsável:</label>
                            <input name="nome_solicit" readonly class="input-padrao" value="<?php echo $nome_recebimento?>" id="x">
                        </div>
                        </div>
                    </div>
            <div class="horizontal ctr2">
                    <div class="align">
                        <div class="box1">
                            <label for="x" class="ali1">Data INÍCIO: </label>
                            <input name="dt_solicit" readonly type="text" value="<?php echo $data_inicio?>" class="input-padrao">
                        </div>

                        <div class="box2">
                            <label for="x" class="ali">HorA INÍCIO:</label>
                            <input class="input-padrao" type="text" name="nome" readonly value="<?php echo $hora_inicio?>">
                        </div>    

                        <div class="box3">
                            <label for="x" class="ali">Data Prevista:</label>
                            <input name="dt_solicit" readonly type="text" value="<?php echo $data_prevista?>" class="input-padrao">
                        </div>
                    </div>
                </div>
                <div class="horizontal ctr2">
                    <div class="align">
                        <div class="box1">
                            <label for="x" class="ali1">Executante: </label>
                            <input name="dt_solicit" readonly type="text" value="<?php echo $nome_executante?>" class="input-padrao">
                        </div>

                        <div class="box2">
                            <label for="x" class="ali">Tipo de Serviço:</label>
                            <input class="input-padrao" readonly value="<?php echo $tipo_servico2?>">    
                        </div>    

                        <div class="box3">
                            <label for="g" class="ali">Prioridade:</label>
                            <input class="input-padrao" readonly value="<?php echo $prioridade?>">  
                        </div>
                    </div>
                </div>
            <br>
     
            <div class="inline">
                <textarea style="resize: none" readonly type="text" name="obs" class="desc"><?php echo $obs_exec?></textarea>
                <br><br>

            </div>
            <br>

        </form>
        <br><br>

        </div>
        
        </div>
        <form method="post" id="form1" name="form1" action="finalizacao-update.php">
            <h1 style="font-size: 20px; color: #000b49; justify-content: left;">FINALIZAÇÃO</h1>
            <div class="box3">
                <label for="h" class="ali3">Ordem de serviço:</label>
                <select class="input-padrao2" name="ordem" required>  
                            <option value="">SELECIONE</option>
                            <option value="CONCLUÍDA">CONCLUÍDA</option>
                            <option value="NÃO CONCLUÍDA">NÃO CONCLUÍDA</option>
                            </select>
            </div>
     <br>

            <div class="horizontal ctr2">
                    <div class="align">
                        <div class="box1">
                            <label for="xO" class="ali1">ESTADO EQUIPAMENTO INICIAL: </label>
                            <select class="input-padrao" name="estado_equip" required>  
                            <option value="">SELECIONE</option>
                            <option value="CONFORME">CONFORME</option>
                            <option value="NÃO CONFORME">NÃO CONFORME</option>
                            </select>
                        </div>
                        <div class="box3">
                            <label for="x" class="ali">Responsável:</label>
                            <input name="nome_solicit" readonly class="input-padrao disable" value="<?php echo $_SESSION['funcionario']?>" id="x">
                        </div>
                    </div>
                </div>
                <div class="horizontal ctr2">
                    <div class="align">
                        <div class="box1">
                            <label for="x" class="ali1">Data Fechamento: </label>
                            <input readonly type="text" value="<?php echo $hoje;?>" class="input-padrao">
                        </div>

                        <div class="box2">
                            <label for="x" class="ali">Horário Fechamento:</label>
                            <input class="input-padrao" readonly type="text" type="text" value="<?php echo $time;?>" >
                        </div>   

                        <input type="hidden" name="solicitacao" value="<?php echo $num_solicit?>">

                    </div>
                    <div class="inline">
                <textarea style="resize: none" type="text" name="digitar" class="desc" placeholder="SERVIÇO REALIZADO OU MOTIVO DO NÃO ATENDIMENTO"></textarea>
                <br><br>

            </div>
                </div>
                <div class="tirex">
                    <div class="archivedy" onclick="return confirmacao();">Cancelar</div>
                    <button class="archive" type="submit">Salvar</button>
                </div>
        </form>
    </body>
                        <!-- botao cancelar -->
                        <script language=javascript>
                    function confirmacao(){
                        if (confirm("Deseja mesmo cancelar? Dados serão perdidos"))
                            window.location.href = "executar.php?selecione=Todos";
                        }

                </script>
</main>
</html>