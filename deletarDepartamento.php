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
if ($flag_dep = isset($id)) {
  $id_dep = $id;
  unset($id);
  unset($_GET['id']);
  unset($_POST['id']);
}

$sql = "SELECT d.id as id_disc FROM disciplina d WHERE d.id_departamento_polo=" . $id_dep;
$departamento_result = mysqli_query($conn, $sql);
while ($departamento_corrente = mysqli_fetch_assoc($departamento_result)) {
  extract($departamento_corrente, EXTR_OVERWRITE);
  $_POST['id_disc'] = $id_disc;
  include 'deletarDisciplina.php';
}

$sql = "SELECT id as id_professor FROM professor WHERE departamento=" . $id_dep;
$departamento_result = mysqli_query($conn, $sql);
while ($departamento_corrente = mysqli_fetch_assoc($departamento_result)) {
  extract($departamento_corrente, EXTR_OVERWRITE);
  $_POST['id_professor'] = $id_professor;
  include 'deletarProfessor.php';
}

mysqli_query($conn, "DELETE FROM departamento_polo WHERE id =" . $id_dep);



if ($flag_dep) {
  saveToPost("Entradas excluídas com sucesso!", "success", "listaDepartamentos");
  include 'main.php';
}
?>