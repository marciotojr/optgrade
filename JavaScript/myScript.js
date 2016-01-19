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
