<?php
if (!isset($_GET['id'])) {
  $id = "-1";
  $departamento = "-1";
} else {
  $id = $_GET['id'];
}

$id_polo=-1;
$codigo = "";

$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
//$db = mysqli_select_db('ihc1', $link) or die('Could not select database.');

$sql = "SELECT codigo, id_polo FROM sala WHERE id =" . $id;
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
        <legend>Dados da Sala</legend>
        <fieldset class="form-group">
            <label for="nome">Codigo</label>
            <input type="text" class="form-control" id="sala" value="<?php echo $codigo; ?>" placeholder="Insira o nome">
        </fieldset>
    </fieldset>
    <fieldset class="form-group">
        <label for="curso"><legend>Polo</legend></label>
        <select class="form-control" id="curso">
            <?php
            $sql = "SELECT id, nome, cidade, uf FROM polo WHERE id=" . $id_polo . " UNION (SELECT id, nome, cidade, uf FROM polo WHERE id<>" . $id_polo . " ORDER BY nome)";
            $result = mysqli_query($conn, $sql);

            while ($pol = mysqli_fetch_assoc($result)) {
              echo "<option value='" . $pol['id'] . " '>" . $pol['nome'] . " (" . $pol['cidade'] . " / " . $pol['uf'] . ")</option>";
            }
            ?>
        </select>
    </fieldset>
    <button type="submit" class="btn btn-primary" onClick="validaCadastroSala()">Cadastrar</button>  
    <button type="submit" class="btn btn-primary" onClick="changeContent('listaSalas.php')">Voltar</button>	
</form>

