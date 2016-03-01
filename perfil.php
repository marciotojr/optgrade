<?php
include("header.php");
?>

<style>

    .nova-grade-block {
        width: 320px;
        padding: 25px;
        border: solid 1px;
        margin: auto auto;
        border:1px solid #999;
        overflow-y:auto;
        -webkit-border-radius:4px;
        -moz-border-radius:4px;
        border-radius:4px;
        -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.05);
        -moz-box-shadow:inset 0 1px 1px rgba(0,0,0,0.05);
        box-shadow:inset 0 1px 1px rgba(0,0,0,0.05);
    }

    .nova-grade-block input {
       height: auto;
    }

</style>

<div class="nova-grade-block">
    <legend>Configura&ccedil;&otilde;es Perfil</legend>
    <fieldset class="form-group">
        <label for="nome">Nome Usu&aacute;rio</label>
        <input type="text" class="form-control" id="nome" placeholder="Insira o nome do usuario" value="Usuario Perfil Teste" >
        <label for="nome">Email</label>
        <input type="text" id="email" placeholder="Insira o email. Ex.: teste@gmail.com" value="teste@gmail.com" >
    </fieldset>
    <fieldset class="form-group">
        <button type="submit" class="btn btn-primary" onClick="redirecionar(0)">Atualizar</button>  
        <button type="submit" class="btn btn-primary" onClick="redirecionar(1)">Voltar</button>
    </fieldset>
</div>
</div>

<script type="text/javascript" language="javascript" charset="utf-8">
                function redirecionar(opt)
                {
                    if (opt == 0)
                    {
                        var msgErro = "Os campos abaixo devem ser preenchidos obrigatoriamente: ";
                        if(document.getElementById("nome").value.length == 0 ||
                           document.getElementById("email").value.length == 0 || 
                           document.getElementById("email").value.search("@") < 1 || 
                           document.getElementById("email").value.search(".com") < 4
                           )
                        {
                            if(document.getElementById("nome").value.length == 0)
                            {
                                    msgErro = msgErro + "\n" + "Campo Usuario é obrigatório;";
                            }
                            
                            if(document.getElementById("email").value.length == 0)
                            {
                                    msgErro = msgErro + "\n" + "Campo Email é obrigatório;";
                            }
                            
                            if(document.getElementById("email").value.search("@") < 1 || document.getElementById("email").value.search(".com") < 4)
                            {
                                    msgErro = msgErro + "\n" + "Email informado é inválido. \nGentileza verificar e reinformar.";
                            }

                            document.getElementById("nome").focus();
                            alert(msgErro);
                            return false;
                        }
                        else
                        {
                            alert("Cadastro Atualizado com sucesso!");
                            window.location = "principal.php";
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