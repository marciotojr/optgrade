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
if ($flag_professor = isset($id)) {
  $id_professor = $id;
  unset($id);
  unset($_GET['id']);
  unset($_POST['id']);
}
mysqli_query($conn, "UPDATE turma SET id_professor = NULL WHERE id_professor =" . $id_professor);
mysqli_query($conn, "DELETE FROM professor WHERE id =" . $id_professor);


if ($flag_professor) {
  saveToPost("Entradas excluídas com sucesso!", "success", "listaProfessores");
  include 'main.php';
}
?>