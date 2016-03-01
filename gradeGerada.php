
<span><i class="icon-calendar"></i> Grade Gerada</span>
<ul>
    <div>

        <li><span class="badge badge-success"><i class="icon-minus-sign"></i>Departamentos</span>
            <ul>
                <?php
                $sql = "SELECT dp.id as id, po.nome as polo, dep.nome as departamento FROM departamento_polo dp, polo po, departamento dep Where dp.id>=0 and dep.id>=0 and dep.id=dp.id_departamento and po.id=dp.id_polo ORDER BY `po`.`nome`, dep.nome ASC";
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
                    echo "<li><a href='#' onclick=\"changeContent('relatorioDepartamento.php?id=" . $row['id'] . "')\">" . $row['departamento'] . "</a></li>";
                  }
                  echo "</ul>";
                }
                ?>
            </ul>
        </li>

        <li>
            <span class="badge badge-success" onclick="changeContent('listaRelatorioProfessores.php')"><i class="icon-minus-sign"></i> Professores</span>
            <ul>
                <?php
                $sql = "SELECT pr.id as id, po.nome as polo, pr.nome as professor, d.sigla as departamento FROM departamento_polo dp, polo po, professor pr, departamento d WHERE pr.id>=0 and pr.departamento=dp.id and po.id=dp.id_polo and dp.id_departamento=d.id  ORDER BY polo, sigla, professor  ASC";
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
                    echo "<li><a href='#' onclick=\"changeContent('relatorioProfessor.php?id=" . $row['id'] . "')\">" . $row['professor'] . "</a></li>";
                  }
                  echo "</ul>";
                }
                ?>

            </ul>
        </li>

        <li><span class="badge badge-success" onclick="changeContent('listaRelatorioDisciplinas.php')"><i class="icon-minus-sign"></i>Disciplinas</span>
            <ul>
                <?php
                $sql = "SELECT dis.id as id, po.nome as polo, dis.nome as disciplina, dis.codigo as codigo FROM departamento_polo dp, polo po, disciplina dis Where dis.id>=0 and dis.id_departamento_polo=dp.id and po.id=dp.id_polo ORDER BY `po`.`nome` ASC ";
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
                    echo "<li><a href='#' onclick=\"changeContent('relatorioDisciplina.php?id=" . $row['id'] . "')\">" . $row['codigo'] . " - " . $row['disciplina'] . "</a></li>";
                  }
                  echo "</ul>";
                }
                ?>
        </li>
</ul>

<li><span class="badge badge-success" onclick="changeContent('listaRelatorioSalas.php')"><i class="icon-minus-sign"></i>Salas</span>
    <ul>
        <?php
        $sql = "SELECT p.nome as polo, s.codigo as codigo, s.id as id FROM sala s, polo p WHERE s.id>=0 and p.id=s.id_polo Order BY polo,codigo";
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
            echo "<li><a href='#' onclick='changeContent(\"relatorioSala.php?id=" . $row['id'] . "\")'>" . $row['codigo'] . "</a></li>";
          }
          echo "</ul>";
        }
        ?>
</li>
</ul>

<li><span class="badge badge-success" onclick="changeContent('listaRelatorioTurmas.php')"><i class="icon-minus-sign"></i>Turmas</span>
    <ul>
        <?php
        $sql = "SELECT t.id as id, po.nome as polo, dis.nome as disciplina, dis.codigo as codigo,"
                . " t.turma as turma, dep.sigla as sigla, dep.nome as departamento "
                . "FROM departamento dep, turma t, departamento_polo dp, polo po, disciplina dis "
                . "WHERE t.id>=0 and dep.id=dp.id_departamento and dis.id_departamento_polo=dp.id "
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
            echo "<li><a href='#' onclick='changeContent(\"relatorioTurma.php?id=" . $row['id'] . "\")'>" . $row['codigo'] . $row['turma'] . "</a></li>";
          }
          echo "</ul>";
        }
        ?>
    </div>
</ul>
<?php
$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
$message = "Erro desconhecido! Tente novamente, em caso de persist&ecirc;ncia chame o administrador!";
$messageType = "danger";
extract($_POST, EXTR_OVERWRITE);

$colisoes = "SELECT id,tipo FROM colisoes ORDER BY id ASC, tipo DESC";
$falhas = "SELECT t.id as id, d.codigo as codigo, d.nome as disciplina, t.turma as turma FROM turma t, disciplina d WHERE t.id_disciplina=d.id and (t.id_professor IS NULL or t.id_sala IS NULL) and t.id<>-1";

$colisoes = mysqli_query($conn, $colisoes);
$falhas = mysqli_query($conn, $falhas);
if (mysqli_num_rows($colisoes) + mysqli_num_rows($falhas) > 0) {//caso exista igual a atualização
  echo
  '<span><i class="icon-calendar"></i> Colis&otilde;es/Falhas</span>
<ul>
    <div>
';
  if (mysqli_num_rows($colisoes) > 0) {
    echo '<li><span class = "badge badge-important"><i class = ""></i> Colis&otilde;es</span><ul>';
    $count=0;
    $id_colisao=-1;
    while ($row = mysqli_fetch_assoc($colisoes)) {
      $tipo=$row['tipo'];
      if($id_colisao!=$row['id']){
        $count++;
        $id_colisao=$row['id'];
        echo '<li><a href="#"><span class = "badge badge-important"  onclick="changeContent(\'realoca.php?id='.$id_colisao.'\')"><i class = "glyphicon glyphicon-alert"></i> Colis&atilde;o #'.$count.': '.$tipo.' x Horario</span></a></li>';
      }
    }
    echo '</ul></li>';
  }
  if (mysqli_num_rows($falhas) > 0) {
    echo '<li><span class = "badge badge-important"><i class = ""></i> Falhas</span><ul>';
    $count=0;
    while ($row = mysqli_fetch_assoc($falhas)) {
      $count++;
      echo '<li><a href="#"><span class = "badge badge-important"  onclick="changeContent(\'realoca.php?id='.$row['id'].'\')"><i class = "glyphicon glyphicon-alert"></i> Falha #'.$count.': '.$row['codigo'].$row['turma'].' - '.$row['disciplina'].'</span></a></li>';
    }
    echo '</li>';
  }
  echo '
    </div>
</ul>';
}
?>

