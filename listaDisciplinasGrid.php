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
<fieldset>
    <legend>Disciplinas</legend>
    <fieldset class="form-group">
        <table class="strippedHover">
            <tr><th>A&ccedil;&otilde;es</th><th>Codigo</th><th>Nome</th><th>Departamento</th><th>Polo</th></tr>
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

            $sql = "SELECT d.id as id, d.codigo as codigo, d.nome as nome, de.nome as departamento, p.nome as polo  FROM disciplina d, departamento_polo dp, departamento de, polo p WHERE d.id_departamento_polo=dp.id and dp.id_departamento=de.id and dp.id_polo = p.id ORDER BY polo, departamento, codigo";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
              while ($disciplina = mysqli_fetch_assoc($result)) {
                extract($disciplina, EXTR_OVERWRITE);
                echo '<tr><td><a href="gerenciarDisciplinaGrid.php?id=\'1\')"><span class="badge badge-edit"><i class="glyphicon glyphicon-pencil"></i></span></a>'
                . '<a href="#" onclick="excluir()"><span class="badge badge-important"><i class="glyphicon glyphicon-remove"></i></span></a></td>';
                echo '<td>' . $codigo . '</td><td>' . $nome . '</td><td>' . $departamento . '</td><td>' . $polo . '</td></tr>';
              }
            } else {
              echo "<tr><td colspan=5>Nenhuma disciplina registrada.</td></tr>";
            }
            ?>
        </table>
    </fieldset>
    <fieldset>
        <button type="submit" class="btn btn-primary" onclick="redirecionar()">Inserir</button>
    </fieldset>
    
    <script type="text/javascript" language="javascript" charset="utf-8">
      function redirecionar()
      {
          window.location = "gerenciarDisciplinaGrid.php";
      }
    </script>
<script>
  function excluir()
  {
      alert("Polo excluído com sucesso!");
  }
</script>
</div>
</body>
</html>
