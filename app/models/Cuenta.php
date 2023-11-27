<?php
class Cuenta {
    public $nroCuenta;
    public $nombre;
    public $apellido;
    public $clave;
    public $tipoDocumento;
    public $nroDocumento;
    public $email;
    public $tipoCuenta; 
    //CA$ de ahorro en pesos o CC$ cuenta corriente pesos
    //CAU$$ de ahorro en dolares o CCU$$ cuenta corriente dolares
    public $saldo = 0;
    private $activo = true;

    public function crearCuenta() {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta
        ("INSERT INTO 
        Cuenta (nroCuenta ,nombre ,apellido ,clave ,tipoDocumento ,nroDocumento ,email ,tipoCuenta, saldo, activo) 
        VALUES (:nroCuenta ,:nombre ,:apellido ,:clave ,:tipoDocumento ,:nroDocumento ,:email ,:tipoCuenta, :saldo, :activo)");
        $cuentas = self::obtenerTodos();
        if(count($cuentas) > 0){
            $consulta->bindValue(':nroCuenta', '', PDO::PARAM_INT);
        }else{
            $consulta->bindValue(':nroCuenta', 100000, PDO::PARAM_INT);
        }
        $consulta->bindValue(':nombre', $this->nombre, PDO::PARAM_STR);
        $consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
        $consulta->bindValue(':tipoDocumento', $this->tipoDocumento, PDO::PARAM_STR);
        $consulta->bindValue(':nroDocumento', $this->nroDocumento, PDO::PARAM_INT);
        $consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
        $consulta->bindValue(':tipoCuenta', $this->tipoCuenta, PDO::PARAM_STR);
        $consulta->bindValue(':saldo', $this->saldo, PDO::PARAM_INT);
        $consulta->bindValue(':activo', $this->activo, PDO::PARAM_BOOL);
        $consulta->execute();
        
        $cuenta = Cuenta::obtenerUltimoId();
        if (!$_FILES["imagen"]["error"]) {
            $partesRuta = explode(".", $_FILES["imagen"]["name"]);
            $extension = end($partesRuta);
            if($extension == "jpg" || $extension == "png" || $extension == "jpeg" ||
               $extension == "JPG" || $extension == "PNG" || $extension == "JPEG"){
                $destino = "img/ImagenesDeCuentas/2023/" . $cuenta->ultimoId . $this->tipoCuenta . '.' . $extension;
                move_uploaded_file($_FILES["imagen"]["tmp_name"], $destino);
            }
        }

        return $objAccesoDatos->obtenerUltimoId();
    }

    public static function obtenerUltimoId(){
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT MAX(nroCuenta) as ultimoId FROM cuenta");
        $consulta->execute();
        return $consulta->fetchObject('Cuenta');
    }

    public static function obtenerTodos() {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM cuenta WHERE activo = 1");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Cuenta');
    }

    public static function obtenerCuenta($nroCuenta, $tipoCuenta) {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * 
                                                       FROM cuenta 
                                                       WHERE nroCuenta = :nroCuenta
                                                       and tipoCuenta = :tipoCuenta");
        $consulta->bindValue(':nroCuenta', $nroCuenta, PDO::PARAM_STR);
        $consulta->bindValue(':tipoCuenta', $tipoCuenta, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('Cuenta');
    }

    public static function obtenerCuentaDatos($nroCuenta, $tipoCuenta) {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT tipoCuenta, saldo 
                                                       FROM cuenta 
                                                       WHERE nroCuenta = :nroCuenta
                                                       and tipoCuenta = :tipoCuenta");
        $consulta->bindValue(':nroCuenta', $nroCuenta, PDO::PARAM_STR);
        $consulta->bindValue(':tipoCuenta', $tipoCuenta, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('Cuenta');
    }

    public static function modificarCuenta($nroCuenta, $nombre, $apellido, $clave, $tipoDocumento, $nroDocumento, $email,$tipoCuenta) {
        $objAccesoDato = AccesoDatos::obtenerInstancia();

        $consulta = $objAccesoDato->prepararConsulta("UPDATE cuenta
                                                      SET nombre = '{$nombre}',
                                                          apellido = '{$apellido}',
                                                          clave = '{$clave}',
                                                          tipoDocumento = '{$tipoDocumento}',
                                                          nroDocumento = {$nroDocumento},
                                                          email = '{$email}',
                                                          tipoCuenta = '{$tipoCuenta}' 
                                                          WHERE nroCuenta = {$nroCuenta}");
        $consulta->execute();
    }

    public static function registrarMovimiento($nroCuenta, $tipoCuenta, $monto) {
        $objAccesoDato = AccesoDatos::obtenerInstancia();

        $consulta = $objAccesoDato->prepararConsulta("UPDATE cuenta
                                                      SET saldo = {$monto}
                                                      WHERE nroCuenta = {$nroCuenta}
                                                      AND tipoCuenta = '{$tipoCuenta}'");
        $consulta->execute();
    }

    public static function borrarCuenta($nroCuenta, $tipoCuenta) {
        $objAccesoDato = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDato->prepararConsulta("UPDATE cuenta 
                                                      SET activo = 0
                                                      WHERE nroCuenta = {$nroCuenta}
                                                      AND tipoCuenta = '{$tipoCuenta}'");
        $consulta->execute();
    }

    public static function acceso($nombre, $clave){
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT *
                                                       FROM cuenta 
                                                       WHERE clave = :clave
                                                       AND nombre = :nombre");
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->bindValue(':clave', $clave, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchObject('Cuenta');
    }
}
