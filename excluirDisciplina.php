<?php
extract($_POST, EXTR_OVERWRITE);
extract($_GET, EXTR_OVERWRITE);
if (!isset($id_aux)) {
  $id_aux[0] = $id;
  $ver_disc = $id;
  unset($id);
}
if (isset($_GET['id']))
  unset($_GET['id']);
if (isset($_POST['id']))
  unset($_POST['id']);
if (isset($ver_disc))
  echo '<fieldset>
    <legend>Confirmação</legend>' .
  "<div class='alert alert-danger fade in'><strong>Atenção!</strong> As entradas abaixo serão excluídas!<br><strong>Confirme no fim da página.</strong><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";;
?>
<hr/>
<legend>Disciplinas</legend>
<fieldset class="form-group">
    <table class="strippedHover">
        <tr><th>Codigo</th><th>Nome</th><th>Departamento</th><th>Polo</th></tr>
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
          $complement = $complement . " or d.id=" . $value;
        }
        $complement = $complement . " )";
        $sql = "SELECT d.id as id, d.codigo as codigo, d.nome as nome, de.nome as departamento, p.nome as polo  FROM disciplina d, departamento_polo dp, departamento de, polo p WHERE d.id_departamento_polo=dp.id and dp.id_departamento=de.id and dp.id_polo = p.id and " . $complement . " ORDER BY polo, departamento, codigo";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          while ($disciplina = mysqli_fetch_assoc($result)) {
            extract($disciplina, EXTR_OVERWRITE);
            echo '<td>' . $codigo . '</td><td>' . $nome . '</td><td>' . $departamento . '</td><td>' . $polo . '</td></tr>';
          }
        } else {
          echo "<tr><td colspan=5>Nenhuma disciplina registrada.</td></tr>";
        }

        unset($id_aux);
        $sql = "SELECT t.id as id FROM disciplina d, turma t WHERE t.id_disciplina=d.id and " . $complement;
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
if (isset($id_aux))
  include 'excluirTurma.php';
if (isset($ver_disc)) {
  echo '<fieldset><form method="GET" action="deletarDisciplina.php">
    <input type="hidden" name="id" value="' . $ver_disc . '">
        <button type="submit" class="btn btn-primary" >Confirmar Exclusão</button>
    </form></fieldset>';
}
?>