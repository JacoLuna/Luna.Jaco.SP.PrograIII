<?php

require_once './models/Ajuste.php';
require_once './interfaces/IApiUsable.php';

class AjusteController extends Ajuste implements IApiUsable {

    public function CargarUno($request, $response, $args) {
        $disponible = true;
        $parametros = $request->getParsedBody();
        $payload = json_encode(array("ERROR" => "No existe una cuenta que cumpla con los datos ingresados"));

        $nroCuenta = $parametros['nroCuenta'];
        $tipoCuenta = $parametros['tipoCuenta'];
        $cuenta = Cuenta::obtenerCuentaDatos($nroCuenta, $tipoCuenta);
        if($cuenta){
            $monto = $parametros['monto'];
            $idMovimientoAjustado = $parametros['idMovimientoAjustado'];
            $motivo = $parametros['motivo'];
    
            $usr = new Ajuste();
            $usr->idMovimientoAjustado = $idMovimientoAjustado;
            $usr->motivo = $motivo;
            $usr->tipoMovimiento = "Ajuste";
            $payload = json_encode(array("mensaje" => "Ajuste hecho"));

            $movimiento = Movimiento::obtenerMovimiento($usr->idMovimientoAjustado);

            $montoAjustado = 0;
            if($movimiento){
                if($movimiento->tipoMovimiento == "Deposito"){
                    $cuenta->saldo += $monto;
                    $montoAjustado = $movimiento->monto + $monto;
                }else{
                    if($cuenta->saldo - $monto >= 0){
                        $cuenta->saldo -= $monto;
                        $montoAjustado = $movimiento->monto + $monto;
                    }else{
                        $disponible = false;
                        $payload = json_encode(array("mensaje" => "El monto a retirar es mayor a los fondo disponibles"));
                    }
                }
                if($disponible){
                    $usr->crearAjuste();
                    Cuenta::registrarMovimiento($nroCuenta, $tipoCuenta, $cuenta->saldo);
                    Movimiento::modificarMovimiento($usr->idMovimientoAjustado, $montoAjustado);
                    $usr->guardarFoto($usr);
                    $idAjuste = Ajuste::obtenerUltimoId();
                    $response = $response->withHeader('idOperacion', $idAjuste->ultimoId);
                }
            }else{
                $payload = json_encode(array("ERROR" => "No existe ese movimiento"));
            }
        }
        $response->getBody()->write($payload);


        return $response
            ->withHeader('Content-Type', 'application/json');
    }
    
    public function TraerUno($request, $response, $args) {
    }
    
    private function TraerUnAjuste($args) {
    }

    public function TraerTodos($request, $response, $args) {
        $lista = Ajuste::obtenerTodos();
        $payload = json_encode(array("listaAjuste" => $lista), JSON_PRETTY_PRINT);

        $response->getBody()->write($payload);


        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public function ModificarUno($request, $response, $args) {
    }

    public function BorrarUno($request, $response, $args) {
    }
}