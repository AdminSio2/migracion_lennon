<?php

require 'config/conexion_pdo.php';

$db = new Database();
//$conexion_sio1 = $db->contectarBDSio1();
$conexion_semana_prueba = $db->contectarBDSemanaPrueba();


$array_grupo_inventario = [];

// Se Obtienen  los datos de la tabla dt_grupoinventario del sio2
$consulta_dt_grupo_inventario = $conexion_semana_prueba->query("SELECT id_inventario, id_grupo_inventario FROM correcciones_familia");
$array_dt_grupo_inventario = $consulta_dt_grupo_inventario->fetchAll(PDO::FETCH_OBJ);



// Se Crea un array asociativo donde la clave es el nombre del grupo y el valor es el id_grupo_inventario
foreach ($array_dt_grupo_inventario as $registro_grupo) {
    $array_grupo_inventario[$registro_grupo->id_inventario] = $registro_grupo->id_grupo_inventario;
}

print_r($array_grupo_inventario);exit;

$array_familia_id_grupo_inventario = [];

// Se Obtiene  los datos de la tabla grupos_familia que envio Gabriel
$consulta_grupos_familia = $conexion_sio1->query("SELECT id_inventario, familia FROM grupos_familia");
$array_informacion_familia = $consulta_grupos_familia->fetchAll(PDO::FETCH_OBJ);


foreach ($array_informacion_familia  as $registro_familia) {
    if (array_key_exists($registro_familia->familia, $array_grupo_inventario)) {
       
        $id_grupo_inventario = $array_grupo_inventario[$registro_familia->familia];

        $id_inventario= $registro_familia->id_inventario;
        
        $array_familia_id_grupo_inventario[$id_inventario] = $id_grupo_inventario;

       
    }
}

//var_dump($array_familia_id_grupo_inventario);exit;









