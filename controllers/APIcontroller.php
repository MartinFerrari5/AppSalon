<?php
namespace Controllers;
use Model\Servicios;
use Model\Cita;
use Model\CitaServicios;
use MVC\Router;
class APIcontroller{
    public static function index(){
        $servicios= Servicios::all();
       
        echo json_encode($servicios);
    }
    public static function citas(){
        //Almacena la cita y devuelve el ID
        $cita= new Cita($_POST);
      
         $resultado=$cita->guardar();
         $id=$resultado['id'];
        
         //  explode() == split() en js, crea un array tomando como punto de creacion el parametro
        //Almacena los servicios con el id de la cita
         $idServicios= explode(',',$_POST['servicios']);
       
         foreach($idServicios as $idServicio){
                $args=[
                    'citaid'=>$id,
                    'servicioid'=>$idServicio
                ];
                
                $citaServicio= new CitaServicios($args);
                ;
                $citaServicio->guardar();
         }
         $respuesta=[
            'resultado'=>$resultado
         ];
        echo json_encode($respuesta);
    }
    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $resultado=Cita::find('id', $_POST['id']);
            $resultado->eliminar();
            // NOS REDIRIGE A LA PAGINA DE DONDE VENIAMOS
            header('Location:' . $_SERVER['HTTP_REFERER'] . '&msg=deleted');
          
        }
    }
    // public static function eliminarServicio(){
    //     if($_SERVER['REQUEST_METHOD']=='POST'){
    //         $resultado=Servicios::find('id', $_POST['id']);
    //         $resultado->eliminar();
    //         // NOS REDIRIGE A LA PAGINA DE DONDE VENIAMOS
    //         header('Location:' . $_SERVER['HTTP_REFERER'] . '?msg=deleted');
          
    //     }
    // }
    public static function editarServicio(){
        $auth=login();
        if($auth['admin']!=1){
            header('Location: /public/');
        }
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $id=$_POST['id'];
            $opcion=$_POST['boton'];
            if($opcion=='eliminar'){
                $resultado=Servicios::find('id', $_POST['id']);
            $resultado->eliminar();
            // NOS REDIRIGE A LA PAGINA DE DONDE VENIAMOS
            header('Location:' . $_SERVER['HTTP_REFERER'] . '?msg=deleted');
            }elseif($opcion=='actualizar'){
                header("Location: /public/admin/actualizarServicios?id={$id}");
            }
           
          
        }
    }
    public static function actualizarServicio(Router $router){
        $auth=login();
        if($auth['admin']!=1){
            header('Location: /public/');
        }
        $id=$_GET['id'] ?? '';
        
        $servicio=Servicios::find('id',$id);
        $alertas=[];
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $args=$_POST;
            $servicio->sincronizar($args);
    
            $alertas=$servicio->alertas();
            if(!$alertas){
                
                $resultado=$servicio->guardar();
                if($resultado){
                    header('Location: /public/admin/verServicios?msg=created');
                }
            }
         }
        $router->render('admin/actualizarServicio',[
            'servicio'=>$servicio,
            'alertas'=>$alertas
        ]);
    }
}