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
    <title>RELATÓRIO DE ORDEM DE SERVIÇO MARKETING</title>
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
        <img class="ctr2" src="img/logo-chiaperini.png" alt="img"><p class="white" style="margin-left: 10px; font-size: 25px;">RELATÓRIO DE ORDEM DE<br> SERVIÇO MARKETING</p>
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

    try{
        //acessa o banco de dados
        $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
        
        $sql = "SELECT num_solicitacao FROM form_mkt ORDER BY num_solicitacao DESC LIMIT 1";

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
        <div class="mg">
                <h1 style="font-size: 20px; color: #000b49; justify-content: left;">SOLICITAÇÃO</h1>
        </div>

        <div class="horizontal ctr2">
            <div class="align">
                <div class="box2">
                    <form action="novo.php" method="post">
                        <div class="dropdown">
                            <button class="input-padraop dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php 
                                        $empresa = $_POST['empresa'];

                                        if ($empresa == '' or $empresa == NULL){
                                            $empresa = '';
                                        }

                                        try{
                                            //acessa o banco de dados
                                            $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                            error_reporting(0);
                                            $sql = "SELECT nome FROM form_emp WHERE cod = $empresa";

                                            if (!isset($empresa) or $empresa ==NULL){
                                                echo 'SELECIONE';
                                                $nome_empresa = "";
                                            }else{
                                            foreach($myPDO->query($sql)as $row){
                                                $nome_empresa = $row['nome'];
                                                error_reporting(0);
                                            }  }
                                                
                                        }catch(PDOException $e){
                                            echo $e->getMEssage();
                                            
                                        }

                                        echo $nome_empresa;
                                        $_POST['nome_empresa'] = $nome_empresa;
                                        $_SESSION['nome_empresa'] = $_POST['nome_empresa'];
                                    ?>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <?php
                                        try{
                                            //acessa o banco de dados
                                            $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                            
                                            $sql = "SELECT cod, nome
                                            FROM form_emp";

                                                $i = 1;

                                            foreach($myPDO->query($sql)as $row){

                                                $sql = "SELECT cod, nome
                                                FROM form_emp LIMIT $i";

                                                foreach($myPDO->query($sql)as $row){
                                                    $nome = $row['nome'];
                                                }
                                    
                                                echo '<button type="submit" class="just-hover" name="empresa" value="'.$i.'">'.$nome.'</button>';

                                                $i = $i+1;

                                            }  
                                                
                                        }catch(PDOException $e){
                                            echo $e->getMEssage();
                                                
                                        }
                                    ?>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="box1" style="opacity:0;">
                    <label for="x" class="ali1">Empresa:</label>
                    <input type="text" placeholder="" class="input-padrao">
                </div>

                <div class="box3" style="opacity:0;">
                    <label for="x" class="ali">Horário:</label>
                    <input readonly type="text" value="" class="input-padrao">
                </div>
            </div>
        </div>

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
                        <label for="x" class="ali1">Solicitante:</label>
                        <select name="nome_solicit" required class="input-padrao" id="nome">
                            <option value="">SELECIONE</option>
                                <?php
                                    try{
                                        //acessa o banco de dados
                                        $empresa = $_POST['empresa'];
                                        $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                        
                                        $sql = "SELECT f.nome as funcionario
                                        FROM form_func f
                                        INNER JOIN form_emp e ON f.empresa=e.cod WHERE f.empresa=$empresa";

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
                            <option value="">SELECIONE</option>
                                <?php
                                    try{
                                        //acessa o banco de dados
                                        $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");

                                        $sql = "SELECT d.descricao as descricao
                                        FROM form_dep d
                                        INNER JOIN form_emp e ON d.empresa=e.cod WHERE d.empresa=$empresa";

                                        foreach($myPDO->query($sql)as $row){
                                            $setor = $row['descricao'];

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
                            <option value="">SELECIONE</option>
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
                    <div class="box2">
                        <label for="x" class="ali2">Recebida por:</label>
                        <input style="opacity: 0.6;" type="text" readonly name="recebido_solicit" value="<?php echo $_SESSION['funcionario']; ?>" class="preenche">
                    </div>

                    <div class="box3">
                        <label for="x" class="ali4">Executante:</label>
                        <select name="executante" required class="input-padrao3" id="exec">
                            <option value="">SELECIONE</option>
                                <?php
                                    $solicitante = $_POST['nome_solicit'];

                                    try{
                                        //acessa o banco de dados
                                        $empresa = $_POST['empresa'];
                                        $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                        
                                        $sql = "SELECT f.nome as funcionario
                                        FROM form_func f
                                        INNER JOIN form_emp e ON f.empresa=e.cod WHERE f.empresa=1 ORDER BY f.nome"; // O "1" VAI FORÇAR VIM SOMENTE FUNCIONÁRIOS DA CHIAPERINI
            
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

        <form method="get" id="form1" name="form1" class="disable">
            <h1 style="font-size: 20px; color: #000b49; justify-content: left;">EXECUÇÃO</h1>
            <div class="box3">
                <label for="h" class="ali3">Ordem de serviço:</label>
                    <input class="input-padrao2 gray" value="NAO CONCLUIDA" readonly id="h">
            </div>
            <br>
     
            <div class="inline">
                <textarea style="resize: none" readonly type="text" name="obs" class="desc" placeholder="Serviço realizado ou motivo do não atendimento"></textarea>
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
                            <input readonly class="input-padrao" id="nome" type="text" name="nome_respons"  placeholder="Responsável">
                        </div>
                    </div>
                </div>
            </div>
            <br>

        </form>
        <br><br>
        
    </body>
</main>
</html>