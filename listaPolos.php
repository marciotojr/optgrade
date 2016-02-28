<fieldset>
    <legend>Polos</legend>
    <fieldset class="form-group">
        <table class="strippedHover">
            <tr><th>A&ccedil;&otilde;es</th><th>Polo</th><th>Cidade</th></tr>
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
            $sql = "DELETE FROM polo WHERE polo.id = -1";
            mysqli_query($conn, $sql);
            $sql = "SELECT id as id, nome as polo, cidade as cidade, uf as uf FROM polo ORDER BY polo";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
              while ($disciplina = mysqli_fetch_assoc($result)) {
                extract($disciplina, EXTR_OVERWRITE);
                echo '<tr><td><a href="#" onclick="changeContent(\'gerenciarPolo.php?id=' . $id . '\')"><span class="badge badge-edit"><i class="glyphicon glyphicon-pencil"></i></span></a>'
                . '<a href="#" onclick="excluir(\'Polo excluído com sucesso!\')"><span class="badge badge-important"><i class="glyphicon glyphicon-remove"></i></span></a></td>';
                echo '<td>' . $polo . '</td><td>' . $cidade . ' / ' . $uf . '</td></tr>';
              }
            } else {
              echo "<tr><td colspan=5>Nenhum polo registrado.</td></tr>";
            }
            ?>
        </table>
    </fieldset>
    <fieldset>
        <button type="submit" class="btn btn-primary" onclick="changeContent('gerenciarPolo.php')">Inserir</button>
    </fieldset>