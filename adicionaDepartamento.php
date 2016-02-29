<?php

function saveToPost($message, $messageType, $page) {
  $_POST["message"] = $message;
  $_POST["messageType"] = $messageType;
  $_POST["page"] = $page;
}

function createTemporary($conn,$id_dep) {
  extract($_POST, EXTR_OVERWRITE);
  mysqli_query($conn, "INSERT INTO departamento_polo (id, id_polo, id_departamento) VALUES (-1, " . $polo . ", ".$id_dep.");");
}

function deleteTemporary($conn) {
  extract($_POST, EXTR_OVERWRITE);
  mysqli_query($conn, "DELETE FROM departamento_polo WHERE id = -1");
}

$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. NÃ£o foi possÃ­vel se conectar ao banco de dados.");
$message = "Erro desconhecido! Tente novamente, em caso de persist&ecirc;ncia chame o administrador!";
$messageType = "danger";
deleteTemporary($conn);
extract($_POST, EXTR_OVERWRITE);

$sql = "SELECT * FROM departamento WHERE nome='".$nome."' and sigla='".$sigla."'";
if (!($dis = mysqli_fetch_assoc(mysqli_query($conn, $sql)))){
  mysqli_query($conn, "INSERT INTO departamento (id, nome, sigla) VALUES (NULL, '" . $nome . "', '" . $sigla . "');");
  $sql = "SELECT * FROM departamento WHERE nome='".$nome."' and sigla='".$sigla."'";
  $dis = mysqli_fetch_assoc(mysqli_query($conn, $sql));
} 
$id_dep=$dis['id'];

if (isset($_POST["id"]) && $_POST["id"] != -1) {
  $sql = "SELECT dp.id as id_departamento_polo FROM departamento_polo dp, departamento d WHERE dp.id_departamento=d.id and d.id=".$id_dep." and dp.id_polo=".$polo." and dp.id<>-1 and dp.id<>" . $id;
  if (mysqli_num_rows($result=mysqli_query($conn, $sql)) > 0) {//caso exista igual a atualizaÃ§Ã£o
    $message = "J&aacute; existe este departamento neste mesmo polo!";
    saveToPost($message, "warning", "gerenciarDepartamento");
    createTemporary($conn,$id_dep);
    include 'main.php';
    die();
  } else {//caso nÃ£o exista igual a atualizaÃ§Ã£o
    echo "UPDATE";
    $dep = mysqli_fetch_assoc($result);
    $sql = "UPDATE departamento_polo SET id_polo = " . $polo . ", id_departamento = " . $id_dep . " WHERE id = " . $id . ";";
    if (mysqli_query($conn, $sql)) {
      $message = "Departamento atualizado com sucesso!";
      $messageType = "success";
    }
  }
} else {
  $sql = "SELECT * FROM departamento_polo dp, departamento d WHERE dp.id_departamento=d.id and d.id=".$id_dep." and dp.id_polo=".$polo;
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {//caso exista igual a adiÃ§Ã£o
    $message = "J&aacute; existe este departamento neste mesmo polo!";
    saveToPost($message, "warning", "gerenciarDepartamento");
    createTemporary($conn,$id_dep);
    include 'main.php';
    die();
  } else {//caso nÃ£o exista igual a adiÃ§Ã£o
    $dep = mysqli_fetch_assoc($result);
    $sql = "INSERT INTO departamento_polo (id, id_polo, id_departamento) VALUES (NULL, " . $polo . ", " . $id_dep.");";
    $result = mysqli_query($conn, $sql);
    $message = "Departamento adicionado com sucesso!";
    $messageType = "success";
  }
}
deleteTemporary($conn);
saveToPost($message, $messageType, "listaDepartamentos");
include 'main.php';
die();
?>