<?php

class Ajuste extends Movimiento{
    public $idMovimientoAjustado;
    public $motivo;
    public function crearAjuste() {
        
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta(
        "INSERT INTO Ajuste (idAjuste ,idMovimientoAjustado ,motivo) 
        VALUES (:idAjuste, :idMovimientoAjustado, :motivo)");

        $consulta->bindValue(':idAjuste', '', PDO::PARAM_INT);
        $consulta->bindValue(':idMovimientoAjustado', $this->idMovimientoAjustado, PDO::PARAM_INT);
        $consulta->bindValue(':motivo', $this->motivo, PDO::PARAM_STR);

        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }
}
?>
