<?php
extract($_POST, EXTR_OVERWRITE);
extract($_GET, EXTR_OVERWRITE);
if (!isset($id_aux)) {
  $id_aux[0] = $id;
  $ver_sala = $id;
  unset($id);
}
if (isset($_GET['id']))
  unset($_GET['id']);
if (isset($_POST['id']))
  unset($_POST['id']);
if (isset($ver_sala))
  echo '<fieldset>
    <legend>Confirmação</legend>' .
  "<div class='alert alert-danger fade in'><strong>Atenção!</strong> A sala será excluída e as turmas abaixo ficarão sem sala!<br><strong>Confirme no fim da página.</strong><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";;
?>
<hr/>
<legend>Salas</legend>
<fieldset class="form-group">
    <table class="strippedHover">
        <tr><th>Codigo</th><th>Polo</th></tr>
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
        $sql = "DELETE FROM sala WHERE id = -1";
        mysqli_query($conn, $sql);

        $complement = "( false ";
        foreach ($id_aux as $key => $value) {
          $complement = $complement . " or s.id=" . $value;
        }
        $complement = $complement . " )";
        $sql = "SELECT s.id as id, s.codigo as codigo, p.nome as polo FROM sala s, polo p WHERE s.id_polo=p.id and ".$complement." ORDER BY polo, codigo";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($disciplina = mysqli_fetch_assoc($result)) {
            extract($disciplina, EXTR_OVERWRITE);
            echo '<td>' . $codigo . '</td><td>' . $polo . '</td></tr>';
          }
        } else {
          echo "<tr><td colspan=5>Nenhum professor registrado.</td></tr>";
        }

        unset($id_aux);
        $sql = "SELECT t.id as id FROM sala s, turma t WHERE t.id_sala=s.id and " . $complement;
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
if (isset($ver_sala)&&isset($id_aux)) {

  include 'excluirTurma.php';
}
if (isset($ver_sala))
  echo '<form method="GET" action="deletarSala.php">
    <input type="hidden" name="id" value="' . $ver_sala . '">
    <fieldset>
        <button type="submit" class="btn btn-primary" >Confirmar Exclusão</button>
        </form>
    </fieldset>';
?>