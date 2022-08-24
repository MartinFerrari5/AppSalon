<?php
namespace Model;

class Cita extends ActiveRecord{
    // Base de datos
    protected static $tabla= 'citas';
    protected static $columnasDB=['id', 'hora','fecha','usuarioid'];
    public $id;
    public $hora;
    public $fecha;
    public $usuarioid;
    public function __construct($args=[]){
        $this->id=$args['id'] ?? null;
        $this->hora=$args['hora'] ?? "";
        $this->fecha=$args['fecha'] ?? "";
        $this->usuarioid=$args['usuarioid'] ?? "";
    }
}