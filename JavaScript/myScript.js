function showDisciplinas(str) {
    if (str.length === 0) {
        document.getElementById("disciplinas").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("disciplinas").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "getDisciplinas.php?q=" + str, true);
        xmlhttp.send();
    }
}

function showDisciplinasLista(str,arr) {
    if (str.length === 0) {
        document.getElementById("disciplinas["+arr+"]").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                document.getElementById("disciplinas["+arr+"]").innerHTML = xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET", "getDisciplinas.php?q=" + str, true);
        xmlhttp.send();
    }
}

var count = 1;

  function geraHorarios(primeiro, ultimo) {
      var string = "";
      for (var i = primeiro; i <= ultimo; i++) {
          string += "<option value=" + i + ">" + i + ":00</option>"
      }
      return string;
  }
  ;

  function addHorario() {
      document.getElementById("horarios").innerHTML = document.getElementById("horarios").innerHTML + "<div id='div" + count + "'><fieldset><select name='dia[" + count + "]'><option value=1>Domingo</option>" +
              "<option value=2>Segunda</option><option value=3>Ter&ccedil;a</option><option value=4>Quarta</option><option value=5>Quinta</option><option value=6>Sexta</option>" +
              "<option value=7>S&aacute;bado</option></select><select  name='inicio[" + count + "]'>" + geraHorarios(7, 22) + "</select><select name='fim[" + count + "]'>" + geraHorarios(8, 23) + "</select>" +
              "<a style='margin: 5px 5px 5px 5px;' href='#' onclick='deleteHorario(\"div" + count + "\")'><span class='badge badge-important'><i class='glyphicon glyphicon-minus'></i></span></a></fieldset></div>";
      count += 1;
  }
  ;
  
  function addHorarioMultiplos(id) {
      document.getElementById("horarios"+id).innerHTML = document.getElementById("horarios"+id).innerHTML + "<div id='div" +id+"-" + count + "'><fieldset><select name='dia["+id+"][" + count + "]'><option value=1>Domingo</option>" +
              "<option value=2>Segunda</option><option value=3>Ter&ccedil;a</option><option value=4>Quarta</option><option value=5>Quinta</option><option value=6>Sexta</option>" +
              "<option value=7>S&aacute;bado</option></select><select  name='inicio["+id+"][" + count + "]'>" + geraHorarios(7, 22) + "</select><select name='fim["+id+"][" + count + "]'>" + geraHorarios(8, 23) + "</select>" +
              "<a style='margin: 5px 5px 5px 5px;' href='#' onclick='deleteHorario(\"div"+id+"-"  + count + "\")'><span class='badge badge-important'><i class='glyphicon glyphicon-minus'></i></span></a></fieldset></div>";
      count += 1;
  }
  ;
  function deleteHorario(h) {
      document.getElementById(h).innerHTML = "";
  }
  ;


function validaCadastroPolo(opt)
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
              changeContent("listaPolos.php");
          }
      }
      else if (opt == 1)
      {
          window.location = "listaPolos.php";
      }
      else if (opt == 2)
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
              changeContent("listaPolosGridCadastro.php");
          }
      }
      else if(opt == 3)
      {
          window.location = "listaPolosGridCadastro.php";
      }

  };
  
  function excluir(msg)
  {
      alert(msg);
  }
  
  function validaCadastroTurma(){
      var msgErro = "Os campos abaixo são de preenchimento obrigatório: ";
          if (document.getElementById("turma").value.length == 0)
          {
              if (document.getElementById("turma").value.length == 0)
              {
                  msgErro = msgErro + "\n" + "Campo Turma é obrigatório;";
              }
              document.getElementById("turma").focus();
              alert(msgErro);
              return false;
          }
          else
          {
              alert("Turma cadastrada com sucesso.");
              changeContent("listaTurmas.php");
          }
  }
  
   function validaCadastroSala(){
      var msgErro = "Os campos abaixo são de preenchimento obrigatório: ";
          if (document.getElementById("sala").value.length == 0)
          {
              if (document.getElementById("sala").value.length == 0)
              {
                  msgErro = msgErro + "\n" + "Campo Codigo é obrigatório;";
              }
              document.getElementById("sala").focus();
              alert(msgErro);
              return false;
          }
          else
          {
              alert("Sala cadastrada com sucesso.");
              changeContent("listaSalas.php");
          }
  } 
  
function validaCadastroDisciplina(){
      var msgErro = "Os campos abaixo são de preenchimento obrigatório: ";
          if (document.getElementById("codigo").value.length == 0 || document.getElementById("nome").value.length == 0)
          {
              if (document.getElementById("nome").value.length == 0)
              {
                  msgErro = msgErro + "\n" + "Campo Nome é obrigatório;";
              }
              if (document.getElementById("codigo").value.length == 0)
              {
                  msgErro = msgErro + "\n" + "Campo Codigo é obrigatório;";
              }
              document.getElementById("nome").focus();
              alert(msgErro);
              return false;
          }
          else
          {
              alert("Disciplina cadastrada com sucesso.");
              changeContent("listaDisciplinas.php");
          }
  }
 
function validaCadastroDisciplinaGrid(){
      var msgErro = "Os campos abaixo são de preenchimento obrigatório: ";
          if (document.getElementById("codigo").value.length == 0 || document.getElementById("nome").value.length == 0)
          {
              if (document.getElementById("nome").value.length == 0)
              {
                  msgErro = msgErro + "\n" + "Campo Nome é obrigatório;";
              }
              if (document.getElementById("codigo").value.length == 0)
              {
                  msgErro = msgErro + "\n" + "Campo Codigo é obrigatório;";
              }
              document.getElementById("nome").focus();
              alert(msgErro);
              return false;
          }
          else
          {
              alert("Disciplina cadastrada com sucesso.");
              window.location = "listaDisciplinasGrid.php";
          }
  }

  function validaCadastroProfessor(){
      var msgErro = "Os campos abaixo são de preenchimento obrigatório: ";
          if (document.getElementById("endereco").value.length == 0 || document.getElementById("bairro").value.length == 0 || document.getElementById("cidade").value.length == 0 || document.getElementById("email").value.length == 0 || document.getElementById("nome").value.length == 0 || document.getElementById("cep").value.length == 0 || document.getElementById("uf").value.length == 0)
          {
              if (document.getElementById("nome").value.length == 0)
              {
                  msgErro = msgErro + "\n" + "Campo Nome é obrigatório;";
              }
              if (document.getElementById("endereco").value.length == 0)
              {
                  msgErro = msgErro + "\n" + "Campo Endereco é obrigatório;";
              }
              if (document.getElementById("bairro").value.length == 0)
              {
                  msgErro = msgErro + "\n" + "Campo Bairro é obrigatório;";
              }
              if (document.getElementById("cidade").value.length == 0)
              {
                  msgErro = msgErro + "\n" + "Campo Cidade é obrigatório;";
              }
              if (document.getElementById("uf").value.length == 0)
              {
                  msgErro = msgErro + "\n" + "Campo UF é obrigatório;";
              }
              if (document.getElementById("cep").value.length == 0)
              {
                  msgErro = msgErro + "\n" + "Campo CEP é obrigatório;";
              }
              if (document.getElementById("email").value.length == 0)
              {
                  msgErro = msgErro + "\n" + "Campo Email é obrigatório;";
              }
              document.getElementById("nome").focus();
              alert(msgErro);
              return false;
          }
          else
          {
              alert("Disciplina cadastrada com sucesso.");
              changeContent("listaDisciplinas.php");
          }
  }