<?php

    class ControladorInformacionGlobal{

        public static function traeArrayCheckIca($conexion_sio1){

            $consulta_proveedores = $conexion_sio1->query("SELECT id_proveedor,descuento_ica  FROM dt_proveedores");

            $array_ica = $consulta_proveedores->fetchAll(PDO::FETCH_OBJ);

            $array_ica_reasignado = [];

            foreach($array_ica as $registro_prove){

                $array_ica_reasignado[$registro_prove->id_proveedor] = $registro_prove->descuento_ica;

            }

            return $array_ica_reasignado;

        }

        public static function traeArrayCodProdTerm($conexion_migracion_prueba){

            $consulta_ordenes = $conexion_migracion_prueba->query("SELECT n_ordenes,referencia,id_ordenes,cod FROM dt_ordenes");

            $array_ordenes_reasignado = [];

            while($registro_ordenes = $consulta_ordenes->fetch(PDO::FETCH_OBJ)){
                $array_ordenes_reasignado[$registro_ordenes->n_ordenes][$registro_ordenes->referencia] = $registro_ordenes->id_ordenes;
                if($registro_ordenes->cod != 0){
                    $array_ordenes_reasignado[$registro_ordenes->n_ordenes][trim($registro_ordenes->cod)] = $registro_ordenes->id_ordenes;
                }
            }

            return $array_ordenes_reasignado;

        }

        public static function traeArrayCodSubcategorias($conexion_sio1){

            $consulta_subcategorias = $conexion_sio1->query("SELECT nOrden,cod  FROM dt_subcategorias GROUP BY nOrden ");

            $array_subcategorias = $consulta_subcategorias->fetchAll(PDO::FETCH_OBJ);

            $array_subcategorias_reasignado = [];

            foreach($array_subcategorias as $registro_subcategorias){

                $array_subcategorias_reasignado[$registro_subcategorias->nOrden] = $registro_subcategorias->cod;

            }

            return $array_subcategorias_reasignado;


        }

        public static function traeArrayDataCompras($conexion_migracion_prueba){

            $consulta_compras = $conexion_migracion_prueba->query("SELECT cod_producto,n_compra,id_compras,id_ordenes,id_costos,n_ordenes,puc_id from dt_compras GROUP BY n_compra,cod_producto");

            $array_compras = $consulta_compras->fetchAll(PDO::FETCH_OBJ);

            $array_compras_reasignado = [];

            foreach($array_compras as $registro_compras){

                $array_compras_reasignado[$registro_compras->n_compra][$registro_compras->cod_producto] = [
                    'id_compras' => $registro_compras->id_compras,
                    'id_costos' => $registro_compras->id_costos,
                    'id_ordenes' => $registro_compras->id_ordenes,
                    'n_ordenes' => $registro_compras->n_ordenes,
                    'puc_id' => $registro_compras->puc_id
                    
                ];

            }

            return $array_compras_reasignado;


        }

        public static function traeArrayDataCostos($conexion_migracion_prueba){
            
            $consulta_costos = $conexion_migracion_prueba->query("SELECT id_costo,n_ordenes,id_ordenes FROM dt_costos");

            $array_costos_reasignado = [];

            while($registro_costos = $consulta_costos->fetch(PDO::FETCH_OBJ)){

                $array_costos_reasignado[$registro_costos->id_costo] = [
                    'n_ordenes' => $registro_costos->n_ordenes,
                    'id_ordenes' => $registro_costos->id_ordenes
                ];

            };

            return $array_costos_reasignado;

        }

        public static function traeDataCorreccionCodprodfinal($conexion_sio1){

            $consulta_dt_codprodfinal = $conexion_sio1->query("SELECT id_cod,tamX ,tamY,tamZ,tamL FROM dt_codprodfinal");

            $array_codprodfinal = $consulta_dt_codprodfinal->fetchAll(PDO::FETCH_OBJ);

            $array_codprodfinal_reasignado = [];

            foreach($array_codprodfinal as $registro_codprodfinal){

                $array_codprodfinal_reasignado[$registro_codprodfinal->id_cod] = [
                    'tamX' => $registro_codprodfinal->tamX,
                    'tamY' => $registro_codprodfinal->tamY,
                    'tamZ' => $registro_codprodfinal->tamZ,
                    'tamL' => $registro_codprodfinal->tamL,
                ];

            }

            return $array_codprodfinal_reasignado;

        }

        public static function traeArrayFechaEstructuraPDiseno($conexion_migracion_prueba){

            $consulta_historico_diseno = $conexion_migracion_prueba->query("SELECT fecha_registro,id_historico_diseno,id_programacion_diseno FROM dt_historico_diseno WHERE observacion = 'Nueva Planeacion'");

            $array_historico_diseno = $consulta_historico_diseno->fetchAll(PDO::FETCH_OBJ);

            $array_historico_diseno_reasignado = [];

            foreach($array_historico_diseno as $registro_historial){
                $array_historico_diseno_reasignado[$registro_historial->id_programacion_diseno]=[
                   'fecha_registro' => $registro_historial->fecha_registro,
                   'id_historico_diseno' => $registro_historial->id_historico_diseno
                ];
            }

            return $array_historico_diseno_reasignado;

        }

        public static function traeArrayFormaPago(){

            $array_forma_pago = [
                '30 d├¡as' => 29,
                'Contado' => 41,
                '60 d├¡as' => 31,
                '45 d├¡as' => 30,
                '15 d├¡as' => 40,
                '75 d├¡as' => null,
                '120 d├¡as' => null,
                '90 d├¡as' => 32,
                '30 DIAS' => 29,
                '60 DIAS' => 31,
                '90 dias' => 32
            ];

            return $array_forma_pago;

        }

        public static function traeArrayTipoPago(){

            $array_tipo_pago = [
                '120 dias' => null,
                '15 dias' => 3,
                '30' => 1,
                '30 dias' => 1,
                '45 dias' => 4,
                '60 dias' => 5,
                '90 dias' => 7,
                'Canje' => 6,
                'Contado' => 2
            ];
            
            return $array_tipo_pago;

        }

        public static function traeArrayIdAcabados($conexion_sio1){

            $consulta_acabados = $conexion_sio1->query("SELECT id_acabado,cod FROM dt_acabados");

            $array_acabados = $consulta_acabados->fetchAll(PDO::FETCH_OBJ);

            $array_acabados_reasignado = [];

            foreach($array_acabados as $registro_acabados){
                $array_acabados_reasignado[$registro_acabados->cod] = $registro_acabados->id_acabado;
            }

            return $array_acabados_reasignado;
        }

        public static function traeArrayIdArea(){
            $array_areas = [
                'ADMINISTRACION' => 1,
                'ALMACEN' => 12,
                'AREA ADMINISTRACION' => 1,
                'AREA FINANCIERA' => 24,
                'ASISTENTE FINANCIERA' => 24,
                'ASISTENTE GERENCIA GENERAL' => 1,
                'AUXILIAR DE PRODUCCION' => 11,
                'BODEGAJE' => 12,
                'COMERCIAL' => 23,
                'COMPRAS' => 10,
                'CONDUCTOR' => 8,
                'CONTABILIDAD' => 25,
                'CONTRATISTA' => 11,
                'CONTRATISTA DIS' => 22,
                'CONTRATISTA DISE├æO' => 22,
                'CONTRATISTA ENSAMBLE Y TERMIN' => 16,
                'CONTRATISTA INSTALACION' => 7,
                'CONTRATISTAS ENS' => 16,
                'CONTRATISTAS ENSAMBLE' => 16,
                'CONTRATISTAS ENSAMBLE Y TERMIN' => 16,
                'CONTRATISTAS METAL' => 13,
                'CONTRATISTAS METALMECANICA' => 13,
                'CONTRATISTAS PIN' => 14,
                'CONTRATISTAS PINTURA' => 14,
                'CONTRATISTAS SUS' => 15,
                'CONTRATISTAS SUSTRATOS' => 15,
                'COORDINACION ADMINISTRATIVA' => 1,
                'COORDINADOR' => 20,
                'COORDINADOR PROYECTOS' => 20,
                'CORTE CNC ESKO BLANDOS' => 15,
                'CORTE CNC MULTICAM RIGIDOS' => 15,
                'CORTE DE LAMINA' => 13,
                'COSTOS' => 21,
                'DECORACION' => 18,
                'DESPACHOS' => 19,
                'DISE├æO' => 22,
                'DISE├æO Y DESARROLLO' => 22,
                'DOCUMENTACION' => 1,
                'DOBLADO' => 13,
                'ENSAMBLE Y TERMINADO' => 16,
                'FINANCIERA' => 24,
                'GERENCIA COMERCIAL' => 23,
                'GERENCIA DE DESARROLLO' => 11,
                'GERENCIA DE PRODUCCION' => 11,
                'GERENCIA DE PRODUCCION Y LOGIS' => 11,
                'GERENCIA DE PRODUCCION Y LOGISTICA' => 11,
                'GERENCIA FINANCIERA' => 24,
                'GERENCIA GENERAL' => 5,
                'GESTION DE HSE' => 6,
                'GESTION DE TALENTO HUMANO' => 6,
                'IMPRESION DIGITAL' => 17,
                'PRODUCCION DE IMPRESION' => 17,
                'INSTALACION' => 7,
                'LASER' => 15,
                'LOGISTICA' => 9,
                'MADERAS' => 15,
                'MANTENIMIENTO MAQUINARIA' => 11,
                'MANTENIMIENTO TECNOLOGICO' => 4,
                'MEJORAMIENTO DE PROCESOS' => 11,
                'METALMECANICA' => 13,
                'OFICINA LOGISTICA' => 9,
                'OFICINA PRODUCCION' => 11,
                'OTROS CONTRATISTAS' => 11,
                'OTROS DIRECTOS' => 11,
                'PERSONAL RETIRADO' => 0,
                'PINTURA' => 14,
                'PINTURA LIQUIDA' => 14,
                'PUNZONADO' => 0,
                'SERIGRAFIA Y/O SCREEN' => 14,
                'SUB GERENCIA GENERAL' => 5,
                'SUPERVISOR PRODUCCION' => 11,
                'SUSTRATOS' => 15,
                'TERCEROS' => 26,
                'TRASFORMACION DE PLASTICOS' => 15,
                'VENTAS CARTAGENA' => 23,
                'VENTAS CONTRATISTAS' => 23,
                'VENTAS DANIEL' => 23,
                'VENTAS GERENCIA' => 23,
                'VENTAS GP1' => 23,
                'VENTAS GP2' => 23,
                'VENTAS GP3' => 23,
                'VENTAS GP4' => 23,
                'VENTAS GP5' => 23,
                'VENTAS GP6 LICITACIONES' => 3,
                'VENTAS GP7' => 23,
                'VENTAS GP8' => 23,
                'VENTAS KATERIN' => 23,
                'VENTAS MARIA DEL PILAR' => 23,
                'VENTAS REINALDO' => 23,
                'VENTAS SIN APORTE' => 23,
                'ViVaS' => 1,
                'VIATICOS' => 8,
            ];

            return $array_areas;

        }

        public static function traeArrayIdCheckList(){

            $array_checklist = [
                '13ZF TRANSPORTE RECOGER TERCEROS' => 13,
                '14ZF VISITA TECNICA' => 8,
                'ACABADOS' => null,
                'ACABADOS (APROBACI├ôN)' => null,
                'ACTA DE ENTREGA' => 41,
                'ACTA FINAL' => 41,
                'ANTICIPO' => 26,
                'ARCHIVOS' => 9,
                'ARTE FINAL APROBADO POR EL CLIENTE' => 35,
                'ARTE GUIA SUMINISTRADO POR EL CLIENTE' => 34,
                'ARTES FINALES' => 35,
                'ARTES FINALES (APROBACI├ôN)' => 35,
                'AUTORIZACION POR ESCRITO CON OK JEFE' => 19,
                'AVAL TENICO, ECOMOMICO Y FECHAS DE ENTREGA' => 20,
                'AVANCE 2' => 28,
                'AVANCE 3' => 29,
                'AVANCE 4' => 30,
                'AVANCES DE OBRA' => 27, 
                'CARTA BODEGA' => null,
                'CERFICADO APORTES PARAFISCALES' => 68,
                'CERTIFICADO DEL MIN TRABAJO' => 66,
                'COBRO BODEGA' => null,
                'CODIGOS' => 44,
                'COLORES APROBADOS POR EL CLIENTE' => 37,
                'COLORES EN ESTUDIO POR EL CLIENTE' => 36,
                'COMIT├ë T├ëCNICO DE CIERRE' => 7,
                'COMIT├ë T├ëCNICO DE INICIO' => 1,
                'COMIT├ë T├ëCNICO DE INICIO LOGISTICA' => 2,
                'CONTRATO' => 18,
                'CREDITO VIGENTE' => null,
                'CUENTA DE COBRO' => null,
                'DESARROLLO PARA LA PRODUCCION' => null,
                'DETALLES EST├ëTICOS' => null,
                'DETALLES EST├ëTICOS (APROBACI├ôN)' => null,
                'DIMENSIONES' => null,
                'DIMENSIONES (APROBACI├ôN)' => null,
                'EMPAQUE DE LA MUESTRA' => null,
                'EMPAQUE DE LA MUESTRA (APROBACI├ôN)' => null,
                'ENCUESTA DE SATISFACCION' => 42,
                'FACTURADO AL 100%' => 32,
                'FECHAS A FACTURAR' => 31,
                'FOTOS PRODUCTO INSTALADO' => null,
                'FUNCIONAMIENTO' => null,
                'FUNCIONAMIENTO (APROBACI├ôN)' => null,
                'IMPLANTACI├ôN' => null,
                'IMPLANTACI├ôN (APROBACI├ôN)' => null,
                'LOGO CORPORATIVO' => null,
                'MODELO DE COMPROBACI├ôN (PROPORCIONES/TAMA├æOS)' => null,
                'MODELO DE COMPROBACI├ôN (PROPORCIONES/TAMA├æOS) (APROBACI├ôN)' => null,
                'MODELO ESTETICO (ACABADOS)' => null,
                'MODELO ESTETICO (ACABADOS) (APROBACI├ôN)' => null,
                'MODELO FUNCIONAL (USO)' => null,
                'MODELO FUNCIONAL (USO) (APROBACI├ôN)' => null,
                'MUESTRA ACCESORIOS' => 39,
                'MUESTRA ACCESORIOS (APROBACI├ôN)' => 40,
                'MUESTRA APROBADA POR EL CLIENTE' => 40,
                'MUESTRA DE COLOR' => 39,
                'MUESTRA DE COLOR (APROBACI├ôN)' => 40,
                'MUESTRA DE IMPRESI├ôN (APROBACI├ôN)' => 39,
                'MUESTRA EN EVALUACION POR EL CLIENTE' => 39,
                'MUESTRA EN PROCESO DE PRODUCCION' => 38,
                'MUESTRA HERRAJERIA' => 38,
                'MUESTRA HERRAJERIA (APROBACI├ôN)' => 40,
                'MUESTRAS' => 38,
                'MUESTRAS DE MATERIALES' => 38,
                'MUESTRAS DE MATERIALES (APROBACI├ôN)' => 40,
                'MUESTRAS DE VINILOS' => 38,
                'MUESTRAS DE VINILOS (APROBACI├ôN)' => 40,
                'OC' => 17,
                'OTROS' => 13,
                'PAGO DEL FIC' => 67,
                'PANTONES' => null,
                'PAZ Y SALVO INSTALADORES Y NOMINA' => null,
                'PEGUES DE MATERIAL' => null,
                'PEGUES DE MATERIAL (APROBACI├ôN)' => null,
                'PERMISOS' => null,
                'POLIZA DE CALIDAD' => 23,
                'POLIZA DE CUMPLIMIENTO' => 22,
                'POLIZA DE NOMINA' => 24,
                'POLIZA DE RESPOSABILIDAD CIVIL' => 25,
                'POLIZAS BUEN MANEJO DE ANTICIPO' => 21,
                'PROPUESTA DISE├æO' => null,
                'PRORROGA DE POLIZA' => null,
                'PROTOTIPO ESCALA REAL' => null,
                'PROTOTIPO ESCALA REAL (APROBACI├ôN)' => null,
                'PRUEBA DE FACTIBILIDAD' => null,
                'PRUEBA DE FACTIBILIDAD (APROBACI├ôN)' => null,
                'RECAUDADO AL 100%' => 33,
                'REGISTRO DAMA' => 45,
                'SECCI├ôN DEL PRODUCTO (COMPROBACI├ôN)' => null,
                'SECCI├ôN DEL PRODUCTO (COMPROBACI├ôN) (APROBACI├ôN)' => null,
                'UBICACI├ôN DEL PRODUCTO (FOTOMONTAJE)' => 54,
                'UBICACI├ôN DEL PRODUCTO (FOTOMONTAJE) (APROBACI├ôN)' => 54,
                'VISUALIZACI├ôN (FOTOMONTAJE, ESQUEMA ├ô RENDER)' => 54,
                'VISUALIZACI├ôN (FOTOMONTAJE, ESQUEMA ├ô RENDER) (APROBACI├ôN)' => 54
            ];

            return $array_checklist;

        }

        public static function traeArrayIdCliente($conexion_migracion_prueba){

            $consulta_clientes = $conexion_migracion_prueba->query("SELECT id_cliente,nit from dt_clientes");

            $array_clientes = $consulta_clientes->fetchAll(PDO::FETCH_OBJ);

            $array_clientes_reasignado = [];

            foreach($array_clientes as $registro_cliente){
                $array_clientes_reasignado[$registro_cliente->nit] =['id_cliente' => $registro_cliente->id_cliente];
            }

            return $array_clientes_reasignado;

        }

        public static function traeArrayIdCodprodfinal($conexion_sio1){

            $dt_codprodfinal_sio1 = $conexion_sio1->prepare("SELECT id_cod,nom_grupo,cod,tamX,tamY,tamZ,tamL FROM dt_codprodfinal");

            $dt_codprodfinal_sio1->execute();
        
            $array_pdo_codprodfinal = $dt_codprodfinal_sio1->fetchAll(PDO::FETCH_OBJ);

            $array_codprodfinal_reasignado = [];

            foreach($array_pdo_codprodfinal as $registro_codprodfinal){

                $cod = rtrim($registro_codprodfinal->cod);

                $array_codprodfinal_reasignado[$cod] = [
                    'id_cod'=>$registro_codprodfinal->id_cod,
                    'nom_grupo'=>$registro_codprodfinal->nom_grupo,
                    'x' => $registro_codprodfinal->tamX,
                    'y' => $registro_codprodfinal->tamY,
                    'z' => $registro_codprodfinal->tamZ,
                    'l' => $registro_codprodfinal->tamL
                ];

                //Hacemos un array con minuscula en la última letra porque el bebé de costos le gusta poner mayusculas y minusculas en los códigos
                
                $ultima_letra = strtolower(substr($cod,-1));
                if(ctype_alpha($ultima_letra)){
                    $longitud = strlen($cod);
                    $resto_del_codigo = substr($cod, 0, $longitud - 1);
                    $cod = $resto_del_codigo.$ultima_letra;
                    $array_codprodfinal_reasignado[$cod] = [
                        'id_cod'=>$registro_codprodfinal->id_cod,
                        'nom_grupo'=>$registro_codprodfinal->nom_grupo,
                        'x' => $registro_codprodfinal->tamX,
                        'y' => $registro_codprodfinal->tamY,
                        'z' => $registro_codprodfinal->tamZ,
                        'l' => $registro_codprodfinal->tamL
                    ];
                }
                
            }

            return $array_codprodfinal_reasignado;

        }

        public static function traeArrayIdCompras($conexion_migracion_prueba){

            $consulta_compras = $conexion_migracion_prueba->query("SELECT id_compras,id_costos FROM dt_compras");

            $array_compras_reasignado = [];

            while($registro_compras = $consulta_compras->fetch(PDO::FETCH_OBJ)){

                $array_compras_reasignado[$registro_compras->id_costos] = $registro_compras->id_compras;

            }

            return $array_compras_reasignado;


        }

        public static function traeArrayIdCotizacion($conexion_migracion_prueba){

            $consulta_cotizacion = $conexion_migracion_prueba->query("SELECT id_cotizacion,n_cotiza,item FROM dt_cotizacion");

            $array_cotizacion = $consulta_cotizacion->fetchAll(PDO::FETCH_OBJ);

            $array_cotizacion_reasignado = [];

            foreach($array_cotizacion as $registro_cotizacion){

                $array_cotizacion_reasignado[$registro_cotizacion->n_cotiza][$registro_cotizacion->item] = ['id_cotizacion' => $registro_cotizacion->id_cotizacion];

            } 

            return $array_cotizacion_reasignado;

        }

        public static function traeArrayIdInventario($conexion_migracion_prueba){

            $consulta_inventario = $conexion_migracion_prueba->query("SELECT id_inventario,codigo_prod,id_medida,producto FROM dt_inventario");

            $consulta_inventario = $consulta_inventario->fetchAll(PDO::FETCH_OBJ);

            $array_inventario_reasignado = [];

            foreach($consulta_inventario as $registro_inventario){

                $array_inventario_reasignado[$registro_inventario->codigo_prod] = [
                    'id_inventario' => $registro_inventario->id_inventario,
                    'id_medida' => $registro_inventario->id_medida,
                    'producto' => $registro_inventario->producto
                ];

            }


            return $array_inventario_reasignado;

        }

        public static function traeArrayIdOrdenes($conexion_migracion_prueba){

            $consulta_ordenes = $conexion_migracion_prueba->query("SELECT id_ordenes,n_ordenes,item_op,id_coordinador,id_usuario,id_categoria  FROM dt_ordenes WHERE n_ordenes is NOT NULL");

            $array_ordenes = $consulta_ordenes->fetchAll(PDO::FETCH_OBJ);

            $array_ordenes_reasignado = [];
            
            foreach($array_ordenes as $registro_ordenes){

                $array_ordenes_reasignado[$registro_ordenes->n_ordenes][$registro_ordenes->item_op] =[
                    'id_ordenes' => $registro_ordenes->id_ordenes,
                    'id_coordinador' => $registro_ordenes->id_coordinador,
                    'id_usuario' => $registro_ordenes->id_usuario,
                    'id_categoria' => $registro_ordenes->id_categoria
                ];

                $array_ordenes_reasignado['lista_id_ordenes'][]= $registro_ordenes->id_ordenes;

            } 

            return $array_ordenes_reasignado;

        }

        public static function traeArrayIdProgramacionDiseno($conexion_sio1){

            $consulta_programacion_diseno = $conexion_sio1->query("
            SELECT id_programacion_diseno,n_programacion  from dt_programacion_diseno
            group by n_programacion");

            $array_programacion_diseno = $consulta_programacion_diseno->fetchAll(PDO::FETCH_OBJ);

            $array_programacion_diseno_reasignado = [];


            foreach($array_programacion_diseno as $registro_programacion_diseno){

                $array_programacion_diseno_reasignado[$registro_programacion_diseno->n_programacion] = $registro_programacion_diseno->id_programacion_diseno;

            }

            return $array_programacion_diseno_reasignado;

        }

        public static function traeArrayIdProveedores($conexion_migracion_prueba){

            $consulta_proveedores = $conexion_migracion_prueba->query("SELECT id_proveedores,empresa  FROM dt_proveedores");

            $array_proveedores = $consulta_proveedores->fetchAll(PDO::FETCH_OBJ);

            $array_proveedores_reasignado = [];

            foreach($array_proveedores as $registro_proveedores){
                $array_proveedores_reasignado[$registro_proveedores->empresa] = $registro_proveedores->id_proveedores;
            }

            return $array_proveedores_reasignado;

        }

        public static function traeArrayIdProveeNit($conexion_migracion_prueba){

            $consulta_proveedores = $conexion_migracion_prueba->query("SELECT id_proveedores,nit  FROM dt_proveedores");

            $array_proveedores = $consulta_proveedores->fetchAll(PDO::FETCH_OBJ);

            $array_proveedores_reasignado = [];

            foreach($array_proveedores as $registro_proveedores){
                $array_proveedores_reasignado[$registro_proveedores->nit] = $registro_proveedores->id_proveedores;
            }

            return $array_proveedores_reasignado;

        }

        public static function traeArrayIdPucsOc($conexion_migracion_prueba){

            $consulta_pucs_oc = $conexion_migracion_prueba->query("SELECT cuenta,id_pucs_oc  FROM dt_pucs_oc dpo ");

            $array_pucs_oc = $consulta_pucs_oc->fetchAll(PDO::FETCH_OBJ);

            $array_pucs_oc_reasignado = [];

            foreach($array_pucs_oc as $registro_puc_oc){

                $array_pucs_oc_reasignado[$registro_puc_oc->cuenta] = $registro_puc_oc->id_pucs_oc;

            }

            return $array_pucs_oc_reasignado;

        }

        public static function traeArrayIdSolicitudGR($conexion_migracion_prueba){

            $consulta_solicitud_g_r = $conexion_migracion_prueba->query("SELECT id_solicitud_g_r,n_solicitud FROM dt_solicitud_g_r GROUP BY n_solicitud");

            $array_solicitud_g_r = $consulta_solicitud_g_r->fetchAll(PDO::FETCH_OBJ);

            $array_solicitud_g_r_reasignado = [];

            foreach($array_solicitud_g_r as $registro_solicitud_g_r){

                $array_solicitud_g_r_reasignado[$registro_solicitud_g_r->n_solicitud] = $registro_solicitud_g_r->id_solicitud_g_r;

            }

            return $array_solicitud_g_r_reasignado;

        }

        public static function traeArrayGruposDiseno(){

            $array_grupos_diseno = [
                'Costos' => 1,
                'ComiteTec' => 2,
                'Terc1' => 3,
                'Terc2' => 4,
                'Terc3' => 5,
                'Metal' => 6,
                'cnc' => 7,
                'maderas' => 8,
                'plasticos' => 9,
                'pintura' => 10,
                'imprdec' => 11,
                'ensamble' => 12,
                'instalacion' => 13
            ];

            return $array_grupos_diseno;

        }

        public static function traeArrayMedidas($conexion_migracion_prueba){

            $consulta_medidas = $conexion_migracion_prueba->query("SELECT * FROM dt_medida");
 
            $array_medidas = $consulta_medidas->fetchAll(PDO::FETCH_OBJ);
 
            $array_medidas_reasignado = [];
 
            foreach($array_medidas as $registro_medida){
 
                 $array_medidas_reasignado[trim($registro_medida->medida)] = $registro_medida->id_medida;
 
            }
 
            return $array_medidas_reasignado;
             
        }

        public static function traeArrayTipoScript(){
            $array_tipo_script = [
                'ENSAM.LONA' => 1,
                'MET.ESTRUCTURA' => 2,
                'ENSAM.ESTRUCTURA' => 3,
                'TER.INS' => 4,
                'TER.TERMO' => 5,
                'TER.LETRARMCONESP' => 6,
                'TER.LETRARMSINESP' => 7,
                'TER.MET' => 8,
                'TER.PINL' => 9,
                'TER.ENSAM' => 10,
                'XPROXIMO' => 11,
                'NOCANTIDAD' => 12,
                'RANGOT8' => 13,
                'RANGBALASTO' => 14,
                'LEDSXFUENTE' => 15,
                'LEDSXFUENTERANGO' => 16,
                'LETRAARMADAILU' => 17,
                'LETRAARMADA' => 18
            ];

            return $array_tipo_script;
        }

        public static function traeArrayUser($conexion_sio1,$conexion_migracion_prueba,$opcion_conversión){

            $consulta_vendedores =  $conexion_sio1->query("SELECT id_vend,codVendedor,vendedor FROM dt_vendedores");

            $array_vendedores = $consulta_vendedores->fetchAll(PDO::FETCH_OBJ);

            $array_vendedores_reasignado = [];

            if($opcion_conversión == 1){ //vendedor
                foreach($array_vendedores as $registro_vendedor){

                    $array_vendedores_reasignado[$registro_vendedor->id_vend] = rtrim($registro_vendedor->vendedor);
    
                }
            }
            elseif($opcion_conversión == 2){ //codVendedor
                foreach($array_vendedores as $registro_vendedor){

                    $array_vendedores_reasignado[$registro_vendedor->id_vend] = $registro_vendedor->codVendedor;
    
                }
            }else{
                echo "No existe esta opción, solo hay 1 o 2";exit;
            }
            


            $consulta_user = $conexion_migracion_prueba->query("SELECT id,id_empleado FROM user");

            $array_user = $consulta_user->fetchAll(PDO::FETCH_OBJ);

            $array_user_reasignado = [];

            foreach($array_user as $registro_user){

                if($registro_user->id_empleado == 1){continue;}

                $codVendedor = $array_vendedores_reasignado[$registro_user->id_empleado];

                $array_user_reasignado[$codVendedor] = $registro_user->id;

            }

            return $array_user_reasignado;

        }


    }

?>