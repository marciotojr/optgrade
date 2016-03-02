<?php
extract($_POST, EXTR_OVERWRITE);
extract($_GET, EXTR_OVERWRITE);
$id_aux[0] = $id;
$id_polo = $id;
unset($id);
if (isset($_GET['id']))
  unset($_GET['id']);
if (isset($_POST['id']))
  unset($_POST['id']);

echo '<fieldset>
    <legend>Confirmação</legend>' .
 "<div class='alert alert-danger fade in'><strong>Atenção!</strong> As entradas abaixo serão excluídas!<br><strong>Confirme no fim da página.</strong><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
?>
<hr/>
<legend>Polo</legend>
<fieldset class="form-group">
    <table class="strippedHover">
        <tr><th>Polo</th><th>Cidade</th></tr>
        <?php
        $id = "";
        $uf = "";
        $nome = "";
        $cidade = "";
        $polo = "";

        $conn = mysqli_connect('localhost', 'root', '', 'ihc1');
        if (!$conn)
          die("Erro fatal. Não foi possível se conectar ao banco de dados.");
//$db = mysqli_select_db('ihc1', $link) or die('Could not select database.');
//$db = mysqli_select_db('ihc1', $link) or die('Could not select database.');
        $sql = "SELECT id as id, nome as polo, cidade as cidade, uf as uf FROM polo WHERE id=" . $id_polo . " ORDER BY polo";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          while ($disciplina = mysqli_fetch_assoc($result)) {
            extract($disciplina, EXTR_OVERWRITE);
            echo '<td>' . $polo . '</td><td>' . $cidade . ' / ' . $uf . '</td></tr>';
          }
        } else {
          echo "<tr><td colspan=5>Nenhuma disciplina registrada.</td></tr>";
        }
        echo "</table></fieldset>";

        unset($id_aux);
        $sql = "SELECT s.id as id FROM polo p, sala s WHERE p.id=s.id_polo and  p.id=" . $id_polo;
        $result = mysqli_query($conn, $sql);


        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            extract($row, EXTR_OVERWRITE);
            $id_aux[$id] = $id;
          }
        }

        if (isset($id_aux))
          include 'excluirSala.php';

        unset($id_aux);
        $sql = "SELECT dp.id as id FROM polo p, departamento_polo dp WHERE p.id=dp.id_polo and  p.id=" . $id_polo;
        $result = mysqli_query($conn, $sql);


        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            extract($row, EXTR_OVERWRITE);
            $id_aux[$id] = $id;
          }
        }

        if (isset($id_aux))
          include 'excluirDepartamento.php';
        ?>
    </table>
</fieldset>
<?php
echo '<fieldset>
        <button type="submit" class="btn btn-primary" onclick="changeContent(\'deletarPolo.php?id=' . $id_polo . '\')">Confirmar Exclusão</button>
    </fieldset>';
?>