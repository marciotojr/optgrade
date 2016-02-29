<?php

function saveToPost($message, $messageType, $page) {
  $_POST["message"] = $message;
  $_POST["messageType"] = $messageType;
  $_POST["page"] = $page;
}

function createTemporary($conn) {
  extract($_POST, EXTR_OVERWRITE);
  mysqli_query($conn, "INSERT INTO 'professor' ('id', 'nome', 'endereco', 'bairro', 'cidade', 'uf', 'cep', 'email', 'departamento') "
          . "VALUES (-1, \'" . $nome . "\', \'" . $endereco . "\', \'" . $bairro . "\', \'" . $cidade . "\', \'" . $email . "\', \'" . $cep . "\', \'" . $email . "\', \'" . $departamento . "\')");
}

function deleteTemporary($conn) {
  extract($_POST, EXTR_OVERWRITE);
  mysqli_query($conn, "DELETE FROM professor WHERE id = -1");
}

$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
$message = "Erro desconhecido! Tente novamente, em caso de persist&ecirc;ncia chame o administrador!";
$messageType = "danger";
extract($_POST, EXTR_OVERWRITE);







if (isset($_POST["id"]) && $_POST["id"] != -1) {
  $sql = "SELECT * FROM professor WHERE nome='" . $nome . "' and departamento=" . $departamento . " and id<>-1 and id<>" . $id;
  if (mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {//caso exista igual a atualização
    $message = "J&aacute; existe um professor com essas mesmas informa&ccedil;&otilde;es!";
    saveToPost($message, "warning", "gerenciarProfessor");
    createTemporary($conn);
    include 'main.php';
    die();
  } else {//caso não exista igual a atualização
    $sql = "UPDATE professor SET nome = '" . $nome . "', endereco = '" . $endereco . "', bairro = '" . $bairro . "', cidade = '" . $cidade . "', cep = '" . $cep . "', email = '" . $email . "', departamento = '" . $departamento . "' WHERE professor.id = " . $id . ";";
    if (mysqli_query($conn, $sql)) {
      $message = "Professor atualizado com sucesso!";
      $messageType = "success";
    }
  }
} else {
  $sql = "SELECT * FROM professor WHERE nome='" . $nome . "' and departamento=" . $departamento;
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {//caso exista igual a adição
    $message = "J&aacute; existe um professor com essas mesmas informa&ccedil;&otilde;es!";
    saveToPost($message, "warning", "gerenciarProfessor");
    createTemporary($conn);
    include 'main.php';
    die();
  } else {//caso não exista igual a adição
    $sql = "INSERT INTO 'professor' ('id', 'nome', 'endereco', 'bairro', 'cidade', 'uf', 'cep', 'email', 'departamento') "
            . "VALUES (NULL, \'" . $nome . "\', \'" . $endereco . "\', \'" . $bairro . "\', \'" . $cidade . "\', \'" . $email . "\', \'" . $cep . "\', \'" . $email . "\', \'" . $departamento . "\')";
    if (mysqli_query($conn, $sql)) {
      $message = "Professor adicionado com sucesso!";
      $messageType = "success";
    }
  }
}
deleteTemporary($conn);
saveToPost($message, $messageType, "listaProfessores");
include 'main.php';
die();
?>