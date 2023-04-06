<?php 
  //Inicia a sessão conferindo se o usuário fez login
  session_start(); 
  if (!isset($_SESSION['logon']) or $_SESSION['logon'] == 0){
    header("Location: /FORMS/login/index.php");
  }

  //coexao com o banco de dados
  include 'conexao.php';

  //variaveis recebendo informaçoes preenchidas e salvas pelo usuario solicitante
  $emp = $_SESSION['empresa'];
  $tipo_servico = strtoupper($_POST['po']);
  $nome_solicitante = strtoupper($_SESSION['funcionario']);
  $data_solicitacao = strtoupper($_POST['dt_solicit']);
  $hora_solicitacao = strtoupper($_POST['hr_solicit']);
  $setor = strtoupper($_SESSION['setor']);
  //$nome_recebimento = strtoupper($_SESSION['funcionario']);
  $descricao = strtoupper($_POST['desc']);
  //$nome_executante = strtoupper($_POST['executante']);
  $data_solicitacao = date('d/m/Y');
  date_default_timezone_set('America/Sao_Paulo');
  $hora_solicitacao = date('H:i'); 
  $num_equipamento = strtoupper($_POST['num_equipamento']);
  $nome_equipamento = strtoupper($_POST['nome_equipamento']);

  $caracteres_sem_acento = array(
    'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Â'=>'Z', 'Â'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
    'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Å'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
    'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
    'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
    'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'Å'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
    'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
    'Ä'=>'a', 'î'=>'i', 'â'=>'a', 'È'=>'s', 'È'=>'t', 'Ä'=>'A', 'Î'=>'I', 'Â'=>'A', 'È'=>'S', 'È'=>'T',
  );

  $descricao_sem_Caracteres_especiais = strtr($descricao, $caracteres_sem_acento);

  $descricao_sem_Caracteres_especiais = strtoupper($descricao_sem_Caracteres_especiais);

  //sql que enviará os dados para o banco de dados
  $result = pg_query($conexao, "INSERT INTO form_manut
  (nome_solicitante, 
  data_solicitacao, 
  hora_solicitacao, 
  setor_solicitante, 
  tipo_servico, 
  num_equipamento,
  nome_equipamento,
  descricao, 
  empresa) 
  VALUES 
  ('$nome_solicitante', 
  '$data_solicitacao', 
  '$hora_solicitacao', 
  '$setor', 
  '$tipo_servico', 
  '$num_equipamento',
  '$nome_equipamento',
  '$descricao_sem_Caracteres_especiais', 
  '$emp')");

  $pg_query = $result;

  try{
    //acessa o banco de dados
    $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
    
    //seleciona o numero de solicitacao que acabou de ser gerado pelo insert
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
  
  $num = $result;

  //exibe o numero de solicitacao gerado apos salvar o processo, se der erro, exibe a mesnagem de erro
  if (!$result or !$pg_query){
    echo '<script>
    window.alert("OCORREU UM ERRO, POR FAVOR CONTATE O SUPORTE DE SISTEMAS");
    window.location.href = "index.php";
    </script>';

    //echo $emp;

  exit;
  }else{
    echo '<script>
    window.alert("ORDEM DE SERVIÇO GERADA COM SUCESSO" + "\n" + "\n" + "( NÚMERO DA SOLICITAÇÃO: '.$num.' )");
    window.location.href = "index.php";
    </script>';

    //echo $emp;


  }

?>