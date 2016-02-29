<?php

function saveToPost($message, $messageType, $page) {
  $_POST["message"] = $message;
  $_POST["messageType"] = $messageType;
  $_POST["page"] = $page;
}

function createTemporary($conn) {
  extract($_POST, EXTR_OVERWRITE);
  mysqli_query($conn, "INSERT INTO turma (id, id_disciplina, turma) VALUES (-1," . $disciplina . ", '" . $turma . "');");
  foreach ($dia as $key => $value) {
    mysqli_query($conn, "INSERT INTO horario (id_turma, id_dia, inicio, fim) VALUES (-1," . $dia[$key] . ", " . $inicio[$key] . ", " . $fim[$key] . ");");
  }
}

function deleteTemporary($conn) {
  extract($_POST, EXTR_OVERWRITE);
  mysqli_query($conn, "DELETE FROM horario WHERE id_turma = -1");
  mysqli_query($conn, "DELETE FROM turma WHERE id = -1");
}

$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
$message = "Erro desconhecido! Tente novamente, em caso de persist&ecirc;ncia chame o administrador!";
$messageType = "danger";
extract($_POST, EXTR_OVERWRITE);

if (isset($_POST["id"]) && $_POST["id"] != -1) {
  $sql = "SELECT id FROM turma WHERE id_disciplina = " . $disciplina . " and turma='" . $turma . "' and id<>-1 and id<>" . $id;
  if (mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {//caso exista igual a atualização
    $message = "J&aacute; existe uma turma com essas mesmas informa&ccedil;&otilde;es!";
    saveToPost($message, "warning", "gerenciarTurma");
    createTemporary($conn);
    include 'main.php';
    die();
  } else {//caso não exista igual a atualização
    $sql = "UPDATE turma SET id_disciplina= " . $disciplina . ", turma = '" . $turma . "' WHERE id = " . $id;
    $result = mysqli_query($conn, $sql);
    mysqli_query($conn, "DELETE FROM horario WHERE id_turma = " . $id);
    foreach ($dia as $key => $value) {
      mysqli_query($conn, "INSERT INTO horario (id_turma, id_dia, inicio, fim) VALUES (" . $id . "," . $dia[$key] . ", " . $inicio[$key] . ", " . $fim[$key] . ");");
    }
    $message = "Turma atualizada com sucesso!";
    $messageType = "success";
  }
} else {
  $sql = "SELECT id FROM turma WHERE id_disciplina = " . $disciplina . " and turma='" . $turma . "'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {//caso exista igual a adição
    $message = "J&aacute; existe uma turma com essas mesmas informa&ccedil;&otilde;es!";
    saveToPost($message, "warning", "gerenciarTurma");
    createTemporary($conn);
    include 'main.php';
    die();
  } else {//caso não exista igual a adição
    $sql = "INSERT INTO turma (id, id_disciplina, turma) VALUES (NULL, " . $disciplina . ", '" . $turma . "');";
    $result = mysqli_query($conn, $sql);

    $sql = "SELECT id FROM turma WHERE id_disciplina = " . $disciplina . " and turma='" . $turma . "'";
    $result = mysqli_query($conn, $sql);
    $result=mysqli_fetch_assoc($result);
    $id=$result["id"];
    mysqli_query($conn, "DELETE FROM horario WHERE id_turma = " . $id);
    foreach ($dia as $key => $value) {
      mysqli_query($conn, "INSERT INTO horario (id_turma, id_dia, inicio, fim) VALUES (" . $id . "," . $dia[$key] . ", " . $inicio[$key] . ", " . $fim[$key] . ");");
    }
    $message = "Turma adicionada com sucesso!";
    $messageType = "success";
  }
}
saveToPost($message, $messageType, "listaTurmas");
include 'main.php';
die();
?>