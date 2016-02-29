<fieldset>           
    <div id="horarios">
        <div id="div0">
            <?php
            if (!function_exists('geraHorarios')) {

              function geraHorarios($primeiro, $ultimo) {
                $string = "";
                for ($i = $primeiro; $i <= $ultimo; $i++) {
                  $string = $string . "<option value=" . $i . ">" . $i . ":00</option>";
                }
                return $string;
              }

            }


            $count = 1;
            if (!isset($_GET['id'])) {
              echo "<fieldset><select name='dia[\"0\"]'><option value=1>Domingo</option>" .
              "<option value=2>Segunda</option><option value=3>Ter&ccedil;a</option><option value=4>Quarta</option><option value=5>Quinta</option>" .
              "<option value=6>Sexta</option>" .
              "<option value=7>S&aacute;bado</option></select><select  name='inicio[\"0\"]'>" . geraHorarios(7, 22) . "</select>" .
              "<select name='fim[\"0\"]'>" . geraHorarios(8, 23) . "</select>";
              $id = "-1";
              $count+=1;
            } else {
              echo "<fieldset><select name='dia[\"0\"]'><option value=1>Domingo</option>" .
              "<option value=2>Segunda</option><option value=3>Ter&ccedil;a</option><option value=4>Quarta</option><option value=5>Quinta</option>" .
              "<option value=6>Sexta</option>" .
              "<option value=7>S&aacute;bado</option></select><select  name='inicio[\"0\"]'>" . geraHorarios(7, 22) . "</select>" .
              "<select name='fim[\"0\"]'>" . geraHorarios(8, 23) . "</select>";
              $count+=1;
              $id = $_GET['id'];
              $conn = mysqli_connect('localhost', 'root', '', 'ihc1');
              if (!$conn)
                die("Erro fatal. Não foi possível se conectar ao banco de dados.");
//$db = mysqli_select_db('ihc1', $link) or die('Could not select database.');

              $sql = "SELECT h.id_dia as dia, h.inicio as inicio, h.fim as fim FROM turma t, horario h WHERE h.id_turma=t.id and t.id=" . $id . " ORDER BY h.id_dia, h.inicio";
              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                if ($turma = mysqli_fetch_assoc($result)) {
                  extract($turma, EXTR_OVERWRITE, "turma");
                }
              }
            }
            ?>

        </div>
    </div>
</fieldset>
<fieldset>
    <a href="#" onclick="addHorario()"><span class="badge badge-success"><i class="glyphicon glyphicon-plus"></i> Adicionar hor&aacute;rio</span></a>
</fieldset>
<script>
  var count = <? echo $count; ?>;





</script>
