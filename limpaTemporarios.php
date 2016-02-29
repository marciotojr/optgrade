<?php
$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
mysqli_query($conn, "DELETE FROM turma WHERE id = -1");
mysqli_query($conn, "DELETE FROM departamento_polo WHERE id = -1");
mysqli_query($conn, "DELETE FROM departamento_polo WHERE id_polo = -1");
mysqli_query($conn, "DELETE FROM departamento_polo WHERE id_departamento = -1");
mysqli_query($conn, "DELETE FROM disciplina WHERE id = -1");
mysqli_query($conn, "DELETE FROM colisoes WHERE id = -1");
mysqli_query($conn, "DELETE FROM colisoes WHERE id_turma = -1");
mysqli_query($conn, "DELETE FROM horario WHERE id_turma = -1");
mysqli_query($conn, "DELETE FROM departamento WHERE id = -1");
mysqli_query($conn, "DELETE FROM sala WHERE id = -1");
mysqli_query($conn, "DELETE FROM professor WHERE id = -1");
mysqli_query($conn, "DELETE FROM polo WHERE id = -1");
?>