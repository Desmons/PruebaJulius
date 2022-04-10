<?php

class valoracion{
    private $valoracion;
    private $id;

    public function __CONSTRUCT($valoracion = null , $id = null) {
        $this->valoracion = $valoracion;
        $this->id = $id;
    }

    // Añadire un valoracion a la lista si no existe, $id nos da el id 
    function getId($con){
        $id = null ;
        while ($id == null) {
            $consulta = $con->prepare('SELECT `idValoraciones`,`tipo` FROM `valoraciones` WHERE `tipo`= :valoracion');
            $consulta->bindParam(':valoracion', $this->valoracion, PDO::PARAM_STR);
            $consulta->execute();
            $registro = $consulta->fetch();
            if($registro != null){
                $id = $registro[0];
            }else{
                $consulta = $con->prepare('INSERT INTO `valoraciones`(`tipo`) VALUES (:valoracion)');
                $consulta->bindParam(':valoracion', $this->valoracion, PDO::PARAM_STR);
                $consulta->execute();
            }
        }
        return $id;
    }

    function getValoracion($con){
        $consulta = $con->prepare('SELECT `tipo` FROM `valoraciones` WHERE `idValoraciones`= :id');
        $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
        $consulta->execute();
        $registro = $consulta->fetch();
        $valoracion = $registro[0];
        return $valoracion;
    }
}

?>