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
            die("Error en la conexión: " . $this->conexion->connect_error);
        }

        $this->conexion->set_charset("utf8");
    }

    // =============================
    // MÉTODO GENERAL: CONSULTAS PREPARADAS
    // =============================
    public function consultaPreparada($sql, $tipos = "", $params = [])
    {
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
        }

        if (!empty($params)) {
            $stmt->bind_param($tipos, ...$params);
        }

        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado instanceof mysqli_result) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }

        return true; // para INSERT, UPDATE, DELETE
    }

    // =============================
    //  INSERTAR Y OBTENER ID
 // =============================
 //Pa poder hacer el rollback, sin esto no funcionaría bien
    public function insertarYObtenerId($sql, $tipos = "", $params = [])
    {
        $stmt = $this->conexion->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $this->conexion->error);
        }

        if (!empty($params)) {
            $stmt->bind_param($tipos, ...$params);
        }

        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }

        return $this->conexion->insert_id; // Devuelve el ID autoincremental
    }

    // =============================
    // NUEVO: TRANSACCIONES
    // =============================
    //rollback pa revertirlo si la cagamos
    //pa usar rollback debemos insertar con la función insertarYObtenerId, sino nos dará 
    public function iniciarTransaccion()
    {
        $this->conexion->begin_transaction();
    }

    public function confirmarTransaccion()
    {
        $this->conexion->commit();
    }

    public function revertirTransaccion()
    {
        $this->conexion->rollback();
    }

    // =============================
    // CERRAR CONEXIÓN
    // =============================
    public function cerrarConexion()
    {
        if ($this->conexion) {
            $this->conexion->close();
        }
    }
}
?>  