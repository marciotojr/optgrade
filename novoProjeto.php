<?php
include("header.php");
?>
<style>

    .nova-grade-block {
        width: 320px;
        padding: 20px;
        border: solid 1px;
        margin: auto auto;
    }

</style>

<div class="nova-grade-block">
    <legend>Nova Grade</legend>
    <fieldset class="form-group">
        <label for="nome">Nome</label>
        <input type="text" class="form-control" id="nome" placeholder="Insira o nome da nova grade">
    </fieldset>
    <fieldset class="form-group">
        <label for="descricao">Descri&ccedil;&atilde;o Resumida</label>
        <textarea id="descricao" style="margin: 0px 0px 10px 0px; width: 277px;" rows="3" cols="100" placeholder="Insira a descri&ccedil;&atilde;o do projeto"></textarea>
    </fieldset>
    <fieldset class="form-group">
        <br>
        <button type="submit" class="btn btn-primary" onClick="redirecionar(0)">Cadastrar</button>  
        <button type="submit" class="btn btn-primary" onClick="redirecionar(1)">Voltar</button>
    </fieldset>
</div>
</div>

<script type="text/javascript" language="javascript" charset="utf-8">
                function redirecionar(opt)
                {
                    if (opt == 0)
                    {
                        var msgErro = "Os campos abaixo são de preenchimento obrigatório: ";
                        if (document.getElementById("nome").value.length == 0 || document.getElementById("descricao").value.length == 0)
                        {
                            if (document.getElementById("nome").value.length == 0)
                            {
                                msgErro = msgErro + "\n" + "Campo Nome é obrigatório;";
                            }

                            if (document.getElementById("descricao").value.length == 0)
                            {
                                msgErro = msgErro + "\n" + "Campo Descricao é obrigatório;";
                            }
                            document.getElementById("nome").focus();
                            alert(msgErro);
                            return false;
                        }
                        else
                        {
                            alert("Projeto X cadastrado com sucesso. Click em OK para continuar e visualizar os detalhes.");
                            window.location = "main.php";
                        }
                    }
                    else if (opt == 1)
                    {
                        window.location = "principal.php";
                    }

                }
</script>

</body>
</html>
