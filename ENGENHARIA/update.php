<?php 
    //Inicia a sessão conferindo se o usuário fez login
    session_start(); 
    if (!isset($_SESSION['logon']) or $_SESSION['logon'] == 0){
        header("Location: /FORMS/login/index.php");
    }

    //comexao banco de dados
    include 'conexao.php'; 
    
    //aramzenando as info informadas pelo o ususario em variaveis
    $resultado = strtoupper($_POST['deft']);
    $status = strtoupper($_POST['status']);
    $nome_responsavel = strtoupper($_POST['nome_responsavel']);
    $obs_exec = strtoupper($_POST['obs_exec']);
    $data_solicitacao = date('d/m/Y');
    date_default_timezone_set('America/Sao_Paulo');
    $hora_solicitacao = date('H:i'); 

    $caracteres_sem_acento = array(
        'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Â'=>'Z', 'Â'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
        'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Å'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
        'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
        'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
        'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'Å'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
        'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
        'Ä'=>'a', 'î'=>'i', 'â'=>'a', 'È'=>'s', 'È'=>'t', 'Ä'=>'A', 'Î'=>'I', 'Â'=>'A', 'È'=>'S', 'È'=>'T'
    );

    $obs_exec = strtr($obs_exec, $caracteres_sem_acento);

    $obs_exec = strtoupper($obs_exec);

    //acessa o banco de dados e atualiza as colunas necessarias atravaes das variaveis
    $result = pg_query($conexao, "UPDATE form_eng SET nome_responsavel = '$nome_responsavel', data_fechamento = '$data_solicitacao', hora_fechamento = '$hora_solicitacao', obs_exec = '$obs_exec', status = '$status'
    WHERE num_solicitacao = '$resultado'");

    //mensagens de erro ou sucesso em uma janela de avisos
    if (!$result){
        echo '<script>
            window.alert("ALGO DEU ERRADO, TENTE NOVAMENTE MAIS TARDE");
            window.location.href = "index.php";
        </script>';

     exit;
    }else{
        echo '<script>
            window.alert("EXECUÇÃO SALVA COM SUCESSO!");
            window.location.href = "index.php";
        </script>';

    }

?>