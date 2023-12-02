<?php
class usuario {
    public $idUsuario;
    public $nombre;
    public $email;
    public $clave;
    public $rol;

    public function crearUsuario() {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta
        ("INSERT INTO usuario (idUsuario,nombre,email,clave,rol) 
        VALUES (:idUsuario,:nombre,:email,:clave,:rol)");
        $usuarios = self::obtenerTodos();
        $consulta->bindValue(':idUsuario', '', PDO::PARAM_INT);
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
        $consulta->bindValue(':rol', $this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':rol', $this->rol, PDO::PARAM_STR);
        $consulta->execute();
    }

    public static function obtenerTodos() {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM usuario");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'usuario');
    }

    public static function obtenerusuario($idUsuario) {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * 
                                                       FROM usuario 
                                                       WHERE idUsuario = :idUsuario");
        $consulta->bindValue(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('usuario');
    }

    public static function modificarusuario($nrousuario, $nombre, $apellido, $clave, $tipoDocumento, $nroDocumento, $email,$tipousuario) {
        // $objAccesoDato = AccesoDatos::obtenerInstancia();

        // $consulta = $objAccesoDato->prepararConsulta("UPDATE usuario
        //                                               SET nombre = '{$nombre}',
        //                                                   apellido = '{$apellido}',
        //                                                   clave = '{$clave}',
        //                                                   tipoDocumento = '{$tipoDocumento}',
        //                                                   nroDocumento = {$nroDocumento},
        //                                                   email = '{$email}',
        //                                                   tipousuario = '{$tipousuario}' 
        //                                                   WHERE nrousuario = {$nrousuario}");
        // $consulta->execute();
    }

    public static function borrarusuario($nrousuario, $tipousuario) {
        // $objAccesoDato = AccesoDatos::obtenerInstancia();
        // $consulta = $objAccesoDato->prepararConsulta("UPDATE usuario 
        //                                               SET activo = 0
        //                                               WHERE nrousuario = {$nrousuario}
        //                                               AND tipousuario = '{$tipousuario}'");
        // $consulta->execute();
    }

    public static function acceso($nombre, $clave){
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT *
                                                       FROM usuario 
                                                       WHERE clave = :clave
                                                       AND nombre = :nombre");
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $clave, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('usuario');
    }
}
