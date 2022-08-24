<?php
namespace Model;
class Servicios extends ActiveRecord{
    protected static $tabla='servicios';
    protected static $errores=[];
    protected static $columnasDB=['id','nombre','precio'];

    public $id;
    public $nombre;
    public $precio;
    
    public function __construct($args=[]){
    $this->id=$args['id'] ?? null;        
    $this->nombre=$args['nombre'] ?? '';
    $this->precio=$args['precio'] ?? '';        
    }
    public  function alertas(){
       
       if(empty($this->precio) || empty($this->nombre)){
        self::$alertas['errores'][]='Debes rellenar ambos campos';
       }
       return self::$alertas;
    }
}