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
if ($flag_polo = isset($id)) {
  $id_polo = $id;
  unset($id);
  unset($_GET['id']);
  unset($_POST['id']);
}
echo "DELETE FROM polo WHERE id =" . $id_polo;

echo $sql = "SELECT dp.id as id_dep FROM departamento_polo dp WHERE dp.id_polo=" . $id_polo;
$polo_result = mysqli_query($conn, $sql);
while ($polo_corrente = mysqli_fetch_assoc($polo_result)) {
  extract($polo_corrente, EXTR_OVERWRITE);
  $_POST['id_dep'] = $id_dep;
  include 'deletarDepartamento.php';
}

echo $sql = "SELECT id as id_sala FROM sala WHERE id_polo=" . $id_polo;
$polo_result = mysqli_query($conn, $sql);
while ($polo_corrente = mysqli_fetch_assoc($polo_result)) {
  extract($polo_corrente, EXTR_OVERWRITE);
  $_POST['id_sala'] = $id_sala;
  include 'deletarSala.php';
}

mysqli_query($conn, "DELETE FROM polo WHERE id =" . $id_polo);
//echo "DELETE FROM polo WHERE id =" . $id_polo;


if ($flag_polo) {
  saveToPost("Entradas excluídas com sucesso!", "success", "listaDepartamentos");
  include 'main.php';
}
?>