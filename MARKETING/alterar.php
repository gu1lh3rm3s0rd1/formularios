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
    <title>RELATÓRIO DE ORDEM DE SERVIÇO MARKETING</title>

    <!-- Faixa azul e logo no topo -->
    <header class="top auto ctr2">
        <img class="ctr2" src="img/logo-chiaperini.png" alt="img"><p class="white" style="margin-left: 10px; font-size: 25px;">RELATÓRIO DE ORDEM DE<br> SERVIÇO MARKETING</p>
    </header>
</head>

<!--Formulário onde estão os dados que já foram solicitados anteriormente-->
<form method="get">
    <?php
        $sql = $_GET['id'];

        $query = "SELECT num_solicitacao, nome_solicitante, data_solicitacao, hora_solicitacao, setor_solicitante, tipo_servico, nome_recebimento, nome_executante, descricao, status, obs_exec, data_fechamento, hora_fechamento, nome_responsavel, empresa
                FROM form_mkt WHERE num_solicitacao = '$sql'";

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
        $status = $arr[9] . "";
        $obs_exec = $arr[10] . "";
        $data_fechamento = $arr[11] . "";
        $hora_fechamento = $arr[12] . "";
        $nome_responsavel = $arr[13] . "";
        $empresa = $arr[14] . "";
    
        $dt_solicit = date("d-m-Y",strtotime($dt_solicit));
        $dt_solicit = str_replace('-', '/', $dt_solicit);

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

            <form method="post" id="initial" action="alterar-update.php">
                <div class="mg">
                    <h1 style="font-size: 20px; color: #000b49; justify-content: left;">SOLICITAÇÃO</h1>
                </div>

                <div class="horizontal ctr2">
                    <div class="align">
                        <div class="box1 disable">
                            <label for="x" class="ali1">Solicitação nº:</label>
                            <input name="n_solicit" readonly type="text" value="<?php echo $num_solicit; ?>" class="input-padrao">
                        </div>

                        <div class="box2 disable">
                            <label for="x" class="ali">Data da solicitação:</label>
                            <input name="dt_solicit" readonly type="text" value="<?php echo $dt_solicit; ?>" class="input-padrao">
                        </div>

                        <div class="box3 disable">
                            <label for="x" class="ali">Horário:</label>
                            <input name="hr_solicit" readonly type="text" value="<?php echo $hr_solicit; ?>" class="input-padrao"><br>
                        </div>
                    </div>
                </div>

                <div class="horizontal ctr2">
                    <div class="align">
                    <div class="box1">
                        <label for="x" class="ali1">Solicitante:</label>
                        <select name="nome_solicit" required class="input-padrao" id="nome">
                            <option value="<?php echo $nome_solicit; ?>"><?php echo $nome_solicit; ?></option>
                                <?php
                                    try{
                                        //acessa o banco de dados
                                        $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");

                                        $sql = "select f.nome as funcionario
                                        from form_func as f
                                        inner join form_emp as e on f.empresa = e.cod
                                        where e.nome = '$empresa' ORDER BY funcionario";

                                        foreach($myPDO->query($sql)as $row){
                                            $nome = $row['funcionario'];
                                
                                            $selected =  ($solicitante == utf8_encode($nome)) ? 'selected' : '';
                                                echo '<option value="'.$nome.'"'.$selected.'>'.$nome.'</option>';

                                        }  

                                    }catch(PDOException $e){
                                            echo $e->getMEssage();
                                            
                                    }
                                ?>
                        </select>
                    </div>

                    <div class="box2">
                        <label for="x" class="ali">Setor:</label>
                        <select name="setor_solicit" required class="input-padrao" id="setor">
                            <option value="<?php echo $setor; ?>"><?php echo $setor; ?></option>
                                <?php
                                    try{
                                        //acessa o banco de dados
                                        $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");

                                        $sql = "select d.cod as cod_setor, d.descricao as setor
                                        from form_dep as d
                                        inner join form_emp as e on d.empresa = e.cod
                                        where e.nome = '$empresa'";

                                        foreach($myPDO->query($sql)as $row){
                                            $setor = $row['setor'];

                                            $selected =  ($solicitante == utf8_encode($setor)) ? 'selected' : '';
                                                echo '<option value="'.$setor.'"'.$selected.'>'.$setor.'</option>';

                                        }  

                                    }catch(PDOException $e){
                                        echo $e->getMEssage();

                                    }
                                ?>
                        </select>
                    </div>

                    <div class="box3">
                        <label for="po" class="ali">Tipo de serviço:</label>
                        <select name="po" required id="po" class="input-padrao">
                            <option value="<?php echo $tp_serv; ?>"><?php echo $tp_serv; ?></option>
                                <?php
                                    $solicitante = $_POST['nome_solicit'];

                                    try{
                                        //acessa o banco de dados
                                        $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                        
                                        $sql = "SELECT * FROM form_serv WHERE painel = 'MKT'";

                                        foreach($myPDO->query($sql)as $row){

                                            $tipo = $row['descricao'];
                                
                                                echo '<option value="'.$tipo.'">'.$tipo.'</option>';

                                            }  
                                            
                                        }catch(PDOException $e){
                                            echo $e->getMEssage();
                                            
                                        }
                                ?>
                        </select>
                    </div>
                    </div>
                </div>

                <div class="horizontal ctr2">
                    <div class="align">
                    <div class="box2 disable">
                            <label for="x" class="ali2">Recebida por:</label>
                            <input type="text" name="recebido_solicit" readonly value="<?php echo $nome_receb; ?>" class="preenche">
                        </div>

                        <div class="box3">
                        <label for="x" class="ali4">Executante:</label>
                        <select name="nome_exec" required class="input-padrao3" id="nome">
                            <option value="<?php echo $nome_executante; ?>"><?php echo $nome_executante; ?></option>
                                <?php
                                    try{
                                        //acessa o banco de dados
                                        $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");

                                        $sql = "select f.nome as funcionario
                                        from form_func as f
                                        inner join form_emp as e on f.empresa = e.cod
                                        ORDER BY funcionario";

                                        foreach($myPDO->query($sql)as $row){
                                            $nome = $row['funcionario'];
                                
                                            $selected =  ($solicitante == utf8_encode($nome)) ? 'selected' : '';
                                                echo '<option value="'.$nome.'"'.$selected.'>'.$nome.'</option>';

                                        }  

                                    }catch(PDOException $e){
                                            echo $e->getMEssage();
                                            
                                    }
                                ?>
                        </select>
                        </div>
                    </div>
                </div>
                <br>

                <textarea class="desc" style="resize: none" type="text" name="desc" value="<?php echo $descr; ?>"><?php echo $descr; ?></textarea>
                <br><br>

                <div class="tirex">
            <div class="archivedy" onclick="return confirmacao();">Cancelar</div>
            <button class="archive" type="submit">ALTERAR</button>
            
        </div>

            </form>

           

