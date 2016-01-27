<?php
$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
//$db = mysqli_select_db('ihc1', $link) or die('Could not select database.');
if (!isset($_GET['id'])) {
  $id = "-1";
} else {
  $id = $_GET['id'];
}
$sql = "SELECT s.codigo as sala, t.id as id, CONCAT(d.codigo,t.turma) as turma, p.nome as professor, d.nome as disciplina, ds.dia as dia, h.id_dia, h.inicio as inicio, h.fim as fim
                    FROM turma t, disciplina d, professor p, sala s, horario h, dia_semana ds
                    WHERE t.id_disciplina=d.id and t.id_professor=p.id and h.id_turma=t.id and ds.id=h.id_dia and t.id_disciplina=d.id and t.id_sala=s.id and s.id=" . $id . "
                    ORDER BY h.id_dia, inicio, departamento, disciplina";
$result = mysqli_query($conn, $sql);
?>
<form>
    <form>
        <fieldset>
            <legend>
                <?php
                if (mysqli_num_rows($result) > 0) {
                  if ($array = mysqli_fetch_assoc($result)) {
                    extract($array, EXTR_OVERWRITE);
                  }
                  echo $sala;
                }
                ?></legend>
            <fieldset class="form-group">
                <?php
                mysqli_data_seek($result, 0);
                if (mysqli_num_rows($result) > 0) {
                  $dia_semana = "";
                  while ($array = mysqli_fetch_assoc($result)) {
                    extract($array, EXTR_OVERWRITE);
                    if ($dia_semana != $dia) {
                      $dia_semana = $dia;
                      echo "</table><legend>$dia_semana</legend><table class='strippedHover'>";
                      echo "<tr><th>A&ccedil;&otilde;es</th><th>Turma</th><th>Disciplina</th><th>Professor</th><th colspan=3>Horario</th></tr>";
                    }
                    echo "<tr><td><a href='#' onclick=\"changeContent('gerenciarTurma.php?id=$id')\"><span class='badge badge-edit'><i class='glyphicon glyphicon-pencil'></i></span></a>"
                    . "<a href='#' onclick=\"changeContent('excluirTurma.php?id=$id')\"><span class='badge badge-important'><i class='glyphicon glyphicon-remove'></i></span></a></td>"
                    . "<td>$turma</td><td>$disciplina</td><td>$professor</td><td>$dia</td><td>$inicio:00</td><td>$fim:00</td></tr>";
                  }
                }
                ?>
                </table>
            </fieldset>
        </fieldset>
    </form>
</form>
