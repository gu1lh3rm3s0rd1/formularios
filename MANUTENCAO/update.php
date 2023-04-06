<?php 
    //Inicia a sessão conferindo se o usuário fez login
    session_start(); 
    if (!isset($_SESSION['logon']) or $_SESSION['logon'] == 0){
        header("Location: /FORMS/login/index.php");
    }

    //comexao banco de dados
    include 'conexao.php'; 
    //echo $_POST['deft'];
    //aramzenando as info informadas pelo o ususario em variaveis
    $resultado = $_POST['deft'];
    $nome_recebimento = $_SESSION['funcionario'];
    $nome_executante = $_POST['nome_exec'];
    $tipo_servico2 = $_POST['tipo2'];
    $prioridade = $_POST['prioridade'];
    $dt_inicio = $_POST['dt_inicio'];
    $hr_inicio = $_POST['hr_inicio'];
    $dt_prevista = $_POST['dt_prevista'];
    $historico = $_POST['historico'];

    $caracteres_sem_acento = array(
        'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Â'=>'Z', 'Â'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
        'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Å'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
        'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
        'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
        'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'Å'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
        'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
        'Ä'=>'a', 'î'=>'i', 'â'=>'a', 'È'=>'s', 'È'=>'t', 'Ä'=>'A', 'Î'=>'I', 'Â'=>'A', 'È'=>'S', 'È'=>'T'
    );

    $historico = strtr($historico, $caracteres_sem_acento);

    $resultado = strtoupper($resultado);
    $nome_recebimento = strtoupper($nome_recebimento);
    $nome_executante = strtoupper($nome_executante);
    $tipo_servico2 = strtoupper($tipo_servico2);
    $prioridade = strtoupper($prioridade);
    $dt_inicio = strtoupper($dt_inicio);
    $hr_inicio = strtoupper($hr_inicio);
    $dt_prevista = strtoupper($dt_prevista);
    $historico = strtoupper($historico);

    //acessa o banco de dados e atualiza as colunas necessarias atravaes das variaveis
    $result = pg_query($conexao, "UPDATE form_manut SET nome_recebimento = '$nome_recebimento', nome_executante = '$nome_executante', tipo_servico2 = '$tipo_servico2', prioridade = '$prioridade', data_inicio = '$dt_inicio', hora_inicio = '$hr_inicio', data_prevista = '$dt_prevista', obs_exec = '$historico'
    WHERE num_solicitacao = '$resultado'");

    //$pg_result = $result;

    //mensagens de erro ou sucesso em uma janela de avisos
    if (!$result){
        echo '<script>
            window.alert("ALGO DEU ERRADO, TENTE NOVAMENTE MAIS TARDE");
            window.location.href = "index.php";
        </script>';

     exit;
    }else{
        echo '<script>
            window.alert("EXECUÇÃO AGENDADA COM SUCESSO!");
            window.location.href = "index.php";
        </script>';

    }

?>