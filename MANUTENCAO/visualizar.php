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
        obs_exec,
        status,
        estado_equipamento,
        nome_responsavel,
        to_char(data_fechamento, 'DD/MM/YYYY') as data_fechamento,
        hora_fechamento,
        obs_fin,
        empresa
        FROM form_manut WHERE num_solicitacao = '$sql'";

        $result = pg_query($conexao, $query);
            if (!$result) {
                echo "Erro na consulta.\n";

            exit;
            }

        //variaveis armazenando as colunas do banco de dados
        $arr = pg_fetch_array($result, 0, PGSQL_NUM);
        $num_solicit =  $arr[0] . "";
        $num =  $arr[0] . "";
        $dt_solicit = $arr[1] . "";
        $hr_solicit = $arr[2] . "";
        $nome_solicit = $arr[3] . "";
        $setor = $arr[4] . "";
        $tp_serv = $arr[5] . "";
        $num_equipamento = $arr[6] . "";
        $nome_equipamento = $arr[7] . "";
        $descr = $arr[8] . "";
        $nome_receb = $arr[9] . "";
        $nome_executante = $arr[10] . "";
        $tipo_servico2 = $arr[11] . "";
        $prioridade = $arr[12] . "";
        $data_inicio = $arr[13] . "";
        $hora_inicio = $arr[14] . "";
        $data_prevista = $arr[15] . "";
        $obs_exec = $arr[16] . "";
        $status = $arr[17] . "";
        $estado_equipamento = $arr[18] . "";
        $nome_responsavel = $arr[19] . "";
        $data_fechamento = $arr[20] . "";
        $hora_fechamento = $arr[21] . "";
        $obs_fin = $arr[22] . "";
        $empresa = $arr[23] . "";
    
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
    ?>
