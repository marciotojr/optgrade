<?php
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
?>
<form>
    <fieldset>
        <input type="hidden" id="id" value="<?php echo $id; ?>">
        <legend>Dados do Polo</legend>
        <fieldset class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" value="<?php echo $nome; ?>" placeholder="Insira o nome">
        </fieldset>
        <fieldset class="form-group">
            <label for="cidade">Cidade</label>
            <input type="text" class="form-control" id="cidade" value="<?php echo $cidade; ?>" placeholder="Insira a cidade">
        </fieldset>
        <fieldset class="form-group">
            <label for="cidade">UF</label>
            <input type="text" class="form-control" length="2" size="2" id="uf" value="<?php echo $uf; ?>" placeholder="Insira a UF">
        </fieldset>
    </fieldset>
    <button type="submit" class="btn btn-primary" onClick="validaCadastroPolo(0)"><?php if($id=="-1") echo "Cadastrar"; else echo "Salvar altera&ccedil;&otilde;s"; ?></button>  
    <button type="submit" class="btn btn-primary" onClick="changeContent('listaPolos.php')">Voltar</button>	
</form>