<?php
namespace Model;
use Model\ActiveRecord;

class Admin extends ActiveRecord{
    protected static $tabla='citaservicios';
    protected static $columnasDB=['id', 'hora', 'nombreCompleto','telefono', 'servicio',
'precio'];
    public $id;
    public $hora;
    public $nombreCompleto;
    public $telefono;
    public $servicio;
    public $precio;

    public function __construct($args=[]){
        $this->id=$args['id'] ?? null;
        $this->hora=$args['hora'] ?? '';
        $this->nombreCompleto=$args['nombreCompleto'] ?? '';
        $this->telefono=$args['telefono'] ?? '';
        $this->servicio=$args['servicio'] ?? '';
        $this->precio=$args['precio'] ?? '';
    }
    
    
}