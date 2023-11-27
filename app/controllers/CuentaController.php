<?php

require_once './models/Cuenta.php';
require_once './interfaces/IApiUsable.php';

class CuentaController extends Cuenta implements IApiUsable {

    public function CargarUno($request, $response, $args) {
        $parametros = $request->getParsedBody();

        $nombre = $parametros['nombre'];
        $apellido = $parametros['apellido'];
        $clave = $parametros['clave'];
        $tipoDocumento = $parametros['tipoDocumento'];
        $nroDocumento  = $parametros['nroDocumento'];
        $email = $parametros['email'];
        $tipoCuenta = $parametros['tipoCuenta'];

        $usr = new Cuenta();
        $usr->nombre = $nombre;
        $usr->apellido = $apellido;
        $usr->clave = $clave;
        $usr->tipoDocumento = $tipoDocumento;
        $usr->nroDocumento = $nroDocumento;
        $usr->email = $email;
        $usr->tipoCuenta = $tipoCuenta;
        if(isset($parametros['saldo'])) $usr->saldo = $parametros['saldo'];
        $usr->crearCuenta();

        $payload = json_encode(array("mensaje" => "Cuenta creada con exito"));

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
    public function logIn($request, $response, $args){
        $parametros = $request->getParsedBody(); 
        $nombre = $parametros['nombre'];
        $contrasenia = $parametros['clave'];
        $cuenta = Cuenta::acceso($nombre, $contrasenia);
        if($cuenta){
            $token = AutentificadorJWT::CrearToken($cuenta->nombre, $cuenta->nroDocumento, $cuenta->rol);
            $payload = json_encode(array('mensaje' => 'se ingresó con exito',
                                         'jwt' => $token));
        }else{
            $payload = json_encode(array('error' => 'Usuario o contraseña incorrectos'));
        }
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
    public function TraerUno($request, $response, $args) {
        $nroCuenta = $args['nroCuenta'];
        $tipoCuenta = $args['tipoCuenta'];
        $cuenta = Cuenta::obtenerCuenta($nroCuenta, $tipoCuenta);
        $payload = json_encode($cuenta);

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
    public function TraerUnoDatos($request, $response, $args) {
        $parametros = $request->getParsedBody();
        $datos = Cuenta::obtenerCuentaDatos($parametros['nroCuenta'], $parametros['tipoCuenta']);
        $payload = json_encode($datos);
        $body = explode(",", $payload);
        $response->getBody()->write($body[7] . " " . $body[8]);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
    private function TraerUnaCuenta($args) {
        $nroCuenta = $args['nroCuenta'];
        $tipoCuenta = $args['tipoCuenta'];
        $cuenta = Cuenta::obtenerCuenta($nroCuenta, $tipoCuenta);
        return $cuenta;
    }

    public function TraerTodos($request, $response, $args) {
        $lista = Cuenta::obtenerTodos();
        $payload = json_encode(array("listaCuenta" => $lista), JSON_PRETTY_PRINT);

        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public function ModificarUno($request, $response, $args) {
        $cuenta = $this->TraerUnaCuenta($args);
        $payload = json_encode(array("ERROR" => "No existe una cuenta que cumpla con los datos ingresados"));
        if($cuenta){
            $parametros = $request->getParsedBody();
        
            $nombre = (isset($parametros['nombre']))?$parametros['nombre']:$cuenta->nombre;
            $apellido = (isset($parametros['apellido']))?$parametros['apellido']:$cuenta->apellido;
            $clave = (isset($parametros['clave']))?$parametros['clave']:$cuenta->clave;
            $tipoDocumento = (isset($parametros['tipoDocumento']))?$parametros['tipoDocumento']:$cuenta->tipoDocumento;
            $nroDocumento = (isset($parametros['nroDocumento']))?$parametros['nroDocumento']:$cuenta->nroDocumento;
            $email = (isset($parametros['email']))?$parametros['email']:$cuenta->email;
            $tipoCuenta = (isset($parametros['tipoCuenta']))?$parametros['tipoCuenta']:$cuenta->tipoCuenta;
            
            Cuenta::modificarCuenta($cuenta->nroCuenta, $nombre, $apellido, $clave, $tipoDocumento, $nroDocumento, $email, $tipoCuenta);
    
            $payload = json_encode(array("mensaje" => "Cuenta modificado con exito"));
        }

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
    public function BorrarUno($request, $response, $args) {
        $exito = false;
        $parametros = $request->getParsedBody();
        $nroCuenta = $args['nroCuenta'];
        $tipoCuenta = $parametros['tipoCuenta'];
        Cuenta::borrarCuenta($nroCuenta, $tipoCuenta);

        $payload = json_encode(array("mensaje" => "Cuenta borrada con exito"));

        $nombreImagen = $nroCuenta . $tipoCuenta;
        
        $exito = rename('img/ImagenesDeCuentas/2023/' . $nombreImagen . '.PNG', 
                        'img/imagenesBackupCuentas/2023/' . $nombreImagen . '.PNG');
        if(!$exito){
            $exito = rename('img/ImagenesDeCuentas/2023/' . $nombreImagen . '.JPG', 
                            'img/imagenesBackupCuentas/2023/' . $nombreImagen . '.JPG');
        }
        if(!$exito){
            rename('img/IImagenesDeCuentas/2023/' . $nombreImagen . '.JPEG', 
                    'img/imagenesBackupCuentas/2023/' . $nombreImagen . '.JPEG');
        }

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
}