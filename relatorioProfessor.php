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
$sql = "SELECT p.nome as professor
                    FROM professor p
                    WHERE  p.id=" . $id;
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
                  echo $professor;
                }
                ?>
            </legend>
            <fieldset class="form-group">
                <?php
                $sql = "SELECT s.codigo as sala, t.id as id_turma, t.turma as turma, p.nome as professor, d.nome as disciplina, d.codigo as codigo
                    FROM turma t, disciplina d, professor p, sala s
                    WHERE t.id_disciplina=d.id and t.id_professor=p.id and t.id_sala=s.id and p.id=" . $id . "
                    ORDER BY disciplina,turma";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  echo '<table class="strippedHover">
                    <tr><th>A&ccedil;&otilde;es</th><th>Disciplina</th><th>Turma</th><th>Sala</th><th colspan=3>Horarios</th></tr>';
                  while ($array = mysqli_fetch_assoc($result)) {
                    extract($array, EXTR_OVERWRITE);
                    echo "<tr>
                          <td><a href='#' onclick=\"changeContent('editarTurma.php?id=$id_turma')\"><span class='badge badge-edit'><i class='glyphicon glyphicon-pencil'></i></span></a>
                    <a href='#' onclick=\"changeContent('excluirTurma.php?id=$id_turma')\"><span class='badge badge-important'><i class='glyphicon glyphicon-remove'></i></span></a></td>
                        <td>$disciplina</td><td>$turma</td><td>$sala</td><td class='subTable'>";
                    $sql = "SELECT ds.dia as dia, h.inicio as inicio, h.fim as fim  FROM dia_semana ds, horario h WHERE h.id_dia=ds.id and h.id_turma=" . $id_turma . " ORDER BY dia, inicio";
                    $result_horario = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result_horario) > 0) {
                      echo "<table>";
                      while ($arrayAux = mysqli_fetch_assoc($result_horario)) {
                        extract($arrayAux, EXTR_OVERWRITE);
                        echo "<tr><td>$dia</td><td>$inicio:00</td><td>$fim:00</td></tr>";
                      }
                      echo "</table></td></tr>";
                    }
                  }
                }else{
                  echo "<h5>Este(a) professor(a) n&atilde;o foi alocado a nenhuma turma.</h5>";
                }
                ?>
            </fieldset>

        </fieldset>
    </form>
</form>
