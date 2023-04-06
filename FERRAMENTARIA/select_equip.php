<?php

  include 'conn.php';

  $categoria = $_GET['num'];

  $query = $conn->prepare("SELECT HB_COD as COD_EQUIP, HB_NOME AS NOME_EQUIP 
  FROM shb010
  WHERE HB_COD = :HB_COD
  ORDER BY HB_COD");

  $data = ['HB_COD' => $categoria];
  $query->execute($data);

  $registros = $query->fetchAll(PDO::FETCH_ASSOC);

  //echo '<option value="">SELECIONE UMA SUBTCHEBA</option>';

  foreach($registros as $option) {
  ?>
      <option value="<?php echo $option['NOME_EQUIP']?>"><?php echo $option['NOME_EQUIP']?></option>
  <?php
  }

?>