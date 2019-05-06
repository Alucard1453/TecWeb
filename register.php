<?php
$servername = "localhost";
$usuario = "root";
$contrasena = "";
$dbname = "proyectotecweb";

$username=$_GET['Usuario'];
$pass=$_GET['Password'];
$edad=$_GET['Edad'];
$genero=$_GET['Genero'];
$ecivil=$_GET['Ecivil'];

session_start();

//Creamos la clase usuario
class Usuario{
    private $nombre;

    public function __construct($nom) {
        $this -> nombre = $nom;
    }

    public function getNombre(){
        return $this -> nombre;
    }
}

try {
    $mdb = new PDO("mysql:host=$servername;dbname=$dbname", $usuario, $contrasena);
    // set the PDO error mode to exception
    $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = $mdb->prepare("SELECT * FROM usuario");
    $sql->execute();
    // use exec() because no results are returned
    $contador=0;
    while($resultado = $sql->fetch(PDO::FETCH_OBJ)){
        $nom = $resultado->nUsuario;
        $Usuarios[$contador] = new Usuario($nom);
        $contador++;
    }
    $mdb = null;
}
catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}


$band = 0;
for($i=0;$i<$contador;$i++){
    if($Usuarios[$i]->getNombre() == $username)
        $band=1;
}

if(!$band){
    $_SESSION['usuario']=$username;
    try {
        $mdb = new PDO("mysql:host=$servername;dbname=$dbname", $usuario, $contrasena);
        // set the PDO error mode to exception
        $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO usuario(nUsuario,password,edad,genero,eCivil)
        VALUES('".$username."','".$pass."','".$edad."','".$genero."','".$ecivil."')";
        // use exec() because no results are returned
        $mdb->exec($sql);
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
    $mdb = null;
}

if(!$band){
    try {
        $mdb = new PDO("mysql:host=$servername;dbname=$dbname", $usuario, $contrasena);
        // set the PDO error mode to exception
        $mdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $mdb->prepare("SELECT idUsuario FROM usuario WHERE nUsuario='".$_SESSION['usuario']."' ");
        $sql->execute();
        // use exec() because no results are returned
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $_SESSION['idUsuario'] = $resultado->idUsuario;
        $mdb = null;
    }
    catch(PDOException $e){
        echo $sql . "<br>" . $e->getMessage();
    }
}

echo $band;

?>