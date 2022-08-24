<?php
namespace Controllers;

use Model\Usuarios;
use MVC\Router;
use Classes\Email;
class logController{

    public static function login(Router $router){
        $alertas=Usuarios::getAlertas();
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $args=$_POST['login'];
            // EN ESTE CASO LE PUEDO PASAR UN NEW USUARIO
            $usuarios= new Usuarios($args);
           
            $alertas=$usuarios->logAlert();
           
            $alertas=$usuarios::getAlertas();
            if(empty($alertas)){
                $resultado=$usuarios::find("email",$usuarios->email);
              
                if($resultado){
                    $verify=$usuarios->verifica($resultado->password);
                    if($verify && $resultado->confirmado==1){
                        session_start();
                        $_SESSION['id']=$resultado->id;
                        $_SESSION['nombre']=$resultado->nombre . " " . $resultado->apellido;
                        $_SESSION['email']=$resultado->email;
                        $_SESSION['login']=true;
                        $_SESSION['admin']=$resultado->admin;
                        if($resultado->admin==1){
                            header('Location: admin');
                        }
                        else{
                            header('Location: servicios');
                        }
                        
                 }elseif(!$verify){
                    Usuarios::setAlerta('errores','Password incorrecto');
                    $alertas=Usuarios::getAlertas();
                 }
                 else{
                    Usuarios::setAlerta('errores','Debes confirmar tu email');
                    $alertas=Usuarios::getAlertas();
                 }
                    
                }else{
                    Usuarios::setAlerta('errores','Usuario no encontrado');
                    $alertas=Usuarios::getAlertas();   
                }
            } 
        }
        $router->render('log/login',[
            'alertas'=>$alertas
        ]);
    }


    public static function logout(Router $router){
        $router->render("log/logout",[]);
    }
    public static function forget(Router $router){
        $alertas=Usuarios::getAlertas();
        $usuarios=new Usuarios();
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $arg=$_POST;
            $usuarios=new Usuarios($arg);
            $alertas=$usuarios->emptyMail();
           if(empty($alertas)){
            $resultado=Usuarios::find('email',$usuarios->email);
          
                if($resultado && $resultado->confirmado==1){
                    $resultado->crearToken();
                    $resultado->guardar();
                    Usuarios::setAlerta('repeated','Enviado con éxito');
                $email= new Email($resultado->nombre, $resultado->apellido, $resultado->token);
                    $email->recover();
                }else{
                    Usuarios::setAlerta('errores','Cuenta inexistente');
                }
        }
            $alertas=Usuarios::getAlertas();
            
             
        }
        $router->render("log/forget",[
            'alertas'=>$alertas,
            'usuarios'=>$usuarios
        ]);
    }

    public static function recover(Router $router){
        $alertas=[];
        $token=s($_GET['token']) ?? null;
        $resultado=Usuarios::find('token',$token);
        $error=false;
        if(!$resultado){
            Usuarios::setAlerta("errores","Token no valido");
            $error= true;
        
        }
        if($_SERVER['REQUEST_METHOD']=='POST'){
         
           
           $auth=$_POST;
           $usuarios= new Usuarios($auth);
           $alertas=$usuarios->long();
           if(!$alertas){
            $usuarios->passwordHash();
            // RESULTADO ES EL DE LA BBDD Y $USUARIOS ES EL DEL INPUT
            $resultado->password=$usuarios->password;
            $resultado->token="";
            $resultado->guardar();
            Usuarios::setAlerta('correcto','Password Reestablecido');
            $error=true;
           }
           
           
        }
        $alertas=Usuarios::getAlertas();
        $router->render('confirmado/recover',[
            'alertas'=>$alertas,
            'error'=>$error
        ]);
    }
    public static function create(Router $router){
            $usuarios=new Usuarios;
            $alertas=Usuarios::getAlertas();
            
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $args=$_POST["account"];
           
            $usuarios= new Usuarios($args);
           
            $usuarios->alertas();
            $usuarios->registro();
            $alertas=Usuarios::getAlertas();
        
            if(empty($alertas) ){
                
                $usuarios->passwordHash();
                $usuarios->crearToken();
               //ENVIAR EL EMAIL
                header('Location:../msg');
               $email=new Email($usuarios->email, $usuarios->nombre,$usuarios->token);
              $email->enviar();
              $resultado=$usuarios->guardar();
            }
        }
        $router->render("log/create",[
            'usuarios'=>$usuarios,
            'alertas'=>$alertas
           
        ]);
    }
    public static function msg(Router $router){
        $router->render('confirmado/msg',[

        ]);
    }
    public static function creado(Router $router){
        $token=s($_GET["token"]) ?? null;
        $mensaje="";
        $usuarios= Usuarios::find('token',$token);
        
        if($usuarios){
            $usuarios->confirmado=1;
            // Se elimina el token asi nadie puede hacer validaciones con ese token
            $usuarios->token="";
            $usuarios->guardar();
            $mensaje="<p class='alerta correcto'>Cuenta creada correctamente</p>";
        }
        else{
            $mensaje="<p class='alerta errores'>Token no válido</p>";
        }

        $router->render('confirmado/creado',[
            'token'=>$token,
            'mensaje'=>$mensaje
        ]);
    }
   
    

}