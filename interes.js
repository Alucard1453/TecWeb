//Valida si hay una sesion iniciada para mostrar mas opciones de la barra
function validarsesion(){
    if(localStorage.getItem("Logueado")){
        var logueado = parseInt(localStorage.getItem("Logueado"),10);
        if(logueado){
            loadJSON();
        }else{
            location.href ="/php/Proyecto/login.html";
        }
    }else{
      location.href ="/php/Proyecto/login.html";
    }
}

//Contacta con la base de datos y recibe un JSON de los temas en ella
function loadJSON(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var temas = JSON.parse(this.responseText);
            //console.log(temas);
            loadBody(temas);
        }
    };
    xmlhttp.open("GET", "JSON_temas.php", true);
    xmlhttp.send();
}

//Construye el DOM a traves del JSON recibido
function loadBody(temas){
    var elementos = new Array();
    elementos=temas;
    var contenedor = document.getElementById("contenedor");
    
    var fila = document.createElement("div");
        fila.setAttribute("class","row");
        fila.setAttribute("id","formulario");

    for(var i=0; i<elementos.length;i++){
        
        var division = document.createElement("div");
        division.setAttribute("class","col-sm-4 tarjeta");
        division.setAttribute("style","background-image: url("+elementos[i].imagen+");")

        var contenido = document.createElement("div");
        contenido.setAttribute("class","row");
        contenido.setAttribute("class","custom-control custom-checkbox");

        var input = document.createElement("input");
        input.setAttribute("type","checkbox");
        input.setAttribute("class","custom-control-input");
        input.setAttribute("value",elementos[i].id);
        input.setAttribute("id",elementos[i].id)
        contenido.appendChild(input);

        var label = document.createElement("label");
        label.setAttribute("class","custom-control-label display-4");
        label.setAttribute("for",elementos[i].id);
        label.innerText = elementos[i].nombre;
        contenido.appendChild(label);

        division.appendChild(contenido);

        fila.appendChild(division);

        contenedor.appendChild(fila);
    }
}

//Cuando se continue se validan los checkbox seleccionados para mostrarlos en el modal de confirmacion
function obtenNombres(){
    //Obtenemos Valores
    var formulario = document.getElementById("formulario");
    var hijos = formulario.childNodes;
    //console.log(hijos);
    var nombresTemas = new Array();
    for(var i=0;i<hijos.length;i++){
        var div = hijos[i].childNodes[0];
        var check = div.firstChild.checked;
        var nombre = div.textContent;
        //console.log(nombre);
        if(check)
            nombresTemas.push(nombre);
    }

    //Damos valor al Modal
    var modal = document.getElementById("modalContenido");

    if(nombresTemas.length==0)
        modal.innerHTML="No ha seleccionado ningun tema de interes, ¿Desea continuar?";
    else{
        var texto = "Sus temas de interes son: ";
        for(var i=0; i<nombresTemas.length;i++){
            texto+="<br><b>"+nombresTemas[i]+"</b>";
        }
        texto+="<br>¿La información es correcta?";
        modal.innerHTML=texto;
    }
    //console.log(nombresTemas);
}

//Si se continua se procede a generar un JSON con la informacion de los checkbox seleccionados
function continuar(){
    var formulario = document.getElementById("formulario");
    var hijos = formulario.childNodes;
    //console.log(hijos);
    var datos = new Array();
    for(var i=0;i<hijos.length;i++){
        var div = hijos[i].childNodes[0];
        var check = div.firstChild.checked;
        var id = div.firstChild.id;
        var nombre = div.textContent;
        datos.push({
            "id":id,
            "check":check
        });
    }
    guardar(datos);
}

//Se envia a la Base el JSON generado para actualizar la tabla
function guardar(datos){
    //console.log(datos);
    dbParam = JSON.stringify(datos);
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            location.href ="/php/Proyecto/index.html";
        }
    };
    xmlhttp.open("POST", "interes.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("docJSON=" + dbParam);
}