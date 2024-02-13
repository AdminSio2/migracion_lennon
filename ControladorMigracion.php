<?php

    include 'ControladorInformacionGlobal.php';
    require 'ControladorFuncionesAuxiliares.php';


    class ControladorMigracion{

        public static function migraDtAcabados($conexion_sio1,$conexion_migracion_prueba,$array_info_global){
           //Inicia timer

           $tiempo_inicio = microtime(true);
           
           //Consultamos dt_acabados en Sio 1

           $consulta_dt_acabados = $conexion_sio1->query("
            SELECT id_acabado,cod,acabado,tipo,clase,grupo,medida,unidadMin,
            vr_hora_hombre,xMin,xMax,yMin,yMax  from dt_acabados  order by id_acabado
           ");
           $array_dt_acabados = $consulta_dt_acabados->fetchAll(PDO::FETCH_OBJ);

           //Creamos la tabla sin llave primaria auto incremental 

           $conexion_migracion_prueba->exec("
            CREATE TABLE `dt_acabados` (
                `id_acabados` int,
                `cod` varchar(250) NOT NULL,
                `acabado` varchar(800) NOT NULL,
                `id_tipo_costo` int NOT NULL,
                `id_clase_costo` int NOT NULL,
                `id_area` int NOT NULL,
                `id_medida` int NOT NULL,
                `unidad_minima` float DEFAULT NULL,
                `vr_hora_hombre` float DEFAULT NULL,
                `x_min` float DEFAULT NULL,
                `x_max` float DEFAULT NULL,
                `y_min` float DEFAULT NULL,
                `y_max` float DEFAULT NULL
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3
           ");
           
            //Algun genio los dejó colocar las medidas a mano, hay que re asignarlas a los ids correctos

            $array_medidas_mal_insertadas =[
                'HR/MT2' => 19,
                'HR/UNID' => 22,
                'HR/MT L' => 21,
                'MTL' => 21,
                'UND' => 22,
                'UNI' => 22
            ];

            

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
                'CONTRATISTA ENSAMBLE Y TERMIN' => 16,
                'CONTRATISTA INSTALACION' => 7,
                'CONTRATISTAS ENS' => 16,
                'CONTRATISTAS ENSAMBLE Y TERMIN' => 16,
                'CONTRATISTAS METAL' => 13,
                'CONTRATISTAS METALMECANICA' => 13,
                'CONTRATISTAS PIN' => 14,
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

            $array_medidas = $array_info_global['medidas=>id_medida'];

            $registros_insertados = 0;
            $conexion_migracion_prueba->beginTransaction();

            foreach($array_dt_acabados as $registro_dt_acabados){

                try{

                    if(array_key_exists($registro_dt_acabados->medida,$array_medidas)){
                        $id_medida = $array_medidas[$registro_dt_acabados->medida];
                    }elseif(array_key_exists($registro_dt_acabados->medida,$array_medidas_mal_insertadas)){
                        $id_medida = $array_medidas_mal_insertadas[$registro_dt_acabados->medida];
                    }else{
                        $id_medida = 0;
                    }

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_acabados(id_acabados,cod,acabado,id_tipo_costo,id_clase_costo,id_area,id_medida,unidad_minima,vr_hora_hombre,x_min,
                        x_max,y_min,y_max) VALUES(:id_acabados,:cod,:acabado,:id_tipo_costo,:id_clase_costo,:id_area,:id_medida,:unidad_minima,:vr_hora_hombre,
                        :x_min,:x_max,:y_min,:y_max)
                    ");

                    $insert_registro->execute([
                        'id_acabados' => $registro_dt_acabados->id_acabado,
                        'cod' => $registro_dt_acabados->cod,
                        'acabado' => $registro_dt_acabados->acabado,
                        'id_tipo_costo' => $registro_dt_acabados->tipo,
                        'id_clase_costo' => $registro_dt_acabados->clase != null?$registro_dt_acabados->clase:0,
                        'id_area' => array_key_exists($registro_dt_acabados->grupo,$array_areas)?$array_areas[$registro_dt_acabados->grupo]:0,
                        'id_medida' => $id_medida,
                        'unidad_minima' => $registro_dt_acabados->unidadMin,
                        'vr_hora_hombre' => $registro_dt_acabados->vr_hora_hombre,
                        'x_min' => $registro_dt_acabados->xMin,
                        'x_max' => $registro_dt_acabados->xMax,
                        'y_min' => $registro_dt_acabados->yMin,
                        'y_max' => $registro_dt_acabados->yMax
                    ]);

                    $registros_insertados++;
                    
                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollback();
                    echo "Error en el id_acabado: ".$registro_dt_acabados->id_acabado."<br>".$e->getMessage();exit;
                }

            }//FIN foreach($array_dt_acabados as $registro_dt_acabados)

            $conexion_migracion_prueba->commit();
            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_acabados
                MODIFY id_acabados INT AUTO_INCREMENT PRIMARY KEY
            ");

            // Finaliza timer y entregamos mensaje 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_acabados completada ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos";

            return $mensaje;

        }

        public static function migraDtInventarioxarea($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Inicia timer

            $tiempo_inicio = microtime(true);

            //Consultamos dt_inventarioxarea del SIo 1 que es nuestra fuente

            $consulta_dt_inventarioxarea = $conexion_sio1->query("
                SELECT id_inventxarea,codigo_prod,producto,stock_area,nomArea  from dt_inventarioxarea
            ");

            $array_dt_inventarioxarea = $consulta_dt_inventarioxarea->fetchAll(PDO::FETCH_OBJ);

            //Creamos la tabla sin llave primaria autoincremental 

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_inventarioxarea` (
                `id_inventarioxarea` int,
                `codigo_prod` varchar(80) NOT NULL,
                `stock` float NOT NULL,
                `id_inventario` int NOT NULL,
                `id_area` int NOT NULL,
                KEY `fk_dt_inventarioxarea_dt_area1` (`id_area`),
                KEY `fk_dt_inventarioxarea_dt_inventario1` (`id_inventario`),
                CONSTRAINT `fk_dt_inventarioxarea_dt_area1` FOREIGN KEY (`id_area`) REFERENCES `dt_area` (`id_area`),
                CONSTRAINT `fk_dt_inventarioxarea_dt_inventario1` FOREIGN KEY (`id_inventario`) REFERENCES `dt_inventario` (`id_inventario`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ");

            $array_areas = $array_info_global['id_area'];
            $array_materiales = $array_info_global['codigo_prod=>id_inventario'];
            
            $registros_insertados = 0;
            $conexion_migracion_prueba->beginTransaction();

        
            foreach($array_dt_inventarioxarea as $registro_dt_inventarioxarea){

                try{ 

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_inventarioxarea(id_inventarioxarea,codigo_prod,stock,id_inventario,id_area)
                        VALUES(:id_inventarioxarea,:codigo_prod,:stock,:id_inventario,:id_area)
                    ");
                    $insert_registro->execute([
                        'id_inventarioxarea' => $registro_dt_inventarioxarea->id_inventxarea,
                        'codigo_prod' => $registro_dt_inventarioxarea->codigo_prod,
                        'stock' => $registro_dt_inventarioxarea->stock_area != null ?$registro_dt_inventarioxarea->stock_area:0,
                        'id_inventario' => array_key_exists($registro_dt_inventarioxarea->codigo_prod,$array_materiales)?$array_materiales[$registro_dt_inventarioxarea->codigo_prod]['id_inventario']:1,
                        'id_area' => array_key_exists($registro_dt_inventarioxarea->nomArea,$array_areas)?$array_areas[$registro_dt_inventarioxarea->nomArea]:0
                    ]); 

                    

                    $registros_insertados++;

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollback();
                    echo "Error en el id_inventarioxarea: ".$registro_dt_inventarioxarea->id_inventxarea."<br>".$e->getMessage();exit;
                }

            } //FIN foreach($array_dt_inventarioxarea as $registro_dt_inventarioxarea)

            $conexion_migracion_prueba->commit();

            //Asignamos la llave primaria con autoincremental 

            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_inventarioxarea
                MODIFY id_inventarioxarea INT AUTO_INCREMENT PRIMARY KEY
            ");

            // Finaliza timer y entregamos mensaje 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_inventarioxarea completada ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos";

            return $mensaje;


        }

        public static function migraDtUsuariosUser($conexion_sio1,$conexion_migracion_prueba){

            //Inicia timer

            $tiempo_inicio = microtime(true);

            //Consultamos dt_vendedores que es nuestra fuente para ambas tablas
            $consulta_dt_vendedores = $conexion_sio1->prepare("
                SELECT 
                id_vend,vendedor,Alias,dirVend,telVend,celularVend,emailVend,aplicaHoras,
                huella,cedula,area,ingresoVend,fechaNac,EPSEntidad,pensionEntidad,cesantias,
                cuenta,banco,sexo,rh,fechaRetiro,empresaTemp,activacion,estCivil,ciudadVend,ArchivoFunciones,
                tallaZapato,tallaCamisa,tallaZapato,tallaCamisa,tallaPantalon,elementos,nom_emerg,tel_emerg,
                imagen 
                from dt_vendedores order by id_vend
            ");
            $consulta_dt_vendedores->execute();

            $array_dt_vendedores = $consulta_dt_vendedores->fetchAll(PDO::FETCH_OBJ);

            //Creamos las tablas sin llave primaria auto incremental

            $conexion_migracion_prueba->exec("
            CREATE TABLE `dt_usuarios` (
                `id_usuario` int NOT NULL,
                `nombre_usuario` varchar(80) NOT NULL COMMENT 'nombre usuario',
                `apellido_usuario` varchar(80) NOT NULL COMMENT 'apellido usuario',
                `alias` varchar(80) DEFAULT NULL,
                `direccion_usuario` varchar(100) DEFAULT NULL COMMENT 'direccion usuario',
                `telefono_usuario` varchar(50) DEFAULT NULL COMMENT 'telefono usuario',
                `celular_usuario` varchar(50) DEFAULT NULL COMMENT 'celular usuario',
                `email_usuario` varchar(76) DEFAULT NULL COMMENT 'email usuario',
                `horas_extra` smallint DEFAULT '0',
                `huella` int DEFAULT '0' COMMENT 'huella biometrica del usuario',
                `cedula` varchar(12) NOT NULL COMMENT 'cédula unica del usuario',
                `id_area` int DEFAULT NULL COMMENT 'llave foranea del area del usuario',
                `fecha_ingreso_usuario` date DEFAULT NULL COMMENT 'fecha de ingreso del usuario',
                `id_cargo` int DEFAULT NULL COMMENT 'llave foranea del cargo del usuario',
                `id_tipo_empleado` smallint DEFAULT NULL,
                `fecha_nacimiento_usuario` date NOT NULL COMMENT 'fecha de nacimiento del usuario',
                `salario` varchar(80) DEFAULT NULL COMMENT 'salario del usuario',
                `eps_entidad` varchar(80) DEFAULT NULL,
                `pension_entidad` varchar(80) DEFAULT NULL,
                `cesantias` varchar(80) DEFAULT NULL,
                `cuenta` varchar(80) DEFAULT NULL,
                `banco` varchar(80) DEFAULT NULL,
                `id_horario` int DEFAULT NULL,
                `sexo` char(1) DEFAULT NULL,
                `rh` tinyint NOT NULL,
                `fecha_retiro` date DEFAULT NULL,
                `empresa_temporal` varchar(80) DEFAULT NULL,
                `activacion` char(1) DEFAULT '1',
                `fecha_activacion` date DEFAULT NULL,
                `id_estado_civil` int DEFAULT NULL,
                `id_ciudad` int DEFAULT NULL,
                `archivo` longtext,
                `talla_zapato` varchar(80) DEFAULT NULL,
                `talla_camisa` varchar(80) DEFAULT NULL,
                `talla_pantalon` varchar(80) DEFAULT NULL,
                `elementos_seguridad` varchar(200) DEFAULT NULL,
                `jefe_area` int DEFAULT '0',
                `contacto_emergencia` varchar(180) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
                `tel_emergencia` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
                `parentesco_emergencia` smallint DEFAULT NULL,
                `religion` smallint DEFAULT NULL,
                `imagen` text,
                `id_geografia` int DEFAULT NULL,
                KEY `id_ciudad` (`id_ciudad`),
                KEY `id_area` (`id_area`),
                KEY `id_horario` (`id_horario`),
                KEY `id_cargo` (`id_cargo`),
                KEY `id_estado_civil` (`id_estado_civil`),
                KEY `id_geografia` (`id_geografia`),
                CONSTRAINT `dt_usuarios_ibfk_1` FOREIGN KEY (`id_geografia`) REFERENCES `dt_geografia` (`id_geografia`)
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
            ");

            $conexion_migracion_prueba->exec("
                CREATE TABLE `user` (
                `id` int NOT NULL AUTO_INCREMENT,
                `id_empleado` int NOT NULL,
                `username` varchar(255) NOT NULL,
                `nombre_usuario` varchar(100) DEFAULT NULL,
                `auth_key` varchar(32) NOT NULL,
                `password_hash` varchar(255) NOT NULL,
                `confirmation_token` varchar(255) DEFAULT NULL,
                `status` int NOT NULL DEFAULT '1',
                `superadmin` smallint DEFAULT '0',
                `created_at` int NOT NULL,
                `updated_at` int NOT NULL,
                `registration_ip` varchar(15) DEFAULT NULL,
                `bind_to_ip` varchar(255) DEFAULT NULL,
                `email` varchar(128) DEFAULT NULL,
                `email_confirmed` smallint NOT NULL DEFAULT '0',
                `token` varchar(200) DEFAULT NULL,
                `id_usuario_encargado` int DEFAULT NULL,
                PRIMARY KEY (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8mb3;
            ");

            

            // echo "<pre>";
            // var_dump($array_dt_vendedores);exit;

            // dt_areas solo para vendedores

            $areas_vendedores =[
                'ADMINISTRACION' => 1,
                'ALMACEN' => 12,
                'AREA ADMINISTRACION' => 1,
                'AREA FINANCIERA' => 24,
                'ASISTENTE FINANCIERA' => 24,
                'ASISTENTE GERENCIA GENERAL' => 1,
                'AUXILIAR DE PRODUCCION' => 11,
                'COMERCIAL' => 23,
                'COMPRAS' => 10,
                'CONDUCTOR' => 8,
                'CONTABILIDAD' => 25,
                'CONTRATISTA' => 11,
                'CONTRATISTA DIS' => 22,
                'CONTRATISTA ENSAMBLE Y TERMIN' => 16,
                'CONTRATISTA INSTALACION' => 7,
                'CONTRATISTAS ENS' => 16,
                'CONTRATISTAS ENSAMBLE Y TERMIN' => 16,
                'CONTRATISTAS METAL' => 13,
                'CONTRATISTAS METALMECANICA' => 13,
                'CONTRATISTAS PIN' => 14,
                'CONTRATISTAS SUS' => 15,
                'CONTRATISTAS SUSTRATOS' => 15,
                'COORDINACION ADMINISTRATIVA' => 1,
                'COORDINADOR' => 20,
                'COORDINADOR PROYECTOS' => 20,
                'CORTE CNC ESKO BLANDOS' => 15,
                'COSTOS' => 21,
                'DECORACION' => 18,
                'DESPACHOS' => 19,
                'DISE├æO' => 22,
                'DISE├æO Y DESARROLLO' => 22,
                'ENSAMBLE Y TERMINADO' => 16,
                'FINANCIERA' => 24,
                'GERENCIA COMERCIAL' => 23,
                'GERENCIA DE DESARROLLO' => 11,
                'GERENCIA DE PRODUCCION' => 11,
                'GERENCIA DE PRODUCCION Y LOGIS' => 11,
                'GERENCIA FINANCIERA' => 24,
                'GERENCIA GENERAL' => 5,
                'GESTION DE HSE' => 6,
                'GESTION DE TALENTO HUMANO' => 6,
                'IMPRESION DIGITAL' => 17,
                'INSTALACION' => 7,
                'JEFE DE PRODUCCION' => 11,
                'LOGISTICA' => 9,
                'MADERAS' => 15, // No habrá ni creo que haya más adelante esta área la asigno a sustratos
                'MANTENIMIENTO MAQUINARIA' => 11,
                'MANTENIMIENTO TECNOLOGICO' => 4,
                'MEJORAMIENTO DE PROCESOS' => 11,
                'METALMECANICA' => 13,
                'OFICINA LOGISTICA' => 9,
                'OFICINA PRODUCCION' => 11,
                'OTROS CONTRATISTAS' => 11,
                'PERSONAL RETIRADO' => 0,
                'PINTURA' => 14,
                'PINTURA LIQUIDA' => 14,
                'SERIGRAFIA Y/O SCREEN' => 14,
                'SUB GERENCIA GENERAL' => 5,
                'SUPERVISOR PRODUCCION' => 11,
                'SUSTRATOS' => 15,
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
                'ViVaS' => 1
            ];

            //sexo

            $array_sexo = [
                'M' => 1,
                'F' => 2
            ];

            //Usuarios repetidos 

            $array_usuarios_repetidos =[685,813,853,687,693,1416,648,727,280,686,666,615,789,658,820,401,
            796,672,661,662,812,684,668,673,88,403,404,414,440,649,656,667,792,847,1276,1421];
      

            //Usuarios con caracteristicas particulares para el formato de nombres

            $tres_palabras_comienza_apellido=[81,85,86,121,148,163,169,184,214,216,224,226,227,230,234,
                260,265,283,289,322,330,334,339,346,349,354,362,364,366,367,369,371,381,382,392,402,404,
                410,423,425,426,431,433,441,457,458,460,462,463,464,467,473,485,489,490,497,506,512,514,528,
                531,533,535,536,539,545,546,556,561,563,568,581,587,588,590,599,600,605,609,610,611,614,
                621,629,635,636,637,644,645,648,649,653,658,661,662,663,668,673,687,696,707,719,726,727,
                744,747,754,757,768,770,782,790,809,814,817,825,840,843,845,849,853,858,863,877,896,924,
                940,950,952,960,976,1027,1028,1031,1038,1046,1068,1074,1077,1081,1088,1105,1113,1120,1121,
                1135,1144,1146,1149,1152,1154,1156,1165,1171,1173,1203,1204,1218,1229,1231,1243,1248,1253,
                1260,1265,1274,1277,1278,1279,1281,1289,1292,1309,1312,1317,1323,1329,1330,1335,1345,1352,
                1361,1364,1406,1426,1431,1445,1448];


            $no_persona = [2,276,1403,1396,1403];

            $cuatro_palabras_comienza_nombre = [119,192,202,240,262,263,266,267,268,269,271,272,273,274,
                278,293,294,295,298,299,300,301,302,303,304,305,308,309,311,312,313,314,318,323,327,329,333,
                336,347,385,386,391,396,399,400,406,408,412,414,416,418,419,432,434,436,437,439,440,448,
                454,459,469,828,866,1397,1449];

            $cinco_palabras_comienza_nombre = [173,264,292,321,337,398,428,445,484];

            //Antes de ingresar el resto de usuarios vamos a crear el Superadmin en las 2 tablas

            $conexion_migracion_prueba->beginTransaction();

            try{

                $insert_super_usuario_dt_usuarios = $conexion_migracion_prueba->prepare("INSERT INTO dt_usuarios(id_usuario,nombre_usuario,apellido_usuario,alias,direccion_usuario,telefono_usuario,
                celular_usuario,email_usuario,horas_extra,huella,cedula,id_area,fecha_ingreso_usuario,id_cargo,id_tipo_empleado,fecha_nacimiento_usuario,
                salario,eps_entidad,pension_entidad,cesantias,cuenta,banco,id_horario,sexo,rh,fecha_retiro,empresa_temporal,activacion,fecha_activacion,
                id_estado_civil,id_ciudad,archivo,talla_zapato,talla_camisa,talla_pantalon,elementos_seguridad,jefe_area,contacto_emergencia,tel_emergencia,
                parentesco_emergencia,religion,imagen,id_geografia) VALUES(:id_usuario,:nombre_usuario,:apellido_usuario,:alias,:direccion_usuario,:telefono_usuario,
                :celular_usuario,:email_usuario,:horas_extra,:huella,:cedula,:id_area,:fecha_ingreso_usuario,:id_cargo,:id_tipo_empleado,:fecha_nacimiento_usuario,
                :salario,:eps_entidad,:pension_entidad,:cesantias,:cuenta,:banco,:id_horario,:sexo,:rh,:fecha_retiro,:empresa_temporal,:activacion,:fecha_activacion,
                :id_estado_civil,:id_ciudad,:archivo,:talla_zapato,:talla_camisa,:talla_pantalon,:elementos_seguridad,:jefe_area,:contacto_emergencia,:tel_emergencia,
                :parentesco_emergencia,:religion,:imagen,:id_geografia)");

                $insert_super_usuario_dt_usuarios->execute([
                    'id_usuario' => 1,
                    'nombre_usuario' => 'ADMINISTRADOR', 
                    'apellido_usuario' => 'ADMIN',
                    'alias' => 'ADMIN',
                    'direccion_usuario' => '',
                    'telefono_usuario' => '',
                    'celular_usuario' => 123456789,
                    'email_usuario' => '123@saviv.net',
                    'horas_extra' => 0,
                    'huella' => 0,
                    'cedula' => 0,
                    'id_area' => 12,
                    'fecha_ingreso_usuario' => '0000-00-00',
                    'id_cargo' => 12,
                    'id_tipo_empleado' => 1,
                    'fecha_nacimiento_usuario' => '0000-00-00',
                    'salario' => 'Vm0wd2VFMUdiRmRpUm1SWFYwZG9WRmx0ZUV0V01WbDNXa1pPVlUxV2NIcFdNakZIVm1zeFYySkVUbGho',
                    'eps_entidad' => '',
                    'pension_entidad' => '',
                    'cesantias' => '',
                    'cuenta' => '',
                    'banco' => '',
                    'id_horario' => 24,
                    'sexo' => 1,
                    'rh' => 3,
                    'fecha_retiro' => '0000-00-00',
                    'empresa_temporal' => '',
                    'activacion' => 1,
                    'fecha_activacion' => null,
                    'id_estado_civil' => 1,
                    'id_ciudad' => 41,
                    'archivo' => '',
                    'talla_zapato' => '',
                    'talla_camisa' => '',
                    'talla_pantalon' => '',
                    'elementos_seguridad' => '',
                    'jefe_area' => 0,
                    'contacto_emergencia' => null,
                    'tel_emergencia' => null,
                    'parentesco_emergencia' => 1,
                    'religion' => 1,
                    'imagen' => 'perfil_usuario/logo-saviv.png',
                    'id_geografia' => 1283

                ]);

                $insert_super_usuario_user = $conexion_migracion_prueba->prepare("
                    INSERT INTO user(id_empleado,username,nombre_usuario,auth_key,password_hash,confirmation_token,status,
                    superadmin,created_at,updated_at,registration_ip,bind_to_ip,email,email_confirmed,token,id_usuario_encargado)
                    VALUES(:id_empleado,:username,:nombre_usuario,:auth_key,:password_hash,:confirmation_token,:status,
                    :superadmin,:created_at,:updated_at,:registration_ip,:bind_to_ip,:email,:email_confirmed,:token,:id_usuario_encargado)
                ");
                $insert_super_usuario_user->execute([
                    ':id_empleado' => 1,
                    ':username' => 'superadmin',
                    ':nombre_usuario' => 'ADMIN SIO',
                    ':auth_key' => 'aR_8HO8OgnExJ9QEluWlIv4w6bYvvwGt',
                    ':password_hash' => '$2y$13$CkI8ekcDodc7X3F8UlUppOMA69qvPQXpMgQWsZGfIvJUkKMUOwY4C',
                    ':confirmation_token' => null,
                    ':status' => 1,
                    ':superadmin' => 1,
                    ':created_at' => 0,
                    ':updated_at' => '1620063235',
                    ':registration_ip' => null,
                    ':bind_to_ip' => null,
                    ':email' => 'saviv3@saviv.net',
                    ':email_confirmed' => 0,
                    ':token' => null,
                    ':id_usuario_encargado' => null
                ]);

            }catch(PDOException $e){
                $conexion_migracion_prueba->rollBack();
                echo "Fallo al ingresar Super admin"."<br>".$e->getMessage();exit;
            }

            $conexion_migracion_prueba->commit();
        

            //Luego migramos todo el resto de usuarios

            $conexion_migracion_prueba->beginTransaction();

            $registros_insertados = 0;

            foreach($array_dt_vendedores as $registro_dt_vendedores){

                try{ 

                    //Reemplazamos caracteres extraños 

                    if(strpos($registro_dt_vendedores->vendedor, '├æ') !== false){
                        $vendedor_nombre_completo = str_replace('├æ', 'Ñ', $registro_dt_vendedores->vendedor);
                    }
                    elseif(strpos($registro_dt_vendedores->vendedor, '├ô') !== false){
                        $vendedor_nombre_completo = str_replace('├ô', 'Ó', $registro_dt_vendedores->vendedor);
                    }
                    elseif(strpos($registro_dt_vendedores->vendedor, '├ì') !== false){
                        $vendedor_nombre_completo = str_replace('├ì', 'Í', $registro_dt_vendedores->vendedor);
                    }
                    else{
                        $vendedor_nombre_completo = $registro_dt_vendedores->vendedor;
                    }


                    $array_string_nombre = str_word_count($vendedor_nombre_completo,1,'ÑÓÍ');
                    $numero_pablabras_nombre = count($array_string_nombre);

                    

                    $username = $vendedor_nombre_completo;

                    

                    if($numero_pablabras_nombre == 1 || in_array($registro_dt_vendedores->id_vend, $no_persona)){
                        $nombre_usuario = 'NO PERSONA';
                        $apellido_usuario = $vendedor_nombre_completo;
                        $username = 'NO PERSONA';
                    }elseif($numero_pablabras_nombre == 2){
                        $nombre_usuario = end($array_string_nombre);
                        $apellido_usuario = $array_string_nombre[0];
                        $username = strtolower($array_string_nombre[0]).".".strtolower($array_string_nombre[1]);//Para la tabla user
                    }elseif($numero_pablabras_nombre == 3){
                        if(in_array($registro_dt_vendedores->id_vend, $tres_palabras_comienza_apellido)){
                            $nombre_usuario = end($array_string_nombre);
                            $apellido_usuario = $array_string_nombre[0]." ".$array_string_nombre[1];
                            $username = strtolower($nombre_usuario).".".strtolower($array_string_nombre[0]);
                        } 
                        else{
                            $nombre_usuario = $array_string_nombre[0];
                            $apellido_usuario = $array_string_nombre[1]." ".$array_string_nombre[2];
                            $username = strtolower($nombre_usuario).".".strtolower($array_string_nombre[1]);
                        }
                    }elseif($numero_pablabras_nombre == 4){
                        if(in_array($registro_dt_vendedores->id_vend, $cuatro_palabras_comienza_nombre)){
                            $nombre_usuario = $array_string_nombre[0]." ".$array_string_nombre[1];
                            $apellido_usuario = $array_string_nombre[2]." ".$array_string_nombre[3];
                            $username = strtolower($array_string_nombre[0]).".".strtolower($array_string_nombre[2]);
                        }else{
                            $nombre_usuario = $array_string_nombre[2]." ".$array_string_nombre[3];
                            $apellido_usuario = $array_string_nombre[0]." ".$array_string_nombre[1];
                            $username = strtolower($array_string_nombre[2]).".".strtolower($array_string_nombre[0]);
                        }
                    }elseif($numero_pablabras_nombre == 5){
                        if(in_array($registro_dt_vendedores->id_vend, $cinco_palabras_comienza_nombre)){
                            $nombre_usuario = $array_string_nombre[0]." ".$array_string_nombre[1];
                            $apellido_usuario = $array_string_nombre[2]." ".$array_string_nombre[3].$array_string_nombre[4];
                            $username = strtolower($array_string_nombre[0]).".".strtolower($array_string_nombre[2]);
                        }else{
                            $nombre_usuario = $array_string_nombre[3]." ".$array_string_nombre[4];
                            $apellido_usuario = $array_string_nombre[0].$array_string_nombre[1]." ".$array_string_nombre[2];
                            $username = strtolower($array_string_nombre[3]).".".strtolower($array_string_nombre[0]);
                        }
                    }elseif($numero_pablabras_nombre == 6){
                        $nombre_usuario = $array_string_nombre[4]." ".$array_string_nombre[5];
                        $apellido_usuario = $array_string_nombre[0]." ".$array_string_nombre[1]." ".$array_string_nombre[2]." ".$array_string_nombre[3];
                        $username = strtolower($array_string_nombre[4]).".".strtolower($array_string_nombre[0]);
                    }
                    else{
                        $nombre_usuario = $vendedor_nombre_completo;
                        $apellido_usuario = $numero_pablabras_nombre;
                    }

                    if(in_array($registro_dt_vendedores->id_vend,$array_usuarios_repetidos)){
                        $alias = "USUARIO REPETIDO";
                        $activacion = 0;
                        $repetido = true;
                    }else{
                        $alias = $registro_dt_vendedores->Alias;
                        $activacion = $registro_dt_vendedores->activacion;
                        $repetido = false;
                    }

                    $id_area = array_key_exists($registro_dt_vendedores->area,$areas_vendedores)?$areas_vendedores[$registro_dt_vendedores->area]:null;

                    $sexo = array_key_exists($registro_dt_vendedores->sexo,$array_sexo)?$array_sexo[$registro_dt_vendedores->sexo]:null;

                    //Insertamos registro dt_usuarios

                    $insert_registro = $conexion_migracion_prueba->prepare("INSERT INTO dt_usuarios(id_usuario,nombre_usuario,apellido_usuario,alias,direccion_usuario,telefono_usuario,
                    celular_usuario,email_usuario,horas_extra,huella,cedula,id_area,fecha_ingreso_usuario,id_cargo,id_tipo_empleado,fecha_nacimiento_usuario,
                    salario,eps_entidad,pension_entidad,cesantias,cuenta,banco,id_horario,sexo,rh,fecha_retiro,empresa_temporal,activacion,fecha_activacion,
                    id_estado_civil,id_ciudad,archivo,talla_zapato,talla_camisa,talla_pantalon,elementos_seguridad,jefe_area,contacto_emergencia,tel_emergencia,
                    parentesco_emergencia,religion,imagen,id_geografia) VALUES(:id_usuario,:nombre_usuario,:apellido_usuario,:alias,:direccion_usuario,:telefono_usuario,
                    :celular_usuario,:email_usuario,:horas_extra,:huella,:cedula,:id_area,:fecha_ingreso_usuario,:id_cargo,:id_tipo_empleado,:fecha_nacimiento_usuario,
                    :salario,:eps_entidad,:pension_entidad,:cesantias,:cuenta,:banco,:id_horario,:sexo,:rh,:fecha_retiro,:empresa_temporal,:activacion,:fecha_activacion,
                    :id_estado_civil,:id_ciudad,:archivo,:talla_zapato,:talla_camisa,:talla_pantalon,:elementos_seguridad,:jefe_area,:contacto_emergencia,:tel_emergencia,
                    :parentesco_emergencia,:religion,:imagen,:id_geografia)");
                    $insert_registro->execute([
                        'id_usuario' => $registro_dt_vendedores->id_vend,
                        'nombre_usuario' => $nombre_usuario, 
                        'apellido_usuario' => $apellido_usuario,
                        'alias' => $alias,
                        'direccion_usuario' => $registro_dt_vendedores->dirVend,
                        'telefono_usuario' => $registro_dt_vendedores->telVend,
                        'celular_usuario' => $registro_dt_vendedores->celularVend,
                        'email_usuario' => $registro_dt_vendedores->emailVend,
                        'horas_extra' => $registro_dt_vendedores->aplicaHoras,
                        'huella' => $registro_dt_vendedores->huella,
                        'cedula' => $registro_dt_vendedores->cedula != null? $registro_dt_vendedores->cedula:0,
                        'id_area' => $id_area,
                        'fecha_ingreso_usuario' => $registro_dt_vendedores->ingresoVend,
                        'id_cargo' => null,
                        'id_tipo_empleado' => null,
                        'fecha_nacimiento_usuario' => $registro_dt_vendedores->fechaNac,
                        'salario' => null,
                        'eps_entidad' => $registro_dt_vendedores->EPSEntidad,
                        'pension_entidad' => $registro_dt_vendedores->pensionEntidad,
                        'cesantias' => $registro_dt_vendedores->cesantias,
                        'cuenta' => $registro_dt_vendedores->cuenta,
                        'banco' => $registro_dt_vendedores->banco,
                        'id_horario' => 24,
                        'sexo' => $sexo,
                        'rh' => $registro_dt_vendedores->rh,
                        'fecha_retiro' => $registro_dt_vendedores->fechaRetiro,
                        'empresa_temporal' => $registro_dt_vendedores->empresaTemp,
                        'activacion' => $activacion,
                        'fecha_activacion' => null,
                        'id_estado_civil' => $registro_dt_vendedores->estCivil,
                        'id_ciudad' => 41,
                        'archivo' => $registro_dt_vendedores->ArchivoFunciones,
                        'talla_zapato' => $registro_dt_vendedores->tallaZapato,
                        'talla_camisa' => $registro_dt_vendedores->tallaCamisa,
                        'talla_pantalon' => $registro_dt_vendedores->tallaPantalon,
                        'elementos_seguridad' => $registro_dt_vendedores->elementos,
                        'jefe_area' => 0,
                        'contacto_emergencia' => $registro_dt_vendedores->nom_emerg,
                        'tel_emergencia' => $registro_dt_vendedores->tel_emerg,
                        'parentesco_emergencia' => null,
                        'religion' => null,
                        'imagen' => $registro_dt_vendedores->imagen,
                        'id_geografia' => 1283

                    ]);

                    //Insertamos registro user 

                    $insert_registro2 = $conexion_migracion_prueba->prepare("
                        INSERT INTO user(id_empleado,username,nombre_usuario,auth_key,password_hash,confirmation_token,status,
                        superadmin,created_at,updated_at,registration_ip,bind_to_ip,email,email_confirmed,token,id_usuario_encargado)
                        VALUES(:id_empleado,:username,:nombre_usuario,:auth_key,:password_hash,:confirmation_token,:status,
                        :superadmin,:created_at,:updated_at,:registration_ip,:bind_to_ip,:email,:email_confirmed,:token,:id_usuario_encargado)
                    ");
                    $insert_registro2->execute([
                        ':id_empleado' => $registro_dt_vendedores->id_vend,
                        ':username' => $repetido?'USUARIO.REPETIDO':$username,
                        ':nombre_usuario' => $nombre_usuario." ".$apellido_usuario,
                        ':auth_key' => 0,
                        ':password_hash' => 0,
                        ':confirmation_token' => null,
                        ':status' => $activacion,
                        ':superadmin' => 0,
                        ':created_at' => $registro_dt_vendedores->ingresoVend != null? $registro_dt_vendedores->ingresoVend:'0000-00-00',
                        ':updated_at' => '0000-00-00',
                        ':registration_ip' => null,
                        ':bind_to_ip' => null,
                        ':email' => strstr(!$registro_dt_vendedores->emailVend,'saviv')?$registro_dt_vendedores->emailVend:'sincorreocorporativo@saviv.net',
                        ':email_confirmed' => strstr(!$registro_dt_vendedores->emailVend,'saviv')?1:0,
                        ':token' => null,
                        ':id_usuario_encargado' => null
                    ]);

                    $registros_insertados++;

                    }catch(PDOException $e){
                        $conexion_migracion_prueba->rollBack();
                        echo "Error en el id_vend: ".$registro_dt_vendedores->id_vend."<br>".$e->getMessage();exit;
                }
            }//FIN foreach($array_dt_vendedores as $registro_dt_vendedores)

            $conexion_migracion_prueba->commit();

            //Asignamos nuevamente llave primaria con autoincremental 

            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_usuarios
                MODIFY id_usuario INT AUTO_INCREMENT PRIMARY KEY
            ");

            //Finaliza timer 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            //Entregamos mensaje 

            $mensaje = "Migración dt_usuarios y user completada ".$registros_insertados." registros insertados en las 2 tablas, en ".$tiempo_transcurrido." segundos";

            return $mensaje;

            

        }

        public static function migraDtProyectoOp($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Iniciamos timer

            $tiempo_inicio = microtime(true);
            

            //Hacemos el array con la información del Sio 1

            $consulta_dt_proyecto_op = $conexion_sio1->query("
                SELECT id_proyecto_op,nombre_proyecto,fecha,estado,obs_proyecto,
                usuario,id_macro_proyecto from dt_proyecto_op
            ");

            $array_dt_proyecto_op = $consulta_dt_proyecto_op->fetchAll(PDO::FETCH_OBJ);

            //Creamos la tabla sin la llave primaria

            $conexion_migracion_prueba->exec("

                CREATE TABLE `dt_proyecto_op` (
                `id_proyecto_op` int,
                `nombre_proyecto` varchar(150) NOT NULL,
                `fecha` datetime(6) NOT NULL,
                `estado` char(1) NOT NULL DEFAULT '0',
                `obs_proyecto` varchar(256) DEFAULT NULL,
                `id_user` int NOT NULL,
                `id_macro_proyecto` int DEFAULT NULL,
                `id_geografia` int DEFAULT NULL,
                `id_ciudad` int DEFAULT NULL,
                KEY `fk_dt_proyecto_op_user1` (`id_user`),
                KEY `fk_dt_proyecto_op_dt_macro_proyecto1` (`id_macro_proyecto`),
                KEY `dt_proyecto_op_dt_geografia_fk` (`id_geografia`),
                KEY `id_ciudad` (`id_ciudad`) USING BTREE,
                CONSTRAINT `dt_proyecto_op_dt_geografia_fk` FOREIGN KEY (`id_geografia`) REFERENCES `dt_geografia` (`id_geografia`),
                CONSTRAINT `fk_dt_proyecto_op_dt_macro_proyecto1` FOREIGN KEY (`id_macro_proyecto`) REFERENCES `dt_macro_proyecto` (`id_macro_proyecto`),
                CONSTRAINT `fk_dt_proyecto_op_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

            ");

            $registros_insertados = 0;

            $conexion_migracion_prueba->beginTransaction();

            foreach($array_dt_proyecto_op as $registro_proyecto_op){

                try{

                    $nombre_proyecto = $registro_proyecto_op->nombre_proyecto;

                    //Reemplazamos caracteres extraños para la Ñ,Ó y Í

                    if(strpos($nombre_proyecto, '├ü') !== false){
                        $nombre_proyecto = str_replace('├ü', 'Á', $nombre_proyecto);
                    }
                    elseif(strpos($nombre_proyecto, '├▒') !== false){
                        $nombre_proyecto = str_replace('├▒', 'ñ', $nombre_proyecto);
                    }
                    elseif(strpos($nombre_proyecto, '├æ') !== false){
                        $nombre_proyecto = str_replace('├æ', 'Ñ', $nombre_proyecto);
                    }
                    elseif(strpos($nombre_proyecto, '├│') !== false){
                        $nombre_proyecto = str_replace('├│', 'ó', $nombre_proyecto);
                    }
                    elseif(strpos($nombre_proyecto, '├ô') !== false){
                        $nombre_proyecto = str_replace('├ô', 'Ó', $nombre_proyecto);
                    }
                    elseif(strpos($nombre_proyecto, '├¡') !== false){
                        $nombre_proyecto = str_replace('├¡', 'í', $nombre_proyecto);
                    }
                    elseif(strpos($nombre_proyecto, '├ì') !== false){
                        $nombre_proyecto = str_replace('├ì', 'Í', $nombre_proyecto);
                    }
                    
                    //Traemos el id_user

                    $id_user = array_key_exists($registro_proyecto_op->usuario,$array_info_global['codVendedor=>id'])?$array_info_global['codVendedor=>id'][$registro_proyecto_op->usuario]:1;


                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_proyecto_op(id_proyecto_op,nombre_proyecto,fecha,obs_proyecto,id_user,id_macro_proyecto,id_geografia,
                        id_ciudad) VALUES(:id_proyecto_op,:nombre_proyecto,:fecha,:obs_proyecto,:id_user,:id_macro_proyecto,:id_geografia,:id_ciudad)
                    ");
                    $insert_registro->execute([
                        'id_proyecto_op' => $registro_proyecto_op->id_proyecto_op,
                        'nombre_proyecto' => $nombre_proyecto,
                        'fecha' => $registro_proyecto_op->fecha,
                        'obs_proyecto' => $registro_proyecto_op->obs_proyecto,
                        'id_user' => $id_user,
                        'id_macro_proyecto' => $registro_proyecto_op->id_macro_proyecto,
                        'id_geografia' => null,
                        'id_ciudad' => null
                    ]);

                    $registros_insertados++;
                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "Hay un problema con el id_proyecto_op ".$registro_proyecto_op->id_proyecto_op."<br>".$e->getMessage();exit;
                }

            }//FIN foreach($array_dt_proyecto_op as $registro_proyecto_op)

            $conexion_migracion_prueba->commit();

            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_proyecto_op
                MODIFY id_proyecto_op INT AUTO_INCREMENT PRIMARY KEY
            ");

            //Finalizamos timer 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            //Entregamos mensajes 

            $mensaje = "Migración dt_proyectos_op completada ".$registros_insertados." registros insertados  en ".$tiempo_transcurrido." segundos";

            return $mensaje;

        }

        public static function migraDtOrdenes($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            $tiempo_inicio = microtime(true);

            //Solo para probar conexiones

            // $ordenes_consulta = $conexion_migracion_prueba->query("SELECT * FROM dt_clientes limit 10");

            // $ordenes_array = $ordenes_consulta->fetchAll(PDO::FETCH_OBJ);

            // echo "<pre>";
            // var_dump($ordenes_array);exit;

            //Hacemos la consulta completa a la tabla que vamos a migrar, solo columnas a migrar 

            $consulta_dt_ordenes = $conexion_sio1->query("
                SELECT 
                id_orden,referencia ,var66,modulo,cobro,nit_op,ref_general,
                descripcionItem ,cantidad,item_op,id_cot,elaboro,idVend,aprobado,tamanoX,
                tamanoY,tamanoZ,vUnidad,vTotal,id_proyecto_op,id_Coordinador,nOrden,ArchivoSCOD,
                nit_op,a_pvo,u_pvo,cotizacion,item_ct,conciliado,
                fechaIngreso,fechaNotas,fechaAprobacion,fechaAutorizacion,fechaFT,fechaCostos,fechaIdeal,
                fechaBodegaje,fechaTransIns,fechaInstalacion,fechaFInstalacion,fechaIngresoOP,
                fecha_conciliacion_new
                from dt_ordenes order by id_orden  
            ");

            $array_dt_ordenes = $consulta_dt_ordenes->fetchAll(PDO::FETCH_OBJ);

            //echo "<pre>";var_dump($array_dt_ordenes);exit;

            //Creamos las tabla dt_ordenes sin llave primarias ni acutoincremental

            $conexion_migracion_prueba->exec("

                CREATE TABLE `dt_ordenes` (
                `id_ordenes` int,
                `referencia` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
                `cod` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
                `id_codprodfinal` int DEFAULT NULL,
                `id_subcategoria` int DEFAULT NULL,
                `id_categoria` int DEFAULT NULL,
                `cobro` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL COMMENT '1 = Si , 0 = No',
                `id_cliente` int DEFAULT NULL,
                `ref_general` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
                `localizacion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
                `cantidad` float DEFAULT NULL,
                `item_op` int DEFAULT NULL,
                `id_cotizacion` int DEFAULT NULL,
                `id_usuario` int DEFAULT NULL,
                `id_vend` int DEFAULT NULL,
                `estado` int DEFAULT NULL,
                `tam_x` varchar(30) DEFAULT NULL,
                `tam_y` varchar(30) DEFAULT NULL,
                `tam_z` varchar(30) DEFAULT NULL,
                `tam_l` varchar(30) DEFAULT NULL,
                `v_unidad` DECIMAL(10, 2) DEFAULT NULL, 
                `v_total` DECIMAL(10, 2) DEFAULT NULL,
                `nombre_proyecto` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci,
                `id_coordinador` int DEFAULT NULL,
                `n_ordenes` int NOT NULL,
                `archivo` varchar(556) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
                `elaboro` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
                `idvend` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
                `coordinador` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
                `nit` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
                `id_orden` int DEFAULT NULL,
                `a_pvo` char(1) DEFAULT NULL,
                `id_cot` int DEFAULT NULL,
                `u_pvo` char(1) DEFAULT NULL,
                `id_proyecto_op` int DEFAULT NULL,
                `cotizacion` varchar(10) DEFAULT NULL,
                `item_ct` int DEFAULT NULL,
                `conciliado` smallint DEFAULT '0',
                KEY `dt_codprodfinal1` (`id_codprodfinal`),
                KEY `dt_subcategoria1` (`id_subcategoria`),
                KEY `dt_clientes1` (`id_cliente`),
                KEY `dt_cotizacion1` (`id_cotizacion`),
                KEY `dt_usuarios1` (`id_usuario`),
                KEY `dt_ordenes_dt_proyecto_op_fk` (`id_proyecto_op`),
                KEY `indx_n_ordenes` (`n_ordenes`),
                CONSTRAINT `dt_ordenes_dt_proyecto_op_fk` FOREIGN KEY (`id_proyecto_op`) REFERENCES `dt_proyecto_op` (`id_proyecto_op`)
                ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3;

            "); 
            
            
            $conexion_migracion_prueba->exec("

                CREATE TABLE `dt_fechas_op` (
                `id_fechas_op` int NOT NULL AUTO_INCREMENT,
                `id_ordenes` int NOT NULL,
                `fecha_ingreso` datetime DEFAULT NULL,
                `fecha_contractual` datetime DEFAULT NULL,
                `fecha_aprobacion_admi` datetime DEFAULT NULL,
                `fecha_aprobacion_cli` datetime DEFAULT NULL,
                `fecha_ft` datetime DEFAULT NULL,
                `fecha_gantt` datetime DEFAULT NULL,
                `fecha_costos` datetime DEFAULT NULL,
                `fecha_produccion` datetime DEFAULT NULL,
                `fecha_bodegaje` datetime DEFAULT NULL,
                `fecha_trans_inst` datetime DEFAULT NULL,
                `fecha_instalacion` datetime DEFAULT NULL,
                `fecha_finstalacion` datetime DEFAULT NULL,
                `fecha_registro` datetime DEFAULT NULL,
                `id_usuario` varchar(30) DEFAULT NULL,
                `fecha_conciliacion` datetime DEFAULT NULL,
                `id_orden` int DEFAULT NULL,
                PRIMARY KEY (`id_fechas_op`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

            ");

            
            //Consultamos las tablas fuente con los datos que necesitamos

            //dt_codprodfinal

            $array_codprodfinal = $array_info_global['cod=>id_codpdrodfinal'];

            

            //dt_cliente 

            

            $array_clientes = $array_info_global['nit=>id_cliente'];


            //id_proyecto_op que fueron borrados de la fuenta en el Sio 1
        
            $array_id_proyecto_faltan = [1,3,14,17,125,224,230,274,386,413,414,418,419,420,443,503,599,619];

            $conexion_migracion_prueba->beginTransaction();

            $registros_insertados = 0;

            // echo "<pre";
            // var_dump($array_user_cod);exit;
            

            foreach($array_dt_ordenes as $registro_dt_ordenes){

                try{
                    //Buscamos id_codprodfinal

                        if($registro_dt_ordenes->var66 != null && array_key_exists($registro_dt_ordenes->var66, $array_codprodfinal)){
                            $var66 = rtrim($registro_dt_ordenes->var66); //eliminamos espacios luego de la cadena
                            $id_codprodfinal = $array_codprodfinal[$var66]['id_cod'];
                        }else{
                            $id_codprodfinal = null;
                            $var66 = null;
                        }


                    //Buscamos subcategoría

                    $subcategorias = [
                        'EZT'=>2,
                        'DEP'=>1,
                        'INS'=>3,
                        'VEX'=>4,
                        'GRT'=>6,
                        'RPC'=>5,
                        'DGT'=>7,
                        'RGC'=>8,
                        'MOB'=>9,
                        'OPC'=>10
                    ];

                    if(array_key_exists($registro_dt_ordenes->modulo, $subcategorias) && $registro_dt_ordenes->modulo != null){
                        $id_subcategoria = $subcategorias[$registro_dt_ordenes->modulo];
                    }else{
                        $id_subcategoria = null;
                    }

                    //Buscamos categoria 

                    $categorias = [  //Según codprodfinal
                        'ADICIONALES'=>6,
                        'AVISOS'=>1,
                        'CONTABLE'=>0,
                        'MOBILIARIO'=>4,
                        'P.O.P'=>2,
                        'Se├▒alizaci├│n'=>3,
                        'SE├æALIZACI├ôN'=>3,
                        'SE├æALIZACION'=>3,
                        'SERVICIOS'=>5,
                    ];

                    if($id_codprodfinal != null){

                        if(array_key_exists($array_codprodfinal[$registro_dt_ordenes->var66]['nom_grupo'], $categorias)){
                            $id_categoria = $categorias[$array_codprodfinal[$registro_dt_ordenes->var66]['nom_grupo']];
                        }else{
                            $id_categoria = null;
                        }

                    }else{$id_categoria = null;}

                    //Buscamos id_cliente

                    if($registro_dt_ordenes->nit_op && array_key_exists($registro_dt_ordenes->nit_op,$array_clientes)){
                        $id_cliente = $array_clientes[$registro_dt_ordenes->nit_op]['id_cliente'];
                    }else{
                        $id_cliente = null;
                    }

                    //Asignamos el cobro

                    $cobro = $registro_dt_ordenes->cobro != null ? $registro_dt_ordenes->cobro:0;

                    //Asignamos id_usuario 

                    $elaboro = rtrim($registro_dt_ordenes->elaboro);

                    $id_usuario = array_key_exists($elaboro ,$array_info_global['vendedor=>id'])?$array_info_global['vendedor=>id'][$elaboro]:null;
                    
                    $id_vend = array_key_exists($registro_dt_ordenes->idVend,$array_info_global['codVendedor=>id'])?$array_info_global['codVendedor=>id'][$registro_dt_ordenes->idVend]:null;

                    $id_coordinador = array_key_exists($registro_dt_ordenes->id_Coordinador,$array_info_global['codVendedor=>id'])?$array_info_global['codVendedor=>id'][$registro_dt_ordenes->id_Coordinador]:null;

                    // if($registro_dt_ordenes->id_orden == 13539){
                    //     $conexion_migracion_prueba->rollBack();
                    //     echo $registro_dt_ordenes->vUnidad." ".$registro_dt_ordenes->vTotal;exit;
                    // }

                    $insert_registro = $conexion_migracion_prueba->prepare("
                    INSERT INTO dt_ordenes(id_ordenes,referencia,cod,id_codprodfinal,id_subcategoria,id_categoria,cobro,id_cliente,ref_general,localizacion,
                    cantidad,item_op,id_cotizacion,id_usuario,id_vend,estado,tam_x,tam_y,tam_z,tam_l,v_unidad,v_total,nombre_proyecto,id_coordinador,n_ordenes,
                    archivo,elaboro,nit,a_pvo,u_pvo,id_proyecto_op,cotizacion,item_ct,conciliado)
                    VALUES(:id_ordenes,:referencia,:cod,:id_codprodfinal,:id_subcategoria,:id_categoria,:cobro,:id_cliente,:ref_general,:localizacion,:cantidad,
                    :item_op,:id_cotizacion,:id_usuario,:id_vend,:estado,:tam_x,:tam_y,:tam_z,:tam_l,:v_unidad,:v_total,:nombre_proyecto,:id_coordinador,
                    :n_ordenes,:archivo,:elaboro,:nit,:a_pvo,:u_pvo,:id_proyecto_op,:cotizacion,:item_ct,:conciliado)
                    "); 
                    $insert_registro->execute([
                        'id_ordenes' => $registro_dt_ordenes->id_orden,
                        'referencia' => $registro_dt_ordenes->referencia != null?$registro_dt_ordenes->referencia:null,
                        'cod' => $var66,
                        'id_codprodfinal' =>$id_codprodfinal != null?$id_codprodfinal:null,
                        'id_subcategoria' => $id_subcategoria,
                        'id_categoria' => $id_categoria,
                        'cobro' => $cobro,
                        'id_cliente' => $id_cliente,
                        'ref_general' => $registro_dt_ordenes->ref_general,
                        'localizacion' => $registro_dt_ordenes->descripcionItem,
                        'cantidad' => $registro_dt_ordenes->cantidad,
                        'item_op' => $registro_dt_ordenes->item_op,
                        'id_cotizacion' => $registro_dt_ordenes->id_cot,
                        'id_usuario' => $id_usuario,
                        'id_vend' => $id_vend,
                        'estado' => $registro_dt_ordenes->aprobado,
                        'tam_x' => $registro_dt_ordenes->tamanoX,
                        'tam_y' => $registro_dt_ordenes->tamanoY,
                        'tam_z' => $registro_dt_ordenes->tamanoZ,
                        'tam_l' => null,
                        'v_unidad' => $registro_dt_ordenes->vUnidad,
                        'v_total' => $registro_dt_ordenes->vTotal,
                        'nombre_proyecto' => null,
                        'id_coordinador' => $id_coordinador,
                        'n_ordenes' => $registro_dt_ordenes->nOrden != null?$registro_dt_ordenes->nOrden:0,
                        'archivo' => $registro_dt_ordenes->ArchivoSCOD,
                        'elaboro' => null,
                        'nit' => $registro_dt_ordenes->nit_op,
                        'a_pvo' => $registro_dt_ordenes->a_pvo,
                        'u_pvo' => $registro_dt_ordenes->u_pvo,
                        'id_proyecto_op' => (!in_array($registro_dt_ordenes->id_proyecto_op,$array_id_proyecto_faltan)&&$registro_dt_ordenes->id_proyecto_op != null)? $registro_dt_ordenes->id_proyecto_op:null,
                        'cotizacion' => $registro_dt_ordenes->cotizacion,
                        'item_ct' => $registro_dt_ordenes->item_ct,
                        'conciliado' => $registro_dt_ordenes->conciliado
                    ]);
                    
                    
                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollback();
                    echo "Error en el id_orden : ".$registro_dt_ordenes->id_orden." en la generación de su registro en dt_ordenes"."<br>".$e->getMessage();exit;
                }

                try{
                    $insert_registro2 = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_fechas_op(id_ordenes,fecha_ingreso,fecha_contractual,fecha_aprobacion_admi,fecha_aprobacion_cli,fecha_ft,fecha_gantt,
                        fecha_costos,fecha_produccion,fecha_bodegaje,fecha_trans_inst,fecha_instalacion,fecha_finstalacion,fecha_registro,
                        id_usuario,fecha_conciliacion) VALUES(:id_ordenes,:fecha_ingreso,:fecha_contractual,:fecha_aprobacion_admi,:fecha_aprobacion_cli,:fecha_ft,:fecha_gantt,
                        :fecha_costos,:fecha_produccion,:fecha_bodegaje,:fecha_trans_inst,:fecha_instalacion,:fecha_finstalacion,:fecha_registro,:id_usuario,:fecha_conciliacion)  
                    ");

                    $insert_registro2->execute([
                        'id_ordenes' => $registro_dt_ordenes->id_orden,
                        'fecha_ingreso' => $registro_dt_ordenes->fechaIngreso,
                        'fecha_contractual' => $registro_dt_ordenes->fechaNotas,
                        'fecha_aprobacion_admi' => $registro_dt_ordenes->fechaAprobacion,
                        'fecha_aprobacion_cli' => $registro_dt_ordenes->fechaAutorizacion,
                        'fecha_ft' => $registro_dt_ordenes->fechaFT,
                        'fecha_gantt' => null,
                        'fecha_costos' => $registro_dt_ordenes->fechaCostos,
                        'fecha_produccion' => $registro_dt_ordenes->fechaIdeal,
                        'fecha_bodegaje' => $registro_dt_ordenes->fechaBodegaje,
                        'fecha_trans_inst' => $registro_dt_ordenes->fechaTransIns, 
                        'fecha_instalacion' => $registro_dt_ordenes->fechaInstalacion,
                        'fecha_finstalacion' => $registro_dt_ordenes->fechaFInstalacion,
                        'fecha_registro' => $registro_dt_ordenes->fechaIngresoOP,
                        'id_usuario' => $id_usuario,
                        'fecha_conciliacion' => $registro_dt_ordenes->fecha_conciliacion_new
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollback();
                    echo "Error en el id_orden : ".$registro_dt_ordenes->id_orden." en la generación de su registro en dt_fechas_op"."<br>".$e->getMessage();exit;
                }

                $registros_insertados++;
                
            }//FIN foreach($array_dt_ordenes as $registro_dt_ordenes)
            

            $conexion_migracion_prueba->commit();
            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_ordenes
                MODIFY id_ordenes INT AUTO_INCREMENT PRIMARY KEY
            ");
            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_fechas_op
                ADD CONSTRAINT dt_fechas_op_dt_ordenes_fk FOREIGN KEY (id_ordenes) REFERENCES dt_ordenes (id_ordenes)
            ");
            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_ordenes y dt_fechas_op completada ".$registros_insertados." registros insertados en las 2 tablas, en ".$tiempo_transcurrido." segundos";

            return $mensaje;
        }
        
        public static function migraDtPlantilla($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Inicia timer

            $tiempo_inicio = microtime(true);
        
            //Consultamos dt_acabados en Sio 1

            //Consultamos dt_plantillas 

            $consulta_dt_plantillas = $conexion_sio1->query("
                SELECT id_guia,nom_guia,codigo,cantXun_G,vr_unid_G,vr_unit_G,
                gestion,cod_guia,tipo_guia,cierre,posicion,formula,comenGeneral,
                aceptScript,tipoScript,clase_guia,factorInicial,padre,final  
                FROM dt_plantillas order by id_guia
            ");

            $array_dt_plantillas = $consulta_dt_plantillas->fetchAll(PDO::FETCH_OBJ);

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_plantilla` (
                `id_plantilla` int,
                `id_padre` int DEFAULT NULL,
                `nom_guia` longtext,
                `cod_guia` varchar(50) DEFAULT NULL,
                `cant_xun_g` float DEFAULT NULL,
                `vr_unid_g` float DEFAULT NULL,
                `vr_unit_g` float DEFAULT NULL,
                `estado` char(1) DEFAULT NULL,
                `id_codprodfinal` int NOT NULL,
                `id_inventario` int DEFAULT NULL,
                `cierre` char(1) DEFAULT NULL,
                `posicion` int DEFAULT NULL,
                `formula` varchar(100) DEFAULT NULL,
                `comentarios` longtext,
                `acepta_script` char(1) DEFAULT NULL,
                `tipo_script` varchar(100) DEFAULT NULL,
                `id_acabados` int DEFAULT NULL,
                `id_clase_costo` int DEFAULT NULL,
                `id_medida` int DEFAULT NULL,
                `tam_x` float DEFAULT NULL,
                `tam_y` float DEFAULT NULL,
                `tam_z` float DEFAULT NULL,
                `tam_l` float DEFAULT NULL,
                `q` float DEFAULT NULL,
                `factor_inicial` double DEFAULT NULL,
                `factor_dependiente` longtext,
                `duracion` double DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
            ");

            $registros_insertados = 0;
            $registros_no_incluidos = 0;
            $conexion_migracion_prueba->beginTransaction();

            $array_codprodfinal = $array_info_global['cod=>id_codpdrodfinal'];
            $array_inventario = $array_info_global['codigo_prod=>id_inventario'];
            $array_tipo_script = $array_info_global['tipo_script'];
            $array_acabados = $array_info_global['cod=>id_acabados'];



            foreach($array_dt_plantillas as $registro_dt_plantillas){
                if(!array_key_exists($registro_dt_plantillas->cod_guia,$array_codprodfinal)){
                    $registros_no_incluidos++;
                    continue;
                } //Las plantillas con codigo borrado se van
                try{
                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_plantilla(id_plantilla,nom_guia,cod_guia,cant_xun_g,vr_unid_g,vr_unit_g,estado,id_codprodfinal,
                        id_inventario,cierre,posicion,formula,comentarios,acepta_script,tipo_script,id_acabados,id_clase_costo,id_medida,
                        tam_x,tam_y,tam_z,tam_l,factor_inicial,factor_dependiente,duracion)
                        VALUES(:id_plantilla,:nom_guia,:cod_guia,:cant_xun_g,:vr_unid_g,:vr_unit_g,:estado,:id_codprodfinal,
                        :id_inventario,:cierre,:posicion,:formula,:comentarios,:acepta_script,:tipo_script,:id_acabados,:id_clase_costo,:id_medida,
                        :tam_x,:tam_y,:tam_z,:tam_l,:factor_inicial,:factor_dependiente,:duracion)
                    ");
                    $insert_registro->execute([
                        'id_plantilla' =>$registro_dt_plantillas->id_guia,
                        'nom_guia' => array_key_exists($registro_dt_plantillas->nom_guia,$array_inventario)?$array_inventario[$registro_dt_plantillas->nom_guia]['producto']:$registro_dt_plantillas->nom_guia,
                        'cod_guia' => $registro_dt_plantillas->codigo,
                        'cant_xun_g' => $registro_dt_plantillas->cantXun_G,
                        'vr_unid_g' => $registro_dt_plantillas->vr_unid_G,
                        'vr_unit_g' => $registro_dt_plantillas->vr_unit_G,
                        'estado' => $registro_dt_plantillas->gestion,
                        'id_codprodfinal' => $array_codprodfinal[$registro_dt_plantillas->cod_guia]['id_cod'],
                        'id_inventario' => array_key_exists($registro_dt_plantillas->codigo,$array_inventario)?$array_inventario[$registro_dt_plantillas->codigo]['id_inventario']:null,
                        'cierre' => $registro_dt_plantillas->cierre,
                        'posicion' => $registro_dt_plantillas->posicion,
                        'formula' => $registro_dt_plantillas->formula,
                        'comentarios' => $registro_dt_plantillas->comenGeneral,
                        'acepta_script' => $registro_dt_plantillas->aceptScript == 'SI' ? 1 : 2,
                        'tipo_script' => array_key_exists($registro_dt_plantillas->tipoScript,$array_tipo_script)?$array_tipo_script[$registro_dt_plantillas->tipoScript]:null,
                        'id_acabados' => array_key_exists($registro_dt_plantillas->codigo,$array_acabados)?$array_acabados[$registro_dt_plantillas->codigo]:null,
                        'id_clase_costo'=>1,
                        'id_medida' => array_key_exists($registro_dt_plantillas->codigo,$array_inventario)?$array_inventario[$registro_dt_plantillas->codigo]['id_medida']:null,
                        'tam_x' => $array_codprodfinal[$registro_dt_plantillas->cod_guia]['x']??0,
                        'tam_y' => $array_codprodfinal[$registro_dt_plantillas->cod_guia]['y']??0,
                        'tam_z' => $array_codprodfinal[$registro_dt_plantillas->cod_guia]['z']??0,
                        'tam_l' => $array_codprodfinal[$registro_dt_plantillas->cod_guia]['l']??0,
                        'factor_inicial' => $registro_dt_plantillas->factorInicial,
                        'factor_dependiente' => $registro_dt_plantillas->padre,
                        'duracion' => $registro_dt_plantillas->final
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollback();
                    echo "Error en el id_guia: ".$registro_dt_plantillas->id_guia."<br>".$e->getMessage();exit;
                }

                $registros_insertados++;

            }
            $conexion_migracion_prueba->commit();
            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_plantilla
                MODIFY id_plantilla INT AUTO_INCREMENT PRIMARY KEY
            ");

            // Finaliza timer y entregamos mensaje 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_plantilla completada ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos"."\n<br>".$registros_no_incluidos." registros no incluidos por no tener id_codprodfinal relacionado";

            return $mensaje;

        }

        public static function migracionDtTareas($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Inicia timer

            $tiempo_inicio = microtime(true);
        

            //Consultamos dt_tareasnew en Sio 1

            $consulta_dt_tareasnew = $conexion_sio1->query("
                SELECT dt_idNewTarea,CodVendedor,FechaInicio,FechaFinal,FechaFinalCli,
                Recibe,Descripcion,estado,observaciones
                from dt_tareasnew   
            ");

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_tareas` (
                `id_tarea` int NOT NULL AUTO_INCREMENT,
                `id_responsable` int NOT NULL,
                `fecha_inicio` datetime DEFAULT NULL,
                `fecha_final` datetime DEFAULT NULL,
                `fecha_final_cli` datetime DEFAULT NULL,
                `id_encargado` int NOT NULL,
                `descripcion` varchar(100) DEFAULT NULL,
                `satisfaccion` smallint DEFAULT '0',
                `observaciones` varchar(100) DEFAULT NULL,
                PRIMARY KEY (`id_tarea`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
            ");

            $array_dt_tareasnew = $consulta_dt_tareasnew->fetchAll(PDO::FETCH_OBJ);

            $registros_insertados = 0;
            $conexion_migracion_prueba->beginTransaction();

            $array_codvendedor_user = $array_info_global['codVendedor=>id'];

            foreach($array_dt_tareasnew as $registro_tareasnew){

                try{

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_tareas(id_responsable,fecha_inicio,fecha_final,fecha_final_cli,id_encargado,descripcion,satisfaccion,observaciones)
                        VALUES(:id_responsable,:fecha_inicio,:fecha_final,:fecha_final_cli,:id_encargado,:descripcion,:satisfaccion,:observaciones)
                    ");

                    $insert_registro->execute([
                        'id_responsable' => array_key_exists($registro_tareasnew->CodVendedor,$array_codvendedor_user)?$array_codvendedor_user[$registro_tareasnew->CodVendedor]:0,
                        'fecha_inicio' => $registro_tareasnew->FechaInicio,
                        'fecha_final' => $registro_tareasnew->FechaFinal,
                        'fecha_final_cli' => $registro_tareasnew->FechaFinalCli,
                        'id_encargado' => array_key_exists($registro_tareasnew->Recibe,$array_codvendedor_user)?$array_codvendedor_user[$registro_tareasnew->Recibe]:0,
                        'descripcion' => $registro_tareasnew->Descripcion,
                        'satisfaccion' => $registro_tareasnew->estado,
                        'observaciones' => $registro_tareasnew->observaciones

                    ]);

                    $registros_insertados++;

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollback();
                    echo "Error en el dt_idNewTarea: ".$registro_tareasnew->dt_idNewTarea."<br>".$e->getMessage();exit;
                }

            }//FIN foreach($array_dt_tareasnew as $registro_tareasnew)

            $conexion_migracion_prueba->commit();
            

            // Finaliza timer y entregamos mensaje 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_tareas completada ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos";

            return $mensaje;


            
        }

        public static function migracionDtCotizacion($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Inicia timer

            $tiempo_inicio = microtime(true);
        
            //Consultamos dt_tareasnew en Sio 1

            $consulta_dt_cotiza = $conexion_sio1->query("
                SELECT id_cotiza,cod_ptoTerm,producto_trm,nCotiza,estado,
                fechaCot,fechaEntregar,items,cantidad1,vUnidad1,vTotal1,
                descripcion,tamX,tamY,tamZ,idVend,id_cotiza,nitCliente,tamL
                from dt_cotiza 
            ");

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_cotizacion` (
                `id_cotizacion` int,
                `id_codprodfinal` int DEFAULT NULL,
                `cod_producto` varchar(100) DEFAULT NULL,
                `nom_producto` varchar(556) DEFAULT NULL,
                `n_cotiza` int DEFAULT NULL,
                `estado` char(2) DEFAULT NULL,
                `fecha_ingreso` varchar(10) DEFAULT NULL,
                `fecha_compromiso` varchar(10) DEFAULT NULL,
                `item` int DEFAULT NULL,
                `cantidad` varchar(10) DEFAULT NULL,
                `v_unidad` float DEFAULT NULL,
                `v_total` float DEFAULT NULL,
                `id_forma_pago` int DEFAULT NULL,
                `descripcion` longtext,
                `tam_x` varchar(10) DEFAULT NULL,
                `tam_y` varchar(10) DEFAULT NULL,
                `tam_z` varchar(10) DEFAULT NULL,
                `usuario_creador` int DEFAULT NULL,
                `id_cliente` int DEFAULT NULL,
                `id_solicitud_cotizacion` int DEFAULT NULL,
                `id_plantilla` int DEFAULT NULL,
                `id_categoria_tabla` int DEFAULT NULL,
                `cedula` varchar(100) DEFAULT NULL,
                `nitcliente` varchar(100) DEFAULT NULL,
                `elaboro` varchar(200) DEFAULT NULL,
                `tam_l` varchar(10) DEFAULT NULL
                ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3;
            ");

            $array_dt_cotiza = $consulta_dt_cotiza->fetchAll(PDO::FETCH_OBJ);

            $registros_insertados = 0;

            $array_codprodfinal = $array_info_global['cod=>id_codpdrodfinal'];
            $array_ordenes = $array_info_global['n_ordenes|item_op=>id_ordenes']; 
            $array_clientes = $array_info_global['nit=>id_cliente'];        
            $array_codvendedor_user =  $array_info_global['codVendedor=>id'];    

            $conexion_migracion_prueba->beginTransaction();

            foreach($array_dt_cotiza as $registro_cotiza){

                try{


                    if(array_key_exists($registro_cotiza->cod_ptoTerm,$array_codprodfinal)){

                        $id_codprodfinal = $array_codprodfinal[$registro_cotiza->cod_ptoTerm]['id_cod'];
                       

                    }else{

                        $id_codprodfinal = null;
                       

                    }  
                    
                        

                    if($registro_cotiza->estado == 3 && $id_codprodfinal == null){
                        $estado = 3;
                    }elseif($registro_cotiza->estado == 1){
                        $estado = 2;
                    }else{
                        $estado = 1;
                    }

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_cotizacion(id_cotizacion,id_codprodfinal,cod_producto,nom_producto,n_cotiza,estado,fecha_ingreso,fecha_compromiso,
                        item,cantidad,v_unidad,v_total,descripcion,tam_x,tam_y,tam_z,usuario_creador,id_cliente,id_plantilla,id_categoria_tabla,
                        nitcliente,tam_l) 
                        VALUES(:id_cotizacion,:id_codprodfinal,:cod_producto,:nom_producto,:n_cotiza,:estado,:fecha_ingreso,:fecha_compromiso,
                        :item,:cantidad,:v_unidad,:v_total,:descripcion,:tam_x,:tam_y,:tam_z,:usuario_creador,:id_cliente,:id_plantilla,:id_categoria_tabla,
                        :nitcliente,:tam_l)
                    ");

                    $insert_registro->execute([
                        'id_cotizacion' => $registro_cotiza->id_cotiza,
                        'id_codprodfinal' => $id_codprodfinal,
                        'cod_producto' => $registro_cotiza->cod_ptoTerm,
                        'nom_producto' => $registro_cotiza->producto_trm,
                        'n_cotiza' => $registro_cotiza->nCotiza,
                        'estado' => $estado,
                        'fecha_ingreso' => $registro_cotiza->fechaCot,
                        'fecha_compromiso' => $registro_cotiza->fechaEntregar,
                        'item' => $registro_cotiza->items,
                        'cantidad' => $registro_cotiza->cantidad1,
                        'v_unidad' => $registro_cotiza->vUnidad1,
                        'v_total' => $registro_cotiza->vTotal1,
                        'descripcion' => $registro_cotiza->descripcion,
                        'tam_x' => $registro_cotiza->tamX,
                        'tam_y' => $registro_cotiza->tamY,
                        'tam_z' => $registro_cotiza->tamZ,
                        'usuario_creador' => array_key_exists($registro_cotiza->idVend,$array_codvendedor_user)?$array_codvendedor_user[$registro_cotiza->idVend]:null,
                        'id_cliente' =>array_key_exists($registro_cotiza->nitCliente,$array_clientes)?$array_clientes[$registro_cotiza->nitCliente]['id_cliente']:null,
                        'id_plantilla' =>0,
                        'id_categoria_tabla' => null,
                        'nitcliente' => $registro_cotiza->nitCliente,
                        'tam_l' => $registro_cotiza->tamL
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollback();
                    echo "Error en el id_cotiza: ".$registro_tareasnew->id_cotiza."<br>".$e->getMessage();exit;
                }

                $registros_insertados++;

            }// foreach($array_dt_cotiza as $registro_cotiza)

            $conexion_migracion_prueba->commit();
            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_cotizacion
                MODIFY id_cotizacion INT AUTO_INCREMENT PRIMARY KEY
            ");

            // Finaliza timer y entregamos mensaje 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_cotizacion completada ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos";

            return $mensaje;

        }

        public static function migracionDtPresupuestoInicial($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Inicia timer 

            $tiempo_inicio = microtime(true);

            //Consultamos dt_ppinicial

            $consulta_dt_ppinicial = $conexion_sio1->query("
                SELECT id_ppI,nOrden,item,MP,MO,Trans,Terc,Viati,otrosD,idUser,
                fecha,Observaciones,PMP,PMO,PTrans,PViati,PotrosD,PTerc,estandar
                from dt_ppinicial order by id_ppI
            ");

            $array_dt_ppinicial = $consulta_dt_ppinicial->fetchAll(PDO::FETCH_OBJ);

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_presupuesto_inicial` (
                `id_presupuesto_inicial` int ,
                `n_ordenes` int NOT NULL,
                `id_ordenes` int NOT NULL,
                `total_materia_prima` DECIMAL(10,2) DEFAULT NULL,
                `total_mano_obra` DECIMAL(10,2) DEFAULT NULL,
                `total_transporte` DECIMAL(10,2) DEFAULT NULL,
                `total_terceros` DECIMAL(10,2) DEFAULT NULL,
                `total_viaticos` DECIMAL(10,2) DEFAULT NULL,
                `total_otros_directos` DECIMAL(10,2) DEFAULT NULL,
                `valor_total` DECIMAL(10,2) DEFAULT NULL,
                `id_usuario` int DEFAULT NULL,
                `fecha_creacion` datetime DEFAULT NULL,
                `observaciones` varchar(556) DEFAULT NULL,
                `total_materia_prima_p` DECIMAL(10,2) DEFAULT NULL,
                `total_mano_obra_p` DECIMAL(10,2) DEFAULT NULL,
                `total_transporte_p` DECIMAL(10,2) DEFAULT NULL,
                `total_viaticos_p` DECIMAL(10,2) DEFAULT NULL,
                `total_otros_directos_p` DECIMAL(10,2) DEFAULT NULL,
                `total_terceros_p` DECIMAL(10,2) DEFAULT NULL,
                `id_orden` int DEFAULT NULL,
                `estado` smallint DEFAULT '1'
                ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3;
            ");

            $registros_insertados = 0;
            $registros_no_incluidos = 0;
            $conexion_migracion_prueba->beginTransaction();

            foreach($array_dt_ppinicial as $registro_ppinicial){
                try{

                    $array_ordenes = $array_info_global['n_ordenes|item_op=>id_ordenes'];

                    $array_user_cod = $array_info_global['codVendedor=>id'];

                    $item = $registro_ppinicial->item != null ? $registro_ppinicial->item:1; //Porque hay algunos en null

                    $id_ordenes = array_key_exists($registro_ppinicial->nOrden,$array_ordenes)&&array_key_exists($item,$array_ordenes[$registro_ppinicial->nOrden])?$array_ordenes[$registro_ppinicial->nOrden][$item]['id_ordenes']:null;

                    if($id_ordenes == null){
                        $registros_no_incluidos++;
                        continue;
                    } //Si se borro el registro en ordenes nos irve de nada el registro de presupuestos

                    $id_usuario = array_key_exists($registro_ppinicial->idUser,$array_user_cod)?$array_user_cod[$registro_ppinicial->idUser]:null;

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_presupuesto_inicial(id_presupuesto_inicial,n_ordenes,id_ordenes,total_materia_prima,total_mano_obra,
                        total_transporte,total_terceros,total_viaticos,total_otros_directos,valor_total,id_usuario,fecha_creacion,observaciones,
                        total_materia_prima_p,total_mano_obra_p,total_transporte_p,total_viaticos_p,total_otros_directos_p,total_terceros_p,
                        estado) VALUES(:id_presupuesto_inicial,:n_ordenes,:id_ordenes,:total_materia_prima,:total_mano_obra,
                        :total_transporte,:total_terceros,:total_viaticos,:total_otros_directos,:valor_total,:id_usuario,:fecha_creacion,:observaciones,
                        :total_materia_prima_p,:total_mano_obra_p,:total_transporte_p,:total_viaticos_p,:total_otros_directos_p,:total_terceros_p,
                        :estado)
                    ");

                    $insert_registro->execute([
                        'id_presupuesto_inicial' => $registro_ppinicial->id_ppI,
                        'n_ordenes' => $registro_ppinicial->nOrden,
                        'id_ordenes' => $id_ordenes,
                        'total_materia_prima' => $registro_ppinicial->MP,
                        'total_mano_obra' => $registro_ppinicial->MO,
                        'total_transporte' => $registro_ppinicial->Trans,
                        'total_terceros' => $registro_ppinicial->Terc,
                        'total_viaticos' => $registro_ppinicial->Viati,
                        'total_otros_directos' => $registro_ppinicial->otrosD,
                        'valor_total' => $registro_ppinicial->MP+$registro_ppinicial->MO+$registro_ppinicial->Trans+$registro_ppinicial->Terc+$registro_ppinicial->Terc+$registro_ppinicial->Viati+$registro_ppinicial->otrosD,
                        'id_usuario' => $id_usuario,
                        'fecha_creacion' => $registro_ppinicial->fecha,
                        'observaciones' => $registro_ppinicial->Observaciones,
                        'total_materia_prima_p' => $registro_ppinicial->PMP,
                        'total_mano_obra_p' => $registro_ppinicial->PMO,
                        'total_transporte_p' => $registro_ppinicial->PTrans,
                        'total_viaticos_p' => $registro_ppinicial->PViati,
                        'total_otros_directos_p' => $registro_ppinicial->PotrosD,
                        'total_terceros_p' => $registro_ppinicial->PTerc,
                        'estado' => $registro_ppinicial->estandar
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "Error en el id_ppI: ".$registro_ppinicial->id_ppI."<br>".$e->getMessage();exit;
                }

                $registros_insertados++;
            }

            $conexion_migracion_prueba->commit();

            //Asignamos la llave primaria con autoincremental 

            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_presupuesto_inicial
                MODIFY id_presupuesto_inicial INT AUTO_INCREMENT PRIMARY KEY
            ");

            // Finaliza timer y entregamos mensaje 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_presupuesto_inicial completada ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos"."\n<br>".$registros_no_incluidos." registros no incluidos por no tener id_ordenes relacionado";

            return $mensaje;

        }
    
        public static function migraDtCostos($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            
            //phpinfo();exit;

            //Inicia timer

            $tiempo_inicio = microtime(true);
        
            //Consultamos dt_acabados en Sio 1

            //Consultamos dt_costos del SIo 1 que es nuestra fuente

            $consulta_dt_costos = $conexion_sio1->query("
                SELECT id_costo,tipo_doc,nDoc,op_item,nCT,tipo_costo,clase_costo,
                cod_material,nom_costo,responsable,MTcritico,fecha_costo,vr_unid,
                valor_unit,cant_x_unid,cant_sol,valor_total,estado_costo,saldoXcompra,
                nGuia,posicion,id_pgantt,OrdenGantt,letra,gDescripcion,comentarios,cierre,
                fechaCierre FROM dt_costos  WHERE nDoc != 0 ORDER BY id_costo 
            ");

            

            //Creamos la tabla sin llave primaria autoincremental

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_costos` (
                `id_costo` int,
                `tipo_doc` smallint DEFAULT NULL,
                `n_ordenes` int DEFAULT NULL,
                `id_ordenes` int DEFAULT NULL,
                `id_cotizacion` int DEFAULT NULL,
                `n_cotiza` int DEFAULT NULL,
                `id_tipo_costo` int DEFAULT NULL,
                `id_clase_costo` int DEFAULT NULL,
                `cod_material` varchar(50) DEFAULT NULL,
                `nombre_costo` varchar(556) DEFAULT NULL,
                `id_acabados` int DEFAULT NULL,
                `id_inventario` int DEFAULT NULL,
                `id_usuario` int DEFAULT NULL,
                `material_crit` int DEFAULT NULL,
                `fecha_ingreso` datetime DEFAULT NULL,
                `valor_unit` DECIMAL(10,2) DEFAULT NULL,
                `vr_unid` DECIMAL(10,2) DEFAULT NULL,
                `cant_unit` float DEFAULT NULL,
                `cant_sol` float DEFAULT NULL,
                `valor_total` DECIMAL(10, 2) DEFAULT NULL,
                `estado` smallint DEFAULT NULL,
                `saldo_compra` float DEFAULT NULL,
                `nit_guia` varchar(50) DEFAULT NULL,
                `posicion` smallint DEFAULT NULL,
                `id_pgantt` int DEFAULT NULL,
                `orden_gantt` varchar(10) DEFAULT NULL,
                `letra` char(1) DEFAULT NULL,
                `gantt_des` varchar(556) DEFAULT NULL,
                `comentarios` varchar(100) DEFAULT NULL,
                `cierre` smallint DEFAULT NULL,
                `fecha_cierre` datetime DEFAULT NULL,
                `id_orden` int DEFAULT NULL,
                `id_costos` int DEFAULT NULL,
                `id_area_costo` int DEFAULT NULL,
                KEY `id_ordenes` (`id_ordenes`),
                KEY `indx_n_ordenes` (`n_ordenes`),
                KEY `indx_cod_material` (`cod_material`),
                CONSTRAINT `dt_costos_ibfk_1` FOREIGN KEY (`id_ordenes`) REFERENCES `dt_ordenes` (`id_ordenes`)
                ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3;
            ");

            $array_materiales = $array_info_global['codigo_prod=>id_inventario'];
            $array_acabados = $array_info_global['cod=>id_acabados'] ;
            $array_usuarios = $array_info_global['vendedor=>id'];
            $array_ordenes = $array_info_global['n_ordenes|item_op=>id_ordenes'];
            $array_cotizacion = $array_info_global['n_cotiza|item=>id_cotizacion'];

            $registros_insertados = 0;
            $registros_no_incluidos = 0;
            $conexion_migracion_prueba->beginTransaction();


            while($registro_dt_costos = $consulta_dt_costos->fetch(PDO::FETCH_OBJ)){

                try{ 

                    $id_ordenes = array_key_exists($registro_dt_costos->nDoc,$array_ordenes) && array_key_exists($registro_dt_costos->op_item,$array_ordenes[$registro_dt_costos->nDoc])?$array_ordenes[$registro_dt_costos->nDoc][$registro_dt_costos->op_item]['id_ordenes']:null;

                    if($id_ordenes == null){
                        $registros_no_incluidos++;
                        continue;
                    } // Costos que tienen su orden borrada, se van 


                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_costos(id_costo,tipo_doc,n_ordenes,id_ordenes,id_cotizacion,n_cotiza,id_tipo_costo,id_clase_costo,cod_material,
                        nombre_costo,id_acabados,id_inventario,id_usuario,material_crit,fecha_ingreso,valor_unit,vr_unid,cant_unit,cant_sol,valor_total,
                        estado,saldo_compra,nit_guia,posicion,id_pgantt,orden_gantt,letra,gantt_des,comentarios,cierre,fecha_cierre)VALUES
                        (:id_costo,:tipo_doc,:n_ordenes,:id_ordenes,:id_cotizacion,:n_cotiza,:id_tipo_costo,:id_clase_costo,:cod_material,
                        :nombre_costo,:id_acabados,:id_inventario,:id_usuario,:material_crit,:fecha_ingreso,:valor_unit,:vr_unid,:cant_unit,:cant_sol,
                        :valor_total,:estado,:saldo_compra,:nit_guia,:posicion,:id_pgantt,:orden_gantt,:letra,:gantt_des,:comentarios,:cierre,:fecha_cierre)
                    ");

                    $insert_registro->execute([
                        'id_costo' => $registro_dt_costos->id_costo,
                        'tipo_doc' => $registro_dt_costos->tipo_doc,
                        'n_ordenes' => $registro_dt_costos->nDoc,
                        'id_ordenes' => $id_ordenes,
                        'id_cotizacion' => array_key_exists($registro_dt_costos->nCT,$array_cotizacion) && array_key_exists($registro_dt_costos->op_item,$array_cotizacion[$registro_dt_costos->nCT])?$array_cotizacion[$registro_dt_costos->nCT][$registro_dt_costos->op_item]['id_cotizacion']:6249,
                        'n_cotiza' => $registro_dt_costos->nCT,
                        'id_tipo_costo' => $registro_dt_costos->tipo_costo,
                        'id_clase_costo' => $registro_dt_costos->clase_costo,
                        'cod_material' => $registro_dt_costos->cod_material,
                        'nombre_costo' => $registro_dt_costos->nom_costo,
                        'id_acabados' => array_key_exists($registro_dt_costos->cod_material,$array_acabados)?$array_acabados[$registro_dt_costos->cod_material]:null,
                        'id_inventario' => array_key_exists($registro_dt_costos->cod_material,$array_materiales)?$array_materiales[$registro_dt_costos->cod_material]['id_inventario']:null,
                        'id_usuario' => array_key_exists(rtrim($registro_dt_costos->responsable),$array_usuarios)?$array_usuarios[rtrim($registro_dt_costos->responsable)]:null,
                        'material_crit' => $registro_dt_costos->MTcritico,
                        'fecha_ingreso' => $registro_dt_costos->fecha_costo,
                        'valor_unit' => $registro_dt_costos->vr_unid,
                        'vr_unid' => $registro_dt_costos->valor_unit,
                        'cant_unit' => $registro_dt_costos->cant_x_unid,
                        'cant_sol' => $registro_dt_costos->cant_sol,
                        'valor_total' => $registro_dt_costos->valor_total,
                        'estado' => $registro_dt_costos->estado_costo,
                        'saldo_compra' => $registro_dt_costos->saldoXcompra,
                        'nit_guia' => $registro_dt_costos->nGuia,
                        'posicion' => $registro_dt_costos->posicion,
                        'id_pgantt' => $registro_dt_costos->id_pgantt,
                        'orden_gantt' => $registro_dt_costos->OrdenGantt,
                        'letra' => $registro_dt_costos->letra,
                        'gantt_des' => $registro_dt_costos->gDescripcion,
                        'comentarios' => $registro_dt_costos->comentarios,
                        'cierre' => $registro_dt_costos->cierre,
                        'fecha_cierre' => $registro_dt_costos->fechaCierre
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "Error en el id_costo: ".$registro_dt_costos->id_costo."<br>".$e->getMessage();exit;
                }

                $registros_insertados++;

            }//FIN while($registro_dt_costos = $consulta_dt_costos->fetch(PDO::FETCH_OBJ))

            $conexion_migracion_prueba->commit();

            //Asignamos la llave primaria con autoincremental 

            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_costos
                MODIFY id_costo INT AUTO_INCREMENT PRIMARY KEY
            ");

            // Finaliza timer y entregamos mensaje 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_costos completada ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos"."\n<br>".$registros_no_incluidos." registros no incluidos por no tener id_ordenes relacionado";

            return $mensaje;



        }

        public static function migraDtDiseno($conexion_sio1,$conexion_migracion_prueba,$array_info_global){


            //Inicia timer

            $tiempo_inicio = microtime(true);

            //Consultamos dt_disenolista item

            $consulta_dt_disenolista = $conexion_sio1->query("
                SELECT id_diseno,grupo,uniones,explosivo_procesosAnt,fotomontajes,
                modulacion,modulacion_lam_perf,archivos_impr,detalles_cons,sistemas_ins,
                archivos_corte,cortes_dobleses,explosivo_mat,detalles_ilum,plantilla_insta,
                plano_coordenadas,plano_electrico,plano_cargue,plano_especial,archivo,
                fechaInicio,codVendedor,nOrden,item,fechaFinal,otros,otrosObser,
                fechaIncioR,fechaFinalR,foto,ruta,fechaFinalCli,OK,CreacionCod,
                PresupuestoMO,DefinirMP,CreacionGantt
                from dt_disenolista dd WHERE 
                not( 
                FechaPrograma like '%2018-09-24%' or FechaPrograma 
                    like '%2018-10-31%' AND nOrden  in (36179,36178,36183,36181,36180,
                37142,36240,36139,37369,37552,36261,37093,36156,37350,36314,36149,
                36150,36153,36141,36143,36144,37546,36970,36776,36777,36152,36151,
                37771,37067,37443,36602,37065,36765,37273,36936,36278,36272,36315,
                36363,36396,36145,36583,37201,37508,37064,36597,36227,36288,36289,
                36378,36376,36148,36732,36287,36308,36395,36451,36277,36230,36998,
                37353,36999,37660,37086,37599,37600,37656,36913,37150,37151,37152,
                37155,37239,37240,37241,37242,37252,37149,37165,37254,37266,37356,
                37357,37358,37359,37276,37253,37216,37267,36142,36229,36874,36876,
                37200,36877,37009,36686,36688,36689,36690,36805,36810,37062,36228,
                36231,36232,36235,36236,36245,36252,36340,36464,36700,36749,36234,
                36239,36579,36606,36146,36243,36247,36212,36238,36725,36205,36581,
                36273,36154,36101,36102,36801,36804,37222,36961,37169,37344,37567,
                37046,37268,36140,36276,36242,37059,36164,36131,36132,36127,36135,
                36136,36134)) ORDER BY id_diseno 
            ");

            //$consulta_dt_disenolista->execute();

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_diseno` (
                `id_disenolista` int,
                `grupo` int DEFAULT NULL,
                `uniones` smallint DEFAULT NULL,
                `explosivo_procesos_ant` smallint DEFAULT NULL,
                `fotomontajes` smallint DEFAULT NULL,
                `modulacion` smallint DEFAULT NULL,
                `modulacion_lam_perf` smallint DEFAULT NULL,
                `archivos_impr` smallint DEFAULT NULL,
                `detalles_cons` smallint DEFAULT NULL,
                `sistemas_ins` smallint DEFAULT NULL,
                `archivos_corte` smallint DEFAULT NULL,
                `corte_dobleces` smallint DEFAULT NULL,
                `explosivo_mat` smallint DEFAULT NULL,
                `detalles_ilum` smallint DEFAULT NULL,
                `plantilla_insta` smallint DEFAULT NULL,
                `plano_coordenadas` smallint DEFAULT NULL,
                `plano_electrico` smallint DEFAULT NULL,
                `plano_cargue` smallint DEFAULT NULL,
                `plano_especial` smallint DEFAULT NULL,
                `archivo` longtext,
                `fecha_inicio` datetime DEFAULT NULL,
                `id_usuario` int DEFAULT NULL,
                `n_ordenes` int DEFAULT NULL,
                `id_ordenes` int DEFAULT NULL,
                `fecha_final` datetime DEFAULT NULL,
                `otros` smallint DEFAULT NULL,
                `otros_observaciones` longtext,
                `fecha_inicio_real` datetime DEFAULT NULL,
                `fecha_final_real` datetime DEFAULT NULL,
                `foto` longtext,
                `ruta` longtext,
                `fecha_final_cli` datetime DEFAULT NULL,
                `estado` smallint DEFAULT NULL,
                `ok` smallint DEFAULT '0',
                `creacion_codigos` smallint DEFAULT NULL,
                `presupuesto_mo` smallint DEFAULT NULL,
                `definir_mp` smallint DEFAULT NULL,
                `creacion_gantt` smallint DEFAULT NULL,
                `id_orden` int DEFAULT NULL,
                KEY `indx_n_ordenes` (`n_ordenes`),
                KEY `indx_estado` (`estado`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
            ");

            $registros_insertados = 0;
            $registros_no_incluidos = 0;
            $conexion_migracion_prueba->beginTransaction();

            $array_grupos_diseno = $array_info_global['grupos_diseno'];
            $array_codvendedor_user = $array_info_global['codVendedor=>id'];
            $array_ordenes = $array_info_global['n_ordenes|item_op=>id_ordenes'];

            $ids_vacios = [12952848,2952854,12953028,12953416,12953541];
            $registros_vacios = 0;

            while($registro_disenolista = $consulta_dt_disenolista->fetch(PDO::FETCH_OBJ)){

                try{
                    // if($registro_disenolista === false){
                    //     $conexion_migracion_prueba->commit();
                    //     echo $registros_insertados." hasta ahora ";
                    //     var_dump($registro_disenolista);exit;
                    // }

                    if(in_array($registro_disenolista->id_diseno,$ids_vacios)){
                        $registros_vacios++;
                        continue;
                    }

                    $id_ordenes = array_key_exists($registro_disenolista->nOrden,$array_ordenes)&&array_key_exists($registro_disenolista->item,$array_ordenes[$registro_disenolista->nOrden])?$array_ordenes[$registro_disenolista->nOrden][$registro_disenolista->item]['id_ordenes']:null;

                    $grupo = array_key_exists($registro_disenolista->grupo,$array_grupos_diseno)?$array_grupos_diseno[$registro_disenolista->grupo]:0;

                    $id_usuario = array_key_exists($registro_disenolista->codVendedor,$array_codvendedor_user)?$array_codvendedor_user[$registro_disenolista->codVendedor]:0;


                    if($id_ordenes == null){
                        $registros_no_incluidos++;
                        continue;
                    }

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_diseno(id_disenolista,grupo,uniones,explosivo_procesos_ant,fotomontajes,modulacion,
                        modulacion_lam_perf,archivos_impr,detalles_cons,sistemas_ins,archivos_corte,corte_dobleces,
                        explosivo_mat,detalles_ilum,plantilla_insta,plano_coordenadas,plano_electrico,plano_cargue,
                        plano_especial,archivo,fecha_inicio,id_usuario,n_ordenes,id_ordenes,fecha_final,otros,
                        otros_observaciones,fecha_inicio_real,fecha_final_real,foto,ruta,fecha_final_cli,estado,ok,
                        creacion_codigos,presupuesto_mo,definir_mp,creacion_gantt)
                        VALUES(:id_disenolista,:grupo,:uniones,:explosivo_procesos_ant,:fotomontajes,:modulacion,
                        :modulacion_lam_perf,:archivos_impr,:detalles_cons,:sistemas_ins,:archivos_corte,:corte_dobleces,
                        :explosivo_mat,:detalles_ilum,:plantilla_insta,:plano_coordenadas,:plano_electrico,:plano_cargue,
                        :plano_especial,:archivo,:fecha_inicio,:id_usuario,:n_ordenes,:id_ordenes,:fecha_final,:otros,
                        :otros_observaciones,:fecha_inicio_real,:fecha_final_real,:foto,:ruta,:fecha_final_cli,:estado,:ok,
                        :creacion_codigos,:presupuesto_mo,:definir_mp,:creacion_gantt) 
                    ");

                    

                    $insert_registro->execute([
                        'id_disenolista' => $registro_disenolista->id_diseno,
                        'grupo' => $grupo,
                        'uniones' => $registro_disenolista->uniones != null ? 1 : null,
                        'explosivo_procesos_ant' => $registro_disenolista->explosivo_procesosAnt != null ? 1 : null,
                        'fotomontajes' => $registro_disenolista->fotomontajes != null ? 1 : null,
                        'modulacion' => $registro_disenolista->modulacion != null ? 1 : null,
                        'modulacion_lam_perf' => $registro_disenolista->modulacion_lam_perf != null ? 1 : null,
                        'archivos_impr' => $registro_disenolista->archivos_impr != null ? 1 : null,
                        'detalles_cons' => $registro_disenolista->detalles_cons != null ? 1 : null,
                        'sistemas_ins' => $registro_disenolista->sistemas_ins != null ? 1 : null,
                        'archivos_corte' => $registro_disenolista->archivos_corte != null ? 1 : null,
                        'corte_dobleces' => $registro_disenolista->cortes_dobleses != null ? 1 : null,
                        'explosivo_mat' => $registro_disenolista->explosivo_mat != null ? 1 : null,
                        'detalles_ilum' => $registro_disenolista->detalles_ilum != null ? 1 : null,
                        'plantilla_insta' => $registro_disenolista->plantilla_insta != null ? 1 : null,
                        'plano_coordenadas' => $registro_disenolista->plano_coordenadas != null ? 1 : null,
                        'plano_electrico' => $registro_disenolista->plano_electrico != null ? 1 : null,
                        'plano_cargue' => $registro_disenolista->plano_cargue != null ? 1 : null,
                        'plano_especial' => $registro_disenolista->plano_especial != null ? 1 : null,
                        'archivo' => $registro_disenolista->archivo,
                        'fecha_inicio' => $registro_disenolista->fechaInicio,
                        'id_usuario' => $id_usuario,
                        'n_ordenes' => $registro_disenolista->nOrden,
                        'id_ordenes' => $id_ordenes,
                        'fecha_final' => $registro_disenolista->fechaFinal,
                        'otros' => $registro_disenolista->otros,
                        'otros_observaciones' => $registro_disenolista->otrosObser,
                        'fecha_inicio_real' => $registro_disenolista->fechaIncioR,
                        'fecha_final_real' => $registro_disenolista->fechaFinalR,
                        'foto' => $registro_disenolista->foto,
                        'ruta' => $registro_disenolista->ruta,
                        'fecha_final_cli' => $registro_disenolista->fechaFinalCli,
                        'estado' =>1,
                        'ok' => $registro_disenolista->OK,
                        'creacion_codigos' => $registro_disenolista->CreacionCod,
                        'presupuesto_mo' => $registro_disenolista->PresupuestoMO,
                        'definir_mp' => $registro_disenolista->DefinirMP,
                        'creacion_gantt' => $registro_disenolista->CreacionGantt
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "Error en el id_diseno: ".$registro_disenolista->id_diseno."<br>".$e->getMessage();exit;
                }

                $registros_insertados++;

            } //FIN while($registro_disenolista = $consulta_dt_disenolista->fetch(PDO::FETCH_OBJ))

            $conexion_migracion_prueba->commit();

            //Asignamos la llave primaria con autoincremental 

            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_diseno
                MODIFY id_disenolista INT AUTO_INCREMENT PRIMARY KEY
            ");

            // Finaliza timer y entregamos mensaje 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_diseno completada ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos"."\n<br>".$registros_no_incluidos." registros no incluidos por no tener id_ordenes relacionado"."\n<br>"."adicionalmente no se incluyeron ".$registros_vacios." por esrar completamente vacios";

            return $mensaje;


        }

        public static function migraDtProgramacionDiseno($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Iniciamos timer

            $tiempo_inicio = microtime(true);
            

            //Hacemos el array con la información del dt_programacion_diseno del Sio 1

            $consulta_dt_programacion_diseno = $conexion_sio1->query("
                SELECT id_programacion_diseno,cod,estado,n_programacion  from dt_programacion_diseno
                group by n_programacion
            ");

            $array_dt_programacion_diseno = $consulta_dt_programacion_diseno->fetchAll(PDO::FETCH_OBJ);

            $conexion_migracion_prueba->exec("

                CREATE TABLE `dt_programacion_diseno` (
                `id_programacion_diseno` int,
                `id_codprodfinal` int NOT NULL,
                `cod` varchar(108) NOT NULL,
                `estado` int NOT NULL DEFAULT '1',
                `n_programacion` int NOT NULL,
                KEY `fk_dt_programacion_diseno_dt_codprodfinal1` (`id_codprodfinal`),
                CONSTRAINT `fk_dt_programacion_diseno_dt_codprodfinal1` FOREIGN KEY (`id_codprodfinal`) REFERENCES `dt_codprodfinal` (`id_codprodfinal`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

            ");

            

            $array_codprodfinal = $array_info_global['cod=>id_codpdrodfinal'];

            $registros_insertados = 0;

            $conexion_migracion_prueba->beginTransaction();

            foreach($array_dt_programacion_diseno as $registro_dt_programacion_diseno){

                try{
                    $cod = trim($registro_dt_programacion_diseno->cod);

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_programacion_diseno(id_programacion_diseno,id_codprodfinal,cod,estado,n_programacion)
                        VALUES(:id_programacion_diseno,:id_codprodfinal,:cod,:estado,:n_programacion)
                    ");

                    $insert_registro->execute([
                        'id_programacion_diseno' => $registro_dt_programacion_diseno->id_programacion_diseno,
                        'id_codprodfinal' => array_key_exists($cod,$array_codprodfinal)?$array_codprodfinal[$cod]['id_cod']:null,
                        'cod' => $cod,
                        'estado' => $registro_dt_programacion_diseno->estado,
                        'n_programacion' =>  $registro_dt_programacion_diseno->n_programacion
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "<pre>";
                    echo "Hay un problema con el id_programacion_diseno ".$registro_dt_programacion_diseno->id_programacion_diseno." ".$registro_dt_programacion_diseno->cod."<br>".$e->getMessage();exit;
                }
                $registros_insertados++;
            }

            $conexion_migracion_prueba->commit();

            //Asignamos la llave primaria con autoincremental 

            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_programacion_diseno
                MODIFY id_programacion_diseno INT AUTO_INCREMENT PRIMARY KEY
            ");
            
            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_programacion_diseno completada, ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos";

            return $mensaje;


        }

        public static function migraDtEstructuraPDiseno($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Iniciamos timer

            $tiempo_inicio = microtime(true);
            

            //Hacemos el array con la información del dt_programacion_diseno del Sio 1

            $consulta_dt_programacion_diseno = $conexion_sio1->query("
                SELECT grupo,fecha_inicio,fecha_final,archivo,gantt,ruta,
                foto,id_programacion_diseno,responsable,n_programacion
                from dt_programacion_diseno
            ");

            $array_dt_programacion_diseno = $consulta_dt_programacion_diseno->fetchAll(PDO::FETCH_OBJ);

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_estructura_p_diseno` (
                `id_estructura_p_diseno` int NOT NULL AUTO_INCREMENT,
                `grupo` varchar(80) NOT NULL,
                `fecha_inicio` datetime(6) NOT NULL,
                `fecha_fin` datetime(6) NOT NULL,
                `archivo` varchar(256) DEFAULT NULL,
                `gantt` int DEFAULT '0',
                `ruta` varchar(256) DEFAULT NULL,
                `foto` varchar(256) DEFAULT NULL,
                `id_programacion_diseno` int NOT NULL,
                `responsable` int NOT NULL,
                PRIMARY KEY (`id_estructura_p_diseno`),
                KEY `fk_dt_estructura_p_diseno_dt_programacion_diseno1` (`id_programacion_diseno`),
                KEY `fk_dt_estructura_p_diseno_user1` (`responsable`),
                CONSTRAINT `fk_dt_estructura_p_diseno_dt_programacion_diseno1` FOREIGN KEY (`id_programacion_diseno`) REFERENCES `dt_programacion_diseno` (`id_programacion_diseno`),
                CONSTRAINT `fk_dt_estructura_p_diseno_user1` FOREIGN KEY (`responsable`) REFERENCES `user` (`id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=448 DEFAULT CHARSET=latin1;
            ");

            $array_grupos = [
                'Metal' => 'metalmecanica',
                'CNC' => 'cnc',
                'Plast' => 'plasticos',
                'Pin' => 'pintura',
                'ImpDec' => 'impresion_decoracion',
                'Ensam' => 'ensamble',
                'Costos' => 'costos',
                'Terc1' => 'terceros_1',
                'Ins' => 'instalacion',
                'Terc2' => 'Terc2',
                'Terc3' => 'Terc3',
                'Made' => 'maderas'
            ];

            $array_id_programacion_diseno = $array_info_global['n_programacion=>id_programacion_diseno'];

            $array_codprodfinal = $array_info_global['cod=>id_codpdrodfinal'];

            $array_usuarios = $array_info_global['codVendedor=>id'];

            $registros_insertados = 0;

            $conexion_migracion_prueba->beginTransaction();

            foreach($array_dt_programacion_diseno as $registro_dt_programacion_diseno){

                try{

                    $archivo = $registro_dt_programacion_diseno->archivo;

                    $archivo = ControladorFuncionesAuxiliares::formateaString($archivo);

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_estructura_p_diseno(grupo,fecha_inicio,fecha_fin,archivo,gantt,ruta,foto,id_programacion_diseno,responsable)
                        VALUES(:grupo,:fecha_inicio,:fecha_fin,:archivo,:gantt,:ruta,:foto,:id_programacion_diseno,:responsable);
                    ");

                    $insert_registro->execute([
                        'grupo' => array_key_exists($registro_dt_programacion_diseno->grupo,$array_grupos)?$array_grupos[$registro_dt_programacion_diseno->grupo]:null,
                        'fecha_inicio' => $registro_dt_programacion_diseno->fecha_inicio,
                        'fecha_fin' => $registro_dt_programacion_diseno->fecha_final,
                        'archivo' => $archivo,
                        'gantt' => $registro_dt_programacion_diseno->gantt,
                        'ruta' => $registro_dt_programacion_diseno->ruta,
                        'foto' => $registro_dt_programacion_diseno->foto,
                        'id_programacion_diseno' => array_key_exists($registro_dt_programacion_diseno->n_programacion,$array_id_programacion_diseno)?$array_id_programacion_diseno[$registro_dt_programacion_diseno->n_programacion]:null,
                        'responsable' => array_key_exists($registro_dt_programacion_diseno->responsable,$array_usuarios)?$array_usuarios[$registro_dt_programacion_diseno->responsable]:null
                    ]);


                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "<pre>";
                    echo "Hay un problema con el id_estructura_p_diseno ".$registro_dt_programacion_diseno->id_programacion_diseno."<br> ".$e->getMessage();exit;
                }

                $registros_insertados++;

            }

            $conexion_migracion_prueba->commit();

            
            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_estructura_p_diseno completada, ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos";

            return $mensaje;

        }

        public static function migraDtHistoricoDiseno($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Iniciamos timer

            $tiempo_inicio = microtime(true);
            

            //Hacemos el array con la información del dt_historico_diseno del Sio 1

            $consulta_dt_historico_diseno = $conexion_sio1->query("
                SELECT id_historico_p_diseno,n_programacion,fecha_regristro,tipo,
                observacion,idUser  from dt_historico_diseno 
            ");

            $array_dt_historico_diseno = $consulta_dt_historico_diseno->fetchAll(PDO::FETCH_OBJ);

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_historico_diseno` (
                `id_historico_diseno` int NOT NULL AUTO_INCREMENT,
                `id_programacion_diseno` int NOT NULL,
                `fecha_registro` datetime(6) NOT NULL,
                `tipo` int NOT NULL COMMENT '1 = Nueva Programación , 2 = Desactiva Programacion, 3 = Actualizar Programacion , 4 = Subir archivos',
                `observacion` varchar(256) NOT NULL,
                `id_user` int NOT NULL,
                `n_programacion` int DEFAULT NULL,
                PRIMARY KEY (`id_historico_diseno`),
                KEY `fk_dt_historico_diseno_dt_programacion_diseno1` (`id_programacion_diseno`),
                KEY `fk_dt_historico_diseno_user1` (`id_user`),
                CONSTRAINT `fk_dt_historico_diseno_dt_programacion_diseno1` FOREIGN KEY (`id_programacion_diseno`) REFERENCES `dt_programacion_diseno` (`id_programacion_diseno`),
                CONSTRAINT `fk_dt_historico_diseno_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ");

            $array_programacion_diseno = $array_info_global['n_programacion=>id_programacion_diseno'];

            $array_usuarios = $array_info_global['codVendedor=>id'];

            $registros_insertados = 0;

            $conexion_migracion_prueba->beginTransaction();

            foreach($array_dt_historico_diseno as $registro_dt_historico_diseno){

                try{

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_historico_diseno(id_programacion_diseno,fecha_registro,tipo,observacion,id_user,n_programacion)
                        VALUES(:id_programacion_diseno,:fecha_registro,:tipo,:observacion,:id_user,:n_programacion)
                    ");

                    $insert_registro->execute([
                        'id_programacion_diseno' => array_key_exists($registro_dt_historico_diseno->n_programacion,$array_programacion_diseno)?$array_programacion_diseno[$registro_dt_historico_diseno->n_programacion]:null,
                        'fecha_registro' =>$registro_dt_historico_diseno->fecha_regristro,
                        'tipo' => $registro_dt_historico_diseno->tipo,
                        'observacion' => $registro_dt_historico_diseno->observacion,
                        'id_user' => array_key_exists($registro_dt_historico_diseno->idUser,$array_usuarios)?$array_usuarios[$registro_dt_historico_diseno->idUser]:null,
                        'n_programacion' => $registro_dt_historico_diseno->n_programacion
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollback();
                    echo "Error en el id_acabado: ".$registro_dt_acabados->id_acabado."<br>".$e->getMessage();exit;
                }

                $registros_insertados++;

            } 

            $conexion_migracion_prueba->commit();

            
            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_historico_diseno completada, ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos";

            return $mensaje;

            
        }

        public static function migraDtHistoricoFt($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Iniciamos timer

            $tiempo_inicio = microtime(true);
            

            //Hacemos el array con la información del dt_historico_ft del Sio 1

            $consulta_dt_estructura_p_diseno  = $conexion_migracion_prueba->query("
                SELECT * from dt_estructura_p_diseno
            ");

            $array_dt_estructura_p_diseno = $consulta_dt_estructura_p_diseno->fetchAll(PDO::FETCH_OBJ);

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_historico_ft` (
                `id_historico_ft` int NOT NULL AUTO_INCREMENT,
                `fecha_registro` datetime(6) NOT NULL,
                `recurso` varchar(256) NOT NULL,
                `ruta` varchar(256) DEFAULT NULL,
                `tipo` int NOT NULL,
                `observaciones` varchar(800) DEFAULT NULL,
                `id_estructura_p_diseno` int NOT NULL,
                `id_user` int NOT NULL,
                `id_historico_diseno` int NOT NULL,
                PRIMARY KEY (`id_historico_ft`),
                KEY `fk_dt_historico_ft_dt_estructura_p_diseno1` (`id_estructura_p_diseno`),
                KEY `fk_dt_historico_ft_user1` (`id_user`),
                KEY `fk_dt_historico_ft_dt_historico_diseno1` (`id_historico_diseno`),
                CONSTRAINT `fk_dt_historico_ft_dt_estructura_p_diseno1` FOREIGN KEY (`id_estructura_p_diseno`) REFERENCES `dt_estructura_p_diseno` (`id_estructura_p_diseno`),
                CONSTRAINT `fk_dt_historico_ft_dt_historico_diseno1` FOREIGN KEY (`id_historico_diseno`) REFERENCES `dt_historico_diseno` (`id_historico_diseno`),
                CONSTRAINT `fk_dt_historico_ft_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            ");

            $array_usuarios = $array_info_global['codVendedor=>id'];

            $array_fecha_ingreso = $array_info_global['id_programacion_diseno=>fecha_ingreso'];

            // echo "<pre>";
            // var_dump($array_estructura);echo "...............................";

            $registros_insertados = 0;
            $registros_no_incluidos = 0;

            $conexion_migracion_prueba->beginTransaction();

            foreach($array_dt_estructura_p_diseno as $registro_dt_estructura_p_diseno){


                try{                                                                                                                                                                                                                                                                                                                                    
                    
                    $fecha_registro = array_key_exists($registro_dt_estructura_p_diseno->id_programacion_diseno,$array_fecha_ingreso)?$array_fecha_ingreso[$registro_dt_estructura_p_diseno->id_programacion_diseno]['fecha_registro']:null;
                    $id_historico_diseno = array_key_exists($registro_dt_estructura_p_diseno->id_programacion_diseno,$array_fecha_ingreso)?$array_fecha_ingreso[$registro_dt_estructura_p_diseno->id_programacion_diseno]['id_historico_diseno']:null;
                    //$id_user = array_key_exists($registro_dt_estructura_p_diseno->responsable,$array_usuarios)?$array_usuarios[$registro_dt_estructura_p_diseno->responsable]:null;

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_historico_ft(fecha_registro,recurso,ruta,tipo,observaciones,id_estructura_p_diseno,
                        id_user,id_historico_diseno)
                        VALUES(:fecha_registro,:recurso,:ruta,:tipo,:observaciones,:id_estructura_p_diseno,
                        :id_user,:id_historico_diseno)
                    ");
                    
                    if($registro_dt_estructura_p_diseno->archivo != null && $registro_dt_estructura_p_diseno->archivo != ''){
                        $recurso = ControladorFuncionesAuxiliares::formateaString($registro_dt_estructura_p_diseno->archivo);
                        $insert_registro->execute([
                            'fecha_registro' => $fecha_registro,
                            'recurso' => $recurso,
                            'ruta' => $registro_dt_estructura_p_diseno->ruta,
                            'tipo' => 1,
                            'observaciones' => null,
                            'id_estructura_p_diseno' => $registro_dt_estructura_p_diseno->id_estructura_p_diseno,
                            'id_user' => $registro_dt_estructura_p_diseno->responsable,
                            'id_historico_diseno' => $id_historico_diseno
                        ]);
                    }
                    elseif($registro_dt_estructura_p_diseno->foto != null && $registro_dt_estructura_p_diseno->foto != ''){
                        $recurso = ControladorFuncionesAuxiliares::formateaString($registro_dt_estructura_p_diseno->foto);
                        $insert_registro->execute([
                            'fecha_registro' => $fecha_registro,
                            'recurso' => $recurso,
                            'ruta' => $registro_dt_estructura_p_diseno->ruta,
                            'tipo' => 2,
                            'observaciones' => null,
                            'id_estructura_p_diseno' => $registro_dt_estructura_p_diseno->id_estructura_p_diseno,
                            'id_user' => $registro_dt_estructura_p_diseno->responsable,
                            'id_historico_diseno' => $id_historico_diseno
                        ]);
                    }else{
                        $registros_no_incluidos++;
                        continue;
                    }
                    

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "Error en el id_estructura_p_diseno: ".$registro_dt_estructura_p_diseno->id_estructura_p_diseno."<br>".$e->getMessage();exit;
                    
                }

                $registros_insertados++;
            }

            $conexion_migracion_prueba->commit();

            
            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_historico_ft completada, ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos"."\n<br>".$registros_no_incluidos." registros no incluidos por no tener foto ni archivo, que son los registros que le dan sentido a la tabla";

            return $mensaje;

        }

        public static function migraDtTareasCosto($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Iniciamos timer

            $tiempo_inicio = microtime(true);
            

            //Hacemos el array con la información del dt_tareas del Sio 1

            $consulta_dt_tareas = $conexion_sio1->query("
                SELECT id_tareas,codVendedor,id_costo,nOrden,item,can_horas,FechaInicio,cod,nom_costo,area,recurso,
                FechaInicioR,FechaFinal,Observaciones,FechaPro,FechaRetro  from dt_tareas  
            ");

            $array_dt_tareas = $consulta_dt_tareas->fetchAll(PDO::FETCH_OBJ);

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_tareas_costo` (
                `id_tarea_costo` int NOT NULL AUTO_INCREMENT,
                `id_vendedor` int NOT NULL,
                `id_usuario` int NOT NULL,
                `id_costo` int DEFAULT NULL,
                `n_ordenes` int DEFAULT NULL,
                `id_ordenes` int DEFAULT NULL,
                `can_horas` float DEFAULT NULL,
                `fecha_inicio` datetime DEFAULT NULL,
                `cod_material` varchar(50) DEFAULT NULL,
                `nombre_costo` varchar(100) DEFAULT NULL,
                `id_area` int DEFAULT NULL,
                `recurso` smallint DEFAULT NULL,
                `fecha_inicio_real` datetime DEFAULT NULL,
                `fecha_final` datetime DEFAULT NULL,
                `observaciones` varchar(100) DEFAULT NULL,
                `fecha_pro` datetime DEFAULT NULL,
                `fecha_retro` datetime DEFAULT NULL,
                `id_costos` int DEFAULT NULL,
                `id_tareas` int DEFAULT NULL,
                `id_orden` int DEFAULT NULL,
                `id_maquina` int DEFAULT NULL,
                PRIMARY KEY (`id_tarea_costo`),
                KEY `id_maquina` (`id_maquina`),
                CONSTRAINT `id_maquina` FOREIGN KEY (`id_maquina`) REFERENCES `dt_maquinas` (`id_maquina`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
            ");

            $registros_insertados = 0;
            $registros_no_incluidos = 0;

            $conexion_migracion_prueba->beginTransaction();

            $array_usuarios = $array_info_global['codVendedor=>id'];

            $array_ordenes = $array_info_global['n_ordenes|item_op=>id_ordenes'];

            $array_areas = $array_info_global['id_area'];

            foreach($array_dt_tareas as $registro_tareas){

                try{

                    $id_vendedor = array_key_exists($registro_tareas->codVendedor,$array_usuarios)?$array_usuarios[$registro_tareas->codVendedor]:null;
                    $id_ordenes = array_key_exists($registro_tareas->nOrden,$array_ordenes)&&array_key_exists($registro_tareas->item,$array_ordenes[$registro_tareas->nOrden])?$array_ordenes[$registro_tareas->nOrden][$registro_tareas->item]['id_ordenes']:null;
                    $id_area = array_key_exists($registro_tareas->area,$array_areas)?$array_areas[$registro_tareas->area]:null;

                    if(!$id_vendedor){
                        $registros_no_incluidos++;
                        continue;
                    }

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_tareas_costo(id_vendedor,id_usuario,id_costo,n_ordenes,id_ordenes,can_horas,fecha_inicio,cod_material,
                        nombre_costo,id_area,recurso,fecha_inicio_real,fecha_final,observaciones,fecha_pro,fecha_retro)
                        VALUES(:id_vendedor,:id_usuario,:id_costo,:n_ordenes,:id_ordenes,:can_horas,:fecha_inicio,:cod_material,
                        :nombre_costo,:id_area,:recurso,:fecha_inicio_real,:fecha_final,:observaciones,:fecha_pro,:fecha_retro)
                    ");

                    $insert_registro->execute([
                        'id_vendedor' => $id_vendedor,
                        'id_usuario' => 1,
                        'id_costo' => $registro_tareas->id_costo,
                        'n_ordenes' => $registro_tareas->nOrden,
                        'id_ordenes' => $id_ordenes,
                        'can_horas' => $registro_tareas->can_horas,
                        'fecha_inicio' => $registro_tareas->FechaInicio,
                        'cod_material' => $registro_tareas->cod,
                        'nombre_costo' => $registro_tareas->nom_costo,
                        'id_area' => $id_area,
                        'recurso' => $registro_tareas->recurso,
                        'fecha_inicio_real' => $registro_tareas->FechaInicioR,
                        'fecha_final' => $registro_tareas->FechaFinal,
                        'observaciones' => $registro_tareas->Observaciones,
                        'fecha_pro' => $registro_tareas->FechaPro,
                        'fecha_retro' => $registro_tareas->FechaRetro
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "<pre>";
                    echo "Hay un problema con el id_tareas ".$registro_tareas->id_tareas."<br> ".$e->getMessage();exit;
                }

                $registros_insertados++;

            }

            $conexion_migracion_prueba->commit();

            
            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_tareas_costo completada, ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos"."\n<br>".$registros_no_incluidos." registros no incluidos por ser programaciones a usuarios que fueron borrados o con códigos de usuario erroneos";

            return $mensaje;



        }

        public static function migraDtCompras($conexion_sio1,$conexion_migracion_prueba,$array_info_global){


            //Iniciamos timer

            $tiempo_inicio = microtime(true);
            

            //Hacemos el array con la información del dt_compras del Sio 1

            $consulta_dt_compras = $conexion_sio1->query("
                SELECT id_compra,item_oc,proveedor,ordenCompra,fecha_oc,fecha_compromiso,
                fechaAprobo,ops_afecta,ops_afecta,ids_despiece,cantidad_sol,saldo_salida,
                cod_producto,detalle_oc,vUnidad_prod,vTotal_prod,puc_id,puc_prod,puc_contra,
                iva_oc,puc_iva,rtfte_oc,puc_rtfte,rtiva_oc,puc_rtiva,rtica_oc,puc_rtica,
                dto_fin,observa_oc,aprobo_oc,estado_oc,elaboro_oc,formaPago,tipo_inv,
                FechaInicio,Compromiso,cantidadT,descripcionT,contratosP,ops_afecta,
                nit_provee,version
                from dt_compras dc 
            ");


            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_compras` (
                `id_compras` int,
                `item_oc` int NOT NULL,
                `id_proveedores` int DEFAULT NULL,
                `n_compra` int DEFAULT NULL,
                `fecha_oc` datetime DEFAULT NULL,
                `fecha_compromiso` date DEFAULT NULL,
                `fecha_aprobacion` date DEFAULT NULL,
                `n_ordenes` int DEFAULT NULL,
                `id_ordenes` int DEFAULT NULL,
                `id_costos` int DEFAULT NULL,
                `cant_sol` double DEFAULT NULL,
                `saldo_salida` double DEFAULT NULL,
                `cod_producto` varchar(24) DEFAULT NULL,
                `detalle_oc` longtext,
                `vr_unidad` DECIMAL(10, 2) DEFAULT NULL,
                `vr_total` DECIMAL(10, 2) DEFAULT NULL,
                `puc_id` int DEFAULT NULL,
                `puc_prod` int DEFAULT NULL,
                `puc_contra` varchar(12) DEFAULT NULL,
                `iva_oc` double DEFAULT NULL,
                `puc_iva` varchar(12) DEFAULT NULL,
                `rtfte_oc` double DEFAULT NULL,
                `puc_rtfte` varchar(12) DEFAULT NULL,
                `rtiva_oc` double DEFAULT NULL,
                `puc_rtiva` varchar(12) DEFAULT NULL,
                `rtica_oc` double DEFAULT NULL,
                `puc_rtica` varchar(12) DEFAULT NULL,
                `dto_fin` double DEFAULT NULL,
                `observa_oc` longtext,
                `aprobo_oc` int DEFAULT NULL,
                `estado` smallint DEFAULT NULL,
                `id_usuario` int NOT NULL,
                `id_tipo_pago` int DEFAULT NULL,
                `tipo_inv` char(1) DEFAULT NULL,
                `fecha_inicio` date DEFAULT NULL,
                `area_realiza` int DEFAULT NULL,
                `area_entrega` int DEFAULT NULL,
                `cantidad` double DEFAULT NULL,
                `observaciones_os` longtext,
                `consecutivo` int DEFAULT NULL,
                `id_orden` int DEFAULT NULL,
                `id_costo` int DEFAULT NULL,
                `id_compra` int DEFAULT NULL,
                `nit` varchar(15) DEFAULT NULL,
                `n_actualizaciones` int DEFAULT NULL,
                KEY `indx_n_ordenes` (`n_ordenes`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
            ");

            $array_proveedores = $array_info_global['empresa=>id_proveedores'];

            $array_costos = $array_info_global['id_costo=>data_costos'];

            $array_usuarios = $array_info_global['vendedor=>id'];//var_dump($array_usuarios);exit;

            $array_u_complemento = [
                'WILLIAM LOPEZ SORA' => 73,
                'JULIAN RAMIREZ' => 41,
                'FORERO ARTUNDUAGA LAURA NATALIA' => 517,
                'GUZMAN FABIO NELSON' => 100,
                'SANCHEZ MARTINEZ JAZMIN MAGDALENA' => 152,
                'JESSICA PAOLA VARGAS VASQUEZ' => 1008,
                'ING. HERRERA LEON H. YESID' => 23,
                'JAIR ORLANDO MORENO AVENDAÑO' => 149,
                'PABLO VASQUEZ' => 25
            ];

            $array_tipo_pago = $array_info_global['id_tipo_pago'];

            $array_areas = $array_info_global['id_area'];

            $registros_insertados = 0;

            $registros_no_incluidos = 0;

            $conexion_migracion_prueba->beginTransaction();

            while($registro_compras = $consulta_dt_compras->fetch(PDO::FETCH_OBJ)){
                try{

                    $elaboro_oc = rtrim($registro_compras->elaboro_oc);

                    $id_proveedores = array_key_exists($registro_compras->proveedor,$array_proveedores)?$array_proveedores[$registro_compras->proveedor]:null;

                    $n_ordenes = array_key_exists($registro_compras->ids_despiece,$array_costos)?$array_costos[$registro_compras->ids_despiece]['n_ordenes']:null;
                    $id_ordenes = array_key_exists($registro_compras->ids_despiece,$array_costos)?$array_costos[$registro_compras->ids_despiece]['id_ordenes']:null;
                    $id_usuario = array_key_exists($elaboro_oc,$array_usuarios)?$array_usuarios[$elaboro_oc]:null;
                    $id_tipo_pago = array_key_exists($registro_compras->formaPago,$array_tipo_pago)?$array_tipo_pago[$registro_compras->formaPago]:null;
                    $area_entrega = array_key_exists($registro_compras->Compromiso,$array_areas)?$array_areas[$registro_compras->Compromiso]:null;
                 

                    //Algun genio dejo este nombre al contrario en 327160 registros 
                    if(!$id_usuario){
                        $id_usuario = array_key_exists($elaboro_oc,$array_u_complemento)?$array_u_complemento[$elaboro_oc]:null;
                    }


                    if(!$id_usuario){
                        $registros_no_incluidos++;
                        continue;
                    }

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_compras(id_compras,item_oc,id_proveedores,n_compra,fecha_oc,fecha_compromiso,fecha_aprobacion,n_ordenes,
                        id_ordenes,id_costos,cant_sol,saldo_salida,cod_producto,detalle_oc,vr_unidad,vr_total,puc_id,puc_prod,puc_contra,
                        iva_oc,puc_iva,rtfte_oc,puc_rtfte,rtiva_oc,puc_rtiva,rtica_oc,puc_rtica,dto_fin,observa_oc,aprobo_oc,estado,id_usuario,
                        id_tipo_pago,tipo_inv,fecha_inicio,area_realiza,area_entrega,cantidad,observaciones_os,consecutivo,nit,n_actualizaciones) VALUES(:id_compras,:item_oc,:id_proveedores,:n_compra,:fecha_oc,:fecha_compromiso,
                        :fecha_aprobacion,:n_ordenes,:id_ordenes,:id_costos,:cant_sol,:saldo_salida,:cod_producto,:detalle_oc,:vr_unidad,
                        :vr_total,:puc_id,:puc_prod,:puc_contra,:iva_oc,:puc_iva,:rtfte_oc,:puc_rtfte,:rtiva_oc,:puc_rtiva,:rtica_oc,:puc_rtica,
                        :dto_fin,:observa_oc,:aprobo_oc,:estado,:id_usuario,:id_tipo_pago,:tipo_inv,:fecha_inicio,:area_realiza,:area_entrega,
                        :cantidad,:observaciones_os,:consecutivo,:nit,:n_actualizaciones)
                    ");

                    $insert_registro->execute([
                        'id_compras' => $registro_compras->id_compra,
                        'item_oc' => $registro_compras->item_oc,
                        'id_proveedores' => $id_proveedores,
                        'n_compra' => $registro_compras->ordenCompra,
                        'fecha_oc' => $registro_compras->fecha_oc,
                        'fecha_compromiso' => $registro_compras->fecha_compromiso,
                        'fecha_aprobacion' => $registro_compras->fechaAprobo,
                        'n_ordenes' => $n_ordenes,
                        'id_ordenes' => $id_ordenes,
                        'id_costos' => $registro_compras->ids_despiece,
                        'cant_sol' => $registro_compras->cantidad_sol,
                        'saldo_salida' => $registro_compras->saldo_salida,
                        'cod_producto' => $registro_compras->cod_producto,
                        'detalle_oc' => $registro_compras->detalle_oc,
                        'vr_unidad' => $registro_compras->vUnidad_prod,
                        'vr_total' => $registro_compras->vTotal_prod,
                        'puc_id' => $registro_compras->puc_id,
                        'puc_prod' => $registro_compras->puc_prod,
                        'puc_contra' => $registro_compras->puc_contra,
                        'iva_oc' => $registro_compras->iva_oc,
                        'puc_iva' => $registro_compras->puc_iva,
                        'rtfte_oc' => $registro_compras->rtfte_oc,
                        'puc_rtfte' => $registro_compras->puc_rtfte,
                        'rtiva_oc' => $registro_compras->rtiva_oc,
                        'puc_rtiva' => $registro_compras->puc_rtiva,
                        'rtica_oc' => $registro_compras->rtica_oc,
                        'puc_rtica' => $registro_compras->puc_rtica,
                        'dto_fin' => $registro_compras->dto_fin,
                        'observa_oc' => $registro_compras->observa_oc,
                        'aprobo_oc' => $registro_compras->aprobo_oc,
                        'estado' => $registro_compras->estado_oc,
                        'id_usuario' => $id_usuario,
                        'id_tipo_pago' => $id_tipo_pago,
                        'tipo_inv' => $registro_compras->tipo_inv,
                        'fecha_inicio' => $registro_compras->FechaInicio,
                        'area_realiza' => null,
                        'area_entrega' => $area_entrega,
                        'cantidad' => $registro_compras->cantidadT,
                        'observaciones_os' => $registro_compras->descripcionT,
                        'consecutivo' => $registro_compras->contratosP,
                        'nit' => $registro_compras->nit_provee,
                        'n_actualizaciones' => $registro_compras->version
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "<pre>";
                    echo "Hay un problema con el id_tareas ".$registro_compras->id_compra."<br> ".$e->getMessage();exit;
                }

                $registros_insertados++;

            }

            $conexion_migracion_prueba->commit();

            //Asignamos la llave primaria con autoincremental 

            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_compras
                MODIFY id_compras INT AUTO_INCREMENT PRIMARY KEY
            ");

            // Finaliza timer y entregamos mensaje 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_compras completada ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos"."\n<br>".$registros_no_incluidos." registros no incluidos por no tener usuario que elabora la oc o ser un usuario borrado de la bd";

            return $mensaje;

        }

        public static function migraDtRotacion($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Iniciamos timer

            $tiempo_inicio = microtime(true);
            

            //Hacemos el array con la información del dt_rotacion del Sio 1
            
            $consulta_dt_rotacion = $conexion_sio1->query("
                SELECT id_rotacion,orden_compra,cod_prod,doc,item_rt,fecha,cantidad,vUnidad_rot,
                vTotal_rot,id_puc,estado_doc,tipo,id_costo,recibido,elaboro,enviado_a,orden,observaciones_rot,
                Facturas,puc_prodrt,puc_ivart,puc_contra,iva_rt,puc_rtftert,rtfte_rt,puc_rtivart,
                rtiva_rt,puc_rticart,rtica_rt,FA_provee,legalizado,fecha_FA,fecha_vence,letra,letra_cta,
                cons_contable from dt_rotacion dr  order by id_rotacion 
            ");

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_rotacion` (
                `id_rotacion` int,
                `n_compra` int DEFAULT NULL,
                `id_compra` int DEFAULT NULL,
                `cod_prod` varchar(24) DEFAULT NULL,
                `n_rotacion` int DEFAULT NULL,
                `item_rotacion` int DEFAULT NULL,
                `fecha` datetime DEFAULT NULL,
                `cantidad` DECIMAL(10, 2) DEFAULT NULL,
                `vr_unidad` DECIMAL(10, 2) DEFAULT NULL,
                `vr_total` DECIMAL(10, 2) DEFAULT NULL,
                `id_puc` int DEFAULT NULL,
                `estado` smallint DEFAULT NULL,
                `id_tipo_rotacion` int DEFAULT NULL,
                `id_costo` int DEFAULT NULL,
                `id_area` int DEFAULT NULL,
                `id_usuario` int DEFAULT NULL,
                `id_encargado` int DEFAULT NULL,
                `n_ordenes` int DEFAULT NULL,
                `id_ordenes` int DEFAULT NULL,
                `observaciones` varchar(556) DEFAULT NULL,
                `factura` varchar(50) DEFAULT NULL,
                `n_remision_prov` varchar(8) DEFAULT NULL,
                `puc_prodrt` varchar(20) DEFAULT NULL,
                `puc_ivart` varchar(20) DEFAULT NULL,
                `puc_contra` varchar(20) DEFAULT NULL,
                `iva_rt` double DEFAULT NULL,
                `puc_rtftert` varchar(20) DEFAULT NULL,
                `rtfte_rt` double DEFAULT NULL,
                `puc_rtivart` varchar(20) DEFAULT NULL,
                `rtiva_rt` double DEFAULT NULL,
                `puc_rticart` varchar(20) DEFAULT NULL,
                `rtica_rt` double DEFAULT NULL,
                `factura_proveedor` int DEFAULT NULL,
                `fecha_legalizacion` datetime DEFAULT NULL,
                `fecha_factura` date DEFAULT NULL,
                `fecha_vencimiento` date DEFAULT NULL,
                `letra` varchar(2) DEFAULT NULL,
                `letra_cta` varchar(10) DEFAULT NULL,
                `cons_contable` int DEFAULT NULL,
                `id_costos` int DEFAULT NULL,
                `id_compras` int DEFAULT NULL,
                `id_orden` int DEFAULT NULL,
                `id_rotaciones` int DEFAULT NULL,
                `id_inventario` int DEFAULT NULL,
                KEY `fk_inventario` (`id_inventario`),
                KEY `indx_n_rotacion` (`n_rotacion`),
                KEY `indx_cod_prod` (`cod_prod`),
                CONSTRAINT `dt_rotacion_ibfk_1` FOREIGN KEY (`id_inventario`) REFERENCES `dt_inventario` (`id_inventario`)
                ) ENGINE=InnoDB AUTO_INCREMENT=21450 DEFAULT CHARSET=utf8mb3;
            ");

            $array_areas = $array_info_global['id_area'];

            $array_usuarios = $array_info_global['vendedor=>id'];

            $array_codigos = $array_info_global['codigo_prod=>id_inventario'];

            $array_data_compras = $array_info_global['n_compra|cod_producto=>data_compras'];

            $array_id_compras = $array_info_global['id_costos=>id_compras'];

            $array_data_costos = $array_info_global['id_costo=>data_costos'];

            $array_materiales = $array_info_global['codigo_prod=>id_inventario'];

            $registros_insertados = 0;

            $registros_no_incluidos = 0;

            $conexion_migracion_prueba->beginTransaction();

            while($registro_rotaciones = $consulta_dt_rotacion->fetch(PDO::FETCH_OBJ)){

                try{ 

                    //No vamos a incluir las rotaciones tipo 7 por ser duplicados de las 25 que son rotaciones

                    if($registro_rotaciones->tipo == 7){
                        $registros_no_incluidos++;
                        continue;
                    }

                    if($registro_rotaciones->id_costo != null){
                        $id_ordenes = array_key_exists($registro_rotaciones->id_costo,$array_data_costos)?$array_data_costos[$registro_rotaciones->id_costo]['id_ordenes']:null;
                        $id_costo = $registro_rotaciones->id_costo;
                        $id_compra = array_key_exists($registro_rotaciones->id_costo,$array_id_compras)?$array_id_compras[$registro_rotaciones->id_costo]:null; 
                        $n_ordenes  = array_key_exists($registro_rotaciones->id_costo,$array_data_costos)?$array_data_costos[$registro_rotaciones->id_costo]['n_ordenes']:null;
                        $observaciones = $registro_rotaciones->observaciones_rot;
                    }else{
                        $array_sin_id_costo = array_key_exists($registro_rotaciones->orden_compra,$array_data_compras)&&array_key_exists($registro_rotaciones->cod_prod,$array_data_compras[$registro_rotaciones->orden_compra])?$array_data_compras[$registro_rotaciones->orden_compra][$registro_rotaciones->cod_prod]:null;
                        $observaciones = $registro_rotaciones->observaciones_rot." n_ordenes completas: ".$registro_rotaciones->orden;

                        if($array_sin_id_costo != null){

                            $id_ordenes = $array_sin_id_costo['id_ordenes'];
                            $id_costo = $array_sin_id_costo['id_costos'];
                            $id_compra = $array_sin_id_costo['id_compras'];
                            $n_ordenes = $array_sin_id_costo['n_ordenes'];
                            if($registro_rotaciones->tipo == 9){
                                $puc_id = $array_sin_id_costo['puc_id'];
                            }else{
                                $puc_id = null;
                            }
                            
                            
                        }else{

                            $id_ordenes = null;
                            $id_costo = null;
                            $id_compra = null;
                            $n_ordenes = null;
                            $puc_id = null;

                        }

                    }

                    $id_inventario = array_key_exists($registro_rotaciones->cod_prod,$array_materiales)?$array_materiales[$registro_rotaciones->cod_prod]['id_inventario']:null;

                    if($registro_rotaciones->tipo == 13){
                        $id_area = 1;
                    }else{
                        $id_area = array_key_exists($registro_rotaciones->enviado_a,$array_areas)?$array_areas[$registro_rotaciones->enviado_a]:null;
                    }

                    if($registro_rotaciones->tipo == 26){
                        $id_encargado = null;
                    }else{
                        $id_encargado = array_key_exists($registro_rotaciones->enviado_a,$array_usuarios)?$array_usuarios[$registro_rotaciones->enviado_a]:null;
                    }

                    $id_usuario = array_key_exists($registro_rotaciones->elaboro,$array_usuarios)?$array_usuarios[$registro_rotaciones->elaboro]:null;

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_rotacion(id_rotacion,cantidad,cod_prod,cons_contable,estado,factura,factura_proveedor,fecha,fecha_factura,fecha_legalizacion,
                        fecha_vencimiento,id_area,id_compra,id_costo,id_encargado,id_ordenes,id_puc,id_tipo_rotacion,id_usuario,item_rotacion,letra,letra_cta,n_compra,
                        n_ordenes,n_remision_prov,n_rotacion,observaciones,puc_contra,puc_ivart,puc_prodrt,puc_rticart,puc_rtftert,puc_rtivart,rtfte_rt,rtica_rt,rtiva_rt,
                        vr_total,vr_unidad,id_inventario)
                        VALUES(:id_rotacion,:cantidad,:cod_prod,:cons_contable,:estado,:factura,:factura_proveedor,:fecha,:fecha_factura,:fecha_legalizacion,
                        :fecha_vencimiento,:id_area,:id_compra,:id_costo,:id_encargado,:id_ordenes,:id_puc,:id_tipo_rotacion,:id_usuario,:item_rotacion,:letra,:letra_cta,
                        :n_compra,:n_ordenes,:n_remision_prov,:n_rotacion,:observaciones,:puc_contra,:puc_ivart,:puc_prodrt,:puc_rticart,:puc_rtftert,:puc_rtivart,:rtfte_rt,
                        :rtica_rt,:rtiva_rt,:vr_total,:vr_unidad,:id_inventario)
                    ");

                    $insert_registro->execute([
                        'id_rotacion' => $registro_rotaciones->id_rotacion,
                        'cantidad' => $registro_rotaciones->cantidad,
                        'cod_prod' => $registro_rotaciones->cod_prod,
                        'cons_contable' => $registro_rotaciones->cons_contable,
                        'estado' => $registro_rotaciones->estado_doc,
                        'factura' => $registro_rotaciones->Facturas,
                        'factura_proveedor' => $registro_rotaciones->FA_provee,
                        'fecha' => $registro_rotaciones->fecha,
                        'fecha_factura' => $registro_rotaciones->fecha_FA,
                        'fecha_legalizacion' => $registro_rotaciones->legalizado,
                        'fecha_vencimiento' => $registro_rotaciones->fecha_vence,
                        'id_area' => $id_area,
                        'id_compra' => $id_compra,
                        'id_costo' => $id_costo,
                        'id_encargado' => $id_encargado,
                        'id_ordenes' => $id_ordenes,
                        'id_puc' => $puc_id,
                        'id_tipo_rotacion' => $registro_rotaciones->tipo,
                        'id_usuario' => $id_usuario,
                        'item_rotacion' => $registro_rotaciones->item_rt,
                        'letra' => $registro_rotaciones->letra,
                        'letra_cta' => $registro_rotaciones->letra_cta,
                        'n_compra' => $registro_rotaciones->orden_compra,
                        'n_ordenes' => $n_ordenes,
                        'n_remision_prov' => null,
                        'n_rotacion' => $registro_rotaciones->doc,
                        'observaciones' => $observaciones,
                        'puc_contra' => $registro_rotaciones->puc_contra,
                        'puc_ivart' => $registro_rotaciones->puc_ivart,
                        'puc_prodrt' => $registro_rotaciones->puc_prodrt,
                        'puc_rticart' => $registro_rotaciones->puc_rticart,
                        'puc_rtftert' => $registro_rotaciones->puc_rtftert,
                        'puc_rtivart' => $registro_rotaciones->puc_rtivart,
                        'rtfte_rt' => $registro_rotaciones->rtfte_rt,
                        'rtica_rt' => $registro_rotaciones->rtica_rt,
                        'rtiva_rt' => $registro_rotaciones->rtiva_rt,
                        'vr_total' => $registro_rotaciones->vTotal_rot,
                        'vr_unidad' => $registro_rotaciones->vUnidad_rot,
                        'id_inventario' => $id_inventario
                    ]);


                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "<pre>";
                    echo "Hay un problema con el id_rotacion ".$registro_rotaciones->id_rotacion."<br> ".$e->getMessage();exit;
                }

                $registros_insertados++;

            }//while($registro_rotaciones = $consulta_dt_rotacion->fetch(PDO::FETCH_OBJ))
        

            $conexion_migracion_prueba->commit();

            //Asignamos la llave primaria con autoincremental 

            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_rotacion
                MODIFY id_rotacion INT AUTO_INCREMENT PRIMARY KEY
            ");

            // Finaliza timer y entregamos mensaje 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_rotacion completada ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos"."\n<br>".$registros_no_incluidos." registros no incluidos por ser tipo 7 (Duplicados de los traslados tipo 25)";

            return $mensaje;


 
        }

    }

?>