<?php 

    require 'config/conexion_pdo.php';
    require 'ControladorMigracion.php';

    $tiempo_inicio = microtime(true);

    $db = new Database();

    $conexion_sio1 = $db->contectarBDSio1();
    //$conexion_semana_prueba = $db->contectarBDSemanaPrueba();
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
    - dt_area  AGREGAR INSERT INTO dt_area(nombre,descripcion) values('FINANCIERA','AGREGADO MIGRACION ANDRES'),('CONTABILIDAD','AGREGADO MIGRACION ANDRES'),('TERCEROS','AGREGADO MIGRACION ANDRES')
    - dt_cargos
    - dt_categoria
    - dt_clase_costo
    - dt_clase_proveedor
    - dt_ciudad
    - dt_codigo_categoria
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
    - dt_tipo_informe
    - dt_tipo_pago


    Traer vacias previamente de las bases de prueba 

    - dt_empresa
    - dt_familiar_cliente
    - dt_representante_cliente
    - dt_hijo_usuario
    - user_visit_log

    Tablas recuperadas del trabajo de Oz (con correcciones aplicadas desde SQL)

    - dt_clientes       Esta ya quedo por migración directa
    - dt_inffac_cli     Esta ya quedo por migración directa
    - dt_macro_proyecto
    - dt_proveedores
    - dt_inf_contable_prove
    - dt_contacto_cliente
    - dt_codprodfinal   Esta ya quedo por migración directa
    - dt_inventario     Esta ya quedo por migración directa
    - dt_kardex         Esta ya quedo por migración directa 


    Se pueden migrar desde SQL
    
    - dt_acabados

    */ 

    date_default_timezone_set('America/Bogota');
    set_time_limit(9600); //Seteamos tiempo de ejecución máximo en 160 min/ 2 h y 40 m
    ini_set('memory_limit', '2G'); //Seteamos una memoria de 2G
    $fechaHoraActual = date('Y-m-d H:i:s');

    echo "*****************";
    echo "Arranca ejecución ".$fechaHoraActual;
    echo "*****************";
    echo "\n<br>"; 

    $array_info_global = [];

    

    


    //Traemos el array id_proveedor => descuento_ica

    $array_info_global['id_proveedor=>descuento_ica'] = ControladorInformacionGlobal::traeArrayCheckIca($conexion_sio1);

    
    
    //Traemos el array id_cod => medidas_codigos  (YA NO SE USA POR MIGRACIÓN DIRECTA DE LA TABLA)

    // $array_info_global['id_cod=>medidas_codigos'] = ControladorInformacionGlobal::traeDataCorreccionCodprodfinal($conexion_sio1);

    

    //Traemos array medidas => id_medida

    $array_info_global['medidas=>id_medida'] = ControladorInformacionGlobal::traeArrayMedidas($conexion_migracion_prueba); 

    //Traemos array grupo => id_grupo_inventario 

    $array_info_global['grupo=>id_grupo_inventario'] = ControladorInformacionGlobal::traeArrayIdGrupoInventario($conexion_migracion_prueba);

    //Traemos array subgrupo => id_subgrupo

    $array_info_global['subgrupo=>id_subgrupo'] = ControladorInformacionGlobal::traeArrayIdSubgrupo($conexion_migracion_prueba);

    

    
    


    echo ControladorMigracion::migraDtUsuariosUser($conexion_sio1,$conexion_migracion_prueba)."\n<br>";
    echo ControladorFuncionesAuxiliares::complementaInfoUsuariosActivos($conexion_migracion_prueba)."\n<br>";
    

    //Traemos los arrays: user codVendedor => id_usuario y vendedor => id_usuario 

    $array_info_global['vendedor=>id'] = ControladorInformacionGlobal::traeArrayUser($conexion_sio1,$conexion_migracion_prueba,1);

    $array_info_global['codVendedor=>id'] = ControladorInformacionGlobal::traeArrayUser($conexion_sio1,$conexion_migracion_prueba,2);

    echo ControladorMigracion::migraDtClientesDtInffacCli($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";

    //Traemos array nit => id_cliente

    $array_info_global['nit=>id_cliente'] = ControladorInformacionGlobal::traeArrayIdCliente($conexion_migracion_prueba);

    echo ControladorFuncionesAuxiliares::actualizaRegistrosNuevosTablasOz($conexion_migracion_prueba)."\n<br>"; //Actualización tablas Oz

    //Traemos array: empresa => id_proveedores
 
    $array_info_global['empresa=>id_proveedores'] = ControladorInformacionGlobal::traeArrayIdProveedores($conexion_migracion_prueba);

    echo ControladorFuncionesAuxiliares::agregaRegistrosFaltantes($conexion_migracion_prueba)."\n<br>";
    echo ControladorMigracion::migraDtCodprodfinal($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";//exit;
    echo ControladorFuncionesAuxiliares::creaTablaDtSublinea($conexion_migracion_prueba)."\n<br>";
    echo ControladorMigracion::migraDtInventarioDtKardex($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";
    echo ControladorFuncionesAuxiliares::incluyeIdMedidasFaltantes($conexion_migracion_prueba)."\n<br>";

    //Desocupamos estos arrays porque no se van a usar luego de la función anterior
    $array_info_global['grupo=>id_grupo_inventario'] = null;
    $array_info_global['subgrupo=>id_subgrupo'] = null;

    //Traemos el array codigo_prod => id_inventario

    $array_convierte_codigo_prod = ControladorInformacionGlobal::traeArrayIdInventario($conexion_migracion_prueba);

    $array_info_global['codigo_prod=>id_inventario'] = ControladorInformacionGlobal::traeArrayIdInventario($conexion_migracion_prueba);

    

    //Traemos array area_sio1 => id_area

    $array_info_global['id_area'] = ControladorInformacionGlobal::traeArrayIdArea($conexion_migracion_prueba);

    

    //Traemos array grupos diseño

    $array_info_global['grupos_diseno'] = ControladorInformacionGlobal::traeArrayGruposDiseno();

    echo ControladorMigracion::migraDtAcabados($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";
    echo ControladorFuncionesAuxiliares::corrigeDtInventario($conexion_migracion_prueba)."\n<br>";
    

    /*Solo estos ids_inventarioxarea del 1 al 13 deben ir con 1 
    el resto son codigos sin id_inventario que se les úso ese provisionalmente*/

    //Traemos array cod => id_acabados

    $array_info_global['cod=>id_acabados'] = ControladorInformacionGlobal::traeArrayIdAcabados($conexion_sio1);

    
    //echo ControladorFuncionesAuxiliares::actualizaAuthAssignment($conexion_migracion_prueba)."\n<br>"; YA NO VA 
    
    echo ControladorFuncionesAuxiliares::corrigeDtInfContableProve($conexion_migracion_prueba,$array_info_global)."\n<br>";
    //echo ControladorFuncionesAuxiliares::corrijeDtCodprodfinal($conexion_migracion_prueba,$array_info_global)."\n<br>"; Esta ya se fue por migración directa
    echo ControladorMigracion::migraDtInventarioxarea($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";
    echo ControladorFuncionesAuxiliares::corrijeDtClientes($conexion_migracion_prueba)."\n<br>";
    

    

    echo ControladorMigracion::migraDtProyectoOp($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";

    //Traemos el array cod => id_codprodfinal 

    $array_info_global['cod=>id_codpdrodfinal'] = ControladorInformacionGlobal::traeArrayIdCodprodfinal($conexion_sio1);

    //Traemos el array nOrden => cod  (desde dt_subcategorias del sio 1) suspendemos

    //$array_info_global['nOrden=>cod'] = ControladorInformacionGlobal::traeArrayCodSubcategorias($conexion_sio1);

    //Traemos el array nOrden|item_ct=>dataSubcategoria

    $array_info_global['nOrden|item_ct=>dataSubcategoria'] = ControladorInformacionGlobal::traeArrayDtSubcategorias($conexion_sio1);

    echo ControladorMigracion::migraDtOrdenes($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";

    //Desocupamos este sub aray que no usaremos más

    $array_info_global['nOrden|item_ct=>dataSubcategoria'] = null;
    
    //Traemos el array: n_ordenes|item_op => id_ordenes

    $array_info_global['n_ordenes|item_op=>id_ordenes'] = ControladorInformacionGlobal::traeArrayIdOrdenes($conexion_migracion_prueba);

    //Traemos array de tipos de script

    $array_info_global['tipo_script'] = ControladorInformacionGlobal::traeArrayTipoScript();

    echo ControladorMigracion::migraDtPlantilla($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>"; //No migramos registros de códigos borrados
    echo ControladorMigracion::migracionDtTareas($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";
    echo ControladorMigracion::migracionDtCotizacion($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";// Con catagoria y plantilla faltantes
    echo ControladorMigracion::migracionDtPresupuestoInicial($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";

    //Traemos array: n_cotiza => id_cotizacion

    $array_info_global['n_cotiza|item=>id_cotizacion'] = ControladorInformacionGlobal::traeArrayIdCotizacion($conexion_migracion_prueba);

    echo ControladorMigracion::migraDtCostos($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";
    echo ControladorMigracion::migraDtDiseno($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";
    echo ControladorMigracion::migraDtProgramacionDiseno($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";
    echo ControladorFuncionesAuxiliares::creaTablaDtProgramacionDisenoOrdenes($conexion_migracion_prueba)."\n<br>";

    //Traemos array: n_programacion => id_programacion_diseno

    $array_info_global['n_programacion=>id_programacion_diseno'] = ControladorInformacionGlobal::traeArrayIdProgramacionDiseno($conexion_sio1);

    

    echo ControladorMigracion::migraDtEstructuraPDiseno($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";
    echo ControladorMigracion::migraDtHistoricoDiseno($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";

    //Traemos array: id_programacion_diseno|archivo => id_estructura_p_diseno

    $array_info_global['id_programacion_diseno=>fecha_ingreso'] = ControladorInformacionGlobal::traeArrayFechaEstructuraPDiseno($conexion_migracion_prueba);

    echo ControladorMigracion::migraDtHistoricoFt($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";
    echo ControladorMigracion::migraDtTareasCosto($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";

    

    //Traemos array: id_costo => data_costos

    $array_info_global['id_costo=>data_costos'] = ControladorInformacionGlobal::traeArrayDataCostos($conexion_migracion_prueba);

    //Traemos array: id_tipo_pago 

    $array_info_global['id_tipo_pago'] = ControladorInformacionGlobal::traeArrayTipoPago();

    echo ControladorMigracion::migraDtCompras($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";

    //Traemos array: n_compra|cod_producto => data_compras

    $array_info_global['n_compra|cod_producto=>data_compras'] = ControladorInformacionGlobal::traeArrayDataCompras($conexion_migracion_prueba);
 
    //Traemos array: id_costos => id_compras

    $array_info_global['id_costos=>id_compras'] = ControladorInformacionGlobal::traeArrayIdCompras($conexion_migracion_prueba);

    //Traemos array cuenta => id_pucs_oc

    $array_info_global['cuenta=>id_pucs_oc'] = ControladorInformacionGlobal::traeArrayIdPucsOc($conexion_migracion_prueba);

    echo ControladorMigracion::migraDtRotacion($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";
    echo ControladorMigracion::migraDtSolicitudGR($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";

    //Traemos array: n_solicitud => id_solicitud_g_r

    $array_info_global['n_solicitud=>id_solicitud_g_r'] = ControladorInformacionGlobal::traeArrayIdSolicitudGR($conexion_migracion_prueba);

    echo ControladorMigracion::migraDtHistoricoGR($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";
    


    //Traemos array nit => id_proveedores

    $array_info_global['nit=>id_proveedores'] = ControladorInformacionGlobal::traeArrayIdProveeNit($conexion_migracion_prueba);


    echo ControladorMigracion::migraDtFacturaProveedor($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";

    //Traemos array id_forma_pago

    $array_info_global['id_forma_pago'] = ControladorInformacionGlobal::traeArrayFormaPago();

    echo ControladorMigracion::migraDtFactura($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";
    echo ControladorFuncionesAuxiliares::creaTablasGarantia($conexion_migracion_prueba)."\n<br>";

    //Traemos array cod_prodTerm => id_orden

    $array_info_global['nOrden|referencia=>id_orden'] =  ControladorInformacionGlobal::traeArrayCodProdTerm($conexion_migracion_prueba);

    echo ControladorMigracion::migraDtRemision($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";

    //Traemos array id_check_list 

    $array_info_global['id_check_list'] = ControladorInformacionGlobal::traeArrayIdCheckList();
    

    echo ControladorMigracion::migraDtEntregables($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";

    echo ControladorMigracion::migraDtHistorialCostos($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";
    echo ControladorMigracion::migraDtHistoricoCierres($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";
    echo ControladorMigracion::migraDtTrazaOp($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";
    echo ControladorMigracion::migraDtHistoricoTareasCosto($conexion_sio1,$conexion_migracion_prueba,$array_info_global)."\n<br>";
    echo ControladorFuncionesAuxiliares::creaProcedimientosAlmacenados($conexion_migracion_prueba)."\n<br>";
    echo ControladorFuncionesAuxiliares::creaVistasBd($conexion_migracion_prueba)."\n<br>";
    echo ControladorFuncionesAuxiliares::implementaLlavesComplementarias($conexion_migracion_prueba)."\n<br>";
    



    $tiempo_fin = microtime(true);
    $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

    echo "\n<br>";
    echo "\n<br>";
    echo "*****************";
    echo "Ejecución completa! Alcanzada en ".$tiempo_transcurrido." segundos";
    echo "*****************";


?>