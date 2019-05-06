<?php
$servername = "localhost";
$usuario = "root";
$contrasena = "";
$dbname = "proyectotecweb";

session_start();

$idarticulo = $_REQUEST["idarticulo"];

try {
    $mdb = new PDO("mysql:host=$servername;dbname=$dbname", $usuario, $contrasena);
    // set the PDO error mode to exception
    $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = $mdb->prepare("SELECT nlike, calificacion FROM articulo WHERE idArticulo='".$idarticulo."'");
    $sql->execute();
    
    $resultado = $sql->fetch(PDO::FETCH_OBJ);
    $nlike=$resultado->nlike;
    $calificacion=$resultado->calificacion;
    
    $nlike++;
    $calificacion+=2;

    $Respuesta = new stdClass();
    $Respuesta->nlike=$nlike;
    $Respuesta->calificacion=$calificacion;
    
    $sql = "UPDATE articulo SET nlike = '".$nlike."', calificacion = '".$calificacion."' WHERE IDarticulo='".$idarticulo."'";
    // use exec() because no results are returned
    //echo $sql;
    $mdb->exec($sql);
    $mdb = null;
}
catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}

$myJSON = json_encode($Respuesta);

echo $myJSON;

?>