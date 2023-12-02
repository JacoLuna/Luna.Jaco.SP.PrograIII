<?php 

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;

    class cajeroMiddleware{
        
        public function __invoke(Request $request, RequestHandler $handler): Response{
            
            $data = AutentificadorJWT::ObtenerDataWithHeader($request->getHeaderLine('Authorization'));
            
            if ($data->rol == 'cajero') {
                $response = $handler->handle($request);
            } else {
                $response = new Response();
                $payload = json_encode(array('ERROR' => 'Solo los cajeros pueden ejecutar esta accion'));
                $response->getBody()->write($payload);
            }
    
            return $response->withHeader('Content-Type', 'application/json');
        }
    }
