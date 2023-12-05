<?php
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require __DIR__ . '/../vendor/autoload.php';

require_once './db/AccesoDatos.php';
require_once './middlewares/AuthMiddleware.php';
require_once './middlewares/cajeroMiddleware.php';
require_once './middlewares/operadorMiddleware.php';
require_once './middlewares/supervisorMiddleware.php';
require_once './middlewares/logMiddleware.php';
require_once './controllers/CuentaController.php';
require_once './controllers/UsuarioController.php';
require_once './controllers/MovimientoController.php';
require_once './controllers/AjusteController.php';
require_once './controllers/LogTransaccionesController.php';
require_once './utilities/AutentificadorJWT.php';
require_once './utilities/Utilities.php';
require_once './models/Log.php';
require_once './models/logTransacciones.php';

define('TIMEZONE', 'America/Argentina/Buenos_Aires');
date_default_timezone_set(TIMEZONE);

$app = AppFactory::create();

$app->addErrorMiddleware(true, true, true);
$app->addBodyParsingMiddleware();

$app->get('/', function ($request,  $response) {
  $response->getBody()->write("----------\n|Api HOME|\n ----------");
  return $response;
});

$app->group('/auth', function (RouteCollectorProxy $group) {
  $group->post('/logIn', \UsuarioController::class . ':logIn');
});

$app->group('/cuentas', function (RouteCollectorProxy $group) {
  $group->get('[/]', \CuentaController::class . ':TraerTodos')
  ->add(\logMiddleware::class . ':registrarAccion');
  $group->get('/{nroCuenta}/{tipoCuenta}', \CuentaController::class . ':TraerUno')
  ->add(\logMiddleware::class . ':registrarAccion');
  $group->post('/datos', \CuentaController::class . ':TraerUnoDatos')
  ->add(\logMiddleware::class . ':registrarAccion');
  $group->post('[/]', \CuentaController::class . ':CargarUno')
  ->add(\logMiddleware::class . ':registrarAccion');
  $group->put('/{nroCuenta}/{tipoCuenta}', \CuentaController::class . ':ModificarUno')
  ->add(\logMiddleware::class . ':registrarAccion');
  $group->delete('/{nroCuenta}', \CuentaController::class . ':BorrarUno')
  ->add(\logMiddleware::class . ':registrarAccion');
})->add(new AuthMiddleware);
// });
$app->group('/Movimientos', function (RouteCollectorProxy $group) {
  $group->get('[/]', \MovimientoController::class . ':TraerTodos')
  ->add(\logMiddleware::class . ':registrarAccion');
  $group->get('/Deposito', \MovimientoController::class . ':TraerDepositos')
  ->add(\logMiddleware::class . ':registrarAccion');
  $group->get('/Retiro', \MovimientoController::class . ':TraerRetiros')
  ->add(\logMiddleware::class . ':registrarAccion');
  $group->post('/Deposito', \MovimientoController::class . ':CargarUno')
  ->add(\logMiddleware::class . ':registrarTransaccion')
  ->add(\logMiddleware::class . ':registrarAccion')
  ->add(new cajeroMiddleware);
  $group->post('/Retiro', \MovimientoController::class . ':CargarUno')
  ->add(\logMiddleware::class . ':registrarTransaccion')
  ->add(\logMiddleware::class . ':registrarAccion')
  ->add(new cajeroMiddleware);
  $group->post('/Ajuste', \AjusteController::class . ':CargarUno')
  ->add(\logMiddleware::class . ':registrarTransaccion')
  ->add(\logMiddleware::class . ':registrarAccion')
  ->add(new supervisorMiddleware);
})->add(new AuthMiddleware);
// });

$app->group('/Consultas', function (RouteCollectorProxy $group) {
  $group->get('/totalMovimiento', \MovimientoController::class . ':totalMovimiento')
  ->add(\logMiddleware::class . ':registrarAccion');
  $group->get('/movimientosCuenta', \MovimientoController::class . ':movimientosCuenta')
  ->add(\logMiddleware::class . ':registrarAccion');
  $group->get('/movimientosEntreFechas', \MovimientoController::class . ':movimientosEntreFechas')
  ->add(\logMiddleware::class . ':registrarAccion');
  $group->get('/movimientosPorTipoCuenta', \MovimientoController::class . ':movimientosPorTipoCuenta')
  ->add(\logMiddleware::class . ':registrarAccion');
  $group->get('/movimientosPorCuenta', \MovimientoController::class . ':movimientosPorCuenta')
  ->add(\logMiddleware::class . ':registrarAccion');
})->add(new operadorMiddleware)
->add(new AuthMiddleware);

$app->group('/Logs', function (RouteCollectorProxy $group) {

  $group->get('/archivo/Csv', \LogTransaccionesController::class . ':descargarArchivoCsv');

})->add(new AuthMiddleware);



$app->run();
