<?php
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/../vendor/autoload.php';

require_once './db/AccesoDatos.php';
require_once './middlewares/AuthMiddleware.php';
require_once './controllers/CuentaController.php';
require_once './controllers/MovimientoController.php';
require_once './controllers/AjusteController.php';
require_once './utilities/AutentificadorJWT.php';
require_once './utilities/Utilities.php';

$app = AppFactory::create();

$app->addErrorMiddleware(true, true, true);
$app->addBodyParsingMiddleware();

$app->get('/', function ($request,  $response) {
  $response->getBody()->write("----------\n|Api HOME|\n ----------");
  return $response;
});

$app->group('/auth', function (RouteCollectorProxy $group) {
  $group->post('/logIn', \CuentaController::class . ':logIn');
});

$app->group('/cuentas', function (RouteCollectorProxy $group) {
  $group->get('[/]', \CuentaController::class . ':TraerTodos');
  $group->get('/{nroCuenta}/{tipoCuenta}', \CuentaController::class . ':TraerUno');
  $group->post('/datos', \CuentaController::class . ':TraerUnoDatos');
  $group->post('[/]', \CuentaController::class . ':CargarUno');
  $group->put('/{nroCuenta}', \CuentaController::class . ':ModificarUno');
  $group->delete('/{nroCuenta}', \CuentaController::class . ':BorrarUno');
});
// })->add(new AuthMiddleware);

$app->group('/Movimientos', function (RouteCollectorProxy $group) {
  $group->get('[/]', \MovimientoController::class . ':TraerTodos');
  $group->get('/Deposito', \MovimientoController::class . ':TraerDepositos');
  $group->get('/Retiro', \MovimientoController::class . ':TraerRetiros');
  $group->post('/Deposito', \MovimientoController::class . ':CargarUno');
  $group->post('/Retiro', \MovimientoController::class . ':CargarUno');
  $group->post('/Ajuste', \AjusteController::class . ':CargarUno');
});


$app->group('/Consultas', function (RouteCollectorProxy $group) {
  $group->get('/totalMovimiento', \MovimientoController::class . ':totalMovimiento');
  $group->get('/movimientosCuenta', \MovimientoController::class . ':movimientosCuenta');
  $group->get('/movimientosEntreFechas', \MovimientoController::class . ':movimientosEntreFechas');
  $group->get('/movimientosPorTipoCuenta', \MovimientoController::class . ':movimientosPorTipoCuenta');
  $group->get('/movimientosPorCuenta', \MovimientoController::class . ':movimientosPorCuenta');
});

$app->run();
