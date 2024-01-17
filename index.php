<?php 

    require 'config/conexion_pdo.php';
    require 'ControladorMigracion.php';

    $tiempo_inicio = microtime(true);

    $db = new Database();

    $conexion_sio1 = $db->contectarBDSio1();
    $conexion_semana_prueba = $db->contectarBDSemanaPrueba();
    $conexion_migracion_prueba = $db->contectarBDMigracionPrueba();

    //Las siguientes tablas ya deben estar disponibles para que la migración funcione
    /*
    De las que ya vienen armadas desde las bases de prueba

    - auth_assignment
    - auth_item
    - auth_item_child
    - auth_item_group 
    - auth_rule
    - chat
    - dt_area  AGREGAR INSERT INTO dt_area(nombre,descripcion) values('TERCEROS','AGREGADO MIGRACION ANDRES')
    - dt_cargos
    - dt_categoria
    - dt_clase_costo
    - dt_clase_proveedor
    - dt_ciudad
    - dt_contrasenas_secundarias
    - dt_documentos
    - dt_estado_civil
    - dt_forma_pago
    - dt_geografia
    - dt_grupo_inventario
    - dt_horario
    - dt_impuestos_saviv
    - dt_interfaz_contable
    - dt_maquinas
    - dt_medida     
    - dt_pucs
    - dt_pucs_oc
    - dt_proveeref
    - dt_regimen
    - dt_subcategoria
    - dt_subgrupo
    - dt_tipo_costo
    - dt_tipo_pago

    Traer vacias de las bases de prueba 

    - dt_empresa
    - dt_familiar_cliente
    - dt_representante_cliente
    - dt_hijo_usuario
    - user_visit_log

    Tablas recuperadas del trabajo de Oz (con correcciones aplicadas desde SQL)

    - dt_clientes
    - dt_inffac_cli
    - dt_macro_proyecto
    - dt_proveedores
    - dt_inf_contable_prove
    - dt_contacto_cliente
    - dt_codprodfinal
    - dt_inventario
    - dt_kardex

    

    Se pueden migrar desde SQL
    
    - dt_acabados

    */ 
   
    echo "Arranca ejecución \n";
    echo "<br>";

    $array_info_global = [];

    //Traemos el array codigo_prod => id_inventario

    $array_convierte_codigo_prod = ControladorInformacionGlobal::traeArrayIdInventario($conexion_migracion_prueba);

    $array_info_global['codigo_prod=>id_inventario'] = ControladorInformacionGlobal::traeArrayIdInventario($conexion_migracion_prueba);

    //Traemos array medidas => id_medida

    $array_convierte_medidas = ControladorInformacionGlobal::traeArrayMedidas($conexion_migracion_prueba);

    $array_info_global['medidas=>id_medida'] = ControladorInformacionGlobal::traeArrayMedidas($conexion_migracion_prueba);

    //Traemos array area_sio1 => id_area

    $array_convierte_nombre_area = ControladorInformacionGlobal::traeArrayIdArea();

    $array_info_global['id_area'] = ControladorInformacionGlobal::traeArrayIdArea($conexion_migracion_prueba);

    //Traemos array nit => id_cliente

    $array_info_global['nit=>id_cliente'] = ControladorInformacionGlobal::traeArrayIdCliente($conexion_migracion_prueba);


    //MIGRAMOS trayendo las funciones correspondientes

    //echo ControladorMigracion::migraDtAcabados($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";
    //echo ControladorMigracion::migraDtInventarioxarea($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";

    /*Solo estos ids_inventarioxarea del 1 al 13 deben ir con 1 
    el resto son codigos sin id_inventario que se les úso ese provisionalmente*/

    //Traemos array cod => id_acabados

    $array_convierte_acabado = ControladorInformacionGlobal::traeArrayIdAcabados($conexion_sio1);

    $array_info_global['cod=>id_acabados'] = ControladorInformacionGlobal::traeArrayIdAcabados($conexion_sio1);

    //echo ControladorMigracion::migraDtUsuariosUser($conexion_sio1,$conexion_migracion_prueba)."\n<br>";

    //Traemos los arrays: user codVendedor => id_usuario y vendedor => id_usuario 

    $array_convierte_vendedor = ControladorInformacionGlobal::traeArrayUser($conexion_sio1,$conexion_migracion_prueba,1);

    $array_info_global['vendedor=>id'] = ControladorInformacionGlobal::traeArrayUser($conexion_sio1,$conexion_migracion_prueba,1);

    $array_convierte_codVendedor = ControladorInformacionGlobal::traeArrayUser($conexion_sio1,$conexion_migracion_prueba,2);

    $array_info_global['codVendedor=>id'] = ControladorInformacionGlobal::traeArrayUser($conexion_sio1,$conexion_migracion_prueba,2);

    //echo ControladorMigracion::migraDtProyectoOp($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";

    //Traemos el array cod => id_codprodfinal 

    $array_convierte_cod = ControladorInformacionGlobal::traeArrayIdCodprodfinal($conexion_sio1);

    $array_info_global['cod=>id_codpdrodfinal'] = ControladorInformacionGlobal::traeArrayIdCodprodfinal($conexion_sio1);



    //echo ControladorMigracion::migraDtOrdenes($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";

    
    //Traemos el array: n_ordenes|item_op => id_ordenes

    $array_convierte_ordenes_item = ControladorInformacionGlobal::traeArrayIdOrdenes($conexion_migracion_prueba);

    $array_info_global['n_ordenes|item_op=>id_ordenes'] = ControladorInformacionGlobal::traeArrayIdOrdenes($conexion_migracion_prueba);

    //Traemos array de tipos de script

    $array_info_global['tipo_script'] = ControladorInformacionGlobal::traeArrayTipoScript();

    //echo ControladorMigracion::migraDtPlantilla($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>"; //No migramos registros de códigos borrados
    //echo ControladorMigracion::migracionDtTareas($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";
  
    echo ControladorMigracion::migracionDtCotizacion($conexion_sio1,$conexion_migracion_prueba,$array_info_global);// Con catagoria y plantilla faltantes
  
    //echo ControladorMigracion::migraDtCostos($conexion_sio1,$conexion_semana_prueba,$conexion_migracion_prueba,$array_convierte_ordenes_item,$array_convierte_vendedor,$array_convierte_codigo_prod,$array_convierte_acabado)."\n<br>";



    $tiempo_fin = microtime(true);
    $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

    echo "\n<br>";
    echo "\n Ejecución completa! Alcanzada en ".$tiempo_transcurrido." segundos";


?>