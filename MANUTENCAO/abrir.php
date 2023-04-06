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
        nome_solicitante, 
        to_char(data_solicitacao, 'DD/MM/YYYY') as data_solicitacao, 
        hora_solicitacao, 
        setor_solicitante, 
        tipo_servico, 
        num_equipamento, 
        nome_equipamento, 
        nome_recebimento, 
        nome_executante, 
        descricao
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
            $nome_solicit = $arr[1] . "";
            $dt_solicit = $arr[2] . "";
            $hr_solicit = $arr[3] . "";
            $setor = $arr[4] . "";
            $tp_serv = $arr[5] . "";
            $num_equipamento = $arr[6] . "";
            $nome_equipamento = $arr[7] . "";
            $nome_receb = $arr[8] . "";
            $nome_executante = $arr[9] . "";
            $descr = $arr[10] . "";
    
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
        
        <!--form method="post" id="form1" name="form1" action="update.php"-->
        <form method="post" action="update.php">
            <input type="hidden" name="deft" value="<?php echo $num?>">
            <h1 style="font-size: 20px; color: #000b49; justify-content: left;">EXECUÇÃO</h1>
            <div class="horizontal ctr2">
                    <div class="align">
                        <div class="box1">
                            <label for="x" class="ali1">RECEBIDA POR:</label>
                            <input name="nome_receb" readonly class="input-padrao" value="<?php echo $_SESSION['funcionario']; ?>" id="x">
                        </div>

                        <div class="box2" style="opacity: 0;">
                            <label for="x" class="ali">Responsável:</label>
                            <input readonly class="input-padrao disable" value="" id="x">
                        </div>

                        <div class="box3" style="opacity: 0;">
                            <label for="x" class="ali">Responsável:</label>
                            <input readonly class="input-padrao disable" value="" id="x">
                        </div>

                    </div>
            </div>

            <div class="horizontal ctr2">
                <div class="align">
                    <div class="box1">
                        <label for="x" class="ali1">EXECUTANTE:</label>
                        <select name="nome_exec" required class="input-padrao" id="solicit">
                            <option value="">SELECIONE</option>
                                <?php
                                    try{
                                        //acessa o banco de dados
                                        $empresa = $_POST['empresa'];
                                        $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                        
                                        $sql = "SELECT f.nome AS funcionario, e.cod AS cod_empresa, d.descricao AS setor, d.cod AS cod_setor
                                        FROM form_func f
                                        INNER JOIN form_emp e ON f.empresa=e.cod
                                        INNER JOIN form_dep d ON f.setor=d.cod
                                        WHERE f.empresa = 1 and d.cod = 31
                                        ORDER BY f.nome ASC";

                                        foreach($myPDO->query($sql)as $row){
                                            $nome = $row['funcionario'];
                                
                                                echo '<option value="'.$nome.'">'.$nome.'</option>';

                                        }  

                                    }catch(PDOException $e){
                                            echo $e->getMEssage();
                                            
                                    }
                                ?>
                        </select>
                    </div>

                    <div class="box2">
                        <label for="tipo2" class="ali">Tipo de serviço:</label>
                        <select name="tipo2" required id="tipo2" class="input-padrao">
                            <option value="">SELECIONE</option>
                                <?php
                                    try{
                                        //acessa o banco de dados
                                        $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                        
                                        $sql = "SELECT * FROM form_serv WHERE painel = 'MAN'";

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

                        <div class="box3">
                            <label for="prioridade" class="ali">Prioridade:</label>  
                            <select name="prioridade" required id="prioridade" class="input-padrao">
                            <option value="">SELECIONE</option>
                            <option value="ALTA">ALTA</option>
                            <option value="MÉDIA">MÉDIA</option>
                            <option value="BAIXA">BAIXA</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="horizontal ctr2">
                    <div class="align">
                    <div class="box1">
                            <label for="x" class="ali1">Data INÍCIO: </label>
                            <input name="dt_inicio" required type="date" placeholder="Data início do serviço" class="input-padrao">
                        </div>

                        <div class="box2">
                            <label for="dt_inicio" class="ali">Hora INÍCIO:</label>
                            <input class="input-padrao" required type="time" name="hr_inicio" placeholder="Horário início do serviço">
                        </div>    

                        <div class="box3">
                            <label for="x" class="ali">Data Prevista:</label>
                            <input name="dt_prevista" required type="date" placeholder="Data prevista da conclusão" class="input-padrao">
                        </div>
                    </div>
                </div>
            <br>
     
            <div class="inline">
                <textarea style="resize: none" type="text" name="historico" class="desc" placeholder="Histórico"></textarea>
                <br><br>

            </div>
            <br>

            <div class="tirex">
                    <div class="archivedy" onclick="return confirmacao();">Cancelar</div>
                    <button class="archive" type="submit">Salvar</button>
                </div>

        </form>
        <br>

        <div class="disable">

        <form id="form1" name="form1">
            <h1 style="font-size: 20px; color: #000b49; justify-content: left;">FINALIZAÇÃO</h1>
            <div class="horizontal ctr2">
                    <div class="align">
                        <div class="box1">
                            <label for="xO" class="ali1">ORDEM DE SERVIÇO: </label>
                            <input id="xO" class="input-padrao" readonly value="SELECIONE">  
                        </div>
                        <div class="box3" style="opacity: 0;">
                            <label for="x" class="ali">Responsável:</label>
                            <input  readonly class="input-padrao disable" value="" id="x">
                        </div>
                    </div>
                </div>

            <div class="horizontal ctr2">
                    <div class="align">
                        <div class="box1">
                            <label for="xO" class="ali1">ESTADO EQUIPAMENTO INICIAL: </label>
                            <input id="xO" class="input-padrao" readonly value="SELECIONE">  
                        </div>
                        <div class="box3">
                            <label for="x" class="ali">Responsável:</label>
                            <input readonly class="input-padrao" value="" id="x">
                        </div>
                    </div>
                </div>
                <div class="horizontal ctr2">
                    <div class="align">
                        <div class="box1">
                            <label for="x" class="ali1">Data Fechamento: </label>
                            <input readonly type="date" value="" class="input-padrao">
                        </div>

                        <div class="box2">
                            <label for="x" class="ali">Horário Fechamento:</label>
                            <input class="input-padrao" readonly type="time" name="nome" type="text" value="" >
                        </div>    
                    </div>
                    
                    <div class="inline">
                <textarea style="resize: none" readonly type="text" class="desc" placeholder="SERVIÇO REALIZADO OU MOTIVO DO NÃO ATENDIMENTO"></textarea>
                <br><br>

            </div>
                </div>
        </form>
        </div>

                <!-- botao cancelar -->
                <script language=javascript>
                    function confirmacao(){
                        if (confirm("Deseja mesmo cancelar? Dados serão perdidos"))
                            window.location.href = "executar.php?selecione=Todos";
                        }

                </script>

                <!-- botao salvar/cancelar adequado dentro de uma div para ser manipualdo na pagina da pagina -->


    </body>
</main>
</html>