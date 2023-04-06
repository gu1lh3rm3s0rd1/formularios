<!--Autenticação define o logado como falso até fazer login-->
<?php session_start(); $_SESSION['logon'] = 0; $_SESSION['dep'] = ''; $_SESSION['paineis'] = -1; $_SESSION['adm'] = 0;?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
        <title>Login</title>
    </head>
<body>

    <!--Função que esconde mensagem de erro de login ao clicar nos inputs-->
    <script>
        function hide(){
            document.getElementById("mensagem").style.display="none";

        }
    </script>

    <!--Faixa azul com logotipo-->
    <div class="backy"><img src="img/logo-chiaperini.png" class="imagem" id="logo" href="index.html"></div><br>

    <?php
        ///////////////////////////////////////////////////////////////////////////////////////////////////////
        //Chama o Banco de Dados e verifica se estão em branco os valores nome e senha digitados pelo usuário

        include('conexao.php');
        
        if(isset($_POST['usuario']) || isset($_POST['senha'])) {

            if(strlen($_POST['usuario']) == 0) {          
                echo '';
            
            } else if(strlen($_POST['senha']) == 0) {
                echo '';
            
            } else {

                //Declarando Variáveis que armazenam os dados digitados pelo usuário
                $usuario = $_POST['usuario'];
                $senha = $_POST['senha'];

                ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
                //Se não houver os dados informados em nenhuma tabela, os valores são definidos como 0
                //Enquanto as variáveis de sessão definidas forem = 0, o usuário não tem acesso aos paineis respectivos
                $_SESSION['ENGENHARIA'] = 0;
                $dep = 0;
                $_SESSION['MANUTENÇÃO'] = 0;
                $_SESSION['FERRAMENTARIA'] = 0;
                $_SESSION['MARKETING'] = 0;
                $_SESSION['abrir'] = 0;
                $_SESSION['executar'] = 0;
                $_SESSION['logon'] = 0;
                $_SESSION['acess'] = 0;
                $_SESSION['adm'] = 0;
                $_SESSION['setor-painel'] = '';
                $_SESSION['MAN_ADM'] = 0;
                $user = "";

                try{
                    //acessa o banco de dados
                    $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                        
                    $adm = "SELECT * FROM form_login WHERE usuario = '$usuario' AND senha = '$senha' AND admin = 1";

                    $sql = "SELECT * FROM form_login WHERE usuario = '$usuario' AND senha = '$senha' ";
                        
                    foreach($myPDO->query($adm)as $row){
                        $user = $row['usuario'];
                        $dep = $row['dep'];
                        $codigo = $row['func'];
                        $_SESSION['dep'] = '';
                        $password = $row['senha'];
                        $_SESSION['adm'] = 1;
                        error_reporting(0);

                }

                if ($user == "" or $user == NULL){

                    foreach($myPDO->query($sql)as $row){
                        $user = $row['usuario'];
                        $dep = $row['dep'];
                        $codigo = $row['func'];
                        $password = $row['senha'];
                        $_SESSION['adm'] = 0;
                        error_reporting(0);    
                }

                }

                }catch(PDOException $e){
                    echo $e->getMEssage();
                        
                }
 
                if ($dep == 'ENG'){

                    if ($_SESSION['adm'] == 1){
                        $_SESSION['dep'] = 'ENG';
                    }
                    $_SESSION['setor-painel'] = 'ENG';

                }else if ($dep == 'FER'){

                    if ($_SESSION['adm'] == 1){
                        $_SESSION['dep'] = 'FER';
                    }
                    $_SESSION['setor-painel'] = 'FER';

                }if ($dep == 'MAN'){

                    if ($_SESSION['adm'] == 1){
                        $_SESSION['dep'] = 'MAN';
                    }
                    $_SESSION['setor-painel'] = 'MAN';

                }if ($dep == 'MKT'){

                    if ($_SESSION['adm'] == 1){
                        $_SESSION['dep'] = 'MKT';
                    }
                    $_SESSION['setor-painel'] = 'MKT';

                }

                error_reporting(0);
                if ($user == $usuario and $password == $senha){
                    try{
                        //acessa o banco de dados
                        $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                            
                        $sql = "SELECT e.nome as nome, f.setor as setor, l.id as id, l.usuario as usuario, l.senha as senha,f.nome funcionario, d.descricao
                        FROM form_func f 
                        INNER JOIN form_login l ON l.func = f.cod
                        INNER JOIN form_dep d ON d.cod = f.setor
                        INNER JOIN form_emp e ON f.empresa = e.cod
                        WHERE usuario = '$usuario' AND senha = '$senha'";
                    
                        foreach($myPDO->query($sql)as $row){
                            $funcionario = $row['funcionario'];
                            $setor = $row['descricao'];
                            $cod_setor = $row['setor'];
                            $empresa = $row['nome'];
                            $id = $row['id'];

                            error_reporting(0);

                        }  
                                
                    }catch(PDOException $e){
                        echo $e->getMEssage();
                            
                    }

                    $_SESSION['abrir'] = 1;
                    $_SESSION['executar'] = 1;
                    $_SESSION['logon'] = 1;
                    $_SESSION['paineis'] = 1;
                    $_SESSION['ENGENHARIA'] = 1;
                    $_SESSION['MANUTENÇÃO'] = 1;
                    $_SESSION['FERRAMENTARIA'] = 1;
                    $_SESSION['MARKETING'] = 1;
                    $_SESSION['funcionario'] = $funcionario;
                    $_SESSION['cod_funcionario'] = $codigo;
                    $_SESSION['setor'] = $setor;
                    $_SESSION['empresa'] = $empresa;
                    $_SESSION['cod-setor'] = $cod_setor;

                    header('Location: index_select.php');
                            
                } else{
                    echo '<script>window.alert("Usuário ou senha incorretos, por favor tente novamente.")</script>';

                }

            }}

        /*        
                try{
                    //acessa o banco de dados
                    $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                        
                    $adm = "SELECT * FROM form_login WHERE usuario = '$usuario' AND senha = '$senha' AND admin = 1";

                    $sql = "SELECT * FROM form_login WHERE usuario = '$usuario' AND senha = '$senha' ";
                        
                    foreach($myPDO->query($adm)as $row){
                        $user = $row['usuario'];
                        $dep = $row['dep'];
                        $codigo = $row['func'];
                        $_SESSION['dep'] = '';
                        $password = $row['senha'];
                        $_SESSION['adm'] = 1;
                        error_reporting(0);

                }

                if ($user == "" or $user == NULL){

                    foreach($myPDO->query($sql)as $row){
                        $user = $row['usuario'];
                        $dep = $row['dep'];
                        $codigo = $row['func'];
                        $password = $row['senha'];
                        $_SESSION['adm'] = 0;
                        error_reporting(0);    
                }

                }

                }catch(PDOException $e){
                    echo $e->getMEssage();
                        
                }
 
                if ($dep == 'ENG'){

                    if ($_SESSION['adm'] == 1){
                        $_SESSION['dep'] = 'ENG';
                    }
                    $_SESSION['setor-painel'] = 'ENG';

                }else if ($dep == 'FER'){

                    if ($_SESSION['adm'] == 1){
                        $_SESSION['dep'] = 'FER';
                    }
                    $_SESSION['setor-painel'] = 'FER';

                }if ($dep == 'MAN'){

                    if ($_SESSION['adm'] == 1){
                        $_SESSION['dep'] = 'MAN';
                    }
                    $_SESSION['setor-painel'] = 'MAN';

                }if ($dep == 'MKT'){

                    if ($_SESSION['adm'] == 1){
                        $_SESSION['dep'] = 'MKT';
                    }
                    $_SESSION['setor-painel'] = 'MKT';

                }

                error_reporting(0);
                if ($user == $usuario and $password == $senha){
                    try{
                        //acessa o banco de dados
                        $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                            
                        $sql = "SELECT l.id as id, l.usuario as usuario, l.senha as senha,f.nome funcionario, d.descricao
                        FROM form_func f 
                        INNER JOIN form_login l ON l.func = f.cod
                        INNER JOIN form_dep d ON d.cod = f.setor
                        WHERE usuario = '$usuario' AND senha = '$senha'";
                    
                        foreach($myPDO->query($sql)as $row){
                            $funcionario = $row['funcionario'];
                            $setor = $row['descricao'];
                            $id = $row['id'];

                            error_reporting(0);

                        }  
                                
                    }catch(PDOException $e){
                        echo $e->getMEssage();
                            
                    }

                    $_SESSION['abrir'] = 1;
                    $_SESSION['executar'] = 1;
                    $_SESSION['logon'] = 1;
                    $_SESSION['paineis'] = 1;
                    $_SESSION['ENGENHARIA'] = 1;
                    $_SESSION['MANUTENÇÃO'] = 0;
                    $_SESSION['FERRAMENTARIA'] = 1;
                    $_SESSION['MARKETING'] = 1;
                    $_SESSION['funcionario'] = $funcionario;
                    $_SESSION['cod_funcionario'] = $codigo;
                    $_SESSION['setor'] = $setor;
                    header('Location: index_select.php');
                            
                } else{
                    echo '<script>window.alert("Usuário ou senha incorretos, por favor tente novamente.")</script>';

                }



                
            }
        } 

        echo '<br>'
        */
    ?>

    <script>
        function trocahide(){
            document.getElementById('nada').style.display = 'none';
            document.getElementById('tudo').style.display = 'block';}

        function trocashow(){
            document.getElementById('nada').style.display = 'block';
            document.getElementById('tudo').style.display = 'none';}
    </script>

    <!------------------------------------------------------------------------------------------------------------------->
    <!--Formulário LOGIN-->
    <main class="main-ctr" id="tudo">
        <div class="flex">
            <form class="ctr form-login" action="" method="POST">
                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script> 

                <lottie-player src="json/enter.json" background="transparent" speed="1" style="margin: 0px auto 0px auto ; width: 60px; height: 60px;" loop autoplay></lottie-player>

                <h1 class="titulo3">Seja bem-vindo!</h1>
                <h1 class="titulo2">Faça seu login</h1>

                <!--Imagem usuário-->
                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script> 

                <lottie-player class="fiote" src="json/user.json" background="transparent" speed="1.5" autoplay></lottie-player>

                <!--Input nome-->
                <div class="ctr">
                    <span class="span1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg>
                    </span>
                    <input onclick="hide()" required class="intro" type="text" name="usuario" placeholder="Usuário">

                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-fill"  viewBox="0 0 0 0">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg>
                    </span>
                </div>

                <!--Input senha-->
                <div class="ctr">
                    <span class="span2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                        </svg>
                    </span>
                    <input onclick="hide()" required class="intro" type="password" name="senha" placeholder="Senha">

                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 0 0">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg>
                    </span>
                </div>

                <button class="btn-sg" href="#ap" type="submit">Entrar</button><p></p>
            </form>
        </div>
    </main>

        <!--Mensagens de erro caso o login e senha sejam inválidos-->
        <?php
            if(isset($_POST['usuario']) || isset($_POST['senha'])) {

                if(strlen($_POST['usuario']) == 0) {

                    echo '<br><div class="ctr2" id="mensagem"><h1 class="info"> USUÁRIO OU SENHA EM BRANCO</h1></div>';
                } else if(strlen($_POST['senha']) == 0) {

                    echo '<br><div class="ctr2" id="mensagem"><h1 class="info"> USUÁRIO OU SENHA EM BRANCO</h1></div>';
                } else {

                //Se o valor for diferente de 0 e não estiver no banco, mostra uma mensagem de erro
            if ($usuario != 0 and $senha != 0){
                echo '<br><div class="ctr2" id="mensagem"><h1 class="info"> USUÁRIO OU SENHA INCORRETOS</h1></div>';
            }}}
        ?>

</body>
</html>