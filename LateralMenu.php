<?php
$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
//$db = mysqli_select_db('ihc1', $link) or die('Could not select database.');
?>

<script>
  function changeContent(str) {
      if (str.length === 0) {
          document.getElementById("content").innerHTML = "";
          return;
      } else {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function () {
              if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                  document.getElementById("content").innerHTML = xmlhttp.responseText;
              }
          };
          xmlhttp.open("GET", str, true);
          xmlhttp.send();
      }
  }
</script>
<div class="lateralMenu">
    <div class="tree">
        <ul>
            <li>
                <span><i class="icon-calendar"></i>Cadastros</span>
                <ul>
                    <div>
                        <li>
                            <span class="badge badge-success" onclick="changeContent('listaPolos.php')"><i class="icon-minus-sign"></i>Polos</span>
                            <ul>
                                <?php
                                $sql = "SELECT id, nome FROM polo";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                  // output data of each row
                                  while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<li><a href='#' onclick='changeContent(\"gerenciarPolo.php?id=" . $row['id'] . "\")'>" . $row['nome'] . "</a></li>";
                                  }
                                }
                                ?>
                            </ul>
                        </li>

                        <li>
                            <span class="badge badge-success" onclick="changeContent('listaProfessores.php')"><i class="icon-minus-sign"></i> Professores</span>
                            <ul>
                                <?php
                                $sql = "SELECT pr.id as id, po.nome as polo, pr.nome as professor FROM departamento_polo dp, polo po, professor pr Where pr.departamento=dp.id and po.id=dp.id_polo  ORDER BY `po`.`nome`  ASC";
                                $result = mysqli_query($conn, $sql);
                                $cidade = "";
                                if (mysqli_num_rows($result) > 0) {
                                  while ($row = mysqli_fetch_assoc($result)) {
                                    if ($cidade != $row['polo']) {
                                      if ($cidade != "") {
                                        echo "</ul>";
                                      }
                                      $cidade = $row['polo'];
                                      echo"<li><span class='badge badge-success'><i class='icon-minus-sign'></i>" . $cidade . "</span><ul>";
                                    }
                                    echo "<li><a href='#' onclick=\"changeContent('gerenciarProfessor.php?id=" . $row['id'] . "')\">" . $row['professor'] . "</a></li>";
                                  }
                                  echo "</ul>";
                                }
                                ?>
                        </li>
                </ul>

            <li><span class="badge badge-success" onclick="changeContent('listaDisciplinas.php')"><i class="icon-minus-sign"></i>Disciplinas</span>
                <ul>
                    <?php
                    $sql = "SELECT dis.id as id, po.nome as polo, dis.nome as disciplina, dis.codigo as codigo FROM departamento_polo dp, polo po, disciplina dis Where dis.id_departamento_polo=dp.id and po.id=dp.id_polo ORDER BY `po`.`nome` ASC ";
                    $result = mysqli_query($conn, $sql);
                    $cidade = "";
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        if ($cidade != $row['polo']) {
                          if ($cidade != "") {
                            echo "</ul>";
                          }
                          $cidade = $row['polo'];
                          echo"<li><span class='badge badge-success'><i class='icon-minus-sign'></i>" . $cidade . "</span><ul>";
                        }
                        echo "<li><a href='#' onclick=\"changeContent('gerenciarDisciplina.php?id=" . $row['id'] . "')\">" . $row['codigo'] . " - " . $row['disciplina'] . "</a></li>";
                      }
                      echo "</ul>";
                    }
                    ?>
            </li>
        </ul>

        <li><span class="badge badge-success" onclick="changeContent('listaSalas.php')"><i class="icon-minus-sign"></i>Salas</span>
            <ul>
                <?php
                $sql = "SELECT p.nome as polo, s.codigo as codigo, s.id as id FROM sala s, polo p WHERE p.id=s.id_polo Order BY polo,codigo";
                $result = mysqli_query($conn, $sql);
                $cidade = "";
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    if ($cidade != $row['polo']) {
                      if ($cidade != "") {
                        echo "</ul>";
                      }
                      $cidade = $row['polo'];
                      echo"<li><span class='badge badge-success'><i class='icon-minus-sign'></i>" . $cidade . "</span><ul>";
                    }
                    echo "<li><a href='#' onclick='changeContent(\"gerenciarSala.php?id=" . $row['id'] . "\")'>" . $row['codigo'] . "</a></li>";
                  }
                  echo "</ul>";
                }
                ?>
        </li>
        </ul>

        <li><span class="badge badge-success" onclick="changeContent('listaTurmas.php')"><i class="icon-minus-sign"></i>Turmas</span>
            <ul>
                <?php
                $sql = "SELECT t.id as id, po.nome as polo, dis.nome as disciplina, dis.codigo as codigo,"
                        . " t.turma as turma, dep.sigla as sigla, dep.nome as departamento "
                        . "FROM departamento dep, turma t, departamento_polo dp, polo po, disciplina dis "
                        . "WHERE dep.id=dp.id_departamento and dis.id_departamento_polo=dp.id "
                        . "and po.id=dp.id_polo and t.id_disciplina=dis.id and t.id_disciplina=dis.id "
                        . "ORDER BY polo, departamento, disciplina ASC";
                $result = mysqli_query($conn, $sql);
                $cidade = "";
                $departamento = "";
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    if ($cidade != $row['polo']) {
                      $departamento = "";
                      if ($cidade != "") {
                        echo "</li></ul></ul>";
                      }
                      $cidade = $row['polo'];
                      echo"<li><span class='badge badge-success'><i class='icon-minus-sign'></i>" . $cidade . "</span><ul>";
                    }
                    if ($departamento != $row['departamento']) {
                      if ($departamento != "") {
                        echo "</li></ul>";
                      }
                      $departamento = $row['departamento'];
                      echo"<li><span class='badge badge-success'><i class='icon-minus-sign'></i>" . $departamento . "</span><ul>";
                    }
                    echo "<li><a href='#' onclick='changeContent(\"gerenciarTurma.php?id=" . $row['id'] . "\")'>" . $row['codigo'] . $row['turma'] . "</a></li>";
                  }
                  echo "</ul>";
                }
                ?>


    </div>
