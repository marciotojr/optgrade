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
    <legend>Abrir Grades Existentes</legend>
    <fieldset class="form-group">
        <label for="nome">Nome Grade</label>
        <select class="form-control" id="curso">
            <option value="Grade 2015.1">Grade 2015.1</option>
            <option value="Grade 2015.3">Grade 2015.3</option>
            <option value="Grade 2016.1">Grade 2016.1</option>
            <option value="Grade 2016.3">Grade 2016.3</option>
        </select>
    </fieldset>
    <fieldset class="form-group">
        <button type="submit" class="btn btn-primary" onClick="redirecionar(0)">Abrir</button>  
        <button type="submit" class="btn btn-primary" onClick="redirecionar(1)">Voltar</button>
    </fieldset>
</div>
</div>

<script type="text/javascript" language="javascript" charset="utf-8">
                function redirecionar(opt)
                {
                    if (opt == 0)
                    {
                        window.location = "main.php";                        
                    }
                    else if (opt == 1)
                    {
                        window.location = "principal.php";
                    }

                }
</script>

</body>
</html>
