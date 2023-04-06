<?php

  //banco de dados
  $myPDO = new PDO("pgsql:host=192.168.0.4;dbname=QUALIDADE","postgres", "Dwf6127d4l5k6@");
                                        
  $categoria = $_GET['solicit'];

  $query = $myPDO->prepare("select cod, descricao, setor
  from form_dep
  where cod = :cod_setor");

  $data = ['cod_setor' => $categoria];
  $query->execute($data);

  $registros = $query->fetchAll(PDO::FETCH_ASSOC);

  //echo '<option value="">SELECIONE UMA SUBTCHEBA</option>';

  foreach($registros as $option) {
  ?>
      <option value="<?php echo $option['cod']?>"><?php echo $option['descricao']?></option>
  <?php
  }

?>