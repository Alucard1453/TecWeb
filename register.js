function getTemas(){

}

function validaedad(age){
    if(age<15){
        var div = document.getElementById("noedad");
        div.style.display = "block";
    }else{
        var div = document.getElementById("noedad");
        div.style.display = "none";
        return true;
    }
}

function escribeuser() {
    var div = document.getElementById("nouser");
    div.style.display = "none";
    div = document.getElementById("invaliduser");
    div.style.display = "none";
}

function escribepass() {
    var div = document.getElementById("nopass");
    div.style.display = "none";
}

function validarFormulario(usuario,pass,edad){
    if(usuario==""){
        var div = document.getElementById("nouser");
        div.style.display = "block";
    }

    if(pass==""){
        var div = document.getElementById("nopass");
        div.style.display = "block";
    }

    if(usuario!="" && pass!="" && validaedad(edad))
        return true;
    else
        return false;
}

function registrar(usuario,pass,edad,genero,ecivil) {
    if(validarFormulario(usuario,pass,edad)){
        validarregistro(usuario,pass,edad,genero,ecivil);
    }
}

function validarregistro(usuario,pass,edad,genero,ecivil){
    //console.log(usuario,pass,edad,genero,ecivil);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var respuesta = parseInt(this.responseText,10);
            /*var respuesta = this.responseText;
            console.log(respuesta);*/
            if(!respuesta){
                localStorage.setItem("Logueado","1");
                location.href ="/php/Proyecto/index.html";
            }
            else{
                var div = document.getElementById("invaliduser");
                div.style.display = "block";
            }
        }
    };
    xmlhttp.open("GET", "register.php?Usuario="+usuario+"&Password="+pass+"&Edad="+edad+"&Genero="+genero+"&Ecivil="+ecivil, true);
    xmlhttp.send();
}