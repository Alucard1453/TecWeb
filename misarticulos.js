//Valida si hay una sesion iniciada para mostrar mas opciones de la barra
function validarsesion(){
    if(localStorage.getItem("Logueado")){
        var logueado = parseInt(localStorage.getItem("Logueado"),10);
        if(logueado){
            var div = document.getElementById("btnalta");
            div.style.display = "block";

            div = document.getElementById("btnMis");
            div.style.display = "block";

            div = document.getElementById("btnpublic");
            div.style.display = "block";

            div = document.getElementById("btncerrar");
            div.style.display = "block";

            div = document.getElementById("btnlogin");
            div.style.display = "none";

            cargaTemas();
            getMisTemas();

        }else{
            var div = document.getElementById("btnlogin");
            div.style.display = "block";
            location.href ="/php/Proyecto/login.html";
        }
    } else{
        location.href ="/php/Proyecto/login.html";
    }
}

//Carga los temas disponibles de acuerdo a la base de datos, devuelve un JSON
function getMisTemas(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var temas = JSON.parse(this.responseText);
            //console.log(temas);
            loadMisTemas(temas);
        }
    };
    xmlhttp.open("GET", "JSON_temas.php", true);
    xmlhttp.send();
}

//Recibe el JSON de la base y carga los temas disponibles en el DOM
function loadMisTemas(temas){
    var elementos = new Array();
    elementos=temas;
    var contenedor = document.getElementById("selecTemaPagina");

    for(var i=0; i<elementos.length;i++){
        var opcion = document.createElement("option");
        opcion.setAttribute("value",elementos[i].id);
        opcion.innerHTML=elementos[i].nombre;

        contenedor.appendChild(opcion);
    }
    getArticulos(0);
}

////////////////////////////////////////////////////////////////
//Funcionamiento de la pagina
//Solicita un JSON a la base para obtener los articulos por temas
var articulos;
function getArticulos(id){
    //console.log(id);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //var articulos = this.responseText;
            articulos = JSON.parse(this.responseText);
            console.log(articulos);
            loadArticulos(articulos);
        }
    };
    xmlhttp.open("GET", "JSON_misarticulos.php?idTema="+id, true);
    xmlhttp.send();
}

