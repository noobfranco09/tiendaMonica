<?php 
class Mysql
{
    private $ipServidor="localhost";
    private $usuario="root";
    private $baseDeDatos="tiendaMonica";
    private $contraseña="";
    private $conexion;

    public function __construct()
    {
        $this->conexion = new mysqli($this->ipServidor,$this->usuario,
        $this->contraseña,$this->baseDeDatos);

        if($this->conexion->connect_error)
        {
            die("Error en la conexión");
        }
        $this->conexion->set_charset("utf8");
    }
    
    public function consulta($consulta)
    {
        $resultado=$this->conexion->query($consulta);
        if(!$resultado)
        {
            throw new ErrorException("Error en la consulta".$consulta);
        }
    }
}
?>