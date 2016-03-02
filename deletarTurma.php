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
if ($flag_turma = isset($id)) {
  $id_turma = $id;
  unset($id);
  unset($_GET['id']);
  unset($_POST['id']);
}

mysqli_query($conn, "DELETE FROM horario WHERE id_turma=" . $id_turma);
mysqli_query($conn, "DELETE FROM colisoes WHERE id_turma=" . $id_turma);
mysqli_query($conn, "DELETE FROM turma WHERE id =" . $id_turma);

$sql = "SELECT id as id_col,COUNT(DISTINCT id_turma) FROM colisoes GROUP BY id HAVING COUNT(DISTINCT id_turma)<2";
$turma_result = mysqli_query($conn, $sql);
while ($turma_corrente = mysqli_fetch_assoc($turma_result)) {
  mysqli_query($conn, "DELETE FROM colisoes WHERE id=" . $turma_corrente['id_col']);
}
include 'procuraColisoes.php';
if ($flag_turma) {
  saveToPost("Entradas excluídas com sucesso!", "success", "listaTurmas");
  include 'main.php';
}
?>