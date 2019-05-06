<?php
$servername = "localhost";
$usuario = "root";
$contrasena = "";
$dbname = "proyectotecweb";

session_start();

$titulo=$_POST['titulo_edicion'];
$imagen=$_POST['imagen_edicion'];
$texto=$_POST['texto_edicion'];
$idTema=$_POST['listado_edicion'];
$idArticulo=$_POST['idArticulo'];

echo $titulo, $imagen,$texto ,$idTema,$idArticulo;


//Se guarda la actualizacion del articulo a la base de datos
try {
    $mdb = new PDO("mysql:host=$servername;dbname=$dbname", $usuario, $contrasena);
    // set the PDO error mode to exception
    $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE articulo SET idTema = '".$idTema."', nArticulo = '".$titulo."', imagen = '".$imagen."', 
            contenido = '".$texto."' WHERE idArticulo= '".$idArticulo."' ";
    // use exec() because no results are returned
    $mdb->exec($sql);
    $mdb = null;
}
catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}
header("Location: /php/Proyecto/misarticulos.html");
?>