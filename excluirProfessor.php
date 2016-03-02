<?php
extract($_POST, EXTR_OVERWRITE);
extract($_GET, EXTR_OVERWRITE);
if (!isset($id_aux)) {
  $id_aux[0] = $id;
  $ver_prof = $id;
  unset($id);
}
if (isset($_GET['id']))
  unset($_GET['id']);
if (isset($_POST['id']))
  unset($_POST['id']);
if (isset($ver_prof))
  echo '<fieldset>
    <legend>Confirmação</legend>' .
  "<div class='alert alert-danger fade in'><strong>Atenção!</strong> O professor será excluído e as turmas abaixo ficarão sem professor!<br><strong>Confirme no fim da página.</strong><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";;
?>
<hr/>
<legend>Professores</legend>
<fieldset class="form-group">
    <table class="strippedHover">
        <tr><th>Nome</th><th>Departamento</th><th>Polo</th></tr>
        <?php
        $id = "";
        $codigo = "";
        $nome = "";
        $departamento = "";
        $polo = "";

        $conn = mysqli_connect('localhost', 'root', '', 'ihc1');
        if (!$conn)
          die("Erro fatal. Não foi possível se conectar ao banco de dados.");
//$db = mysqli_select_db('ihc1', $link) or die('Could not select database.');
        $complement = "( false ";
        foreach ($id_aux as $key => $value) {
          $complement = $complement . " or p.id=" . $value;
        }
        $complement = $complement . " )";
        $sql = "SELECT p.id as id, p.nome as nome, d.nome as departamento, po.nome as polo FROM professor p, departamento d, polo po, departamento_polo dp WHERE p.departamento=dp.id and dp.id_polo = po.id and dp.id_departamento=d.id and " . $complement . " ORDER BY polo, departamento, nome";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($disciplina = mysqli_fetch_assoc($result)) {
            extract($disciplina, EXTR_OVERWRITE);
            echo '<td>' . $nome . '</td><td>' . $departamento . '</td><td>' . $polo . '</td></tr>';
          }
        } else {
          echo "<tr><td colspan=5>Nenhum professor registrado.</td></tr>";
        }

        unset($id_aux);
        $sql = "SELECT t.id as id FROM professor p, turma t WHERE t.id_professor=p.id and " . $complement;
        $result = mysqli_query($conn, $sql);


        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            extract($row, EXTR_OVERWRITE);
            $id_aux[$id] = $id;
          }
        }
        ?>
    </table>
</fieldset>
<?php
if (isset($ver_prof)&&isset($id_aux)) {

  include 'excluirTurma.php';
}
if (isset($ver_prof))
  echo '<form method="GET" action="deletarProfessor.php">
    <input type="hidden" name="id" value="' . $ver_prof . '">
    <fieldset>
        <button type="submit" class="btn btn-primary" >Confirmar Exclusão</button>
        </form>
    </fieldset>';
?>