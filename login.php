<?php
$servername = "localhost";
$usuario = "root";
$contrasena = "";
$dbname = "proyectotecweb";

$username=$_GET['Usuario'];
$pass=$_GET['Password'];

session_start();

//Creamos la clase usuario
class Usuario{
    private $nombre;
    private $contra;
    
    public function __construct($nom, $cont) {
        $this -> nombre = $nom;
        $this -> contra = $cont;
    }

    public function getNombre(){
        return $this -> nombre;
    }

    public function getPass(){
        return $this -> contra;
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
        $cont = $resultado->password;
        $Usuarios[$contador] = new Usuario($nom,$cont);
        $contador++;
    }
    $mdb = null;
}
catch(PDOException $e){
    echo $sql . "<br>" . $e->getMessage();
}

$band = 0;
for($i=0;$i<$contador;$i++){
    if($Usuarios[$i]->getNombre() == $username && $Usuarios[$i]->getPass() == $pass){
        $_SESSION['usuario']=$Usuarios[$i]->getNombre();
        $band=1;
    }
}

if($band){
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