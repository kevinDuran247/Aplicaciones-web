<?php

class crud extends Conexion {
    public function mostrarDatos() {
        try{
            $conn = parent::conectar();
            $coleccion = $conn->personas;
            $datos = $coleccion->find();
            return $datos;
        }catch(\Throwable $th){
            return $th->getMessage();
        }
    }

    public function mostrarUnDato($id) {
        try{
            $conn = parent::conectar();
            $coleccion = $conn->personas;
            $respuesta = $coleccion->findOne(array('_id' => new MongoDB\BSON\ObjectID($id)));
            return $respuesta;
        }catch(\Throwable $th){
            return $th->getMessage();
        }
    }
    
    public function insertarDatos($datos) {
        try{
            $conn = Conexion::conectar();
            $coleccion = $conn->personas;
            $respuesta = $coleccion->insertOne($datos);
            return $respuesta;
        }catch(\Throwable $th){
            return $th->getMessage();
        }
    }

    public function eliminar($id) {
        try {
            $conn = Conexion::conectar();
            $coleccion = $conn->personas;
            $respuesta = $coleccion->deleteOne(array("_id" => new MongoDB\BSON\ObjectId($id)));
            return $respuesta;
        }catch(\Throwable $th){
            return $th->getMessage();
        }
    }

    public function modificarDatos($id,$datos) {
        try {
            $conn = Conexion::conectar();
            $coleccion = $conn->personas;
            $respuesta = $coleccion->updateOne(['_id' => new MongoDB\BSON\ObjectId($id)],['$set'=> $datos]);
            return $respuesta;
        }catch(\Throwable $th){
            return $th->getMessage();
        }
    }

    public function consultar($nombre) {
        try {
            $conn = parent::conectar();
            $coleccion = $conn->personas;
            $expresion_regular = new \MongoDB\BSON\Regex($nombre, 'i');
            $filtro = ['$or' => [
                ['nombre' => $expresion_regular],
                ['apellido' => $expresion_regular],
                ['correo
                ' => $expresion_regular]
            ]];
            $resultado = $coleccion->find($filtro);
            return $resultado;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}

?>