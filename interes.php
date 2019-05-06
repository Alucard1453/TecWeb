<?php
    $servername = "localhost";
    $usuario = "root";
    $contrasena = "";
    $dbname = "proyectotecweb";

    header("Content-Type: application/json; charset=UTF-8");
    $arreglo = json_decode($_POST["docJSON"]);

    session_start();
    
    //var_dump($arreglo);
    /*
    foreach($arreglo as $obj){
        $id = $obj->id;
        $valor = $obj->check;
        echo "ID: ".$id."   Valor: ".$valor."\n";
    }
    */

    try {
        $mdb = new PDO("mysql:host=$servername;dbname=$dbname", $usuario, $contrasena);
        // set the PDO error mode to exception
        $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        foreach($arreglo as $obj){
            if($obj->check){
                $sql = "INSERT INTO temainteres(idUsuario,idTema)
                VALUES('".$_SESSION['idUsuario']."','".$obj->id."')";
                // use exec() because no results are returned
                $mdb->exec($sql);
            }
        }
        $mdb = null;
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
    
?>