<?php

require_once './models/Movimiento.php';
require_once './interfaces/IApiUsable.php';

class MovimientoController extends Movimiento implements IApiUsable {

    public function CargarUno($request, $response, $args) {
        $disponible = true;
        $parametros = $request->getParsedBody();
        $payload = json_encode(array("ERROR" => "No existe una cuenta que cumpla con los datos ingresados"));

        $nroCuenta = $parametros['nroCuenta'];
        $tipoCuenta = $parametros['tipoCuenta'];
        $cuenta = Cuenta::obtenerCuentaDatos($nroCuenta, $tipoCuenta);
        $url = $request->getUri()->getPath();
        if($cuenta){
            $monto = $parametros['monto'];
            $fecha = $parametros['fecha'];
    
            $usr = new Movimiento();
            $usr->nroCuenta = $nroCuenta;
            $usr->monto = $monto;
            $usr->fecha = $fecha;
            $usr->tipoMovimiento = substr($url,13);
            $payload = json_encode(array("mensaje" => "Movimiento hecho"));

            switch ($usr->tipoMovimiento) {
                case "Deposito":
                    $cuenta->saldo += $monto;
                    break;
                case "Retiro":
                    if($cuenta->saldo - $monto >= 0){
                        $cuenta->saldo -= $monto;
                    }else{
                        $disponible = false;
                        $payload = json_encode(array("mensaje" => "El monto a retirar es mayor a los fondo disponibles"));
                    }
                    break;
            }
            if($disponible){
                $usr->crearMovimiento();
                Cuenta::registrarMovimiento($nroCuenta, $tipoCuenta, $cuenta->saldo);
                $usr->guardarFoto($usr);
            }
        }

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
    
    public function TraerUno($request, $response, $args) {
        $usr = $args['nroMovimiento'];
        $movimiento = Movimiento::obtenerMovimiento($usr);
        $payload = json_encode($movimiento);

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
    
    private function TraerUnMovimiento($args) {
        $usr = $args['nroMovimiento'];
        $movimiento = Movimiento::obtenerMovimiento($usr);
        return $movimiento;
    }

    public function TraerTodos($request, $response, $args) {
        $lista = Movimiento::obtenerTodos();
        $payload = json_encode(array("listaMovimiento" => $lista), JSON_PRETTY_PRINT);

        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public function ModificarUno($request, $response, $args) {
    }

    public function BorrarUno($request, $response, $args) {
    }

    public function totalMovimiento($request, $response, $args){
        
        $parametros = $request->getQueryParams();
        
        $tipoCuenta = $parametros['tipoCuenta'];
        
        $tipoMovimiento = $parametros['tipoMovimiento'];
        $fecha = new DateTime('yesterday');

        if(isset($parametros['fecha'])){
            $fecha = new DateTime($parametros['fecha']);
        }
        $resultado = Movimiento::TotalDepositado($tipoCuenta, $tipoMovimiento, $fecha);
        $body = explode('"', json_encode($resultado));
        $payload = json_encode(array("mensaje" => " Fecha: " . $fecha->format('y-m-d') . 
                                                  " movimiento: " . $tipoMovimiento . 
                                                  " cuentas: " . $tipoCuenta . 
                                                  " monto: " . $body[3]), JSON_PRETTY_PRINT);
        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public function movimientosCuenta($request, $response, $args){
        $parametros = $request->getQueryParams();
        
        $nroCuenta = $parametros['nroCuenta'];
        $tipoMovimiento = $parametros['tipoMovimiento'];

        $movimientos = Movimiento::obtenerTodosDeUnaCuenta($nroCuenta, $tipoMovimiento);
        $payload = json_encode(array("movimientos" => $movimientos));
        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public function movimientosPorTipoCuenta($request, $response, $args){
        $parametros = $request->getQueryParams();
        
        $tipoCuenta = $parametros['tipoCuenta'];
        $tipoMovimiento = $parametros['tipoMovimiento'];

        $movimientos = Movimiento::obtenerTodosDeUnTipoDeCuenta($tipoCuenta, $tipoMovimiento);
        $payload = json_encode(array("movimientos" => $movimientos));
        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public function movimientosPorCuenta($request, $response, $args){
        $parametros = $request->getQueryParams();
        $nroCuenta = $parametros['nroCuenta'];
        $movimientos = Movimiento::obtenerTodosMovsDeUnaCuenta($nroCuenta);
        $payload = json_encode(array("movimientos" => $movimientos));
        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json');
    }
    public function movimientosEntreFechas($request, $response, $args){
        $parametros = $request->getQueryParams();
        $tipoMovimiento = $parametros['tipoMovimiento'];
        $fecha1 = $parametros['fecha1'];
        $fecha2 = $parametros['fecha2'];
        $movimientos = Movimiento::obtenerTodosMovsEntreFechas($tipoMovimiento, $fecha1, $fecha2);
        $payload = json_encode(array("movimientos" => $movimientos));
        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json');
    }
    
    
}