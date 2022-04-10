<?php

class editor{
    private $editor;
    private $id;

    public function __CONSTRUCT($editor = null , $id = null) {
        $this->editor = $editor;
        $this->id = $id;
    }

    // Añadire un editor a la lista si no existe, $id nos da el id 
    function getId($con){
        $id = null ;
        while ($id == null) {
            $consulta = $con->prepare('SELECT `idEditor`,`editor` FROM `editores` WHERE `editor`= :editor');
            $consulta->bindParam(':editor', $this->editor, PDO::PARAM_STR);
            $consulta->execute();
            $registro = $consulta->fetch();
            if($registro != null){
                $id = $registro[0];
            }else{
                $consulta = $con->prepare('INSERT INTO `editores`(`editor`) VALUES (:editor)');
                $consulta->bindParam(':editor', $this->editor, PDO::PARAM_STR);
                $consulta->execute();
            }
        }
        return $id;
    }
    function getEditor($con){
        $consulta = $con->prepare('SELECT `editor` FROM `editores` WHERE `idEditor`= :id');
        $consulta->bindParam(':id', $this->id, PDO::PARAM_INT);
        $consulta->execute();
        $registro = $consulta->fetch();
        $Editor = $registro[0];
        return $Editor;
    }
}

?>