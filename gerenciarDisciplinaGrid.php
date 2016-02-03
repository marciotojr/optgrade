<?php
include("header.php");
?>

<style>

    .nova-grade-block {
        width: auto;
        padding: 20px;
        border: solid 1px;
        margin: 2px 2px 2px 2px;
    }

</style>

<div class="nova-grade-block">
  
<?php
if (!isset($_GET['id'])) {
  $id = "-1";
  $departamento = "-1";
} else {
  $id = $_GET['id'];
}

$codigo = "";
$nome = "";
$departamento_polo = "-1";

$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
//$db = mysqli_select_db('ihc1', $link) or die('Could not select database.');

$sql = "SELECT d.codigo as codigo, d.nome as nome, d.id_departamento_polo as departamento_polo FROM disciplina d WHERE d.id =1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  if ($disciplina = mysqli_fetch_assoc($result)) {
    extract($disciplina, EXTR_OVERWRITE, "disc");
  }
}
?>
    <fieldset><legend>Disciplina</legend></fieldset>
    <fieldset class="form-group">
        <legend>Departamento</legend>

        <label for="curso">Polo e Departamento</label>
        <select class="form-control" id="curso">
            <?php
            $sql = "  select  dp.id as id,
                                    d.nome as departamento, 
                                    p.nome as polo 
                            FROM departamento d,
                                 departamento_polo dp, 
                                 polo p 
                            where   p.id = dp.id_polo 
                                    and d.id = dp.id_departamento
                                    and dp.id = " . $departamento_polo . "
                            UNION
                            (select   dp.id as id,
                                      d.nome as departamento, 
                                      p.nome as polo 
                            FROM departamento d,
                                 departamento_polo dp, 
                                 polo p 
                            where   p.id = dp.id_polo 
                                    and d.id = dp.id_departamento
                                    and dp.id <> " . $departamento_polo . ")
                          ORDER BY polo, departamento";
            $result = mysqli_query($conn, $sql);

            while ($dep = mysqli_fetch_assoc($result)) {
              echo "<option value='" . $dep['id'] . " '>" . $dep['polo'] . " - " . $dep['departamento'] . "</option>";
            }
            ?>
        </select>
    </fieldset>
    <fieldset>
        <input type="hidden" id="id" value="<?php echo $id; ?>">
        <legend>Disciplina</legend>
        <fieldset class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" value="<?php echo $nome; ?>" placeholder="Insira o nome">
        </fieldset>
        <fieldset class="form-group">
            <label for="codigo">C&oacute;digo</label>
            <input type="text" class="form-control" id="codigo" value="<?php echo $codigo; ?>" placeholder="Insira o c&oacute;digo da disciplina">
        </fieldset>
    </fieldset>
    <button type="submit" class="btn btn-primary" onClick="validaCadastroDisciplinaGrid()">Cadastrar</button>  
    <button type="submit" class="btn btn-primary" onClick="voltar()">Voltar</button>	

    <script type="text/javascript" language="javascript" charset="utf-8">
                function voltar()
                {     
                        window.location = "listaDisciplinasGrid.php";
                }
</script>
    

