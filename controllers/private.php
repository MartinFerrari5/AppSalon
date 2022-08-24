<?php
namespace Controllers;
use MVC\Router;
use Model\Usuarios;
class privateArea{
    public static function servicios(Router $router){
        $auth=login();
     
        $usuarios=Usuarios::find("id",$_SESSION["id"]);
        
        $router->render('menu/servicios',[
            'auth'=>$auth,
            'usuarios'=>$usuarios,
            'nombre'=> $_SESSION['nombre'],
            'id'=> $_SESSION['id']
        ]);
    }
}