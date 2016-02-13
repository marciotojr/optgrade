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
        <legend>Salas</legend>
        <fieldset class="form-group">
            <table class="strippedHover">
                <tr><th>A&ccedil;&otilde;es</th><th>Codigo</th><th>Polo</th></tr>
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

                $sql = "SELECT s.id as id, s.codigo as codigo, p.nome as polo FROM sala s, polo p WHERE s.id_polo=p.id ORDER BY polo, codigo";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                  while ($disciplina = mysqli_fetch_assoc($result)) {
                    extract($disciplina, EXTR_OVERWRITE);
                    echo '<tr><td><a href="#" onclick="changeContent(\'gerenciarSala.php?id=' . $id . '\')"><span class="badge badge-edit"><i class="glyphicon glyphicon-pencil"></i></span></a>'
                    . '<a href="#" onclick="changeContent(\'excluirSala.php?id=' . $id . '\')"><span class="badge badge-important"><i class="glyphicon glyphicon-remove"></i></span></a></td>';
                    echo '<td>' . $codigo . '</td><td>' . $polo . '</td></tr>';
                  }
                } else {
                  echo "<tr><td colspan=5>Nenhuma disciplina registrada.</td></tr>";
                }
                ?>
            </table>
        </fieldset>

        <fieldset>
            <button type="submit" class="btn btn-primary" onclick="redirecionar(0)">Inserir</button>
            <button type="submit" class="btn btn-primary" onClick="redirecionar(1)">Voltar</button>
        </fieldset>
        <script type="text/javascript" language="javascript" charset="utf-8">
          function redirecionar(opt)
          {
              if (opt == 0)
              {
                  window.location = "gerenciarSalaGrid.php";
              }
              else if (opt == 1)
              {
                  window.location = "principal.php";
              }
          }
        </script>
</div>
<script>
  function excluir()
  {
      alert("Polo excluído com sucesso!");
  }
</script>
</div>
</body>
</html>
