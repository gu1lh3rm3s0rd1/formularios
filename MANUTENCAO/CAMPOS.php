<?php 
    //Inicia a sessão conferindo se o usuário fez login
    session_start(); 
    if (!isset($_SESSION['logon']) or $_SESSION['logon'] == 0){
        header("Location: /FORMS/login/index.php");
    }

    //hora e minuto em tempo real
    $hoje = date('d/m/Y');
    date_default_timezone_set('America/Sao_Paulo');
    $time = date('H:i'); 

    //se nao informar o usuario ou senha o site retorna a pagina de login caso as informacoes sejam nulas/em branco
    if (!isset($_SESSION['funcionario']) or $_SESSION['funcionario'] == 0 or $_SESSION['funcionario'] == ''){
        header("Location: /FORMS/login/index.php");
    }

    //comexao banco de dados
    include 'conexao.php'; 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="pesquisa.css" rel="stylesheet"/>

    <!-- lib´s bootstrap/javascript -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <title>RELATÓRIO DE ORDEM DE SERVIÇO MANUTENÇÃO</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- habilita um campo de pesqusia nos campos solicitante(nome), setor(setor), executante(exec) -->
    <script>
        $(document).ready(function() {
            $('#nome').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#setor').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#exec').select2();
        });
    </script>

    <!-- Faixa azul e logo no topo -->
    <header class="top auto ctr2">
        <img class="ctr2" src="img/logo-chiaperini.png" alt="img"><p class="white" style="margin-left: 10px; font-size: 25px;">RELATÓRIO DE ORDEM DE<br> SERVIÇO MANUTENÇÃO</p>
    </header>
</head>

<?php
    //decalra as as variaveis de solicitaçoes como nulas, caso contrario, ficariam comportando erros de variaveis indefinidas ate o usuario defini-las
    if(!isset($_POST['n_solicit'])){
        $_POST['n_solicit'] = "";
    }

    if (!isset($_POST['nome_solicit'])){
        $_POST['nome_solicit'] = "";
    }

    if (!isset($_POST['dt_solicit'])){
        $_POST['dt_solicit'] = "";
    }

    if (!isset($_POST['hr_solicit'])){
        $_POST['hr_solicit'] = "";
    }

    if (!isset($_POST['setor_solicit'])){
        $_POST['setor_solicit'] = "";
    }

    if (!isset($_POST['po'])){
        $_POST['po'] = "";
    }

    if (!isset($_POST['op'])){
        $_POST['op'] = "";
    }

    if (!isset($_POST['op'])){
        $_POST['op'] = "";
    }

    if (!isset($_POST['recebido_solicit'])){
        $_POST['recebido_solicit'] = "";
    }

    if (!isset($_POST['desc'])){
        $_POST['desc'] = "";
    }

    if (!isset($_POST['nome_respons'])){
        $_POST['nome_respons'] = "";
    }

    if (!isset($_POST['obs'])){
        $_POST['obs'] = "";
    }

    if (!isset($_POST['executante'])){
        $_POST['executante'] = "";
    }

    if (!isset($_POST['empresa'])){
        $_POST['empresa'] = "";
    }

    if (!isset($_POST['num_equipamento'])){
        $_POST['num_equipamento'] = "";
    }

    if (!isset($_POST['nome_equipamento'])){
        $_POST['nome_equipamento'] = "";
    }

    //variaveis que recebem as info informadas pelo usuario
    $nome_solicitante = $_POST['nome_solicit'];
    $data_solicitacao = $_POST['dt_solicit'];
    $hora_solicitacao = $_POST['hr_solicit'];
    $setor = $_POST['setor_solicit'];
    $tipo_servico = $_POST['po'];
    $nome_recebimento = $_POST['recebido_solicit'];
    $descricao = $_POST['desc'];
    $nome_executante = $_POST['executante'];
    $nome_responsavel = $_POST['nome_respons'];
    $obs_exec = $_POST['obs'];
    $empresa = $_POST['empresa'];
    $num_equipamento = $_POST['num_equipamento'];
    $nome_equipamento = $_POST['nome_equipamento'];

    try{
        //acessa o banco de dados
        $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
        
        $sql = "SELECT num_solicitacao FROM form_manut ORDER BY num_solicitacao DESC LIMIT 1";

        foreach($myPDO->query($sql)as $row){
            $result = $row['num_solicitacao'];
            $num_solicitacao = $row['num_solicitacao'];
        
            //varaivel que recebera um valor do banco e posteriormente o completara com zeros a esquerda
            $tamanho = strlen($result);

            //tamanhos que a varaivel aceita
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
        }  
            
    }catch(PDOException $e){
        echo $e->getMEssage();
        
    }
        
