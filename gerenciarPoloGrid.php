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

$nome = "";
$cidade = "";
$uf = "";

$conn = mysqli_connect('localhost', 'root', '', 'ihc1');
if (!$conn)
  die("Erro fatal. Não foi possível se conectar ao banco de dados.");
//$db = mysqli_select_db('ihc1', $link) or die('Could not select database.');

$sql = "SELECT nome, cidade, uf FROM polo WHERE id =" . $id;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  if ($polo = mysqli_fetch_assoc($result)) {
    extract($polo, EXTR_OVERWRITE, "polo");
  }
}
?>
    <fieldset>
        <input type="hidden" id="id" value="<?php echo $id; ?>">
        <legend>Dados do Polo</legend>
        <fieldset class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" value="<?php echo $nome; ?>" placeholder="Insira o nome">
        </fieldset>
        <fieldset class="form-group">
            <label for="cidade">Cidade</label>
            <input type="text" class="form-control" id="cidade" value="<?php echo $cidade; ?>" placeholder="Insira a cidade">
        </fieldset>
        <fieldset class="form-group">
            <label for="cidade">UF</label>
            <input type="text" class="form-control" length="2" size="2" id="uf" value="<?php echo $uf; ?>" placeholder="Insira a UF">
        </fieldset>
    </fieldset>
    <button type="submit" class="btn btn-primary" onClick="redirecionar(0)">Cadastrar</button>  
	<button type="submit" class="btn btn-primary" onClick="redirecionar(1)">Voltar</button>	
</div>

</div>


<script type="text/javascript" language="javascript" charset="utf-8">
                function redirecionar(opt)
                {
                    if (opt == 0)
                    {
                        var msgErro = "Os campos abaixo são de preenchimento obrigatório: ";
                        if (document.getElementById("nome").value.length == 0 || document.getElementById("cidade").value.length == 0 || document.getElementById("uf").value.length == 0)
                        {
                            if (document.getElementById("nome").value.length == 0)
                            {
                                msgErro = msgErro + "\n" + "Campo Nome é obrigatório;";
                            }

                            if (document.getElementById("cidade").value.length == 0)
                            {
                                msgErro = msgErro + "\n" + "Campo Cidade é obrigatório;";
                            }
							
							if (document.getElementById("uf").value.length == 0)
                            {
                                msgErro = msgErro + "\n" + "Campo UF é obrigatório;";
                            }
                            document.getElementById("nome").focus();
                            alert(msgErro);
                            return false;
                        }
                        else
                        {
                            alert("Polo X atualizado com sucesso.");
                            window.location = "listaPolosGrid.php";
                        }
                    }
                    else if (opt == 1)
                    {
                        window.location = "listaPolosGrid.php";
                    }

                }
</script>

</body>
</html>
