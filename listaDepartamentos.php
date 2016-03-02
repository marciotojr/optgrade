
<fieldset>
    <legend>Departamentos</legend>
    <fieldset class="form-group">
        <table class="strippedHover">
            <tr><th>A&ccedil;&otilde;es</th><th>Nome</th><th>Sigla</th><th>Polo</th></tr>
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

            $sql = "SELECT dp.id as id, de.sigla as codigo, de.nome as nome, p.nome as polo  FROM departamento_polo dp, departamento de, polo p WHERE dp.id_departamento=de.id and dp.id_polo = p.id ORDER BY polo, nome, codigo";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
              while ($disciplina = mysqli_fetch_assoc($result)) {
                extract($disciplina, EXTR_OVERWRITE);
                echo '<tr><td><a href="#" onclick="changeContent(\'gerenciarDepartamento.php?id=' . $id . '\')"><span class="badge badge-edit"><i class="glyphicon glyphicon-pencil"></i></span></a>'
                . '<a href="#" onclick="changeContent(\'excluirDepartamento.php?id=' . $id . '\')"><span class="badge badge-important"><i class="glyphicon glyphicon-remove"></i></span></a></td>';
                echo '<td>' . $nome . '</td><td>' . $codigo . '</td><td>' . $polo . '</td></tr>';
              }
            } else {
              echo "<tr><td colspan=5>Nenhum departamento registrado.</td></tr>";
            }
            ?>
        </table>
    </fieldset>
    <fieldset>
        <button type="submit" class="btn btn-primary" onclick="changeContent('gerenciarDepartamento.php')">Inserir</button>
    </fieldset>
