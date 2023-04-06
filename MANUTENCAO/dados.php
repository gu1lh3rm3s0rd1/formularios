<?php

    include 'conexao.php';

    //armazena os dados preenchidos pelo o usuario em variaveis
    $tipo_servico = $_POST['po'];
    $num_solicitacao = $_POST['n_solicit'];
    $nome_solicitante = $_POST['nome_solicit'];
    $data_solicitacao = $_POST['dt_solicit'];
    $hora_solicitacao = $_POST['hr_solicit'];
    $setor = $_POST['setor_solicit'];
    $nome_equipamento = $_POST['nome_equip'];
    $num_equipamento = $_POST['num_equip'];
    $nome_recebimento = $_POST['recebido_solicit'];
    $descricao = $_POST['desc'];
    $data_solicitacao = date('d/m/Y');
    date_default_timezone_set('America/Sao_Paulo');
    $hora_solicitacao = date('H:i'); 


        //atualiza os dados da tabela quando o usuario salvar o formulario
        $result = pg_query($conexao, "UPDATE form_manut SET nome_solicitante = '$nome_solicitante', data_solicitacao = '$data_solicitacao', hora_solicitacao = '$hora_solicitacao', 
        setor = '$setor', tipo_servico = '$tipo_servico', nome_recebimento = '$nome_recebimento', descricao = '$descricao', num_equipamento = '$num_equipamento', 
        nome_equipamento = '$nome_equipamento' WHERE num_solicitacao = '$num_solicitacao'");

        //$num_solicitacao = $num_solicitacao + 1;

        //$result = pg_query($conexao, "INSERT INTO form_eng (num_solicitacao) VALUES ('$num_solicitacao')");

        if (!$result){
            echo '<script>
            window.alert("ORDEM DE SERVIÇO");
            window.location.href = "index.php";
            </script>';
        exit;
        }else{
            echo '<script>
            window.alert("ORDEM DE SERVIÇO SALVA COM SUCESSO!");
            window.location.href = "index.php";
            </script>';
        }

?>