<form id="form1" name="form1" class="disable">
<h1 style="font-size: 20px; color: #000b49; justify-content: left;">EXECUÇÃO</h1>
    <input type="hidden" name="deft" value="<?php echo $num?>">
        <div class="box3">
            <label for="h" class="ali3">Ordem de serviço:</label>
            <input value="NÃO CONCLUÍDA" name="status" id="h" readonly class="input-padrao2">
        </div>
        <br>

        <div class="inline">
            <textarea style="resize: none" required type="text" name="obs_exec" class="desc" placeholder="Serviço realizado ou motivo do não atendimento"></textarea>
            <br><br>

            <div class="horizontal ctr2">
                <div class="align">
                    <div class="box1">
                        <label for="x" class="ali">Data de fechamento: </label>
                        <input name="dt_solicit" readonly type="text" placeholder="Data da solicitação" class="input-padrao">
                    </div>

                    <div class="box2">
                        <label for="x" class="ali">Horário fechamento:</label>
                        <input class="input-padrao" readonly id="nome" type="time" name="nome"  placeholder="Horário">
                    </div>    

                    <div class="box3">
                        <label for="x" class="ali">Responsável serviço:</label>
                        <input class="input-padrao" readonly id="nome" type="text" placeholder="Responsável Serviço" name="nome_responsavel">
                    </div>
                </div>
            </div>
        </div>
        <br>

        <!-- botao cancelar -->
        <script language=javascript>
            function confirmacao(){
                if (confirm("Deseja mesmo cancelar? Dados serão perdidos"))
                    window.location.href = "selecionar.php?selecione=Não";
                }
                function alterar(){
                if (confirm("Deseja mesmo alterar? O processo é irreversível"))
                    window.location.href = "alterar-update.php";
                }
        </script>

        <!-- botao salvar/cancelar adequado dentro de uma div para ser manipualdo na pagina da pagina -->
        <br><br>
</form>

    </body>
</main>
</html>