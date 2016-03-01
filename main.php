<?php
ini_set('default_charset', 'UTF-8');
include("header.php");
include("lateralMenu.php");
?>
<div id="content" class="content">
    <?php
    if (isset($_POST["message"])) {
      $messageTitle = "";
      //echo "<div id='message' class='".$_POST["messageType"]."Message'>".$_POST["message"]."</div>";
      switch ($_POST["messageType"]) {
        case "success":
          $messageTitle = "Sucesso!";
          break;
        case "info":
          $messageTitle = "Informação!";
          break;
        case "warning":
          $messageTitle = "Atenção!";
          break;
        case "danger":
          $messageTitle = "Erro!";
          break;
      }
      echo "<div class='alert alert-" . $_POST["messageType"] . " fade in'><strong>" . $messageTitle . "</strong> " . $_POST["message"]
      . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
    }
    if (isset($_POST["page"])) {
      include $_POST["page"] . ".php";
    } else {
      echo '<legend>Primeiros Passos</legend>
    <p>Para buscar informa&ccedil;&otilde;es do projeto utilize os menus laterias de forma sequenciada para navegar.</p>
    
    <p style="font-size: 14px; font-weight: bold;">Veja como &eacute; f&aacute;cil:</p>
    <br>
    <p style="font-size: 14px; font-weight: bold;">1 - Expandindo a &aacute;rvore:</p>
    <img src="Expandir_Arvore.png" style="max-width: 130% "/>    
        
    <p style="font-size: 14px; font-weight: bold;">2 - Exibindo as informa&ccedil;&otilde;es:</p>
    <img src="Exibir_Grid.png" style="max-width: 130% "/>
            	';
    }
    ?>
</div>
</div>
</body>
</html>
