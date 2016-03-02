<?php

function saveToPost($message, $messageType) {
  $_POST["message"] = $message;
  $_POST["messageType"] = $messageType;
  $_POST["page"] = "";
}

$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
$message = "Erro desconhecido! Tente novamente, em caso de persist&ecirc;ncia chame o administrador!";
$messageType = "danger";
extract($_POST, EXTR_OVERWRITE);



$sql = "SELECT id FROM turma WHERE id>=0";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  $sql = "SELECT  s.id as sala
FROM sala s
INNER JOIN polo p ON p.id=s.id_polo
INNER JOIN departamento_polo dp ON dp.id_polo=p.id
INNER JOIN disciplina d ON d.id_departamento_polo=dp.id
INNER JOIN turma t ON t.id_disciplina=d.id
WHERE t.id=" . $row['id'] . "
ORDER BY RAND()
LIMIT 0,1";
  $update = mysqli_query($conn, $sql);
  if ($update = mysqli_fetch_assoc($update)) {
    mysqli_query($conn, 'UPDATE turma SET id_sala=' . $update['sala'] . ' WHERE id=' . $row['id']);
  }

  $sql = "SELECT  p.id as professor
FROM professor p
INNER JOIN departamento_polo dp ON dp.id=p.departamento
INNER JOIN disciplina d ON d.id_departamento_polo=dp.id
INNER JOIN turma t ON t.id_disciplina=d.id
WHERE t.id=" . $row['id'] . "
ORDER BY RAND()
LIMIT 0,1";
  $update = mysqli_query($conn, $sql);
  if ($update = mysqli_fetch_assoc($update)) {
    mysqli_query($conn, 'UPDATE turma SET id_professor=' . $update['professor'] . ' WHERE id=' . $row['id']);
  }
}
saveToPost("Grade gerada com sucesso <br><strong>Verifique as falhas e colisões no fim da árvore de informações</strong>", "success");
include 'procuraColisoes.php';
include 'main.php';
?>

