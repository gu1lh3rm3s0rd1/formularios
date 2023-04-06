<?php

    //conexao oracle database
    //    $conexao = oci_connect('P11PROD', 'P11PROD', '192.168.0.12/orcl');
    //    if (!$conexao) { 
    //    $erro = oci_error();
    //    trigger_error(htmlentities($erro['message'], ENT_QUOTES), E_USER_ERROR);
    //    exit;
    //    }

    //conexao oracle database PDO
    $db = " (DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.0.12)(PORT = 1521))
    (CONNECT_DATA = (SID = orcl))
    )";

    $user = "P11PROD";
    $pass = "P11PROD";

    try{
        $conn = new PDO("oci:dbname=".$db,$user,$pass);

    }catch(PDOException $e){
        echo ($e->getMessage());

    }

?>