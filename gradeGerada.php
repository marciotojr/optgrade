<li>
    <span><i class="icon-calendar"></i> Grade Gerada</span>
    <ul><div>				
            <li>
                <span class="badge badge-success"><i class="icon-minus-sign"></i> Professores</span>
                <ul>
                    <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'ihc1');
                    if (!$conn)
                      die("Erro fatal. Não foi possível se conectar ao banco de dados.");
                    
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
                        echo "<li><a href='gerenciarProfessor.php?id=" . $row['id'] . "'>" . $row['professor'] . "</a></li>";
                      }
                      echo "</ul>";
                    }
                    ?>
            </li>
				</ul>

<li><span class="badge badge-success"><i class="icon-minus-sign"></i>Disciplinas</span>
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
            echo "<li><a href='gerenciarDisciplina.php?id=" . $row['id'] . "'>" . $row['codigo'] . " - " . $row['disciplina'] . "</a></li>";
          }
          echo "</ul>";
        }
        ?>
</li>
</ul>

<li><span class="badge badge-success"><i class="icon-minus-sign"></i>Salas</span>
				<ul>
        <?php
        $sql = "SELECT p.nome as polo, s.codigo as codigo, s.id as id FROM sala s, polo p WHERE p.id=s.id_polo ";
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
            echo "<li><a href='gerenciarSala.php?id=" . $row['id'] . "'>" . $row['codigo'] . "</a></li>";
          }
          echo "</ul>";
        }
        ?>
</li>
</ul>

<li><span class="badge badge-success"><i class="icon-minus-sign"></i>Turmas</span>
				<ul>
        <?php
        $sql = "SELECT dis.id as id, po.nome as polo, dis.nome as disciplina, dis.codigo as codigo, t.turma as turma, dep.sigla as sigla, dep.nome as departamento FROM departamento dep, turma t, departamento_polo dp, polo po, disciplina dis Where dep.id=dp.id_departamento and dis.id_departamento_polo=dp.id and po.id=dp.id_polo and t.id_disciplina=dis.id and t.id_disciplina=dis.id ORDER BY polo, departamento, disciplina ASC";
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
            echo "<li><a href='gerenciarSala.php?id=" . $row['id'] . "'>" . $row['codigo'] . $row['turma'] . "</a></li>";
          }
          echo "</ul>";
        }
        ?>

    </div>
</ul>
