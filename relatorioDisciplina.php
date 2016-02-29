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
$sql = "SELECT s.codigo as sala, t.id as id_turma, t.turma as turma, p.nome as professor, d.nome as disciplina, d.codigo as codigo
                    FROM turma t, disciplina d, professor p, sala s
                    WHERE t.id_disciplina=d.id and t.id_professor=p.id and t.id_sala=s.id and d.id=" . $id . "
                    ORDER BY turma";
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
                  echo $codigo . " - " . $disciplina;
                }
                ?>
            </legend>
            <fieldset class="form-group">
                <table class="strippedHover">
                    <?php
                    mysqli_data_seek($result, 0);
                    if (mysqli_num_rows($result) > 0) {
                      echo '<tr><th>A&ccedil;&otilde;es</th><th>Turma</th><th>Professor</th><th>Sala</th><th colspan=3>Horarios</th></tr>';
                      while ($array = mysqli_fetch_assoc($result)) {
                        extract($array, EXTR_OVERWRITE);
                        echo "<tr>
                          <td><a href='#' onclick=\"changeContent('editarTurma.php?id=$id_turma')\"><span class='badge badge-edit'><i class='glyphicon glyphicon-pencil'></i></span></a>
                    <a href='#' onclick=\"changeContent('excluirTurma.php?id=$id_turma')\"><span class='badge badge-important'><i class='glyphicon glyphicon-remove'></i></span></a></td>
                        <td>$turma</td><td>$professor</td><td>$sala</td><td class='subTable'>";
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
                      echo "<h5>Esta disciplina n&atilde;o tem turmas alocadas.</h5>";
                    }
                    ?>
            </fieldset>

        </fieldset>
    </form>
</form>
