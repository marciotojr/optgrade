<?php
$conn = mysqli_connect('localhost', 'root', '','ihc1');
	if(!$conn)
		die("Erro fatal. Não foi possível se conectar ao banco de dados.");
$sql = "SELECT id, nome, codigo FROM disciplina WHERE id_departamento_polo=".$_GET["q"]." ORDER BY nome";
$result = mysqli_query($conn, $sql);

while ($dis = mysqli_fetch_assoc($result)) {
  echo "<option value='" . $dis['id'] . " '>" . $dis['nome'] . "</option>";
}
?>