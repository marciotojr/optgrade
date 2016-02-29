
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
$sql = "SELECT t.id as id, t.turma as turma, d.codigo as codigo, COALESCE(p.nome,'Sem Professor') as professor, COALESCE(s.codigo,'Sem Sala') as sala, d.nome as disciplina
FROM turma t 
LEFT JOIN professor p ON t.id_professor=p.id 
LEFT JOIN sala s ON t.id_sala=s.id 
LEFT JOIN disciplina d ON t.id_disciplina=d.id
WHERE t.id=".$id.
" ORDER BY t.id";
$result = mysqli_query($conn, $sql);
?>
<form>
    <form>
        <fieldset>
            <legend>
                <?php
                if (mysqli_num_rows($result) > 0) {
                  if ($turma = mysqli_fetch_assoc($result)) {
                    extract($turma, EXTR_OVERWRITE, "turma");
                  }
                  echo $codigo . " " . $turma;
                }
                ?>
            </legend>
            <fieldset class="form-group">
                <table class="strippedHover">
                    <tr><th>A&ccedil;&otilde;es</th><th>Disciplina</th><th>Professor</th><th>Sala</th><th colspan=3>Horarios</th></tr>
                    <tr>
                        <td><a href="#" onclick="changeContent('gerenciarTurma.php?id=<?php echo $id; ?>')"><span class="badge badge-edit"><i class="glyphicon glyphicon-pencil"></i></span></a>
                            <a href="#" onclick="changeContent('excluirTurma.php?id=<?php echo $id; ?>')"><span class="badge badge-important"><i class="glyphicon glyphicon-remove"></i></span></a></td>
                        <td><?php echo $disciplina; ?></td><td><?php echo $professor; ?></td><td><?php echo $sala; ?></td><td class="subTable">
                            <table>
                                <?php
                                //$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
                                $sql = "SELECT d.dia as dia, h.inicio as inicio, h.fim as fim FROM horario h, dia_semana d WHERE h.id_dia=d.id  and h.id_turma = " . $id;
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                  while ($horario = mysqli_fetch_assoc($result)) {
                                    extract($horario, EXTR_OVERWRITE, "horario");
                                    echo "<tr><td>" . $dia . "</td><td>" . $inicio . ":00</td><td>" . $fim . ":00</td></tr>";
                                  }
                                }
                                ?>
                            </table>
                        </td></tr>
                </table>
            </fieldset>
        </fieldset>
    </form>
</form>
