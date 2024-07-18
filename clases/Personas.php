<?php

namespace App;

class Personas{

    protected static $db;
    protected static $columnaDB = ['id', 'nombre', 'apellido', 'acompanante3', 'acompanante2', 'acompanante1', 'ingreso', 'usuariosId'];

    protected static $errores = [];

    public $emailUser;
    public $idUser;
    public $id;
    public $nombre;
    public $apellido;
    public $acompanante1;
    public $acompanante2;
    public $acompanante3;
    public $ingreso;
    public $usuariosId;

    public $acompanante;

    public $ingroActual;

    public function __construct($args = []){

        $this->ingroActual = date('Y-m-d H:i:s');
        $this->emailUser = $_SESSION['usuario'];

        $query = " SELECT id FROM usuarios WHERE email = '$this->emailUser'";
        $resultado = self::$db->query($query);
        $idUser = $resultado->fetch_object();
        $idUser = $idUser->id;
        

        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->acompanante3 = $args['acompanante3'] ?? '';
        $this->acompanante2 = $args['acompanante2'] ?? '';
        $this->acompanante1 = $args['acompanante1'] ?? '';
        if($args['ingreso'] === ''){ $this->ingreso = $this->ingroActual; }else{ $this->ingreso = $args['ingreso'];}
        $this->usuariosId = $args['usuariosId'] ?? $idUser;

        $this->acompanante = $args['acompanantes'] ?? '';

    }

    public static function setDB($database){
        self::$db = $database; // Asignar la base de datos a la propiedad estática de la clase
    }

    public function guardar(){
        $atributos = $this->sanitizarAtributos();

        $query = " INSERT INTO personas ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('"; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        // debuguear(array_keys($atributos));
        $resultado = self::$db->query($query);
        // debuguear($resultado);
        return $resultado;

    }
    
    public function atributos(){
        $atributos = [];
        foreach(self::$columnaDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){

        if(!$this->nombre){
            self::$errores[] = 'El nombre es obligatorio';
        }

        if(!$this->apellido){
            self::$errores[] = 'El apellido es obligatorio';
        }

        if($this->acompanante > 0){
            if($this->acompanante1 == '' && $this->acompanante2 == '' && $this->acompanante3 == ''){
                self::$errores[] = 'Los nombres de los acompañantes son obligatorios';
            }
        }
        

        return self::$errores;
    }

}