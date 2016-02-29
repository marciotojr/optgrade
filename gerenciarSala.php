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
<form action="adicionaSala.php" method="post">
    <fieldset>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <legend>Dados da Sala</legend>
        <fieldset class="form-group">
            <label for="nome">Codigo</label>
            <input type="text" class="form-control" name="codigo" value="<?php echo $codigo; ?>" placeholder="Insira o nome" maxlength="10">
        </fieldset>
    </fieldset>
    <fieldset class="form-group">
        <label for="curso"><legend>Polo</legend></label>
        <select class="form-control" name="polo" id="polo">
            <?php
            $sql = "SELECT id, nome, cidade, uf FROM polo WHERE id=" . $id_polo . " UNION (SELECT id, nome, cidade, uf FROM polo WHERE id<>" . $id_polo . " ORDER BY nome)";
            $result = mysqli_query($conn, $sql);

            while ($pol = mysqli_fetch_assoc($result)) {
              echo "<option value='" . $pol['id'] . "'>" . $pol['nome'] . " (" . $pol['cidade'] . " / " . $pol['uf'] . ")</option>";
            }
            ?>
        </select>
    </fieldset>
    <button type="submit" class="btn btn-primary" onClick="validaCadastroSala()"><?php if($id=="-1") echo "Cadastrar"; else echo "Salvar altera&ccedil;&otilde;s"; ?></button>  
    <button type="reset" class="btn btn-primary" onClick="changeContent('listaProfessores.php')">Voltar</button>	
</form>

