<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AutentificadorJWT {
    private static $clave = 'banco963852741';
    private static $tipoEncriptacion = 'HS256';

    public static function CrearToken($nombre, $rol) {
        $ahora = time();
        $payload = array(
            'iat' => $ahora,
            'exp' => $ahora + (14400000), //4 horas
            'data' => [
                'nombre' => $nombre,
                'rol' => $rol,
            ],
            'app' => "El banco"
        );
        return JWT::encode($payload, self::$clave, self::$tipoEncriptacion);
    }

    public static function VerificarToken($token) {
        if (empty($token)) {
            throw new Exception("El token esta vacio.");
        }
        try {
            $decodificado = JWT::decode(
                $token,
                new Key(self::$clave, self::$tipoEncriptacion)
            );
        } catch (Exception $e) {
            throw $e;
        }
    }


    public static function ObtenerPayLoad($token) {
        if (empty($token)) {
            throw new Exception("El token esta vacio.");
        }
        return JWT::decode(
            $token,
            new Key(self::$clave, self::$tipoEncriptacion)
        );
    }

    public static function ObtenerData($token) {
        return JWT::decode(
            $token,
            new Key(self::$clave, self::$tipoEncriptacion)
        )->data;
    }
    
    static function ObtenerDataWithHeader($header){
        $token = trim(explode("Bearer", $header)[1]);
        $data = self::ObtenerData($token);
        return $data; 
    }
    
}
