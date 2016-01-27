<fieldset>
    <legend>Professores</legend>
    <fieldset class="form-group">
        <table class="strippedHover">
            <tr><th>A&ccedil;&otilde;es</th><th>Nome</th><th>Departamento</th><th>Polo</th></tr>
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

            $sql = "SELECT p.id as id, p.nome as nome, d.nome as departamento, po.nome as polo FROM professor p, departamento d, polo po, departamento_polo dp WHERE p.departamento=dp.id and dp.id_polo = po.id and dp.id_departamento=d.id ORDER BY polo, departamento, nome";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
              while ($professor = mysqli_fetch_assoc($result)) {
                extract($professor, EXTR_OVERWRITE);
                echo '<tr><td><a href="#" onclick="changeContent(\'gerenciarProfessor.php?id=' . $id . '\')"><span class="badge badge-edit"><i class="glyphicon glyphicon-pencil"></i></span></a>'
                . '<a href="#" onclick="changeContent(\'excluirProfessor.php?id=' . $id . '\')"><span class="badge badge-important"><i class="glyphicon glyphicon-remove"></i></span></a></td>';
                echo '<td>' . $nome . '</td><td>' . $departamento . '</td><td>' . $polo . '</td></tr>';
              }
            } else {
              echo "<tr><td colspan=5>Nenhuma disciplina registrada.</td></tr>";
            }
            ?>
        </table>
    </fieldset>
    <fieldset>
        <button type="submit" class="btn btn-primary" onclick="changeContent('gerenciarProfessor.php')">Inserir</button>
    </fieldset>
