function escribeuser() {
    var div = document.getElementById("nouser");
    div.style.display = "none";
    div = document.getElementById("invalidinfo");
    div.style.display = "none";
}

function escribepass() {
    var div = document.getElementById("nopass");
    div.style.display = "none";
    div = document.getElementById("invalidinfo");
    div.style.display = "none";
}

function validarFormulario(usuario,pass){
    if(usuario==""){
        var div = document.getElementById("nouser");
        div.style.display = "block";
    }

    if(pass==""){
        var div = document.getElementById("nopass");
        div.style.display = "block";
    }

    if(usuario!="" && pass!="")
        return true;
    else
        return false;
}

function ingresar(usuario,pass) {
    if(validarFormulario(usuario,pass)){
        validaracceso(usuario,pass);
    }
}

function validaracceso(usuario,pass){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var respuesta = parseInt(this.responseText,10);
            if(respuesta){
                localStorage.setItem("Logueado","1");
                location.href ="/php/Proyecto/index.html";
            }
            else{
                var div = document.getElementById("invalidinfo");
                div.style.display = "block";
            }
        }
    };
    xmlhttp.open("GET", "login.php?Usuario="+usuario+"&Password="+pass, true);
    xmlhttp.send();
}