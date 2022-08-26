<?php 

require_once __DIR__ . '/../includes/app.php';
require __DIR__ . '/../controllers/log.php';
require __DIR__ . '/../controllers/private.php';
require __DIR__ . '/../controllers/APIcontroller.php';

use MVC\Router;
use Controllers\logController;
use Controllers\privateArea;
use Controllers\APIcontroller;
use Controllers\Admincontroller;
$router = new Router();

//INICIO SESION
$router->get('/',[logController::class, 'login']);
$router->post('/',[logController::class, 'login']);

// CERRAR SESION
$router->get('/log/logout',[logController::class, 'logout']);

//CREAR CUENTA
$router->get('/log/create',[logController::class, 'create']);
$router->post('/log/create',[logController::class, 'create']);

//RECUPERAR PASSWORD
$router->get('/log/forget',[logController::class, 'forget']);
$router->post('/log/forget',[logController::class, 'forget']);
 $router->get('/confirmado/recover',[logController::class, 'recover']);
 $router->post('/confirmado/recover',[logController::class, 'recover']);

//Confirmar
$router->get('/msg',[logController::class, 'msg']);
$router->get('/creado',[logController::class, 'creado']);

// *******************PRIVATE AREA******************* \\
    // Menu
        $router->get('/servicios',[privateArea::class, 'servicios']);
// API de citas
$router->get('/api/servicios',[APIcontroller::class,'index']);
//RESERVA DE TURNOS
// $router->get('/api/citas',[APIcontroller::class,'citas']);
$router->post('/api/citas',[APIcontroller::class,'citas']);
$router->get('/api/eliminar',[APIcontroller::class,'eliminar']);
$router->post('/api/eliminar',[APIcontroller::class,'eliminar']);
$router->post('/admin/api/eliminarServicio',[APIcontroller::class,'eliminarServicio']);
$router->post('/admin/api/editarServicio',[APIcontroller::class,'editarServicio']);
$router->get('/admin/actualizarServicios',[APIcontroller::class,'actualizarServicio']);
$router->post('/admin/actualizarServicios',[APIcontroller::class,'actualizarServicio']);

// PANEL ADMIN
$router->get('/admin', [AdminController::class,'index']);
$router->post('/admin', [AdminController::class,'index']);
$router->get('/admin/verServicios', [AdminController::class,'verServicios']);
$router->post('/admin/verServicios', [AdminController::class,'verServicios']);
$router->get('/admin/crearServicios', [AdminController::class,'crearServicios']);
$router->post('/admin/crearServicios', [AdminController::class,'crearServicios']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();