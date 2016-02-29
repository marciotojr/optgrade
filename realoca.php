<form method="post" action="corrigeColisoes.php">
<?php
if (!isset($_GET['id'])) {
  $id = "-1";
  $departamento = "-1";
} else {
  $id = $_GET['id'];
}

$turma = "";
$disciplina = "-1";
$departamento = "-1";
$dp = "-1";

$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
//$db = mysqli_select_db('ihc1', $link) or die('Could not select database.');

$sql = "SELECT id_turma, tipo FROM colisoes WHERE id=" . $id;
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) {
  while ($turmas = mysqli_fetch_assoc($res)) {
    extract($turmas, EXTR_OVERWRITE);
    $_GET['id']=$id_turma;
    include("realocaItem.php");
  }
}
?>
    <br>
    <fieldset>
        <button type="submit" class="btn btn-primary" onclick="validaCadastroTurma()"><?php if($id=="-1") echo "Cadastrar"; else echo "Salvar altera&ccedil;&otilde;s"; ?></button>
        <button type="reset" class="btn btn-primary" onClick="changeContent('listaTurmas.php')">Voltar</button>	
    </fieldset>
</form>