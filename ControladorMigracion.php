<?php

    include 'ControladorInformacionGlobal.php';


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
                PRIMARY KEY (`id_fechas_op`),
                KEY `dt_ordenes1` (`id_ordenes`),
                KEY `fk_dt_fechas_OP_dt_usuarios1` (`id_usuario`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

            ");

            
            //Consultamos las tablas fuente con los datos que necesitamos

            //dt_codprodfinal

            $array_codprodfinal = $array_info_global['cod=>id_codpdrodfinal'];

            

            //dt_cliente 

            $dt_clientes_sio2 = $conexion_migracion_prueba->query("SELECT id_cliente,nit from dt_clientes");

            $array_pdo_clientes = $dt_clientes_sio2->fetchAll(PDO::FETCH_OBJ);

            $array_clientes = [];

            foreach($array_pdo_clientes as $registro_cliente){
                $array_clientes[$registro_cliente->nit] = $registro_cliente->id_cliente;
            }

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
                        $id_cliente = $array_clientes[$registro_dt_ordenes->nit_op];
                    }else{
                        $id_cliente = null;
                    }

                    //Asignamos el cobro

                    $cobro = $registro_dt_ordenes->cobro != null ? $registro_dt_ordenes->cobro:0;

                    //Asignamos id_usuario 

                    $id_usuario = array_key_exists($registro_dt_ordenes->elaboro,$array_info_global['vendedor=>id'])?$array_info_global['vendedor=>id'][$registro_dt_ordenes->elaboro]:null;
                    
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
                        'id_coordinador' => null,
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
            $conexion_migracion_prueba->beginTransaction();

            $array_codprodfinal = $array_info_global['cod=>id_codpdrodfinal'];
            $array_inventario = $array_info_global['codigo_prod=>id_inventario'];
            $array_tipo_script = $array_info_global['tipo_script'];
            $array_acabados = $array_info_global['cod=>id_acabados'];



            foreach($array_dt_plantillas as $registro_dt_plantillas){
                if(!array_key_exists($registro_dt_plantillas->cod_guia,$array_codprodfinal)){continue;}
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

            $mensaje = "Migración dt_plantilla completada ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos";

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


        //Con faltantes dt_costos
        public static function migraDtCostos($conexion_sio1,$conexion_semana_prueba,$conexion_migracion_prueba,$array_convierte_ordenes_item,$array_convierte_vendedor,$array_convierte_codigo_prod,$array_convierte_acabado){

            ini_set('memory_limit', '4100M');
            set_time_limit(3400);
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
                fechaCierre  FROM dt_costos WHERE YEAR(fecha_costo) = 2018 ORDER BY id_costo 
            ");

            $array_dt_costos = $consulta_dt_costos->fetchAll(PDO::FETCH_OBJ);

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
                `valor_unit` DECIMAL(10, 2) DEFAULT NULL,
                `vr_unid` DECIMAL(10, 2) DEFAULT NULL,
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

            $array_materiales = $array_convierte_codigo_prod;
            $array_acabados = $array_convierte_acabado;
            $array_usuarios = $array_convierte_vendedor;
            $array_ordenes = $array_convierte_ordenes_item;

            $registros_insertados = 0;
            $conexion_migracion_prueba->beginTransaction();


            foreach($array_dt_costos as $registro_dt_costos){

                try{ 
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
                        'id_ordenes' => array_key_exists($registro_dt_costos->nDoc,$array_ordenes) && array_key_exists($registro_dt_costos->op_item,$array_ordenes[$registro_dt_costos->nDoc])?$array_ordenes[$registro_dt_costos->nDoc][$registro_dt_costos->op_item]:6249,
                        'id_cotizacion' => 1,
                        'n_cotiza' => $registro_dt_costos->nCT,
                        'id_tipo_costo' => $registro_dt_costos->tipo_costo,
                        'id_clase_costo' => $registro_dt_costos->clase_costo,
                        'cod_material' => $registro_dt_costos->cod_material,
                        'nombre_costo' => $registro_dt_costos->nom_costo,
                        'id_acabados' => array_key_exists($registro_dt_costos->cod_material,$array_acabados)?$array_acabados[$registro_dt_costos->cod_material]:null,
                        'id_inventario' => array_key_exists($registro_dt_costos->cod_material,$array_materiales)?$array_materiales[$registro_dt_costos->cod_material]['id_inventario']:null,
                        'id_usuario' => array_key_exists($registro_dt_costos->responsable,$array_usuarios)?$array_usuarios[$registro_dt_costos->responsable]:null,
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
                    $conexion_migracion_prueba->rollback();
                    echo "Error en el id_costo: ".$registro_dt_costos->id_costo."<br>".$e->getMessage();exit;
                }

                $registros_insertados++;

            }//FIN foreach($array_dt_costos as $registro_dt_costos)

            $conexion_migracion_prueba->commit();

            //Asignamos la llave primaria con autoincremental 

            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_costos
                MODIFY id_costo INT AUTO_INCREMENT PRIMARY KEY
            ");

            // Finaliza timer y entregamos mensaje 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_costos completada ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos";

            return $mensaje;



        }

    }

?>