<?php
namespace Model;
class Usuarios extends ActiveRecord{
    protected static $tabla= 'usuarios';
    protected static $columnasDB=['id','nombre','apellido','telefono','email',
    'password','admin','confirmado','token'] ;
    public static $alertas=[];

    //VARIABLES
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $password;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($arg=[]){
        $this->id=$arg['id'] ?? null;
        $this->nombre=$arg['nombre'] ?? '';
        $this->apellido=$arg['apellido'] ?? '';
        $this->telefono=$arg['telefono'] ?? '';
        $this->email=$arg['email'] ?? '';
        $this->password=$arg['password'] ?? '';
        $this->admin= $arg['admin'] ?? 0;
        $this->confirmado= $arg['confirmado'] ?? 0;
        $this->token=$arg['token'] ?? '';
    }
    public function alertas(){
        if(!$this->nombre){
            self::$alertas['errores'][]='Debes agregar un nombre';
        }
        if(!$this->apellido){
            self::$alertas['errores'][]='Debes agregar un apellido';
        }
        if(!$this->telefono){
            self::$alertas['errores'][]='Debes agregar un telefono';
        }
        if(!preg_match('/[0-9]/',$this->telefono)){
            $alertas['errores'][]="No puedes agregar caracteres no numericos";
        }
        if(!$this->email){
            self::$alertas['errores'][]='Debes agregar un email';
        }
        if(!$this->password){
            self::$alertas['errores'][]='Debes agregar un password';
        }
        elseif(strlen($this->password)<10){
            self::$alertas['errores'][]='El password debe ser mayor a 10 caracteres';
        }
        return self::$alertas;
    }
    public function registro(){
        $query="SELECT * FROM ". self::$tabla ." WHERE email='{$this->email}' LIMIT 1";
        $resultado=self::$db->query($query); 
        
        if($resultado->num_rows==1) /*num_row=1 quiere decir que la consulta devolvio resultados*/{
            self::$alertas['repeated'][]='This account already exists';
            return self::$alertas;
        }
        
    }
    public function emptyMail(){
        if(!$this->email){
            self::$alertas['errores'][]='Debes escribir un email';
        }
        return self::$alertas;
    }
    public function long(){
        if(!$this->password){
            self::$alertas['errores'][]='Debes escribir un password';
        }
        if(strlen($this->password)<10){
            self::$alertas['errores'][]='Debes escribir un password  superior a 10 caracteres';
        }
        return self::$alertas;
    }
    public function passwordHash(){
        
        $this->password=password_hash($this->password, PASSWORD_BCRYPT);
        
    }
    public function crearToken(){
        $this->token=uniqid();
    }
    public function logAlert(){
        if(!$this->email){
            self::$alertas['errores'][]='Debes escribir un email';
        }
        if(!$this->password){
            self::$alertas['errores'][]='Debes escribir un password';
        }
        return self::$alertas;
    }
    public function verifica($pass){
        
        $resultado=password_verify($this->password,$pass);
        return $resultado;
    }
 
}