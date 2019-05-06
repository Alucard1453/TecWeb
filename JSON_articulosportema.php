<?php

$servername = "localhost";
$usuario = "root";
$contrasena = "";
$dbname = "proyectotecweb";

session_start();

$idTema = $_REQUEST["idTema"];

try {
    $mdb = new PDO("mysql:host=$servername;dbname=$dbname", $usuario, $contrasena);
    // set the PDO error mode to exception
    $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $mdb->prepare("SELECT t.idTema, nTema, idArticulo, nArticulo, imagen, contenido, nlike, dislike, interested, calificacion, nUsuario 
                          FROM tema t INNER JOIN articulo a ON t.idTema=a.idTema INNER JOIN usuario u ON a.idUsuario = u.idUsuario
                          WHERE t.idTema='". $idTema ."' ");
    $sql->execute();
    // use exec() because no results are returned
    $contador=0;
    //$Temas = array();
    $Articulos=null;
    while($resultado = $sql->fetch(PDO::FETCH_OBJ)){
        $Articulos[$contador] = new stdClass();
        $Articulos[$contador]->idTema=$resultado->idTema;
        $Articulos[$contador]->nTema=$resultado->nTema;
        $Articulos[$contador]->idArticulo=$resultado->idArticulo;
        $Articulos[$contador]->nArticulo=$resultado->nArticulo;
        $Articulos[$contador]->imagen=$resultado->imagen;
        $Articulos[$contador]->contenido=$resultado->contenido;
        $Articulos[$contador]->nlike=$resultado->nlike;
        $Articulos[$contador]->dislike=$resultado->dislike;
        $Articulos[$contador]->interested=$resultado->interested;
        $Articulos[$contador]->calificacion=$resultado->calificacion;
        $Articulos[$contador]->nUsuario=$resultado->nUsuario;
        $contador++;
    }
    $mdb = null;
}
catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}

//Si se encontraron articulos vamos a ordenarlos por orden de calificacion
if($Articulos){
    for($i=1;$i<count($Articulos);$i++){
        for($j=0;$j<count($Articulos)-$i;$j++){
            if($Articulos[$j]->calificacion < $Articulos[$j+1]->calificacion){
                $Aux=$Articulos[$j+1];
                $Articulos[$j+1]=$Articulos[$j];
                $Articulos[$j]=$Aux;
            }
        }
    }
}

$myJSON = json_encode($Articulos);

echo $myJSON;
    
?>