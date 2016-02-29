<?php

function saveToPost($message, $messageType, $page) {
  $_POST["message"] = $message;
  $_POST["messageType"] = $messageType;
  $_POST["page"] = $page;
}

function createTemporary($conn) {
  extract($_POST, EXTR_OVERWRITE);
  mysqli_query($conn, "INSERT INTO sala (id, codigo, id_polo) VALUES (-1, '" . $codigo . "', '" . $polo . "');");
}

function deleteTemporary($conn) {
  extract($_POST, EXTR_OVERWRITE);
  mysqli_query($conn, "DELETE FROM sala WHERE id = -1");
}

$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
$message = "Erro desconhecido! Tente novamente, em caso de persist&ecirc;ncia chame o administrador!";
$messageType = "danger";
extract($_POST, EXTR_OVERWRITE);







if (isset($_POST["id"]) && $_POST["id"] != -1) {
  $sql = "SELECT id, codigo, id_polo FROM sala WHERE codigo = '" . $codigo . "' and id_polo='" . $polo . "' and id<>-1 and id<>" . $id;
  if (mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {//caso exista igual a atualização
    $message = "J&aacute; existe uma sala com essas mesmas informa&ccedil;&otilde;es!";
    saveToPost($message, "warning", "gerenciarSala");
    createTemporary($conn);
    include 'main.php';
    die();
  } else {//caso não exista igual a atualização
    $sql = "UPDATE sala SET codigo = '" . $codigo . "', id_polo = '" . $polo . "' WHERE sala.id = " . $id;
    $result = mysqli_query($conn, $sql);
    $message = "Sala atualizada com sucesso!";
    $messageType = "success";
  }
} else {
  $sql = "SELECT id, codigo, id_polo FROM sala WHERE codigo = '" . $codigo . "' and id<>-1 and id_polo='" . $polo . "'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {//caso exista igual a adição
    $message = "J&aacute; existe uma sala com essas mesmas informa&ccedil;&otilde;es!";
    saveToPost($message, "warning", "gerenciarSala");
    createTemporary($conn);
    include 'main.php';
    die();
  } else {//caso não exista igual a adição
    $sql = "INSERT INTO sala (id, codigo, id_polo) VALUES (NULL, '" . $codigo . "', '" . $polo . "');";
    $result = mysqli_query($conn, $sql);
    $message = "Sala adicionado com sucesso!";
    $messageType = "success";
  }
}
deleteTemporary($conn);
saveToPost($message, $messageType, "listaSalas");
include 'main.php';
die();
?>