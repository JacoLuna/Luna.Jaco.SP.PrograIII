<?php

class Movimiento {

    public $idMovimiento;
    public $nroCuenta;
    public $monto;
    public $fecha;
    public $tipoMovimiento;

    public function crearMovimiento() {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO 
        Movimiento (idMovimiento ,nroCuenta ,monto ,fecha, tipoMovimiento) 
        VALUES (:idMovimiento ,:nroCuenta ,:monto ,:fecha, :tipoMovimiento)");

        $consulta->bindValue(':idMovimiento', '', PDO::PARAM_INT);
        $consulta->bindValue(':nroCuenta', $this->nroCuenta, PDO::PARAM_INT);
        $consulta->bindValue(':monto', $this->monto, PDO::PARAM_INT);
        $consulta->bindValue(':fecha', $this->fecha, PDO::PARAM_STR);
        $consulta->bindValue(':tipoMovimiento', $this->tipoMovimiento, PDO::PARAM_STR);

        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    protected static function guardarFoto($datos) {
        $movimiento = Movimiento::obtenerUltimoId();
        if (!$_FILES["imagen"]["error"]) {
            $partesRuta = explode(".", $_FILES["imagen"]["name"]);
            $extension = end($partesRuta);
            if ($extension == "jpg" || $extension == "png" || $extension == "jpeg" ||
                $extension == "JPG" || $extension == "PNG" || $extension == "JPEG") {

                switch ($datos->tipoMovimiento) {
                    case "Deposito":
                        $destino = "img/ImagenesDeMovimientos/Depositos/2023/" . $movimiento->ultimoId . $datos->nroCuenta . '.' . $extension;
                        break;
                    case "Retiro":
                        $destino = "img/ImagenesDeMovimientos/Retiros/2023/" . $movimiento->ultimoId . $datos->nroCuenta . '.' . $extension;
                        break;
                    case "Ajuste":
                        $destino = "img/ImagenesDeMovimientos/Ajustes/2023/" . $movimiento->ultimoId . $datos->nroCuenta . '.' . $extension;
                        break;
                }
                move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino);
            }
        }
    }

    public static function obtenerUltimoId() {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT MAX(idMovimiento) as ultimoId FROM movimiento");
        $consulta->execute();
        return $consulta->fetchObject('Movimiento');
    }

    public static function obtenerTodos() {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM movimiento");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Movimiento');
    }

    public static function obtenerTodosDeUnaCuenta($nroCuenta, $tipoMovimiento) {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * 
                                                       FROM movimiento 
                                                       WHERE nroCuenta = {$nroCuenta}
                                                       AND tipoMovimiento = '{$tipoMovimiento}'");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Movimiento');
    }
    
    public static function obtenerTodosDeUnTipoDeCuenta($tipoCuenta, $tipoMovimiento) {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT mov.*, tipoCuenta
                                                       FROM movimiento as mov
                                                       INNER JOIN cuenta as cue
                                                       ON mov.nroCuenta = mov.nroCuenta
                                                       WHERE tipoCuenta = '{$tipoCuenta}'
                                                       AND tipoMovimiento = '{$tipoMovimiento}'");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Movimiento');
    }
    
    public static function obtenerTodosMovsDeUnaCuenta($nroCuenta) {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT mov.*
                                                       FROM movimiento as mov
                                                       INNER JOIN cuenta as cue
                                                       ON mov.nroCuenta = mov.nroCuenta
                                                       WHERE mov.nroCuenta = {$nroCuenta}");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Movimiento');
    }

    public static function obtenerMovimiento($idMovimiento) {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * 
                                                       FROM movimiento 
                                                       WHERE idMovimiento = :idMovimiento");
        $consulta->bindValue(':idMovimiento', $idMovimiento, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('Movimiento');
    }

    public static function obtenerMovimientoDatos($nroMovimiento, $tipoMovimiento) {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT tipoMovimiento, saldo 
                                                       FROM movimiento 
                                                       WHERE nroMovimiento = :nroMovimiento
                                                       and tipoMovimiento = :tipoMovimiento");
        $consulta->bindValue(':nroMovimiento', $nroMovimiento, PDO::PARAM_STR);
        $consulta->bindValue(':tipoMovimiento', $tipoMovimiento, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('Movimiento');
    }

    public static function modificarMovimiento($idMovimiento, $monto) {
        $objAccesoDato = AccesoDatos::obtenerInstancia();

        $consulta = $objAccesoDato->prepararConsulta("UPDATE movimiento
                                                      SET monto = '{$monto}'
                                                      WHERE idMovimiento = {$idMovimiento}");
        $consulta->execute();
    }

    public static function TotalDepositado($tipoCuenta, $tipoMovimiento, $fecha){
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("SELECT SUM(monto) as suma
                                                      FROM movimiento
                                                      WHERE tipoMovimiento = '{$tipoMovimiento}' 
                                                      AND fecha = '{$fecha->format('Y/m/d')}'");
        $consulta->execute();
        return $consulta->fetch();
    }

    public static function obtenerTodosMovsEntreFechas($tipoMovimiento, $fecha1, $fecha2){
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("SELECT nombre, mov.*
                                                      FROM movimiento as mov
                                                      INNER JOIN cuenta as cue
                                                      ON mov.nroCuenta = cue.nroCuenta
                                                      WHERE tipoMovimiento = '{$tipoMovimiento}'
                                                      AND NOT (
                                                          '{$fecha1}'  > fecha
                                                      OR 
                                                          '{$fecha2}' < fecha )  
                                                      ORDER BY nombre ASC");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Movimiento');
    }
    
}
