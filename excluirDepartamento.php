<?php
extract($_POST, EXTR_OVERWRITE);
extract($_GET, EXTR_OVERWRITE);
if (!isset($id_aux)) {
  $id_aux[0] = $id;
  $ver_dep = $id;
  unset($id);
}
if (isset($_GET['id']))
  unset($_GET['id']);
if (isset($_POST['id']))
  unset($_POST['id']);
if (isset($ver_dep))
  echo '<fieldset>
    <legend>Confirmação</legend>' .
  "<div class='alert alert-danger fade in'><strong>Atenção!</strong> As entradas abaixo serão excluídas!<br><strong>Confirme no fim da página.</strong><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";;
?>
<hr/>
<legend>Departamentos</legend>
<fieldset class="form-group">
    <table class="strippedHover">
        <tr><th>Nome</th><th>Sigla</th><th>Polo</th></tr>
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
          $complement = $complement . " or dp.id=" . $value;
        }
        $complement = $complement . " )";
        $dep_complement=$complement;
        $sql = "SELECT dp.id as id, de.sigla as codigo, de.nome as nome, p.nome as polo  FROM departamento_polo dp, departamento de, polo p WHERE dp.id_departamento=de.id and dp.id_polo = p.id and " . $complement . " ORDER BY polo, nome, codigo";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($disciplina = mysqli_fetch_assoc($result)) {
            extract($disciplina, EXTR_OVERWRITE);
            echo '<td>' . $nome . '</td><td>' . $codigo . '</td><td>' . $polo . '</td></tr>';
          }
        } else {
          echo "<tr><td colspan=5>Nenhum departamento registrado.</td></tr>";
        }
        echo "</table></fieldset>";
        
        unset($id_aux);
        $sql = "SELECT p.id as id FROM professor p, departamento_polo dp WHERE p.departamento=dp.id and  " . $dep_complement;
        $result = mysqli_query($conn, $sql);


        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            extract($row, EXTR_OVERWRITE);
            $id_aux[$id] = $id;
          }
        }
        if (isset($id_aux))
          include 'excluirProfessor.php';

        unset($id_aux);
        $sql = "SELECT d.id as id FROM disciplina d, departamento_polo dp WHERE d.id_departamento_polo=dp.id and  " . $dep_complement;
        $result = mysqli_query($conn, $sql);


        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            extract($row, EXTR_OVERWRITE);
            $id_aux[$id] = $id;
          }
        }
        if (isset($id_aux))
          include 'excluirDisciplina.php';
      
        ?>
    </table>
</fieldset>
<?php
if (isset($ver_dep))
  echo '<form method="GET" action="deletarDepartamento.php">
    <input type="hidden" name="id" value="' . $ver_dep . '">
    <fieldset>
        <button type="submit" class="btn btn-primary" >Confirmar Exclusão</button>
        </form>
    </fieldset>';
?>