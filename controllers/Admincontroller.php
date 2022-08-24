<?php
namespace Controllers;

use Model\ActiveRecord;
use Model\Admin;
use MVC\Router;
use Model\Servicios;
class AdminController {
    public static function index(Router $router){
        $auth=login();
        if($auth['admin']!=1){
            header('Location: /public/');
        }
        // FECHA ACTUAL
        $date=$_GET['fecha'] ?? date('Y-m-d');
       
        $fecha=explode('-',$date);
        
        $alertas=[];
        $fechas=[];
        // VALIDA QUE EXISTA LA FECHA (DEVUELVE TRUE O FALSE)
        if(checkdate($fecha[1],$fecha[2],$fecha[0])){
            
            $query='SELECT citas.id,hora, CONCAT(usuarios.nombre, " ", usuarios.apellido) as 
            nombreCompleto,usuarios.telefono, servicios.nombre as servicio, servicios.precio FROM citas
            LEFT OUTER JOIN usuarios
            ON citas.usuarioid=usuarios.id
            LEFT OUTER JOIN citaservicios
            ON citaservicios.citaid=citas.id
            LEFT OUTER JOIN servicios 
            ON servicios.id=citaservicios.servicioid
            where fecha= ' . '"' . $date . '"'  ;
            $fechas=Admin::findDate($query);
        };
        if(!$fechas){
            $alertas['errores'][]='Fecha sin turnos';
            
        }
        if($_SERVER['REQUEST_METHOD']=='POST'){
            debuguear($_POST);
        }
        $router->render('admin/admin',[
            'nombre'=> $_SESSION['nombre'],
            'alertas'=>$alertas,
            'fechas'=>$fechas,
            'fecha'=>$fecha,
            'date'=>$date,
        ]);
    }
    public static function verServicios(Router $router){
        $auth=login();
       
        if($auth['admin']!=1){
            header('Location: /public/');
        }
        $servicios=Servicios::all();
        
        $router->render('admin/verServicios',[
            'servicios'=>$servicios
        ]);

    }
    public static function crearServicios(Router $router){
        $auth=login();
        if($auth['admin']!=1){
            header('Location: /public/');
        }
        $servicio=new Servicios();
        $alertas=[];
        
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $args=$_POST;
            // SINCRONIZO PARA NO INSTANCIAR DE NUEVO AL OBJETO
            $servicio->sincronizar($args);
            $alertas=$servicio->alertas();
            if(!$alertas){
                $resultado=$servicio->guardar();
                if($resultado){
                    header('Location: /public/admin?msg=created');
                }
            }
          
          
        }
        
        $router->render('admin/crearServicios',[
            'alertas'=>$alertas,
            'servicio'=>$servicio
        ]);

    }
}