?>

<!-- Adequa em uma main para responsividade -->
<main>
    <body class="claro">

        <div class="horizontal ctr2">
        <label class="mg" style="font-size: 20px; color: #000b49; justify-content: left;">SOLICITAÇÃO</label>

        <form method="post" id="initial" action="insert.php">
            <div class="horizontal ctr2">
                <div class="align">
                    <div class="box1">
                        <label for="x" class="ali1">Solicitação nº:</label>
                        <input name="n_solicit" readonly type="text" placeholder="Gerando" class="input-padrao">
                    </div>

                    <div class="box2">
                        <label for="x" class="ali">Data da solicitação:</label>
                        <input name="dt_solicit" readonly type="text" value="<?php echo $hoje ?>" placeholder="Data da solicitação" class="input-padrao">
                    </div>

                    <div class="box3">
                        <label for="x" class="ali">Horário:</label>
                        <input name="hr_solicit" readonly type="text" value="<?php echo $time; ?>" placeholder="Horário" class="input-padrao"><br>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                $(function(){
                    $('.chzn-select').chosen({width: "50%", no_results_text: "Sem registro de ", size:"5"});
                    $(document).on('chosen:updated', '.chzn-select', function(e,x){
                        //Não sei direito o que voce quer fazer aqui,
                        // Mas coloco o código aqui, ele será executado toda vez que o usuario mudar o chosen
                        //De uma olhada nos parametros e, x

                        alert('Alguma alteração aconteceu');
                    });
                });
            </script>

            <div class="horizontal ctr2">
                <div class="align">
                    <div class="box1">
                        <label for="xnome" class="ali1">Solicitante:</label>
                        <input name="nome_solicit" readonly class="input-padrao disable" value="<?php echo $_SESSION['funcionario']?>" id="xnome">
                    </div>

                    <div class="box2">
                        <label for="ynome" class="ali">Setor:</label>
                        <input name="nome_solicit" readonly class="input-padrao disable" value="<?php echo $_SESSION['setor']?>" id="ynome">
                    </div>

                    <div class="box3">
                        <label for="po" class="ali">Tipo de serviço:</label>
                        <select name="po" required id="po" class="input-padrao">
                            <option value="">SELECIONE</option>
                                <?php
                                    $solicitante = $_POST['nome_solicit'];

                                    try{
                                        //acessa o banco de dados
                                        $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                        
                                        $sql = "SELECT * FROM form_serv WHERE painel = 'MAN2' ORDER BY id DESC";

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
                    <div class="box2">
                        <label for="x" class="ali2">Nº Equipamento:</label>
                        <input name="nome_equipamento" type="text" placeholder="Nº Equipamento" class="input-padrao">
                    </div>

                    <div class="box1">
                        <label for="x" class="ali4">Descrição Equipamento:</label>
                        <input name="num_equipamento" type="text" placeholder="Descrição Equipamento" class="input-padrao3">
                    </div>
                </div>
            </div>

            <br>

            <textarea required style="resize: none" type="text" name="desc" class="desc" placeholder="Descrição"></textarea>
            <br><br>

            <!-- botao salvar cancelar, encerra sessao e retorna ao index -->
            <script language=javascript>
                function confirmacao(){
                if (confirm("Deseja mesmo cancelar? Dados serão perdidos"))
                    window.location.href = "index.php";
                }
            </script>

            <!-- botao salvar adequado dentro de uma div para ser orientado a esquerda da pagina -->
            <div class="tirex">
                <div class="archivedy" onclick="return confirmacao();">CANCELAR</div>
                <button class="archive" type="submit">SALVAR</button>
            </div>
            <br><br>

        </form>

        <form method="get" id="form1" name="form1">
            <h1 style="font-size: 20px; color: #000b49; justify-content: left;">EXECUÇÃO</h1>
            <div class="horizontal ctr2">
                    <div class="align">
            <div class="box1">
                            <label for="x" class="ali1">RECEBIDA POR:</label>
                            <input name="nome_solicit" readonly class="input-padrao disable" value="<?php echo $_SESSION['funcionario']?>" id="x">
                        </div>
                        <div class="box2" style="opacity: 0;">
                            <label for="x" class="ali">Responsável:</label>
                            <input name="nome_solicit" readonly class="input-padrao disable" value="<?php echo $_SESSION['funcionario']?>" id="x">
                        </div>
                        <div class="box3" style="opacity: 0;">
                            <label for="x" class="ali">Responsável:</label>
                            <input name="nome_solicit" readonly class="input-padrao disable" value="<?php echo $_SESSION['funcionario']?>" id="x">
                        </div>
                        </div>
                    </div>
            <div class="horizontal ctr2">
                    <div class="align">
                        <div class="box1">
                            <label for="x" class="ali1">Data INÍCIO: </label>
                            <input name="dt_solicit" required type="date" placeholder="Data da solicitação" class="input-padrao">
                        </div>

                        <div class="box2">
                            <label for="x" class="ali">Hora INÍCIO:</label>
                            <input class="input-padrao" type="time" name="nome"  placeholder="Horário">
                        </div>    

                        <div class="box3">
                            <label for="x" class="ali">Data Prevista:</label>
                            <input name="dt_solicit" required type="date" placeholder="Data da solicitação" class="input-padrao">
                        </div>
                    </div>
                </div>
                <div class="horizontal ctr2">
                    <div class="align">
                        <div class="box1">
                            <label for="x" class="ali1">Executante: </label>
                            <input name="dt_solicit" required type="text" placeholder="Executante" class="input-padrao">
                        </div>

                        <div class="box2">
                            <label for="x" class="ali">Tipo de Serviço:</label>
                            <select class="input-padrao" required>    
                            <option value="">SELECIONE</option>
                                <?php
                                    $solicitante = $_POST['nome_solicit'];

                                    try{
                                        //acessa o banco de dados
                                        $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                        
                                        $sql = "SELECT * FROM form_serv WHERE painel = 'MAN' ORDER BY id DESC";

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
                            <label for="g" class="ali">Prioridade:</label>
                            <select required class="input-padrao" name="g" id="g">
                                <option value="">SELECIONE</option>
                                <option value="ALTA">ALTA</option>
                                <option value="MEDIA">MÉDIA</option>
                                <option value="BAIXA">BAIXA</option>
                            </select>
                        </div>
                    </div>
                </div>
            <br>
     
            <div class="inline">
                <textarea style="resize: none" required type="text" name="obs" class="desc" placeholder="Histórico"></textarea>
                <br><br>

            </div>
            <br>

        </form>
        <br><br>

        <form method="get" id="form1" name="form1">
            <h1 style="font-size: 20px; color: #000b49; justify-content: left;">FINALIZAÇÃO</h1>
            <div class="box3">
                <label for="h" class="ali3">Ordem de serviço:</label>
                <select name="dt_solicit" id="xO" required class="input-padrao2 gray">
                            <option value="">SELECIONE</option>
                            <option value="CONCLUIDA">CONCLUIDA</option>
                            <option value="NAO CONCLUIDA">NAO CONCLUIDA</option>
                            </select>
            </div>
     <br>
            <div class="inline">
                <textarea style="resize: none" required type="text" name="obs" class="desc" placeholder="SERVIÇO REALIZADO OU MOTIVO DO NÃO ATENDIMENTO"></textarea>
                <br><br>

            </div>

            <div class="horizontal ctr2">
                    <div class="align">
                        <div class="box1">
                            <label for="xO" class="ali11">ESTADO EQUIPAMENTO INICIAL: </label>
                            <select name="dt_solicit" id="xO" required class="input-padrao">
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
                            <input name="dt_solicit" readonly type="text" value="<?php echo $hoje;?>" class="input-padrao">
                        </div>

                        <div class="box2">
                            <label for="x" class="ali">Horário Fechamento:</label>
                            <input class="input-padrao" readonly type="text" name="nome" type="text" value="<?php echo $time;?>" >
                        </div>    
                    </div>
                </div>
        </form>
        
    </body>
</main>
</html>