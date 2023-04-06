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
    <title>RELATÓRIO DE ORDEM DE SERVIÇO FERRAMENTARIA</title>

    <!-- Faixa azul e logo no topo -->
    <header class="top auto ctr2">
        <img class="ctr2" src="img/logo-chiaperini.png" alt="img"><p class="white" style="margin-left: 10px; font-size: 25px;">RELATÓRIO DE ORDEM DE<br> SERVIÇO FERRAMENTARIA</p>
    </header>
</head>

<!--Formulário onde estão os dados que já foram solicitados anteriormente-->
<form method="get">
    <?php
        $sql = $_GET['id'];

        $query = "SELECT num_solicitacao, nome_solicitante, data_solicitacao, hora_solicitacao, setor_solicitante, tipo_servico, nome_recebimento, num_equipamento,
                         nome_equipamento, nome_executante, descricao, status, obs_exec, data_fechamento, hora_fechamento, nome_responsavel, empresa
                FROM form_fer WHERE num_solicitacao = '$sql'";

        $result = pg_query($conexao, $query);
            if (!$result) {
                echo "Erro na consulta.\n";

            exit;
            }

        //variaveis armazenando as colunas do banco de dados
        $arr = pg_fetch_array($result, 0, PGSQL_NUM);
        $num_solicit =  $arr[0] . "";
        $num =  $arr[0] . "";
        $nome_solicit = $arr[1] . "";
        $dt_solicit = $arr[2] . "";
        $hr_solicit = $arr[3] . "";
        $setor = $arr[4] . "";
        $tp_serv = $arr[5] . "";
        $nome_receb = $arr[6] . "";
        $num_equipamento = $arr[7] . "";
        $nome_equipamento = $arr[8] . "";
        $nome_executante = $arr[9] . "";
        $descr = $arr[10] . "";
        $status = $arr[11] . "";
        $obs_exec = $arr[12] . "";
        $data_fechamento = $arr[13] . "";
        $hora_fechamento = $arr[14] . "";
        $nome_responsavel = $arr[15] . "";
        $empresa = $arr[16] . "";
    
        //variavel criada para manipular o preenchimento de zeros a esquerda
        $tamanho = strlen($num_solicit);

        $dt_solicit = date("d-m-Y",strtotime($dt_solicit));
        $dt_solicit = str_replace('-', '/', $dt_solicit);

        $data_fechamento = date("d-m-Y",strtotime($data_fechamento));
        $data_fechamento = str_replace('-', '/', $data_fechamento);

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
                            <label for="x" class="ali2">Nº Equipamento:</label>
                            <input name="num_equipamento" readonly type="text" value="<?php echo $num_equipamento; ?>" class="input-padrao">
                        </div>

                        <div class="box1">
                            <label for="x" class="ali4">Equipamento:</label>
                            <input name="nome_equipamento" readonly type="text" value="<?php echo $nome_equipamento; ?>" class="input-padrao3">
                        </div>
                    </div>
                </div>

                <div class="horizontal ctr2">
                    <div class="align">
                    <div class="box2">
                            <label for="x" class="ali2">Recebida por:</label>
                            <input type="text" required name="recebido_solicit" readonly value="<?php echo $nome_receb; ?>" class="preenche">
                        </div>

                        <div class="box3">
                            <label for="x" class="ali4">Executante:</label>
                            <input class="input-padrao3" id="nome" type="text" readonly name="executante" value="<?php echo $nome_executante; ?>">
                        </div>
                    </div>
                </div>
                <br>

                <textarea readonly style="resize: none" type="text" name="desc" class="desc" value="<?php echo $descr; ?>"><?php echo $descr; ?></textarea>
                <br><br>

            </form>

            <h1 style="font-size: 20px; color: #000b49; justify-content: left;">EXECUÇÃO</h1>

            <form method="post" id="form1" name="form1">
                <input type="hidden" name="deft" value="<?php echo $num?>">
                    <div class="box3">
                        <label for="h" class="ali3">Ordem de serviço:</label>
                        <input class="input-padrao2 gray" value="CONCLUIDA" readonly id="h">
                    </div>
                    <br>

                    <div class="inline">
                        <textarea style="resize: none" readonly type="text" name="obs_exec" class="desc"><?php echo $obs_exec; ?></textarea>
                        <br><br>

                        <div class="horizontal ctr2">
                            <div class="align">
                                <div class="box1">
                                    <label for="x" class="ali">Data de fechamento: </label>
                                    <input name="dt_solicit" readonly type="text" value="<?php echo $data_fechamento ?>" class="input-padrao">
                                </div>

                                <div class="box2">
                                    <label for="x" class="ali">Horário fechamento:</label>
                                    <input class="input-padrao" readonly value="<?php echo $hora_fechamento; ?>" id="nome" type="time" name="nome">
                                </div>    

                                <div class="box3">
                                    <label for="x" class="ali">Responsável serviço:</label>
                                    <input class="input-padrao" readonly id="nome" type="text" name="nome_responsavel" value="<?php echo $nome_responsavel; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

            </form>
        </div>

        <!-- botao salvar adequado dentro de uma div para ser manipualdo a esquerda da pagina -->
        <div class="tirex">
            <a href="index.php" class="sair3">Voltar</a>
        </div>
        <br><br>

    </body>
</main>
</html>