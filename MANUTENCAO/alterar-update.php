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

        $codigo = $_SESSION['cod_funcionario'];

    //comexao banco de dados
    include 'conexao.php'; 
    
    //aramzenando as info informadas pelo o ususario em variaveis
    $solicitacao = strtoupper($_POST['number']);
    $prioridade = strtoupper($_POST['prioridade']);
    $executante = strtoupper($_POST['executante']);
    $novo_executante = strtoupper($_POST['newexecutante']);
    $tipo2 = strtoupper($_POST['tipo2']);
    $nome_solicit = strtoupper($_POST['nome_solicit']);
    $setor_solicit = strtoupper($_POST['setor_solicit']);
    $tipo_servico = strtoupper($_POST['po']);
    $tipo2 = strtoupper($_POST['tipo2']);
    $nome_exec = strtoupper($_POST['nome_exec']);
    $desc = strtoupper($_POST['desc']);

    $caracteres_sem_acento = array(
        'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Â'=>'Z', 'Â'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
        'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Å'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
        'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
        'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
        'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'Å'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
        'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
        'Ä'=>'a', 'î'=>'i', 'â'=>'a', 'È'=>'s', 'È'=>'t', 'Ä'=>'A', 'Î'=>'I', 'Â'=>'A', 'È'=>'S', 'È'=>'T'
    );

    $desc = strtr($desc, $caracteres_sem_acento);

    $desc = strtoupper($desc); 

        //acessa o banco de dados e atualiza as colunas necessarias atravaes das variaveis
        $result = pg_query($conexao, "INSERT INTO form_manut_log
        SELECT *, '$hoje','$time','$codigo'
        FROM form_manut
        WHERE num_solicitacao = $solicitacao");
    
        $sql = pg_query($conexao, "UPDATE public.form_manut
        SET nome_executante = '$novo_executante', tipo_servico2= '$tipo2', prioridade= '$prioridade'
        WHERE num_solicitacao = $solicitacao");
    
    //mensagens de erro ou sucesso em uma janela de avisos
    if (!$sql or !$result){
        echo '<script>
            window.alert("ALGO DEU ERRADO, POR FAVOR ENTRE EM CONTATO COM O SUPORTE DE T.I");
            window.location.href = "index.php";
        </script>';

     exit;

    }else{
        echo '<script>
            window.alert("ALTERAÇÃO SALVA COM SUCESSO!");
            window.location.href = "index.php";
        </script>';
    }

?>