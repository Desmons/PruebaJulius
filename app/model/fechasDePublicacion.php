<?php

class fechasDePublicacion{
    private $fechasDePublicacion;
    private $id;

    public function __CONSTRUCT($fechasDePublicacion = null , $id = null) {
        $this->fechasDePublicacion = $fechasDePublicacion;
        $this->id = $id;
    }

    // Añadire un fechasDePublicacion a la lista si no existe, $id nos da el id 
    function getId($con){
        $id = null ;
        while ($id == null) {
            $consulta = $con->prepare('SELECT `idFechaDePublicacion`,`fecha` FROM `fechasdepublicacion` WHERE `fecha`= :fechasDePublicacion');
            $consulta->bindParam(':fechasDePublicacion', $this->fechasDePublicacion, PDO::PARAM_STR);
            $consulta->execute();
            $registro = $consulta->fetch();
            if($registro != null){
                $id = $registro[0];
            }else{
                $consulta = $con->prepare('INSERT INTO `fechasdepublicacion`(`fecha`) VALUES (:fechasDePublicacion)');
                $consulta->bindParam(':fechasDePublicacion', $this->fechasDePublicacion, PDO::PARAM_STR);
                $consulta->execute();
            }
        }
        return $id;
    }

    function getFechaDePublicacion($con){
        $consulta = $con->prepare('SELECT `fecha` FROM `fechasdepublicacion` WHERE `idFechaDePublicacion`= :id');
        $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
        $consulta->execute();
        $registro = $consulta->fetch();
        $fechaDePublicacion = $registro[0];
        return $fechaDePublicacion;
    }
}

?>