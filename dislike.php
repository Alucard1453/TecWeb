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
    
    $sql = $mdb->prepare("SELECT dislike, calificacion FROM articulo WHERE idArticulo='".$idarticulo."'");
    $sql->execute();
    
    $resultado = $sql->fetch(PDO::FETCH_OBJ);
    $dislike=$resultado->dislike;
    $calificacion=$resultado->calificacion;
    
    $dislike++;
    $calificacion-=2;

    $Respuesta = new stdClass();
    $Respuesta->dislike=$dislike;
    $Respuesta->calificacion=$calificacion;
    
    $sql = "UPDATE articulo SET dislike = '".$dislike."', calificacion = '".$calificacion."' WHERE IDarticulo='".$idarticulo."'";
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