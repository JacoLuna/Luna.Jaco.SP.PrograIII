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
        // $usr = $args['nroAjuste'];
        // $ajuste = Ajuste::obtenerAjuste($usr);
        // $payload = json_encode($ajuste);

        // $response->getBody()->write($payload);
        // return $response
        //     ->withHeader('Content-Type', 'application/json');
    }
    
    private function TraerUnAjuste($args) {
        // $usr = $args['nroAjuste'];
        // $ajuste = Ajuste::obtenerAjuste($usr);
        // return $ajuste;
    }

    public function TraerTodos($request, $response, $args) {
        $lista = Ajuste::obtenerTodos();
        $payload = json_encode(array("listaAjuste" => $lista), JSON_PRETTY_PRINT);

        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public function ModificarUno($request, $response, $args) {
        // $ajuste = $this->TraerUnAjuste($args);
        // $parametros = $request->getParsedBody();
        
        // $nombre = (isset($parametros['nombre']))?$parametros['nombre']:$ajuste->nombre;
        // $apellido = (isset($parametros['apellido']))?$parametros['apellido']:$ajuste->apellido;
        // $clave = (isset($parametros['clave']))?$parametros['clave']:$ajuste->clave;
        // $tipoDocumento = (isset($parametros['tipoDocumento']))?$parametros['tipoDocumento']:$ajuste->tipoDocumento;
        // $nroDocumento = (isset($parametros['nroDocumento']))?$parametros['nroDocumento']:$ajuste->nroDocumento;
        // $email = (isset($parametros['email']))?$parametros['email']:$ajuste->email;
        // $tipoAjuste = (isset($parametros['tipoAjuste']))?$parametros['tipoAjuste']:$ajuste->tipoAjuste;
        
        // Ajuste::modificarAjuste($ajuste->nroAjuste, $nombre, $apellido, $clave, $tipoDocumento, $nroDocumento, $email, $tipoAjuste);

        // $payload = json_encode(array("mensaje" => "Ajuste modificado con exito"));

        // $response->getBody()->write($payload);
        // return $response
        //     ->withHeader('Content-Type', 'application/json');
    }

    public function BorrarUno($request, $response, $args) {
    }
}