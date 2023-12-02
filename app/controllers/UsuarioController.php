<?php

require_once './models/Usuario.php';
require_once './interfaces/IApiUsable.php';

class UsuarioController extends Usuario implements IApiUsable {

    public function CargarUno($request, $response, $args) {
        $parametros = $request->getParsedBody();

        $nombre = $parametros['nombre'];
        $email = $parametros['email'];
        $clave = $parametros['clave'];
        $rol = $parametros['rol'];

        $usr = new Usuario();
        $usr->nombre = $nombre;
        $usr->clave = $clave;
        $usr->email = $email;
        $usr->rol = $rol;
        $usr->crearUsuario();

        $payload = json_encode(array("mensaje" => "Usuario creada con exito"));

        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    public function logIn($request, $response, $args){
        $parametros = $request->getParsedBody(); 
        $nombre = $parametros['nombre'];
        $contrasenia = $parametros['clave'];
        $usuario = Usuario::acceso($nombre, $contrasenia);
        if($usuario){
            $token = AutentificadorJWT::CrearToken($usuario->nombre, $usuario->rol);
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
    }
    public function TraerUnoDatos($request, $response, $args) {
    }
    private function TraerUnaUsuario($args) {
    }

    public function TraerTodos($request, $response, $args) {
    }

    public function ModificarUno($request, $response, $args) {
    }
    public function BorrarUno($request, $response, $args) {
    }
}