<?php
class Mysql
{
    private $ipServidor = "localhost";
    private $usuario = "root";
    private $baseDeDatos = "tiendaMonica";
    private $contraseña = "";
    private $conexion;

    public function __construct()
    {
        $this->conexion = new mysqli(
            $this->ipServidor,
            $this->usuario,
            $this->contraseña,
            $this->baseDeDatos
        );

        if ($this->conexion->connect_error) {
            die("Error en la conexión");
        }
        $this->conexion->set_charset("utf8");
    }

    /*     public function consulta($consulta)
        {
            $resultado = $this->conexion->query($consulta);
            if (!$resultado) {
                throw new ErrorException("Error en la consulta" . $consulta);
            }
            if ($resultado instanceof mysqli_result) {
                return $resultado->fetch_all(MYSQL_ASSOC);
            } else {
                return true;
            }

        } */

    public function consultaPreparada($sql, $tipos="", $params=[])
    {
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
        }
        if (!empty($params)) {
            // Unión dinámica de parámetros
            $stmt->bind_param($tipos, ...$params);
        }
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado instanceof mysqli_result) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }

        return true;
    }

    public function cerrarConexion()
    {
        if ($this->conexion) {
            $this->conexion->close();
        }
    }
}
?>