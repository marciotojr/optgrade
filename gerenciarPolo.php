<?php
extract($_POST, EXTR_OVERWRITE);
extract($_GET, EXTR_OVERWRITE);
if (!isset($_GET['id'])) {
  $id = "-1";
  $departamento = "-1";
} else {
  $id = $_GET['id'];
}

$nome = "";
$cidade = "";
$uf = "";

$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
//$db = mysqli_select_db('ihc1', $link) or die('Could not select database.');

$sql = "SELECT nome, cidade, uf FROM polo WHERE id =" . $id;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  if ($polo = mysqli_fetch_assoc($result)) {
    extract($polo, EXTR_OVERWRITE, "polo");
  }
}
$sql = "DELETE FROM polo WHERE polo.id = -1";
mysqli_query($conn, $sql);
?>
<form method="post" action="adicionaPolo.php">
    <fieldset>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <legend>Dados do Polo</legend>
        <fieldset class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" value="<?php echo $nome; ?>"  maxlength="50" placeholder="Insira o nome">
        </fieldset>
        <fieldset class="form-group">
            <label for="cidade">Cidade</label>
            <input type="text" class="form-control" name="cidade" value="<?php echo $cidade; ?>" maxlength="50" placeholder="Insira a cidade">
        </fieldset>
        <fieldset class="form-group">
            <label for="cidade">UF</label>
            <input type="text" class="form-control" maxlength="2" size="2" name="uf" value="<?php echo $uf; ?>" placeholder="Insira a UF">
        </fieldset>
    </fieldset>
    <button type="submit" class="btn btn-primary" onClick="validaCadastroPolo(0)"><?php if($id=="-1") echo "Cadastrar"; else echo "Salvar altera&ccedil;&otilde;s"; ?></button>  
    <button type="reset" class="btn btn-primary" onClick="changeContent('listaPolos.php')">Voltar</button>	
</form>