<?php

    class ControladorInformacionGlobal{

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

        public static function traeArrayIdCotizacion($conexion_migracion_prueba){

            $consulta_cotizacion = $conexion_migracion_prueba->query("SELECT id_cotizacion,n_cotiza,item FROM dt_cotizacion");

            $array_cotizacion = $consulta_cotizacion->fetchAll(PDO::FETCH_OBJ);

            $array_cotizacion_reasignado = [];

            foreach($array_cotizacion as $registro_cotizacion){

                $array_cotizacion_reasignado[$registro_cotizacion->n_cotiza][$registro_cotizacion->item] = ['id_cotizacion' => $registro_cotizacion->id_cotizacion];

            } 

            return $array_cotizacion_reasignado;

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

                    $array_vendedores_reasignado[$registro_vendedor->id_vend] = $registro_vendedor->vendedor;
    
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