//Carga en el DOM los articulos Recibidos
function loadArticulos(userArticulos){
    var contenedor = document.getElementById("contenedor");
        contenedor.removeChild(document.getElementById("articulos"));
    
    var articulos = document.createElement("div");
        articulos.setAttribute("id","articulos");

    if(userArticulos){
        var elementos = new Array();
        elementos=userArticulos;
        
        for(var i=0 ; i<elementos.length;i++){
            var card = document.createElement("div");
                card.setAttribute("class","card");
                card.setAttribute("id","card"+elementos[i].idArticulo);
            var cardbody =document.createElement("div");
                cardbody.setAttribute("class","card-body");
            var rowtitle = document.createElement("div");
                rowtitle.setAttribute("class","row");
            var col8 = document.createElement("div");
                col8.setAttribute("class","col-8");
            var h5 = document.createElement("h5");
                h5.setAttribute("class","card-title");
                h5.innerHTML=elementos[i].nArticulo;
            var nombreTema = document.createElement("div");
                nombreTema.innerHTML=elementos[i].nTema;
            col8.appendChild(h5);
            col8.appendChild(nombreTema);
            //boton editar
            var col1h2 = document.createElement("div");
                col1h2.setAttribute("class","col-2");
            var buttonedit = document.createElement("button");
                buttonedit.setAttribute("class","btn btn-primary");
                buttonedit.setAttribute("data-toggle","modal");
                buttonedit.setAttribute("data-target","#modalEdicion");
                buttonedit.setAttribute("onclick","seleccionaArticuloEdicion("+elementos[i].idArticulo+")");
                buttonedit.innerHTML="<i class='far fa-edit'></i>";
            col1h2.appendChild(buttonedit);
            //boton eliminar
            var col2h2 = document.createElement("div");
                col2h2.setAttribute("class","col-2");
            var buttondelete = document.createElement("button");
                buttondelete.setAttribute("class","btn btn-danger");
                buttondelete.setAttribute("data-toggle","modal");
                buttondelete.setAttribute("data-target","#modalConfirmaBaja");
                buttondelete.setAttribute("onclick","seleccionaArticulo("+elementos[i].idArticulo+")");
                //buttondelete.setAttribute("onclick","eliminaArticulo("+elementos[i].idArticulo+")");
                buttondelete.innerHTML="<i class='far fa-trash-alt'></i>";
            col2h2.appendChild(buttondelete);
            rowtitle.appendChild(col8);
            rowtitle.appendChild(col1h2);
            rowtitle.appendChild(col2h2);
            cardbody.appendChild(rowtitle);
            var hr = document.createElement("hr");
            cardbody.appendChild(hr);
            var imagen=document.createElement("img");
                imagen.setAttribute("src",elementos[i].imagen);
                imagen.setAttribute("class","card-img-top");
            cardbody.appendChild(imagen);
            var p=document.createElement("p");
                p.setAttribute("class","card-text");
                p.innerHTML=elementos[i].contenido;
            cardbody.appendChild(p);
            var hr = document.createElement("hr");
            cardbody.appendChild(hr);
            //footer
            var rowfooter = document.createElement("div");
                rowfooter.setAttribute("class","row");
            //boton likes
            var col1f2 = document.createElement("div");
                col1f2.setAttribute("class","col-2");
            var buttonlike = document.createElement("button");
                buttonlike.setAttribute("class","btn btn-primary");
                buttonlike.setAttribute("disabled","true");
                buttonlike.innerHTML="<i class='far fa-thumbs-up'></i> "+elementos[i].nlike;
            col1f2.appendChild(buttonlike);
            //boton dislikes
            var col2f2 = document.createElement("div");
                col2f2.setAttribute("class","col-2");
            var buttondislike = document.createElement("button");
                buttondislike.setAttribute("class","btn btn-danger");
                buttondislike.setAttribute("disabled","true");
                buttondislike.innerHTML="<i class='far fa-thumbs-down'></i> "+elementos[i].dislike;
            col2f2.appendChild(buttondislike);
            //boton no me interesa
            var col3f2 = document.createElement("div");
                col3f2.setAttribute("class","col-2");
            var buttonnotinterested = document.createElement("button");
                buttonnotinterested.setAttribute("class","btn btn-warning");
                buttonnotinterested.setAttribute("disabled","true");
                buttonnotinterested.innerHTML="<i class='far fa-meh'></i> "+elementos[i].interested;
            col3f2.appendChild(buttonnotinterested);
            //espacio
            var col4f3 = document.createElement("div");
                col4f3.setAttribute("class","col-3");
                col4f3.innerHTML = "Valoracion: <b>"+elementos[i].calificacion+"</b>";
            //Autor
            var col5f3 = document.createElement("div");
                col5f3.setAttribute("class","col-3");
                col5f3.innerHTML = "Autor: <b>"+elementos[i].nUsuario+"</b>";

            rowfooter.appendChild(col1f2);
            rowfooter.appendChild(col2f2);
            rowfooter.appendChild(col3f2);
            rowfooter.appendChild(col4f3);
            rowfooter.appendChild(col5f3);
            cardbody.appendChild(rowfooter);
            card.appendChild(cardbody);
            articulos.appendChild(card);
            var br = document.createElement("br");
            articulos.appendChild(br);
        }

        contenedor.appendChild(articulos);
    } else{
        var hijo = document.createElement("div");
            hijo.setAttribute("class", "alert alert-danger");
            hijo.setAttribute("role", "alert");
            hijo.innerHTML = "Usted no ha agregado articulos del tema seleccionado";
        articulos.appendChild(hijo);
        contenedor.appendChild(articulos);
    }
}

//Funciona para seleccionar el articulo en caso de eliminacion
var articuloSeleccionado;
function seleccionaArticulo(id){
    articuloSeleccionado=id;
    var dialogo = document.getElementById("modalContenido");
    var arreglo = new Array();
    arreglo=articulos;
    for(var i=0;i<arreglo.length;i++){
        if(arreglo[i].idArticulo == articuloSeleccionado)
            var datosArticulo = arreglo[i];
    }
    //console.log(datosArticulo);
    dialogo.innerHTML="¿Desea eliminar el articulo <b>"+datosArticulo.nArticulo+"</b>?";
}

//Por practicidad solo se elimina del DOM
function eliminaArticulo(){
    console.log(articuloSeleccionado);
    var contenedor = document.getElementById("articulos");
    var articulo = document.getElementById("card"+articuloSeleccionado);
    contenedor.removeChild(articulo);
}

