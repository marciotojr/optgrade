<form>
    <form>
        <fieldset>
            <legend>Disciplinas</legend>
            <fieldset class="form-group">
                <table class="strippedHover">
                    <tr><th>A&ccedil;&otilde;es</th><th>Codigo</th><th>Turma</th><th>Disciplina</th><th>Departamento</th><th>Polo</th></tr>
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

                    $sql = "SELECT t.id as id, d.codigo as codigo, d.nome as nome, de.nome as departamento, p.nome as polo, t.turma as turma FROM disciplina d, departamento_polo dp, departamento de, polo p, turma t WHERE d.id_departamento_polo=dp.id and dp.id_departamento=de.id and dp.id_polo = p.id and t.id_disciplina=d.id ORDER BY polo, departamento, codigo, turma";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                      while ($disciplina = mysqli_fetch_assoc($result)) {
                        extract($disciplina, EXTR_OVERWRITE);
                        echo '<tr><td><a href="#" onclick="changeContent(\'gerenciarDisciplina.php?id=' . $id . '\')"><span class="badge badge-edit"><i class="glyphicon glyphicon-pencil"></i></span></a>'
                        . '<a href="#" onclick="changeContent(\'excluirDisciplina.php?id=' . $id . '\')"><span class="badge badge-important"><i class="glyphicon glyphicon-remove"></i></span></a></td>';
                        echo '<td>' . $codigo . '</td><td>' . $turma. '</td><td>' . $nome . '</td><td>' . $departamento . '</td><td>' . $polo . '</td></tr>';
                      }
                    } else {
                      echo "<tr><td colspan=5>Nenhuma disciplina registrada.</td></tr>";
                    }
                    ?>
                </table>
            </fieldset>
    </form>
</form>
