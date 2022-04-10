<?php

class titulo{
    private $titulo;
    private $id;

    public function __CONSTRUCT($titulo = null ,$id = null) {
        $this->titulo = $titulo;
        $this->id = $id;
    }

    // Añadire un titulo a la lista si no existe, $id nos da el id 
    function getId($con){
        $id = null ;
        while ($id == null) {
            $consulta = $con->prepare('SELECT `idTitulo`,`titulo` FROM `titulos` WHERE `titulo`= :titulo');
            $consulta->bindParam(':titulo', $this->titulo, PDO::PARAM_STR);
            $consulta->execute();
            $registro = $consulta->fetch();
            if($registro != null){
                $id = $registro[0];
            }else{
                $consulta = $con->prepare('INSERT INTO `titulos`(`titulo`) VALUES (:titulo)');
                $consulta->bindParam(':titulo', $this->titulo, PDO::PARAM_STR);
                $consulta->execute();
            }
        }
        return $id;
    }

    function getTitulo($con){
        $consulta = $con->prepare('SELECT `titulo` FROM `titulos` WHERE `idTitulo`= :id');
        $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
        $consulta->execute();
        $registro = $consulta->fetch();
        $titulo = $registro[1];
        return $titulo;
    }
}

?>