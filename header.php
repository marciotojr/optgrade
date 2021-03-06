<!DOCTYPE html>
<html lang="en">
    <head>
        <title>optGrade</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script src="javascript/myScript.js"></script>
        <link rel="stylesheet" href="bootstrap-tree-master/bootstrap-combined.min.css">
        <link rel="stylesheet" href="css/tables.css">
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

    </head>
    <body>
        <div class="topMenu">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">optGrade</a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            
                            <li>
                                <a href="principal.php"><span class="glyphicon glyphicon-home"></span> Home</a>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Projeto <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="novoProjeto.php">Novo Projeto</a></li>
                                    <li><a href="abrirProjeto.php">Abrir Projeto</a></li>
                                    <li><a href="principal.php">Fechar</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Cadastros Basicos <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="listaPolosGridCadastro.php" onclick="changeContent('listaPolosGrid.php')">Polos</a></li>
                                    <li><a href="listaDisciplinasGrid.php" onclick="changeContent('listaDisciplinasGrid.php')">Disciplinas</a></li>
                                    <li><a href="listaTurmasGrid.php" onclick="changeContent('listaTurmasGrid.php')">Turmas</a></li>
                                    <li><a href="listaProfessorGrid.php" onclick="changeContent('listaProfessorGrid.php')">Professores</a></li>
                                    <li><a href="listaSalasGrid.php" onclick="changeContent('listaSalasGrid.php')">Salas</a></li>
                                    <!--li><a href="#">Horarios</a></li>
                                    <li><a href="#">Preferencia de Horarios</a></li>
                                    <li><a href="#">Preferencia de Disciplinas</a></li-->
                                </ul>
                            </li>
                            <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Relatorios <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                             <li><a href="#">Turma x Professor</a></li>
                             <li><a href="main.php?relatorio=1&page=relatorioSala">Turma x Sala</a></li>
                             <li><a href="#">Turma x Disciplina</a></li>
                             <li><a href="#">Turma x Departamento</a></li>
                            </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="perfil.php"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
                            <li><a href="help.php"><span class="glyphicon glyphicon-book"></span> Ajuda</a></li>
                            <li><a href="index.html"><span class="glyphicon glyphicon-log-in"></span> Sair</a></li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
