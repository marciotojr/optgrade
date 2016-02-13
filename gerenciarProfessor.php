<?php
if (!isset($_GET['id'])) {
  $id = "-1";
  $departamento = "-1";
} else {
  $id = $_GET['id'];
}

$nome = "";
$endereco = "";
$bairro = "";
$cidade = "";
$uf = "";
$cep = "";
$email = "";

$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
//$db = mysqli_select_db('ihc1', $link) or die('Could not select database.');

$sql = "SELECT nome, endereco, bairro, cidade, uf, cep, email, departamento FROM `professor` WHERE id =" . $id;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  if ($professor = mysqli_fetch_assoc($result)) {
    extract($professor, EXTR_OVERWRITE, "prof");
  }
}
?>
<form>
    <fieldset>
        <input type="hidden" id="id" value="<?php echo $id; ?>">
        <legend>Dados Pessoais</legend>
        <fieldset class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" value="<?php echo $nome; ?>" placeholder="Insira o nome">
        </fieldset>
        <fieldset class="form-group">
            <label for="endereco">Endere&ccedil;o</label>
            <input type="text" class="form-control" id="endereco" value="<?php echo $endereco; ?>" placeholder="Insira a rua, avenida, alameda, ect...">
        </fieldset>
        <fieldset class="form-group">
            <label for="bairro">Bairro</label>
            <input type="text" class="form-control" id="bairro" value="<?php echo $bairro; ?>" placeholder="Insira o bairro ou distrito">
        </fieldset>
        <fieldset class="form-group">
            <label for="cidade">Cidade</label>
            <input type="text" class="form-control" id="cidade" value="<?php echo $cidade; ?>" placeholder="Insira a cidade">
        </fieldset>
        <fieldset class="form-group">
            <label for="uf">UF</label>
            <input type="text" class="form-control" id="uf" value="<?php echo $uf; ?>" placeholder="Insira a UF">
        </fieldset>
        <fieldset class="form-group">
            <label for="cep">CEP</label>
            <input type="text" class="form-control" id="cep" value="<?php echo $cep; ?>" placeholder="Insira o CEP (somente números)" maxlength=7>
        </fieldset>
        <fieldset class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" value="<?php echo $email; ?>" placeholder="Insira o email">
        </fieldset>
    </fieldset>
    <fieldset class="form-group">
        <legend>Departamento</legend>
        <label for="curso">Curso</label>
        <select class="form-control" id="curso" onchange="showDisciplinas(this.value)">
            <?php
            $sql = "  select  dp.id as id,
                                    d.nome as departamento, 
                                    p.nome as polo 
                            FROM departamento d,
                                 departamento_polo dp, 
                                 polo p 
                            where   p.id = dp.id_polo 
                                    and d.id = dp.id_departamento
                                    and dp.id = " . $departamento . "
                            UNION
                            (select   dp.id as id,
                                      d.nome as departamento, 
                                      p.nome as polo 
                            FROM departamento d,
                                 departamento_polo dp, 
                                 polo p 
                            where   p.id = dp.id_polo 
                                    and d.id = dp.id_departamento
                                    and dp.id <> " . $departamento . "
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
        <legend>Informa&ccedil;&otilde;es Complementares</legend>
        <label for="disciplinas">Disciplinas que leciona</label>
        <select multiple class="form-control" id="disciplinas">
            <?php
            if ($departamento != "-1") {
              $sql = "SELECT id, nome, codigo FROM disciplina WHERE id_departamento_polo=" . $departamento . " ORDER BY nome";
            } else {
              $sql = "SELECT id, nome, codigo FROM disciplina WHERE id_departamento_polo=" . $depAux . " ORDER BY nome";
            }
            $result = mysqli_query($conn, $sql);

            while ($dis = mysqli_fetch_assoc($result)) {
              echo "<option value='" . $dis['id'] . " '>" . $dis['nome'] . "</option>";
            }
            ?>
        </select>
        <small>Use a tecla control (ctrl) para selecionar m&uacute;ltiplos campos.</small>
    </fieldset>
    <button type="submit" class="btn btn-primary" onClick="validaCadastroProfessor()"><?php if($id=="-1") echo "Cadastrar"; else echo "Salvar altera&ccedil;&otilde;s"; ?></button>  
    <button type="submit" class="btn btn-primary" onClick="changeContent('listaProfessores.php')">Voltar</button>	
</form>