</form>
<!-- Adequa em uma main para responsividade -->
<main>
    <body class="claro">
        <div class="disable">
            <form method="get" id="initial">
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
                            <input name="hr_solicit" readonly type="time" value="<?php echo $hr_solicit; ?>" class="input-padrao"><br>
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
                            <label for="x" class="ali2">Nº Equipamento:</label>
                            <input name="num_equipamento" readonly type="text" value="<?php echo $num_equipamento; ?>" class="input-padrao">
                        </div>

                        <div class="box1">
                            <label for="x" class="ali4">Equipamento:</label>
                            <input name="nome_equipamento" readonly type="text" value="<?php echo $nome_equipamento; ?>" class="input-padrao3">
                        </div>
                    </div>
                </div>

                <br>

                <textarea readonly style="resize: none" type="text" name="desc" class="desc" value="<?php echo $descr; ?>"><?php echo $descr; ?></textarea>
                <br><br>

            </form>

        <form method="get" id="form1" name="form1">
            <h1 style="font-size: 20px; color: #000b49; justify-content: left;">EXECUÇÃO</h1>
            <div class="horizontal ctr2">
                    <div class="align">
            <div class="box1">
                            <label for="x" class="ali1">RECEBIDA POR:</label>
                            <input name="nome_solicit" readonly class="input-padrao" placeholder="RECEBIDA POR" value="<?php echo   $nome_receb   ?>" id="x">
                        </div>
                        <div class="box2" style="opacity: 0;">
                            <label for="x" class="ali">Responsável:</label>
                            <input name="nome_solicit" readonly class="input-padrao" value="<?php      ?>" id="x">
                        </div>
                        <div class="box3" style="opacity: 0;">
                            <label for="x" class="ali">Responsável:</label>
                            <input name="nome_solicit" readonly class="input-padrao" value="<?php      ?>" id="x">
                        </div>
                        </div>
                    </div>
            <div class="horizontal ctr2">
                    <div class="align">
                    <div class="box1">
                            <label for="x" class="ali1">Executante: </label>
                            <input name="dt_solicit" readonly type="text" value="<?php echo  $nome_executante    ?>" placeholder="Executante" class="input-padrao">
                        </div>

                        <div class="box2">
                            <label for="x" class="ali">Tipo de Serviço:</label>
                            <input class="input-padrao" readonly value="<?php echo    $tipo_servico2   ?>" placeholder="SELECIONE">    
                        </div>    

                        <div class="box3">
                            <label for="g" class="ali">Prioridade:</label>
                            <input class="input-padrao" readonly value="<?php echo   $prioridade   ?>" placeholder="SELECIONE">  
                        </div>
                    </div>
                </div>
                <div class="horizontal ctr2">
                    <div class="align">
                    <div class="box1">
                            <label for="x" class="ali1">Data INÍCIO: </label>
                            <input name="dt_solicit" readonly type="text" value="<?php echo $data_inicio    ?>" placeholder="Data início do serviço" class="input-padrao">
                        </div>

                        <div class="box2">
                            <label for="x" class="ali">HorA INÍCIO:</label>
                            <input class="input-padrao" type="text" value="<?php echo   $hora_inicio   ?>" name="nome" readonly placeholder="Horário início do serviço">
                        </div>    
 
                        <div class="box3">
                            <label for="x" class="ali">Data Prevista:</label>
                            <input name="dt_solicit" readonly value="<?php echo  $data_prevista    ?>" type="text" placeholder="Data prevista da conclusão" class="input-padrao">
                        </div>
                    </div>
                </div>
            <br>
     
            <div class="inline">
                <textarea style="resize: none" readonly type="text" name="obs" class="desc" placeholder="Histórico"><?php echo   $obs_exec   ?></textarea>
                <br><br>

            </div>
            <br>

        </form>
        <br><br>

        <form method="get" id="form1" name="form1">
            <h1 style="font-size: 20px; color: #000b49; justify-content: left;">FINALIZAÇÃO</h1>
            <div class="horizontal ctr2">
                    <div class="align">
                        <div class="box1">
                            <label for="xO" class="ali1">ORDEM DE SERVIÇO: </label>
                            <input id="xO" class="input-padrao" placeholder="ORDEM DE SERVIÇO" readonly value="<?php echo  $status    ?>">  
                        </div>
                        <div class="box3" style="opacity: 0;">
                            <label for="x" class="ali">Responsável:</label>
                            <input name="nome_solicit" readonly class="input-padrao" value="<?php ?>" id="x">
                        </div>
                    </div>
                </div>

            <div class="horizontal ctr2">
                    <div class="align">
                        <div class="box1">
                            <label for="xO" class="ali1">ESTADO EQUIPAMENTO INICIAL: </label>
                            <input id="xO" class="input-padrao" placeholder="ESTADO EQUIPAMENTO INICIAL" readonly value="<?php echo  $estado_equipamento    ?>">  
                        </div>
                        <div class="box3">
                            <label for="x" class="ali">Responsável:</label>
                            <input name="nome_solicit" readonly placeholder="RESPONSÁVEL" class="input-padrao" value="<?php echo  $nome_responsavel    ?>" id="x">
                        </div>
                    </div>
                </div>
                <div class="horizontal ctr2">
                    <div class="align">
                        <div class="box1">
                            <label for="x" class="ali1">Data Fechamento: </label>
                            <input name="" readonly type="text" value="<?php echo $data_fechamento ?>" placeholder="DATA FECHAMENTO" class="input-padrao">
                        </div>

                        <div class="box2">
                            <label for="x" class="ali">Horário Fechamento:</label>
                            <input class="input-padrao" readonly type="time" name="nome" type="text" value="<?php echo  $hora_fechamento    ?>">
                        </div>    
                    </div>
                    
                    <div class="inline">
                <textarea style="resize: none" readonly type="text" name="obs" class="desc" placeholder="SERVIÇO REALIZADO OU MOTIVO DO NÃO ATENDIMENTO"><?php echo   $obs_fin   ?></textarea>
                <br><br>

            </div>
                </div>
        </form>
        </div>
        </div>

        <!-- botao salvar adequado dentro de uma div para ser manipualdo a esquerda da pagina -->
        <div class="tirex">
            <a href="consulta.php?selecione=Todos" class="sair3">Voltar</a>
        </div>
        <br><br>

    </body>
</main>
</html>