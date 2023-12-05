<?php

require_once './models/LogTransacciones.php';
require_once './interfaces/IApiUsable.php';

class LogTransaccionesController extends LogTransacciones implements IApiUsable {

    public function CargarUno($request, $response, $args) {
    }
    public function TraerUno($request, $response, $args) {
    }
    public function TraerUnoDatos($request, $response, $args) {
    }
    private function TraerUnaLogTransacciones($args) {
    }
    public function TraerTodos($request, $response, $args) {
    }

    public function ModificarUno($request, $response, $args) {
    }
    public function BorrarUno($request, $response, $args) {
    }
    public function descargarArchivoCsv($request, $response, $args) {
        $data = $this->castLogTransaccionessToCSV();
        
        if($data !== null) {
            $response = $response
            ->withHeader('Content-Description', 'File Transfer')
            ->withHeader('Content-Type', 'text/csv')
            ->withHeader('Content-Disposition', 'attachment;filename=logTransacciones.csv')
            ->withHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
            ->withHeader('Expires', '0')
            ->withHeader('Cache-Control', 'post-check=0, pre-check=0')
            ->withHeader('Pragma', 'no-cache');
            
            $response->getBody()->write($data);
            return $response;
        }
        else {
            $payload = json_encode(array("error" => "Error al descargar el archivo"));
            $response->getBody()->write($payload);
        }
    
        return $response;
    } 
    private static function castLogTransaccionessToCSV() {
        $logTransaccioness = LogTransacciones::obtenerTodos();
        foreach($logTransaccioness as $index => $logTransacciones) {
            if($index == 0) $data = "idLogTransaccion,fecha,idOperacion,idUsuario\n";
            $data .= $logTransacciones->toStringCSV();
        }
        return $data;
    }
    // private function guardarArchivoSCV($rutaArchivo, $datos = array()) {
    //     $rows = "";
    //     if (!$archivo = fopen($rutaArchivo, "w")) {
    //         $archivo = fopen($rutaArchivo, "x+");
    //     }
    //     foreach($datos as $index=>$dato){
    //         if($index == count($datos) -1){
    //             $rows .= $dato;
    //         }else{
    //             $rows .= $dato . "\n";
    //         }
    //     }
    //     fwrite($archivo, $rows);
    //     fclose($archivo);
    // }
}