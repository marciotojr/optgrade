<?php

function saveToPost($message, $messageType, $page) {
  $_POST["message"] = $message;
  $_POST["messageType"] = $messageType;
  $_POST["page"] = $page;
}

function createTemporary($conn) {
  extract($_POST, EXTR_OVERWRITE);
  mysqli_query($conn, "INSERT INTO disciplina (id, codigo, nome, id_departamento_polo) VALUES (-1, '" . $codigo . "', '" . $nome . "', " . $departamento . ");");
}

function deleteTemporary($conn) {
  extract($_POST, EXTR_OVERWRITE);
  mysqli_query($conn, "DELETE FROM disciplina WHERE id = -1");
}

$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
$message = "Erro desconhecido! Tente novamente, em caso de persist&ecirc;ncia chame o administrador!";
$messageType = "danger";
extract($_POST, EXTR_OVERWRITE);

if (isset($_POST["id"]) && $_POST["id"] != -1) {
  $sql = "SELECT * FROM disciplina WHERE codigo='" . $codigo . "' and id_departamento_polo=" . $departamento . " and id<>-1 and id<>" . $id;
  if (mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {//caso exista igual a atualização
    $message = "J&aacute; existe uma disciplina com esse mesmo c&oacute;digo!";
    saveToPost($message, "warning", "gerenciarDisciplina");
    createTemporary($conn);
    include 'main.php';
    die();
  } else {//caso não exista igual a atualização
    $sql = "UPDATE disciplina SET codigo = '" . $codigo . "', id_departamento_polo = '" . $departamento . "', nome = '" . $nome . "' WHERE id = " . $id . ";";
    if (mysqli_query($conn, $sql)) {
      $message = "Disiciplina atualizada com sucesso!";
      $messageType = "success";
    }
  }
} else {
  $sql = "SELECT * FROM disciplina WHERE codigo='" . $codigo . "' and id_departamento_polo=" . $departamento;
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {//caso exista igual a adição
    $message = "J&aacute; existe uma disciplina com esse mesmo c&oacute;digo!";
    saveToPost($message, "warning", "gerenciarDisciplina");
    createTemporary($conn);
    include 'main.php';
    die();
  } else {//caso não exista igual a adição
    $sql = "INSERT INTO disciplina (id, codigo, nome, id_departamento_polo) VALUES (NULL, '" . $codigo . "', '" . $nome . "', " . $departamento . ");";
    $result = mysqli_query($conn, $sql);
    $message = "Disicplina adicionada com sucesso!";
    $messageType = "success";
  }
}
deleteTemporary($conn);
saveToPost($message, $messageType, "listaDisciplinas");
include 'main.php';
die();
?>