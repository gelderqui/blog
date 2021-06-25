<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//Necesario para recibir parametros con axios
$_POST = json_decode(file_get_contents("php://input"), true);

//Recepcion de datos enviados mediante post desde main.js
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

//Forma de abreeviar una condicional ifelse para recibir los parametros
$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$stock = (isset($_POST['stock'])) ? $_POST['stock'] : '';

switch($opcion){
    case 1:
        $consulta = "INSERT INTO moviles (nombre, descripcion, stock) VALUES('$nombre', '$descripcion', '$stock') ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        break;
    case 2:
        $consulta = "UPDATE moviles SET nombre='$nombre', descripcion='$descripcion', stock='$stock' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3:
        $consulta = "DELETE FROM moviles WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;         
    case 4:
        $consulta = "SELECT id, nombre, descripcion, stock FROM moviles";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}
//Enviar el array final en formato json a js
print json_encode($data, JSON_UNESCAPED_UNICODE);
//Cerramos la conexion
$conexion = NULL;