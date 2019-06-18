function news() {
    document.getElementById("news").style.display = "block";
    document.getElementById("terminarz").style.display = "none";
    document.getElementById("tabela").style.display = "none";
    document.getElementById("kadra").style.display = "none";
}

function terminarz() {
    document.getElementById("news").style.display = "none";
    document.getElementById("terminarz").style.display = "block";
    document.getElementById("tabela").style.display = "none";
    document.getElementById("kadra").style.display = "none";
}

function tabela() {
    document.getElementById("news").style.display = "none";
    document.getElementById("terminarz").style.display = "none";
    document.getElementById("tabela").style.display = "block";
    document.getElementById("kadra").style.display = "none";
}


function kadra() {
    document.getElementById("news").style.display = "none";
    document.getElementById("terminarz").style.display = "none";
    document.getElementById("tabela").style.display = "none";
    document.getElementById("kadra").style.display = "block";
}

function dodaj(){
    document.getElementById("dodajZawodnik").style.display = "block";
    document.getElementById("usunZawodnik").style.display = "none";
    document.getElementById("edytujZawodnik").style.display = "none";
}

function usun(){
    document.getElementById("dodajZawodnik").style.display = "none";
    document.getElementById("usunZawodnik").style.display = "block";
    document.getElementById("edytujZawodnik").style.display = "none";
}

function edytuj(){
    document.getElementById("dodajZawodnik").style.display = "none";
    document.getElementById("usunZawodnik").style.display = "none";
    document.getElementById("edytujZawodnik").style.display = "block";
}