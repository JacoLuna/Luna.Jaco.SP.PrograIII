<?php 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

    class logMiddleware{
        
        public function __invoke(Request $request, RequestHandler $handler){
        }

        public function registrarAccion(Request $request, RequestHandler $handler){
            $response = $handler->handle($request);
            $payload = json_encode(array('mensaje' => 'accion registrada'));
            $response->getBody()->write($payload);

            $data = AutentificadorJWT::ObtenerDataWithHeader($request->getHeaderLine('Authorization'));
            $log = new Log();
            $log->rol = $data->rol;
            $log->descripcion = $request->getUri();
            $log->crearLog();

            return $response->withHeader('Content-Type', 'application/json');
        }

        public function registrarTransaccion(Request $request, RequestHandler $handler){
            $response = $handler->handle($request);
            $payload = json_encode(array('mensaje' => 'Transaccion registrada'));
            $response->getBody()->write($payload);

            $data = AutentificadorJWT::ObtenerDataWithHeader($request->getHeaderLine('Authorization'));
            $log = new LogTransacciones();
            $log->idUsuario = $data->nombre;
            $log->fecha = new DateTime();
            $log->idOperacion = $response->getHeader('idOperacion')[0];
            $log->crearLogTransacciones();
            
            return $response->withHeader('Content-Type', 'application/json');;
        }
        
    }
