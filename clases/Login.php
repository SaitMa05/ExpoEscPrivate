<?php

namespace App;

class Login{

    protected static $db;
    protected static $columnaDB = ['id', 'email', 'password'];

    protected static $errores = [];

    public $email;
    public $password;

    public function __construct($args = []){
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public static function setDB($database){
        self::$db = $database; // Asignar la base de datos a la propiedad estática de la clase
    }

    public static function getErrores(){
        return self::$errores;
    }

    public function validar(){
        if(!$this->email){
            self::$errores[] = "Debes añadir un correo";
        }
        if(!$this->password){
            self::$errores[] = "Debes añadir una contraseña";
        }

        $atributos = $this->sanitizarAtributos();

        $this->email = $atributos['email'];
        $this->password = $atributos['password'];


        $query = " SELECT * FROM usuarios WHERE email = '$this->email' ";
        $resultado = self::consultarSQL($query);
        if($resultado){
            $resultadoUsuario = $resultado[0];
            if($resultadoUsuario->email == $this->email){
                if( password_verify($this->password, $resultadoUsuario->password) ){
                    // Autenticar el usuario
                    session_start();
                    $_SESSION['usuario'] = $this->email;
                    $_SESSION['login'] = true;
                    header('Location: /expoesc/');
                }else{
                    self::$errores[] = "La contraseña es incorrecta";
                }
            }
        }else{
            self::$errores[] = "El usuario no existe";
        }
        return self::$errores;
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

    public static function consultarSQL($query){
        $resultado = self::$db->query($query);
        $array = [];
        while($registro = $resultado->fetch_object()){
            $array[] = self::crearObjeto($registro);
        }
        $resultado->free();
        return $array;
    }
    protected static function crearObjeto($registro){
        $objeto = new self;
        foreach($registro as $key => $value){
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

}