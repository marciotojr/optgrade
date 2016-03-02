<form method="post" action="corrigeColisoes.php">
<?php
if (!isset($_GET['id'])) {
  $id = "-1";
  $departamento = "-1";
} else {
  $id = $_GET['id'];
}
extract($_POST, EXTR_OVERWRITE);

echo '<input type="hidden" name="acao" value="aloca">'; 

$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
//$db = mysqli_select_db('ihc1', $link) or die('Could not select database.');


    $_GET['id']=$id;
    include("realocaItem.php");
  
?>
    <br>
    <fieldset>
        <button type="submit" class="btn btn-primary" onclick="validaCadastroTurma()"><?php if($id=="-1") echo "Cadastrar"; else echo "Salvar altera&ccedil;&otilde;s"; ?></button>
        <button type="reset" class="btn btn-primary" onClick="changeContent('listaTurmas.php')">Voltar</button>	
    </fieldset>
</form>