<?php

function saveToPost($message, $messageType, $page) {
  $_POST["message"] = $message;
  $_POST["messageType"] = $messageType;
  $_POST["page"] = $page;
}

$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
$message = "Erro desconhecido! Tente novamente, em caso de persist&ecirc;ncia chame o administrador!";
$messageType = "danger";
extract($_POST, EXTR_OVERWRITE);



$sql = "INSERT INTO polo (id, nome, cidade, uf) VALUES (-1, '" . $nome . "', '" . $cidade . "', '" . $uf . "');";
mysqli_query($conn, $sql);



if (isset($_POST["id"]) && $_POST["id"] != -1) {
  $sql = "UPDATE polo SET nome = '" . $nome . "', cidade = '" . $cidade . "', uf = '" . $uf . "' WHERE polo.id = " . $id;
  if (mysqli_query($conn, $sql)) {
    $message = "Polo atualizado com sucesso!";
    $messageType = "success";
  } else {
    saveToPost($message, $messageType, "gerenciarPolo");
    include 'main.php';
    die();
  }
} else {
  $sql = "SELECT id, nome, cidade FROM polo WHERE id<>-1 and nome = '" . $nome . "'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $message = "J&aacute; existe um polo com essas mesmas informa&ccedil;&otilde;es!";
    saveToPost($message, "warning", "gerenciarPolo");
    include 'main.php';
    die();
  } else {
    $sql = "INSERT INTO polo (id, nome, cidade, uf) VALUES (NULL, '" . $nome . "', '" . $cidade . "', '" . $uf . "');";
    $result = mysqli_query($conn, $sql);
    $message = "Polo adicionado com sucesso!";
    $messageType = "success";
  }
}
saveToPost($message, $messageType, "listaPolos");
include 'main.php';

$sql = "DELETE FROM polo WHERE polo.id = -1";
mysqli_query($conn, $sql);
die();
?>