<?php
class Log {
    public $idLog;
    public $descripcion;
    public $rol;

    public function crearLog() {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();

        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO log(idLog ,descripcion, rol) 
        VALUES (:idLog, :descripcion, :rol)");
        $consulta->bindValue(':idLog', '', PDO::PARAM_INT);
        $consulta->bindValue(':descripcion', $this->descripcion, PDO::PARAM_STR);
        $consulta->bindValue(':rol', $this->rol, PDO::PARAM_STR);
        $consulta->execute();
        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function obtenerTodos() {
    }

    public static function obtenerLog($idLog, $tipoLog) {
    }

    public static function obtenerLogDatos($idLog, $tipoLog) {
    }

    public static function modificarLog() {
    }

    public static function registrarMovimiento($idLog, $tipoLog, $monto) {
    }

    public static function borrarLog($idLog, $tipoLog) {
    }
}
