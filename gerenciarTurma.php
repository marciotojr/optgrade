<?php
if (!isset($_GET['id'])) {
  $id = "-1";
  $departamento = "-1";
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

$sql = "SELECT t.id as id, t.turma as turma, d.id as disciplina , dep.id as departamento, dp.id as dp "
        . "FROM turma t, disciplina d, departamento_polo dp, departamento dep "
        . "WHERE t.id_disciplina=d.id and d.id_departamento_polo = dp.id and dp.id_departamento = dep.id and t.id=" . $id;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  if ($turma = mysqli_fetch_assoc($result)) {
    extract($turma, EXTR_OVERWRITE, "turma");
  }
}
?>
<form method="post" action="adicionaTurma.php">
    <fieldset>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
    </fieldset>
    <fieldset class="form-group">
        <legend>Turma</legend>
        <label for="curso">Polo e Departamento</label>
        <select class="form-control" name="curso" id="curso" onchange="showDisciplinas(this.value)">
            <?php
            $sql = "  select  dp.id as id,
                                    d.nome as departamento, 
                                    p.nome as polo 
                            FROM departamento d,
                                 departamento_polo dp, 
                                 polo p 
                            where   p.id = dp.id_polo 
                                    and d.id = dp.id_departamento
                                    and dp.id = " . $dp . "
                            UNION
                            (select   dp.id as id,
                                      d.nome as departamento, 
                                      p.nome as polo 
                            FROM departamento d,
                                 departamento_polo dp, 
                                 polo p 
                            where   p.id = dp.id_polo 
                                    and d.id = dp.id_departamento
                                    and dp.id <> " . $dp . "
                          ORDER BY polo, departamento)";
            $result = mysqli_query($conn, $sql);

            while ($dep = mysqli_fetch_assoc($result)) {
              if (!isset($depAux)) {
                $depAux = $dep['id'];
              }
              echo "<option value='" . $dep['id'] . " '>" . $dep['polo'] . " - " . $dep['departamento'] . "</option>";
            }
            ?>
        </select>
    </fieldset>
    <fieldset class="form-group">
        <label for="disciplinas">Disciplina</label>
        <select class="form-control" name="disciplinas" id="disciplinas">
            <?php
            $sql = "SELECT id, nome, codigo FROM disciplina WHERE id_departamento_polo=" . $depAux . " ORDER BY nome";
            $result = mysqli_query($conn, $sql);

            while ($dis = mysqli_fetch_assoc($result)) {
              echo "<option value='" . $dis['id'] . " '>" . $dis['nome'] . "</option>";
            }
            ?>
        </select>
    </fieldset>
    <fieldset class="form-group">
        <label for="turma">Turma</label>
        <input type="text" class="form-control" name="turma" value="<?php echo $turma; ?>" placeholder="Insira o nome">
    </fieldset>
    <fieldset>
        <?php
        include ("geraListaHorarios.php");
        ?>
    </fieldset>
    <br>
    <fieldset>
        <button type="submit" class="btn btn-primary" onclick="validaCadastroTurma()"><?php if($id=="-1") echo "Cadastrar"; else echo "Salvar altera&ccedil;&otilde;s"; ?></button>
        <button type="reset" class="btn btn-primary" onClick="changeContent('listaTurmas.php')">Voltar</button>	
    </fieldset>
</form>

