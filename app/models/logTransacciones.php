<?php
class LogTransacciones {
    public $idLogTransaccion;
    public $fecha;
    public $idOperacion;
    public $idUsuario;

    public function crearLogTransacciones() {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta(
        "INSERT INTO logtransacciones(idLogTransaccion ,fecha , idOperacion, idUsuario) 
        VALUES (:idLogTransaccion, :fecha, :idOperacion, :idUsuario)");
        $consulta->bindValue(':idLogTransaccion', '', PDO::PARAM_INT);
        $consulta->bindValue(':fecha', $this->fecha->format('DD/mm/yyyy H:i:s'), PDO::PARAM_STR);
        $consulta->bindValue(':idOperacion', $this->idOperacion, PDO::PARAM_INT);
        $consulta->bindValue(':idUsuario', $this->idUsuario, PDO::PARAM_INT);
        $consulta->execute();
        return $objAccesoDatos->obtenerUltimoId();
    }


    public static function obtenerTodos() {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM logtransacciones");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'LogTransacciones');
    }

    public static function obtenerLogTransacciones($idLogTransacciones, $tipoLogTransacciones) {
    }

    public static function obtenerLogTransaccionesDatos($idLogTransacciones, $tipoLogTransacciones) {
    }

    public static function modificarLogTransacciones() {
    }

    public static function registrarMovimiento($idLogTransacciones, $tipoLogTransacciones, $monto) {
    }

    public static function borrarLogTransacciones($idLogTransacciones, $tipoLogTransacciones) {
    }

    public function toStringCSV(){
        return $this->idLogTransaccion . ","  . $this->fecha . "," . $this->idOperacion . "," . $this->idUsuario . "\n";
    }
}
