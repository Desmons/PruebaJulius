<?php
  class Conexion extends PDO{
    
    private $tipo = "mysql";
    private $baseDatos = "prueba_fabriciocardozoordoñez";
    private $servidor = "localhost";
    private $usuario = "root";
    private $contra = "";
    private $conn = "";

    public function __CONSTRUCT() {  
        
      parent::__construct($this->tipo.':host='.$this->servidor.';dbname='.$this->baseDatos, $this->usuario, $this->contra);

    }

    public function getCon(){
      return $this->conn;
    }

  }
?>