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
                          FROM tema t INNER JOIN articulo a ON t.idTema=a.idTema INNER JOIN usuario u ON a.idUsuario = u.idUsuario ");
    $sql->execute();
    // use exec() because no results are returned
    $contador=0;
    //$Temas = array();
    $Articulos=null;
    while($resultado = $sql->fetch(PDO::FETCH_OBJ)){
        if($resultado->idTema == $idTema || $idTema == 0){
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
    //Se generara el documento XML
    //Exportamos el XML
    $dom = new DOMDocument();
    $dom->encoding = 'utf-8';
    $dom->xmlVersion = '1.0';
    $dom->formatOutput = true;

    $xml_file_name = 'articulos.xml';
    $root = $dom->createElement('Articulos');
    for($i=0; $i<$contador;$i++){
        $articulo_node = $dom->createElement('articulo');
        $attr_id = new DOMAttr('id', $Articulos[$i]->idArticulo);
        $articulo_node->setAttributeNode($attr_id);
        $attr_idautor = new DOMAttr('idautor', $_SESSION['idUsuario']);
        $articulo_node->setAttributeNode($attr_idautor);
        $attr_likes = new DOMAttr('likes', $Articulos[$i]->nlike);
        $articulo_node->setAttributeNode($attr_likes);
        $attr_dislikes = new DOMAttr('dislikes', $Articulos[$i]->dislike);
        $articulo_node->setAttributeNode($attr_dislikes);
        $attr_notinterested = new DOMAttr('notinterested', $Articulos[$i]->interested);
        $articulo_node->setAttributeNode($attr_notinterested);
        $attr_valoracion = new DOMAttr('valoracion', $Articulos[$i]->calificacion);
        $articulo_node->setAttributeNode($attr_valoracion);
        
        $child_node_tema = $dom->createElement('tema', $Articulos[$i]->nTema);
        $attr_idTema = new DOMAttr('idTema', $Articulos[$i]->idTema);
        $child_node_tema->setAttributeNode($attr_idTema);
        $articulo_node->appendChild($child_node_tema);
        
        $child_node_titulo = $dom->createElement('titulo', $Articulos[$i]->nArticulo);
        $articulo_node->appendChild($child_node_titulo);
        
        $child_node_img = $dom->createElement('imagen', $Articulos[$i]->imagen);
        $articulo_node->appendChild($child_node_img);
        
        $child_node_contenido = $dom->createElement('contenido', $Articulos[$i]->contenido);
        $articulo_node->appendChild($child_node_contenido);
        
        $child_node_autor = $dom->createElement('autor', $Articulos[$i]->nUsuario);
        $articulo_node->appendChild($child_node_autor);

        $root->appendChild($articulo_node);
        $dom->appendChild($root);
    }
    $dom->save($xml_file_name);
} else {
    //Se generara el documento XML
    //Exportamos el XML
    $dom = new DOMDocument();
    $dom->encoding = 'utf-8';
    $dom->xmlVersion = '1.0';
    $dom->formatOutput = true;

    $xml_file_name = 'articulos.xml';
    $root = $dom->createElement('Articulos');
    $dom->appendChild($root);
    $dom->save($xml_file_name);
}
    
?>