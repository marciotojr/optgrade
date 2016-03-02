<?php

$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");

$row = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT COALESCE(max(id),0) as maximum FROM colisoes'));
$count = $row['maximum'];

$sql = "SELECT t1.id as base_colisao, t2.id as colidida FROM 
turma t1 INNER JOIN horario h1 ON h1.id_turma=t1.id,
turma t2 INNER JOIN horario h2 ON h2.id_turma=t2.id
WHERE t1.id<>t2.id and (h1.inicio BETWEEN h2.inicio and h2.fim or h1.fim BETWEEN h2.inicio and h2.fim) and t1.id_professor=t2.id_professor ORDER BY t1.id";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  $increment=false;
  $base = "";
  extract($row, EXTR_OVERWRITE);
  if ($base != $base_colisao) {
    $acumulador[$base_colisao] = $base_colisao;
    $base=$base_colisao;
  }
  $sql = "SELECT c1.id_turma as t1, c2.id_turma as t2 FROM colisoes c1, colisoes c2 WHERE c1.id=c2.id and c1.id_turma<>c2.id_turma";
  $break = false;
  while ($rowAux = mysqli_fetch_assoc(mysqli_query($conn, $sql))) {
    extract($rowAux, EXTR_OVERWRITE);
    if(($base==$t1 && $colidida==$t2)||($base==$t2 && $colidida==$t1)){
      $break=true;
      break;
    }
  }
  if (!$break) {
    $sql = 'SELECT * FROM colisoes WHERE id='.$count.' and id_turma= '.$base;
    if (!mysqli_fetch_assoc(mysqli_query($conn, $sql))){
            mysqli_query($conn, "INSERT INTO colisoes(id, id_turma, tipo) VALUES (".$count.",".$base.",'Professor')");
            $increment=true;
    }
    $sql = 'SELECT * FROM colisoes WHERE id='.$count.' and id_turma= '.$colidida;
    if (!mysqli_fetch_assoc(mysqli_query($conn, $sql))){
            mysqli_query($conn, "INSERT INTO colisoes(id, id_turma, tipo) VALUES (".$count.",".$colidida.",'Professor')");
            $increment=true;
    }
   
  }
  if($increment){
    $count+=1;
  }
}


$sql = "SELECT t1.id as base_colisao, t2.id as colidida FROM 
turma t1 INNER JOIN horario h1 ON h1.id_turma=t1.id,
turma t2 INNER JOIN horario h2 ON h2.id_turma=t2.id
WHERE t1.id<>t2.id and (h1.inicio BETWEEN h2.inicio and h2.fim or h1.fim BETWEEN h2.inicio and h2.fim) and t1.id_sala=t2.id_sala ORDER BY t1.id";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  $increment=false;
  $base = "";
  extract($row, EXTR_OVERWRITE);
  if ($base != $base_colisao) {
    $acumulador[$base_colisao] = $base_colisao;
    $base=$base_colisao;
  }
  $sql = "SELECT c1.id_turma as t1, c2.id_turma as t2 FROM colisoes c1, colisoes c2 WHERE c1.id=c2.id and c1.id_turma<>c2.id_turma";
  $break = false;
  while ($rowAux = mysqli_fetch_assoc(mysqli_query($conn, $sql))) {
    extract($rowAux, EXTR_OVERWRITE);
    if(($base==$t1 && $colidida==$t2)||($base==$t2 && $colidida==$t1)){
      $break=true;
      break;
    }
  }
  if (!$break) {
    $sql = 'SELECT * FROM colisoes WHERE id='.$count.' and id_turma= '.$base;
    if (!mysqli_fetch_assoc(mysqli_query($conn, $sql))){
            mysqli_query($conn, "INSERT INTO colisoes(id, id_turma, tipo) VALUES (".$count.",".$base.",'Sala')");
            $increment=true;
    }
    $sql = 'SELECT * FROM colisoes WHERE id='.$count.' and id_turma= '.$colidida;
    if (!mysqli_fetch_assoc(mysqli_query($conn, $sql))){
            mysqli_query($conn, "INSERT INTO colisoes(id, id_turma, tipo) VALUES (".$count.",".$colidida.",'Sala')");
            $increment=true;
    }
   
  }
  if($increment){
    $count+=1;
  }
}

?>