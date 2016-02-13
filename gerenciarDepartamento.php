<?php
if (!isset($_GET['id'])) {
  $id = "-1";
  $departamento = "-1";
} else {
  $id = $_GET['id'];
}

$id_polo = -1;
$codigo = "";
$nome = "";
$sigla = "";

$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
//$db = mysqli_select_db('ihc1', $link) or die('Could not select database.');

$sql = "SELECT d.sigla as sigla, d.nome as nome, id_polo FROM departamento d, polo p, departamento_polo dp WHERE d.id=dp.id_departamento and p.id=dp.id_polo and dp.id =" . $id;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  if ($sala = mysqli_fetch_assoc($result)) {
    extract($sala, EXTR_OVERWRITE);
  }
}
?>
<form>
    <fieldset>
        <input type="hidden" id="id" value="<?php echo $id; ?>">
        <legend>Dados do Departamento</legend>
        <fieldset class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" value="<?php echo $nome; ?>" placeholder="Insira o nome">
        </fieldset>
        <fieldset class="form-group">
            <label for="sigla">Sigla</label>
            <input type="text" class="form-control" id="sigla" value="<?php echo $sigla; ?>" placeholder="Insira a sigla">
        </fieldset>
    </fieldset>
    <fieldset class="form-group">
        <label for="curso"><legend>Polo</legend></label>
        <select class="form-control" id="polo">
            <?php
            $sql = "SELECT id, nome, cidade, uf FROM polo WHERE id=" . $id_polo . " UNION (SELECT id, nome, cidade, uf FROM polo WHERE id<>" . $id_polo . " ORDER BY nome)";
            $result = mysqli_query($conn, $sql);

            while ($pol = mysqli_fetch_assoc($result)) {
              echo "<option value='" . $pol['id'] . " '>" . $pol['nome'] . " (" . $pol['cidade'] . " / " . $pol['uf'] . ")</option>";
            }
            ?>
        </select>
    </fieldset>
    <button type="submit" class="btn btn-primary" onClick="validaCadastroSala()"><?php if($id=="-1") echo "Cadastrar"; else echo "Salvar altera&ccedil;&otilde;s"; ?></button>  
    <button type="submit" class="btn btn-primary" onClick="changeContent('listaSalas.php')">Voltar</button>	
</form>