</ul>
<?php
$sql = "SELECT dis.id as id, po.nome as polo, dis.nome as disciplina, dis.codigo as codigo, t.turma as turma, dep.sigla as sigla, dep.nome as departamento FROM departamento dep, turma t, departamento_polo dp, polo po, disciplina dis Where dep.id=dp.id_departamento and dis.id_departamento_polo=dp.id and po.id=dp.id_polo and t.id_disciplina=dis.id and t.id_disciplina=dis.id ORDER BY polo, departamento, disciplina ASC";
$result = mysqli_query($conn, $sql);
if ($row = mysqli_fetch_assoc($result)) {
  include("gradeGerada.php");
} else {
  echo '<br><br><form><fieldset><input type="submit" class="btn btn-primary" value="Gerar Nova Grade"></fieldset></form>';
}
?>
<script type="text/javascript">
  $(function () {
      $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
      $('.tree li.parent_li > span').on('click', function (e) {
          var children = $(this).parent('li.parent_li').find(' > ul > li');
          if (children.is(":visible")) {
              children.hide('fast');
              $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
          } else {
              children.show('fast');
              $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
          }
          e.stopPropagation();
      });

      var children = $('.tree li.parent_li > span').parent('li.parent_li').find(' > ul > li');
      children.hide('fast');
      $('.tree li.parent_li > span').attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
      e.stopPropagation();

  }
  )
          ;
</script>
<script>
      function showDisciplinas(str) {
          if (str.length === 0) {
              document.getElementById("disciplinas").innerHTML = "";
              return;
          } else {
              var xmlhttp = new XMLHttpRequest();
              xmlhttp.onreadystatechange = function () {
                  if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                      document.getElementById("disciplinas").innerHTML = xmlhttp.responseText;
                  }
              };
              xmlhttp.open("GET", "getDisciplinas.php?q=" + str, true);
              xmlhttp.send();
          }
      }
    </script>
</div>
