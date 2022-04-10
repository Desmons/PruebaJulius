<?php

class edicion{
    private $edicion;
    private $id;

    public function __CONSTRUCT($edicion = null , $id = null) {
        $this->edicion = $edicion;
        $this->id = $id;
    }

    // Añadire un edicion a la lista si no existe, $id nos da el id 
    function getId($con){
        $id = null ;
        while ($id == null) {
            $consulta = $con->prepare('SELECT `idEdicion`,`edicion` FROM `ediciones` WHERE `edicion`= :edicion');
            $consulta->bindParam(':edicion', $this->edicion, PDO::PARAM_STR);
            $consulta->execute();
            $registro = $consulta->fetch();
            if($registro != null){
                $id = $registro[0];
            }else{
                $consulta = $con->prepare('INSERT INTO `ediciones`(`edicion`) VALUES (:edicion)');
                $consulta->bindParam(':edicion', $this->edicion, PDO::PARAM_STR);
                $consulta->execute();
            }
        }
        return $id;
    }
    function getEdicion($con){
        $consulta = $con->prepare('SELECT `edicion` FROM `ediciones` WHERE `idEdicion`= :id');
        $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
        $consulta->execute();
        $registro = $consulta->fetch();
        $edicion = $registro[0];
        return $edicion;
    }
}

?>