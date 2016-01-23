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
			<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Arquivo <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="#">Novo Projeto</a></li>
				<li><a href="#">Abrir Projeto</a></li>
				<li><a href="#">Fechar</a></li>
			</ul>
			</li>
			<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Cadastros Basicos <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="#" onclick="changeContent('gerenciarPolo.php')">Polos</a></li>
				<li><a href="#" onclick="changeContent('gerenciarDisciplina.php')">Disciplinas</a></li>
				<li><a href="#" onclick="changeContent('gerenciarTurma.php')">Turmas</a></li>
				<li><a href="#" onclick="changeContent('gerenciarProfessor.php')">Professores</a></li>
				<li><a href="#" onclick="changeContent('gerenciarSala.php')">Salas</a></li>
				<li><a href="#">Horarios</a></li>
				<li><a href="#">Preferencia de Horarios</a></li>
				<li><a href="#">Preferencia de Disciplinas</a></li>
			</ul>
			</li>
			<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#">Relatorios <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="#">Horario x Professor</a></li>
				<li><a href="#">Professore x Turma</a></li>
				<li><a href="#">Turma x Sala</a></li>
				<li><a href="#">Turma x Dia</a></li>
				<li><a href="#">Turma x Horario x Professor</a></li>
			</ul>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><a><span class="glyphicon glyphicon-user"></span> Bem Vindo</a></li>
			<li><a href="index.html"><span class="glyphicon glyphicon-log-in"></span> Sair</a></li>
		</ul>
	</div>
</div>
</nav>
</div>
