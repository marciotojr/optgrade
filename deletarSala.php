<?php

if (!function_exists('saveToPost')) {

  function saveToPost($message, $messageType, $page) {
    $_POST["message"] = $message;
    $_POST["messageType"] = $messageType;
    $_POST["page"] = $page;
  }

}

$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");

extract($_POST, EXTR_OVERWRITE);
extract($_GET, EXTR_OVERWRITE);
if ($flag_sala = isset($id)) {
  $id_sala = $id;
  unset($id);
  unset($_GET['id']);
  unset($_POST['id']);
}
mysqli_query($conn, "UPDATE turma SET id_sala = NULL WHERE id_sala =" . $id_sala);
mysqli_query($conn, "DELETE FROM sala WHERE id =" . $id_sala);


if ($flag_sala) {
  saveToPost("Entradas excluídas com sucesso!", "success", "listaSalas");
  include 'main.php';
}
?>