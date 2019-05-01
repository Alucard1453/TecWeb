function validarsesion(){
    if(localStorage.getItem("Logueado")){
    var logueado = parseInt(localStorage.getItem("Logueado"),10);
    if(logueado){
        var div = document.getElementById("btnEdition");
        div.style.display = "block";

        div = document.getElementById("btnMis");
        div.style.display = "block";

        div = document.getElementById("btnpublic");
        div.style.display = "block";

        div = document.getElementById("btncerrar");
        div.style.display = "block";

        div = document.getElementById("btnlogin");
        div.style.display = "none";

    }else{
        var div = document.getElementById("btnlogin");
        div.style.display = "block";
    }}
}