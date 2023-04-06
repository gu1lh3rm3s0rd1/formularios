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
    <title>RELATÓRIO DE ORDEM DE SERVIÇO ENGENHARIA</title>

    <!-- Faixa azul e logo no topo -->
    <header class="top auto ctr2">
        <img class="ctr2" src="img/logo-chiaperini.png" alt="img"><p class="white" style="margin-left: 10px; font-size: 25px;">RELATÓRIO DE ORDEM DE<br> SERVIÇO ENGENHARIA</p>
    </header>
</head>

<!--Formulário onde estão os dados que já foram solicitados anteriormente-->
<form method="get">

    <?php

        $sql = $_GET['id'];

                //sql para pegar os dados que serao apresentados para o usuario quando ele abrir abrir um OS em andamento para finaliza-la
                $query = "SELECT num_solicitacao, nome_solicitante, to_char(data_solicitacao, 'DD/MM/YYYY') as data_solicitacao, hora_solicitacao, setor_solicitante, tipo_servico, nome_recebimento, nome_executante, descricao
                FROM form_eng WHERE num_solicitacao = '$sql'";

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
            $nome_executante = $arr[7] . "";
            $descr = $arr[8] . "";
    
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

        </div>
    </form>

        <h1 style="font-size: 20px; color: #000b49; justify-content: left;">EXECUÇÃO</h1>

        <form method="post" id="form1" name="form1" action="update.php">
            <input type="hidden" name="deft" value="<?php echo $num?>">
                <div class="box3">

                    <label for="h" class="ali3">Ordem de serviço:</label>

                    <select name="status" id="h" required class="input-padrao2">
                        <option value="">SELECIONE</option>
                        <option value="CONCLUÍDA">CONCLUÍDA</option>
                        <option value="NÃO CONCLUÍDA">NÃO CONCLUÍDA</option>
                    </select>

                </div>

                <br>

                <div class="inline">

                    <textarea style="resize: none" required type="text" name="obs_exec" class="desc" placeholder="Serviço realizado ou motivo do não atendimento"></textarea>

                    <br><br>

                    <div class="horizontal ctr2">
                        <div class="align">

                            <div class="box1">
                                <label for="x" class="ali">Data de fechamento: </label>
                                <input name="dt_solicit" readonly type="text" value="<?php echo $hoje ?>" placeholder="Data da solicitação" class="input-padrao">
                            </div>

                            <div class="box2">
                                <label for="x" class="ali">Horário fechamento:</label>
                                <input class="input-padrao" readonly value="<?php echo $time; ?>" required id="nome" type="time" name="nome"  placeholder="Horário">
                            </div>    

                            <div class="box3">
                                <label for="x" class="ali">Responsável serviço:</label>
                                <input class="input-padrao" readonly id="nome" type="text" name="nome_responsavel" value="<?php echo $_SESSION['funcionario'];?>">
                            </div>

                        </div>
                    </div>
                </div>

                <br>

                <!-- botao cancelar -->
                <script language=javascript>
                    function confirmacao(){
                        if (confirm("Deseja mesmo cancelar? Dados serão perdidos"))
                            window.location.href = "executar.php";
                        }
                </script>

                <!-- botao salvar/cancelar adequado dentro de uma div para ser manipualdo na pagina da pagina -->
                <div class="tirex">
                    <div class="archivedy" onclick="return confirmacao();">Cancelar</div>
                    <button class="archive" type="submit">Executar</button>
                </div>
                
                <br><br>
    </form>
</body>

</main>
</html>