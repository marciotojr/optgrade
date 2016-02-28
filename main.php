<?php
ini_set('default_charset','UTF-8');
include("header.php");
include("lateralMenu.php");
?>
<div id="content" class="content">
<?php
  if (isset($_POST["message"])){
    $messageTitle="";
    //echo "<div id='message' class='".$_POST["messageType"]."Message'>".$_POST["message"]."</div>";
    switch ($_POST["messageType"]){
      case "success": 
        $messageTitle="Sucesso!";
        break;
      case "info": 
        $messageTitle="Informação!";
        break;
      case "warning": 
        $messageTitle="Atenção!";
        break;
      case "danger": 
        $messageTitle="Erro!";
        break;
      
    }
    echo "<div class='alert alert-".$_POST["messageType"]." fade in'><strong>".$messageTitle."</strong> ".$_POST["message"]
            . '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
  }
  if (isset($_POST["page"])){
    include $_POST["page"].".php";
  }
?>
</div>
</div>
</body>
</html>
