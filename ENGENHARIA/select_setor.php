<?php

  //banco de dados
  $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                        
  $categoria = $_GET['nome'];

  $query = $myPDO->prepare("select d.cod, d.descricao, d.setor, f.nome
  from form_dep d 
  inner join form_func f on f.setor = d.cod
  where f.nome = :funcionario");

  $data = ['funcionario' => $categoria];
  $query->execute($data);

  $registros = $query->fetchAll(PDO::FETCH_ASSOC);

  //echo '<option value="">SELECIONE UMA SUBTCHEBA</option>';

  foreach($registros as $option) {
  ?>
      <option value="<?php echo $option['descricao']?>"><?php echo $option['descricao']?></option>
  <?php
  }

?>