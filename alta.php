<?php
$servername = "localhost";
$usuario = "root";
$contrasena = "";
$dbname = "proyectotecweb";

session_start();

$titulo=$_POST['titulo'];
$imagen=$_POST['imagen'];
$texto=$_POST['texto'];
$idTema=$_POST['selectTema'];
$temaNuevo=$_POST['temaNuevo'];

//Si se recibe la el elemento check
if(isset($_POST['check'])){
    $check=$_POST['check'];

    echo $titulo, $imagen, $texto, $idTema, $temaNuevo, $check, $_SESSION['usuario'], $_SESSION['idUsuario']."<br>";

    //Creamos el arbol y leemos el documento
    $doc = new DOMDocument;
    $doc->load('temas.xml');
    $xml = $doc->documentElement;
    $list = $xml->getElementsByTagName('tema');

    //var_dump($xml);
    //Buscamos el nombre del tema nuevo, si se encuentra se borra del arbol
    $band = false;
    foreach ($list as $node) {
        $tema = $node->getElementsByTagName('nombre');
        $img = $node->getElementsByTagName('imagen');

        if($temaNuevo == $tema->item(0)->nodeValue){
            $band = true;
            $nombreTema=$tema->item(0)->nodeValue;
            $rutaImagen=$img->item(0)->nodeValue;
            $xml->removeChild($node);
        }
    }
    /*echo "<br>";
    echo "<br>";
    echo "<br>";

    /*$xml = simplexml_load_file("temas.xml");
    var_dump($xml);
    $band = false;
    foreach ($xml->tema as $nodo) {
        echo "<br>".$nodo->nombre."<br>";
        echo $nodo->imagen."<br>";
        if($temaNuevo == $nodo->nombre){
            $band = true;
            $nombreTema=$nodo->nombre;
            $rutaImagen=$nodo->imagen;
            unset($nodo); //No funciona para eliminar nodo
        }
    }
    var_dump($xml);*/

    //var_dump($xml);
    //Si el tema se encontro se borra del arbol del XML y se guarda el nuevo archivo,
    //de lo contrario se redirecciona para informar del error
    if($band){
        echo $doc->save('temas.xml'); //Se guarda el documento XML con el nodo borrado
        /*echo "<br>".$nombreTema."<br>";
        echo $rutaImagen."<br>";*/

        //Se guarda el nuevo tema en la base de datos
        try {
            $mdb = new PDO("mysql:host=$servername;dbname=$dbname", $usuario, $contrasena);
            // set the PDO error mode to exception
            $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO tema (nTema, fotoTema)
            VALUES ( '".$nombreTema."' , '".$rutaImagen."' )";
            // use exec() because no results are returned
            $mdb->exec($sql);
            $mdb = null;
        }
        catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }

        //Se recupera el ID del tema recien guardado
        try {
            $mdb = new PDO("mysql:host=$servername;dbname=$dbname", $usuario, $contrasena);
            // set the PDO error mode to exception
            $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $mdb->prepare("SELECT idTema FROM tema WHERE nTema='". $nombreTema ."' ");
            $sql->execute();
            // use exec() because no results are returned
            $resultado = $sql->fetch(PDO::FETCH_OBJ);
            $idTema = $resultado->idTema;
            $mdb = null;
        }
        catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }

        //Se guarda el articulo a la base de datos
        try {
            $mdb = new PDO("mysql:host=$servername;dbname=$dbname", $usuario, $contrasena);
            // set the PDO error mode to exception
            $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO articulo (idUsuario, idTema, nArticulo, imagen, contenido)
            VALUES ( '".$_SESSION['idUsuario']."' , '".$idTema."', '".$titulo."', '".$imagen."', '".$texto."' )";
            // use exec() because no results are returned
            $mdb->exec($sql);
            $mdb = null;
        }
        catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
        //echo $idTema;
        header("Location: /php/Proyecto/misarticulos.html");
    }else{
        header("Location: /php/Proyecto/error.html");
    }
    
}else{
    //Se guarda el articulo a la base de datos
    try {
        $mdb = new PDO("mysql:host=$servername;dbname=$dbname", $usuario, $contrasena);
        // set the PDO error mode to exception
        $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO articulo (idUsuario, idTema, nArticulo, imagen, contenido)
        VALUES ( '".$_SESSION['idUsuario']."' , '".$idTema."', '".$titulo."', '".$imagen."', '".$texto."' )";
        // use exec() because no results are returned
        $mdb->exec($sql);
        $mdb = null;
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
    header("Location: /php/Proyecto/misarticulos.html");
}

?>