//Selecciona el articulo para recuperarlo en caso de edicion
function seleccionaArticuloEdicion(id){
    articuloSeleccionado=id;
    var arreglo = new Array();
    arreglo=articulos;
    for(var i=0;i<arreglo.length;i++){
        if(arreglo[i].idArticulo == articuloSeleccionado)
            var datosArticulo = arreglo[i];
    }
    //console.log(datosArticulo);
    var titulo = document.getElementById("titulo_edicion");
    titulo.setAttribute("value",datosArticulo.nArticulo);
    var imagen = document.getElementById("imagen_edicion");
    imagen.setAttribute("value",datosArticulo.imagen);
    var contenido = document.getElementById("texto_edicion");
    contenido.setAttribute("value",datosArticulo.contenido);
    var idArticulo = document.getElementById("idArticulo");
    idArticulo.setAttribute("value",datosArticulo.idArticulo);
}

////////////////////////////////////////////////////////
//Funcionamiento del boton Logout
//Funcion para cerrar sesion
function logout(){
    localStorage.removeItem("Logueado");
    localStorage.removeItem("idTema");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var respuesta = this.responseText;
            console.log(respuesta);
            location.href ="/php/Proyecto/index.html";
        }
    };
    xmlhttp.open("GET", "logout.php", true);
    xmlhttp.send();
}

////////////////////////////////////////////////////////
//Funcionamiento del boton Añadir
//Carga los temas disponibles de acuerdo a la base de datos, devuelve un JSON
function cargaTemas(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var temas = JSON.parse(this.responseText);
            //console.log(temas);
            loadTemas(temas);
        }
    };
    xmlhttp.open("GET", "JSON_temas.php", true);
    xmlhttp.send();
}

//Recibe el JSON de la base y carga los temas disponibles en el DOM
function loadTemas(temas){
    var elementos = new Array();
    elementos=temas;
    var contenedor = document.getElementById("selectTema");
    var edicion = document.getElementById("listado_edicion");

    for(var i=0; i<elementos.length;i++){
        var opcion = document.createElement("option");
        opcion.setAttribute("value",elementos[i].id);
        opcion.innerHTML=elementos[i].nombre;

        contenedor.appendChild(opcion);

        var opcionEdicion = document.createElement("option");
        opcionEdicion.setAttribute("value",elementos[i].id);
        opcionEdicion.innerHTML=elementos[i].nombre;

        edicion.appendChild(opcionEdicion);
    }

    var newTema = document.getElementById("newTema");
    newTema.style.display = "none";
}

//Si el tema a dar de alta no esta en base de datos
function otroTema(){
    var check = document.getElementById("check");
    var listado = document.getElementById("listado");

    if(check.checked){
        listado.style.display = "none";
        newTema.style.display = "block";
        check.setAttribute("value",true);
        loadXMLDoc();
    }else{
        listado.style.display = "block";
        newTema.style.display = "none";
        check.setAttribute("value",false);
    }
}

//Carga el XML con los temas que aun no estan en la base
function loadXMLDoc() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          obtenTemasDisponibles(this);
      }
    };
    xmlhttp.open("GET", "temas.xml", true);
    xmlhttp.send();
}

//Mete los temas del XML a un arreglo para la busqueda y autocompletado
function obtenTemasDisponibles(xml){
    var xmlDoc = xml.responseXML;
    var x = xmlDoc.getElementsByTagName("tema");
    var nuevosTemas = new Array();

    for(var i=0; i<x.length;i++){
        nuevosTemas.push(x[i].getElementsByTagName("nombre")[0].childNodes[0].nodeValue);
    }
    console.log(nuevosTemas);
    autocomplete(document.getElementById("temaNuevo"), nuevosTemas);
}

//Funciones para la busqueda y autocompletado
function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
          /*check if the item starts with the same letters as the text field value:*/
          if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            /*make the matching letters bold:*/
            b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
            b.innerHTML += arr[i].substr(val.length);
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function(e) {
                /*insert the value for the autocomplete text field:*/
                inp.value = this.getElementsByTagName("input")[0].value;
                /*close the list of autocompleted values,
                (or any other open lists of autocompleted values:*/
                closeAllLists();
            });
            a.appendChild(b);
          }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
          /*If the arrow DOWN key is pressed,
          increase the currentFocus variable:*/
          currentFocus++;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 38) { //up
          /*If the arrow UP key is pressed,
          decrease the currentFocus variable:*/
          currentFocus--;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 13) {
          /*If the ENTER key is pressed, prevent the form from being submitted,*/
          e.preventDefault();
          if (currentFocus > -1) {
            /*and simulate a click on the "active" item:*/
            if (x) x[currentFocus].click();
          }
        }
    });
    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }
    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}