<?php
if (!isset($_GET['id'])) {
  $id = $_POST['id'];
} else {
  $id = $_GET['id'];
}

$turma = "";
$disciplina = "-1";
$departamento = "-1";
$dp = "-1";

$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
//$db = mysqli_select_db('ihc1', $link) or die('Could not select database.');

$sql = "SELECT t.id as id, t.id as id_turma, t.turma as turma, d.id as disciplina , dep.id as departamento, t.id_professor as id_professor, dp.id as dp, t.id_sala as id_sala "
        . "FROM turma t, disciplina d, departamento_polo dp, departamento dep "
        . "WHERE t.id_disciplina=d.id and d.id_departamento_polo = dp.id and dp.id_departamento = dep.id and t.id=" . $id;
$result3 = mysqli_query($conn, $sql);

if (mysqli_num_rows($result3) > 0) {
  if ($t = mysqli_fetch_assoc($result3)) {
    extract($t, EXTR_OVERWRITE);
  }
}
?>
<fieldset>
    <?php echo '<input type="hidden" id="id[' . $id . ']" value="' . $id . '">'; ?>
</fieldset>
<fieldset class="form-group">
    <?php
    $sql = "SELECT turma, codigo FROM disciplina d, turma t WHERE t.id_disciplina=d.id and t.id=" . $id_turma;
    $result1 = mysqli_query($conn, $sql);

    while ($t = mysqli_fetch_assoc($result1)) {
      extract($t, EXTR_OVERWRITE);
      echo "<legend>" . $codigo . $turma . "</legend>";
    }
    echo '<b>Polo e Departamento</b><br>';
    $sql = "  select  dp.id as id,
                                    d.nome as departamento, 
                                    p.nome as polo 
                            FROM departamento d,
                                 departamento_polo dp, 
                                 polo p 
                            where   p.id = dp.id_polo 
                                    and d.id = dp.id_departamento
                                    and dp.id = " . $dp . "
                            ";
    $result2 = mysqli_query($conn, $sql);

    while ($dep = mysqli_fetch_assoc($result2)) {
      if (!isset($depAux)) {
        $depAux = $dep['id'];
      }
      echo $dep['polo'] . " - " . $dep['departamento'];
    }
    ?>
</fieldset>
<fieldset class="form-group">

<?php
echo '<b>Disciplina</b><br>';

$sql = "SELECT d.nome as disciplina, d.codigo as disciplina_codigo FROM turma t, disciplina d WHERE t.id_disciplina=d.id and t.id=" . $id_turma;
$result1 = mysqli_query($conn, $sql);

while ($dis = mysqli_fetch_assoc($result1)) {
  echo $dis['disciplina'];
}
?>

</fieldset>
<fieldset class="form-group">
<?php
echo '<b>Turma</b><br>';
echo $turma;
?>
</fieldset>
<fieldset>
<?php
echo '<b>Professor</b><br>';
echo '<select id="professor[' . $id . ']">';
$sql = "SELECT id as id_professor_aux ,nome as nome_professor FROM professor WHERE departamento=" . $dp . " and id=" . $id_professor . "
UNION
(SELECT id as id_professor_aux ,nome as nome_professor FROM professor WHERE departamento=" . $dp . " and id<>" . $id_professor . " ORDER BY nome_professor)";
$result4 = mysqli_query($conn, $sql);

while ($dep = mysqli_fetch_assoc($result4)) {
  extract($dep, EXTR_OVERWRITE);
  echo '<option value="' . $id_professor_aux . '">' . $nome_professor . '</option>';
}
echo '</select>';
?>
</fieldset>
<fieldset>
<?php
echo '<b>Sala</b><br>';
echo '<select id="sala[' . $id . ']">';
$sql = "SELECT s.id as sala_id, s.codigo as sala_codigo FROM sala s WHERE s.id_polo IN (SELECT dp.id_polo FROM departamento_polo dp WHERE dp.id=" . $dp . ") and s.id=" . $id_sala . "
UNION
(SELECT s.id as sala_id, s.codigo as sala_codigo FROM sala s WHERE s.id_polo IN (SELECT dp.id_polo FROM departamento_polo dp WHERE dp.id= " . $dp . ") and s.id<>" . $id_sala . " ORDER BY s.codigo)";
$result4 = mysqli_query($conn, $sql);

while ($dep = mysqli_fetch_assoc($result4)) {
  extract($dep, EXTR_OVERWRITE);
  echo '<option value="' . $sala_id . '">' . $sala_codigo . '</option>';
}
echo '</select>';
?>
</fieldset>
<fieldset>
<?php
echo '<b>Horarios</b><br>';
include ("geraListaHorarios.php");
?>
</fieldset>
<hr>