<?php

$servername = "localhost";
$usuario = "root";
$contrasena = "";
$dbname = "proyectotecweb";

try {
    $mdb = new PDO("mysql:host=$servername;dbname=$dbname", $usuario, $contrasena);
    // set the PDO error mode to exception
    $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $mdb->prepare("SELECT * FROM tema");
    $sql->execute();
    // use exec() because no results are returned
    $contador=0;
    //$Temas = array();
    while($resultado = $sql->fetch(PDO::FETCH_OBJ)){
        $Temas[$contador] = new stdClass();
        $Temas[$contador]->id=$resultado->idTema;
        $Temas[$contador]->nombre=$resultado->nTema;
        $Temas[$contador]->imagen=$resultado->fotoTema;
        $contador++;
    }
    $mdb = null;
}
catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}

$myJSON = json_encode($Temas);

echo $myJSON;
    
?>