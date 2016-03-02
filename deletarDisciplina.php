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
if ($flag_disc = isset($id)) {
  $id_disc = $id;
  unset($id);
  unset($_GET['id']);
  unset($_POST['id']);
}

$sql = "SELECT t.id as id_turma FROM turma t WHERE t.id_disciplina=" . $id_disc;
$disciplina_result = mysqli_query($conn, $sql);
while ($disciplina_corrente = mysqli_fetch_assoc($disciplina_result)) {
  extract($disciplina_corrente, EXTR_OVERWRITE);
  $_POST['id_turma'] = $id_turma;
  include 'deletarTurma.php';
}

mysqli_query($conn, "DELETE FROM disciplina WHERE id =" . $id_disc);



if ($flag_disc) {
  saveToPost("Entradas excluídas com sucesso!", "success", "listaDisciplinas");
  include 'main.php';
}
?>