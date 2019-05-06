<?php
$servername = "localhost";
$usuario = "root";
$contrasena = "";
$dbname = "proyectotecweb";

session_start();

//Primero seleccionamos los temas de interes del usuario
try {
    $mdb = new PDO("mysql:host=$servername;dbname=$dbname", $usuario, $contrasena);
    // set the PDO error mode to exception
    $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $mdb->prepare("SELECT idTema FROM temainteres t WHERE t.idUsuario='". $_SESSION['idUsuario'] ."' ");
    $sql->execute();
    // use exec() because no results are returned
    $contador=0;
    //$Temas = array();
    $TemasInteres=null;
    while($resultado = $sql->fetch(PDO::FETCH_OBJ)){
        $TemasInteres[$contador]=$resultado->idTema;
        $contador++;
    }
    $mdb = null;
}
catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}

/*foreach($TemasInteres as $contenido){
    echo $contenido;
}*/

//Si el usuario si tiene guardados temas de interes
if($TemasInteres){
    //Seleccionamos los articulos que son de su interes
    $contador=0;
    $ArticulosInteres=null;
    for($i=0 ; $i< count($TemasInteres) ; $i++){
        try {
            $mdb = new PDO("mysql:host=$servername;dbname=$dbname", $usuario, $contrasena);
            // set the PDO error mode to exception
            $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $mdb->prepare("SELECT t.idTema, nTema, idArticulo, nArticulo, imagen, contenido, nlike, dislike, interested, calificacion, nUsuario 
            FROM tema t INNER JOIN articulo a ON t.idTema=a.idTema INNER JOIN usuario u ON a.idUsuario = u.idUsuario
            WHERE t.idTema='". $TemasInteres[$i] ."' ");
            $sql->execute();
            // use exec() because no results are returned
            while($resultado = $sql->fetch(PDO::FETCH_OBJ)){
                $ArticulosInteres[$contador] = new stdClass();
                $ArticulosInteres[$contador]->idTema=$resultado->idTema;
                $ArticulosInteres[$contador]->nTema=$resultado->nTema;
                $ArticulosInteres[$contador]->idArticulo=$resultado->idArticulo;
                $ArticulosInteres[$contador]->nArticulo=$resultado->nArticulo;
                $ArticulosInteres[$contador]->imagen=$resultado->imagen;
                $ArticulosInteres[$contador]->contenido=$resultado->contenido;
                $ArticulosInteres[$contador]->nlike=$resultado->nlike;
                $ArticulosInteres[$contador]->dislike=$resultado->dislike;
                $ArticulosInteres[$contador]->interested=$resultado->interested;
                $ArticulosInteres[$contador]->calificacion=$resultado->calificacion;
                $ArticulosInteres[$contador]->nUsuario=$resultado->nUsuario;
                $contador++;
            }
            $mdb = null;
        }
        catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    //Si se encontraron articulos de interes vamos a ordenarlos por orden de calificacion
    if($ArticulosInteres){
        for($i=1;$i<count($ArticulosInteres);$i++){
            for($j=0;$j<count($ArticulosInteres)-$i;$j++){
                if($ArticulosInteres[$j]->calificacion < $ArticulosInteres[$j+1]->calificacion){
                    $Aux=$ArticulosInteres[$j+1];
                    $ArticulosInteres[$j+1]=$ArticulosInteres[$j];
                    $ArticulosInteres[$j]=$Aux;
                }
            }
        }
    }

    //Se devuelve la lista de los articulos de interes
    $myJSON = json_encode($ArticulosInteres);

    echo $myJSON;
    
} else{
    //Si no hay articulos de interes obtendremos los mas valorados por tema
    //Obtenemos todos los id de los temas
    try {
        $mdb = new PDO("mysql:host=$servername;dbname=$dbname", $usuario, $contrasena);
        // set the PDO error mode to exception
        $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $mdb->prepare("SELECT idTema FROM tema");
        $sql->execute();
        // use exec() because no results are returned
        $contador=0;
        //$Temas = array();
        $Temas=null;
        while($resultado = $sql->fetch(PDO::FETCH_OBJ)){
            $Temas[$contador]=$resultado->idTema;
            $contador++;
        }
        $mdb = null;
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }

    //Vamos a obtener todos los articulos por cada tema
    $contador=0;
    $ArticulosInteres=null;
    for($cont=0 ; $cont < count($Temas) ; $cont++){
        $artTmp=null;
        $indice=0;
        try {
            $mdb = new PDO("mysql:host=$servername;dbname=$dbname", $usuario, $contrasena);
            // set the PDO error mode to exception
            $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $mdb->prepare("SELECT t.idTema, nTema, idArticulo, nArticulo, imagen, contenido, nlike, dislike, interested, calificacion, nUsuario 
            FROM tema t INNER JOIN articulo a ON t.idTema=a.idTema INNER JOIN usuario u ON a.idUsuario = u.idUsuario
            WHERE t.idTema='". $Temas[$cont] ."' ");
            $sql->execute();
            // use exec() because no results are returned
            while($resultado = $sql->fetch(PDO::FETCH_OBJ)){
                $artTmp[$indice] = new stdClass();
                $artTmp[$indice]->idTema=$resultado->idTema;
                $artTmp[$indice]->nTema=$resultado->nTema;
                $artTmp[$indice]->idArticulo=$resultado->idArticulo;
                $artTmp[$indice]->nArticulo=$resultado->nArticulo;
                $artTmp[$indice]->imagen=$resultado->imagen;
                $artTmp[$indice]->contenido=$resultado->contenido;
                $artTmp[$indice]->nlike=$resultado->nlike;
                $artTmp[$indice]->dislike=$resultado->dislike;
                $artTmp[$indice]->interested=$resultado->interested;
                $artTmp[$indice]->calificacion=$resultado->calificacion;
                $artTmp[$indice]->nUsuario=$resultado->nUsuario;
                $indice++;
            }
            $mdb = null;
        }
        catch(PDOException $e){
            echo $sql . "<br>" . $e->getMessage();
        }
        
        //Ordenamos de mayor a menor
        if($artTmp){
            for($i=1;$i<count($artTmp);$i++){
                for($j=0;$j<count($artTmp)-$i;$j++){
                    if($artTmp[$j]->calificacion < $artTmp[$j+1]->calificacion){
                        $Aux=$artTmp[$j+1];
                        $artTmp[$j+1]=$artTmp[$j];
                        $artTmp[$j]=$Aux;
                    }
                }
            }
        }

        //Ya ordenados solamente tomamos el que tenga mayor valoracion
        if($artTmp){
            $ArticulosInteres[$contador]=$artTmp[0];
            $contador++;
        }
    }

    //Ordenamos los articulos de mayor interes de mayor a menor
    if($ArticulosInteres){
        for($i=1;$i<count($ArticulosInteres);$i++){
            for($j=0;$j<count($ArticulosInteres)-$i;$j++){
                if($ArticulosInteres[$j]->calificacion < $ArticulosInteres[$j+1]->calificacion){
                    $Aux=$ArticulosInteres[$j+1];
                    $ArticulosInteres[$j+1]=$ArticulosInteres[$j];
                    $ArticulosInteres[$j]=$Aux;
                }
            }
        }
    }
    

    //Se devuelve la lista de los articulos de interes
    $myJSON = json_encode($ArticulosInteres);

    echo $myJSON;
}
    
?>