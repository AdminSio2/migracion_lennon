<?php

    class ControladorFuncionesAuxiliares{

        
        public static function actualizaAuthAssignment($conexion_migracion_prueba){
            try{

                $conexion_migracion_prueba->exec("
                    DROP TABLE IF EXISTS `auth_assignment`;
                    CREATE TABLE `auth_assignment` (
                        `item_name` varchar(64) NOT NULL,
                        `user_id` int NOT NULL,
                        `created_at` int DEFAULT NULL,
                        PRIMARY KEY (`item_name`,`user_id`),
                        KEY `user_id` (`user_id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
                    
                    
                    LOCK TABLES `auth_assignment` WRITE;
                    /*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
                    INSERT INTO `auth_assignment` VALUES ('Admin',1,1542641803),('Admin',5,1554821342),('AdminComercial',21,1567111467),('AdminComercial',370,1567111559),('AuxiliarAlmacen',1169,1703174675),('AuxiliarCompras',955,1703092249),('AuxiliarContable',55,1622561435),('AuxiliarFacturacion',94,1622126700),('AuxiliarFacturacion',108,1703167239),('AuxiliarLogistica',110,1703178854),('AuxiliarLogistica',1120,1616610723),('AuxiliarNomina',93,1622126921),('Commercial',83,1616113599),('CoordinadorLogistica',1172,1616610551),('CoordinadorProyectos',1164,1702963973),('CoordinadorProyectos',1165,1620082102),('CordinadorProyectos',23,1620082806),('CordinadorProyectos',89,1620082949),('CordinadorProyectos',90,1620083352),('CordinadorProyectos',742,1620082696),('DirectorAdministrativo',12,1703012183),('DirectorAdministrativo',13,1618348059),('DirectorComercial',18,1561558971),('DirectorComercial',19,1562352426),('DirectorComercial',22,1564431147),('DirectorComercial',24,1575058042),('DirectorComercial',782,1558628741),('DirectorFacturacion',92,1622126145),('DirectorFacturacion',370,1703166369),('DirectorLogistica',11,1558628873),('DirectorLogistica',84,1616193679),('DirectorProduccion',85,1616194033),('DirectorProduccion',1143,1558629016),('DirectorRH',81,1616099948),('DirectorRH',82,1616099931),('DirectorRH',689,1542718664),('DirectorVivas',10,1558628688),('DirectorVivas',25,1575900768),('Disenador',1117,1702987867),('Disenador',1145,1702987916),('Disenador',1153,1702987640),('JefeAlmacen',96,1648765275),('JefeAlmacen',955,1616609450),('JefeAlmacen2',38,1703174222),('JefeCompras',87,1637784620),('JefeCompras',96,1648765275),('JefeCompras',782,1616164078),('JefeCompras',1172,1680116631),('LiderCostos',100,1662133858),('LiderCostos',1124,1616607567),('LiderDiseno',383,1616608448),('Operador',30,1576672972),('Operador',31,1576672956),('Operador',40,1703081003),('Operador',47,1703177135),('Operador',62,1657821121),('Operador',67,1616173514),('Operador',98,1654872054),('Operador',865,1703178517),('Operador',1106,1576672849),('Operador',1169,1576672754),('ProgramadorOperaciones',1141,1651581277),('ProgramadorOperaciones',1143,1651521169),('SuperCoordinador',3,1561558659),('SuperCoordinador',8,1564431182),('SuperCoordinador',9,1561585200),('SuperDiseñador',95,1649456085),('SuperDiseñador',383,1575902106),('SuperMercadeo',9,1616163286),('SuperMercadeo',16,1563480008),('SuperMercadeo',17,1564176208);
                    /*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
                    UNLOCK TABLES;
                ");

            }catch(PDOException $e){
                echo "Fallo en la actualización de auth_assignment ".$e->getMessage();exit;
            }

            return "Actualización completa de la tabla auth_assignment a los valores de la primera semana de prueba";
        }

        public static function formateaString($string_formatear){


            if(strpos($string_formatear, '├æ') !== false){
                $string_formateado = str_replace('├æ', 'Ñ', $string_formatear);
            }
            elseif(strpos($string_formatear, '├▒') !== false){
                $string_formateado = str_replace('├▒', 'ñ', $string_formatear);
            }
            elseif(strpos($string_formatear, '├ô') !== false){
                $string_formateado = str_replace('├ô', 'Ó', $string_formatear);
            }
            elseif(strpos($string_formatear, '├Æ') !== false){
                $string_formateado = str_replace('├Æ', 'Ó', $string_formatear);
            }
            elseif(strpos($string_formatear, '├│') !== false){
                $string_formateado = str_replace('├│', 'ó', $string_formatear);
            }
            elseif(strpos($string_formatear, '├▓') !== false){
                $string_formateado = str_replace('├▓', 'ó', $string_formatear);
            }
            elseif(strpos($string_formatear, '├Ü') !== false){
                $string_formateado = str_replace('├Ü', 'Ú', $string_formatear);
            }
            elseif(strpos($string_formatear, '├ì') !== false){
                $string_formateado = str_replace('├ì', 'Í', $string_formatear);
            }
            elseif(strpos($string_formatear, '├¡') !== false){
                $string_formateado = str_replace('├ì', 'í', $string_formatear);
            }
            elseif(strpos($string_formatear, '├®') !== false){
                $string_formateado = str_replace('├®', 'é', $string_formatear);
            }
            elseif(strpos($string_formatear, '├ë') !== false){
                $string_formateado = str_replace('├ë', 'É', $string_formatear);
            }
            else{
                $string_formateado = $string_formatear;
            }

            return $string_formateado;

        }

        public static function creaTablasGarantia($conexion_migracion_prueba){

            try{

                $conexion_migracion_prueba->exec("


                
                CREATE TABLE `dt_comite_g_r` (
                    `id_comite_g_r` int NOT NULL AUTO_INCREMENT,
                    `fecha_comite` date NOT NULL,
                    `observacion` varchar(256) DEFAULT NULL,
                    `valor_g_r_f` double DEFAULT NULL,
                    `user_id` int NOT NULL,
                    `n_solicitud` int NOT NULL,
                    PRIMARY KEY (`id_comite_g_r`),
                    UNIQUE KEY `dt_comite_g_r_n_solicitud_idx` (`n_solicitud`) USING BTREE
                  ) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb3;

                  CREATE TABLE `dt_comite_g_r_f` (
                    `id_comite_g_r_f` int NOT NULL AUTO_INCREMENT,
                    `fecha_comite_f` date NOT NULL,
                    `observacion_f` varchar(256) DEFAULT NULL,
                    `valor_g_r_f` double DEFAULT NULL,
                    `id_user` int NOT NULL,
                    `n_solicitud` int NOT NULL,
                    PRIMARY KEY (`id_comite_g_r_f`),
                    UNIQUE KEY `dt_comite_g_r_f_n_solicitud_idx` (`n_solicitud`) USING BTREE,
                    KEY `fk_dt_comite_g_r_f_user1` (`id_user`),
                    CONSTRAINT `fk_dt_comite_g_r_f_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
                  ) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
                
                
                    CREATE TABLE `dt_actividades` (
                        `id_acitvidades_forma` int NOT NULL AUTO_INCREMENT,
                        `fecha_registro` date NOT NULL,
                        `analisis_forma` varchar(608) NOT NULL,
                        `actividad` varchar(608) NOT NULL,
                        `fecha_inicio` date NOT NULL,
                        `fecha_fin` date NOT NULL,
                        `orden` int NOT NULL,
                        `tipo` int NOT NULL,
                        `id_user` int NOT NULL,
                        `responsable` int NOT NULL,
                        `id_comite_g_r` int NOT NULL,
                        `n_solicitud` int DEFAULT NULL,
                        PRIMARY KEY (`id_acitvidades_forma`),
                        KEY `fk_dt_acitvidades_forma_user1` (`id_user`),
                        KEY `fk_dt_acitvidades_user1` (`responsable`),
                        KEY `fk_dt_acitvidades_dt_comite_g_r1` (`id_comite_g_r`),
                        CONSTRAINT `fk_dt_acitvidades_dt_comite_g_r1` FOREIGN KEY (`id_comite_g_r`) REFERENCES `dt_comite_g_r` (`id_comite_g_r`),
                        CONSTRAINT `fk_dt_acitvidades_forma_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
                        CONSTRAINT `fk_dt_acitvidades_user1` FOREIGN KEY (`responsable`) REFERENCES `user` (`id`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=271 DEFAULT CHARSET=utf8mb3;
                    
                    
                    CREATE TABLE `dt_actividades_f` (
                        `id_actividades_forma` int NOT NULL AUTO_INCREMENT,
                        `fecha_registro` date NOT NULL,
                        `analisis_forma` varchar(608) NOT NULL,
                        `actividad` varchar(608) NOT NULL,
                        `fecha_inicio` date NOT NULL,
                        `fecha_fin` date NOT NULL,
                        `orden` int NOT NULL,
                        `tipo` int NOT NULL,
                        `id_user` int NOT NULL,
                        `responsable` int NOT NULL,
                        `id_comite_g_r_f` int NOT NULL,
                        `n_solicitud` int DEFAULT NULL,
                        PRIMARY KEY (`id_actividades_forma`),
                        KEY `fk_dt_acitvidades_forma_user10` (`id_user`),
                        KEY `fk_dt_acitvidades_user10` (`responsable`),
                        KEY `fk_dt_acitvidades_f_dt_comite_g_r_f1` (`id_comite_g_r_f`),
                        CONSTRAINT `fk_dt_acitvidades_f_dt_comite_g_r_f1` FOREIGN KEY (`id_comite_g_r_f`) REFERENCES `dt_comite_g_r_f` (`id_comite_g_r_f`),
                        CONSTRAINT `fk_dt_acitvidades_forma_user10` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
                        CONSTRAINT `fk_dt_acitvidades_user10` FOREIGN KEY (`responsable`) REFERENCES `user` (`id`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;


                    
                    CREATE TABLE `dt_aprobado_g_r` (
                        `id_aprobado_g_r` int NOT NULL AUTO_INCREMENT,
                        `observacion` varchar(256) DEFAULT NULL,
                        `fecha_registro` date NOT NULL,
                        `id_solicitud_g_r` int NOT NULL,
                        `user_id` int NOT NULL,
                        PRIMARY KEY (`id_aprobado_g_r`),
                        KEY `fk_dt_aprobado_g_r_dt_solicitud_g_r1` (`id_solicitud_g_r`),
                        KEY `fk_dt_aprobado_g_r_user1` (`user_id`),
                        CONSTRAINT `fk_dt_aprobado_g_r_dt_solicitud_g_r1` FOREIGN KEY (`id_solicitud_g_r`) REFERENCES `dt_solicitud_g_r` (`id_solicitud_g_r`),
                        CONSTRAINT `fk_dt_aprobado_g_r_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3;

                

                ");
            }catch(PDOException $e){
                echo "Error al generar las tablas complementarias a dt_solicitud_g_r".$e->getMessage();exit;
            }

            return "Se crearon las tablas dt_actividades, dt_actividades_f, dt_aprobado_g_r,dt_comite_g_r_f y dt_comite_g_r complemetarias a dt_solicitud_g_r";


        }

        public static function creaTablaDtProgramacionDisenoOrdenes($conexion_migracion_prueba){

            try{ 
            
                $conexion_migracion_prueba->exec("
                    CREATE TABLE `dt_programacion_diseno_dt_ordenes` (
                        `id_programacion_diseno` int NOT NULL,
                        `dt_ordenes_id_ordenes` int NOT NULL,
                        PRIMARY KEY (`id_programacion_diseno`,`dt_ordenes_id_ordenes`),
                        KEY `fk_dt_programacion_diseno_has_dt_ordenes_dt_ordenes1` (`dt_ordenes_id_ordenes`),
                        CONSTRAINT `fk_dt_programacion_diseno_has_dt_ordenes_dt_ordenes1` FOREIGN KEY (`dt_ordenes_id_ordenes`) REFERENCES `dt_ordenes` (`id_ordenes`),
                        CONSTRAINT `fk_dt_programacion_diseno_has_dt_ordenes_dt_programacion_dise1` FOREIGN KEY (`id_programacion_diseno`) REFERENCES `dt_programacion_diseno` (`id_programacion_diseno`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
                ");

            }catch(PDOException $e){
                echo "Error al generar las tablas dt_programacion_diseno_dt_ordenes complementaria a dt_programacion_diseno".$e->getMessage();exit;
            }

            return "Se creó las tabla dt_programacion_diseno_dt_ordenes complemetaria a dt_programacion_diseno_dt_ordenes";
        }

        public static function corrijeDtCodprodfinal($conexion_migracion_prueba,$array_info_global){
            
            //Iniciamos timer

            $tiempo_inicio = microtime(true);

            $consulta_dt_codprodfinal = $conexion_migracion_prueba->query("SELECT id_codprodfinal,tam_x,tam_y,tam_z,tam_l,nom_codigo FROM dt_codprodfinal");

            $array_dt_codprodfinal = $consulta_dt_codprodfinal->fetchAll(PDO::FETCH_OBJ);

            $conexion_migracion_prueba->exec("
            
                ALTER TABLE dt_codprodfinal
                MODIFY tam_x DECIMAL(10,2) DEFAULT NULL;

                ALTER TABLE dt_codprodfinal
                MODIFY tam_y DECIMAL(10,2) DEFAULT NULL;

                ALTER TABLE dt_codprodfinal
                MODIFY tam_z DECIMAL(10,2) DEFAULT NULL;

                ALTER TABLE dt_codprodfinal
                MODIFY tam_l DECIMAL(10,2) DEFAULT NULL;
            

            ");


            $array_data_cod_sio1 = $array_info_global['id_cod=>medidas_codigos'];

            $conexion_migracion_prueba->beginTransaction();

            $registros_corregidos = 0;

            foreach($array_dt_codprodfinal as $registro_codprodfinal){

                try{
                    if(array_key_exists($registro_codprodfinal->id_codprodfinal,$array_data_cod_sio1)){
                        $tam_x = $array_data_cod_sio1[$registro_codprodfinal->id_codprodfinal]['tamX'];
                        $tam_y = $array_data_cod_sio1[$registro_codprodfinal->id_codprodfinal]['tamY'];
                        $tam_z = $array_data_cod_sio1[$registro_codprodfinal->id_codprodfinal]['tamZ'];
                        $tam_l = $array_data_cod_sio1[$registro_codprodfinal->id_codprodfinal]['tamL'];
                    }else{
                        $tam_x = null;
                        $tam_y = null;
                        $tam_z = null;
                        $tam_l = null;
                    }

                    $nom_codigo = ControladorFuncionesAuxiliares::formateaString($registro_codprodfinal->nom_codigo);
                    

                    $update_codprodfinal = $conexion_migracion_prueba->prepare("UPDATE dt_codprodfinal SET tam_x = :tam_x,tam_y = :tam_y,tam_z = :tam_z,tam_l = :tam_l,nom_codigo = :nom_codigo WHERE id_codprodfinal = :id_codprodfinal");

                    $update_codprodfinal->execute([
                        'tam_x' => $tam_x,
                        'tam_y' => $tam_y,
                        'tam_z' => $tam_z,
                        'tam_l' => $tam_l,
                        'nom_codigo' => $nom_codigo,
                        'id_codprodfinal' => $registro_codprodfinal->id_codprodfinal
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "Hubo un error en el id_codprodfinal".$registro_codprodfinal->id_codprodfinal."<br>".$e->getMessage();
                    exit;
                }

                $registros_corregidos++;

            }

            $conexion_migracion_prueba->commit();

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Corrección dt_codprodfinal completada ".$registros_corregidos." registros corregidos en ".$tiempo_transcurrido." segundos";

            return $mensaje;

        }

        public static function corrigeDtInfContableProve($conexion_migracion_prueba,$array_info_global){

            //Iniciamos timer

            $tiempo_inicio = microtime(true);

            $array_check_ica = $array_info_global['id_proveedor=>descuento_ica'];

            $conexion_migracion_prueba->beginTransaction();

            $registros_corregidos = 0;
 
            foreach($array_check_ica as $id_proveedor => $ica_prove){

                try{

                    $update_prove = $conexion_migracion_prueba->prepare("UPDATE dt_inf_contable_prove SET ica_prove = :ica_prove WHERE id_proveedores = :id_proveedores");

                    $update_prove->execute([
                        'id_proveedores' => $id_proveedor,
                        'ica_prove' => $ica_prove
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "Hubo un problema con el id_proveedor ".$registro_prove['id_proveedores']."<br>".$e->getMessage();exit;
                    exit;
                }

                $registros_corregidos++;
            }

            $conexion_migracion_prueba->commit();

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Corrección dt_inf_contable_prove completada ".$registros_corregidos." registros corregidos en ".$tiempo_transcurrido." segundos";

            return $mensaje;

        }    

        public static function corrigeDtInventario($conexion_migracion_prueba){

            //Iniciamos timer

            $tiempo_inicio = microtime(true);

            $array_familias_corregidas = [ 
                1=>
                19,
                3=>
                9,
                4=>
                9,
                5=>
                9,
                6=>
                9,
                7=>
                9,
                8=>
                19,
                9=>
                9,
                10=>
                9,
                13=>
                12,
                14=>
                9,
                15=>
                9,
                16=>
                9,
                17=>
                9,
                19=>
                9,
                24=>
                12,
                26=>
                12,
                27=>
                9,
                28=>
                9,
                29=>
                18,
                30=>
                18,
                31=>
                19,
                32=>
                19,
                33=>
                19,
                34=>
                6,
                35=>
                12,
                36=>
                6,
                37=>
                6,
                38=>
                6,
                39=>
                6,
                40=>
                6,
                42=>
                6,
                43=>
                6,
                44=>
                6,
                45=>
                18,
                46=>
                6,
                47=>
                6,
                48=>
                6,
                49=>
                6,
                50=>
                6,
                55=>
                11,
                56=>
                18,
                57=>
                11,
                59=>
                11,
                60=>
                11,
                61=>
                11,
                62=>
                6,
                64=>
                11,
                66=>
                11,
                67=>
                18,
                69=>
                11,
                70=>
                6,
                71=>
                6,
                72=>
                6,
                73=>
                6,
                74=>
                6,
                75=>
                6,
                76=>
                6,
                77=>
                6,
                78=>
                18,
                79=>
                6,
                80=>
                6,
                81=>
                6,
                82=>
                6,
                83=>
                6,
                84=>
                6,
                85=>
                6,
                86=>
                6,
                87=>
                6,
                88=>
                6,
                89=>
                12,
                90=>
                6,
                91=>
                6,
                93=>
                6,
                94=>
                6,
                95=>
                6,
                96=>
                6,
                97=>
                6,
                98=>
                6,
                99=>
                6,
                100=>
                18,
                101=>
                6,
                102=>
                6,
                103=>
                6,
                104=>
                6,
                105=>
                6,
                106=>
                6,
                107=>
                6,
                108=>
                6,
                109=>
                6,
                110=>
                6,
                111=>
                18,
                112=>
                18,
                113=>
                18,
                114=>
                18,
                115=>
                18,
                116=>
                18,
                117=>
                18,
                120=>
                6,
                121=>
                6,
                122=>
                18,
                123=>
                19,
                131=>
                6,
                132=>
                6,
                133=>
                18,
                135=>
                6,
                136=>
                6,
                139=>
                6,
                140=>
                6,
                141=>
                6,
                142=>
                6,
                143=>
                11,
                144=>
                18,
                145=>
                11,
                146=>
                11,
                147=>
                11,
                148=>
                11,
                149=>
                11,
                150=>
                11,
                153=>
                11,
                154=>
                18,
                158=>
                11,
                159=>
                11,
                161=>
                11,
                163=>
                11,
                164=>
                11,
                168=>
                11,
                169=>
                11,
                170=>
                11,
                171=>
                11,
                172=>
                11,
                173=>
                11,
                174=>
                11,
                175=>
                11,
                176=>
                11,
                177=>
                11,
                178=>
                11,
                179=>
                11,
                180=>
                5,
                181=>
                19,
                182=>
                11,
                183=>
                11,
                184=>
                11,
                185=>
                11,
                186=>
                18,
                187=>
                11,
                188=>
                11,
                189=>
                11,
                190=>
                11,
                191=>
                11,
                192=>
                11,
                193=>
                11,
                194=>
                11,
                195=>
                11,
                196=>
                11,
                197=>
                18,
                198=>
                11,
                199=>
                11,
                200=>
                11,
                201=>
                11,
                202=>
                11,
                203=>
                11,
                204=>
                11,
                205=>
                11,
                206=>
                11,
                207=>
                11,
                208=>
                18,
                209=>
                11,
                210=>
                11,
                211=>
                11,
                212=>
                11,
                213=>
                11,
                214=>
                11,
                215=>
                11,
                216=>
                11,
                217=>
                11,
                219=>
                19,
                220=>
                18,
                221=>
                11,
                222=>
                11,
                223=>
                11,
                224=>
                11,
                225=>
                11,
                229=>
                11,
                230=>
                11,
                231=>
                18,
                232=>
                11,
                233=>
                18,
                234=>
                11,
                235=>
                11,
                236=>
                11,
                237=>
                11,
                238=>
                11,
                239=>
                18,
                240=>
                11,
                241=>
                11,
                242=>
                18,
                243=>
                18,
                244=>
                11,
                245=>
                11,
                246=>
                11,
                247=>
                18,
                249=>
                12,
                251=>
                12,
                253=>
                18,
                264=>
                18,
                268=>
                5,
                275=>
                18,
                286=>
                18,
                302=>
                5,
                305=>
                5,
                308=>
                18,
                313=>
                5,
                315=>
                5,
                316=>
                5,
                319=>
                18,
                330=>
                19,
                331=>
                18,
                336=>
                5,
                342=>
                18,
                352=>
                5,
                353=>
                18,
                361=>
                5,
                367=>
                5,
                375=>
                12,
                383=>
                5,
                387=>
                5,
                389=>
                5,
                394=>
                5,
                396=>
                5,
                397=>
                18,
                398=>
                5,
                400=>
                5,
                403=>
                5,
                404=>
                5,
                406=>
                5,
                407=>
                18,
                408=>
                5,
                413=>
                5,
                414=>
                5,
                418=>
                18,
                426=>
                5,
                427=>
                5,
                429=>
                18,
                430=>
                5,
                432=>
                5,
                437=>
                5,
                440=>
                18,
                441=>
                5,
                443=>
                5,
                444=>
                5,
                445=>
                5,
                446=>
                5,
                449=>
                18,
                451=>
                18,
                452=>
                5,
                454=>
                5,
                455=>
                5,
                456=>
                5,
                457=>
                5,
                459=>
                5,
                460=>
                5,
                462=>
                9,
                463=>
                5,
                465=>
                5,
                466=>
                5,
                467=>
                5,
                471=>
                5,
                473=>
                9,
                474=>
                5,
                479=>
                5,
                482=>
                5,
                484=>
                9,
                486=>
                5,
                489=>
                5,
                491=>
                5,
                495=>
                9,
                506=>
                9,
                517=>
                9,
                518=>
                5,
                528=>
                9,
                536=>
                5,
                540=>
                5,
                542=>
                5,
                544=>
                5,
                545=>
                5,
                548=>
                5,
                551=>
                9,
                552=>
                5,
                553=>
                5,
                555=>
                5,
                557=>
                5,
                558=>
                5,
                562=>
                9,
                571=>
                5,
                573=>
                9,
                575=>
                5,
                577=>
                5,
                579=>
                5,
                582=>
                5,
                584=>
                9,
                588=>
                5,
                590=>
                5,
                592=>
                5,
                594=>
                14,
                595=>
                9,
                597=>
                17,
                598=>
                17,
                599=>
                17,
                600=>
                17,
                601=>
                17,
                602=>
                17,
                603=>
                17,
                604=>
                17,
                605=>
                17,
                606=>
                9,
                607=>
                17,
                608=>
                17,
                609=>
                17,
                612=>
                14,
                614=>
                12,
                615=>
                14,
                616=>
                14,
                617=>
                9,
                619=>
                14,
                620=>
                14,
                621=>
                14,
                623=>
                14,
                624=>
                14,
                625=>
                12,
                626=>
                14,
                627=>
                14,
                628=>
                9,
                629=>
                14,
                630=>
                12,
                631=>
                14,
                632=>
                12,
                633=>
                12,
                635=>
                12,
                636=>
                14,
                637=>
                14,
                638=>
                14,
                639=>
                9,
                650=>
                9,
                655=>
                13,
                656=>
                13,
                657=>
                13,
                658=>
                13,
                659=>
                13,
                660=>
                13,
                662=>
                9,
                665=>
                14,
                673=>
                9,
                680=>
                13,
                681=>
                13,
                682=>
                19,
                684=>
                9,
                685=>
                12,
                686=>
                8,
                687=>
                8,
                688=>
                19,
                689=>
                19,
                690=>
                12,
                691=>
                15,
                692=>
                15,
                693=>
                15,
                694=>
                15,
                696=>
                15,
                697=>
                15,
                698=>
                15,
                699=>
                15,
                700=>
                15,
                706=>
                9,
                707=>
                15,
                709=>
                15,
                710=>
                15,
                711=>
                15,
                712=>
                15,
                713=>
                15,
                715=>
                15,
                716=>
                15,
                717=>
                9,
                718=>
                15,
                719=>
                15,
                721=>
                15,
                722=>
                15,
                724=>
                19,
                725=>
                19,
                726=>
                19,
                727=>
                19,
                728=>
                9,
                729=>
                19,
                730=>
                19,
                731=>
                19,
                737=>
                19,
                739=>
                9,
                750=>
                9,
                761=>
                9,
                768=>
                15,
                773=>
                9,
                776=>
                21,
                777=>
                21,
                778=>
                21,
                784=>
                9,
                789=>
                21,
                790=>
                21,
                791=>
                21,
                792=>
                21,
                793=>
                21,
                795=>
                9,
                797=>
                8,
                799=>
                21,
                800=>
                21,
                801=>
                21,
                803=>
                19,
                806=>
                9,
                808=>
                12,
                809=>
                12,
                810=>
                12,
                811=>
                12,
                812=>
                12,
                813=>
                12,
                814=>
                12,
                815=>
                12,
                816=>
                12,
                817=>
                9,
                818=>
                12,
                819=>
                12,
                820=>
                19,
                821=>
                12,
                822=>
                12,
                823=>
                19,
                824=>
                12,
                825=>
                12,
                826=>
                12,
                827=>
                12,
                828=>
                9,
                829=>
                19,
                831=>
                12,
                832=>
                19,
                833=>
                12,
                834=>
                12,
                835=>
                12,
                837=>
                19,
                838=>
                19,
                839=>
                9,
                841=>
                12,
                842=>
                12,
                843=>
                12,
                844=>
                12,
                845=>
                12,
                846=>
                12,
                847=>
                12,
                848=>
                12,
                849=>
                12,
                850=>
                9,
                851=>
                8,
                852=>
                12,
                853=>
                12,
                854=>
                12,
                855=>
                12,
                856=>
                12,
                858=>
                12,
                859=>
                12,
                860=>
                12,
                861=>
                9,
                862=>
                9,
                864=>
                6,
                865=>
                11,
                866=>
                9,
                867=>
                9,
                868=>
                9,
                869=>
                9,
                870=>
                9,
                871=>
                9,
                873=>
                9,
                875=>
                9,
                876=>
                9,
                877=>
                11,
                895=>
                19,
                897=>
                22,
                898=>
                22,
                900=>
                5,
                901=>
                5,
                903=>
                13,
                905=>
                13,
                906=>
                13,
                907=>
                13,
                908=>
                13,
                909=>
                13,
                910=>
                13,
                911=>
                13,
                916=>
                13,
                917=>
                13,
                918=>
                19,
                919=>
                13,
                920=>
                13,
                921=>
                19,
                922=>
                18,
                923=>
                18,
                924=>
                18,
                925=>
                18,
                926=>
                18,
                928=>
                19,
                929=>
                8,
                930=>
                18,
                931=>
                18,
                932=>
                9,
                933=>
                9,
                934=>
                9,
                935=>
                12,
                936=>
                11,
                937=>
                11,
                938=>
                12,
                940=>
                9,
                941=>
                19,
                942=>
                15,
                943=>
                18,
                944=>
                18,
                945=>
                15,
                957=>
                15,
                958=>
                12,
                963=>
                11,
                975=>
                11,
                1008=>
                11,
                1010=>
                11,
                1015=>
                11,
                1016=>
                14,
                1017=>
                14,
                1018=>
                14,
                1019=>
                14,
                1020=>
                14,
                1021=>
                14,
                1022=>
                14,
                1023=>
                14,
                1024=>
                14,
                1029=>
                19,
                1030=>
                19,
                1031=>
                14,
                1032=>
                14,
                1035=>
                13,
                1037=>
                13,
                1038=>
                13,
                1039=>
                13,
                1040=>
                13,
                1042=>
                13,
                1043=>
                13,
                1044=>
                13,
                1045=>
                6,
                1046=>
                6,
                1047=>
                6,
                1048=>
                6,
                1049=>
                6,
                1050=>
                6,
                1051=>
                6,
                1053=>
                5,
                1054=>
                5,
                1055=>
                5,
                1056=>
                5,
                1057=>
                5,
                1058=>
                5,
                1059=>
                5,
                1060=>
                5,
                1061=>
                5,
                1062=>
                5,
                1063=>
                5,
                1064=>
                5,
                1065=>
                5,
                1066=>
                5,
                1067=>
                13,
                1068=>
                13,
                1069=>
                13,
                1070=>
                13,
                1071=>
                13,
                1072=>
                13,
                1073=>
                13,
                1074=>
                13,
                1075=>
                13,
                1076=>
                13,
                1077=>
                13,
                1078=>
                13,
                1079=>
                13,
                1080=>
                13,
                1081=>
                13,
                1082=>
                4,
                1083=>
                15,
                1084=>
                19,
                1089=>
                9,
                1090=>
                9,
                1091=>
                6,
                1093=>
                6,
                1095=>
                6,
                1096=>
                6,
                1097=>
                6,
                1099=>
                6,
                1101=>
                6,
                1102=>
                6,
                1103=>
                6,
                1106=>
                15,
                1107=>
                5,
                1109=>
                17,
                1110=>
                19,
                1111=>
                15,
                1112=>
                11,
                1113=>
                17,
                1114=>
                8,
                1118=>
                19,
                1119=>
                9,
                1120=>
                12,
                1121=>
                9,
                1122=>
                12,
                1123=>
                13,
                1124=>
                13,
                1125=>
                13,
                1126=>
                13,
                1127=>
                13,
                1128=>
                13,
                1129=>
                13,
                1130=>
                19,
                1131=>
                12,
                1132=>
                19,
                1134=>
                14,
                1135=>
                14,
                1136=>
                14,
                1137=>
                14,
                1138=>
                11,
                1139=>
                11,
                1140=>
                11,
                1141=>
                11,
                1142=>
                11,
                1143=>
                11,
                1144=>
                11,
                1145=>
                11,
                1146=>
                11,
                1147=>
                11,
                1148=>
                11,
                1149=>
                11,
                1150=>
                11,
                1151=>
                11,
                1152=>
                11,
                1153=>
                11,
                1154=>
                11,
                1155=>
                11,
                1156=>
                11,
                1157=>
                4,
                1158=>
                11,
                1159=>
                18,
                1160=>
                19,
                1161=>
                11,
                1162=>
                18,
                1163=>
                18,
                1164=>
                9,
                1165=>
                9,
                1166=>
                9,
                1167=>
                9,
                1168=>
                18,
                1169=>
                11,
                1170=>
                19,
                1171=>
                11,
                1172=>
                11,
                1173=>
                9,
                1174=>
                9,
                1175=>
                11,
                1176=>
                21,
                1179=>
                5,
                1180=>
                5,
                1181=>
                5,
                1182=>
                5,
                1183=>
                5,
                1184=>
                5,
                1185=>
                5,
                1186=>
                5,
                1187=>
                5,
                1188=>
                21,
                1189=>
                21,
                1190=>
                21,
                1191=>
                21,
                1192=>
                21,
                1193=>
                21,
                1194=>
                21,
                1195=>
                21,
                1196=>
                21,
                1197=>
                21,
                1198=>
                21,
                1199=>
                21,
                1201=>
                21,
                1202=>
                21,
                1203=>
                21,
                1204=>
                21,
                1205=>
                21,
                1206=>
                21,
                1207=>
                21,
                1208=>
                21,
                1209=>
                21,
                1210=>
                21,
                1213=>
                21,
                1214=>
                21,
                1215=>
                21,
                1218=>
                21,
                1219=>
                21,
                1220=>
                21,
                1221=>
                21,
                1222=>
                21,
                1230=>
                21,
                1231=>
                21,
                1232=>
                21,
                1233=>
                21,
                1234=>
                21,
                1235=>
                21,
                1236=>
                21,
                1239=>
                21,
                1241=>
                21,
                1242=>
                21,
                1245=>
                18,
                1247=>
                11,
                1250=>
                11,
                1251=>
                20,
                1252=>
                15,
                1253=>
                11,
                1260=>
                11,
                1262=>
                5,
                1263=>
                12,
                2398=>
                21,
                2400=>
                19,
                2401=>
                22,
                2402=>
                22,
                2407=>
                17,
                2412=>
                5,
                2413=>
                5,
                2418=>
                15,
                2421=>
                6,
                2422=>
                12,
                2423=>
                16,
                2424=>
                5,
                2425=>
                17,
                2426=>
                9,
                2427=>
                19,
                2428=>
                19,
                2429=>
                19,
                2430=>
                19,
                2431=>
                19,
                2434=>
                11,
                2435=>
                11,
                2436=>
                11,
                2437=>
                11,
                2438=>
                19,
                2439=>
                11,
                2440=>
                11,
                2441=>
                11,
                2443=>
                11,
                2444=>
                11,
                2447=>
                4,
                2449=>
                9,
                2450=>
                14,
                2452=>
                12,
                2456=>
                5,
                2458=>
                5,
                2459=>
                5,
                2461=>
                13,
                2462=>
                13,
                2464=>
                9,
                2468=>
                9,
                2469=>
                9,
                2471=>
                9,
                2474=>
                16,
                2476=>
                17,
                2478=>
                17,
                2479=>
                17,
                2480=>
                17,
                2481=>
                17,
                2482=>
                11,
                2488=>
                17,
                2489=>
                17,
                2491=>
                5,
                2492=>
                17,
                2493=>
                17,
                2494=>
                9,
                2495=>
                9,
                2496=>
                9,
                2501=>
                13,
                2502=>
                19,
                2503=>
                19,
                2504=>
                13,
                2505=>
                13,
                2584=>
                11,
                2586=>
                11,
                2591=>
                9,
                2626=>
                17,
                2629=>
                17,
                2634=>
                19,
                2635=>
                5,
                2636=>
                5,
                2637=>
                5,
                2638=>
                5,
                2639=>
                5,
                2640=>
                5,
                2642=>
                5,
                2643=>
                9,
                2644=>
                22,
                2645=>
                13,
                2646=>
                13,
                2647=>
                13,
                2648=>
                13,
                2649=>
                13,
                2650=>
                13,
                2651=>
                13,
                2652=>
                13,
                2653=>
                13,
                2654=>
                13,
                2655=>
                13,
                2656=>
                19,
                2657=>
                9,
                2658=>
                8,
                2659=>
                12,
                2660=>
                12,
                2661=>
                14,
                2662=>
                14,
                2663=>
                14,
                2664=>
                14,
                2665=>
                19,
                2666=>
                4,
                2667=>
                4,
                2668=>
                6,
                2669=>
                11,
                2670=>
                17,
                2671=>
                11,
                2672=>
                14,
                2673=>
                12,
                2674=>
                19,
                2675=>
                21,
                2677=>
                19,
                2678=>
                6,
                2679=>
                6,
                2680=>
                6,
                2681=>
                6,
                2682=>
                16,
                2683=>
                16,
                2684=>
                16,
                2685=>
                16,
                2686=>
                16,
                2687=>
                16,
                2688=>
                19,
                2689=>
                16,
                2690=>
                16,
                2691=>
                16,
                2692=>
                16,
                2693=>
                16,
                2695=>
                17,
                2696=>
                5,
                2697=>
                5,
                2698=>
                17,
                2699=>
                17,
                2700=>
                5,
                2701=>
                5,
                2702=>
                5,
                2703=>
                5,
                2704=>
                12,
                2705=>
                18,
                2706=>
                6,
                2707=>
                6,
                2708=>
                12,
                2709=>
                11,
                2710=>
                4,
                2711=>
                9,
                2712=>
                9,
                2713=>
                19,
                2714=>
                21,
                2715=>
                17,
                2716=>
                9,
                2718=>
                9,
                2719=>
                9,
                2720=>
                19,
                2721=>
                9,
                2722=>
                9,
                2727=>
                11,
                2728=>
                11,
                2729=>
                11,
                2730=>
                11,
                2731=>
                15,
                2732=>
                19,
                2733=>
                15,
                2734=>
                15,
                2735=>
                15,
                2736=>
                18,
                2737=>
                4,
                2738=>
                12,
                2739=>
                19,
                2742=>
                20,
                2743=>
                9,
                2744=>
                9,
                2745=>
                9,
                2746=>
                15,
                2747=>
                17,
                2748=>
                6,
                2750=>
                13,
                2751=>
                17,
                2752=>
                5,
                2753=>
                11,
                2754=>
                17,
                2755=>
                19,
                2756=>
                11,
                2757=>
                11,
                2758=>
                9,
                2759=>
                5,
                2760=>
                13,
                2761=>
                13,
                2762=>
                6,
                2763=>
                15,
                2765=>
                9,
                2766=>
                9,
                2767=>
                9,
                2768=>
                5,
                2769=>
                20,
                2770=>
                17,
                2771=>
                17,
                2773=>
                12,
                2774=>
                9,
                2775=>
                9,
                2776=>
                9,
                2778=>
                9,
                2779=>
                20,
                2780=>
                5,
                2781=>
                11,
                2782=>
                16,
                2783=>
                16,
                2784=>
                4,
                2785=>
                17,
                2786=>
                8,
                2787=>
                18,
                2789=>
                5,
                2790=>
                19,
                2791=>
                6,
                2792=>
                11,
                2796=>
                13,
                2797=>
                19,
                2798=>
                13,
                2799=>
                11,
                2800=>
                18,
                2801=>
                19,
                2802=>
                19,
                2803=>
                5,
                2804=>
                11,
                2805=>
                12,
                2806=>
                18,
                2807=>
                18,
                2808=>
                11,
                2809=>
                11,
                2810=>
                18,
                2811=>
                5,
                2812=>
                14,
                2813=>
                4,
                2814=>
                19,
                2817=>
                5,
                2819=>
                9,
                2820=>
                4,
                2821=>
                9,
                2822=>
                19,
                2823=>
                17,
                2825=>
                9,
                2826=>
                17,
                2827=>
                17,
                2828=>
                13,
                2829=>
                14,
                2830=>
                17,
                2831=>
                9,
                2832=>
                5,
                2833=>
                5,
                2834=>
                5,
                2835=>
                18,
                2836=>
                6,
                2837=>
                17,
                2838=>
                6,
                2839=>
                16,
                2840=>
                14,
                2841=>
                21,
                2842=>
                15,
                2843=>
                17,
                2844=>
                4,
                2845=>
                5,
                2846=>
                12,
                2847=>
                19,
                2848=>
                19,
                2849=>
                11,
                2850=>
                18,
                2851=>
                19,
                2852=>
                10,
                2854=>
                11,
                2855=>
                17,
                2856=>
                17,
                2857=>
                19,
                2858=>
                16,
                2859=>
                14,
                2860=>
                8,
                2861=>
                19,
                2865=>
                15,
                2867=>
                9,
                2868=>
                19,
                2869=>
                19,
                2870=>
                19,
                2871=>
                19,
                2872=>
                19,
                2873=>
                19,
                2874=>
                11,
                2875=>
                18,
                2876=>
                9,
                2878=>
                13,
                2879=>
                14,
                2880=>
                9,
                2881=>
                9,
                2883=>
                19,
                2884=>
                9,
                2885=>
                8,
                2886=>
                17,
                2887=>
                6,
                2888=>
                20,
                2890=>
                4,
                2891=>
                9,
                2892=>
                19,
                2893=>
                19,
                2894=>
                19,
                2895=>
                15,
                2896=>
                15,
                2899=>
                9,
                2900=>
                9,
                2901=>
                9,
                2903=>
                16,
                2904=>
                16,
                2905=>
                16,
                2907=>
                19,
                2908=>
                11,
                2909=>
                11,
                2910=>
                17,
                2911=>
                8,
                2912=>
                17,
                2913=>
                18,
                2914=>
                5,
                2915=>
                5,
                2916=>
                5,
                2917=>
                13,
                2919=>
                16,
                2920=>
                19,
                2921=>
                19,
                2922=>
                19,
                2923=>
                18,
                2924=>
                13,
                2925=>
                5,
                2926=>
                17,
                2927=>
                17,
                2928=>
                17,
                2929=>
                17,
                2930=>
                13,
                2931=>
                13,
                2932=>
                18,
                2933=>
                15,
                2934=>
                13,
                2935=>
                17,
                2936=>
                21,
                2937=>
                21,
                2938=>
                21,
                2941=>
                17,
                2942=>
                5,
                2944=>
                16,
                2945=>
                5,
                2946=>
                16,
                2947=>
                16,
                2948=>
                16,
                2949=>
                16,
                2950=>
                15,
                2951=>
                19,
                2952=>
                13,
                2953=>
                18,
                2954=>
                11,
                2955=>
                11,
                2956=>
                14,
                2957=>
                16,
                2958=>
                9,
                2959=>
                19,
                2962=>
                8,
                2963=>
                13,
                2964=>
                6,
                2965=>
                17,
                2966=>
                16,
                2967=>
                16,
                2968=>
                16,
                2969=>
                19,
                2970=>
                17,
                2971=>
                17,
                2972=>
                11,
                2973=>
                17,
                2974=>
                19,
                2975=>
                19,
                2976=>
                11,
                2977=>
                17,
                2978=>
                16,
                2979=>
                19,
                2980=>
                13,
                2981=>
                9,
                2982=>
                11,
                2983=>
                18,
                2984=>
                14,
                2985=>
                19,
                2986=>
                6,
                2987=>
                14,
                2988=>
                5,
                2989=>
                17,
                2990=>
                17,
                2991=>
                16,
                2992=>
                19,
                2993=>
                16,
                2994=>
                19,
                2996=>
                19,
                2997=>
                17,
                2998=>
                17,
                2999=>
                17,
                3000=>
                17,
                3001=>
                17,
                3002=>
                17,
                3003=>
                19,
                3004=>
                19,
                3005=>
                17,
                3006=>
                5,
                3007=>
                21,
                3008=>
                21,
                3009=>
                15,
                3010=>
                17,
                3011=>
                17,
                3012=>
                17,
                3013=>
                5,
                3014=>
                5,
                3015=>
                17,
                3016=>
                17,
                3017=>
                19,
                3019=>
                18,
                3020=>
                18,
                3021=>
                17,
                3022=>
                17,
                3023=>
                17,
                3024=>
                17,
                3025=>
                19,
                3026=>
                19,
                3027=>
                6,
                3028=>
                16,
                3029=>
                16,
                3030=>
                16,
                3031=>
                16,
                3032=>
                16,
                3033=>
                19,
                3034=>
                11,
                3037=>
                17,
                3038=>
                16,
                3039=>
                13,
                3040=>
                11,
                3041=>
                17,
                3042=>
                19,
                3043=>
                14,
                3044=>
                14,
                3045=>
                14,
                3046=>
                14,
                3047=>
                6,
                3048=>
                17,
                3049=>
                17,
                3050=>
                17,
                3051=>
                17,
                3052=>
                17,
                3053=>
                21,
                3054=>
                21,
                3055=>
                21,
                3056=>
                21,
                3057=>
                13,
                3058=>
                12,
                3059=>
                17,
                3060=>
                19,
                3061=>
                19,
                3063=>
                19,
                3064=>
                9,
                3065=>
                13,
                3066=>
                11,
                3067=>
                11,
                3068=>
                18,
                3069=>
                18,
                3070=>
                20,
                3071=>
                4,
                3072=>
                4,
                3073=>
                19,
                3074=>
                19,
                3079=>
                11,
                3080=>
                9,
                3081=>
                11,
                3082=>
                9,
                3083=>
                14,
                3084=>
                14,
                3085=>
                4,
                3086=>
                13,
                3087=>
                9,
                3088=>
                19,
                3089=>
                9,
                3091=>
                9,
                3092=>
                9,
                3094=>
                11,
                3095=>
                11,
                3097=>
                11,
                3098=>
                11,
                3099=>
                9,
                3100=>
                9,
                3101=>
                19,
                3102=>
                17,
                3103=>
                17,
                3104=>
                17,
                3105=>
                17,
                3106=>
                17,
                3107=>
                17,
                3108=>
                16,
                3109=>
                19,
                3110=>
                19,
                3111=>
                9,
                3112=>
                9,
                3113=>
                9,
                3114=>
                19,
                3115=>
                6,
                3116=>
                19,
                3117=>
                9,
                3118=>
                12,
                3119=>
                9,
                3120=>
                9,
                3121=>
                17,
                3122=>
                17,
                3123=>
                17,
                3124=>
                17,
                3125=>
                19,
                3126=>
                12,
                3129=>
                12,
                3130=>
                17,
                3131=>
                5,
                3132=>
                17,
                3133=>
                11,
                3135=>
                11,
                3136=>
                9,
                3137=>
                19,
                3138=>
                11,
                3139=>
                5,
                3140=>
                19,
                3141=>
                19,
                3142=>
                17,
                3143=>
                12,
                3144=>
                19,
                3145=>
                19,
                3146=>
                17,
                3147=>
                8,
                3148=>
                6,
                3149=>
                14,
                3150=>
                9,
                3151=>
                9,
                3152=>
                22,
                3153=>
                12,
                3154=>
                17,
                3155=>
                19,
                3156=>
                5,
                3157=>
                18,
                3158=>
                11,
                3159=>
                5,
                3160=>
                9,
                3161=>
                17,
                3162=>
                17,
                3164=>
                18,
                3165=>
                19,
                3166=>
                19,
                3167=>
                19,
                3168=>
                19,
                3169=>
                12,
                3171=>
                14,
                3172=>
                9,
                3173=>
                18,
                3174=>
                18,
                3175=>
                9,
                3176=>
                14,
                3177=>
                12,
                3178=>
                12,
                3179=>
                12,
                3181=>
                19,
                3182=>
                11,
                3183=>
                19,
                3184=>
                19,
                3185=>
                19,
                3187=>
                4,
                3188=>
                4,
                3189=>
                11,
                3190=>
                6,
                3191=>
                19,
                3192=>
                19,
                3193=>
                11,
                3194=>
                11,
                3195=>
                5,
                3196=>
                11,
                3197=>
                11,
                3198=>
                13,
                3199=>
                12,
                3202=>
                4,
                3203=>
                4,
                3205=>
                12,
                3206=>
                19,
                3207=>
                19,
                3208=>
                20,
                3209=>
                19,
                3210=>
                19,
                3212=>
                4,
                3213=>
                12,
                3214=>
                4,
                3215=>
                4,
                3216=>
                4,
                3217=>
                17,
                3218=>
                11,
                3219=>
                5,
                3221=>
                9,
                3222=>
                14,
                3223=>
                21,
                3224=>
                19,
                3225=>
                19,
                3226=>
                19,
                3227=>
                21,
                3228=>
                13,
                3229=>
                9,
                3230=>
                9,
                3231=>
                11,
                3233=>
                11,
                3234=>
                21,
                3235=>
                19,
                3236=>
                19,
                3237=>
                17,
                3238=>
                18,
                3239=>
                12,
                3240=>
                12,
                3242=>
                5,
                3243=>
                19,
                3244=>
                19,
                3245=>
                11,
                3246=>
                13,
                3247=>
                9,
                3248=>
                5,
                3249=>
                14,
                3251=>
                19,
                3252=>
                18,
                3254=>
                11,
                3255=>
                19,
                3256=>
                5,
                3258=>
                19,
                3259=>
                9,
                3260=>
                19,
                3261=>
                11,
                3262=>
                11,
                3263=>
                9,
                3264=>
                12,
                3265=>
                17,
                3266=>
                19,
                3267=>
                17,
                3268=>
                19,
                3269=>
                14,
                3270=>
                18,
                3271=>
                18,
                3272=>
                5,
                3274=>
                19,
                3275=>
                21,
                3276=>
                14,
                3277=>
                14,
                3279=>
                18,
                3280=>
                9,
                3281=>
                19,
                3282=>
                12,
                3283=>
                12,
                3284=>
                5,
                3285=>
                13,
                3287=>
                18,
                3288=>
                19,
                3289=>
                14,
                3290=>
                4,
                3292=>
                11,
                3293=>
                21,
                3294=>
                5,
                3295=>
                5,
                3296=>
                15,
                3297=>
                19,
                3299=>
                11,
                3300=>
                16,
                3302=>
                5,
                3303=>
                14,
                3305=>
                15,
                3306=>
                21,
                3307=>
                5,
                3309=>
                5,
                3310=>
                11,
                3312=>
                9,
                3313=>
                11,
                3314=>
                11,
                3316=>
                11,
                3317=>
                9,
                3318=>
                11,
                3319=>
                5,
                3320=>
                5,
                3321=>
                5,
                3322=>
                5,
                3323=>
                5,
                3324=>
                5,
                3325=>
                17,
                3326=>
                17,
                3327=>
                17,
                3328=>
                17,
                3330=>
                6,
                3331=>
                21,
                3332=>
                9,
                3333=>
                9,
                3334=>
                9,
                3335=>
                9,
                3336=>
                9,
                3337=>
                11,
                3338=>
                11,
                3339=>
                14,
                3340=>
                17,
                3341=>
                14,
                3342=>
                5,
                3343=>
                5,
                3344=>
                5,
                3345=>
                5,
                3346=>
                6,
                3347=>
                11,
                3348=>
                11,
                3349=>
                21,
                3350=>
                11,
                3351=>
                11,
                3353=>
                19,
                3356=>
                14,
                3358=>
                11,
                3359=>
                18,
                3360=>
                15,
                3361=>
                9,
                3362=>
                19,
                3363=>
                18,
                3364=>
                9,
                3365=>
                9,
                3367=>
                17,
                3368=>
                5,
                3369=>
                9,
                3370=>
                9,
                3371=>
                19,
                3372=>
                18,
                3373=>
                18,
                3374=>
                11,
                3375=>
                18,
                3376=>
                18,
                3377=>
                19,
                3378=>
                19,
                3379=>
                11,
                3380=>
                19,
                3381=>
                11,
                3382=>
                12,
                3383=>
                19,
                3384=>
                5,
                3386=>
                5,
                3387=>
                21,
                3388=>
                19,
                3389=>
                19,
                3390=>
                17,
                3391=>
                19,
                3392=>
                14,
                3393=>
                19,
                3394=>
                17,
                3395=>
                9,
                3396=>
                9,
                3397=>
                5,
                3398=>
                9,
                3399=>
                21,
                3401=>
                16,
                3402=>
                12,
                3403=>
                19,
                3404=>
                19,
                3405=>
                19,
                3406=>
                19,
                3407=>
                19,
                3410=>
                15,
                3411=>
                19,
                3415=>
                9,
                3416=>
                9,
                3417=>
                9,
                3418=>
                12,
                3419=>
                9,
                3420=>
                21,
                3421=>
                5,
                3422=>
                18,
                3423=>
                11,
                3424=>
                17,
                3425=>
                17,
                3426=>
                17,
                3427=>
                17,
                3428=>
                17,
                3429=>
                17,
                3430=>
                17,
                3431=>
                17,
                3432=>
                17,
                3433=>
                17,
                3434=>
                17,
                3435=>
                17,
                3436=>
                17,
                3437=>
                17,
                3438=>
                17,
                3439=>
                17,
                3440=>
                17,
                3441=>
                17,
                3442=>
                17,
                3443=>
                17,
                3444=>
                17,
                3445=>
                17,
                3446=>
                17,
                3447=>
                17,
                3448=>
                17,
                3449=>
                5,
                3450=>
                17,
                3452=>
                5,
                3453=>
                5,
                3454=>
                5,
                3455=>
                5,
                3456=>
                5,
                3457=>
                5,
                3459=>
                5,
                3460=>
                5,
                3461=>
                5,
                3462=>
                5,
                3463=>
                5,
                3464=>
                5,
                3465=>
                5,
                3466=>
                5,
                3467=>
                13,
                3468=>
                19,
                3469=>
                11,
                3470=>
                19,
                3471=>
                9,
                3472=>
                17,
                3473=>
                17,
                3475=>
                9,
                3476=>
                9,
                3477=>
                5,
                3478=>
                5,
                3479=>
                11,
                3480=>
                14,
                3481=>
                9,
                3482=>
                9,
                3483=>
                5,
                3484=>
                11,
                3485=>
                6,
                3486=>
                6,
                3488=>
                5,
                3489=>
                11,
                3490=>
                5,
                3491=>
                9,
                3492=>
                11,
                3493=>
                11,
                3494=>
                5,
                3495=>
                8,
                3496=>
                4,
                3497=>
                11,
                3498=>
                17,
                3500=>
                11,
                3501=>
                11,
                3502=>
                19,
                3503=>
                11,
                3510=>
                5,
                3511=>
                19,
                3512=>
                21,
                3514=>
                9,
                3515=>
                21,
                3516=>
                5,
                3517=>
                9,
                3518=>
                11,
                3519=>
                17,
                3520=>
                17,
                3521=>
                17,
                3522=>
                19,
                3524=>
                11,
                3525=>
                19,
                3526=>
                14,
                3527=>
                6,
                3528=>
                6,
                3529=>
                6,
                3530=>
                13,
                3531=>
                4,
                3532=>
                14,
                3533=>
                18,
                3534=>
                14,
                3535=>
                18,
                3536=>
                19,
                3537=>
                19,
                3538=>
                6,
                3539=>
                11,
                3540=>
                12,
                3541=>
                19,
                3542=>
                21,
                3543=>
                11,
                3544=>
                11,
                3545=>
                11,
                3546=>
                6,
                3547=>
                8,
                3548=>
                15,
                3550=>
                5,
                3551=>
                9,
                3552=>
                5,
                3553=>
                21,
                3554=>
                11,
                3555=>
                19,
                3556=>
                17,
                3557=>
                19,
                3558=>
                19,
                3559=>
                12,
                3560=>
                11,
                3561=>
                21,
                3562=>
                17,
                3564=>
                16,
                3566=>
                14,
                3567=>
                9,
                3568=>
                12,
                3569=>
                17,
                3570=>
                17,
                3571=>
                17,
                3572=>
                17,
                3573=>
                12,
                3574=>
                19,
                3575=>
                11,
                3576=>
                8,
                3577=>
                13,
                3578=>
                9,
                3579=>
                17,
                3580=>
                17,
                3581=>
                15,
                3582=>
                15,
                3583=>
                12,
                3584=>
                12,
                3585=>
                12,
                3586=>
                9,
                3587=>
                19,
                3588=>
                11,
                3589=>
                14,
                3590=>
                14,
                3591=>
                9,
                3592=>
                11,
                3593=>
                14,
                3594=>
                19,
                3595=>
                19,
                3596=>
                14,
                3597=>
                11,
                3598=>
                6,
                3599=>
                11,
                3600=>
                12,
                3601=>
                8,
                3602=>
                6,
                3603=>
                16,
                3604=>
                14,
                3605=>
                14,
                3606=>
                5,
                3607=>
                21,
                3608=>
                11,
                3609=>
                6,
                3610=>
                19,
                3611=>
                14,
                3612=>
                5,
                3614=>
                13,
                3615=>
                5,
                3616=>
                17,
                3617=>
                19,
                3618=>
                4,
                3619=>
                9,
                3620=>
                9,
                3621=>
                19,
                3622=>
                15,
                3624=>
                14,
                3625=>
                5,
                3626=>
                17,
                3627=>
                14,
                3628=>
                14,
                3629=>
                12,
                3630=>
                20,
                3631=>
                14,
                3632=>
                5,
                3633=>
                17,
                3634=>
                17,
                3635=>
                17,
                3636=>
                17,
                3637=>
                17,
                3638=>
                17,
                3639=>
                17,
                3640=>
                5,
                3641=>
                5,
                3642=>
                17,
                3643=>
                17,
                3644=>
                17,
                3645=>
                17,
                3646=>
                19,
                3647=>
                17,
                3648=>
                9,
                3649=>
                19,
                3650=>
                17,
                3651=>
                6,
                3652=>
                11,
                3653=>
                20,
                3654=>
                5,
                3655=>
                4,
                3656=>
                4,
                3657=>
                9,
                3658=>
                9,
                3659=>
                9,
                3660=>
                9,
                3661=>
                9,
                3662=>
                9,
                3663=>
                9,
                3664=>
                9,
                3665=>
                9,
                3666=>
                9,
                3667=>
                9,
                3668=>
                9,
                3669=>
                9,
                3670=>
                9,
                3671=>
                9,
                3672=>
                9,
                3673=>
                9,
                3674=>
                9,
                3675=>
                9,
                3676=>
                9,
                3677=>
                9,
                3678=>
                9,
                3679=>
                9,
                3680=>
                9,
                3681=>
                9,
                3682=>
                9,
                3683=>
                9,
                3684=>
                9,
                3685=>
                9,
                3686=>
                9,
                3687=>
                14,
                3688=>
                9,
                3689=>
                9,
                3690=>
                9,
                3691=>
                9,
                3692=>
                9,
                3693=>
                15,
                3694=>
                9,
                3695=>
                9,
                3696=>
                9,
                3697=>
                9,
                3698=>
                9,
                3699=>
                9,
                3700=>
                12,
                3701=>
                9,
                3702=>
                9,
                3703=>
                5,
                3704=>
                16,
                3705=>
                16,
                3706=>
                16,
                3707=>
                11,
                3708=>
                5,
                3709=>
                11,
                3710=>
                18,
                3711=>
                18,
                3712=>
                18,
                3713=>
                11,
                3714=>
                20,
                3715=>
                12,
                3716=>
                11,
                3717=>
                5,
                3718=>
                17,
                3719=>
                17,
                3720=>
                17,
                3721=>
                17,
                3722=>
                17,
                3723=>
                17,
                3724=>
                17,
                3725=>
                17,
                3726=>
                14,
                3727=>
                9,
                3728=>
                5,
                3729=>
                4,
                3730=>
                9,
                3731=>
                9,
                3732=>
                9,
                3733=>
                9,
                3734=>
                9,
                3735=>
                9,
                3736=>
                9,
                3737=>
                9,
                3738=>
                9,
                3739=>
                5,
                3740=>
                5,
                3741=>
                21,
                3742=>
                19,
                3743=>
                12,
                3744=>
                13,
                3745=>
                19,
                3746=>
                15,
                3747=>
                18,
                3748=>
                19,
                3749=>
                19,
                3750=>
                18,
                3751=>
                18,
                3752=>
                19,
                3753=>
                16,
                3754=>
                22,
                3755=>
                6,
                3756=>
                6,
                3757=>
                6,
                3758=>
                6,
                3759=>
                14,
                3760=>
                20,
                3761=>
                21,
                3762=>
                5,
                3763=>
                11,
                3764=>
                21,
                3765=>
                7,
                3768=>
                5,
                3769=>
                14,
                3770=>
                21,
                3771=>
                21,
                3772=>
                18,
                3773=>
                9,
                3774=>
                19,
                3775=>
                19,
                3776=>
                19,
                3777=>
                21,
                3778=>
                19,
                3779=>
                19,
                3780=>
                19,
                3781=>
                19,
                3782=>
                19,
                3783=>
                19,
                3784=>
                19,
                3785=>
                19,
                3786=>
                19,
                3787=>
                19,
                3788=>
                5,
                3789=>
                5,
                3790=>
                5,
                3791=>
                5,
                3792=>
                17,
                3793=>
                17,
                3794=>
                17,
                3795=>
                17,
                3796=>
                5,
                3797=>
                5,
                3798=>
                5,
                3799=>
                5,
                3800=>
                17,
                3801=>
                17,
                3802=>
                17,
                3803=>
                9,
                3804=>
                21,
                3805=>
                9,
                3806=>
                9,
                3807=>
                15,
                3808=>
                17,
                3809=>
                5,
                3810=>
                5,
                3811=>
                5,
                3812=>
                17,
                3813=>
                5,
                3814=>
                5,
                3815=>
                5,
                3816=>
                5,
                3817=>
                5,
                3818=>
                17,
                3819=>
                5,
                3820=>
                17,
                3821=>
                17,
                3822=>
                17,
                3823=>
                5,
                3824=>
                17,
                3825=>
                5,
                3826=>
                5,
                3827=>
                5,
                3828=>
                17,
                3829=>
                5,
                3830=>
                17,
                3831=>
                5,
                3832=>
                5,
                3834=>
                17,
                3835=>
                17,
                3836=>
                17,
                3837=>
                17,
                3838=>
                5,
                3839=>
                5,
                3840=>
                5,
                3841=>
                5,
                3842=>
                5,
                3843=>
                17,
                3844=>
                5,
                3845=>
                17,
                3846=>
                17,
                3847=>
                5,
                3848=>
                5,
                3849=>
                18,
                3850=>
                5,
                3851=>
                5,
                3852=>
                5,
                3853=>
                5,
                3854=>
                5,
                3855=>
                5,
                3856=>
                5,
                3857=>
                5,
                3858=>
                5,
                3859=>
                5,
                3860=>
                5,
                3861=>
                5,
                3862=>
                5,
                3863=>
                5,
                3864=>
                5,
                3865=>
                5,
                3866=>
                5,
                3867=>
                15,
                3868=>
                15,
                3869=>
                5,
                3870=>
                5,
                3871=>
                5,
                3872=>
                5,
                3873=>
                5,
                3874=>
                15,
                3875=>
                15,
                3876=>
                15,
                3877=>
                15,
                3878=>
                15,
                3879=>
                15,
                3880=>
                15,
                3881=>
                15,
                3882=>
                5,
                3883=>
                15,
                3884=>
                5,
                3885=>
                15,
                3886=>
                15,
                3887=>
                5,
                3888=>
                15,
                3889=>
                5,
                3890=>
                15,
                3891=>
                15,
                3892=>
                22,
                3893=>
                5,
                3894=>
                5,
                3895=>
                5,
                3896=>
                5,
                3897=>
                5,
                3898=>
                5,
                3899=>
                5,
                3900=>
                5,
                3901=>
                5,
                3902=>
                5,
                3903=>
                5,
                3904=>
                5,
                3905=>
                21,
                3906=>
                21,
                3907=>
                21,
                3908=>
                21,
                3909=>
                21,
                3910=>
                21,
                3911=>
                21,
                3912=>
                21,
                3913=>
                21,
                3914=>
                21,
                3915=>
                21,
                3916=>
                21,
                3917=>
                21,
                3918=>
                21,
                3919=>
                21,
                3920=>
                21,
                3921=>
                21,
                3922=>
                21,
                3923=>
                21,
                3924=>
                21,
                3925=>
                21,
                3926=>
                21,
                3927=>
                21,
                3928=>
                21,
                3929=>
                21,
                3930=>
                21,
                3931=>
                5,
                3932=>
                5,
                3933=>
                5,
                3934=>
                5,
                3935=>
                5,
                3936=>
                18,
                3937=>
                18,
                3938=>
                18,
                3939=>
                15,
                3940=>
                13,
                3941=>
                15,
                3942=>
                15,
                3943=>
                15,
                3944=>
                15,
                3945=>
                15,
                3946=>
                15,
                3947=>
                15,
                3948=>
                15,
                3949=>
                15,
                3950=>
                15,
                3951=>
                15,
                3952=>
                15,
                3954=>
                15,
                3955=>
                15,
                3956=>
                15,
                3957=>
                15,
                3958=>
                15,
                3959=>
                15,
                3960=>
                15,
                3961=>
                15,
                3962=>
                15,
                3963=>
                15,
                3964=>
                15,
                3965=>
                15,
                3966=>
                15,
                3967=>
                15,
                3968=>
                14,
                3969=>
                14,
                3970=>
                14,
                3971=>
                14,
                3972=>
                14,
                3973=>
                14,
                3974=>
                14,
                3975=>
                14,
                3976=>
                14,
                3977=>
                14,
                3978=>
                14,
                3979=>
                14,
                3980=>
                14,
                3981=>
                14,
                3982=>
                14,
                3983=>
                14,
                3984=>
                14,
                3985=>
                13,
                3986=>
                13,
                3987=>
                13,
                3988=>
                14,
                3990=>
                9,
                3991=>
                19,
                3992=>
                6,
                3993=>
                21,
                3994=>
                21,
                3995=>
                21,
                3996=>
                21,
                3997=>
                21,
                3998=>
                21,
                3999=>
                21,
                4000=>
                5,
                4001=>
                9,
                4002=>
                15,
                4003=>
                15,
                4004=>
                5,
                4005=>
                15,
                4006=>
                21,
                4007=>
                5,
                4008=>
                15,
                4009=>
                12,
                4010=>
                12,
                4011=>
                12,
                4012=>
                5,
                4013=>
                18,
                4014=>
                14,
                4015=>
                6,
                4016=>
                9,
                4017=>
                9,
                4018=>
                9,
                4019=>
                9,
                4020=>
                9,
                4021=>
                9,
                4022=>
                9,
                4023=>
                9,
                4024=>
                9,
                4025=>
                9,
                4026=>
                9,
                4027=>
                9,
                4030=>
                21,
                4031=>
                21,
                4032=>
                15,
                4033=>
                11,
                4034=>
                18,
                4035=>
                15,
                4036=>
                19,
                4037=>
                9,
                4038=>
                6,
                4039=>
                6,
                4040=>
                6,
                4041=>
                6,
                4042=>
                6,
                4043=>
                5,
                4044=>
                5,
                4045=>
                21,
                4046=>
                21,
                4047=>
                21,
                4048=>
                21,
                4049=>
                15,
                4050=>
                15,
                4051=>
                9,
                4052=>
                9,
                4053=>
                9,
                4054=>
                9,
                4055=>
                9,
                4056=>
                4,
                4057=>
                15,
                4058=>
                15,
                4059=>
                22,
                4060=>
                21,
                4061=>
                5,
                4062=>
                15,
                4063=>
                11,
                4064=>
                11,
                4065=>
                11,
                4066=>
                11,
                4067=>
                21,
                4068=>
                5,
                4069=>
                21,
                4070=>
                18,
                4071=>
                19,
                4072=>
                15,
                4073=>
                17,
                4074=>
                15,
                4075=>
                19,
                4076=>
                21,
                4077=>
                5,
                4078=>
                19,
                4079=>
                19,
                4080=>
                17,
                4081=>
                17,
                4082=>
                17,
                4083=>
                17,
                4084=>
                19,
                4085=>
                21,
                4086=>
                21,
                4087=>
                19,
                4088=>
                5,
                4089=>
                19,
                4090=>
                14,
                4091=>
                5,
                4092=>
                5,
                4093=>
                5,
                4094=>
                5,
                4095=>
                21,
                4096=>
                21,
                4097=>
                22,
                4098=>
                19,
                4099=>
                15,
                4100=>
                11,
                4101=>
                11,
                4102=>
                11,
                4103=>
                12,
                4104=>
                12,
                4105=>
                21,
                4106=>
                21,
                4107=>
                11,
                4108=>
                11,
                4109=>
                11,
                4110=>
                5,
                4111=>
                11,
                4112=>
                20,
                4113=>
                15,
                4114=>
                11,
                4115=>
                11,
                4116=>
                11,
                4117=>
                19,
                4118=>
                9,
                4119=>
                21,
                4120=>
                19,
                4121=>
                19,
                4122=>
                13,
                4123=>
                13,
                4124=>
                19,
                4125=>
                21,
                4126=>
                6,
                4127=>
                16,
                4128=>
                11,
                4129=>
                15,
                4130=>
                15,
                4131=>
                15,
                4132=>
                15,
                4133=>
                11,
                4134=>
                21,
                4135=>
                21,
                4136=>
                21,
                4137=>
                21,
                4138=>
                21,
                4139=>
                21,
                4140=>
                5,
                4141=>
                15,
                4142=>
                15,
                4143=>
                21,
                4144=>
                5,
                4145=>
                14,
                4146=>
                14,
                4147=>
                17,
                4148=>
                17,
                4149=>
                17,
                4150=>
                17,
                4151=>
                17,
                4152=>
                11,
                4153=>
                16,
                4154=>
                16,
                4155=>
                16,
                4156=>
                16,
                4157=>
                16,
                4158=>
                17,
                4159=>
                5,
                4160=>
                5,
                4161=>
                14,
                4162=>
                21,
                4163=>
                21,
                4164=>
                21,
                4165=>
                21,
                4166=>
                15,
                4167=>
                5,
                4168=>
                5,
                4169=>
                15,
                4170=>
                15,
                4171=>
                11,
                4172=>
                11,
                4173=>
                11,
                4174=>
                15,
                4175=>
                5,
                4176=>
                5,
                4177=>
                5,
                4178=>
                5,
                4179=>
                19,
                4180=>
                19,
                4181=>
                21,
                4182=>
                9,
                4183=>
                19,
                4184=>
                5,
                4185=>
                15,
                4186=>
                15,
                4187=>
                15,
                4188=>
                15,
                4189=>
                15,
                4190=>
                15,
                4191=>
                15,
                4192=>
                15,
                4193=>
                15,
                4194=>
                5,
                4195=>
                5,
                4197=>
                21,
                4198=>
                21,
                4199=>
                6,
                4200=>
                5,
                4201=>
                5,
                4202=>
                5,
                4203=>
                5,
                4204=>
                5,
                4205=>
                21,
                4206=>
                21,
                4207=>
                21,
                4208=>
                11,
                4209=>
                11,
                4210=>
                11,
                4211=>
                11,
                4212=>
                11,
                4213=>
                11,
                4214=>
                11,
                4215=>
                19,
                4216=>
                12,
                4217=>
                15,
                4218=>
                15,
                4219=>
                11,
                4220=>
                5,
                4221=>
                21,
                4222=>
                21,
                4223=>
                21,
                4224=>
                21,
                4225=>
                21,
                4226=>
                21,
                4227=>
                21,
                4228=>
                21,
                4229=>
                21,
                4230=>
                21,
                4231=>
                21,
                4232=>
                21,
                4233=>
                21,
                4234=>
                21,
                4235=>
                21,
                4236=>
                21,
                4237=>
                21,
                4238=>
                21,
                4239=>
                21,
                4240=>
                21,
                4241=>
                21,
                4242=>
                15,
                4243=>
                15,
                4244=>
                15,
                4245=>
                15,
                4246=>
                15,
                4247=>
                15,
                4248=>
                15,
                4249=>
                15,
                4250=>
                15,
                4251=>
                15,
                4252=>
                15,
                4253=>
                15,
                4254=>
                21,
                4255=>
                21,
                4256=>
                21,
                4257=>
                21,
                4258=>
                21,
                4259=>
                21,
                4260=>
                21,
                4261=>
                21,
                4262=>
                21,
                4263=>
                21,
                4264=>
                21,
                4265=>
                21,
                4266=>
                21,
                4267=>
                21,
                4268=>
                21,
                4269=>
                21,
                4270=>
                21,
                4271=>
                21,
                4272=>
                21,
                4273=>
                21,
                4274=>
                21,
                4275=>
                21,
                4276=>
                21,
                4277=>
                21,
                4278=>
                21,
                4279=>
                21,
                4280=>
                21,
                4281=>
                5,
                4282=>
                21,
                4283=>
                21,
                4284=>
                21,
                4285=>
                21,
                4286=>
                21,
                4287=>
                21,
                4288=>
                11,
                4289=>
                11,
                4290=>
                11,
                4291=>
                11,
                4293=>
                15,
                4294=>
                5,
                4295=>
                21,
                4296=>
                21,
                4297=>
                21,
                4298=>
                15,
                4299=>
                15,
                4300=>
                15,
                4301=>
                15,
                4302=>
                21,
                4303=>
                20,
                4304=>
                5,
                4305=>
                15,
                4306=>
                15,
                4307=>
                15,
                4308=>
                9,
                4309=>
                17,
                4310=>
                19,
                4311=>
                19,
                4312=>
                11,
                4313=>
                11,
                4317=>
                21,
                4318=>
                21,
                4319=>
                21,
                4320=>
                15,
                4321=>
                6,
                4322=>
                6,
                4323=>
                6,
                4324=>
                21,
                4325=>
                21,
                4326=>
                15,
                4327=>
                15,
                4328=>
                15,
                4329=>
                15,
                4330=>
                15,
                4331=>
                15,
                4332=>
                15,
                4333=>
                5,
                4334=>
                6,
                4335=>
                21,
                4336=>
                21,
                4337=>
                21,
                4338=>
                21,
                4339=>
                21,
                4340=>
                21,
                4341=>
                21,
                4342=>
                21,
                4343=>
                21,
                4344=>
                15,
                4345=>
                15,
                4346=>
                12,
                4347=>
                15,
                4348=>
                15,
                4349=>
                15,
                4350=>
                21,
                4351=>
                11,
                4352=>
                11,
                4353=>
                11,
                4354=>
                11,
                4355=>
                11,
                4356=>
                11,
                4357=>
                16,
                4358=>
                21,
                4359=>
                21,
                4360=>
                21,
                4361=>
                21,
                4362=>
                21,
                4363=>
                21,
                4364=>
                21,
                4365=>
                21,
                4366=>
                21,
                4367=>
                21,
                4368=>
                21,
                4369=>
                21,
                4370=>
                5,
                4371=>
                15,
                4372=>
                20,
                4373=>
                21,
                4374=>
                21,
                4375=>
                21,
                4376=>
                5,
                4377=>
                6,
                4378=>
                5,
                4379=>
                21,
                4380=>
                15,
                4381=>
                11,
                4382=>
                5,
                4383=>
                11,
                4384=>
                5,
                4385=>
                21,
                4386=>
                21,
                4387=>
                20,
                4388=>
                20,
                4389=>
                15,
                4390=>
                5,
                4391=>
                15,
                4392=>
                6,
                4393=>
                18,
                4394=>
                12,
                4395=>
                12,
                4396=>
                18,
                4397=>
                14,
                4398=>
                9,
                4399=>
                9,
                4400=>
                5,
                4401=>
                20,
                4402=>
                21,
                4403=>
                21,
                4404=>
                21,
                4405=>
                21,
                4406=>
                21,
                4407=>
                21,
                4408=>
                21,
                4409=>
                6,
                4410=>
                5,
                4411=>
                21,
                4412=>
                5,
                4413=>
                6,
                4414=>
                6,
                4415=>
                6,
                4416=>
                6,
                4417=>
                6,
                4418=>
                6,
                4419=>
                6,
                4420=>
                6,
                4421=>
                6,
                4422=>
                6,
                4423=>
                6,
                4424=>
                6,
                4425=>
                6,
                4426=>
                6,
                4427=>
                8,
                4428=>
                8,
                4429=>
                8,
                4430=>
                8,
                4431=>
                8,
                4432=>
                8,
                4433=>
                8,
                4434=>
                8,
                4435=>
                17,
                4436=>
                17,
                4437=>
                15,
                4438=>
                15,
                4439=>
                21,
                4440=>
                15,
                4441=>
                6,
                4442=>
                21,
                4443=>
                21,
                4444=>
                14,
                4445=>
                21,
                4446=>
                15,
                4447=>
                15,
                4448=>
                15,
                4449=>
                15,
                4450=>
                19,
                4451=>
                7,
                4452=>
                5,
                4453=>
                5,
                4454=>
                5,
                4455=>
                5,
                4456=>
                5,
                4457=>
                5,
                4458=>
                5,
                4459=>
                21,
                4460=>
                15,
                4461=>
                14,
                4462=>
                18,
                4463=>
                11,
                4464=>
                11,
                4465=>
                11,
                4466=>
                21,
                4467=>
                21,
                4468=>
                19,
                4469=>
                21,
                4470=>
                15,
                4471=>
                21,
                4472=>
                20,
                4473=>
                15,
                4474=>
                15,
                4475=>
                15,
                4476=>
                15,
                4477=>
                15,
                4478=>
                15,
                4479=>
                15,
                4480=>
                15,
                4481=>
                5,
                4482=>
                21,
                4483=>
                11,
                4484=>
                11,
                4485=>
                21,
                4486=>
                22,
                4487=>
                15,
                4488=>
                21,
                4490=>
                6,
                4491=>
                6,
                4492=>
                6,
                4493=>
                11,
                4494=>
                11,
                4495=>
                11,
                4496=>
                11,
                4497=>
                17,
                4498=>
                11,
                4499=>
                11,
                4500=>
                12,
                4501=>
                6,
                4502=>
                5,
                4503=>
                5,
                4504=>
                5,
                4505=>
                5,
                4506=>
                5,
                4507=>
                5,
                4508=>
                5,
                4509=>
                5,
                4510=>
                5,
                4511=>
                5,
                4512=>
                5,
                4513=>
                5,
                4514=>
                5,
                4515=>
                5,
                4516=>
                11,
                4517=>
                11,
                4518=>
                11,
                4519=>
                11,
                4520=>
                11,
                4521=>
                11,
                4522=>
                11,
                4523=>
                11,
                4524=>
                11,
                4525=>
                11,
                4526=>
                11,
                4527=>
                11,
                4528=>
                5,
                4529=>
                5,
                4530=>
                5,
                4531=>
                21,
                4532=>
                21,
                4533=>
                21,
                4534=>
                15,
                4535=>
                15,
                4536=>
                20,
                4537=>
                21,
                4538=>
                21,
                4539=>
                15,
                4540=>
                5,
                4541=>
                5,
                4542=>
                15,
                4543=>
                15,
                4544=>
                5,
                4545=>
                6,
                4546=>
                15,
                4547=>
                18,
                4548=>
                9,
                4549=>
                19,
                4550=>
                9,
                4551=>
                21,
                4552=>
                5,
                4553=>
                5,
                4554=>
                5,
                4555=>
                5,
                4556=>
                5,
                4557=>
                5,
                4558=>
                5,
                4559=>
                5,
                4560=>
                5,
                4561=>
                5,
                4562=>
                5,
                4563=>
                5,
                4564=>
                5,
                4565=>
                5,
                4566=>
                5,
                4567=>
                5,
                4568=>
                5,
                4569=>
                5,
                4570=>
                5,
                4571=>
                5,
                4572=>
                15,
                4573=>
                15,
                4574=>
                6,
                4575=>
                5,
                4576=>
                5,
                4577=>
                11,
                4578=>
                11,
                4579=>
                15,
                4580=>
                20,
                4581=>
                11,
                4582=>
                11,
                4583=>
                11,
                4584=>
                21,
                4585=>
                15,
                4586=>
                9,
                4587=>
                12,
                4588=>
                12,
                4589=>
                5,
                4590=>
                5,
                4591=>
                5,
                4592=>
                5,
                4594=>
                15,
                4595=>
                9,
                4596=>
                6,
                4597=>
                6,
                4598=>
                6,
                4599=>
                6,
                4600=>
                6,
                4601=>
                6,
                4602=>
                9,
                4603=>
                9,
                4604=>
                19,
                4605=>
                17,
                4606=>
                11,
                4607=>
                11,
                4608=>
                11,
                4609=>
                11,
                4610=>
                15,
                4611=>
                15,
                4612=>
                15,
                4613=>
                15,
                4614=>
                6,
                4615=>
                15,
                4616=>
                21,
                4617=>
                15,
                4618=>
                6,
                4619=>
                22,
                4620=>
                15,
                4621=>
                15,
                4622=>
                6,
                4623=>
                15,
                4624=>
                9,
                4625=>
                6,
                4626=>
                6,
                4627=>
                6,
                4628=>
                6,
                4629=>
                11,
                4630=>
                11,
                4631=>
                11,
                4632=>
                11,
                4633=>
                11,
                4634=>
                11,
                4635=>
                11,
                4636=>
                11,
                4637=>
                11,
                4638=>
                11,
                4639=>
                11,
                4640=>
                11,
                4641=>
                21,
                4642=>
                21,
                4643=>
                21,
                4644=>
                21,
                4645=>
                21,
                4646=>
                7,
                4647=>
                6,
                4648=>
                6,
                4649=>
                6,
                4650=>
                6,
                4651=>
                6,
                4652=>
                9,
                4653=>
                5,
                4654=>
                5,
                4655=>
                5,
                4656=>
                5,
                4657=>
                5,
                4658=>
                5,
                4659=>
                15,
                4660=>
                21,
                4661=>
                21,
                4662=>
                15,
                4663=>
                15,
                4664=>
                15,
                4665=>
                6,
                4667=>
                5,
                4668=>
                15,
                4669=>
                5,
                4671=>
                21,
                4672=>
                21,
                4673=>
                21,
                4674=>
                21,
                4675=>
                21,
                4676=>
                21,
                4677=>
                21,
                4678=>
                5,
                4679=>
                21,
                4680=>
                5,
                4681=>
                20,
                4682=>
                5,
                4683=>
                20,
                4684=>
                20,
                4685=>
                21,
                4686=>
                18,
                4687=>
                18,
                4688=>
                18,
                4689=>
                18,
                4690=>
                4,
                4691=>
                5,
                4692=>
                6,
                4693=>
                21,
                4694=>
                21,
                4695=>
                5,
                4696=>
                15,
                4697=>
                5,
                4698=>
                15,
                4699=>
                5,
                4700=>
                18,
                4701=>
                18,
                4702=>
                15,
                4703=>
                11,
                4704=>
                11,
                4705=>
                15,
                4706=>
                5,
                4707=>
                20,
                4708=>
                5,
                4709=>
                5,
                4710=>
                15,
                4711=>
                15,
                4712=>
                18,
                4713=>
                18,
                4714=>
                15,
                4715=>
                15,
                4716=>
                15,
                4717=>
                15,
                4718=>
                15,
                4719=>
                15,
                4720=>
                21,
                4721=>
                6,
                4722=>
                6,
                4723=>
                15,
                4724=>
                19,
                4725=>
                19,
                4726=>
                20,
                4727=>
                20,
                4728=>
                6,
                4729=>
                11,
                4730=>
                9,
                4731=>
                18,
                4732=>
                6,
                4733=>
                5,
                4734=>
                15,
                4735=>
                5,
                4736=>
                15,
                4737=>
                11,
                4738=>
                15,
                4739=>
                15,
                4740=>
                15,
                4741=>
                19,
                4742=>
                15,
                4743=>
                15,
                4744=>
                20,
                4745=>
                4,
                4746=>
                11,
                4747=>
                11,
                4748=>
                19,
                4749=>
                21,
                4750=>
                22,
                4751=>
                15,
                4752=>
                15,
                4753=>
                15,
                4754=>
                15,
                4755=>
                18,
                4756=>
                21,
                4757=>
                21,
                4758=>
                11,
                4759=>
                11,
                4760=>
                11,
                4761=>
                11,
                4762=>
                11,
                4763=>
                21,
                4764=>
                21,
                4765=>
                15,
                4766=>
                15,
                4767=>
                15,
                4768=>
                15,
                4769=>
                15,
                4770=>
                15,
                4771=>
                20,
                4772=>
                21,
                4773=>
                11,
                4774=>
                15,
                4775=>
                20,
                4776=>
                20,
                4777=>
                18,
                4778=>
                18,
                4779=>
                6,
                4780=>
                5,
                4781=>
                12,
                4782=>
                11,
                4783=>
                11,
                4784=>
                11,
                4785=>
                11,
                4786=>
                11,
                4787=>
                19,
                4788=>
                15,
                4789=>
                5,
                4790=>
                5,
                4791=>
                15,
                4792=>
                6,
                4793=>
                21,
                4794=>
                19,
                4795=>
                11,
                4796=>
                15,
                4797=>
                15,
                4798=>
                15,
                4799=>
                15,
                4800=>
                15,
                4801=>
                12,
                4802=>
                19,
                4803=>
                11,
                4804=>
                11,
                4805=>
                11,
                4806=>
                15,
                4807=>
                5,
                4808=>
                5,
                4809=>
                5,
                4810=>
                5,
                4811=>
                19,
                4812=>
                15,
                4813=>
                15,
                4814=>
                15,
                4815=>
                5,
                4816=>
                5,
                4817=>
                15,
                4818=>
                15,
                4819=>
                5,
                4820=>
                17,
                4821=>
                12,
                4822=>
                15,
                4823=>
                15,
                4824=>
                20,
                4825=>
                5,
                4826=>
                5,
                4827=>
                15,
                4828=>
                15,
                4829=>
                15,
                4830=>
                9,
                4831=>
                20,
                4832=>
                9,
                4833=>
                21,
                4834=>
                18,
                4835=>
                18,
                4836=>
                15,
                4837=>
                15,
                4838=>
                15,
                4839=>
                15,
                4840=>
                15,
                4841=>
                15,
                4842=>
                14,
                4843=>
                14,
                4844=>
                14,
                4845=>
                15,
                4846=>
                11,
                4847=>
                19,
                4848=>
                19,
                4849=>
                21,
                4850=>
                15,
                4851=>
                11,
                4852=>
                6,
                4853=>
                6,
                4854=>
                6,
                4855=>
                20,
                4856=>
                15,
                4857=>
                15,
                4858=>
                15,
                4859=>
                6,
                4860=>
                6,
                4861=>
                15,
                4862=>
                11,
                4863=>
                11,
                4864=>
                11,
                4865=>
                11,
                4866=>
                11,
                4867=>
                11,
                4868=>
                20,
                4869=>
                11,
                4870=>
                19,
                4871=>
                18,
                4872=>
                15,
                4873=>
                15,
                4874=>
                15,
                4875=>
                15,
                4876=>
                15,
                4877=>
                15,
                4878=>
                15,
                4879=>
                17,
                4880=>
                12,
                4881=>
                21,
                4882=>
                15,
                4883=>
                15,
                4884=>
                15,
                4885=>
                15,
                4886=>
                15,
                4887=>
                11,
                4888=>
                21,
                4889=>
                21,
                4890=>
                11,
                4891=>
                11,
                4892=>
                11,
                4893=>
                5,
                4894=>
                21,
                4895=>
                6,
                4896=>
                15,
                4897=>
                15,
                4898=>
                15,
                4899=>
                15,
                4900=>
                21,
                4901=>
                5,
                4902=>
                5,
                4903=>
                5,
                4904=>
                5,
                4905=>
                19,
                4906=>
                19,
                4907=>
                19,
                4908=>
                19,
                4909=>
                19,
                4910=>
                19,
                4911=>
                19,
                4912=>
                19,
                4913=>
                19,
                4914=>
                19,
                4915=>
                19,
                4916=>
                19,
                4918=>
                19,
                4919=>
                19,
                4920=>
                19,
                4921=>
                15,
                4922=>
                15,
                4923=>
                19,
                4924=>
                19,
                4925=>
                19,
                4926=>
                19,
                4927=>
                19,
                4928=>
                19,
                4929=>
                19,
                4930=>
                19,
                4931=>
                19,
                4932=>
                14,
                4933=>
                5,
                4934=>
                5,
                4935=>
                5,
                4936=>
                5,
                4937=>
                14,
                4938=>
                14,
                4939=>
                11,
                4940=>
                20,
                4941=>
                19,
                4942=>
                20,
                4943=>
                20,
                4944=>
                20,
                4945=>
                20,
                4946=>
                20,
                4947=>
                20,
                4948=>
                15,
                4949=>
                15,
                4950=>
                15,
                4951=>
                5,
                4952=>
                11,
                4953=>
                21,
                4954=>
                21,
                4955=>
                21,
                4956=>
                21,
                4957=>
                21,
                4958=>
                21,
                4959=>
                21,
                4960=>
                21,
                4961=>
                21,
                4962=>
                5,
                4963=>
                21,
                4964=>
                21,
                4965=>
                14,
                4966=>
                19,
                4967=>
                19,
                4968=>
                21,
                4969=>
                5,
                4970=>
                5,
                4971=>
                15,
                4972=>
                15,
                4973=>
                17,
                4974=>
                17,
                4975=>
                17,
                4976=>
                17,
                4977=>
                12,
                4978=>
                4,
                4979=>
                11,
                4980=>
                11,
                4981=>
                11,
                4982=>
                11,
                4983=>
                11,
                4984=>
                11,
                4985=>
                6,
                4986=>
                6,
                4987=>
                15,
                4988=>
                5,
                4989=>
                15,
                4990=>
                5,
                4991=>
                7,
                4992=>
                21,
                4993=>
                5,
                4994=>
                5,
                4995=>
                5,
                4996=>
                5,
                4997=>
                21,
                4998=>
                21,
                4999=>
                15,
                5000=>
                15,
                5001=>
                11,
                5002=>
                11,
                5003=>
                20,
                5004=>
                20,
                5005=>
                20,
                5006=>
                11,
                5007=>
                11,
                5008=>
                5,
                5009=>
                15,
                5135=>
                5,
                5136=>
                5,
                5137=>
                5,
                5138=>
                5,
                5139=>
                11,
                5140=>
                11,
                5141=>
                11,
                5142=>
                11,
                5143=>
                11,
                5144=>
                11,
                5145=>
                15,
                5146=>
                15,
                5149=>
                5,
                5150=>
                21,
                5151=>
                21,
                5152=>
                21,
                5153=>
                21,
                5154=>
                21,
                5155=>
                15,
                5156=>
                5,
                5157=>
                5,
                5158=>
                5,
                5159=>
                5,
                5160=>
                15,
                5161=>
                11,
                5162=>
                15,
                5163=>
                15,
                5164=>
                12,
                5165=>
                19,
                5166=>
                21,
                5167=>
                21,
                5168=>
                21,
                5169=>
                15,
                5170=>
                15,
                5171=>
                20,
                5172=>
                14,
                5255=>
                5,
                5256=>
                5,
                5257=>
                5,
                5258=>
                19,
                5277=>
                11,
                5278=>
                11,
                5279=>
                11,
                5283=>
                14,
                5284=>
                14,
                5356=>
                15,
                5357=>
                15,
                5358=>
                15,
                5359=>
                15,
                5365=>
                4,
                5454=>
                5,
                5455=>
                20,
                5456=>
                20,
                5457=>
                20,
                5458=>
                15,
                5459=>
                15,
                5460=>
                5,
                5461=>
                15,
                5462=>
                11,
                5463=>
                11,
                5464=>
                11,
                5465=>
                20,
                5466=>
                20,
                5467=>
                20,
                5468=>
                15,
                5469=>
                15,
                5470=>
                15,
                5471=>
                15,
                5482=>
                15,
                5550=>
                11,
                5551=>
                11,
                5552=>
                19,
                5553=>
                15,
                5554=>
                20,
                5556=>
                5,
                5557=>
                19,
                5558=>
                5,
                5559=>
                20,
                5560=>
                20,
                5562=>
                15,
                5563=>
                4,
                5565=>
                19,
                5566=>
                19,
                5567=>
                20,
                5568=>
                20,
                5569=>
                15,
                5570=>
                19,
                5571=>
                19,
                5572=>
                11,
                5573=>
                11,
                5574=>
                11,
                5576=>
                11,
                5577=>
                11,
                5580=>
                21,
                5581=>
                5,
                5584=>
                21,
                5585=>
                5,
                5586=>
                5,
                5587=>
                5,
                5588=>
                18,
                5589=>
                5,
                5590=>
                15,
                5591=>
                15,
                5592=>
                19,
                5593=>
                15,
                5594=>
                20,
                5595=>
                20,
                5596=>
                20,
                5597=>
                20,
                5598=>
                20,
                5599=>
                20,
                5600=>
                20,
                5601=>
                20,
                5602=>
                20,
                5603=>
                20,
                5604=>
                20,
                5605=>
                20,
                5606=>
                20,
                5610=>
                19,
                5611=>
                19,
                5612=>
                18,
                5613=>
                19,
                5614=>
                19,
                5616=>
                19,
                5617=>
                20,
                5618=>
                20,
                5619=>
                14,
                5620=>
                5,
                5621=>
                18,
                5622=>
                19,
                5623=>
                20,
                5624=>
                11,
                5625=>
                20,
                5626=>
                14,
                5627=>
                15,
                5628=>
                15,
                5629=>
                20,
                5630=>
                19,
                5631=>
                11,
                5632=>
                11,
                5633=>
                11,
                5634=>
                21,
                5635=>
                21,
                5636=>
                21,
                5637=>
                21,
                5638=>
                21,
                5639=>
                21,
                5640=>
                21,
                5641=>
                11,
                5642=>
                15,
                5643=>
                15,
                5644=>
                5,
                5645=>
                5,
                5646=>
                5,
                5650=>
                18,
                5651=>
                5,
                5652=>
                18,
                5653=>
                20,
                5654=>
                20,
                5655=>
                19,
                5656=>
                4,
                5657=>
                5,
                5658=>
                18,
                5659=>
                22,
                5660=>
                18,
                5661=>
                18,
                5662=>
                18,
                5663=>
                18,
                5664=>
                18,
                5665=>
                5,
                5666=>
                15,
                5667=>
                15,
                5668=>
                22,
                5834=>
                15,
                5868=>
                14,
                6011=>
                11,
                6012=>
                21,
                6105=>
                9,
                6106=>
                15,
                6107=>
                15,
                6108=>
                15,
                6154=>
                5,
                6342=>
                17,
                6343=>
                9,
                6344=>
                16,
                6345=>
                6,
                6346=>
                19,
                6347=>
                19,
                6406=>
                15,
                6407=>
                15,
                6408=>
                15,
                6436=>
                21,
                6460=>
                21,
                6461=>
                21,
                6462=>
                21,
                6581=>
                5,
                6596=>
                22,
                6597=>
                22,
                6598=>
                6,
                6599=>
                6,
                6600=>
                6,
                6602=>
                21,
                6603=>
                21,
                6604=>
                21,
                6605=>
                21,
                6606=>
                21,
                6607=>
                21,
                6608=>
                22,
                6636=>
                11,
                6637=>
                15,
                6638=>
                5,
                6639=>
                11,
                6640=>
                11,
                6641=>
                21,
                6642=>
                21,
                6643=>
                21,
                6644=>
                11,
                6645=>
                20,
                6646=>
                15,
                6651=>
                15,
                6652=>
                11,
                6653=>
                15,
                6654=>
                21,
                6655=>
                21,
                6656=>
                21,
                6657=>
                21,
                6658=>
                21,
                6659=>
                21,
                6660=>
                21,
                6661=>
                21,
                6663=>
                5,
                6665=>
                11,
                6666=>
                11,
                6667=>
                19,
                6668=>
                11,
                6669=>
                19,
                6670=>
                21,
                6671=>
                21,
                6672=>
                18,
                6673=>
                11,
                6674=>
                11,
                6675=>
                11,
                6676=>
                11,
                6677=>
                11,
                6678=>
                9,
                6679=>
                15,
                6680=>
                15,
                6681=>
                15,
                6682=>
                15,
                6683=>
                15,
                6684=>
                15,
                6685=>
                21,
                6686=>
                21,
                6687=>
                21,
                6688=>
                21,
                6689=>
                11,
                6690=>
                9,
                6691=>
                9,
                6692=>
                21,
                6693=>
                21,
                6694=>
                15,
                6695=>
                18,
                6715=>
                9,
                6746=>
                15,
                6747=>
                5,
                6748=>
                15,
                6749=>
                15,
                6750=>
                15,
                6751=>
                15,
                6752=>
                15,
                6753=>
                15,
                6754=>
                15,
                6755=>
                15,
                6757=>
                15,
                6758=>
                15,
                6759=>
                11,
                6760=>
                15,
                6761=>
                15,
                6762=>
                15,
                6763=>
                9,
                6764=>
                9,
                6765=>
                9,
                6766=>
                15,
                6841=>
                19,
                6865=>
                11,
                6925=>
                15,
                6977=>
                9,
                6978=>
                5,
                6979=>
                5,
                6980=>
                5,
                6981=>
                5,
                7296=>
                15,
                7297=>
                15,
                7298=>
                15,
                7299=>
                15,
                7300=>
                15,
                7301=>
                15,
                7302=>
                15,
                7303=>
                15,
                7304=>
                19,
                7305=>
                19,
                7306=>
                19,
                7307=>
                19,
                7308=>
                19,
                7309=>
                19,
                7311=>
                11,
                7312=>
                11,
                7313=>
                11,
                7314=>
                11,
                7315=>
                11,
                7316=>
                11,
                7317=>
                15,
                7318=>
                5,
                7319=>
                5,
                7320=>
                19,
                7321=>
                19,
                7322=>
                11,
                7323=>
                11,
                7324=>
                15,
                7325=>
                11,
                7326=>
                11,
                7327=>
                15,
                7328=>
                11,
                7329=>
                19,
                7330=>
                19,
                7331=>
                19,
                7332=>
                19,
                7333=>
                19,
                7334=>
                19,
                7335=>
                19,
                7336=>
                15,
                7337=>
                19,
                7338=>
                19,
                7339=>
                19,
                7340=>
                19,
                7341=>
                11,
                7342=>
                11,
                7343=>
                11,
                7344=>
                11,
                7345=>
                11,
                7346=>
                11,
                7347=>
                11,
                7348=>
                11,
                7349=>
                11,
                7350=>
                11,
                7351=>
                11,
                7352=>
                11,
                7353=>
                15,
                7354=>
                15,
                7355=>
                15,
                7356=>
                15,
                7357=>
                15,
                7358=>
                15,
                7359=>
                15,
                7360=>
                11,
                7361=>
                19,
                7362=>
                19,
                7363=>
                19,
                7364=>
                19,
                7365=>
                19,
                7366=>
                21,
                7367=>
                15,
                7368=>
                15,
                7369=>
                15,
                7370=>
                15,
                7371=>
                19,
                7372=>
                19,
                7373=>
                19,
                7374=>
                19,
                7375=>
                4,
                7376=>
                15,
                7377=>
                19,
                7378=>
                19,
                7379=>
                9,
                7380=>
                19,
                7381=>
                19,
                7382=>
                19,
                7383=>
                19,
                7384=>
                19,
                7385=>
                19,
                7386=>
                11,
                7387=>
                5,
                7388=>
                11,
                7389=>
                11,
                7390=>
                11,
                7391=>
                11,
                7392=>
                11,
                7393=>
                21,
                7394=>
                19,
                7395=>
                19,
                7396=>
                19,
                7397=>
                19,
                7398=>
                19,
                7399=>
                5,
                7400=>
                14,
                7401=>
                19,
                7402=>
                19,
                7403=>
                19,
                7404=>
                19,
                7405=>
                19,
                7406=>
                18,
                7407=>
                11,
                7408=>
                19,
                7409=>
                19,
                7410=>
                19,
                7411=>
                19,
                7412=>
                19,
                7413=>
                19,
                7414=>
                19,
                7415=>
                19,
                7416=>
                15,
                7417=>
                11,
                7418=>
                19,
                7419=>
                19,
                7420=>
                19,
                7421=>
                19,
                7422=>
                11,
                7423=>
                11,
                7425=>
                11,
                7426=>
                22,
                7427=>
                11,
                7428=>
                11,
                7429=>
                14,
                7430=>
                15,
                7431=>
                4,
                7432=>
                15,
                7433=>
                15,
                7434=>
                4,
                7435=>
                19,
                7436=>
                11,
                7437=>
                15,
                7438=>
                11,
                7439=>
                19,
                7440=>
                15,
                7441=>
                19,
                7442=>
                6,
                7443=>
                15,
                7444=>
                18,
                7445=>
                15,
                7446=>
                11,
                7447=>
                11,
                7448=>
                6,
                7449=>
                6,
                7450=>
                11,
                7451=>
                11,
                7452=>
                19,
                7453=>
                19,
                7454=>
                19,
                7455=>
                19,
                7456=>
                19,
                7457=>
                11,
                7458=>
                11,
                7459=>
                15,
                7460=>
                18,
                7461=>
                18,
                7464=>
                19,
                7466=>
                19,
                7467=>
                9,
                7483=>
                18,
                7484=>
                15,
                7485=>
                15,
                7487=>
                11,
                7488=>
                15,
                7489=>
                15,
                7490=>
                15,
                7491=>
                11,
                7492=>
                18,
                7493=>
                19,
                7494=>
                19,
                7495=>
                11,
                7496=>
                11,
                7497=>
                11,
                7498=>
                11,
                7499=>
                11,
                7500=>
                11,
                7501=>
                11,
                7502=>
                11,
                7503=>
                15,
                7504=>
                15,
                7505=>
                15,
                7506=>
                18,
                7507=>
                18,
                7508=>
                18,
                7509=>
                15,
                7510=>
                5,
                7511=>
                15,
                7512=>
                18,
                7513=>
                18,
                7514=>
                18,
                7515=>
                18,
                7516=>
                11,
                7517=>
                11,
                7518=>
                11,
                7519=>
                11,
                7520=>
                11,
                7521=>
                11,
                7522=>
                11,
                7523=>
                22,
                7524=>
                11,
                7525=>
                11,
                7526=>
                11,
                7527=>
                11,
                7528=>
                11,
                7529=>
                11,
                7530=>
                11,
                7531=>
                18,
                7532=>
                18,
                7533=>
                18,
                7534=>
                18,
                7535=>
                18,
                7536=>
                18,
                7537=>
                18,
                7538=>
                18,
                7539=>
                14,
                7540=>
                11,
                7541=>
                19,
                7542=>
                15,
                7543=>
                15,
                7544=>
                17,
                7545=>
                15,
                7546=>
                11,
                7547=>
                11,
                7548=>
                11,
                7549=>
                11,
                7550=>
                18,
                7551=>
                19,
                7552=>
                9,
                7553=>
                21,
                7554=>
                21,
                7555=>
                15,
                7557=>
                11,
                7558=>
                11,
                7559=>
                11,
                7560=>
                11,
                7561=>
                11,
                7562=>
                11,
                7563=>
                11,
                7564=>
                18,
                7565=>
                16,
                7566=>
                16,
                7567=>
                16,
                7568=>
                16,
                7569=>
                16,
                7570=>
                5,
                7571=>
                19,
                7572=>
                16,
                7573=>
                16,
                7575=>
                21,
                7576=>
                21,
                7577=>
                21,
                7578=>
                12,
                7579=>
                5,
                7580=>
                5,
                7581=>
                5,
                7582=>
                5,
                7583=>
                19,
                7584=>
                18,
                7585=>
                15,
                7586=>
                18,
                7587=>
                15,
                7588=>
                15,
                7589=>
                14,
                7590=>
                14,
                7591=>
                14,
                7592=>
                14,
                7593=>
                11,
                7594=>
                11,
                7595=>
                19,
                7596=>
                11,
                7597=>
                20,
                7598=>
                20,
                7599=>
                19,
                7600=>
                9,
                7601=>
                11,
                7602=>
                5,
                7603=>
                21,
                7604=>
                19,
                7605=>
                19,
                7606=>
                21,
                7607=>
                21,
                7608=>
                21,
                7609=>
                21,
                7610=>
                21,
                7611=>
                21,
                7612=>
                21,
                7613=>
                21,
                7614=>
                21,
                7615=>
                21,
                7616=>
                11,
                7617=>
                11,
                7618=>
                11,
                7619=>
                11,
                7620=>
                11,
                7621=>
                11,
                7622=>
                11,
                7623=>
                19,
                7624=>
                19,
                7625=>
                5,
                7626=>
                19,
                7627=>
                19,
                7628=>
                19,
                7629=>
                22,
                7630=>
                19,
                7631=>
                19,
                7632=>
                19,
                7633=>
                19,
                7634=>
                19,
                7635=>
                19,
                7636=>
                5,
                7637=>
                5,
                7638=>
                5,
                7639=>
                5,
                7640=>
                5,
                7641=>
                5,
                7642=>
                5,
                7643=>
                5,
                7644=>
                5,
                7645=>
                11,
                7646=>
                9,
                7647=>
                9,
                7648=>
                9,
                7650=>
                5,
                7651=>
                19,
                7652=>
                5,
                7653=>
                18,
                7654=>
                18,
                7657=>
                5,
                7658=>
                5,
                7659=>
                5,
                7660=>
                11,
                7661=>
                19,
                7662=>
                11,
                7663=>
                11,
                7664=>
                21,
                7665=>
                11,
                7666=>
                11,
                7667=>
                21,
                7669=>
                9,
                7670=>
                15,
                7671=>
                15,
                7672=>
                15,
                7673=>
                15,
                7674=>
                15,
                7675=>
                15,
                7676=>
                18,
                7677=>
                18,
                7678=>
                15,
                7679=>
                15,
                7680=>
                5,
                7681=>
                5,
                7682=>
                19,
                7683=>
                19,
                7684=>
                15,
                7693=>
                11,
                7694=>
                4,
                7695=>
                4,
                7696=>
                19,
                7697=>
                21,
                7698=>
                18,
                7699=>
                18,
                7700=>
                19,
                7701=>
                5,
                7709=>
                19,
                7710=>
                20,
                7711=>
                4,
                7715=>
                11,
                7716=>
                11,
                7717=>
                5,
                7718=>
                20,
                7719=>
                4,
                7720=>
                4,
                7721=>
                19,
                7722=>
                9,
                7724=>
                5,
                7725=>
                18,
                7726=>
                15,
                7727=>
                5,
                7729=>
                19,
                7730=>
                11,
                7731=>
                11,
                7732=>
                11,
                7733=>
                11,
                7734=>
                5,
                7735=>
                5,
                7736=>
                5,
                7737=>
                18,
                7738=>
                12,
                7739=>
                19,
                7741=>
                19,
                7742=>
                9,
                7744=>
                11,
                7745=>
                19,
                7746=>
                19,
                7747=>
                6,
                7748=>
                6,
                7749=>
                19,
                7750=>
                11,
                7751=>
                5,
                7752=>
                5,
                7753=>
                15,
                7754=>
                15,
                7755=>
                15,
                7756=>
                6,
                7757=>
                4,
                7758=>
                5,
                7759=>
                9,
                7760=>
                9,
                7761=>
                9,
                7762=>
                9,
                7763=>
                9,
                7764=>
                9,
                7765=>
                9,
                7766=>
                18,
                7767=>
                18,
                7768=>
                15,
                7769=>
                18,
                7770=>
                18,
                7771=>
                5,
                7772=>
                5,
                7773=>
                11,
                7774=>
                11,
                7775=>
                5,
                7776=>
                11,
                7777=>
                11,
                7778=>
                19,
                7779=>
                19,
                7780=>
                9,
                7781=>
                5,
                7782=>
                5,
                7783=>
                5,
                7784=>
                18,
                7785=>
                18,
                7786=>
                11,
                7787=>
                11,
                7788=>
                11,
                7789=>
                9,
                7790=>
                11,
                7791=>
                19,
                7792=>
                11,
                7793=>
                5,
                7794=>
                18,
                7795=>
                15,
                7796=>
                15,
                7797=>
                16,
                7798=>
                16,
                7799=>
                16,
                7800=>
                16,
                7801=>
                16,
                7802=>
                16,
                7803=>
                16,
                7804=>
                16,
                7805=>
                16,
                7806=>
                16,
                7807=>
                8,
                7808=>
                18,
                7809=>
                21,
                7810=>
                21,
                7811=>
                5,
                7812=>
                21,
                7813=>
                11,
                7814=>
                11,
                7815=>
                11,
                7816=>
                11,
                7817=>
                21,
                7818=>
                11,
                7819=>
                11,
                7820=>
                11,
                7821=>
                15,
                7822=>
                11,
                7823=>
                19,
                7824=>
                19,
                7825=>
                19,
                7826=>
                18,
                7827=>
                21,
                7828=>
                19,
                7829=>
                11,
                7830=>
                11,
                7831=>
                11,
                7832=>
                18,
                7833=>
                18,
                7834=>
                15,
                7835=>
                19,
                7836=>
                19,
                7837=>
                11,
                7838=>
                21,
                7839=>
                21,
                7840=>
                11,
                7841=>
                5,
                7842=>
                21,
                7843=>
                11,
                7844=>
                11,
                7845=>
                11,
                7847=>
                11,
                7849=>
                9,
                7850=>
                9,
                7851=>
                9,
                7852=>
                9,
                7853=>
                9,
                7854=>
                9,
                7855=>
                9,
                7856=>
                19,
                7857=>
                19,
                7858=>
                15,
                7859=>
                15,
                7860=>
                15,
                7861=>
                18,
                7862=>
                16,
                7863=>
                11,
                7864=>
                11,
                7865=>
                11,
                7866=>
                16,
                7867=>
                15,
                7868=>
                15,
                7869=>
                18,
                7870=>
                11,
                7871=>
                11,
                7872=>
                11,
                7873=>
                22,
                7874=>
                15,
                7875=>
                15,
                7876=>
                19,
                7877=>
                19,
                7878=>
                15,
                7879=>
                15,
                7880=>
                15,
                7881=>
                11,
                7882=>
                11,
                7883=>
                18,
                7884=>
                18,
                7885=>
                11,
                7886=>
                21,
                7887=>
                15,
                7888=>
                15,
                7889=>
                18,
                7890=>
                15,
                7891=>
                11,
                7892=>
                11,
                7893=>
                11,
                7894=>
                15,
                7895=>
                9,
                7896=>
                9,
                7897=>
                19,
                7898=>
                11,
                7899=>
                11,
                7900=>
                11,
                7901=>
                11,
                7902=>
                11,
                7903=>
                11,
                7904=>
                11,
                7905=>
                22,
                7906=>
                11,
                7907=>
                11,
                7908=>
                11,
                7909=>
                11,
                7910=>
                11,
                7911=>
                11,
                7912=>
                19,
                7913=>
                12,
                7914=>
                15,
                7915=>
                11,
                7916=>
                11,
                7917=>
                11,
                7918=>
                15,
                7919=>
                18,
                7920=>
                15,
                7921=>
                21,
                7969=>
                11,
                7970=>
                11,
                7971=>
                9,
                7972=>
                18,
                7973=>
                11,
                7974=>
                11,
                7975=>
                11,
                7976=>
                11,
                7977=>
                18,
                7978=>
                11,
                7979=>
                19,
                7982=>
                18,
                7983=>
                18,
                8010=>
                18,
                8011=>
                11,
                8012=>
                15,
                8013=>
                22,
                8014=>
                9,
                8015=>
                9,
                8016=>
                15,
                8017=>
                11,
                8018=>
                11,
                8019=>
                11,
                8020=>
                9,
                8021=>
                18,
                8022=>
                14,
                8023=>
                14,
                8024=>
                14,
                8025=>
                14,
                8026=>
                18,
                8027=>
                18,
                8028=>
                15,
                8029=>
                18,
                8030=>
                18,
                8031=>
                18,
                8032=>
                18,
                8033=>
                18,
                8034=>
                18,
                8035=>
                18,
                8036=>
                18,
                8037=>
                18,
                8038=>
                9,
                8039=>
                18,
                8040=>
                18,
                8041=>
                18,
                8042=>
                15,
                8043=>
                15,
                8044=>
                19,
                8045=>
                15,
                8046=>
                15,
                8047=>
                11,
                8048=>
                11,
                8049=>
                11,
                8050=>
                11,
                8051=>
                11,
                8052=>
                11,
                8053=>
                9,
                8054=>
                22,
                8055=>
                22,
                8056=>
                11,
                8057=>
                11,
                8058=>
                11,
                8059=>
                18,
                8060=>
                18,
                8061=>
                18,
                8062=>
                11,
                8063=>
                11,
                8064=>
                18,
                8065=>
                11,
                8066=>
                11,
                8067=>
                11,
                8068=>
                11,
                8069=>
                11,
                8070=>
                11,
                8071=>
                9,
                8072=>
                9,
                8073=>
                15,
                8074=>
                21,
                8075=>
                18,
                8119=>
                11,
                8120=>
                11,
                8121=>
                22,
                8139=>
                11,
                8148=>
                18,
                8149=>
                11,
                8150=>
                11,
                8151=>
                11,
                8152=>
                11,
                8153=>
                18,
                8154=>
                6,
                8155=>
                6,
                8156=>
                18,
                8158=>
                15,
                8159=>
                15,
                8160=>
                15,
                8161=>
                5,
                8162=>
                18,
                8163=>
                18,
                8164=>
                11,
                8165=>
                11,
                8166=>
                11,
                8167=>
                11,
                8168=>
                11,
                8169=>
                11,
                8170=>
                11,
                8171=>
                15,
                8172=>
                15,
                8173=>
                15,
                8174=>
                15,
                8175=>
                15,
                8176=>
                15,
                8177=>
                15,
                8178=>
                21,
                8180=>
                9,
                8181=>
                9,
                8182=>
                18,
                8183=>
                9,
                8184=>
                11,
                8185=>
                11,
                8186=>
                9,
                8187=>
                5,
                8188=>
                19,
                8189=>
                11,
                8190=>
                9,
                8191=>
                5,
                8192=>
                11,
                8193=>
                15,
                8194=>
                11,
                8195=>
                19,
                8196=>
                11,
                8197=>
                11,
                8198=>
                11,
                8199=>
                15,
                8200=>
                11,
                8201=>
                15,
                8202=>
                15,
                8203=>
                11,
                8204=>
                9,
                8205=>
                19,
                8206=>
                9,
                8207=>
                9,
                8208=>
                9,
                8209=>
                9,
                8210=>
                19,
                8211=>
                19,
                8212=>
                19,
                8213=>
                9,
                8214=>
                9,
                8215=>
                11,
                8216=>
                11,
                8217=>
                11,
                8218=>
                11,
                8219=>
                11,
                8220=>
                11,
                8221=>
                11,
                8222=>
                11,
                8223=>
                11,
                8224=>
                11,
                8225=>
                21,
                8226=>
                18,
                8227=>
                14,
                8228=>
                14,
                8229=>
                19,
                8230=>
                19,
                8231=>
                9,
                8232=>
                21,
                8233=>
                19,
                8234=>
                5,
                8235=>
                5,
                8236=>
                5,
                8237=>
                11,
                8238=>
                11,
                8239=>
                9,
                8240=>
                5,
                8241=>
                5,
                8242=>
                19,
                8243=>
                18,
                8244=>
                18,
                8245=>
                18,
                8246=>
                18,
                8247=>
                19,
                8248=>
                11,
                8249=>
                5,
                8250=>
                5,
                8251=>
                19,
                8252=>
                21,
                8253=>
                21,
                8254=>
                21,
                8255=>
                21,
                8258=>
                11,
                8259=>
                11,
                8260=>
                11,
                8261=>
                15,
                8262=>
                11,
                8263=>
                11,
                8264=>
                11,
                8265=>
                11,
                8266=>
                19,
                8267=>
                11,
                8268=>
                11,
                8269=>
                11,
                8270=>
                11,
                8271=>
                19,
                8272=>
                19,
                8273=>
                6,
                8274=>
                5,
                8275=>
                19,
                8276=>
                9,
                8303=>
                11,
                8304=>
                15,
                8313=>
                15,
                8314=>
                22,
                8315=>
                15,
                8317=>
                11,
                8333=>
                6,
                8334=>
                9,
                8335=>
                9,
                8336=>
                6,
                8373=>
                19,
                8393=>
                15,
                8394=>
                4,
                8395=>
                19,
                8396=>
                19,
                8397=>
                19,
                8398=>
                11,
                8399=>
                11,
                8400=>
                11,
                8401=>
                11,
                8402=>
                11,
                8403=>
                11,
                8404=>
                19,
                8405=>
                19,
                8406=>
                18,
                8407=>
                9,
                8408=>
                11,
                8409=>
                11,
                8410=>
                11,
                8411=>
                11,
                8412=>
                9,
                8414=>
                19,
                8447=>
                20,
                8565=>
                15,
                8566=>
                15,
                8567=>
                6,
                8588=>
                19,
                8589=>
                18,
                8590=>
                18,
                8591=>
                9,
                8592=>
                9,
                8593=>
                9,
                8594=>
                9,
                8617=>
                15,
                8618=>
                9,
                8619=>
                12,
                8620=>
                19,
                8621=>
                9,
                8622=>
                9,
                8623=>
                9,
                8624=>
                9,
                8625=>
                9,
                8626=>
                9,
                8627=>
                19,
                8628=>
                15,
                8629=>
                15,
                8630=>
                11,
                8631=>
                18,
                8632=>
                18,
                8633=>
                18,
                8634=>
                18,
                8635=>
                11,
                8636=>
                11,
                8637=>
                9,
                8638=>
                18,
                8639=>
                18,
                8640=>
                18,
                8641=>
                18,
                8642=>
                18,
                8643=>
                11,
                8644=>
                11,
                8645=>
                19,
                8646=>
                11,
                8647=>
                11,
                8648=>
                11,
                8649=>
                5,
                8650=>
                5,
                8651=>
                11,
                8652=>
                11,
                8653=>
                11,
                8654=>
                21,
                8655=>
                21,
                8656=>
                15,
                8657=>
                9,
                8658=>
                11,
                8659=>
                15,
                8660=>
                15,
                8661=>
                11,
                8662=>
                11,
                8663=>
                15,
                8664=>
                22,
                8665=>
                22,
                8666=>
                15,
                8667=>
                15,
                8668=>
                9,
                8669=>
                9,
                8670=>
                11,
                8671=>
                11,
                8672=>
                11,
                8673=>
                11,
                8674=>
                11,
                8675=>
                11,
                8676=>
                11,
                8677=>
                11,
                8678=>
                11,
                8679=>
                11,
                8680=>
                11,
                8681=>
                11,
                8682=>
                18,
                8683=>
                11,
                8684=>
                11,
                8685=>
                11,
                8686=>
                15,
                8687=>
                15,
                8688=>
                15,
                8689=>
                18,
                8690=>
                19,
                8691=>
                19,
                8692=>
                5,
                8693=>
                11,
                8694=>
                11,
                8695=>
                11,
                8696=>
                6,
                8697=>
                15,
                8698=>
                15,
                8699=>
                15,
                8700=>
                19,
                8701=>
                15,
                8702=>
                21,
                8703=>
                21,
                8704=>
                21,
                8705=>
                13,
                8706=>
                21,
                8707=>
                21,
                8708=>
                11,
                8709=>
                11,
                8710=>
                11,
                8711=>
                4,
                8712=>
                11,
                8713=>
                11,
                8714=>
                21,
                8715=>
                11,
                8716=>
                17,
                8717=>
                21,
                8718=>
                17,
                8720=>
                11,
                8721=>
                18,
                8722=>
                18,
                8723=>
                18,
                8724=>
                18,
                8725=>
                21,
                8726=>
                22,
                8727=>
                12,
                8728=>
                15,
                8729=>
                11,
                8730=>
                11,
                8731=>
                11,
                8732=>
                11,
                8733=>
                17,
                8734=>
                11,
                8735=>
                15,
                8736=>
                15,
                8737=>
                15,
                8738=>
                15,
                8739=>
                15,
                8740=>
                15,
                8741=>
                15,
                8742=>
                15,
                8743=>
                15,
                8744=>
                19,
                8745=>
                19,
                8746=>
                19,
                8747=>
                19,
                8748=>
                9,
                8749=>
                9,
                8750=>
                11,
                8751=>
                11,
                8752=>
                11,
                8753=>
                11,
                8754=>
                11,
                8755=>
                15,
                8756=>
                11,
                8757=>
                11,
                8758=>
                15,
                8759=>
                21,
                8760=>
                9,
                8761=>
                9,
                8762=>
                9,
                8763=>
                11,
                8764=>
                11,
                8765=>
                11,
                8766=>
                18,
                8767=>
                18,
                8768=>
                18,
                8769=>
                18,
                8770=>
                18,
                8771=>
                9,
                8772=>
                11,
                8773=>
                11,
                8774=>
                4,
                8775=>
                18,
                8776=>
                9,
                8777=>
                9,
                8778=>
                9,
                8779=>
                19,
                8780=>
                11,
                8781=>
                11,
                8782=>
                11,
                8783=>
                11,
                8784=>
                11,
                8785=>
                11,
                8786=>
                19,
                8787=>
                11,
                8788=>
                19,
                8789=>
                19,
                8790=>
                19,
                8791=>
                19,
                8792=>
                11,
                8793=>
                8,
                8794=>
                15,
                8795=>
                11,
                8796=>
                11,
                8797=>
                11,
                8798=>
                11,
                8799=>
                11,
                8800=>
                11,
                8801=>
                11,
                8802=>
                11,
                8803=>
                11,
                8804=>
                11,
                8805=>
                11,
                8806=>
                11,
                8807=>
                11,
                8808=>
                15,
                8809=>
                11,
                8810=>
                11,
                8811=>
                11,
                8812=>
                11,
                8813=>
                19,
                8814=>
                19,
                8815=>
                15,
                8816=>
                9,
                8817=>
                11,
                8818=>
                11,
                8819=>
                11,
                8820=>
                11,
                8821=>
                11,
                8822=>
                11,
                8823=>
                11,
                8824=>
                19,
                8825=>
                4,
                8826=>
                4,
                8827=>
                18,
                8828=>
                4,
                8829=>
                11,
                8830=>
                11,
                8831=>
                11,
                8832=>
                11,
                8833=>
                11,
                8834=>
                11,
                8835=>
                11,
                8836=>
                11,
                8837=>
                21,
                8838=>
                15,
                8839=>
                9,
                8840=>
                9,
                8841=>
                11,
                8842=>
                11,
                8843=>
                11,
                8844=>
                5,
                8845=>
                5,
                8846=>
                5,
                8847=>
                5,
                8848=>
                5,
                8849=>
                5,
                8850=>
                11,
                8851=>
                11,
                8852=>
                5,
                8853=>
                11,
                8854=>
                11,
                8855=>
                17,
                8856=>
                11,
                8857=>
                11,
                8858=>
                4,
                8859=>
                19,
                8860=>
                11,
                8861=>
                11,
                8862=>
                11,
                8863=>
                19,
                8864=>
                19,
                8865=>
                19,
                8866=>
                11,
                8867=>
                9,
                8868=>
                9,
                8869=>
                9,
                8870=>
                15,
                8871=>
                11,
                8872=>
                11,
                8873=>
                18,
                8874=>
                15,
                8875=>
                15,
                8876=>
                11,
                8877=>
                18,
                8878=>
                18,
                8879=>
                11,
                8880=>
                19,
                8881=>
                19,
                8882=>
                9,
                8883=>
                9,
                8884=>
                9,
                8885=>
                19,
                8886=>
                19,
                8887=>
                11,
                8888=>
                11,
                8889=>
                11,
                8890=>
                9,
                8891=>
                11,
                8892=>
                11,
                8893=>
                11,
                8894=>
                11,
                8895=>
                11,
                8896=>
                11,
                8897=>
                9,
                8898=>
                9,
                8899=>
                9,
                8900=>
                9,
                8901=>
                9,
                8902=>
                15,
                8903=>
                15,
                8904=>
                9,
                8905=>
                9,
                8906=>
                18,
                8907=>
                9,
                8908=>
                15,
                8909=>
                11,
                8913=>
                15,
                8914=>
                11,
                8915=>
                11,
                8916=>
                11,
                8917=>
                11,
                8918=>
                11,
                8919=>
                6,
                8920=>
                11,
                8921=>
                9,
                8922=>
                19,
                8923=>
                15,
                8924=>
                15,
                8925=>
                15,
                8926=>
                15,
                8927=>
                15,
                8928=>
                19,
                8929=>
                22,
                8930=>
                22,
                8931=>
                22,
                8932=>
                9,
                8933=>
                9,
                8934=>
                9,
                8935=>
                18,
                8936=>
                18,
                8937=>
                5,
                8938=>
                11,
                8939=>
                11,
                8940=>
                11,
                8941=>
                11,
                8942=>
                11,
                8943=>
                11,
                8944=>
                11,
                8945=>
                11,
                8946=>
                11,
                8947=>
                11,
                8948=>
                11,
                8949=>
                11,
                8950=>
                15,
                8951=>
                15,
                8952=>
                11,
                8953=>
                11,
                8954=>
                11,
                8955=>
                15,
                8956=>
                15,
                8957=>
                15,
                8958=>
                19,
                8959=>
                5,
                8960=>
                5,
                8961=>
                5,
                8962=>
                5,
                8963=>
                5,
                8964=>
                5,
                8965=>
                5,
                8966=>
                15,
                8967=>
                15,
                8968=>
                5,
                8969=>
                6,
                8970=>
                6,
                8971=>
                5,
                8972=>
                5,
                8973=>
                11,
                8974=>
                11,
                8975=>
                5,
                8976=>
                11,
                8977=>
                15,
                8978=>
                14,
                8979=>
                14,
                8980=>
                11,
                8981=>
                22,
                8982=>
                11,
                8983=>
                11,
                8984=>
                22,
                8985=>
                9,
                8986=>
                21,
                8987=>
                21,
                8988=>
                9,
                8990=>
                9,
                8991=>
                19,
                8992=>
                19,
                8993=>
                15,
                8994=>
                15,
                8995=>
                15,
                8996=>
                15,
                8997=>
                15,
                8998=>
                15,
                8999=>
                15,
                9000=>
                15,
                9001=>
                11,
                9002=>
                11,
                9003=>
                11,
                9004=>
                11,
                9005=>
                11,
                9006=>
                11,
                9007=>
                5,
                9008=>
                21,
                9009=>
                20,
                9010=>
                19,
                9011=>
                5,
                9012=>
                5,
                9013=>
                15,
                9015=>
                11,
                9017=>
                19,
                9018=>
                5,
                9019=>
                19,
                9020=>
                19,
                9021=>
                19,
                9022=>
                19,
                9024=>
                11,
                9025=>
                11,
                9026=>
                11,
                9027=>
                11,
                9028=>
                9,
                9029=>
                19,
                9030=>
                9,
                9031=>
                9,
                9032=>
                9,
                9033=>
                9,
                9035=>
                11,
                9036=>
                15,
                9037=>
                15,
                9038=>
                15,
                9039=>
                9,
                9040=>
                19,
                9041=>
                19,
                9042=>
                11,
                9043=>
                11,
                9044=>
                11,
                9045=>
                11,
                9046=>
                11,
                9047=>
                11,
                9048=>
                11,
                9049=>
                11,
                9050=>
                9,
                9051=>
                9,
                9052=>
                9,
                9054=>
                15,
                9055=>
                15,
                9056=>
                15,
                9057=>
                15,
                9058=>
                9,
                9059=>
                4,
                9060=>
                18,
                9061=>
                11,
                9062=>
                11,
                9063=>
                11,
                9064=>
                11,
                9065=>
                4,
                9066=>
                4,
                9067=>
                4,
                9068=>
                9,
                9069=>
                11,
                9070=>
                10,
                9071=>
                19,
                9072=>
                9,
                9073=>
                9,
                9074=>
                8,
                9075=>
                8,
                9076=>
                8,
                9077=>
                8,
                9078=>
                15,
                9079=>
                15,
                9080=>
                15,
                9081=>
                15,
                9082=>
                15,
                9083=>
                18,
                9084=>
                21,
                9085=>
                5,
                9086=>
                11,
                9087=>
                11,
                9088=>
                11,
                9089=>
                11,
                9090=>
                11,
                9091=>
                11,
                9092=>
                18,
                9093=>
                11,
                9094=>
                9,
                9095=>
                11,
                9096=>
                9,
                9097=>
                9,
                9098=>
                16,
                9099=>
                9,
                9100=>
                9,
                9101=>
                9,
                9102=>
                9,
                9103=>
                9,
                9104=>
                9,
                9105=>
                11,
                9106=>
                11,
                9107=>
                9,
                9108=>
                5,
                9109=>
                11,
                9110=>
                9,
                9111=>
                9,
                9112=>
                9,
                9113=>
                9,
                9114=>
                15,
                9115=>
                15,
                9116=>
                22,
                9117=>
                22,
                9118=>
                22,
                9119=>
                17,
                9120=>
                18,
                9121=>
                11,
                9122=>
                11,
                9123=>
                11,
                9124=>
                11,
                9125=>
                11,
                9126=>
                9,
                9127=>
                9,
                9128=>
                9,
                9129=>
                11,
                9130=>
                22,
                9131=>
                15,
                9132=>
                19,
                9133=>
                9,
                9134=>
                11,
                9135=>
                5,
                9136=>
                18,
                9137=>
                18,
                9138=>
                11,
                9139=>
                11,
                9140=>
                18,
                9141=>
                15,
                9142=>
                4,
                9143=>
                4,
                9144=>
                16,
                9145=>
                16,
                9146=>
                5,
                9147=>
                16,
                9148=>
                9,
                9149=>
                9,
                9150=>
                11,
                9151=>
                9,
                9152=>
                15,
                9153=>
                15,
                9154=>
                15,
                9155=>
                15,
                9156=>
                9,
                9157=>
                11,
                9158=>
                11,
                9159=>
                9,
                9160=>
                11,
                9161=>
                11,
                9162=>
                11,
                9163=>
                11,
                9164=>
                11,
                9165=>
                9,
                9166=>
                15,
                9167=>
                16,
                9168=>
                9,
                9169=>
                9,
                9170=>
                11,
                9171=>
                11,
                9172=>
                11,
                9173=>
                18,
                9174=>
                11,
                9175=>
                11,
                9176=>
                11,
                9177=>
                11,
                9178=>
                11,
                9179=>
                18,
                9180=>
                18,
                9181=>
                9,
                9182=>
                9,
                9183=>
                11,
                9184=>
                18,
                9185=>
                18,
                9186=>
                9,
                9187=>
                9,
                9188=>
                9,
                9189=>
                9,
                9190=>
                11,
                9191=>
                12,
                9192=>
                11,
                9193=>
                5,
                9194=>
                9,
                9195=>
                9,
                9196=>
                15,
                9197=>
                9,
                9198=>
                9,
                9199=>
                11,
                9200=>
                9,
                9201=>
                9,
                9202=>
                5,
                9203=>
                15,
                9204=>
                5,
                9205=>
                5,
                9206=>
                9,
                9207=>
                11,
                9208=>
                11,
                9209=>
                11,
                9210=>
                9,
                9211=>
                16,
                9212=>
                16,
                9213=>
                5,
                9214=>
                9,
                9215=>
                9,
                9216=>
                9,
                9217=>
                4,
                9218=>
                4,
                9219=>
                21,
                9220=>
                9,
                9221=>
                9,
                9222=>
                11,
                9223=>
                18,
                9224=>
                18,
                9225=>
                5,
                9226=>
                11,
                9227=>
                11,
                9228=>
                11,
                9229=>
                11,
                9230=>
                11,
                9231=>
                9,
                9232=>
                5,
                9233=>
                22,
                9234=>
                22,
                9235=>
                22,
                9236=>
                21,
                9237=>
                11,
                9238=>
                11,
                9239=>
                11,
                9240=>
                9,
                9241=>
                21,
                9242=>
                15,
                9243=>
                19,
                9244=>
                21,
                9245=>
                21,
                9246=>
                9,
                9247=>
                6,
                9248=>
                18,
                9249=>
                5,
                9250=>
                18,
                9251=>
                11,
                9252=>
                18,
                9253=>
                19,
                9254=>
                4,
                9255=>
                12,
                9256=>
                19,
                9257=>
                20,
                9258=>
                20,
                9259=>
                20,
                9260=>
                15,
                9261=>
                15,
                9262=>
                18,
                9263=>
                18,
                9264=>
                18,
                9265=>
                14,
                9266=>
                18,
                9267=>
                18,
                9268=>
                21,
                9269=>
                11,
                9270=>
                11,
                9271=>
                9,
                9272=>
                15,
                9273=>
                21,
                9274=>
                10,
                9275=>
                15,
                9276=>
                22,
                9277=>
                22,
                9278=>
                11,
                9279=>
                9,
                9280=>
                9,
                9281=>
                6,
                9282=>
                6,
                9283=>
                6,
                9284=>
                6,
                9285=>
                6,
                9286=>
                22,
                9287=>
                22,
                9288=>
                15,
                9289=>
                9,
                9290=>
                12,
                9291=>
                11,
                9292=>
                4,
                9293=>
                4,
                9294=>
                4,
                9295=>
                13,
                9296=>
                15,
                9297=>
                9,
                9298=>
                22,
                9299=>
                22,
                9300=>
                11,
                9301=>
                11,
                9302=>
                11,
                9303=>
                11,
                9304=>
                9,
                9305=>
                9,
                9306=>
                15,
                9307=>
                21,
                9308=>
                21,
                9309=>
                9,
                9310=>
                18,
                9311=>
                11,
                9312=>
                11,
                9313=>
                11,
                9314=>
                9,
                9315=>
                9,
                9316=>
                22,
                9317=>
                22,
                9318=>
                9,
                9319=>
                9,
                9320=>
                9,
                9321=>
                19,
                9322=>
                19,
                9323=>
                19,
                9324=>
                18,
                9325=>
                19,
                9326=>
                11,
                9327=>
                11,
                9328=>
                11,
                9329=>
                11,
                9330=>
                11,
                9331=>
                11,
                9332=>
                11,
                9333=>
                5,
                9334=>
                19,
                9335=>
                19,
                9336=>
                19,
                9337=>
                19,
                9338=>
                19,
                9339=>
                19,
                9340=>
                19,
                9341=>
                15,
                9342=>
                6,
                9343=>
                18,
                9344=>
                18,
                9345=>
                18,
                9346=>
                18,
                9347=>
                18,
                9348=>
                11,
                9349=>
                11,
                9350=>
                11,
                9351=>
                11,
                9352=>
                19,
                9353=>
                18,
                9354=>
                18,
                9355=>
                11,
                9356=>
                19,
                9357=>
                18,
                9358=>
                18,
                9359=>
                11,
                9360=>
                15,
                9361=>
                15,
                9362=>
                21,
                9364=>
                18,
                9365=>
                18,
                9366=>
                18,
                9367=>
                18,
                9368=>
                18,
                9369=>
                19,
                9370=>
                19,
                9371=>
                11,
                9372=>
                18,
                9373=>
                18,
                9374=>
                18,
                9375=>
                19,
                9376=>
                18,
                9377=>
                18,
                9378=>
                19,
                9379=>
                19,
                9380=>
                22,
                9381=>
                22,
                9382=>
                22,
                9383=>
                11,
                9384=>
                11,
                9385=>
                11,
                9386=>
                11,
                9387=>
                11,
                9388=>
                21,
                9389=>
                18,
                9390=>
                18,
                9391=>
                18,
                9392=>
                18,
                9393=>
                11,
                9394=>
                11,
                9395=>
                11,
                9396=>
                18,
                9397=>
                18,
                9398=>
                18,
                9399=>
                18,
                9400=>
                19,
                9401=>
                19,
                9402=>
                19,
                9403=>
                11,
                9404=>
                11,
                9405=>
                11,
                9406=>
                11,
                9407=>
                11,
                9408=>
                11,
                9409=>
                11,
                9410=>
                11,
                9411=>
                11,
                9412=>
                11,
                9413=>
                11,
                9414=>
                11,
                9415=>
                11,
                9416=>
                11,
                9417=>
                11,
                9418=>
                11,
                9419=>
                19,
                9420=>
                19,
                9421=>
                19,
                9422=>
                19,
                9423=>
                19,
                9424=>
                19,
                9425=>
                19,
                9426=>
                19,
                9427=>
                19,
                9428=>
                19,
                9429=>
                19,
                9430=>
                19,
                9431=>
                19,
                9432=>
                19,
                9433=>
                19,
                9434=>
                19,
                9435=>
                19,
                9436=>
                19,
                9437=>
                19,
                9438=>
                19,
                9439=>
                19,
                9440=>
                19,
                9441=>
                19
            ];

            $array_medidas_corregidas = [
                1=>
                11,
                3=>
                11,
                4=>
                11,
                5=>
                11,
                6=>
                11,
                7=>
                11,
                8=>
                11,
                9=>
                11,
                10=>
                11,
                13=>
                11,
                14=>
                11,
                15=>
                11,
                16=>
                11,
                17=>
                11,
                19=>
                11,
                24=>
                15,
                26=>
                15,
                27=>
                15,
                28=>
                15,
                29=>
                11,
                30=>
                15,
                31=>
                15,
                32=>
                15,
                33=>
                15,
                34=>
                11,
                35=>
                15,
                36=>
                11,
                37=>
                11,
                38=>
                11,
                39=>
                11,
                40=>
                11,
                42=>
                11,
                43=>
                11,
                44=>
                11,
                45=>
                15,
                46=>
                11,
                47=>
                11,
                48=>
                11,
                49=>
                11,
                50=>
                11,
                55=>
                8,
                56=>
                15,
                57=>
                8,
                59=>
                8,
                60=>
                8,
                61=>
                8,
                62=>
                8,
                64=>
                8,
                66=>
                8,
                67=>
                15,
                69=>
                8,
                70=>
                11,
                71=>
                11,
                72=>
                11,
                73=>
                11,
                74=>
                11,
                75=>
                11,
                76=>
                11,
                77=>
                11,
                78=>
                15,
                79=>
                11,
                80=>
                11,
                81=>
                11,
                82=>
                11,
                83=>
                11,
                84=>
                11,
                85=>
                11,
                86=>
                11,
                87=>
                11,
                88=>
                11,
                89=>
                15,
                90=>
                11,
                91=>
                11,
                93=>
                11,
                94=>
                11,
                95=>
                11,
                96=>
                11,
                97=>
                11,
                98=>
                11,
                99=>
                11,
                100=>
                15,
                101=>
                11,
                102=>
                11,
                103=>
                11,
                104=>
                11,
                105=>
                11,
                106=>
                11,
                107=>
                11,
                108=>
                11,
                109=>
                11,
                110=>
                11,
                111=>
                11,
                112=>
                15,
                113=>
                11,
                114=>
                11,
                115=>
                11,
                116=>
                11,
                117=>
                11,
                120=>
                11,
                121=>
                11,
                122=>
                15,
                123=>
                15,
                131=>
                11,
                132=>
                11,
                133=>
                15,
                135=>
                11,
                136=>
                11,
                139=>
                11,
                140=>
                11,
                141=>
                11,
                142=>
                11,
                143=>
                11,
                144=>
                15,
                145=>
                11,
                146=>
                11,
                147=>
                11,
                148=>
                11,
                149=>
                11,
                150=>
                11,
                153=>
                8,
                154=>
                15,
                158=>
                8,
                159=>
                8,
                161=>
                8,
                163=>
                11,
                164=>
                8,
                168=>
                8,
                169=>
                8,
                170=>
                8,
                171=>
                8,
                172=>
                8,
                173=>
                8,
                174=>
                8,
                175=>
                15,
                176=>
                8,
                177=>
                8,
                178=>
                8,
                179=>
                8,
                180=>
                8,
                181=>
                8,
                182=>
                11,
                183=>
                11,
                184=>
                11,
                185=>
                11,
                186=>
                15,
                187=>
                11,
                188=>
                11,
                189=>
                11,
                190=>
                11,
                191=>
                11,
                192=>
                11,
                193=>
                11,
                194=>
                11,
                195=>
                11,
                196=>
                11,
                197=>
                15,
                198=>
                11,
                199=>
                11,
                200=>
                11,
                201=>
                11,
                202=>
                11,
                203=>
                11,
                204=>
                11,
                205=>
                11,
                206=>
                11,
                207=>
                11,
                208=>
                15,
                209=>
                11,
                210=>
                11,
                211=>
                11,
                212=>
                11,
                213=>
                11,
                214=>
                11,
                215=>
                11,
                216=>
                11,
                217=>
                11,
                219=>
                15,
                220=>
                15,
                221=>
                11,
                222=>
                11,
                223=>
                11,
                224=>
                11,
                225=>
                11,
                229=>
                11,
                230=>
                11,
                231=>
                15,
                232=>
                11,
                233=>
                11,
                234=>
                11,
                235=>
                11,
                236=>
                11,
                237=>
                11,
                238=>
                11,
                239=>
                11,
                240=>
                11,
                241=>
                11,
                242=>
                15,
                243=>
                11,
                244=>
                11,
                245=>
                11,
                246=>
                11,
                247=>
                11,
                249=>
                15,
                251=>
                15,
                253=>
                15,
                264=>
                15,
                268=>
                15,
                275=>
                15,
                286=>
                15,
                302=>
                15,
                305=>
                15,
                308=>
                15,
                313=>
                15,
                315=>
                15,
                316=>
                15,
                319=>
                15,
                330=>
                15,
                331=>
                15,
                336=>
                15,
                342=>
                15,
                352=>
                15,
                353=>
                15,
                361=>
                15,
                367=>
                15,
                375=>
                15,
                383=>
                15,
                387=>
                15,
                389=>
                15,
                394=>
                15,
                396=>
                15,
                397=>
                15,
                398=>
                15,
                400=>
                15,
                403=>
                15,
                404=>
                15,
                406=>
                15,
                407=>
                15,
                408=>
                15,
                413=>
                15,
                414=>
                15,
                418=>
                15,
                426=>
                15,
                427=>
                15,
                429=>
                15,
                430=>
                15,
                432=>
                15,
                437=>
                15,
                440=>
                15,
                441=>
                15,
                443=>
                15,
                444=>
                15,
                445=>
                15,
                446=>
                15,
                449=>
                15,
                451=>
                15,
                452=>
                15,
                454=>
                15,
                455=>
                15,
                456=>
                15,
                457=>
                15,
                459=>
                15,
                460=>
                15,
                462=>
                15,
                463=>
                15,
                465=>
                15,
                466=>
                15,
                467=>
                15,
                471=>
                15,
                473=>
                15,
                474=>
                15,
                479=>
                15,
                482=>
                15,
                484=>
                15,
                486=>
                15,
                489=>
                15,
                491=>
                15,
                495=>
                15,
                506=>
                15,
                517=>
                15,
                518=>
                15,
                528=>
                15,
                536=>
                15,
                540=>
                15,
                542=>
                15,
                544=>
                15,
                545=>
                15,
                548=>
                15,
                551=>
                15,
                552=>
                15,
                553=>
                15,
                555=>
                15,
                557=>
                15,
                558=>
                15,
                562=>
                15,
                571=>
                15,
                573=>
                15,
                575=>
                15,
                577=>
                15,
                579=>
                15,
                582=>
                15,
                584=>
                15,
                588=>
                15,
                590=>
                15,
                592=>
                15,
                594=>
                15,
                595=>
                15,
                597=>
                8,
                598=>
                8,
                599=>
                8,
                600=>
                8,
                601=>
                8,
                602=>
                8,
                603=>
                8,
                604=>
                8,
                605=>
                8,
                606=>
                15,
                607=>
                8,
                608=>
                8,
                609=>
                8,
                612=>
                15,
                614=>
                15,
                615=>
                15,
                616=>
                15,
                617=>
                15,
                619=>
                15,
                620=>
                15,
                621=>
                15,
                623=>
                15,
                624=>
                15,
                625=>
                15,
                626=>
                15,
                627=>
                15,
                628=>
                15,
                629=>
                15,
                630=>
                15,
                631=>
                15,
                632=>
                15,
                633=>
                15,
                635=>
                15,
                636=>
                15,
                637=>
                15,
                638=>
                15,
                639=>
                15,
                650=>
                15,
                655=>
                11,
                656=>
                11,
                657=>
                11,
                658=>
                11,
                659=>
                11,
                660=>
                11,
                662=>
                15,
                665=>
                15,
                673=>
                15,
                680=>
                11,
                681=>
                11,
                682=>
                9,
                684=>
                15,
                685=>
                11,
                686=>
                11,
                687=>
                11,
                688=>
                11,
                689=>
                9,
                690=>
                4,
                691=>
                4,
                692=>
                4,
                693=>
                4,
                694=>
                4,
                696=>
                4,
                697=>
                4,
                698=>
                4,
                699=>
                4,
                700=>
                4,
                706=>
                15,
                707=>
                4,
                709=>
                4,
                710=>
                4,
                711=>
                4,
                712=>
                4,
                713=>
                4,
                715=>
                4,
                716=>
                4,
                717=>
                15,
                718=>
                4,
                719=>
                4,
                721=>
                15,
                722=>
                7,
                724=>
                7,
                725=>
                7,
                726=>
                7,
                727=>
                7,
                728=>
                15,
                729=>
                7,
                730=>
                7,
                731=>
                7,
                737=>
                7,
                739=>
                15,
                750=>
                15,
                761=>
                15,
                768=>
                4,
                773=>
                15,
                776=>
                11,
                777=>
                11,
                778=>
                11,
                784=>
                15,
                789=>
                11,
                790=>
                11,
                791=>
                11,
                792=>
                11,
                793=>
                11,
                795=>
                15,
                797=>
                11,
                799=>
                11,
                800=>
                11,
                801=>
                11,
                803=>
                15,
                806=>
                15,
                808=>
                15,
                809=>
                15,
                810=>
                15,
                811=>
                15,
                812=>
                15,
                813=>
                15,
                814=>
                15,
                815=>
                15,
                816=>
                15,
                817=>
                15,
                818=>
                15,
                819=>
                15,
                820=>
                15,
                821=>
                15,
                822=>
                15,
                823=>
                15,
                824=>
                15,
                825=>
                15,
                826=>
                15,
                827=>
                11,
                828=>
                15,
                829=>
                11,
                831=>
                9,
                832=>
                9,
                833=>
                4,
                834=>
                15,
                835=>
                15,
                837=>
                11,
                838=>
                11,
                839=>
                15,
                841=>
                11,
                842=>
                11,
                843=>
                11,
                844=>
                11,
                845=>
                11,
                846=>
                15,
                847=>
                15,
                848=>
                15,
                849=>
                15,
                850=>
                15,
                851=>
                11,
                852=>
                4,
                853=>
                4,
                854=>
                15,
                855=>
                15,
                856=>
                15,
                858=>
                15,
                859=>
                15,
                860=>
                15,
                861=>
                15,
                862=>
                15,
                864=>
                8,
                865=>
                11,
                866=>
                15,
                867=>
                15,
                868=>
                15,
                869=>
                15,
                870=>
                15,
                871=>
                15,
                873=>
                15,
                875=>
                15,
                876=>
                11,
                877=>
                8,
                895=>
                9,
                897=>
                15,
                898=>
                15,
                900=>
                15,
                901=>
                15,
                903=>
                11,
                905=>
                11,
                906=>
                11,
                907=>
                11,
                908=>
                11,
                909=>
                11,
                910=>
                11,
                911=>
                11,
                916=>
                11,
                917=>
                11,
                918=>
                11,
                919=>
                11,
                920=>
                11,
                921=>
                11,
                922=>
                15,
                923=>
                15,
                924=>
                15,
                925=>
                15,
                926=>
                15,
                928=>
                11,
                929=>
                15,
                930=>
                15,
                931=>
                15,
                932=>
                15,
                933=>
                15,
                934=>
                15,
                935=>
                15,
                936=>
                11,
                937=>
                11,
                938=>
                11,
                940=>
                11,
                941=>
                15,
                942=>
                4,
                943=>
                15,
                944=>
                15,
                945=>
                4,
                957=>
                4,
                958=>
                4,
                963=>
                15,
                975=>
                15,
                1008=>
                15,
                1010=>
                15,
                1015=>
                15,
                1016=>
                15,
                1017=>
                15,
                1018=>
                15,
                1019=>
                15,
                1020=>
                15,
                1021=>
                15,
                1022=>
                15,
                1023=>
                15,
                1024=>
                15,
                1029=>
                15,
                1030=>
                15,
                1031=>
                11,
                1032=>
                11,
                1035=>
                11,
                1037=>
                11,
                1038=>
                11,
                1039=>
                11,
                1040=>
                11,
                1042=>
                11,
                1043=>
                11,
                1044=>
                11,
                1045=>
                8,
                1046=>
                8,
                1047=>
                8,
                1048=>
                8,
                1049=>
                8,
                1050=>
                8,
                1051=>
                8,
                1053=>
                8,
                1054=>
                8,
                1055=>
                8,
                1056=>
                8,
                1057=>
                8,
                1058=>
                8,
                1059=>
                8,
                1060=>
                8,
                1061=>
                8,
                1062=>
                8,
                1063=>
                8,
                1064=>
                8,
                1065=>
                8,
                1066=>
                8,
                1067=>
                11,
                1068=>
                11,
                1069=>
                11,
                1070=>
                11,
                1071=>
                11,
                1072=>
                11,
                1073=>
                11,
                1074=>
                11,
                1075=>
                11,
                1076=>
                11,
                1077=>
                11,
                1078=>
                11,
                1079=>
                11,
                1080=>
                11,
                1081=>
                11,
                1082=>
                8,
                1083=>
                4,
                1084=>
                15,
                1089=>
                15,
                1090=>
                15,
                1091=>
                11,
                1093=>
                11,
                1095=>
                11,
                1096=>
                11,
                1097=>
                11,
                1099=>
                11,
                1101=>
                11,
                1102=>
                11,
                1103=>
                11,
                1106=>
                4,
                1107=>
                8,
                1109=>
                8,
                1110=>
                11,
                1111=>
                4,
                1112=>
                11,
                1113=>
                8,
                1114=>
                15,
                1118=>
                15,
                1119=>
                15,
                1120=>
                15,
                1121=>
                15,
                1122=>
                15,
                1123=>
                11,
                1124=>
                11,
                1125=>
                11,
                1126=>
                11,
                1127=>
                11,
                1128=>
                11,
                1129=>
                11,
                1130=>
                11,
                1131=>
                9,
                1132=>
                7,
                1134=>
                15,
                1135=>
                15,
                1136=>
                15,
                1137=>
                15,
                1138=>
                11,
                1139=>
                11,
                1140=>
                11,
                1141=>
                11,
                1142=>
                11,
                1143=>
                11,
                1144=>
                11,
                1145=>
                11,
                1146=>
                11,
                1147=>
                11,
                1148=>
                11,
                1149=>
                11,
                1150=>
                11,
                1151=>
                11,
                1152=>
                11,
                1153=>
                11,
                1154=>
                11,
                1155=>
                11,
                1156=>
                11,
                1157=>
                11,
                1158=>
                11,
                1159=>
                15,
                1160=>
                9,
                1161=>
                11,
                1162=>
                15,
                1163=>
                15,
                1164=>
                15,
                1165=>
                15,
                1166=>
                15,
                1167=>
                15,
                1168=>
                15,
                1169=>
                11,
                1170=>
                15,
                1171=>
                11,
                1172=>
                11,
                1173=>
                15,
                1174=>
                15,
                1175=>
                11,
                1176=>
                11,
                1179=>
                11,
                1180=>
                11,
                1181=>
                11,
                1182=>
                11,
                1183=>
                11,
                1184=>
                11,
                1185=>
                11,
                1186=>
                11,
                1187=>
                11,
                1188=>
                11,
                1189=>
                11,
                1190=>
                11,
                1191=>
                11,
                1192=>
                11,
                1193=>
                11,
                1194=>
                11,
                1195=>
                11,
                1196=>
                11,
                1197=>
                11,
                1198=>
                11,
                1199=>
                11,
                1201=>
                11,
                1202=>
                11,
                1203=>
                11,
                1204=>
                11,
                1205=>
                11,
                1206=>
                11,
                1207=>
                11,
                1208=>
                11,
                1209=>
                11,
                1210=>
                11,
                1213=>
                11,
                1214=>
                11,
                1215=>
                11,
                1218=>
                11,
                1219=>
                11,
                1220=>
                11,
                1221=>
                11,
                1222=>
                11,
                1230=>
                11,
                1231=>
                11,
                1232=>
                11,
                1233=>
                11,
                1234=>
                11,
                1235=>
                11,
                1236=>
                11,
                1239=>
                11,
                1241=>
                11,
                1242=>
                11,
                1245=>
                11,
                1247=>
                11,
                1250=>
                11,
                1251=>
                15,
                1252=>
                4,
                1253=>
                11,
                1260=>
                11,
                1262=>
                15,
                1263=>
                11,
                2398=>
                11,
                2400=>
                15,
                2401=>
                15,
                2402=>
                15,
                2407=>
                15,
                2412=>
                15,
                2413=>
                15,
                2418=>
                15,
                2421=>
                15,
                2422=>
                15,
                2423=>
                11,
                2424=>
                8,
                2425=>
                8,
                2426=>
                15,
                2427=>
                15,
                2428=>
                11,
                2429=>
                15,
                2430=>
                11,
                2431=>
                11,
                2434=>
                8,
                2435=>
                11,
                2436=>
                11,
                2437=>
                11,
                2438=>
                11,
                2439=>
                11,
                2440=>
                11,
                2441=>
                11,
                2443=>
                11,
                2444=>
                8,
                2447=>
                15,
                2449=>
                11,
                2450=>
                15,
                2452=>
                11,
                2456=>
                15,
                2458=>
                15,
                2459=>
                15,
                2461=>
                11,
                2462=>
                11,
                2464=>
                15,
                2468=>
                15,
                2469=>
                15,
                2471=>
                15,
                2474=>
                11,
                2476=>
                8,
                2478=>
                8,
                2479=>
                8,
                2480=>
                8,
                2481=>
                8,
                2482=>
                11,
                2488=>
                8,
                2489=>
                8,
                2491=>
                8,
                2492=>
                8,
                2493=>
                8,
                2494=>
                15,
                2495=>
                15,
                2496=>
                15,
                2501=>
                11,
                2502=>
                15,
                2503=>
                15,
                2504=>
                11,
                2505=>
                11,
                2584=>
                11,
                2586=>
                11,
                2591=>
                15,
                2626=>
                8,
                2629=>
                8,
                2634=>
                15,
                2635=>
                15,
                2636=>
                15,
                2637=>
                15,
                2638=>
                15,
                2639=>
                15,
                2640=>
                15,
                2642=>
                15,
                2643=>
                15,
                2644=>
                15,
                2645=>
                11,
                2646=>
                11,
                2647=>
                11,
                2648=>
                11,
                2649=>
                11,
                2650=>
                11,
                2651=>
                11,
                2652=>
                11,
                2653=>
                11,
                2654=>
                11,
                2655=>
                11,
                2656=>
                11,
                2657=>
                15,
                2658=>
                15,
                2659=>
                11,
                2660=>
                11,
                2661=>
                11,
                2662=>
                15,
                2663=>
                15,
                2664=>
                15,
                2665=>
                15,
                2666=>
                8,
                2667=>
                8,
                2668=>
                8,
                2669=>
                8,
                2670=>
                8,
                2671=>
                8,
                2672=>
                15,
                2673=>
                7,
                2674=>
                15,
                2675=>
                11,
                2677=>
                15,
                2678=>
                11,
                2679=>
                11,
                2680=>
                11,
                2681=>
                11,
                2682=>
                11,
                2683=>
                11,
                2684=>
                11,
                2685=>
                11,
                2686=>
                11,
                2687=>
                11,
                2688=>
                11,
                2689=>
                11,
                2690=>
                11,
                2691=>
                11,
                2692=>
                11,
                2693=>
                11,
                2695=>
                8,
                2696=>
                8,
                2697=>
                8,
                2698=>
                8,
                2699=>
                8,
                2700=>
                8,
                2701=>
                15,
                2702=>
                15,
                2703=>
                15,
                2704=>
                15,
                2705=>
                15,
                2706=>
                11,
                2707=>
                11,
                2708=>
                11,
                2709=>
                11,
                2710=>
                11,
                2711=>
                15,
                2712=>
                15,
                2713=>
                11,
                2714=>
                11,
                2715=>
                8,
                2716=>
                11,
                2718=>
                15,
                2719=>
                15,
                2720=>
                4,
                2721=>
                11,
                2722=>
                15,
                2727=>
                11,
                2728=>
                11,
                2729=>
                11,
                2730=>
                11,
                2731=>
                4,
                2732=>
                15,
                2733=>
                4,
                2734=>
                4,
                2735=>
                4,
                2736=>
                15,
                2737=>
                15,
                2738=>
                15,
                2739=>
                15,
                2742=>
                15,
                2743=>
                15,
                2744=>
                11,
                2745=>
                15,
                2746=>
                4,
                2747=>
                8,
                2748=>
                15,
                2750=>
                11,
                2751=>
                8,
                2752=>
                15,
                2753=>
                15,
                2754=>
                8,
                2755=>
                15,
                2756=>
                11,
                2757=>
                11,
                2758=>
                11,
                2759=>
                15,
                2760=>
                11,
                2761=>
                11,
                2762=>
                15,
                2763=>
                4,
                2765=>
                15,
                2766=>
                15,
                2767=>
                15,
                2768=>
                8,
                2769=>
                15,
                2770=>
                8,
                2771=>
                8,
                2773=>
                11,
                2774=>
                15,
                2775=>
                15,
                2776=>
                11,
                2778=>
                11,
                2779=>
                15,
                2780=>
                15,
                2781=>
                15,
                2782=>
                15,
                2783=>
                11,
                2784=>
                8,
                2785=>
                8,
                2786=>
                11,
                2787=>
                15,
                2789=>
                15,
                2790=>
                15,
                2791=>
                15,
                2792=>
                11,
                2796=>
                11,
                2797=>
                15,
                2798=>
                11,
                2799=>
                11,
                2800=>
                15,
                2801=>
                11,
                2802=>
                15,
                2803=>
                8,
                2804=>
                11,
                2805=>
                15,
                2806=>
                11,
                2807=>
                15,
                2808=>
                11,
                2809=>
                11,
                2810=>
                15,
                2811=>
                15,
                2812=>
                15,
                2813=>
                11,
                2814=>
                15,
                2817=>
                8,
                2819=>
                11,
                2820=>
                8,
                2821=>
                15,
                2822=>
                15,
                2823=>
                8,
                2825=>
                15,
                2826=>
                8,
                2827=>
                8,
                2828=>
                11,
                2829=>
                15,
                2830=>
                8,
                2831=>
                15,
                2832=>
                15,
                2833=>
                15,
                2834=>
                15,
                2835=>
                15,
                2836=>
                11,
                2837=>
                8,
                2838=>
                11,
                2839=>
                11,
                2840=>
                15,
                2841=>
                11,
                2842=>
                4,
                2843=>
                8,
                2844=>
                8,
                2845=>
                15,
                2846=>
                15,
                2847=>
                15,
                2848=>
                15,
                2849=>
                11,
                2850=>
                15,
                2851=>
                15,
                2852=>
                15,
                2854=>
                11,
                2855=>
                8,
                2856=>
                8,
                2857=>
                15,
                2858=>
                11,
                2859=>
                15,
                2860=>
                15,
                2861=>
                15,
                2865=>
                9,
                2867=>
                15,
                2868=>
                15,
                2869=>
                15,
                2870=>
                15,
                2871=>
                15,
                2872=>
                15,
                2873=>
                15,
                2874=>
                15,
                2875=>
                15,
                2876=>
                15,
                2878=>
                11,
                2879=>
                15,
                2880=>
                15,
                2881=>
                15,
                2883=>
                15,
                2884=>
                15,
                2885=>
                15,
                2886=>
                8,
                2887=>
                11,
                2888=>
                15,
                2890=>
                11,
                2891=>
                11,
                2892=>
                11,
                2893=>
                15,
                2894=>
                15,
                2895=>
                4,
                2896=>
                15,
                2899=>
                15,
                2900=>
                15,
                2901=>
                15,
                2903=>
                11,
                2904=>
                11,
                2905=>
                11,
                2907=>
                16,
                2908=>
                15,
                2909=>
                11,
                2910=>
                8,
                2911=>
                15,
                2912=>
                8,
                2913=>
                11,
                2914=>
                15,
                2915=>
                15,
                2916=>
                15,
                2917=>
                11,
                2919=>
                11,
                2920=>
                15,
                2921=>
                15,
                2922=>
                15,
                2923=>
                11,
                2924=>
                11,
                2925=>
                15,
                2926=>
                8,
                2927=>
                8,
                2928=>
                8,
                2929=>
                8,
                2930=>
                11,
                2931=>
                11,
                2932=>
                15,
                2933=>
                4,
                2934=>
                11,
                2935=>
                8,
                2936=>
                11,
                2937=>
                11,
                2938=>
                11,
                2941=>
                15,
                2942=>
                15,
                2944=>
                11,
                2945=>
                15,
                2946=>
                11,
                2947=>
                11,
                2948=>
                11,
                2949=>
                11,
                2950=>
                15,
                2951=>
                11,
                2952=>
                15,
                2953=>
                15,
                2954=>
                8,
                2955=>
                11,
                2956=>
                15,
                2957=>
                11,
                2958=>
                15,
                2959=>
                15,
                2962=>
                11,
                2963=>
                11,
                2964=>
                11,
                2965=>
                8,
                2966=>
                11,
                2967=>
                15,
                2968=>
                11,
                2969=>
                11,
                2970=>
                8,
                2971=>
                8,
                2972=>
                11,
                2973=>
                8,
                2974=>
                15,
                2975=>
                15,
                2976=>
                11,
                2977=>
                8,
                2978=>
                11,
                2979=>
                15,
                2980=>
                15,
                2981=>
                15,
                2982=>
                11,
                2983=>
                15,
                2984=>
                15,
                2985=>
                15,
                2986=>
                11,
                2987=>
                11,
                2988=>
                15,
                2989=>
                15,
                2990=>
                8,
                2991=>
                15,
                2992=>
                11,
                2993=>
                11,
                2994=>
                11,
                2996=>
                11,
                2997=>
                8,
                2998=>
                8,
                2999=>
                8,
                3000=>
                8,
                3001=>
                8,
                3002=>
                8,
                3003=>
                15,
                3004=>
                11,
                3005=>
                8,
                3006=>
                15,
                3007=>
                11,
                3008=>
                11,
                3009=>
                15,
                3010=>
                8,
                3011=>
                8,
                3012=>
                8,
                3013=>
                8,
                3014=>
                8,
                3015=>
                8,
                3016=>
                15,
                3017=>
                15,
                3019=>
                15,
                3020=>
                15,
                3021=>
                8,
                3022=>
                8,
                3023=>
                8,
                3024=>
                8,
                3025=>
                11,
                3026=>
                11,
                3027=>
                11,
                3028=>
                11,
                3029=>
                11,
                3030=>
                11,
                3031=>
                11,
                3032=>
                11,
                3033=>
                11,
                3034=>
                11,
                3037=>
                8,
                3038=>
                11,
                3039=>
                11,
                3040=>
                11,
                3041=>
                8,
                3042=>
                15,
                3043=>
                15,
                3044=>
                15,
                3045=>
                15,
                3046=>
                15,
                3047=>
                8,
                3048=>
                15,
                3049=>
                8,
                3050=>
                8,
                3051=>
                8,
                3052=>
                8,
                3053=>
                11,
                3054=>
                11,
                3055=>
                11,
                3056=>
                11,
                3057=>
                11,
                3058=>
                4,
                3059=>
                8,
                3060=>
                11,
                3061=>
                15,
                3063=>
                15,
                3064=>
                15,
                3065=>
                11,
                3066=>
                11,
                3067=>
                11,
                3068=>
                15,
                3069=>
                15,
                3070=>
                15,
                3071=>
                11,
                3072=>
                11,
                3073=>
                11,
                3074=>
                11,
                3079=>
                11,
                3080=>
                15,
                3081=>
                11,
                3082=>
                11,
                3083=>
                15,
                3084=>
                15,
                3085=>
                11,
                3086=>
                11,
                3087=>
                15,
                3088=>
                15,
                3089=>
                15,
                3091=>
                11,
                3092=>
                15,
                3094=>
                11,
                3095=>
                11,
                3097=>
                11,
                3098=>
                11,
                3099=>
                14,
                3100=>
                15,
                3101=>
                15,
                3102=>
                8,
                3103=>
                8,
                3104=>
                8,
                3105=>
                8,
                3106=>
                8,
                3107=>
                8,
                3108=>
                15,
                3109=>
                15,
                3110=>
                15,
                3111=>
                11,
                3112=>
                11,
                3113=>
                15,
                3114=>
                15,
                3115=>
                11,
                3116=>
                15,
                3117=>
                11,
                3118=>
                15,
                3119=>
                11,
                3120=>
                11,
                3121=>
                8,
                3122=>
                8,
                3123=>
                8,
                3124=>
                8,
                3125=>
                15,
                3126=>
                15,
                3129=>
                15,
                3130=>
                8,
                3131=>
                8,
                3132=>
                8,
                3133=>
                11,
                3135=>
                7,
                3136=>
                15,
                3137=>
                15,
                3138=>
                11,
                3139=>
                8,
                3140=>
                15,
                3141=>
                15,
                3142=>
                8,
                3143=>
                15,
                3144=>
                15,
                3145=>
                11,
                3146=>
                8,
                3147=>
                15,
                3148=>
                8,
                3149=>
                11,
                3150=>
                15,
                3151=>
                15,
                3152=>
                15,
                3153=>
                11,
                3154=>
                8,
                3155=>
                15,
                3156=>
                11,
                3157=>
                15,
                3158=>
                11,
                3159=>
                8,
                3160=>
                15,
                3161=>
                8,
                3162=>
                8,
                3164=>
                11,
                3165=>
                15,
                3166=>
                15,
                3167=>
                15,
                3168=>
                15,
                3169=>
                11,
                3171=>
                8,
                3172=>
                15,
                3173=>
                15,
                3174=>
                15,
                3175=>
                15,
                3176=>
                15,
                3177=>
                4,
                3178=>
                4,
                3179=>
                4,
                3181=>
                15,
                3182=>
                15,
                3183=>
                15,
                3184=>
                15,
                3185=>
                15,
                3187=>
                11,
                3188=>
                11,
                3189=>
                11,
                3190=>
                11,
                3191=>
                15,
                3192=>
                15,
                3193=>
                11,
                3194=>
                11,
                3195=>
                15,
                3196=>
                11,
                3197=>
                11,
                3198=>
                11,
                3199=>
                11,
                3202=>
                11,
                3203=>
                8,
                3205=>
                15,
                3206=>
                15,
                3207=>
                15,
                3208=>
                15,
                3209=>
                15,
                3210=>
                15,
                3212=>
                11,
                3213=>
                11,
                3214=>
                8,
                3215=>
                13,
                3216=>
                13,
                3217=>
                8,
                3218=>
                11,
                3219=>
                8,
                3221=>
                11,
                3222=>
                11,
                3223=>
                11,
                3224=>
                15,
                3225=>
                15,
                3226=>
                11,
                3227=>
                11,
                3228=>
                11,
                3229=>
                11,
                3230=>
                11,
                3231=>
                11,
                3233=>
                11,
                3234=>
                11,
                3235=>
                11,
                3236=>
                11,
                3237=>
                8,
                3238=>
                15,
                3239=>
                11,
                3240=>
                6,
                3242=>
                15,
                3243=>
                8,
                3244=>
                11,
                3245=>
                8,
                3246=>
                11,
                3247=>
                15,
                3248=>
                15,
                3249=>
                15,
                3251=>
                8,
                3252=>
                11,
                3254=>
                11,
                3255=>
                15,
                3256=>
                15,
                3258=>
                11,
                3259=>
                11,
                3260=>
                15,
                3261=>
                11,
                3262=>
                11,
                3263=>
                11,
                3264=>
                11,
                3265=>
                8,
                3266=>
                15,
                3267=>
                8,
                3268=>
                8,
                3269=>
                15,
                3270=>
                11,
                3271=>
                11,
                3272=>
                15,
                3274=>
                15,
                3275=>
                11,
                3276=>
                15,
                3277=>
                15,
                3279=>
                11,
                3280=>
                15,
                3281=>
                15,
                3282=>
                15,
                3283=>
                15,
                3284=>
                15,
                3285=>
                11,
                3287=>
                15,
                3288=>
                15,
                3289=>
                15,
                3290=>
                11,
                3292=>
                11,
                3293=>
                11,
                3294=>
                15,
                3295=>
                15,
                3296=>
                4,
                3297=>
                11,
                3299=>
                11,
                3300=>
                11,
                3302=>
                11,
                3303=>
                15,
                3305=>
                4,
                3306=>
                11,
                3307=>
                15,
                3309=>
                15,
                3310=>
                15,
                3312=>
                15,
                3313=>
                15,
                3314=>
                15,
                3316=>
                15,
                3317=>
                15,
                3318=>
                15,
                3319=>
                15,
                3320=>
                15,
                3321=>
                15,
                3322=>
                15,
                3323=>
                15,
                3324=>
                15,
                3325=>
                8,
                3326=>
                8,
                3327=>
                8,
                3328=>
                15,
                3330=>
                8,
                3331=>
                11,
                3332=>
                15,
                3333=>
                15,
                3334=>
                15,
                3335=>
                15,
                3336=>
                11,
                3337=>
                11,
                3338=>
                11,
                3339=>
                8,
                3340=>
                8,
                3341=>
                15,
                3342=>
                15,
                3343=>
                15,
                3344=>
                15,
                3345=>
                15,
                3346=>
                11,
                3347=>
                11,
                3348=>
                11,
                3349=>
                11,
                3350=>
                11,
                3351=>
                15,
                3353=>
                4,
                3356=>
                11,
                3358=>
                11,
                3359=>
                11,
                3360=>
                4,
                3361=>
                15,
                3362=>
                11,
                3363=>
                15,
                3364=>
                15,
                3365=>
                15,
                3367=>
                8,
                3368=>
                8,
                3369=>
                15,
                3370=>
                15,
                3371=>
                15,
                3372=>
                15,
                3373=>
                15,
                3374=>
                11,
                3375=>
                15,
                3376=>
                15,
                3377=>
                15,
                3378=>
                11,
                3379=>
                11,
                3380=>
                15,
                3381=>
                11,
                3382=>
                11,
                3383=>
                15,
                3384=>
                15,
                3386=>
                15,
                3387=>
                11,
                3388=>
                3,
                3389=>
                9,
                3390=>
                8,
                3391=>
                15,
                3392=>
                15,
                3393=>
                11,
                3394=>
                8,
                3395=>
                15,
                3396=>
                15,
                3397=>
                15,
                3398=>
                15,
                3399=>
                11,
                3401=>
                15,
                3402=>
                4,
                3403=>
                15,
                3404=>
                15,
                3405=>
                15,
                3406=>
                15,
                3407=>
                15,
                3410=>
                4,
                3411=>
                15,
                3415=>
                15,
                3416=>
                15,
                3417=>
                11,
                3418=>
                11,
                3419=>
                11,
                3420=>
                11,
                3421=>
                15,
                3422=>
                15,
                3423=>
                8,
                3424=>
                8,
                3425=>
                8,
                3426=>
                8,
                3427=>
                8,
                3428=>
                8,
                3429=>
                8,
                3430=>
                8,
                3431=>
                8,
                3432=>
                8,
                3433=>
                8,
                3434=>
                8,
                3435=>
                8,
                3436=>
                8,
                3437=>
                8,
                3438=>
                8,
                3439=>
                8,
                3440=>
                8,
                3441=>
                8,
                3442=>
                8,
                3443=>
                8,
                3444=>
                8,
                3445=>
                8,
                3446=>
                8,
                3447=>
                8,
                3448=>
                8,
                3449=>
                8,
                3450=>
                8,
                3452=>
                15,
                3453=>
                15,
                3454=>
                15,
                3455=>
                15,
                3456=>
                15,
                3457=>
                15,
                3459=>
                15,
                3460=>
                15,
                3461=>
                15,
                3462=>
                15,
                3463=>
                15,
                3464=>
                15,
                3465=>
                15,
                3466=>
                15,
                3467=>
                11,
                3468=>
                15,
                3469=>
                11,
                3470=>
                11,
                3471=>
                15,
                3472=>
                15,
                3473=>
                15,
                3475=>
                15,
                3476=>
                11,
                3477=>
                15,
                3478=>
                15,
                3479=>
                11,
                3480=>
                8,
                3481=>
                15,
                3482=>
                15,
                3483=>
                15,
                3484=>
                11,
                3485=>
                11,
                3486=>
                11,
                3488=>
                15,
                3489=>
                11,
                3490=>
                15,
                3491=>
                11,
                3492=>
                11,
                3493=>
                11,
                3494=>
                15,
                3495=>
                15,
                3496=>
                11,
                3497=>
                11,
                3498=>
                8,
                3500=>
                11,
                3501=>
                11,
                3502=>
                11,
                3503=>
                11,
                3510=>
                15,
                3511=>
                15,
                3512=>
                11,
                3514=>
                15,
                3515=>
                11,
                3516=>
                8,
                3517=>
                15,
                3518=>
                11,
                3519=>
                8,
                3520=>
                8,
                3521=>
                8,
                3522=>
                5,
                3524=>
                15,
                3525=>
                15,
                3526=>
                11,
                3527=>
                11,
                3528=>
                11,
                3529=>
                11,
                3530=>
                11,
                3531=>
                8,
                3532=>
                15,
                3533=>
                15,
                3534=>
                15,
                3535=>
                11,
                3536=>
                15,
                3537=>
                15,
                3538=>
                11,
                3539=>
                11,
                3540=>
                11,
                3541=>
                11,
                3542=>
                11,
                3543=>
                11,
                3544=>
                8,
                3545=>
                8,
                3546=>
                15,
                3547=>
                15,
                3548=>
                4,
                3550=>
                8,
                3551=>
                15,
                3552=>
                15,
                3553=>
                11,
                3554=>
                11,
                3555=>
                11,
                3556=>
                8,
                3557=>
                8,
                3558=>
                15,
                3559=>
                15,
                3560=>
                11,
                3561=>
                11,
                3562=>
                8,
                3564=>
                8,
                3566=>
                15,
                3567=>
                15,
                3568=>
                11,
                3569=>
                8,
                3570=>
                8,
                3571=>
                8,
                3572=>
                8,
                3573=>
                15,
                3574=>
                11,
                3575=>
                11,
                3576=>
                15,
                3577=>
                11,
                3578=>
                15,
                3579=>
                8,
                3580=>
                8,
                3581=>
                4,
                3582=>
                4,
                3583=>
                15,
                3584=>
                15,
                3585=>
                15,
                3586=>
                15,
                3587=>
                15,
                3588=>
                11,
                3589=>
                11,
                3590=>
                11,
                3591=>
                15,
                3592=>
                8,
                3593=>
                15,
                3594=>
                11,
                3595=>
                15,
                3596=>
                11,
                3597=>
                11,
                3598=>
                8,
                3599=>
                8,
                3600=>
                11,
                3601=>
                15,
                3602=>
                11,
                3603=>
                15,
                3604=>
                15,
                3605=>
                15,
                3606=>
                15,
                3607=>
                11,
                3608=>
                11,
                3609=>
                8,
                3610=>
                15,
                3611=>
                15,
                3612=>
                15,
                3614=>
                11,
                3615=>
                8,
                3616=>
                8,
                3617=>
                15,
                3618=>
                11,
                3619=>
                15,
                3620=>
                15,
                3621=>
                15,
                3622=>
                5,
                3624=>
                15,
                3625=>
                15,
                3626=>
                8,
                3627=>
                15,
                3628=>
                15,
                3629=>
                15,
                3630=>
                15,
                3631=>
                15,
                3632=>
                15,
                3633=>
                8,
                3634=>
                8,
                3635=>
                8,
                3636=>
                8,
                3637=>
                8,
                3638=>
                8,
                3639=>
                8,
                3640=>
                8,
                3641=>
                8,
                3642=>
                8,
                3643=>
                8,
                3644=>
                8,
                3645=>
                8,
                3646=>
                15,
                3647=>
                8,
                3648=>
                11,
                3649=>
                11,
                3650=>
                8,
                3651=>
                11,
                3652=>
                11,
                3653=>
                15,
                3654=>
                8,
                3655=>
                11,
                3656=>
                11,
                3657=>
                15,
                3658=>
                15,
                3659=>
                15,
                3660=>
                15,
                3661=>
                15,
                3662=>
                15,
                3663=>
                15,
                3664=>
                15,
                3665=>
                15,
                3666=>
                15,
                3667=>
                15,
                3668=>
                15,
                3669=>
                15,
                3670=>
                15,
                3671=>
                15,
                3672=>
                15,
                3673=>
                15,
                3674=>
                15,
                3675=>
                15,
                3676=>
                15,
                3677=>
                15,
                3678=>
                15,
                3679=>
                15,
                3680=>
                15,
                3681=>
                15,
                3682=>
                15,
                3683=>
                15,
                3684=>
                15,
                3685=>
                15,
                3686=>
                15,
                3687=>
                15,
                3688=>
                11,
                3689=>
                11,
                3690=>
                11,
                3691=>
                11,
                3692=>
                11,
                3693=>
                15,
                3694=>
                15,
                3695=>
                15,
                3696=>
                15,
                3697=>
                15,
                3698=>
                15,
                3699=>
                15,
                3700=>
                15,
                3701=>
                15,
                3702=>
                15,
                3703=>
                11,
                3704=>
                11,
                3705=>
                11,
                3706=>
                11,
                3707=>
                15,
                3708=>
                15,
                3709=>
                11,
                3710=>
                11,
                3711=>
                11,
                3712=>
                11,
                3713=>
                11,
                3714=>
                15,
                3715=>
                4,
                3716=>
                11,
                3717=>
                15,
                3718=>
                8,
                3719=>
                8,
                3720=>
                8,
                3721=>
                8,
                3722=>
                8,
                3723=>
                8,
                3724=>
                8,
                3725=>
                8,
                3726=>
                15,
                3727=>
                15,
                3728=>
                15,
                3729=>
                11,
                3730=>
                15,
                3731=>
                11,
                3732=>
                11,
                3733=>
                11,
                3734=>
                11,
                3735=>
                15,
                3736=>
                15,
                3737=>
                15,
                3738=>
                15,
                3739=>
                15,
                3740=>
                15,
                3741=>
                11,
                3742=>
                11,
                3743=>
                11,
                3744=>
                11,
                3745=>
                15,
                3746=>
                4,
                3747=>
                15,
                3748=>
                15,
                3749=>
                11,
                3750=>
                11,
                3751=>
                15,
                3752=>
                11,
                3753=>
                11,
                3754=>
                15,
                3755=>
                11,
                3756=>
                11,
                3757=>
                11,
                3758=>
                11,
                3759=>
                15,
                3760=>
                15,
                3761=>
                11,
                3762=>
                15,
                3763=>
                11,
                3764=>
                11,
                3765=>
                8,
                3768=>
                15,
                3769=>
                15,
                3770=>
                11,
                3771=>
                11,
                3772=>
                15,
                3773=>
                15,
                3774=>
                9,
                3775=>
                9,
                3776=>
                9,
                3777=>
                9,
                3778=>
                9,
                3779=>
                9,
                3780=>
                9,
                3781=>
                9,
                3782=>
                9,
                3783=>
                9,
                3784=>
                9,
                3785=>
                9,
                3786=>
                9,
                3787=>
                9,
                3788=>
                15,
                3789=>
                15,
                3790=>
                15,
                3791=>
                15,
                3792=>
                8,
                3793=>
                8,
                3794=>
                15,
                3795=>
                15,
                3796=>
                15,
                3797=>
                15,
                3798=>
                NULL,
                3799=>
                15,
                3800=>
                8,
                3801=>
                8,
                3802=>
                8,
                3803=>
                15,
                3804=>
                11,
                3805=>
                15,
                3806=>
                15,
                3807=>
                4,
                3808=>
                8,
                3809=>
                15,
                3810=>
                15,
                3811=>
                8,
                3812=>
                8,
                3813=>
                8,
                3814=>
                15,
                3815=>
                15,
                3816=>
                8,
                3817=>
                15,
                3818=>
                8,
                3819=>
                15,
                3820=>
                NULL,
                3821=>
                NULL,
                3822=>
                15,
                3823=>
                15,
                3824=>
                15,
                3825=>
                15,
                3826=>
                15,
                3827=>
                8,
                3828=>
                8,
                3829=>
                8,
                3830=>
                8,
                3831=>
                15,
                3832=>
                15,
                3834=>
                8,
                3835=>
                NULL,
                3836=>
                15,
                3837=>
                NULL,
                3838=>
                15,
                3839=>
                15,
                3840=>
                15,
                3841=>
                15,
                3842=>
                15,
                3843=>
                15,
                3844=>
                15,
                3845=>
                15,
                3846=>
                8,
                3847=>
                15,
                3848=>
                15,
                3849=>
                15,
                3850=>
                15,
                3851=>
                15,
                3852=>
                15,
                3853=>
                15,
                3854=>
                15,
                3855=>
                15,
                3856=>
                15,
                3857=>
                15,
                3858=>
                15,
                3859=>
                15,
                3860=>
                15,
                3861=>
                15,
                3862=>
                15,
                3863=>
                15,
                3864=>
                15,
                3865=>
                15,
                3866=>
                15,
                3867=>
                4,
                3868=>
                4,
                3869=>
                15,
                3870=>
                15,
                3871=>
                15,
                3872=>
                15,
                3873=>
                15,
                3874=>
                4,
                3875=>
                4,
                3876=>
                4,
                3877=>
                4,
                3878=>
                4,
                3879=>
                4,
                3880=>
                4,
                3881=>
                4,
                3882=>
                15,
                3883=>
                4,
                3884=>
                10,
                3885=>
                4,
                3886=>
                4,
                3887=>
                10,
                3888=>
                4,
                3889=>
                15,
                3890=>
                4,
                3891=>
                4,
                3892=>
                15,
                3893=>
                15,
                3894=>
                15,
                3895=>
                15,
                3896=>
                15,
                3897=>
                15,
                3898=>
                15,
                3899=>
                15,
                3900=>
                15,
                3901=>
                15,
                3902=>
                15,
                3903=>
                15,
                3904=>
                15,
                3905=>
                11,
                3906=>
                11,
                3907=>
                11,
                3908=>
                11,
                3909=>
                11,
                3910=>
                11,
                3911=>
                11,
                3912=>
                11,
                3913=>
                11,
                3914=>
                11,
                3915=>
                11,
                3916=>
                11,
                3917=>
                11,
                3918=>
                11,
                3919=>
                11,
                3920=>
                11,
                3921=>
                11,
                3922=>
                11,
                3923=>
                11,
                3924=>
                11,
                3925=>
                11,
                3926=>
                11,
                3927=>
                11,
                3928=>
                11,
                3929=>
                11,
                3930=>
                11,
                3931=>
                15,
                3932=>
                15,
                3933=>
                NULL,
                3934=>
                NULL,
                3935=>
                15,
                3936=>
                15,
                3937=>
                15,
                3938=>
                15,
                3939=>
                7,
                3940=>
                11,
                3941=>
                7,
                3942=>
                7,
                3943=>
                7,
                3944=>
                7,
                3945=>
                7,
                3946=>
                7,
                3947=>
                7,
                3948=>
                7,
                3949=>
                7,
                3950=>
                7,
                3951=>
                7,
                3952=>
                7,
                3954=>
                7,
                3955=>
                7,
                3956=>
                7,
                3957=>
                7,
                3958=>
                7,
                3959=>
                7,
                3960=>
                7,
                3961=>
                7,
                3962=>
                7,
                3963=>
                7,
                3964=>
                7,
                3965=>
                7,
                3966=>
                7,
                3967=>
                7,
                3968=>
                15,
                3969=>
                15,
                3970=>
                15,
                3971=>
                15,
                3972=>
                15,
                3973=>
                15,
                3974=>
                15,
                3975=>
                15,
                3976=>
                15,
                3977=>
                15,
                3978=>
                15,
                3979=>
                15,
                3980=>
                15,
                3981=>
                15,
                3982=>
                15,
                3983=>
                15,
                3984=>
                15,
                3985=>
                10,
                3986=>
                10,
                3987=>
                10,
                3988=>
                15,
                3990=>
                15,
                3991=>
                15,
                3992=>
                15,
                3993=>
                11,
                3994=>
                11,
                3995=>
                11,
                3996=>
                11,
                3997=>
                11,
                3998=>
                11,
                3999=>
                11,
                4000=>
                15,
                4001=>
                11,
                4002=>
                4,
                4003=>
                4,
                4004=>
                4,
                4005=>
                15,
                4006=>
                11,
                4007=>
                15,
                4008=>
                7,
                4009=>
                11,
                4010=>
                11,
                4011=>
                11,
                4012=>
                15,
                4013=>
                15,
                4014=>
                11,
                4015=>
                11,
                4016=>
                15,
                4017=>
                15,
                4018=>
                15,
                4019=>
                15,
                4020=>
                15,
                4021=>
                15,
                4022=>
                15,
                4023=>
                15,
                4024=>
                15,
                4025=>
                15,
                4026=>
                15,
                4027=>
                15,
                4030=>
                11,
                4031=>
                11,
                4032=>
                4,
                4033=>
                15,
                4034=>
                15,
                4035=>
                4,
                4036=>
                15,
                4037=>
                10,
                4038=>
                15,
                4039=>
                15,
                4040=>
                15,
                4041=>
                15,
                4042=>
                15,
                4043=>
                15,
                4044=>
                15,
                4045=>
                11,
                4046=>
                11,
                4047=>
                11,
                4048=>
                11,
                4049=>
                4,
                4050=>
                7,
                4051=>
                15,
                4052=>
                15,
                4053=>
                15,
                4054=>
                15,
                4055=>
                15,
                4056=>
                8,
                4057=>
                4,
                4058=>
                7,
                4059=>
                15,
                4060=>
                11,
                4061=>
                15,
                4062=>
                7,
                4063=>
                15,
                4064=>
                15,
                4065=>
                15,
                4066=>
                15,
                4067=>
                11,
                4068=>
                15,
                4069=>
                11,
                4070=>
                15,
                4071=>
                15,
                4072=>
                7,
                4073=>
                8,
                4074=>
                7,
                4075=>
                15,
                4076=>
                11,
                4077=>
                15,
                4078=>
                15,
                4079=>
                15,
                4080=>
                NULL,
                4081=>
                NULL,
                4082=>
                15,
                4083=>
                15,
                4084=>
                15,
                4085=>
                11,
                4086=>
                11,
                4087=>
                15,
                4088=>
                15,
                4089=>
                15,
                4090=>
                15,
                4091=>
                15,
                4092=>
                15,
                4093=>
                15,
                4094=>
                15,
                4095=>
                11,
                4096=>
                11,
                4097=>
                15,
                4098=>
                15,
                4099=>
                7,
                4100=>
                15,
                4101=>
                15,
                4102=>
                15,
                4103=>
                15,
                4104=>
                4,
                4105=>
                11,
                4106=>
                11,
                4107=>
                15,
                4108=>
                15,
                4109=>
                15,
                4110=>
                15,
                4111=>
                15,
                4112=>
                15,
                4113=>
                7,
                4114=>
                15,
                4115=>
                15,
                4116=>
                15,
                4117=>
                15,
                4118=>
                15,
                4119=>
                11,
                4120=>
                15,
                4121=>
                15,
                4122=>
                10,
                4123=>
                10,
                4124=>
                15,
                4125=>
                11,
                4126=>
                15,
                4127=>
                11,
                4128=>
                15,
                4129=>
                4,
                4130=>
                4,
                4131=>
                4,
                4132=>
                4,
                4133=>
                15,
                4134=>
                11,
                4135=>
                11,
                4136=>
                11,
                4137=>
                11,
                4138=>
                11,
                4139=>
                11,
                4140=>
                15,
                4141=>
                7,
                4142=>
                4,
                4143=>
                11,
                4144=>
                15,
                4145=>
                15,
                4146=>
                15,
                4147=>
                NULL,
                4148=>
                8,
                4149=>
                8,
                4150=>
                8,
                4151=>
                8,
                4152=>
                15,
                4153=>
                15,
                4154=>
                15,
                4155=>
                15,
                4156=>
                15,
                4157=>
                15,
                4158=>
                8,
                4159=>
                15,
                4160=>
                15,
                4161=>
                15,
                4162=>
                11,
                4163=>
                11,
                4164=>
                11,
                4165=>
                11,
                4166=>
                4,
                4167=>
                15,
                4168=>
                15,
                4169=>
                4,
                4170=>
                4,
                4171=>
                15,
                4172=>
                15,
                4173=>
                15,
                4174=>
                4,
                4175=>
                15,
                4176=>
                15,
                4177=>
                15,
                4178=>
                15,
                4179=>
                7,
                4180=>
                7,
                4181=>
                11,
                4182=>
                15,
                4183=>
                15,
                4184=>
                15,
                4185=>
                4,
                4186=>
                4,
                4187=>
                7,
                4188=>
                7,
                4189=>
                7,
                4190=>
                4,
                4191=>
                4,
                4192=>
                4,
                4193=>
                4,
                4194=>
                15,
                4195=>
                15,
                4197=>
                11,
                4198=>
                11,
                4199=>
                15,
                4200=>
                15,
                4201=>
                15,
                4202=>
                15,
                4203=>
                15,
                4204=>
                15,
                4205=>
                11,
                4206=>
                11,
                4207=>
                11,
                4208=>
                15,
                4209=>
                15,
                4210=>
                15,
                4211=>
                15,
                4212=>
                15,
                4213=>
                15,
                4214=>
                15,
                4215=>
                15,
                4216=>
                15,
                4217=>
                4,
                4218=>
                4,
                4219=>
                15,
                4220=>
                15,
                4221=>
                11,
                4222=>
                11,
                4223=>
                11,
                4224=>
                11,
                4225=>
                11,
                4226=>
                11,
                4227=>
                11,
                4228=>
                11,
                4229=>
                11,
                4230=>
                11,
                4231=>
                11,
                4232=>
                11,
                4233=>
                11,
                4234=>
                11,
                4235=>
                11,
                4236=>
                11,
                4237=>
                11,
                4238=>
                11,
                4239=>
                11,
                4240=>
                11,
                4241=>
                11,
                4242=>
                4,
                4243=>
                4,
                4244=>
                4,
                4245=>
                4,
                4246=>
                4,
                4247=>
                4,
                4248=>
                4,
                4249=>
                4,
                4250=>
                4,
                4251=>
                4,
                4252=>
                4,
                4253=>
                4,
                4254=>
                11,
                4255=>
                11,
                4256=>
                11,
                4257=>
                11,
                4258=>
                11,
                4259=>
                11,
                4260=>
                11,
                4261=>
                11,
                4262=>
                11,
                4263=>
                11,
                4264=>
                11,
                4265=>
                11,
                4266=>
                11,
                4267=>
                11,
                4268=>
                11,
                4269=>
                11,
                4270=>
                11,
                4271=>
                11,
                4272=>
                11,
                4273=>
                11,
                4274=>
                11,
                4275=>
                11,
                4276=>
                11,
                4277=>
                11,
                4278=>
                11,
                4279=>
                11,
                4280=>
                11,
                4281=>
                15,
                4282=>
                11,
                4283=>
                11,
                4284=>
                11,
                4285=>
                11,
                4286=>
                11,
                4287=>
                11,
                4288=>
                15,
                4289=>
                15,
                4290=>
                15,
                4291=>
                15,
                4293=>
                4,
                4294=>
                15,
                4295=>
                11,
                4296=>
                11,
                4297=>
                11,
                4298=>
                4,
                4299=>
                4,
                4300=>
                4,
                4301=>
                4,
                4302=>
                11,
                4303=>
                15,
                4304=>
                4,
                4305=>
                4,
                4306=>
                4,
                4307=>
                4,
                4308=>
                15,
                4309=>
                8,
                4310=>
                15,
                4311=>
                15,
                4312=>
                15,
                4313=>
                10,
                4317=>
                11,
                4318=>
                11,
                4319=>
                11,
                4320=>
                4,
                4321=>
                11,
                4322=>
                11,
                4323=>
                11,
                4324=>
                11,
                4325=>
                11,
                4326=>
                4,
                4327=>
                4,
                4328=>
                4,
                4329=>
                4,
                4330=>
                4,
                4331=>
                4,
                4332=>
                4,
                4333=>
                15,
                4334=>
                15,
                4335=>
                11,
                4336=>
                11,
                4337=>
                11,
                4338=>
                11,
                4339=>
                11,
                4340=>
                11,
                4341=>
                11,
                4342=>
                11,
                4343=>
                11,
                4344=>
                4,
                4345=>
                4,
                4346=>
                4,
                4347=>
                4,
                4348=>
                4,
                4349=>
                4,
                4350=>
                11,
                4351=>
                15,
                4352=>
                15,
                4353=>
                15,
                4354=>
                15,
                4355=>
                15,
                4356=>
                15,
                4357=>
                11,
                4358=>
                11,
                4359=>
                11,
                4360=>
                11,
                4361=>
                11,
                4362=>
                11,
                4363=>
                11,
                4364=>
                11,
                4365=>
                11,
                4366=>
                11,
                4367=>
                11,
                4368=>
                11,
                4369=>
                11,
                4370=>
                15,
                4371=>
                7,
                4372=>
                15,
                4373=>
                11,
                4374=>
                11,
                4375=>
                11,
                4376=>
                11,
                4377=>
                11,
                4378=>
                15,
                4379=>
                11,
                4380=>
                7,
                4381=>
                15,
                4382=>
                15,
                4383=>
                15,
                4384=>
                15,
                4385=>
                11,
                4386=>
                11,
                4387=>
                15,
                4388=>
                15,
                4389=>
                4,
                4390=>
                15,
                4391=>
                4,
                4392=>
                11,
                4393=>
                15,
                4394=>
                15,
                4395=>
                15,
                4396=>
                15,
                4397=>
                15,
                4398=>
                10,
                4399=>
                10,
                4400=>
                15,
                4401=>
                15,
                4402=>
                11,
                4403=>
                11,
                4404=>
                11,
                4405=>
                11,
                4406=>
                11,
                4407=>
                11,
                4408=>
                11,
                4409=>
                15,
                4410=>
                15,
                4411=>
                11,
                4412=>
                15,
                4413=>
                8,
                4414=>
                8,
                4415=>
                8,
                4416=>
                8,
                4417=>
                8,
                4418=>
                8,
                4419=>
                8,
                4420=>
                8,
                4421=>
                8,
                4422=>
                8,
                4423=>
                8,
                4424=>
                8,
                4425=>
                8,
                4426=>
                8,
                4427=>
                15,
                4428=>
                15,
                4429=>
                15,
                4430=>
                15,
                4431=>
                15,
                4432=>
                15,
                4433=>
                15,
                4434=>
                15,
                4435=>
                15,
                4436=>
                15,
                4437=>
                4,
                4438=>
                4,
                4439=>
                11,
                4440=>
                7,
                4441=>
                10,
                4442=>
                11,
                4443=>
                11,
                4444=>
                15,
                4445=>
                11,
                4446=>
                4,
                4447=>
                4,
                4448=>
                4,
                4449=>
                4,
                4450=>
                15,
                4451=>
                8,
                4452=>
                15,
                4453=>
                15,
                4454=>
                15,
                4455=>
                15,
                4456=>
                15,
                4457=>
                15,
                4458=>
                15,
                4459=>
                11,
                4460=>
                7,
                4461=>
                11,
                4462=>
                15,
                4463=>
                15,
                4464=>
                15,
                4465=>
                15,
                4466=>
                11,
                4467=>
                11,
                4468=>
                11,
                4469=>
                11,
                4470=>
                4,
                4471=>
                11,
                4472=>
                15,
                4473=>
                4,
                4474=>
                4,
                4475=>
                4,
                4476=>
                4,
                4477=>
                4,
                4478=>
                4,
                4479=>
                4,
                4480=>
                4,
                4481=>
                15,
                4482=>
                11,
                4483=>
                15,
                4484=>
                15,
                4485=>
                11,
                4486=>
                15,
                4487=>
                NULL,
                4488=>
                11,
                4490=>
                15,
                4491=>
                15,
                4492=>
                15,
                4493=>
                10,
                4494=>
                11,
                4495=>
                11,
                4496=>
                11,
                4497=>
                15,
                4498=>
                15,
                4499=>
                15,
                4500=>
                11,
                4501=>
                10,
                4502=>
                15,
                4503=>
                15,
                4504=>
                15,
                4505=>
                15,
                4506=>
                15,
                4507=>
                15,
                4508=>
                15,
                4509=>
                15,
                4510=>
                15,
                4511=>
                15,
                4512=>
                15,
                4513=>
                15,
                4514=>
                15,
                4515=>
                15,
                4516=>
                15,
                4517=>
                15,
                4518=>
                15,
                4519=>
                15,
                4520=>
                15,
                4521=>
                15,
                4522=>
                15,
                4523=>
                15,
                4524=>
                15,
                4525=>
                15,
                4526=>
                15,
                4527=>
                15,
                4528=>
                15,
                4529=>
                15,
                4530=>
                15,
                4531=>
                11,
                4532=>
                11,
                4533=>
                11,
                4534=>
                4,
                4535=>
                4,
                4536=>
                15,
                4537=>
                11,
                4538=>
                11,
                4539=>
                7,
                4540=>
                15,
                4541=>
                15,
                4542=>
                7,
                4543=>
                7,
                4544=>
                15,
                4545=>
                11,
                4546=>
                7,
                4547=>
                15,
                4548=>
                15,
                4549=>
                15,
                4550=>
                15,
                4551=>
                11,
                4552=>
                15,
                4553=>
                15,
                4554=>
                15,
                4555=>
                15,
                4556=>
                15,
                4557=>
                15,
                4558=>
                15,
                4559=>
                15,
                4560=>
                15,
                4561=>
                15,
                4562=>
                15,
                4563=>
                15,
                4564=>
                15,
                4565=>
                15,
                4566=>
                15,
                4567=>
                15,
                4568=>
                15,
                4569=>
                15,
                4570=>
                15,
                4571=>
                15,
                4572=>
                7,
                4573=>
                4,
                4574=>
                11,
                4575=>
                15,
                4576=>
                15,
                4577=>
                15,
                4578=>
                15,
                4579=>
                4,
                4580=>
                15,
                4581=>
                15,
                4582=>
                15,
                4583=>
                15,
                4584=>
                11,
                4585=>
                7,
                4586=>
                15,
                4587=>
                15,
                4588=>
                15,
                4589=>
                15,
                4590=>
                15,
                4591=>
                15,
                4592=>
                15,
                4594=>
                7,
                4595=>
                15,
                4596=>
                15,
                4597=>
                15,
                4598=>
                15,
                4599=>
                15,
                4600=>
                15,
                4601=>
                15,
                4602=>
                15,
                4603=>
                NULL,
                4604=>
                15,
                4605=>
                15,
                4606=>
                15,
                4607=>
                15,
                4608=>
                15,
                4609=>
                15,
                4610=>
                4,
                4611=>
                4,
                4612=>
                4,
                4613=>
                4,
                4614=>
                8,
                4615=>
                7,
                4616=>
                11,
                4617=>
                4,
                4618=>
                15,
                4619=>
                15,
                4620=>
                4,
                4621=>
                4,
                4622=>
                15,
                4623=>
                4,
                4624=>
                15,
                4625=>
                15,
                4626=>
                11,
                4627=>
                11,
                4628=>
                8,
                4629=>
                11,
                4630=>
                11,
                4631=>
                15,
                4632=>
                15,
                4633=>
                15,
                4634=>
                15,
                4635=>
                15,
                4636=>
                15,
                4637=>
                15,
                4638=>
                15,
                4639=>
                15,
                4640=>
                15,
                4641=>
                11,
                4642=>
                11,
                4643=>
                11,
                4644=>
                11,
                4645=>
                11,
                4646=>
                8,
                4647=>
                15,
                4648=>
                15,
                4649=>
                11,
                4650=>
                11,
                4651=>
                11,
                4652=>
                15,
                4653=>
                15,
                4654=>
                15,
                4655=>
                15,
                4656=>
                15,
                4657=>
                15,
                4658=>
                15,
                4659=>
                7,
                4660=>
                11,
                4661=>
                11,
                4662=>
                7,
                4663=>
                7,
                4664=>
                7,
                4665=>
                11,
                4667=>
                15,
                4668=>
                7,
                4669=>
                15,
                4671=>
                11,
                4672=>
                11,
                4673=>
                11,
                4674=>
                11,
                4675=>
                11,
                4676=>
                11,
                4677=>
                11,
                4678=>
                15,
                4679=>
                11,
                4680=>
                15,
                4681=>
                15,
                4682=>
                15,
                4683=>
                15,
                4684=>
                15,
                4685=>
                11,
                4686=>
                15,
                4687=>
                15,
                4688=>
                15,
                4689=>
                15,
                4690=>
                8,
                4691=>
                15,
                4692=>
                11,
                4693=>
                11,
                4694=>
                11,
                4695=>
                15,
                4696=>
                NULL,
                4697=>
                15,
                4698=>
                4,
                4699=>
                8,
                4700=>
                15,
                4701=>
                15,
                4702=>
                4,
                4703=>
                15,
                4704=>
                15,
                4705=>
                7,
                4706=>
                15,
                4707=>
                15,
                4708=>
                15,
                4709=>
                15,
                4710=>
                4,
                4711=>
                4,
                4712=>
                15,
                4713=>
                15,
                4714=>
                7,
                4715=>
                4,
                4716=>
                4,
                4717=>
                4,
                4718=>
                4,
                4719=>
                4,
                4720=>
                11,
                4721=>
                15,
                4722=>
                15,
                4723=>
                7,
                4724=>
                15,
                4725=>
                15,
                4726=>
                15,
                4727=>
                15,
                4728=>
                11,
                4729=>
                8,
                4730=>
                15,
                4731=>
                15,
                4732=>
                15,
                4733=>
                15,
                4734=>
                4,
                4735=>
                15,
                4736=>
                7,
                4737=>
                15,
                4738=>
                4,
                4739=>
                4,
                4740=>
                4,
                4741=>
                7,
                4742=>
                7,
                4743=>
                4,
                4744=>
                15,
                4745=>
                15,
                4746=>
                15,
                4747=>
                15,
                4748=>
                7,
                4749=>
                11,
                4750=>
                15,
                4751=>
                7,
                4752=>
                4,
                4753=>
                7,
                4754=>
                4,
                4755=>
                15,
                4756=>
                11,
                4757=>
                11,
                4758=>
                15,
                4759=>
                15,
                4760=>
                15,
                4761=>
                15,
                4762=>
                15,
                4763=>
                11,
                4764=>
                11,
                4765=>
                7,
                4766=>
                4,
                4767=>
                4,
                4768=>
                4,
                4769=>
                4,
                4770=>
                4,
                4771=>
                15,
                4772=>
                11,
                4773=>
                15,
                4774=>
                4,
                4775=>
                15,
                4776=>
                15,
                4777=>
                15,
                4778=>
                15,
                4779=>
                15,
                4780=>
                15,
                4781=>
                15,
                4782=>
                15,
                4783=>
                15,
                4784=>
                15,
                4785=>
                15,
                4786=>
                15,
                4787=>
                15,
                4788=>
                4,
                4789=>
                15,
                4790=>
                15,
                4791=>
                7,
                4792=>
                15,
                4793=>
                11,
                4794=>
                15,
                4795=>
                11,
                4796=>
                4,
                4797=>
                4,
                4798=>
                4,
                4799=>
                4,
                4800=>
                4,
                4801=>
                15,
                4802=>
                11,
                4803=>
                15,
                4804=>
                15,
                4805=>
                15,
                4806=>
                4,
                4807=>
                15,
                4808=>
                15,
                4809=>
                15,
                4810=>
                15,
                4811=>
                15,
                4812=>
                4,
                4813=>
                4,
                4814=>
                4,
                4815=>
                15,
                4816=>
                15,
                4817=>
                4,
                4818=>
                4,
                4819=>
                15,
                4820=>
                8,
                4821=>
                15,
                4822=>
                4,
                4823=>
                4,
                4824=>
                15,
                4825=>
                15,
                4826=>
                15,
                4827=>
                7,
                4828=>
                7,
                4829=>
                4,
                4830=>
                15,
                4831=>
                15,
                4832=>
                15,
                4833=>
                11,
                4834=>
                15,
                4835=>
                15,
                4836=>
                7,
                4837=>
                7,
                4838=>
                4,
                4839=>
                4,
                4840=>
                4,
                4841=>
                4,
                4842=>
                15,
                4843=>
                15,
                4844=>
                15,
                4845=>
                4,
                4846=>
                11,
                4847=>
                7,
                4848=>
                7,
                4849=>
                11,
                4850=>
                4,
                4851=>
                15,
                4852=>
                11,
                4853=>
                11,
                4854=>
                11,
                4855=>
                15,
                4856=>
                4,
                4857=>
                4,
                4858=>
                4,
                4859=>
                8,
                4860=>
                8,
                4861=>
                4,
                4862=>
                15,
                4863=>
                15,
                4864=>
                15,
                4865=>
                15,
                4866=>
                15,
                4867=>
                15,
                4868=>
                15,
                4869=>
                15,
                4870=>
                15,
                4871=>
                15,
                4872=>
                4,
                4873=>
                4,
                4874=>
                4,
                4875=>
                4,
                4876=>
                4,
                4877=>
                4,
                4878=>
                7,
                4879=>
                8,
                4880=>
                15,
                4881=>
                11,
                4882=>
                7,
                4883=>
                7,
                4884=>
                7,
                4885=>
                7,
                4886=>
                7,
                4887=>
                15,
                4888=>
                11,
                4889=>
                11,
                4890=>
                15,
                4891=>
                15,
                4892=>
                15,
                4893=>
                15,
                4894=>
                11,
                4895=>
                8,
                4896=>
                4,
                4897=>
                4,
                4898=>
                4,
                4899=>
                4,
                4900=>
                11,
                4901=>
                15,
                4902=>
                15,
                4903=>
                15,
                4904=>
                15,
                4905=>
                15,
                4906=>
                15,
                4907=>
                15,
                4908=>
                15,
                4909=>
                15,
                4910=>
                15,
                4911=>
                15,
                4912=>
                15,
                4913=>
                15,
                4914=>
                15,
                4915=>
                15,
                4916=>
                15,
                4918=>
                15,
                4919=>
                15,
                4920=>
                15,
                4921=>
                7,
                4922=>
                4,
                4923=>
                15,
                4924=>
                15,
                4925=>
                15,
                4926=>
                15,
                4927=>
                15,
                4928=>
                15,
                4929=>
                15,
                4930=>
                15,
                4931=>
                15,
                4932=>
                15,
                4933=>
                15,
                4934=>
                15,
                4935=>
                15,
                4936=>
                15,
                4937=>
                15,
                4938=>
                15,
                4939=>
                15,
                4940=>
                15,
                4941=>
                15,
                4942=>
                15,
                4943=>
                15,
                4944=>
                15,
                4945=>
                15,
                4946=>
                15,
                4947=>
                15,
                4948=>
                4,
                4949=>
                7,
                4950=>
                7,
                4951=>
                15,
                4952=>
                15,
                4953=>
                11,
                4954=>
                11,
                4955=>
                11,
                4956=>
                11,
                4957=>
                11,
                4958=>
                11,
                4959=>
                11,
                4960=>
                11,
                4961=>
                11,
                4962=>
                15,
                4963=>
                11,
                4964=>
                11,
                4965=>
                15,
                4966=>
                15,
                4967=>
                15,
                4968=>
                11,
                4969=>
                15,
                4970=>
                15,
                4971=>
                7,
                4972=>
                4,
                4973=>
                8,
                4974=>
                8,
                4975=>
                8,
                4976=>
                8,
                4977=>
                10,
                4978=>
                10,
                4979=>
                15,
                4980=>
                15,
                4981=>
                15,
                4982=>
                15,
                4983=>
                15,
                4984=>
                15,
                4985=>
                11,
                4986=>
                11,
                4987=>
                7,
                4988=>
                15,
                4989=>
                4,
                4990=>
                15,
                4991=>
                8,
                4992=>
                11,
                4993=>
                15,
                4994=>
                15,
                4995=>
                15,
                4996=>
                15,
                4997=>
                11,
                4998=>
                11,
                4999=>
                4,
                5000=>
                4,
                5001=>
                15,
                5002=>
                15,
                5003=>
                15,
                5004=>
                15,
                5005=>
                15,
                5006=>
                15,
                5007=>
                15,
                5008=>
                15,
                5009=>
                15,
                5135=>
                15,
                5136=>
                15,
                5137=>
                15,
                5138=>
                15,
                5139=>
                15,
                5140=>
                15,
                5141=>
                15,
                5142=>
                15,
                5143=>
                15,
                5144=>
                15,
                5145=>
                4,
                5146=>
                4,
                5149=>
                15,
                5150=>
                11,
                5151=>
                11,
                5152=>
                11,
                5153=>
                11,
                5154=>
                11,
                5155=>
                4,
                5156=>
                15,
                5157=>
                15,
                5158=>
                15,
                5159=>
                15,
                5160=>
                4,
                5161=>
                15,
                5162=>
                4,
                5163=>
                4,
                5164=>
                15,
                5165=>
                15,
                5166=>
                11,
                5167=>
                11,
                5168=>
                11,
                5169=>
                9,
                5170=>
                9,
                5171=>
                15,
                5172=>
                15,
                5255=>
                15,
                5256=>
                15,
                5257=>
                15,
                5258=>
                15,
                5277=>
                15,
                5278=>
                15,
                5279=>
                15,
                5283=>
                15,
                5284=>
                15,
                5356=>
                4,
                5357=>
                4,
                5358=>
                4,
                5359=>
                4,
                5365=>
                8,
                5454=>
                15,
                5455=>
                15,
                5456=>
                15,
                5457=>
                15,
                5458=>
                4,
                5459=>
                4,
                5460=>
                8,
                5461=>
                7,
                5462=>
                15,
                5463=>
                15,
                5464=>
                15,
                5465=>
                15,
                5466=>
                15,
                5467=>
                15,
                5468=>
                NULL,
                5469=>
                4,
                5470=>
                4,
                5471=>
                4,
                5482=>
                7,
                5550=>
                15,
                5551=>
                15,
                5552=>
                15,
                5553=>
                7,
                5554=>
                15,
                5556=>
                15,
                5557=>
                15,
                5558=>
                15,
                5559=>
                15,
                5560=>
                15,
                5562=>
                7,
                5563=>
                8,
                5565=>
                15,
                5566=>
                15,
                5567=>
                15,
                5568=>
                15,
                5569=>
                4,
                5570=>
                15,
                5571=>
                15,
                5572=>
                15,
                5573=>
                15,
                5574=>
                15,
                5576=>
                15,
                5577=>
                15,
                5580=>
                11,
                5581=>
                15,
                5584=>
                11,
                5585=>
                4,
                5586=>
                15,
                5587=>
                15,
                5588=>
                15,
                5589=>
                15,
                5590=>
                4,
                5591=>
                4,
                5592=>
                15,
                5593=>
                7,
                5594=>
                15,
                5595=>
                15,
                5596=>
                15,
                5597=>
                15,
                5598=>
                15,
                5599=>
                15,
                5600=>
                15,
                5601=>
                15,
                5602=>
                15,
                5603=>
                15,
                5604=>
                15,
                5605=>
                15,
                5606=>
                15,
                5610=>
                15,
                5611=>
                15,
                5612=>
                15,
                5613=>
                15,
                5614=>
                15,
                5616=>
                15,
                5617=>
                15,
                5618=>
                15,
                5619=>
                15,
                5620=>
                15,
                5621=>
                15,
                5622=>
                NULL,
                5623=>
                15,
                5624=>
                15,
                5625=>
                15,
                5626=>
                15,
                5627=>
                4,
                5628=>
                7,
                5629=>
                15,
                5630=>
                15,
                5631=>
                15,
                5632=>
                15,
                5633=>
                15,
                5634=>
                11,
                5635=>
                11,
                5636=>
                11,
                5637=>
                11,
                5638=>
                11,
                5639=>
                11,
                5640=>
                11,
                5641=>
                15,
                5642=>
                4,
                5643=>
                4,
                5644=>
                15,
                5645=>
                15,
                5646=>
                15,
                5650=>
                15,
                5651=>
                15,
                5652=>
                15,
                5653=>
                15,
                5654=>
                15,
                5655=>
                15,
                5656=>
                11,
                5657=>
                15,
                5658=>
                15,
                5659=>
                15,
                5660=>
                15,
                5661=>
                15,
                5662=>
                15,
                5663=>
                15,
                5664=>
                15,
                5665=>
                15,
                5666=>
                4,
                5667=>
                4,
                5668=>
                15,
                5834=>
                4,
                5868=>
                15,
                6011=>
                15,
                6012=>
                11,
                6105=>
                15,
                6106=>
                4,
                6107=>
                4,
                6108=>
                4,
                6154=>
                15,
                6342=>
                15,
                6343=>
                15,
                6344=>
                15,
                6345=>
                15,
                6346=>
                15,
                6347=>
                15,
                6406=>
                4,
                6407=>
                4,
                6408=>
                4,
                6436=>
                11,
                6460=>
                11,
                6461=>
                11,
                6462=>
                11,
                6581=>
                15,
                6596=>
                15,
                6597=>
                15,
                6598=>
                11,
                6599=>
                11,
                6600=>
                11,
                6602=>
                11,
                6603=>
                11,
                6604=>
                11,
                6605=>
                11,
                6606=>
                11,
                6607=>
                11,
                6608=>
                15,
                6636=>
                15,
                6637=>
                4,
                6638=>
                15,
                6639=>
                15,
                6640=>
                15,
                6641=>
                11,
                6642=>
                11,
                6643=>
                11,
                6644=>
                15,
                6645=>
                15,
                6646=>
                4,
                6651=>
                4,
                6652=>
                15,
                6653=>
                7,
                6654=>
                11,
                6655=>
                11,
                6656=>
                11,
                6657=>
                11,
                6658=>
                11,
                6659=>
                11,
                6660=>
                11,
                6661=>
                11,
                6663=>
                15,
                6665=>
                15,
                6666=>
                15,
                6667=>
                NULL,
                6668=>
                15,
                6669=>
                11,
                6670=>
                11,
                6671=>
                11,
                6672=>
                15,
                6673=>
                15,
                6674=>
                15,
                6675=>
                15,
                6676=>
                15,
                6677=>
                15,
                6678=>
                15,
                6679=>
                7,
                6680=>
                4,
                6681=>
                4,
                6682=>
                4,
                6683=>
                4,
                6684=>
                4,
                6685=>
                11,
                6686=>
                11,
                6687=>
                11,
                6688=>
                11,
                6689=>
                15,
                6690=>
                15,
                6691=>
                15,
                6692=>
                11,
                6693=>
                11,
                6694=>
                4,
                6695=>
                15,
                6715=>
                15,
                6746=>
                4,
                6747=>
                4,
                6748=>
                4,
                6749=>
                4,
                6750=>
                4,
                6751=>
                4,
                6752=>
                4,
                6753=>
                4,
                6754=>
                4,
                6755=>
                4,
                6757=>
                4,
                6758=>
                4,
                6759=>
                15,
                6760=>
                4,
                6761=>
                4,
                6762=>
                4,
                6763=>
                15,
                6764=>
                15,
                6765=>
                15,
                6766=>
                4,
                6841=>
                15,
                6865=>
                15,
                6925=>
                4,
                6977=>
                10,
                6978=>
                15,
                6979=>
                15,
                6980=>
                15,
                6981=>
                15,
                7296=>
                4,
                7297=>
                4,
                7298=>
                4,
                7299=>
                4,
                7300=>
                4,
                7301=>
                4,
                7302=>
                4,
                7303=>
                4,
                7304=>
                15,
                7305=>
                15,
                7306=>
                15,
                7307=>
                15,
                7308=>
                15,
                7309=>
                15,
                7311=>
                11,
                7312=>
                11,
                7313=>
                15,
                7314=>
                15,
                7315=>
                15,
                7316=>
                15,
                7317=>
                4,
                7318=>
                15,
                7319=>
                15,
                7320=>
                15,
                7321=>
                15,
                7322=>
                15,
                7323=>
                15,
                7324=>
                4,
                7325=>
                15,
                7326=>
                15,
                7327=>
                4,
                7328=>
                15,
                7329=>
                15,
                7330=>
                15,
                7331=>
                15,
                7332=>
                15,
                7333=>
                11,
                7334=>
                11,
                7335=>
                15,
                7336=>
                4,
                7337=>
                10,
                7338=>
                15,
                7339=>
                15,
                7340=>
                15,
                7341=>
                15,
                7342=>
                15,
                7343=>
                15,
                7344=>
                15,
                7345=>
                15,
                7346=>
                15,
                7347=>
                15,
                7348=>
                15,
                7349=>
                15,
                7350=>
                15,
                7351=>
                15,
                7352=>
                15,
                7353=>
                4,
                7354=>
                4,
                7355=>
                4,
                7356=>
                4,
                7357=>
                4,
                7358=>
                4,
                7359=>
                4,
                7360=>
                15,
                7361=>
                15,
                7362=>
                15,
                7363=>
                15,
                7364=>
                15,
                7365=>
                15,
                7366=>
                11,
                7367=>
                4,
                7368=>
                4,
                7369=>
                4,
                7370=>
                4,
                7371=>
                15,
                7372=>
                15,
                7373=>
                15,
                7374=>
                15,
                7375=>
                15,
                7376=>
                4,
                7377=>
                15,
                7378=>
                15,
                7379=>
                15,
                7380=>
                15,
                7381=>
                15,
                7382=>
                15,
                7383=>
                15,
                7384=>
                15,
                7385=>
                15,
                7386=>
                15,
                7387=>
                15,
                7388=>
                15,
                7389=>
                15,
                7390=>
                15,
                7391=>
                15,
                7392=>
                15,
                7393=>
                11,
                7394=>
                15,
                7395=>
                15,
                7396=>
                15,
                7397=>
                15,
                7398=>
                15,
                7399=>
                15,
                7400=>
                15,
                7401=>
                15,
                7402=>
                15,
                7403=>
                15,
                7404=>
                15,
                7405=>
                15,
                7406=>
                15,
                7407=>
                11,
                7408=>
                15,
                7409=>
                15,
                7410=>
                15,
                7411=>
                15,
                7412=>
                15,
                7413=>
                15,
                7414=>
                15,
                7415=>
                15,
                7416=>
                4,
                7417=>
                11,
                7418=>
                15,
                7419=>
                15,
                7420=>
                15,
                7421=>
                15,
                7422=>
                11,
                7423=>
                15,
                7425=>
                15,
                7426=>
                15,
                7427=>
                15,
                7428=>
                15,
                7429=>
                15,
                7430=>
                7,
                7431=>
                15,
                7432=>
                4,
                7433=>
                7,
                7434=>
                11,
                7435=>
                NULL,
                7436=>
                15,
                7437=>
                4,
                7438=>
                15,
                7439=>
                4,
                7440=>
                4,
                7441=>
                15,
                7442=>
                15,
                7443=>
                4,
                7444=>
                15,
                7445=>
                4,
                7446=>
                15,
                7447=>
                15,
                7448=>
                15,
                7449=>
                15,
                7450=>
                15,
                7451=>
                15,
                7452=>
                15,
                7453=>
                15,
                7454=>
                15,
                7455=>
                15,
                7456=>
                15,
                7457=>
                15,
                7458=>
                15,
                7459=>
                4,
                7460=>
                15,
                7461=>
                15,
                7464=>
                15,
                7466=>
                15,
                7467=>
                15,
                7483=>
                15,
                7484=>
                4,
                7485=>
                7,
                7487=>
                15,
                7488=>
                4,
                7489=>
                4,
                7490=>
                4,
                7491=>
                11,
                7492=>
                15,
                7493=>
                15,
                7494=>
                15,
                7495=>
                15,
                7496=>
                15,
                7497=>
                15,
                7498=>
                15,
                7499=>
                15,
                7500=>
                15,
                7501=>
                15,
                7502=>
                15,
                7503=>
                7,
                7504=>
                4,
                7505=>
                4,
                7506=>
                15,
                7507=>
                15,
                7508=>
                15,
                7509=>
                4,
                7510=>
                4,
                7511=>
                4,
                7512=>
                15,
                7513=>
                15,
                7514=>
                15,
                7515=>
                15,
                7516=>
                15,
                7517=>
                15,
                7518=>
                15,
                7519=>
                15,
                7520=>
                15,
                7521=>
                15,
                7522=>
                15,
                7523=>
                15,
                7524=>
                11,
                7525=>
                11,
                7526=>
                15,
                7527=>
                15,
                7528=>
                15,
                7529=>
                15,
                7530=>
                15,
                7531=>
                15,
                7532=>
                15,
                7533=>
                15,
                7534=>
                15,
                7535=>
                15,
                7536=>
                15,
                7537=>
                15,
                7538=>
                15,
                7539=>
                15,
                7540=>
                15,
                7541=>
                15,
                7542=>
                4,
                7543=>
                4,
                7544=>
                15,
                7545=>
                4,
                7546=>
                15,
                7547=>
                15,
                7548=>
                15,
                7549=>
                11,
                7550=>
                15,
                7551=>
                15,
                7552=>
                15,
                7553=>
                11,
                7554=>
                11,
                7555=>
                7,
                7557=>
                15,
                7558=>
                15,
                7559=>
                15,
                7560=>
                15,
                7561=>
                15,
                7562=>
                15,
                7563=>
                15,
                7564=>
                15,
                7565=>
                15,
                7566=>
                15,
                7567=>
                15,
                7568=>
                15,
                7569=>
                15,
                7570=>
                15,
                7571=>
                15,
                7572=>
                15,
                7573=>
                15,
                7575=>
                11,
                7576=>
                11,
                7577=>
                11,
                7578=>
                15,
                7579=>
                15,
                7580=>
                15,
                7581=>
                15,
                7582=>
                15,
                7583=>
                15,
                7584=>
                15,
                7585=>
                7,
                7586=>
                15,
                7587=>
                4,
                7588=>
                4,
                7589=>
                15,
                7590=>
                15,
                7591=>
                15,
                7592=>
                15,
                7593=>
                15,
                7594=>
                15,
                7595=>
                15,
                7596=>
                11,
                7597=>
                15,
                7598=>
                15,
                7599=>
                15,
                7600=>
                15,
                7601=>
                11,
                7602=>
                15,
                7603=>
                11,
                7604=>
                15,
                7605=>
                15,
                7606=>
                11,
                7607=>
                11,
                7608=>
                11,
                7609=>
                11,
                7610=>
                11,
                7611=>
                11,
                7612=>
                11,
                7613=>
                11,
                7614=>
                11,
                7615=>
                11,
                7616=>
                15,
                7617=>
                15,
                7618=>
                15,
                7619=>
                15,
                7620=>
                15,
                7621=>
                15,
                7622=>
                15,
                7623=>
                15,
                7624=>
                15,
                7625=>
                15,
                7626=>
                11,
                7627=>
                15,
                7628=>
                15,
                7629=>
                15,
                7630=>
                15,
                7631=>
                15,
                7632=>
                15,
                7633=>
                15,
                7634=>
                15,
                7635=>
                15,
                7636=>
                15,
                7637=>
                15,
                7638=>
                15,
                7639=>
                15,
                7640=>
                15,
                7641=>
                15,
                7642=>
                15,
                7643=>
                15,
                7644=>
                15,
                7645=>
                11,
                7646=>
                15,
                7647=>
                15,
                7648=>
                15,
                7650=>
                15,
                7651=>
                15,
                7652=>
                15,
                7653=>
                15,
                7654=>
                15,
                7657=>
                15,
                7658=>
                15,
                7659=>
                15,
                7660=>
                15,
                7661=>
                4,
                7662=>
                15,
                7663=>
                15,
                7664=>
                11,
                7665=>
                15,
                7666=>
                15,
                7667=>
                11,
                7669=>
                15,
                7670=>
                4,
                7671=>
                4,
                7672=>
                4,
                7673=>
                4,
                7674=>
                4,
                7675=>
                4,
                7676=>
                15,
                7677=>
                15,
                7678=>
                4,
                7679=>
                4,
                7680=>
                15,
                7681=>
                15,
                7682=>
                15,
                7683=>
                15,
                7684=>
                7,
                7693=>
                15,
                7694=>
                15,
                7695=>
                15,
                7696=>
                15,
                7697=>
                11,
                7698=>
                15,
                7699=>
                15,
                7700=>
                15,
                7701=>
                15,
                7709=>
                15,
                7710=>
                15,
                7711=>
                15,
                7715=>
                15,
                7716=>
                15,
                7717=>
                15,
                7718=>
                15,
                7719=>
                15,
                7720=>
                15,
                7721=>
                15,
                7722=>
                15,
                7724=>
                15,
                7725=>
                15,
                7726=>
                4,
                7727=>
                15,
                7729=>
                15,
                7730=>
                11,
                7731=>
                11,
                7732=>
                15,
                7733=>
                15,
                7734=>
                15,
                7735=>
                15,
                7736=>
                15,
                7737=>
                15,
                7738=>
                15,
                7739=>
                15,
                7741=>
                15,
                7742=>
                15,
                7744=>
                15,
                7745=>
                11,
                7746=>
                15,
                7747=>
                11,
                7748=>
                11,
                7749=>
                15,
                7750=>
                15,
                7751=>
                15,
                7752=>
                15,
                7753=>
                7,
                7754=>
                4,
                7755=>
                4,
                7756=>
                11,
                7757=>
                15,
                7758=>
                15,
                7759=>
                15,
                7760=>
                15,
                7761=>
                15,
                7762=>
                15,
                7763=>
                15,
                7764=>
                15,
                7765=>
                15,
                7766=>
                15,
                7767=>
                15,
                7768=>
                4,
                7769=>
                15,
                7770=>
                15,
                7771=>
                15,
                7772=>
                15,
                7773=>
                15,
                7774=>
                15,
                7775=>
                15,
                7776=>
                15,
                7777=>
                15,
                7778=>
                15,
                7779=>
                15,
                7780=>
                15,
                7781=>
                15,
                7782=>
                15,
                7783=>
                15,
                7784=>
                15,
                7785=>
                15,
                7786=>
                15,
                7787=>
                15,
                7788=>
                15,
                7789=>
                15,
                7790=>
                15,
                7791=>
                15,
                7792=>
                15,
                7793=>
                15,
                7794=>
                15,
                7795=>
                4,
                7796=>
                7,
                7797=>
                7,
                7798=>
                7,
                7799=>
                7,
                7800=>
                7,
                7801=>
                6,
                7802=>
                6,
                7803=>
                7,
                7804=>
                7,
                7805=>
                7,
                7806=>
                12,
                7807=>
                15,
                7808=>
                15,
                7809=>
                11,
                7810=>
                11,
                7811=>
                15,
                7812=>
                11,
                7813=>
                15,
                7814=>
                15,
                7815=>
                15,
                7816=>
                15,
                7817=>
                11,
                7818=>
                15,
                7819=>
                15,
                7820=>
                15,
                7821=>
                7,
                7822=>
                15,
                7823=>
                11,
                7824=>
                11,
                7825=>
                15,
                7826=>
                15,
                7827=>
                11,
                7828=>
                15,
                7829=>
                15,
                7830=>
                15,
                7831=>
                15,
                7832=>
                15,
                7833=>
                15,
                7834=>
                7,
                7835=>
                15,
                7836=>
                15,
                7837=>
                11,
                7838=>
                11,
                7839=>
                11,
                7840=>
                15,
                7841=>
                15,
                7842=>
                11,
                7843=>
                15,
                7844=>
                15,
                7845=>
                15,
                7847=>
                15,
                7849=>
                15,
                7850=>
                15,
                7851=>
                15,
                7852=>
                15,
                7853=>
                11,
                7854=>
                15,
                7855=>
                15,
                7856=>
                15,
                7857=>
                15,
                7858=>
                4,
                7859=>
                4,
                7860=>
                4,
                7861=>
                15,
                7862=>
                15,
                7863=>
                15,
                7864=>
                15,
                7865=>
                15,
                7866=>
                7,
                7867=>
                4,
                7868=>
                4,
                7869=>
                15,
                7870=>
                15,
                7871=>
                15,
                7872=>
                15,
                7873=>
                15,
                7874=>
                4,
                7875=>
                4,
                7876=>
                15,
                7877=>
                15,
                7878=>
                7,
                7879=>
                7,
                7880=>
                4,
                7881=>
                15,
                7882=>
                15,
                7883=>
                15,
                7884=>
                15,
                7885=>
                15,
                7886=>
                11,
                7887=>
                7,
                7888=>
                7,
                7889=>
                15,
                7890=>
                4,
                7891=>
                11,
                7892=>
                15,
                7893=>
                15,
                7894=>
                4,
                7895=>
                15,
                7896=>
                15,
                7897=>
                15,
                7898=>
                15,
                7899=>
                15,
                7900=>
                15,
                7901=>
                15,
                7902=>
                15,
                7903=>
                15,
                7904=>
                15,
                7905=>
                15,
                7906=>
                15,
                7907=>
                15,
                7908=>
                15,
                7909=>
                15,
                7910=>
                15,
                7911=>
                15,
                7912=>
                15,
                7913=>
                11,
                7914=>
                4,
                7915=>
                15,
                7916=>
                15,
                7917=>
                15,
                7918=>
                4,
                7919=>
                15,
                7920=>
                7,
                7921=>
                11,
                7969=>
                15,
                7970=>
                15,
                7971=>
                15,
                7972=>
                15,
                7973=>
                11,
                7974=>
                15,
                7975=>
                15,
                7976=>
                15,
                7977=>
                15,
                7978=>
                11,
                7979=>
                11,
                7982=>
                15,
                7983=>
                15,
                8010=>
                15,
                8011=>
                15,
                8012=>
                7,
                8013=>
                15,
                8014=>
                15,
                8015=>
                15,
                8016=>
                4,
                8017=>
                15,
                8018=>
                15,
                8019=>
                15,
                8020=>
                15,
                8021=>
                15,
                8022=>
                15,
                8023=>
                15,
                8024=>
                15,
                8025=>
                15,
                8026=>
                15,
                8027=>
                15,
                8028=>
                7,
                8029=>
                15,
                8030=>
                15,
                8031=>
                15,
                8032=>
                15,
                8033=>
                15,
                8034=>
                15,
                8035=>
                15,
                8036=>
                15,
                8037=>
                15,
                8038=>
                15,
                8039=>
                15,
                8040=>
                15,
                8041=>
                15,
                8042=>
                7,
                8043=>
                7,
                8044=>
                15,
                8045=>
                4,
                8046=>
                4,
                8047=>
                15,
                8048=>
                15,
                8049=>
                15,
                8050=>
                15,
                8051=>
                15,
                8052=>
                15,
                8053=>
                15,
                8054=>
                15,
                8055=>
                15,
                8056=>
                11,
                8057=>
                15,
                8058=>
                15,
                8059=>
                15,
                8060=>
                15,
                8061=>
                15,
                8062=>
                15,
                8063=>
                15,
                8064=>
                15,
                8065=>
                15,
                8066=>
                15,
                8067=>
                15,
                8068=>
                15,
                8069=>
                15,
                8070=>
                15,
                8071=>
                15,
                8072=>
                15,
                8073=>
                7,
                8074=>
                11,
                8075=>
                15,
                8119=>
                11,
                8120=>
                11,
                8121=>
                15,
                8139=>
                11,
                8148=>
                15,
                8149=>
                15,
                8150=>
                15,
                8151=>
                15,
                8152=>
                15,
                8153=>
                15,
                8154=>
                11,
                8155=>
                11,
                8156=>
                15,
                8158=>
                7,
                8159=>
                7,
                8160=>
                4,
                8161=>
                15,
                8162=>
                15,
                8163=>
                15,
                8164=>
                15,
                8165=>
                15,
                8166=>
                15,
                8167=>
                15,
                8168=>
                15,
                8169=>
                15,
                8170=>
                15,
                8171=>
                7,
                8172=>
                7,
                8173=>
                7,
                8174=>
                7,
                8175=>
                7,
                8176=>
                7,
                8177=>
                7,
                8178=>
                11,
                8180=>
                15,
                8181=>
                15,
                8182=>
                15,
                8183=>
                15,
                8184=>
                11,
                8185=>
                11,
                8186=>
                15,
                8187=>
                15,
                8188=>
                15,
                8189=>
                15,
                8190=>
                15,
                8191=>
                15,
                8192=>
                15,
                8193=>
                4,
                8194=>
                15,
                8195=>
                15,
                8196=>
                15,
                8197=>
                15,
                8198=>
                15,
                8199=>
                7,
                8200=>
                11,
                8201=>
                7,
                8202=>
                7,
                8203=>
                11,
                8204=>
                15,
                8205=>
                15,
                8206=>
                15,
                8207=>
                15,
                8208=>
                15,
                8209=>
                15,
                8210=>
                15,
                8211=>
                15,
                8212=>
                15,
                8213=>
                15,
                8214=>
                15,
                8215=>
                15,
                8216=>
                15,
                8217=>
                15,
                8218=>
                15,
                8219=>
                15,
                8220=>
                15,
                8221=>
                15,
                8222=>
                15,
                8223=>
                15,
                8224=>
                15,
                8225=>
                11,
                8226=>
                15,
                8227=>
                15,
                8228=>
                15,
                8229=>
                11,
                8230=>
                15,
                8231=>
                15,
                8232=>
                11,
                8233=>
                15,
                8234=>
                15,
                8235=>
                15,
                8236=>
                15,
                8237=>
                15,
                8238=>
                15,
                8239=>
                11,
                8240=>
                15,
                8241=>
                15,
                8242=>
                15,
                8243=>
                15,
                8244=>
                15,
                8245=>
                10,
                8246=>
                15,
                8247=>
                15,
                8248=>
                15,
                8249=>
                15,
                8250=>
                15,
                8251=>
                15,
                8252=>
                11,
                8253=>
                11,
                8254=>
                11,
                8255=>
                11,
                8258=>
                15,
                8259=>
                15,
                8260=>
                15,
                8261=>
                4,
                8262=>
                15,
                8263=>
                15,
                8264=>
                15,
                8265=>
                15,
                8266=>
                15,
                8267=>
                11,
                8268=>
                11,
                8269=>
                15,
                8270=>
                15,
                8271=>
                15,
                8272=>
                15,
                8273=>
                15,
                8274=>
                15,
                8275=>
                15,
                8276=>
                15,
                8303=>
                15,
                8304=>
                7,
                8313=>
                4,
                8314=>
                15,
                8315=>
                7,
                8317=>
                15,
                8333=>
                11,
                8334=>
                15,
                8335=>
                15,
                8336=>
                15,
                8373=>
                15,
                8393=>
                4,
                8394=>
                15,
                8395=>
                15,
                8396=>
                15,
                8397=>
                15,
                8398=>
                15,
                8399=>
                15,
                8400=>
                15,
                8401=>
                15,
                8402=>
                15,
                8403=>
                15,
                8404=>
                15,
                8405=>
                15,
                8406=>
                15,
                8407=>
                11,
                8408=>
                15,
                8409=>
                15,
                8410=>
                15,
                8411=>
                15,
                8412=>
                15,
                8414=>
                15,
                8447=>
                15,
                8565=>
                4,
                8566=>
                4,
                8567=>
                11,
                8588=>
                15,
                8589=>
                15,
                8590=>
                15,
                8591=>
                15,
                8592=>
                15,
                8593=>
                15,
                8594=>
                15,
                8617=>
                4,
                8618=>
                15,
                8619=>
                11,
                8620=>
                15,
                8621=>
                15,
                8622=>
                15,
                8623=>
                15,
                8624=>
                15,
                8625=>
                15,
                8626=>
                15,
                8627=>
                15,
                8628=>
                4,
                8629=>
                4,
                8630=>
                15,
                8631=>
                15,
                8632=>
                15,
                8633=>
                15,
                8634=>
                15,
                8635=>
                15,
                8636=>
                15,
                8637=>
                15,
                8638=>
                15,
                8639=>
                15,
                8640=>
                15,
                8641=>
                15,
                8642=>
                15,
                8643=>
                15,
                8644=>
                15,
                8645=>
                15,
                8646=>
                15,
                8647=>
                15,
                8648=>
                15,
                8649=>
                15,
                8650=>
                15,
                8651=>
                11,
                8652=>
                11,
                8653=>
                11,
                8654=>
                11,
                8655=>
                11,
                8656=>
                4,
                8657=>
                15,
                8658=>
                11,
                8659=>
                7,
                8660=>
                7,
                8661=>
                15,
                8662=>
                15,
                8663=>
                4,
                8664=>
                15,
                8665=>
                15,
                8666=>
                7,
                8667=>
                7,
                8668=>
                15,
                8669=>
                15,
                8670=>
                11,
                8671=>
                15,
                8672=>
                15,
                8673=>
                15,
                8674=>
                15,
                8675=>
                15,
                8676=>
                15,
                8677=>
                15,
                8678=>
                15,
                8679=>
                15,
                8680=>
                15,
                8681=>
                15,
                8682=>
                15,
                8683=>
                11,
                8684=>
                15,
                8685=>
                15,
                8686=>
                7,
                8687=>
                4,
                8688=>
                4,
                8689=>
                15,
                8690=>
                15,
                8691=>
                8,
                8692=>
                8,
                8693=>
                15,
                8694=>
                15,
                8695=>
                11,
                8696=>
                11,
                8697=>
                4,
                8698=>
                4,
                8699=>
                4,
                8700=>
                4,
                8701=>
                4,
                8702=>
                11,
                8703=>
                11,
                8704=>
                11,
                8705=>
                11,
                8706=>
                11,
                8707=>
                11,
                8708=>
                15,
                8709=>
                15,
                8710=>
                15,
                8711=>
                15,
                8712=>
                15,
                8713=>
                15,
                8714=>
                11,
                8715=>
                15,
                8716=>
                15,
                8717=>
                11,
                8718=>
                15,
                8720=>
                15,
                8721=>
                15,
                8722=>
                15,
                8723=>
                15,
                8724=>
                15,
                8725=>
                11,
                8726=>
                15,
                8727=>
                15,
                8728=>
                7,
                8729=>
                NULL,
                8730=>
                11,
                8731=>
                11,
                8732=>
                15,
                8733=>
                8,
                8734=>
                15,
                8735=>
                4,
                8736=>
                4,
                8737=>
                4,
                8738=>
                4,
                8739=>
                4,
                8740=>
                4,
                8741=>
                4,
                8742=>
                4,
                8743=>
                4,
                8744=>
                11,
                8745=>
                11,
                8746=>
                15,
                8747=>
                15,
                8748=>
                11,
                8749=>
                15,
                8750=>
                11,
                8751=>
                11,
                8752=>
                11,
                8753=>
                11,
                8754=>
                15,
                8755=>
                4,
                8756=>
                11,
                8757=>
                11,
                8758=>
                4,
                8759=>
                11,
                8760=>
                15,
                8761=>
                15,
                8762=>
                15,
                8763=>
                11,
                8764=>
                11,
                8765=>
                11,
                8766=>
                15,
                8767=>
                15,
                8768=>
                15,
                8769=>
                15,
                8770=>
                15,
                8771=>
                15,
                8772=>
                15,
                8773=>
                15,
                8774=>
                15,
                8775=>
                15,
                8776=>
                11,
                8777=>
                15,
                8778=>
                15,
                8779=>
                15,
                8780=>
                11,
                8781=>
                11,
                8782=>
                15,
                8783=>
                15,
                8784=>
                15,
                8785=>
                15,
                8786=>
                15,
                8787=>
                11,
                8788=>
                11,
                8789=>
                11,
                8790=>
                11,
                8791=>
                11,
                8792=>
                15,
                8793=>
                11,
                8794=>
                4,
                8795=>
                15,
                8796=>
                15,
                8797=>
                11,
                8798=>
                15,
                8799=>
                15,
                8800=>
                15,
                8801=>
                15,
                8802=>
                15,
                8803=>
                15,
                8804=>
                15,
                8805=>
                15,
                8806=>
                15,
                8807=>
                15,
                8808=>
                4,
                8809=>
                15,
                8810=>
                15,
                8811=>
                15,
                8812=>
                15,
                8813=>
                15,
                8814=>
                NULL,
                8815=>
                4,
                8816=>
                15,
                8817=>
                15,
                8818=>
                15,
                8819=>
                15,
                8820=>
                15,
                8821=>
                15,
                8822=>
                15,
                8823=>
                15,
                8824=>
                15,
                8825=>
                15,
                8826=>
                15,
                8827=>
                15,
                8828=>
                15,
                8829=>
                15,
                8830=>
                15,
                8831=>
                15,
                8832=>
                15,
                8833=>
                15,
                8834=>
                15,
                8835=>
                15,
                8836=>
                15,
                8837=>
                11,
                8838=>
                4,
                8839=>
                15,
                8840=>
                15,
                8841=>
                15,
                8842=>
                11,
                8843=>
                15,
                8844=>
                15,
                8845=>
                15,
                8846=>
                15,
                8847=>
                15,
                8848=>
                15,
                8849=>
                15,
                8850=>
                15,
                8851=>
                15,
                8852=>
                15,
                8853=>
                15,
                8854=>
                15,
                8855=>
                15,
                8856=>
                15,
                8857=>
                15,
                8858=>
                11,
                8859=>
                15,
                8860=>
                15,
                8861=>
                15,
                8862=>
                15,
                8863=>
                15,
                8864=>
                15,
                8865=>
                15,
                8866=>
                11,
                8867=>
                15,
                8868=>
                15,
                8869=>
                15,
                8870=>
                4,
                8871=>
                15,
                8872=>
                15,
                8873=>
                15,
                8874=>
                4,
                8875=>
                4,
                8876=>
                15,
                8877=>
                15,
                8878=>
                15,
                8879=>
                15,
                8880=>
                15,
                8881=>
                15,
                8882=>
                15,
                8883=>
                15,
                8884=>
                15,
                8885=>
                15,
                8886=>
                15,
                8887=>
                15,
                8888=>
                15,
                8889=>
                15,
                8890=>
                15,
                8891=>
                15,
                8892=>
                15,
                8893=>
                15,
                8894=>
                15,
                8895=>
                15,
                8896=>
                15,
                8897=>
                15,
                8898=>
                15,
                8899=>
                15,
                8900=>
                15,
                8901=>
                15,
                8902=>
                7,
                8903=>
                7,
                8904=>
                15,
                8905=>
                15,
                8906=>
                15,
                8907=>
                15,
                8908=>
                4,
                8909=>
                15,
                8913=>
                7,
                8914=>
                15,
                8915=>
                11,
                8916=>
                11,
                8917=>
                11,
                8918=>
                15,
                8919=>
                11,
                8920=>
                15,
                8921=>
                15,
                8922=>
                NULL,
                8923=>
                7,
                8924=>
                4,
                8925=>
                4,
                8926=>
                4,
                8927=>
                4,
                8928=>
                4,
                8929=>
                15,
                8930=>
                15,
                8931=>
                15,
                8932=>
                15,
                8933=>
                15,
                8934=>
                15,
                8935=>
                15,
                8936=>
                15,
                8937=>
                15,
                8938=>
                15,
                8939=>
                15,
                8940=>
                15,
                8941=>
                15,
                8942=>
                15,
                8943=>
                15,
                8944=>
                15,
                8945=>
                15,
                8946=>
                15,
                8947=>
                15,
                8948=>
                15,
                8949=>
                15,
                8950=>
                7,
                8951=>
                7,
                8952=>
                15,
                8953=>
                15,
                8954=>
                15,
                8955=>
                4,
                8956=>
                4,
                8957=>
                4,
                8958=>
                NULL,
                8959=>
                15,
                8960=>
                15,
                8961=>
                15,
                8962=>
                15,
                8963=>
                15,
                8964=>
                15,
                8965=>
                15,
                8966=>
                4,
                8967=>
                4,
                8968=>
                15,
                8969=>
                15,
                8970=>
                15,
                8971=>
                15,
                8972=>
                15,
                8973=>
                11,
                8974=>
                11,
                8975=>
                15,
                8976=>
                11,
                8977=>
                7,
                8978=>
                15,
                8979=>
                11,
                8980=>
                11,
                8981=>
                15,
                8982=>
                15,
                8983=>
                15,
                8984=>
                15,
                8985=>
                15,
                8986=>
                11,
                8987=>
                11,
                8988=>
                15,
                8990=>
                15,
                8991=>
                15,
                8992=>
                15,
                8993=>
                4,
                8994=>
                4,
                8995=>
                4,
                8996=>
                4,
                8997=>
                4,
                8998=>
                4,
                8999=>
                4,
                9000=>
                4,
                9001=>
                15,
                9002=>
                15,
                9003=>
                15,
                9004=>
                15,
                9005=>
                15,
                9006=>
                15,
                9007=>
                15,
                9008=>
                11,
                9009=>
                15,
                9010=>
                15,
                9011=>
                15,
                9012=>
                15,
                9013=>
                4,
                9015=>
                11,
                9017=>
                11,
                9018=>
                15,
                9019=>
                15,
                9020=>
                15,
                9021=>
                15,
                9022=>
                15,
                9024=>
                15,
                9025=>
                15,
                9026=>
                15,
                9027=>
                15,
                9028=>
                15,
                9029=>
                15,
                9030=>
                11,
                9031=>
                15,
                9032=>
                15,
                9033=>
                15,
                9035=>
                11,
                9036=>
                4,
                9037=>
                4,
                9038=>
                4,
                9039=>
                15,
                9040=>
                15,
                9041=>
                15,
                9042=>
                15,
                9043=>
                15,
                9044=>
                15,
                9045=>
                15,
                9046=>
                15,
                9047=>
                15,
                9048=>
                15,
                9049=>
                15,
                9050=>
                15,
                9051=>
                15,
                9052=>
                15,
                9054=>
                4,
                9055=>
                4,
                9056=>
                4,
                9057=>
                4,
                9058=>
                15,
                9059=>
                15,
                9060=>
                15,
                9061=>
                15,
                9062=>
                15,
                9063=>
                15,
                9064=>
                15,
                9065=>
                15,
                9066=>
                15,
                9067=>
                15,
                9068=>
                15,
                9069=>
                15,
                9070=>
                NULL,
                9071=>
                15,
                9072=>
                15,
                9073=>
                15,
                9074=>
                15,
                9075=>
                15,
                9076=>
                15,
                9077=>
                15,
                9078=>
                9,
                9079=>
                9,
                9080=>
                9,
                9081=>
                NULL,
                9082=>
                4,
                9083=>
                15,
                9084=>
                11,
                9085=>
                15,
                9086=>
                10,
                9087=>
                10,
                9088=>
                15,
                9089=>
                15,
                9090=>
                15,
                9091=>
                15,
                9092=>
                15,
                9093=>
                15,
                9094=>
                15,
                9095=>
                15,
                9096=>
                15,
                9097=>
                15,
                9098=>
                10,
                9099=>
                10,
                9100=>
                10,
                9101=>
                15,
                9102=>
                15,
                9103=>
                15,
                9104=>
                15,
                9105=>
                15,
                9106=>
                15,
                9107=>
                15,
                9108=>
                15,
                9109=>
                15,
                9110=>
                15,
                9111=>
                10,
                9112=>
                15,
                9113=>
                NULL,
                9114=>
                4,
                9115=>
                7,
                9116=>
                10,
                9117=>
                10,
                9118=>
                10,
                9119=>
                10,
                9120=>
                13,
                9121=>
                15,
                9122=>
                15,
                9123=>
                15,
                9124=>
                15,
                9125=>
                10,
                9126=>
                15,
                9127=>
                15,
                9128=>
                15,
                9129=>
                15,
                9130=>
                15,
                9131=>
                4,
                9132=>
                15,
                9133=>
                15,
                9134=>
                15,
                9135=>
                10,
                9136=>
                NULL,
                9137=>
                15,
                9138=>
                15,
                9139=>
                15,
                9140=>
                15,
                9141=>
                7,
                9142=>
                15,
                9143=>
                15,
                9144=>
                11,
                9145=>
                15,
                9146=>
                15,
                9147=>
                10,
                9148=>
                NULL,
                9149=>
                NULL,
                9150=>
                NULL,
                9151=>
                15,
                9152=>
                4,
                9153=>
                4,
                9154=>
                4,
                9155=>
                4,
                9156=>
                15,
                9157=>
                15,
                9158=>
                11,
                9159=>
                15,
                9160=>
                15,
                9161=>
                15,
                9162=>
                15,
                9163=>
                15,
                9164=>
                15,
                9165=>
                15,
                9166=>
                7,
                9167=>
                15,
                9168=>
                15,
                9169=>
                15,
                9170=>
                15,
                9171=>
                15,
                9172=>
                15,
                9173=>
                15,
                9174=>
                15,
                9175=>
                11,
                9176=>
                NULL,
                9177=>
                15,
                9178=>
                NULL,
                9179=>
                15,
                9180=>
                15,
                9181=>
                15,
                9182=>
                15,
                9183=>
                15,
                9184=>
                15,
                9185=>
                15,
                9186=>
                15,
                9187=>
                15,
                9188=>
                15,
                9189=>
                15,
                9190=>
                15,
                9191=>
                15,
                9192=>
                15,
                9193=>
                15,
                9194=>
                15,
                9195=>
                15,
                9196=>
                7,
                9197=>
                15,
                9198=>
                15,
                9199=>
                15,
                9200=>
                15,
                9201=>
                15,
                9202=>
                15,
                9203=>
                15,
                9204=>
                15,
                9205=>
                15,
                9206=>
                15,
                9207=>
                15,
                9208=>
                15,
                9209=>
                15,
                9210=>
                15,
                9211=>
                15,
                9212=>
                15,
                9213=>
                15,
                9214=>
                15,
                9215=>
                15,
                9216=>
                15,
                9217=>
                15,
                9218=>
                15,
                9219=>
                NULL,
                9220=>
                15,
                9221=>
                15,
                9222=>
                15,
                9223=>
                15,
                9224=>
                15,
                9225=>
                15,
                9226=>
                10,
                9227=>
                11,
                9228=>
                15,
                9229=>
                15,
                9230=>
                15,
                9231=>
                15,
                9232=>
                15,
                9233=>
                15,
                9234=>
                15,
                9235=>
                15,
                9236=>
                11,
                9237=>
                15,
                9238=>
                11,
                9239=>
                15,
                9240=>
                15,
                9241=>
                11,
                9242=>
                7,
                9243=>
                15,
                9244=>
                11,
                9245=>
                11,
                9246=>
                15,
                9247=>
                11,
                9248=>
                15,
                9249=>
                11,
                9250=>
                15,
                9251=>
                15,
                9252=>
                15,
                9253=>
                10,
                9254=>
                15,
                9255=>
                15,
                9256=>
                15,
                9257=>
                15,
                9258=>
                15,
                9259=>
                15,
                9260=>
                4,
                9261=>
                4,
                9262=>
                15,
                9263=>
                15,
                9264=>
                15,
                9265=>
                11,
                9266=>
                15,
                9267=>
                15,
                9268=>
                10,
                9269=>
                15,
                9270=>
                15,
                9271=>
                15,
                9272=>
                4,
                9273=>
                10,
                9274=>
                15,
                9275=>
                7,
                9276=>
                15,
                9277=>
                15,
                9278=>
                10,
                9279=>
                NULL,
                9280=>
                NULL,
                9281=>
                15,
                9282=>
                15,
                9283=>
                15,
                9284=>
                15,
                9285=>
                15,
                9286=>
                15,
                9287=>
                15,
                9288=>
                7,
                9289=>
                15,
                9290=>
                15,
                9291=>
                15,
                9292=>
                NULL,
                9293=>
                NULL,
                9294=>
                NULL,
                9295=>
                10,
                9296=>
                NULL,
                9297=>
                15,
                9298=>
                NULL,
                9299=>
                NULL,
                9300=>
                10,
                9301=>
                10,
                9302=>
                10,
                9303=>
                10,
                9304=>
                15,
                9305=>
                15,
                9306=>
                4,
                9307=>
                10,
                9308=>
                10,
                9309=>
                NULL,
                9310=>
                15,
                9311=>
                15,
                9312=>
                11,
                9313=>
                10,
                9314=>
                15,
                9315=>
                15,
                9316=>
                15,
                9317=>
                15,
                9318=>
                NULL,
                9319=>
                NULL,
                9320=>
                15,
                9321=>
                10,
                9322=>
                15,
                9323=>
                15,
                9324=>
                15,
                9325=>
                15,
                9326=>
                15,
                9327=>
                15,
                9328=>
                15,
                9329=>
                15,
                9330=>
                15,
                9331=>
                15,
                9332=>
                10,
                9333=>
                15,
                9334=>
                10,
                9335=>
                15,
                9336=>
                15,
                9337=>
                15,
                9338=>
                10,
                9339=>
                15,
                9340=>
                9,
                9341=>
                15,
                9342=>
                15,
                9343=>
                15,
                9344=>
                15,
                9345=>
                15,
                9346=>
                15,
                9347=>
                15,
                9348=>
                15,
                9349=>
                15,
                9350=>
                15,
                9351=>
                15,
                9352=>
                15,
                9353=>
                15,
                9354=>
                15,
                9355=>
                10,
                9356=>
                15,
                9357=>
                15,
                9358=>
                15,
                9359=>
                10,
                9360=>
                7,
                9361=>
                7,
                9362=>
                10,
                9364=>
                15,
                9365=>
                15,
                9366=>
                15,
                9367=>
                15,
                9368=>
                15,
                9369=>
                10,
                9370=>
                15,
                9371=>
                15,
                9372=>
                15,
                9373=>
                15,
                9374=>
                15,
                9375=>
                15,
                9376=>
                15,
                9377=>
                15,
                9378=>
                15,
                9379=>
                15,
                9380=>
                15,
                9381=>
                15,
                9382=>
                15,
                9383=>
                15,
                9384=>
                15,
                9385=>
                15,
                9386=>
                15,
                9387=>
                15,
                9388=>
                10,
                9389=>
                15,
                9390=>
                15,
                9391=>
                15,
                9392=>
                15,
                9393=>
                10,
                9394=>
                10,
                9395=>
                10,
                9396=>
                15,
                9397=>
                15,
                9398=>
                15,
                9399=>
                15,
                9400=>
                15,
                9401=>
                15,
                9402=>
                15,
                9403=>
                15,
                9404=>
                15,
                9405=>
                15,
                9406=>
                15,
                9407=>
                15,
                9408=>
                15,
                9409=>
                15,
                9410=>
                10,
                9411=>
                10,
                9412=>
                10,
                9413=>
                10,
                9414=>
                15,
                9415=>
                15,
                9416=>
                15,
                9417=>
                15,
                9418=>
                15,
                9419=>
                15,
                9420=>
                15,
                9421=>
                15,
                9422=>
                15,
                9423=>
                15,
                9424=>
                15,
                9425=>
                15,
                9426=>
                15,
                9427=>
                15,
                9428=>
                15,
                9429=>
                15,
                9430=>
                15,
                9431=>
                15,
                9432=>
                15,
                9433=>
                15,
                9434=>
                15,
                9435=>
                15,
                9436=>
                15,
                9437=>
                15,
                9438=>
                15,
                9439=>
                15,
                9440=>
                15,
                9441=>
                15
            ];
            

            $registros_corregidos = 0;
            $registros_corregidos2 = 0;

            $conexion_migracion_prueba->beginTransaction();

            foreach($array_familias_corregidas as $id_inventario => $id_subgrupo){

                try{

                    $update_inventario = $conexion_migracion_prueba->prepare("UPDATE dt_inventario SET id_subgrupo = :id_subgrupo WHERE id_inventario = :id_inventario");

                    $update_inventario->execute([
                        'id_subgrupo' => $id_subgrupo,
                        'id_inventario' => $id_inventario
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "Hubo un problema corrigiendo el subgrupo en el id_inventario ".$id_inventario."\n<br>".$e->getMessage();exit;
                }

                $registros_corregidos++;

            }
            foreach($array_medidas_corregidas as $id_inventario => $id_medida){

                try{

                    $update_inventario = $conexion_migracion_prueba->prepare("UPDATE dt_inventario SET id_medida = :id_medida WHERE id_inventario = :id_inventario");

                    $update_inventario->execute([
                        'id_medida' => $id_medida,
                        'id_inventario' => $id_inventario
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "Hubo un problema corrigiendo la medida en el id_inventario ".$id_inventario."\n<br>".$e->getMessage();exit;
                }

                $registros_corregidos2++;

            }

            $conexion_migracion_prueba->commit();

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Corrección dt_inventario completada ".$registros_corregidos." registros corregidos en subgrupo y ".$registros_corregidos2." registros corregidos en medida ".". Correcciones completadas en ".$tiempo_transcurrido." segundos";

            return $mensaje;

        }

        public static function actualizaRegistrosNuevosTablasOz($conexion_migracion_prueba){

            //Iniciamos timer

            $tiempo_inicio = microtime(true);

            //dt_clientes 

            try{
                $conexion_migracion_prueba->exec("

                    INSERT INTO dt_clientes
                    (id_cliente, estado, potencial, objetivo, nom_empresa, id_usuario, nit, dig_verificacion, fecha_ingreso, fecha_actualizacion, usuario_actualizador, direccion, telefono, email_empresa, pagina_web, 
                    contacto, sector, area, telefono_contacto, cargo_contacto, email_contacto, fecha_nac_contacto, direccion_contacto, gustos, representante_legal, cedula_representante_legal, celular_representante_legal,
                    facturacion, id_pais, importancia_1, importancia_2, importancia_3, importancia_4, intereses_compras, intereses_mercadeo, intereses_proyectos, id_ciudad, id_regimen, id_forma_pago, id_geografia)
                    VALUES(2744, 1, 0, 1, 'YULY MAYERLY CABALLERO LEON', 54, '1070706941',0, '2023-09-20 16:20:58', '2023-09-20 16:22:00', 54, 'CR 2 18 168 CENTRO', '3102618705', 'caballero.yuly@gmail.com',
                    '', '', '', '', '', '', '', '0001-01-01', '', '', 'YULY MAYERLY CABALLERO LEON', 0,  0,  '',1, 0, 0, 0, 0, '', '', '', 15, 3, 0,NULL);


                    INSERT INTO dt_clientes
                    (id_cliente, estado, potencial, objetivo, nom_empresa, id_usuario, nit, dig_verificacion, fecha_ingreso, fecha_actualizacion, usuario_actualizador, direccion, telefono, email_empresa, pagina_web, 
                    contacto, sector, area, telefono_contacto, cargo_contacto, email_contacto, fecha_nac_contacto, direccion_contacto, gustos, representante_legal, cedula_representante_legal, celular_representante_legal,
                    facturacion, id_pais, importancia_1, importancia_2, importancia_3, importancia_4, intereses_compras, intereses_mercadeo, intereses_proyectos, id_ciudad, id_regimen, id_forma_pago, id_geografia)
                    VALUES(2745, 1, 0, 1, 'FORMAS TRENDY S A S', 54, '901502103',3, '2023-11-08 09:08:10', '2023-11-08 09:08:10', 54, 'CL 68 23 36', '3103396111', 'formastrendy@gmail.com',
                    '', '', '', '', '', '', '', '0001-01-01', '', '', '', 0,  0,  '',1, 0, 0, 0, 0, '', '', '', 1, 2, 41, NULL);


                    INSERT INTO dt_clientes
                    (id_cliente, estado, potencial, objetivo, nom_empresa, id_usuario, nit, dig_verificacion, fecha_ingreso, fecha_actualizacion, usuario_actualizador, direccion, telefono, email_empresa, pagina_web, 
                    contacto, sector, area, telefono_contacto, cargo_contacto, email_contacto, fecha_nac_contacto, direccion_contacto, gustos, representante_legal, cedula_representante_legal, celular_representante_legal,
                    facturacion, id_pais, importancia_1, importancia_2, importancia_3, importancia_4, intereses_compras, intereses_mercadeo, intereses_proyectos, id_ciudad, id_regimen, id_forma_pago, id_geografia)
                    VALUES(2746, 1, 0, 1, 'INGRAS S A S', 178, '901256344',6, '2024-02-13 16:23:01', '2024-02-13 16:24:40', 178, 'CR 48 98 A SUR 112', '3223118', 'contabilidad@ingras.com.co',
                    '', '', '', '', '', '', '', '0001-01-01', '', '', '', 0,  0,  '',1, 0, 0, 0, 0, '', '', '', 3, 2, 0,10);

                ");
            }catch(PDOException $e){
                echo "Hubo un error en la actualización de los registros nuevos de la tabla dt_clientes "."\n<br>".$e->getMessage();
            }

            //dt_inffac_cli

            try{
                $conexion_migracion_prueba->exec("

                    INSERT INTO dt_inffac_cli
                    (id_inffac_cli, cuenta_contable, descuento_ica, cupo_credito, cupo_contrato, aprobado_por, cod_clasitri, tipo_identificacion, tipo_persona, declarante, agente_retenedor, benefactor_rtiva, agente_rtiva, rete_garantia, meses_garantia, valor_rt_garantia, rt_fuente_renta, entidad_publica, cod_entidad_publica, razon_social, comision_coorporativa, id_cliente)
                    VALUES(1899, '0', '', NULL, '0', 0, NULL, 0, 2, 2, 0, 2, 0, 0, 0, '0', 0, 0, '', 0, '', 2744);
                    
                    INSERT INTO dt_inffac_cli
                    (id_inffac_cli, cuenta_contable, descuento_ica, cupo_credito, cupo_contrato, aprobado_por, cod_clasitri, tipo_identificacion, tipo_persona, declarante, agente_retenedor, benefactor_rtiva, agente_rtiva, rete_garantia, meses_garantia, valor_rt_garantia, rt_fuente_renta, entidad_publica, cod_entidad_publica, razon_social, comision_coorporativa, id_cliente)
                    VALUES(1900, '0', '', NULL, '0', 0, NULL, 1, 1, 1, 0, 2, 0, 0, 0, '0', 0, 0, '', 0, '', 2745);
                    
                    INSERT INTO dt_inffac_cli
                    (id_inffac_cli, cuenta_contable, descuento_ica, cupo_credito, cupo_contrato, aprobado_por, cod_clasitri, tipo_identificacion, tipo_persona, declarante, agente_retenedor,
                    benefactor_rtiva, agente_rtiva, rete_garantia, meses_garantia, valor_rt_garantia, rt_fuente_renta, entidad_publica, cod_entidad_publica, razon_social, comision_coorporativa, id_cliente)
                    VALUES(1901, '0', '', NULL, '0', 0, NULL, 1, 1, 1, 0, 2, 0, 0, 0, '0', 0, 0, '', 0, '', 2746);

                ");
            }catch(PDOException $e){
                echo "Hubo un error en la actualización de los registros nuevos de la tabla dt_inffac_cli "."\n<br>".$e->getMessage();
            }

            //dt_macro_proyecto 

            try{
                $conexion_migracion_prueba->exec("
                    INSERT INTO dt_macro_proyecto
                    (id_macro_proyecto, nombre_proyecto, observacion, fecha_final, fecha_registro, id_user, id_cliente, nit)
                    VALUES(118, 'Suministro de Avisos+ flechas+ señaletica contrato 4600005009', '', '2024-12-31', '2023-09-04 15:30:17', 742, 622, 830095213);
                    
                    INSERT INTO dt_macro_proyecto
                    (id_macro_proyecto, nombre_proyecto, observacion, fecha_final, fecha_registro, id_user, id_cliente, nit)
                    VALUES(119, 'Suministro de Avisos de Reinversión contrato 4600005009', '', '2024-12-30', '2023-09-04 15:30:53', 742, 622, 830095213);
                    
                    INSERT INTO dt_macro_proyecto
                    (id_macro_proyecto, nombre_proyecto, observacion, fecha_final, fecha_registro, id_user, id_cliente, nit)
                    VALUES(120, 'Señaletica Mantenimiento Terpel bajo OC', '', '2024-12-31', '2023-10-30 10:27:48', 742, 622, 830095213);
                    
                    INSERT INTO dt_macro_proyecto
                    (id_macro_proyecto, nombre_proyecto, observacion, fecha_final, fecha_registro, id_user, id_cliente, nit)
                    VALUES(121, 'Venta Laminas Verdes Biomax', '', '2024-02-29', '2023-10-30 10:27:48', 742, 2745, 901502103);
                    
                    INSERT INTO dt_macro_proyecto
                    (id_macro_proyecto, nombre_proyecto, observacion, fecha_final, fecha_registro, id_user, id_cliente, nit)
                    VALUES(122, 'Productos de imagen MVI (imagen nueva)', '', '2024-12-30', '2023-11-22 10:07:33', 742, 2728, 900072847);
                    
                    INSERT INTO dt_macro_proyecto
                    (id_macro_proyecto, nombre_proyecto, observacion, fecha_final, fecha_registro, id_user, id_cliente, nit)
                    VALUES(124, 'DiseÃ±o, Suministro, Fabricación e Instalación de la Señalizacion del portico Connecta 26 ', '', '2024-12-27', '2023-12-21 09:02:31', 11, 2731, 901122122);
                    
                    INSERT INTO dt_macro_proyecto
                    (id_macro_proyecto, nombre_proyecto, observacion, fecha_final, fecha_registro, id_user, id_cliente, nit)
                    VALUES(125, 'Mantenimiento Aviso Hotel Cartagena Bocagrande ', '', '2025-01-31', '2024-02-05 13:08:16', 742, 2539, 900748621);
                ");
            }catch(PDOException $e){
                echo "Hubo un error en la actualización de los registros nuevos de la tabla dt_macro_proyecto "."\n<br>".$e->getMessage();

            }

            //dt_proveedores

            try{
                $conexion_migracion_prueba->exec("
                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2093, 'SERVIMETERS S.A.S.', 5, 2, 'CR 20 C 74 A 10', 41, '2100833', '3164722914', '2023-09-04', 'asistente.facturacion4@servimeters.com', 'NA', '', '', 2, 0, '830117370', 0, 0, 41);


                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2094, 'MONCADA MALDONADO ERIKA PAOLA', 8, 3, 'CN Tocancipa sopo', 15, '3007422483', '3208901392', '2023-09-04', 'erikam1302@hotmail.com', 'NA', '', 'SISO', 2, 0, '1078348871', 0, 0, 22);

                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2095, 'IMPORTADORA UNLIMITED MARKET S.A.S.', 9, 2, 'CL 68 B BIS 70 83', 1, '5409098', '3107832645', '2023-09-07', 'andreacontreras@unlimitedmk.com', 'NA', '', 'IMPORTADORA', 2, 0, '830097133', 0, 0, 41);


                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2096, 'RAMIREZ RODRIGUEZ EDWARD DAVID', 0, 3, 'CL 147 98 B 92', 1, '3227241120', '', '2023-09-10', 'info@hseqlife.com', 'NA', '', 'AUDITORIA SGSST', 2, 0, '80814278', 0, 0, 41);

                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2097, 'RAMIREZ MOLINA KAREN JOHANNA', 0, 3, 'CR 1 SUR 78 B 39', 1, '3502992983', '', '2023-09-12', 'ramirejohanna932@gmail.com', 'NA', '', 'SUMINISTRO DESAYUNOS', 2, 0, '1022417856', 0, 0, 41);

                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2098, 'VARGAS MUOZ MARLON DAVID', 0, 3, 'KM 114 CRT LA CORDIALIDAD KM 3 CRV BARRANQUILLA', 1, '8141665', '', '2023-09-12', 'marlondavid1@hotmail.com', 'NA', '', 'SERVICIO DE SONIDO EVENTOS', 2, 0, '94456740', 0, 0, 41);

                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2099, 'STECKERL ACEROS SAS', 2, 4, 'CR 27 120 503 TO B AP 101 CON SAN FELIPE 1', 5, '3850707', '', '2023-01-18', 'mailen.ferrer@steckerlaceros.com', 'NA', '', 'ACEROS', 2, 0, '900499032', 0, 0, 189);


                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2100, 'VELANDIA GARCIA NELSO', 7, 3, 'TV 70 G 65 59 SUR', 1, '3103429383', '', '2023-09-18', 'NA', 'NA', '', 'MANTENIMIENTO GRAPADORA SENCO', 2, 0, '79547465', 0, 0, 41);


                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2101, 'ESCOBAR SALAMANCA HERNANDO', 0, 3, 'CR 78 23 51', 15, '3144233770', '', '2023-10-23 ', 'hescobars@hotmail.com', 'NA', '', 'MATERIAL', 1, 0, '9526069', 0, 0, 22);

                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2102, 'OSORIO CRIOLLO EDNA MAYERLY', 0, 3, 'CON TEJARES DE LA LOMA I MZ 11 CA 14', 26, '3503836', '3133321806', '2023-10-31 ', 'dennis0105@hotmail.com', 'NA', '', 'SISO', 2, 0, '28542907', 0, 0, 33);


                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2103, 'OFIGUEROA COGOLLOS FABIAN ALONSO', 6, 2, 'CR 24 42 A 05 SUR', 1, '6013589018', '3183119645', '2023-11-03 ', 'fabianfig@hotmail.com', 'NA', '', 'EQUIPOS DE PINTURA ELECTROSTÃTICA', 2, 0, '79867608', 0, 0, 41);

                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2104, 'R.C. LIZ CAUCHOS E.U.', 0, 2, 'CR 30 8 55', 1, '2379259', '', '2023-11-06 ', 'rclizcauchos@hotmail.com', 'NA', '', 'EMPAQUES', 2, 0, '900195267', 0, 0, 41);


                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2105, 'L A C LOGISTICA ANDINA DE CARGA SAS', 0, 2, 'CR 34 A 3 53', 1, '3754355', '3112639147', '2023-11-08 ', 'logisticaandinadecarga@hotmail.com', 'NA', '', 'LOGISTICA', 2, 0, '800213907', 0, 0, 41);


                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2106, 'NYCE COLOMBIA S A S', 0, 2, 'CL 30 17 52', 1, '7568485', '', '2023-11-08 ', 'wvizcaino@nycecolombia.co', 'NA', '', 'PRUEBAS ILUMINACION', 2, 0, '900799375', 0, 0, 41);


                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2107, 'F&MAN SAS', 0, 2, 'DG 77 123 A 88 OF 93', 1, '8143045', '', '2023-11-14 ', 'fredtauro@hotmail.com', 'NA', '', 'LOGISTICA', 2, 0, '900898218', 0, 0, 41);


                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2108, 'CUBILLOS MORENO JUAN CAMILO', 0, 3, 'CL 69 A 115 C 40', 1, '7522496', '3214846427', '2023-11-17 ', 'ferresolucionesmda@gmail.com', 'NA', '', 'EPP', 2, 0, '1016073892', 0, 0, 41);


                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2109, 'GRUAS PEREIRA S.A.S.', 0, 2, 'KM 10 VIA PEREIRA ARMENIA VDA GUACARI', 26, '3152340', '', '2023-11-17 ', 'administracion@ayax.com.co', 'NA', '', 'GRUAS', 2, 0, '900150406', 0, 0, 33);

                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2110, 'TAPIERO BERMUDEZ MARIA CONSUELO', 0, 2, 'CR 107 75 D 5', 1, '6014557493', '3203648387', '2023-12-04', 'majo.1223-mary@hotmail.com', 'NA', '', 'SISO', 2, 0, '1105306662', 0, 0, 41);

                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2111, 'LA DIVINA COMEDIA S.A.S.', 0, 2, 'CR 9 94 A 32 OF 202', 1, '3124491490', '', '2023-12-06 ', 'rutdivinacomedia@andresexpres.co', 'NA', '', 'SUMINISTRO ALIMENTOS', 2, 0, '901285057', 0, 0, 41);

                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2112, 'CORONADO GARCIA JHONATAN JOSE', 0, 3, 'CL 69 20 E 91 BRR LAS MORAS', 5, '3043386523', '3043386523', '2023-12-11 ', 'jhoncorodesalud@hotmail.com', 'NA', '', 'SISO', 2, 0, '1129581615', 0, 0, 12);

                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2113, 'JULIO DIAZ SHIRLI PATRICIA', 0, 3, 'BRR LOS CALAMARES MZ 77 INT 9 ET 5', 5, '3215150195', '', '2023-12-14 ', 'shirleysjulio@hotmail.com', 'NA', '', 'SISO', 2, 0, '1143338950', 0, 0, 12);

                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2114, 'OROZCO FLOREZ JENNY MARCELA', 0, 3, 'CR 10 9 A 08 BRR LA ALDEA DE MARIA', 8, '8907447', '3213776101', '2023-12-19 ', 'orozcojenny425@gmail.com', 'NA', '', 'SISO', 2, 0, '1060653537', 0, 0, 15);


                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2115, 'LOZANO MORA JUAN DANIEL', 4, 3, 'CR 58 C 134 A 51', 1, '3112884219', '', '2024-01-05', 'jdlozanom@unal.edu.co', 'NA', '', 'ANCHETAS', 2, 0, '1019058220', 0, 0, 41);

                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2117, 'OCHICA SALAMANCA OSWALDO', 4, 3, 'VDA ROMITA', 7, '3143629552', '', '2024-01-05', 'oswaldo.ochica@hotmail.com', 'NA', '', 'ANCHETAS', 2, 0, '79554372', 0, 0, 372);

                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2118, 'SUMI-INGENIERIA SAS', 0, 2, 'CR 77 K 65 B 73 SUR', 1, '3503374568', '', '2024-01-22', 'sumiingenieria@gmail.com', 'NA', '', 'FERRETERIA', 2, 0, '901542622', 0, 0, 41);

                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2119, 'LAC LOGISTICA DE CARGA S.A.S', 5, 2, 'CR 53 14 67', 1, '311639147', '', '2024-01-12', 'logisticadecarga2023@gmail.com', 'NA', '', 'TRANSPORTE LOGISTICA', 2, 0, '901707778', 1, 0, 41); 


                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2120, 'ALMASERVICE SAS', 6, 2, 'CL 168 23 20', 1, '3105895582', '3104885821', '2024-02-07', 'contabilidad@almaservice.com.co', 'NA', '', 'ACM', 2, 0, '900582792', 0, 0, 41); 


                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2121, 'CREANDO PUBLICIDAD IMAGEN SAS', 0, 2, 'CR 78 H 26 36 SUR BL 21', 1, '3023631423', '3002755646', '2024-02-01', 'creandopublicidadimagen@gmail.com', 'NA', '', 'CONTRATISTA INSTALACION', 2, 0, '901790487', 0, 0, 41); 


                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2122, 'COLMALLAS S.A.', 6, 2, 'CL 12 37 53', 1, '36082211', '', '2024-02-12', 'impuestos@colmallas.com', 'NA', '', 'LAMINAS - MALLAS', 2, 0, '860066875', 0, 0, 41); 



                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2123, 'TI TRANSPORTE E IZAJE SAS', 0, 2, 'CR 17 65 113 APTO 502 EDIFICIO ALEJANDRA', 28, '3173636588', '3133925010', '2024-02-19', 'TYTRANSPORTEIzAJESAS@GMAIL.COM', 'NA', '', 'GRUAS', 2, 0, '901789173', 0, 0, 966); 


                    INSERT INTO dt_proveedores
                    (id_proveedores, empresa, dig_verificacion, id_regimen, direccion, id_ciudad, telefono, celular, fecha_ingreso, email, contacto, celular_contacto, descripcion, id_clase_proveedor, id_forma_pago, nit, id_tipo_pago, rtefuente_renta, id_geografia)
                    VALUES(2124, 'HINCAPIE MORALES NATALY', 0, 3, 'CR 4 22 31 BRR LA CEIBA AP 1108', 8, '31051000778', '', '2024-02-26', 'Tlorenata0827@gmail.com', 'NA', '', 'SISO', 2, 0, '30361658', 0, 0, 10);
                ");
            }catch(PDOException $e){
                echo "Hubo un error en la actualización de los registros nuevos de la tabla dt_proveedores "."\n<br>".$e->getMessage();

            }

            //dt_inf_contable_provee


            try{
                $conexion_migracion_prueba->exec("
                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2093, 0.08, '2', 0, 0, 220505, 23680102, '', 0.01104, '', 0, 2093);



                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2094, 0.08, '1', 0, 0, 220506, 0, '', 0, '', 0, 2094);

                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2095, 0.08, '1', 0, 0, 220505, 23680102, '', 0.01104, '', 0, 2095);


                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2096, 0.08, '1', 0, 0, 220506, 23680103, '', 0.00966, '', 0, 2096);

                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2097, 0.08, '1', 0, 0, 220506, 23680102, '', 0.01104, '', 0, 2097);



                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2098, 0.08, '1', 0, 0, 220506, 23680103, '', 0.00966, '', 0, 2098);

                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2099, 0.08, '2', 0, 0, 220505, 23680102, '', 0.01104, '', 0, 2099);


                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2100, 0.08, '1', 0, 0, 220506, 23680103, '', 0.00966, '', 0, 2100);


                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2101, 0.08, '1', 0, 0, 220506, 23680102, '', 0.01104, '', 0, 2101);

                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2102, 0.08, '1', 0, 0, 220506, 23680102, '', 0.01104, '', 0, 2102);


                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2103, 0.08, '1', 0, 0, 220505, 23680102, '',0.01104, '', 0, 2103);


                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2104, 0.08, '1', 0, 0, 220505, 23680102, '', 0.01104, '', 0, 2104);

                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2105, 0.08, '1', 0, 0, 220506, 23680104, '', 0.00414, '', 0, 2105);


                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2106, 0.08, '1', 0, 0, 220505, 23680102, '',0.01104, '', 0, 2106);

                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2107, 0.08, '1', 0, 0, 220506, 23680103, '',0.00966, '', 0, 2107);

                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2108, 0.08, '1', 0, 0, 220505, 23680102, '', 0.01104, '', 0, 2108);


                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2109, 0.08, '1', 0, 0, 220506, 23680102, '',0.01104, '', 0, 2109);




                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2110, 0.08, '1', 0, 0, 220506, 23680103, '', 0.00966, '', 0, 2110);

                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2111, 0.08, '1', 0, 0, 220505, 23680102, '', 0.01104, '', 0, 2111);


                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2112, 0.08, '1', 0, 0, 220506, 23680102, '',0.01104, '', 0, 2112);

                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2113, 0.08, '1', 0, 0, 220506, 23680102, '',0.00966, '', 0, 2113);

                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2114, 0.08, '1', 0, 0, 220506, 23680102, '', 0.01104, '', 0, 2114);


                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2115, 0.08, '1', 0, 0, 220506, 23680102, '',0.01104, '', 0, 2115);



                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2116, 0.08, '1', 0, 0, 220506, 23680102, '', 0.01104, '', 0, 2116);

                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2117, 0.08, '1', 0, 0, 220505, 23680102, '', 0.01104, '', 0, 2117);


                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2118, 0.08, '1', 0, 0, 220506, 23680104, '',0.00414, '', 0, 2118);

                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2119, 0.08, '1', 0, 0, 220506, 23680103, '',0.00966, '', 0, 2119);

                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2120, 0.08, '1', 0, 0, 220505, 23680102, '', 0.01104, '', 0, 2120);


                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2121, 0.08, '1', 0, 0, 220505, 23680102, '',0.01104, '', 0, 2121);


                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2123, 0.08, '1', 0, 0, 220506, 23680102, '',0.01104, '', 0, 2123);

                    INSERT INTO dt_inf_contable_prove
                    (id_inf_contable_prove, rteica, autoret, aporte_especial, vr_aporte, cuenta_contable, cuenta_con_ica, ica_prove, desc_ica, cupo_credito, aprobado_por, id_proveedores)
                    VALUES(2124, 0.08, '1', 0, 0, 220506, 23680102, '',0.01104, '', 0, 2124);
                ");
            }catch(PDOException $e){
                echo "Hubo un error en la actualización de los registros nuevos de la tabla dt_inf_contable_provee "."\n<br>".$e->getMessage();

            }


            //dt_codprodfinal
 

            try{
                $conexion_migracion_prueba->exec("
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13462, 'AV-438l-1', 1, 'AV-438l-1 MÓDULO ALTOQUE 2 CARAS PARA TÓTEM PYLON 10 O 15M - TERPEL COLOMBIA', 1.15, 1.88, 0.65, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13463, 'AV-439d', 6, 'AV-439d ACM ROJO PARA REINVERSIÓN PYLON 15 METROS - TERPEL COLOMBIA', 0, 0, 0, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13464, 'AV-439f', 1, 'AV-439f PANTALLAS DIGITALES PARA PYLON 15 METROS 3P2C REINV. - TERPEL COLOMBIA', 0, 0, 0, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13465, 'AV-438m4', 1, 'AV-438m4 DISPLAY PARA TÓTEM 10M O 7M 3P1C (PANTALLAS RECTEECH 12 pulgadas) - TERPEL COLOMBIA', 1.82, 1.78, 0.6, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13466, 'AVA-248q', 5, 'AVA-248q CIMENTACIÓN PARA TÓTEM PYLON 10 METROS ZONA NORTE - TERPEL COLOMBIA', 0, 0, 0, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13467, 'AVA-248r', 5, 'AVA-248r CIMENTACIÓN PARA TÓTEM PYLON 15 METROS ZONA NORTE - TERPEL COLOMBIA', 0, 0, 0, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13468, 'AVA-254', 5, 'AVA-254 TRANSPORTE TÓTEM + GRUA PARA IZAJE DE PYLON 10 METROS ZONA NORTE - TERPEL COLOMBIA', 0, 0, 0, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13469, 'AVA-254a', 5, 'AVA-254a TRANSPORTE TÓTEM + GRUA PARA IZAJE DE PYLON 15 METROS ZONA NORTE - TERPEL COLOMBIA', 0, 0, 0, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13470, 'AVA-254b', 5, 'AVA-254b INSTALACIÓN TÓTEM PYLON DE 7,10 Y 15 METROS ZONA NORTE + SEÑALETICA + FLECHAS - TERPEL COLOMBIA', 0, 0, 0, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13471, 'AVA-254c', 5, 'AVA-254c DIAGNÓSTICO ZONA NORTE TERPEL COLOMBIA', 0, 0, 0, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13472, 'AVA-254e', 1, 'AV-439e ACM ROJO PARA REINVERSIÓN PYLON 10 METROS - TERPEL COLOMBIA', 0, 0, 0, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13473, 'AVA-248x', 5, 'AVA-248x ACOMPAÑAMIENTO SISO REINV. TERPEL COLOMBIA', 0, 0, 0, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13474, 'AVA-249f1', 6, 'AVA-249f1 TRANSPORTE + GRUA PARA IZAJE TÓTEM PYLON 15 METROS ZONA SUR - TERPEL COLOMBIA (EN DOS PARTES)', 0, 0, 0, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13475, 'AVA-249s1', 5, 'AVA-249s1 TRANSPORTE + GRUA PARA IZAJE TÓTEM PYLON 15 METROS ZONA CENTRO - TERPEL COLOMBIA (EN DOS PARTES)', 0, 0, 0, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13476, 'AVA-254a1', 5, 'AVA-254a1 TRANSPORTE + GRUA PARA IZAJE TÓTEM PYLON 15 METROS ZONA NORTE - TERPEL COLOMBIA (EN DOS PARTES)', 0, 0, 0, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13477, 'AVA-249v1', 5, 'AVA-249v1 TRANSPORTE + GRUA PARA IZAJE DE TÓTEM PYLON 15 METROS ZONA ANTIOQUIA - TERPEL COLOMBIA (EN DOS PARTES)', 0, 0, 0, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13478, 'AV-5006B', 0, 'AV-5006B AVISO TIPO COLOMBINA 3P1C EN GALVANIZADA ', 0, 0, 0, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 819001667);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13479, 'AV-439g', 0, 'AV-439g PANTALLAS DIGITALES PARA PYLON 10 METROS 3P2C REINV. - TERPEL COLOMBIA', 6, 1.6, 0.24, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13480, 'AV-434b2', 1, 'AV-434b2 BASES DE TRANSPORTE DE CABEZOTE + HUACAL PARA LOGO', 0, 0, 0, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13481, 'AVA-266', 5, 'AVA-266 SERVICIO DE INSTALACIÓN DE CABEZOTE REINV TERPEL PANAMÃ - CIUDAD DE PANAMÃ', 0, 0, 0, 0, 2722, 4, '', NULL, '', 'B', NULL, 0, 1019225108400);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13482, 'AVA-266A', 5, 'AVA-266a SERVICIO DE INSTALACIÓN DE CABEZOTE REINV TERPEL PANAMÃ - DARIÃ‰N', 0, 0, 0, 0, 2722, 4, '', NULL, '', 'B', NULL, 0, 1019225108400);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13483, 'AVA-266b', 5, 'AVA-266b SERVICIO DE INSTALACIÓN DE CABEZOTE REINV TERPEL PANAMÃ - COLÓN Y PANAMA OESTE', 0, 0, 0, 0, 2722, 4, '', NULL, '', 'B', NULL, 0, 1019225108400);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13484, 'AVA-266c', 5, 'AVA-266c SERVICIO DE INSTALACIÓN DE CABEZOTE REINV TERPEL PANAMÃ - COCLÃ‰', 0, 0, 0, 0, 2722, 4, '', NULL, '', 'B', NULL, 0, 1019225108400);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13485, 'AVA-266d', 5, 'AVA-266d SERVICIO DE INSTALACIÓN DE CABEZOTE REINV TERPEL PANAMÃ - BOCAS DEL TORO', 0, 0, 0, 0, 2722, 4, '', NULL, '', 'B', NULL, 0, 1019225108400);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13486, 'AVA-266e', 5, 'AVA-266e TRANSPORTE DE PUERTO A EDS (VALOR APLICA TODAS LAS ZONAS)', 0, 0, 0, 0, 2722, 4, '', NULL, '', 'B', NULL, 0, 1019225108400);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13487, 'AVA-266f', 5, 'AVA-266f EMBALAJE PARA CABEZOTE DE REINVERSIÓN TERPEL PANAMA', 0, 0, 0, 0, 2722, 4, '', NULL, '', 'B', NULL, 0, 1019225108400);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13488, 'AVA-266G', 5, 'AVA-266g MATERIAL INSTALACIÓN CABEZOTE REINV. TERPEL PANAMA', 0, 0, 0, 0, 2722, 4, '', NULL, '', 'B', NULL, 0, 1019225108400);
                    
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13489, 'AVA-267', 5, 'AVA-267 EXPORTACIÓN CABEZOTE REINVERSION TERPEL PANAMÃ', 0, 0, 0, 0, 2722, 4, '', NULL, '', 'B', NULL, 0, 1019225108400);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13490, 'AVA-267a', 5, 'AVA-267a IMPORTACIÓN CABEZOTE REINVERSIÓN TERPEL PANAMÃ', 0, 0, 0, 0, 2722, 4, '', NULL, '', 'B', NULL, 0, 1019225108400);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13491, 'AV-4080', 1, 'AV-4080 TÓTEM SHELL 7 METROS', 7.25, 1.81, 0.36, 0, 2728, 4, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13492, 'AV-4080-1', 1, 'AV-4080-1 PRODUCTOS PARA TÓTEM SHELL 7 METROS (SUPER/V-POWER/DIESEL V-POWER))', 0, 0, 0, 0, 2728, 4, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13493, 'AV-4081', 1, 'AV-4081 PANEL DE FASCIA DUAL COLOR DE 270 CM DE LONGITUD', 0.6, 2.7, 0.05, 0, 2728, 4, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13494, 'AV-4081a', 1, 'AV-4081a PANEL DE FASCIA BLANCO DE 270 CM DE LONGITUD', 0.6, 2.7, 0.05, 0, 2728, 4, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13495, 'AV-4081b', 6, 'AV-4081b PANEL DE TRANSICIÓN DUAL COLOR', 0.6, 2.7, 0.05, 0, 2728, 4, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13496, 'AV-4082', 1, 'AV-4082 FLOACTING PECTEN PARA FASCIA DE 135 CM DE ALTURA', 1.43, 1.41, 0.95, 0, 2728, 4, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13497, 'AV-4083', 1, 'AV-4083 PUMP NUMBER SHELL DE 30 CM DE ALTURA', 0.3, 0.395, 0.026, 0, 2728, 4, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13498, 'AV-4084', 1, 'AV-4084 SPREADER NO ILUMINADO DE SHELL', 0.6, 1.6, 0.12, 0, 2728, 4, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13499, 'AV-4085', 1, 'AV-4085 POSTER A2 DE SHEL', 0.87, 0.45, 0.054, 0, 2728, 4, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13500, 'AV-4086', 1, 'AV-4086 AVISO DIRECCIONAL GRANDE SHELL X 1 CARA', 1.71, 0.8, 0.3, 0, 2728, 4, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13501, 'AV-4014-3', 1, 'AV-4014-3 PRODUCTOS PARA TÓTEM BIOMAX 2.0 CON DYNAMAX (CORRIENTE - DIESEL - DIESEL DYNAMAX)', 0, 0, 0, 0, 2001,4,'', NULL, '', 'B', NULL, 0, 830136799);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13502, 'AV-439h', 1, 'AV-439h PANTALLAS DIGITALES PARA PYLON 10 METROS 4P2C REINV. - TERPEL COLOMBIA', 0, 0, 0, 0, 622,4,'', NULL, '', 'B', NULL, 0, 830095213);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13503, 'AV-438m5', 1, 'AV-438m5 DISPLAY PARA TÓTEM 10M O 7M 2P1C (PANTALLAS RECTEECH 12 pulgadas) - TERPEL COLOMBIA', 1.38, 1.74, 0.6, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13504, 'AV-439i', 1, 'AV-439i PANTALLAS DIGITALES PARA PYLON 15 METROS 2P2C REINV. - TERPEL COLOMBIA', 0, 0, 0, 0, 622,4,'', NULL, '', 'B', NULL, 0, 830095213);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13505, 'AV-438h-1 ', 1, 'AV-438h-1 FLECHA (ENTRADA) (CON CANTONERA ROJA) TERPEL COLOMBIA', 0.94, 0.85, 0.2, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13506, 'AV-4086a', 1, 'AV-4086a AVISO DIRECCIONAL PEQUEÑO SHELL X 1 CARA', 1.52, 0.6, 0.3, 0, 622, 4, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13507, 'AV-438i-1 ', 1, 'AV-438i-1 FLECHA (SALIDA) (CON CANTONERA ROJA) TERPEL COLOMBIA', 0.94, 0.85, 0.2, 0, 2743, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13508, 'AV-4087', 1, 'AV-4087 AVISO DE ALTURA MÃXIMA SHELL', 0.21, 1.6, 0.04, 0, 2743, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13509, 'POP-981', 2, 'POP-981 MUEBLE CSU SHELL', 1.595, 0.85, 0.61, 0, 2743, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13510, 'POP-982', 2, 'POP-982 MUEBLE LEADERBOARD SHELL', 1.6, 0.61, 0.15, 0, 2743, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13511, 'AV-4088', 1, 'AV-4088 STICKERS EN VINILO IMPRESO PARA CSU O LEADERBOARD DE SHELL', 0.15, 0.46, 0.001, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13512, 'AV-4081c', 1, 'AV-4081c PANEL DE FASCIA DUAL COLOR ESQUINERO DE RADIO=60cm', 0.6, 0.8, 0.8, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13513, 'AV-4081d', 1, 'AV-4081d PANEL DE FASCIA DUAL COLOR ESQUINERO DE RADIO=16cm', 0.6, 0.8, 0.8,  0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13514, 'AV-4083a', 1, 'AV-4083a PUMP NUMBER DE SHELL DE 60 CM DE ALTURA', 0.6, 0.395, 0.026,  0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13515, 'AV-4083b', 1, 'AV-4083b PUMP NUMBER DE SHELL DE 60 CM DE ALTURA (TAXIS)', 0.6, 0.395, 0.026,  0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13516, 'AV-4083c', 1, 'AV-4083c PUMP NUMBER DE SHELL DE 60 CM DE ALTURA (MOTOS)', 0.6, 0.395, 0.026,  0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13517, 'AV-4083d', 1, 'AV-4083d PUMP NUMBER DE SHELL DE 60 CM DE ALTURA (UREA)', 0.6, 0.395, 0.026,  0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13518, 'AV-4086b', 1, 'AV-4086b AVISO DIRECCIONAL PEQUEÑO SHELL X 2 CARAS', 1.52, 0.6, 0.3,  0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13519, 'AV-4086c', 1, 'AV-4086c AVISO DIRECCIONAL PEQUEÑO X 1 CARA (AIRE)', 1.52, 0.6, 0.3,  0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13520, 'AV-4086d', 1, 'AV-4086d AVISO DIRECCIONAL PEQUEÑO X 1 CARA (ASPIRADORA)', 1.52, 0.6, 0.3,  0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13521,  'AV-4086e', 1, 'AV-4086e AVISO DIRECCIONAL PEQUEÑO X 1 CARA (NITRÓGENO)', 1.52, 0.6, 0.3,  0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13522,  'AV-4089', 1, 'AV-4089 AVISO NOMBRE DE EDS SHELL', 0.2,0.8, 0.05,  0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13523,  'AV-4090', 1, 'AV-4090 TÓTEM SHELL 5 METROS 3P1C',5.15,1.31, 0.26, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13524,  'AV-4091', 1, 'AV-4091 ABRI POSTER SIGN 3P2C (CARA 1 PANTALLAS Y CARA 2 PANTALLAS)',2.45,1.41, 0.26, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13525,  'AV-4090-1', 1, 'AV-4090-1 PRODUCTOS PARA TÓTEM SHELL 5 METROS CONFIG. 3P2C (SUPER/V-POWER/DIESEL V-POWER)',0,0, 0.0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13526,  'AV-4090-2', 1, 'AV-4090-2 PRODUCTOS PARA TÓTEM SHELL 5 METROS CONFIG. 3P1C (SUPER/V-POWER/DIESEL V-POWER)',0,0, 0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13527,  'AV-438-2', 1, 'AV-438-2 CABEZOTE LOGO TERPEL 2 CARAS - PINTADO CON LACA Y CON ESPALDAR DE LOGOS EN ALUMINIO (COLOMBIA)',4.13,2.08, 0.6, 0, 622, 19, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13528,  'AV-4080a', 6, 'AV-4080a TÓTEM SHELL 7 METROS 3P1C',7.25,1.81,0.36, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13529,  'AV-4080-2 ', 1, 'AV-4080-2 PRODUCTOS PARA TÓTEM SHELL 7 METROS CONFIG. 3P1C (SUPER/V-POWER/DIESEL V-POWER))',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13530,  'AV-4090a', 1, 'AV-4090a TÓTEM SHELL 5 METROS 3P2C',5.15,1.31,0.26, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13531,  'AV-4091-1', 1, 'AV-4091-1 PRODUCTOS PARA ABRI POSTER SIGIN CONFIG. 3P2C (SUPER/V-POWER/DIESEL V-POWER)',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13532,  'AVA-331', 5, 'AVA-331 EMBALAJE AVISO TÓTEM SHELL 7 METROS',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13533,  'AVA-331a', 5, 'AVA-331a EMBALAJE AVISO TÓTEM SHELL 5 METROS',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13534, 'AVA-331b', 5, 'AVA-331b EMBALAJE AVISO ABRI SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13535,  'AVA-332', 5, 'AVA-332 EMBALAJE AVISO DIRECCIONAL PEQUEÑO SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13536,  'AVA-332a', 5, 'AVA-332a EMBALAJE AVISO DIRECCIONAL GRANDE SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13537,  'AVA-333', 5, 'AVA-333 EMBALAJE PANEL DE FASCIA 270 CM SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13538,  'AVA-333a', 6, 'AVA-333a  EMBALAJE ESQUINERO DE RADIO DE 60CM DE SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13539,  'AVA-333b', 5, 'AVA-333b EMBALAJE ESQUINERO DE RADIO 16CM SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13540,  'AVA-334', 5, 'AVA-334 EMBALAJE MUEBLE CSU SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13541,  'AVA-335', 5, 'AVA-335 EMBALAJE LEADERBOARD SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13542,  'AVA-336', 5, 'AVA-336 EMBALAJE POSTER A2 SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13543, 'AVA-337', 5, 'AVA-337 EMBALAJE DE SPREADER ILUMINADO O NO ILUMINADO SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13544,  'AVA-338', 5, 'AVA-338 EMBALAJE PUMP NUMBER DE 30 CM DE ALTURA SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13545, 'AVA-338a', 5, 'AVA-338a EMBALAJE PUMP NUMBER DE 60CM DE ALTURA SHELL',0,0,0, 0, 2728, 19,'', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13546, 'AVA-339', 5, 'AVA-339 EMBALAJE FLOACTING PECTEN DE 135CM DE ALTURA DE SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13547, 'AV-439c-1', 1, 'AV-439c-1 CABEZOTE TERPEL PARA TÓTEM PYLON 10 O 15 METROS  - TERPEL COLOMBIA (REINV.)',4.35,2.81,0.6, 0, 622, 19, '', NULL, '', 'B', NULL, 0, 830095213);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13548, 'AVA-328', 5, 'AVA-328 MATERIAL DE INSTALACIÓN TÓTEM 7 Y 5 METROS SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13549, 'AVA-328a', 6, 'AVA-328a MATERIAL INSTALACIÓN PARA AVISO DIRECCIONAL GRANDE O PEQUEÑO DE SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13550, 'AVA-328a', 5, 'AVA-328b MATERIAL INSTALACIÓN PANEL FASCIA DE 270 CM DE LONGITUD SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13551, 'AVA-328b-1', 5, 'AVA-328b-1 MATERIALINSTALACIÓN ESQUINERO R=60 CM SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13552, 'AVA-328b-2', 5, 'AVA-328b-2 MATERIAL INSTALACIÓN ESQUINERO R=16CM SHELL CM ',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13553, 'AVA-328b-3', 5, 'AVA-328b-3 MATERIAL INSTALACIÓN PANEL DE TRANSICIÓN SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13554, 'AVA-328c', 5, 'AVA-328c MATERIAL INSTALACIÓN MUEBLE CSU SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13555, 'AVA-328d', 5, 'AVA-328d MATERIAL INSTALACIÓN LEADERBOARD SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13556, 'AVA-328e', 5, 'AVA-328e MATERIAL INSTALACIÓN POSTER A2 SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13557, 'AVA-328f', 5, 'AVA-328f MATERIAL INSTALACIÓN SPREADER ILUMINADO O NO ILUMINADO DE SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13558, 'AVA-328g', 5, 'AVA-328g MATERIAL INSTALACIÓN PUMP NUMBER DE 30 O 60 CM DE ALTURA SHELLL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13559, 'AVA-328h', 5, 'AVA-328h MATERIAL INSTALACIÓN FLOACTING PECTEN DE 135CM DE ALTURA SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13560, 'AVA-328i', 5, 'AVA-328i MATERIAL INSTALACIÓN AVISO NOMBRE EDS SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13561, 'AVA-328j', 5, 'AVA-328j MATERIAL INSTALACIÓN AVISO ALTURA MÃXIMA SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                    
                    
                    
                    INSERT INTO dt_codprodfinal
                    (id_codprodfinal, cod, id_categoria, nom_codigo, tam_x, tam_y, tam_z, tam_l, id_cliente, id_grupo_inventario, iluminacion, acabados, decoracion, tipo_producto, marca, tipo_presupuesto, nit)
                    VALUES(13562, 'AVA-328k', 1, 'AVA-328k MATERIAL INSTALACIÓN ABRI POSTER SIGN SHELL',0,0,0, 0, 2728, 19, '', NULL, '', 'B', NULL, 0, 900072847);
                
                
                ");
            }catch(PDOException $e){
                echo "Hubo un error en la actualización de los registros nuevos de la tabla dt_codprodfinal "."\n<br>".$e->getMessage();

            }

            //dt_inventario 

            try{
                $conexion_migracion_prueba->exec("

                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9308, '22152092023', '22152092023', NULL, 'VINILO TRANSLUCIDO LG 0.61M - LC2013M ROJO', 11, 300, '1', 6300, 6300, 6300, 1890000, 218, 0.610, 0, 1, 1, 'INGRESO INICIAL', '2023-09-08', 259, 50, 0, 'LG');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9309, '121219', '121219', NULL, 'LED NEXUS STRIP SP160 - 0,72W30-F30 CALIDO 3.100K', 15, 900, '1', 3024.52, 3024.52, 4500, 2722068, 637, 0, 0, 1, 1, 'INGRESO INICIAL', '2023-10-10', 99, 1, 0, 'NEXUS LED');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9310, '9291680', '9291680', NULL, 'TORNILLO HEX G8 1pulgadas X 5pulgadas', 15, 40, '1', 9672, 9672, 12000, 386880, 209, 1.000, 5, 1, 1, 'INGRESO INICIAL', '2023-10-13', 228, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9311, '0602601045', '060260', NULL, 'FLANCHE HIERRO 1/4 - 10 * 6 CON 1 PERF', 15, 1, '1', 72000, 72000, 30000, 72000, 2000, 0, 0, 1, 1, '', '2023-10-13', 0, 0, 0, '');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9312, '20152721', '20152721', NULL, 'TUBO RECTANGULAR HIERRO CAL 3MM DE 200*100', 11, 0, '1', 250000, 250000, 250000, 0, 0, 0, 0, 1, 1, 'INGRESO INICIAL', '2023-10-20', 114, 0, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9313, '20152729', '20152729', NULL, 'TUBO RECTANGULAR HIERRO CAL 4MM DE 200*70', 11, 6, '1', 100316.67, 100316.67, 601900, 2033, 200.000, 70, 0, 1, 1, 'INGRESO INICIAL', '2023-10-24', 114, 0, 1, 'NACIONAL');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9314, '9422004', '9422004', NULL, 'LED NOVA P6HT DOBLE CARA 6W BLANCO', 15, 20, '1', 31689, 31689, 32000, 633780, 637, 0.000, 0,  1, 1, 'INGRESO INICIAL', '2023-11-07', 99, 0, 0, 'VISCOM ');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9315, '94810002', '94810002', NULL, 'LED NOVA 100HTR 2SMD 0,6W ROJO', 15, 480, '1', 3336, 3336, 3400, 1601280, 637, 0.000, 0,  1, 1, 'INGRESO INICIAL', '2023-11-07', 99, 0, 0, 'VISCOM ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9316, '013207227', '013207227', NULL, 'ACM SHELL 3MM 180MM RED+540 YELOW 720 * 2700', 15, 275, '1', 168166.81, 168166.81, 160000, 46245872.75, 637, 720.000, 2700,  1, 1, 'INGRESO INICIAL', '2023-11-07', 206, 0, 0, 'IMPORTADO ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9317, '013207215', '013207215', NULL, 'ACM SHELL 3MM 180MM RED+540 YELOW 720 * 1530', 15, 480, '1', 3336, 3336, 3400, 1601280, 637, 0,0,  1, 1, 'INGRESO INICIAL', '2023-11-07', 206, 0, 0, 'IMPORTADO ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9318, '900130', '900130', NULL, 'PANEL INDICADOR PWM LED BLANCO 12pulgadas DE 4,5 DIGITOS DELANTERO', 0, 1, '1', 1404208, 1404208, 1419000, 1404208, 637, 0,0,  1, 1, 'INGRESO INICIAL', '2023-11-15', 99, 0, 0, 'PWM ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9319, '900135', '900135', NULL, 'PANEL INDICADOR PWM LED BLANCO 16pulgadas DE 4,5 DIGITOS DELANTERO', 0, 1, '1', 1740680, 1740680, 1905000, 1740680, 637, 0,0,  1, 1, 'INGRESO INICIAL', '2023-11-15', 99, 0, 0, 'PWM ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9320, '900140', '900140', NULL, 'PANEL INDICADOR PWM LED BLANCO 16pulgadas DE 4,5 DIGITOS TRASERO', 0, 1, '1', 1905000, 1905000, 1905000, 0, 0, 0,0,  1, 1, 'INGRESO INICIAL', '2023-11-15', 99, 0, 1, 'PWM ');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9321, '10086', '10086', NULL, 'CORAZA PLASTICA ISIFLEX VERDE 3/4', 11, 0, '1', 3100, 3100, 3100, 0, 0, 0,0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 99, 0, 1, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9322, '70191', '70191', NULL, 'GRAPA GALVANIZADA DE 1pulgadas', 15, 0, '1', 19000, 19000, 19000, 0, 0, 0,0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 99, 0, 1, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9323, '220551', '220551', NULL, 'VIDRIO TEMPLADO 4MM - 1620 MM * 1090 MM', 15, 12, '1', 193411, 193411, 300000, 2320932, 678, 1620.000, 1090,  1, 1, 'INGRESO INICIAL', '2023-11-16', 238, 0, 1, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9324, '200412', '200412', NULL, 'TORNILLO LAMINA BROCA HEX ZINC #12 * 7/8pulgadas', 15, 0, '1', 200, 200, 200, 2320932, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 228, 0, 1, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9325, '190311', '190311', NULL, 'SOLDADURA EPOXICA TOPEX ULTRA FUERTE BLISTER * 22 GR', 15, 0, '1', 15000, 15000, 15000, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 146, 0, 1, 'TOPEX ');
                    
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9326, '600313370', '600313370', NULL, 'FLANCHE HIERRO 1 - 56 * 58 CON 5 PERF', 15, 4, '1', 415000, 415000, 360000, 1660000, 2000, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 114, 0, 1, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9327, '600313371', '600313371', NULL, 'FLANCHE HIERRO 1/2 - 12.5 * 12.5', 15,28, '1', 10500, 10500, 15000, 294000, 2000, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 114, 0, 1, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9328, '600313372', '600313372', NULL, 'FLANCHE HIERRO 1/2 - 10.5 * 10.0 CIRCULAR', 15,8, '1', 7500, 7500, 15000, 60000, 2000, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 114, 0, 1, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9329, '600313373', '600313373', NULL, 'FLANCHE HIERRO 1/4 - 14 * 14', 15,4, '1', 6500, 6500, 8000, 26000, 2000, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 114, 0, 1, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9330, '2011107', '2011107', NULL, 'PERFIL HIERRO EN C DE 15 * 10 CAL 1/4pulgadas', 15,4, '1', 10700, 10700, 8000, 42800, 2033, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 114, 0, 1, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9331, '2011108', '2011108', NULL, 'PERFIL HIERRO EN C DE 10 * 10 CAL 1/4pulgadas', 15,8, '1', 8000, 8000, 80000, 64000, 2033, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 114, 0, 1, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9332, '201342', '201342', NULL, 'TUBO CUADRADO HIERRO ESTRUCT CAL 5MM DE 100 * 100', 11,6, '1', 102500, 102500, 120000, 615000, 2033, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 114, 0, 1, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9333, '10861', '10861', NULL, 'LAMINA PET 122 * 244 1,5 MM', 15,0, '1', 130000, 130000, 130000, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 62, 0, 1, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9334, '130191', '130191', NULL, 'MALLA MOSQUITERA PLASTICA GRIS', 11,0, '1', 5000, 5000, 5000, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 62, 0, 1, 'NACIONAL ');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9335, '10036', '10036', NULL, 'ABRAZADERA INOXIDABLE DE 1-3/16pulgadas', 15,0, '1', 8000, 8000, 8000, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 228, 0, 1, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9336, '30281', '30281', NULL, 'CANALETA PLASTICA RANURADA 6 X 8 CM', 15,0, '1', 19000, 19000, 19000, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 99, 0, 1, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9337, '30282', '30282', NULL, 'CANALETA PLASTICA RANURADA 4 X 4 CM', 15,0, '1', 14000, 14000, 14000, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 99, 0, 1, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9338, '50071', '50071', NULL, 'CAUCHO ESPUMA DE 1/4pulgadas (6MM) * 5/8pulgadas (16 MM)', 11,0, '1', 4000, 4000, 4000, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 206, 0, 1, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9339, '10098', '10098', NULL, 'ACOPLE UNION MANGUERA EN T PLASTICO DE 3/4', 15,0, '1', 2000, 2000, 2000, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 99, 0, 1, 'NACIONAL ');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9340, '160790', '160790', NULL, 'PERFIL TRIM 1pulgadas COLOR VERDE', 0,45, '1', 10553, 10553, 11000, 474885, 637, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 206, 0, 0, 'IMPORTADO ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9341, '16136588', '16136588', NULL, 'PINTURA TRAFICO PESADO - ROJO', 15,0, '1', 80000, 80000, 80000, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-11-16', 199, 0, 0, 'PINTUCO ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9342, '120335', '120335', NULL, 'LAMINA ALUMINIO 2MM 1,30 * 2,35', 15,130, '1', 373049, 373049, 233000, 48496370, 637, 130.000, 235,  1, 1, 'INGRESO INICIAL', '2023-11-16', 65, 0, 0, 'IMPORTADO ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9343, '200422', '200422', NULL, 'TORNILLO PUNTA BROCA M8*2pulgadas', 15,0, '1', 2500, 2500, 2500, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-12-04', 18, 0, 1, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9344, '200423', '200423', NULL, 'TORNILLO CAB PLANA M8 8*3/4 PUNTA BROCA', 15,0, '1', 173, 173, 173, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-12-04', 18, 0, 1, 'NACIONAL ');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9345, '200424', '200424', NULL, 'TORNILLO HEXAGONAL M8 8*3/4pulgadas', 15,0, '1', 1580, 1580, 1580, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-12-04', 18, 0, 1, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9346, '200425', '200425', NULL, 'TUERCA M8', 15,0, '1', 565, 565, 565, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-12-04', 18, 0, 1, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9347, '200426', '200426', NULL, 'ARANDELA M8', 15,0, '1', 733, 733, 733, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-12-04', 18, 0, 1, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9348, '419', '419', NULL, 'FLANCHE HIERRO 1/4 - 75 * 30 CON 6 PERFORACIONES', 15,2, '1', 70000, 70000, 2300, 140000, 2000, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-12-04', 114, 0, 1, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9349, '926', '926', NULL, 'FLANCHE HIERRO 1/4 - 10.0 * 8.0 TRIANGULAR', 15,4, '1', 2000, 2000, 2000, 8000, 2000, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-12-04', 114, 0, 0, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9350, '927', '927', NULL, 'FLANCHE HIERRO 1/4 - 8.0 * 5.0 CIRCULAR CON 1 PERFORACIÃ“N', 15,8, '1', 2000, 2000, 11000, 16000, 2000, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-12-04', 114, 0, 1, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9351, '928', '928', NULL, 'FLANCHE HIERRO 1/4 -12.0 * 5.0 CON 2 PERFORACIONES', 15,4, '1', 2500, 2500, 80920, 10000, 2000, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-12-04', 114, 0, 1, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9352, '20573', '20573', NULL, 'BISAGRA BLANCA DE 2/19/32pulgadas', 15,0, '1', 96, 96, 96, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-12-05', 232, 0, 1, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9353, '200451', '200451', NULL, 'TUERCA REMACHE 3/16', 15,0, '1', 45, 45, 45, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-12-05', 228, 0, 1, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9354, '200452', '200452', NULL, 'REMACHE POP 1/8', 15,0, '1', 2500, 2500, 2500, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-12-05', 228, 0, 1, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9355, '202076', '202076', NULL, 'TUBO REDONDO HIERRO DIAMETRO DE 2pulgadas Y ESPESOR DE 2.5MM', 11,0, '1', 2500, 2500, 2500, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-12-04', 114, 0, 1, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9356, '70171', '70171', NULL, 'GRAPA GALVANIZADA DOBLE ALETA DE 2pulgadas', 15,0, '1', 166000, 166000, 166000, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-12-04', 232, 0, 1, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9357, '30464', '30464', NULL, 'TORNILLO BROCA HEX 1/4 * 1pulgadas', 15,0, '1', 321, 321, 321, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-12-04', 228, 0, 1, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9358, '70043', '70043', NULL, 'TORNILLO CAB PAN 316 * 3/4', 15,0, '1', 43, 43, 43, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-12-04', 228, 0, 1, 'NACIONAL ');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9359, '13453', '13453', NULL, 'ANGULO HIERRO 4*3/8', 11,0, '1', 4865, 4865, 4865, 0, 0, 0, 0,  1, 1, 'INGRESO INICIAL', '2023-12-04', 114, 0, 1, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y, estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9360, '2256038004', '2256038004', NULL, 'PINTURA ELECTROSTATICA - BEIGE CHAMPAGNE SEMIMATE (60% BRILLANTE) PANTONE 8004', 7, 0.0, '1', 30000, 30000, 30000, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2023-12-07', 119, 0, 0, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y, estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9361, '2256039016', '2256039016', NULL, 'PINTURA ELECTROSTATICA - BLANCO SEMIMATE (60% BRILLANTE) RAL 9016 CREAR', 7, 50.0, '1', 29600.0, 29600.0, 30000.0, 1480000.0, 138, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2023-12-07', 119, 0, 0, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y, estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9362, '2073', '2073', NULL, 'VINILO LX LC2073M 0.61*50', 11, 50.0, '1', 6300.0, 6300.0, 6300.0, 315000.0, 218, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2023-12-21', 259, 0, 1, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9364, '200292', '200292', NULL, 'TORNILLO CABEZA PAN M4*3,5CM', 15, 168, '1', 40, 40, 350, 6720, 209, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-22', 259, 1, 0, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9365, '200293', '200293', NULL, 'TORNILLO CABEZA PAN M4*2CM', 15, 168, '1', 33, 33, 300, 5544, 209, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-22', 259, 1, 0, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9366, '200294', '200294', NULL, 'TUERCA PLASTICA CIEGA M4', 15, 0, '1', 4700, 4700, 4700, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-22', 259, 1, 0, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9367, '200295', '200295', NULL, 'TUERCA MARIPOSA M4', 15, 0, '1', 400, 400, 400, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-22', 259, 1, 0, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9368, '200296', '200296', NULL, 'TUERCA REMACHE M4', 15, 0, '1', 2200, 2200, 2200, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-22', 259, 1, 0, 'NACIONAL ');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9369, '200297', '200297', NULL, 'PERFIL CAUCHO U 10MM', 10, 0, '1', 6000, 6000, 6000, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-22', 259, 1, 0, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9370, '200298', '200298', NULL, 'BALDE PLASTICO GRIS', 15, 0, '1', 19500, 19500, 19500, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-22', 259, 1, 0, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9371, '610805441', '610805441', NULL, 'FLANCHE HIERRO 3/16 - 13.0 * 8.0 CON 2 PERFORACIONES', 15, 0, '1', 10000, 10000, 10000, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-24', 259, 1, 0, 'NACIONAL ');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9372, '200445', '200445', NULL, 'TUERCA REMACHABLE M5', 15, 0, '1', 600, 600, 600, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-24', 259, 1, 0, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9373, '201435', '201435', NULL, 'CHAZO EXPANSIVO 1/2 * 3', 15, 0, '1',2200, 2200, 2200, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-24', 259, 1, 0, 'NACIONAL ');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9374, '202035', '202035', NULL, 'TORNILLO CABEZA PAN PHILLIPS M5*18MM', 15, 0, '1',900, 900, 900, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-24', 259, 1, 0, 'NACIONAL ');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9375, '20522', '20522', NULL, 'BISAGRA ESQUINERA SET MAGNETICO SOBLE XF-5211 BLANCO', 15, 0, '1',11300, 11300, 11300, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-24', 259, 1, 0, 'NACIONAL');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9376, '200375', '200375', NULL, 'TORNILLO AVELLAN 1/4pulgadas X 1-1/4pulgadas', 15, 60, '1',162, 162, 1500, 9720, 209, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-24', 259, 1, 0, 'NACIONAL');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9377, '200378', '200378', NULL, 'TORNILLO LAMINA HEX BROCA NEOFRENO 10 * 3/4', 15, 0, '1',102, 102, 102, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-24', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9378, '190312', '190312', NULL, 'SOLDADURA EPOXICA TOPEX ULTRA FUERTE BLISTER * 16GR', 15, 0, '1',15900, 15900, 15900, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-25', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9379, '205311', '205311', NULL, 'BISAGRA FUERTE OMEGA B010', 15, 69, '1',1122, 1122, 1400, 77418, 209, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-25', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9380, '13222', '13222', NULL, 'ACM BLUE DE 1.50 * 5.80 4MM', 15, 4, '1',922792.25, 922792.25, 991991.5, 3691169, 2120, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-29', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9381, '13223', '13223', NULL, 'ACM VERDE MANZANA MATE DE 1.50 * 5.50 3MM', 15, 4, '1',544965,544965, 511840, 2179860, 1768, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-29', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9382, '13224', '13224', NULL, 'ACM AZUL MATE DE 1.50 * 5.50 3MM', 15, 4, '1',532481,532481,499356, 2129924, 1768, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-29', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9383, '610805428', '610805428', NULL, 'FLANCHE HIERRO DE 7/8pulgadas - 50 * 50', 15, 0, '1',253000,253000,253000, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-31', 259, 1, 0, 'NACIONAL');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9384, '610805429', '610805429', NULL, 'FLANCHE HIERRO DE 1/2pulgadas - 20 * 17', 15, 0, '1',18500, 18500, 18500, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-31', 259, 1, 0, 'NACIONAL');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9385, '610805430', '610805430', NULL, 'FLANCHE HIERRO DE 1/2pulgadas - 20 * 7', 15, 0, '1',7800, 7800, 7800, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-31', 259, 1, 0, 'NACIONAL');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9386, '610805431', '610805431', NULL, 'FLANCHE HIERRO DE 1/2pulgadas - 20 * 7', 15, 0, '1',19900, 19900, 19900, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-31', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9387, '610805432', '610805432', NULL, 'FLANCHE HIERRO DE 5/8pulgadas - 15 * 19.2', 15, 0, '1',19900, 19900, 19900, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-31', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9388, '1261', '1261', NULL, 'VINILO VAZ 675 AZUL CLARO DE1,22M', 10, 3.11, '1', 12717, 12717, 13193.27, 39549.87, 71, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-01-31', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9389, '200381', '200381', NULL, 'TORNILLO LAMINA BROCA HEX ZINC 10  * 3/4', 15, 0, '1', 102, 102, 102, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-02', 259, 1, 0, 'NACIONAL');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9390, '200384', '200384', NULL, 'TORNILLO HEX G2 ZINC DE 5/16 * 1', 15, 0, '1', 1250, 1250, 1250, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-02', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9391, '200385', '200385', NULL, 'TORNILLO HEXAGONAL AUTOPERFORANTE DE 1/4*3/4', 15, 0, '1', 450, 450, 450, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-02', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9392, '200386', '200386', NULL, 'TORNILLO HEX G2 DE 1/4 * 3/4', 15, 0, '1', 400, 400, 400, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-02', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9393, '201811', '201811', NULL, 'TUBO RECTANGULAR HIERRO ESTRUCTURAL 300X100 5MM', 10, 0, '1', 183000, 183000, 183000, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-07', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9394, '201812', '201812', NULL, 'TUBO RECTANGULAR HIERRO ESTRUCTURAL 200X100 5MM', 10, 0, '1', 175000, 175000,175000, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-07', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9395, '201813', '201813', NULL, 'TUBO CUADRADO HIERRO ESTRUCTURAL 34pulgadas CALIBRE 2.5MM', 10, 0, '1', 50000, 50000,50000, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-08', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9396, '200286', '200286', NULL, 'TORNILLO AUTOPERFORANTE PHILIPS 3/164pulgadas * 1-1/2', 15, 0, '1', 150, 150, 150, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-08', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9397, '30515', '30515', NULL, 'CHAZO EXPANSIVO 5/16 * 3', 15, 0, '1', 500, 500, 500, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-08', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9398, '2256033543', '2256033543', NULL, 'TORNILLO HEXAG ZIN 1/4*3/4', 15, 0, '1', 1200, 1200, 1200, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-08', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9399, '30515', '30515', NULL, 'TORNILLO  HEXAG 8 X 1pulgadas AUTOPERFORANTE', 15, 0, '1', 800, 800, 800, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-08', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9400, '2205603435', '2205603435', NULL, 'PROM TEMPLADO INCOLORO 4MM 1190 X 790', 15, 15, '1', 96457.95, 96457.95, 88778,1446869.25, 678, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-09', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9401, '130192', '130192', NULL, 'MALLA EXPANDIDA  IMT-20 LIVIANA  CALIBRE 18 LÃMINA 1.0M X 2.0M', 15, 4, '1',61281, 61281, 236275, 245124, 2121, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-12', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9402, '2205603433', '2205603433', NULL, 'VIDRIO TEMPLADO 4MM 1185 X 2310', 15, 0, '1',113278, 113278,113278, 245124, 2121, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-14', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9403, '610800355', '610800355', NULL, 'FLANCHE HIERRO 3/16pulgadas 85 * 100 MM S/PLANO', 15, 8, '1', 5500, 5500, 5500, 44000, 2000, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-14', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9404, '610800356', '610800356', NULL, 'FLANCHE HIERRO 3/16pulgadas 130 X 100 MM S/PLANO', 15, 4, '1', 8000, 8000, 8000, 32000, 2000, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-14', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9405, '610800357', '610800357', NULL, 'FLANCHE HIERRO 3/16pulgadas 70 X 85 MM S/PLANO', 15, 4, '1', 4000, 4000, 4000, 16000, 2000, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-14', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9406, '610800358', '610800358', NULL, 'FLANCHE HIERRO 3/16pulgadas 130 X 70 MM S/PLANO', 15, 2, '1', 6000, 6000, 6000, 12000, 2000, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-14', 259, 1, 0, 'NACIONAL');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9407, '610800359', '610800359', NULL, 'FLANCHE HIERRO 1/4pulgadas 150 X 170 MM S/PLANO', 15, 2, '1', 19400, 19400, 19400, 38800, 2000, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-14', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9408, '600313395', '600313395', NULL, 'FLANCHE HIERRO 3/164pulgadas 100 X 85 MM S/PLANO', 15, 0, '1', 5500, 5500, 5500, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-15', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9409, '600313396', '600313396', NULL, 'FLANCHE HIERRO 3/164pulgadas 100 X 130 MM S/PLANO', 15, 0, '1', 8000, 8000, 8000, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-15', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9410, '201388', '201388', NULL, 'TUBO CUADRADO FE CAL 14 1 -1/2', 10, 0, '1', 32120, 32120, 32120, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-16', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9411, '201389', '201389', NULL, 'TUBO RECTANGULAR FE ESTRUC 200*70 4MM', 10, 0, '1', 85000, 85000, 85000, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-16', 259, 1, 0, 'NACIONAL');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9412, '201401', '201401', NULL, 'TUBO RECTANGULAR FE ESTRUC 150*50 5MM', 10, 0, '1', 61666.67, 61666.67, 61666.6666666, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-16', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9413, '201402', '201402', NULL, 'TUBO CUADRADDO FE ESTRUCTU 24pulgadas DE CAL 2MM', 10, 0, '1', 84166.67, 84166.67, 61666.6666666, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-17', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9414, '610203469', '610203469', NULL, 'FLACHE HIERRO 14pulgadas - 40 * 40 CON 5 PERFORACIONES', 15, 0, '1', 400000, 400000,400000, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-19', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9415, '610203470', '610203470', NULL, 'FLANCHE HIERRO 1/24pulgadas - 12,10*15,4', 15, 0, '1',50000, 50000, 50000, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-19', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9416, '610203471', '610203471', NULL, 'FLANCHE HIERRO 5/8 - 15,0 * 30,0 CON 5 PERFORACIONES', 15, 0, '1',36000, 36000, 36000, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-19', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9417, '610203472', '610203472', NULL, 'FLANCHE HIERRO 5/16 - 10,8* 10,0* 7,0', 15, 0, '1',3500, 3500, 3500, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-19', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9418, '610203473', '610203473', NULL, 'FLANCHE HIERRO 5/16 -9,7*10,0 *4,5', 15, 0, '1',2500, 2500,2500, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-19', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9419, '30533', '30533', NULL, 'BOCINA METALICA 3/164pulgadas', 15, 0, '1',4000, 4000, 4000, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-19', 259, 1, 0, 'NACIONAL');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9420, '190315', '190315', NULL, 'METAL LIQUIDO FE1 500GR', 15, 0, '1',641677, 641677, 641677, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-20', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9421, '1212500', '1212500', NULL, 'L-DC-RY-2700 LUCOLINE RED / YELLOW 2700 MM 5 W P.M.', 15, 0, '1',278987, 278987, 278987, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9422, '1212501', '1212501', NULL, 'L-DC-RY-BND LUCOLINE RED / YELLOW CORNER R 600', 15, 0, '1',253666, 253666, 253666, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9423, '1212502', '1212502', NULL, 'L-DC-RY-BND LUCOLINE RED / YELLOW CORNER R 160', 15, 0, '1',296919, 296919, 296919, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9424, '1212503', '1212503', NULL, 'L-CLIP-F LUCOLINE MOUNTING CLIP FIXED', 15, 0, '1',1622, 1622, 1622, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9425, '1212504', '1212504', NULL, 'L-CLIP-S LUCOLINE MOUNTING CLIP SLIDING', 15, 0, '1',1081, 1081, 1081, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9426, '1212505', '1212505', NULL, 'L-R-END LUCOLINE PMS 1797C RED ENDCAP', 15, 0, '1',2163, 2163, 2163, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,
                    estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9427, '1212506', '1212506', NULL, 'L-GLUE FIELD ENDCAP GLUE 5 OZ', 15, 5, '1', 67584, 67584, 67584, 337920, 637, 0, 0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 0, 0, 'LUCOLED');

                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9428, '1212507', '1212507', NULL, 'L-CAB-F-500 LUCOLINE FEMALE CONNECTOR ASSEMBLY 500 MM', 15, 0, '1',6443, 6443, 6443, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9429, '1212508', '1212508', NULL, 'L-CAB-M-500 LUCOLINE MALE CONNECTOR ASSEMBLY 500 MM', 15, 0, '1',6443, 6443, 6443, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9430, '1212509', '1212509', NULL, 'L-CAB-Y-1.5 LUCOLINE CONNECTION CABLE 1.5 M M/F CONNECTOR', 15, 0, '1',80650, 80650, 80650, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9431, '1212510', '1212510', NULL, 'L-CAB-1.0 LUCOLINE EXTENSION CABLE 1.0 M M/F CONNECTOR', 15, 0, '1',13066, 13066, 13066, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9432, '1212511', '1212511', NULL, 'L-CAB-3.0 LUCOLINE EXTENSION CABLE 3.0 M M/F CONNECTOR', 15, 0, '1',15094, 15094, 15094, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9433, '1212512', '1212512', NULL, 'L-CAB-5.0 LUCOLINE EXTENSION CABLE 5.0 M M/F CONNECTOR', 15, 0, '1',20501, 20501, 20501, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9434, '1212513', '1212513', NULL, 'L-CON-BNK-M LUCOLINE BLANKING MALE CONNECTOR', 15, 0, '1',9011, 9011, 9011, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9435, '1212514', '1212514', NULL, 'L-CON-BNK-F LUCOLINE BLANKING FEMALE CONNECTOR', 15, 0, '1',9011, 9011, 9011, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9436, '1212515', '1212515', NULL, 'L-CON-Y-FFM LUCOLINE Y-CONNECTOR 2XF 1XM', 15, 0, '1',26898, 26898, 26898, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9437, '1212516', '1212516', NULL, 'L-CON-MM LUCOLINE GENDERCHANGER CONNECTOR 2XM', 15, 0, '1',17887, 17887, 17887, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9438, '1212517', '1212517', NULL, 'L-CON-FF LUCOLINE GENDERCHANGER CONNECTOR 2XF', 15, 0, '1',17887, 17887, 17887, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9439, '1212518', '1212518', NULL, 'L-CON-Y-MMF LUCOLINE Y-CONNECTOR 2XM 1XF', 15, 0, '1',26898, 26898, 26898, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9440, '1212519', '1212519', NULL, 'L-CON-Y-FFM LUCOLINE Y-CONNECTOR 2XF 1XM', 15, 0, '1',26898, 26898, 26898, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9441, '1212520', '1212520', NULL, 'FUENTE 48V - 150W PP48150', 15, 0, '1',205005, 205005, 205005, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-21', 259, 1, 0, 'NACIONAL');
                    
                    
                    INSERT INTO dt_inventario
                    (id_inventario, codigo_prod, cod_transito, cod_barras, producto, id_medida, stock, kardex_estado, valor_unidad, valor_unidad_compra, lista_precio, valor_total, id_proveedor, tam_x, tam_y,estado, tiempo_compra, observaciones_mat, fecha_creacion, id_subgrupo, cantidad_min, material_crit, marca)
                    VALUES(9442, '190088', '190088', NULL, 'POLIMEROMS ULTRA CLEAR TRANSPARENTE 280ML/285 G', 15, 0, '1',48000, 48000, 48000, 0, 0, 0.0, 0.0, 1, 1, 'INGRESO INICIAL', '2024-02-29', 259, 1, 0, 'NACIONAL');

                ");
            }catch(PDOException $e){
                echo "Hubo un error en la actualización de los registros nuevos de la tabla dt_inventario "."\n<br>".$e->getMessage();
            }

            //dt_kardex

            try{
                $conexion_migracion_prueba->exec("

                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9308, 9308, '22152092023', 'VINILO TRANSLUCIDO LG 0.61M - LC2013M ROJO', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 65.8, 414540, 52.74, 332262, 52.74, 332262, 246.26, 1551438);
                 
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9309, 9309, '121219', 'LED NEXUS STRIP SP160 - 0,72W30-F30 CALIDO 3.100K', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 60.0, 0.0, 900, 2722068, 900, 2722068, 780, 2359125.6);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9310, 9310, '9291680', 'TORNILLO HEX G8 1pulgadas X 5pulgadas', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 16, 154752, 28, 270816, 4, 38688);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9311, 9311, '0602601045', 'FLANCHE HIERRO 1/4 - 10 * 6 CON 1 PERF', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 1, 72000, 1, 72000, 1, 72000);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9312, 9312, '20152721', 'TUBO RECTANGULAR HIERRO CAL 3MM DE 200*100', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9313, 9313, '20152729', 'TUBO RECTANGULAR HIERRO CAL 4MM DE 200*70', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 6, 601900, 6, 601900);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9314, 9314, '9422004', 'LED NOVA P6HT DOBLE CARA 6W BLANCO', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 20, 633780, 20, 633780, 20, 633780);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9315, 9315, '94810002', 'LED NOVA 100HTR 2SMD 0,6W ROJO', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 480, 1601280, 480, 1601280, 480, 1601280);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9316, 9316, '013207227', 'ACM SHELL 3MM 180MM RED+540 YELOW 720 * 2700', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 275, 46245873, 275, 46245873, 275, 46245873);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9317, 9317, '013207215', 'ACM SHELL 3MM 180MM RED+540 YELOW 720 * 1530', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 44, 3922116, 44, 3922116, 44, 3922116);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9318, 9318, '900130', 'PANEL INDICADOR PWM LED BLANCO 12pulgadas DE 4,5 DIGITOS DELANTERO', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 1, 1404208, 1, 1404208);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9319, 9319, '900135', 'PANEL INDICADOR PWM LED BLANCO 16pulgadas DE 4,5 DIGITOS DELANTERO', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 1, 1740680, 1, 1740680);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9320, 9320, '900140', 'PANEL INDICADOR PWM LED BLANCO 16pulgadas DE 4,5 DIGITOS TRASERO', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9321, 9321, '10086', 'CORAZA PLASTICA ISIFLEX VERDE 3/4', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9322, 9322, '70191', 'GRAPA GALVANIZADA DE 1pulgadas', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9323, 9323, '220551', 'VIDRIO TEMPLADO 4MM - 1620 MM * 1090 MM', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 12, 2320932);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9324, 9324, '200412', 'TORNILLO LAMINA BROCA HEX ZINC #12 * 7/8pulgadas', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9325, 9325, '190311', 'SOLDADURA EPOXICA TOPEX ULTRA FUERTE BLISTER * 22 GR', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9326, 9326,'600313370', 'FLANCHE HIERRO 1 - 56 * 58 CON 5 PERF', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9327, 9327, '600313371', 'FLANCHE HIERRO 1/2 - 12.5 * 12.5', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9328, 9328, '600313372', 'FLANCHE HIERRO 1/2 - 10.5 * 10.0 CIRCULAR', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9329, 9329, '600313373', 'FLANCHE HIERRO 1/4 - 14 * 14', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9330,9330,'2011107', 'PERFIL HIERRO EN C DE 15 * 10 CAL 1/4pulgadas', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9331, 9331, '2011108', 'PERFIL HIERRO EN C DE 10 * 10 CAL 1/4pulgadas', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9332, 9332, '201342', 'TUBO CUADRADO HIERRO ESTRUCT CAL 5MM DE 100 * 100', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 6, 615000);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9333, 9333, '10861', 'LAMINA PET 122 * 244 1,5 MM', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9334, 9334,'130191', 'MALLA MOSQUITERA PLASTICA GRIS', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9335, 9335, '10036', 'ABRAZADERA INOXIDABLE DE 1-3/16pulgadas', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9336, 3936, '30281', 'CANALETA PLASTICA RANURADA 6 X 8 CM', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9337, 9337, '30282', 'CANALETA PLASTICA RANURADA 4 X 4 CM', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9338, 9338,'50071', 'CAUCHO ESPUMA DE 1/4pulgadas (6MM) * 5/8pulgadas (16 MM)', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9339, 9339, '10098', 'ACOPLE UNION MANGUERA EN T PLASTICO DE 3/4', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9340, 9340, '160790', 'PERFIL TRIM 1pulgadas COLOR VERDE', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 45, 474885, 45, 474885);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9341, 9341, '16136588', 'PINTURA TRAFICO PESADO - ROJO', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9342, 9342,'120335', 'LAMINA ALUMINIO 2MM 1,30 * 2,35', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 130, 48496370, 130, 48496370);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9343, 9343, '200422', 'TORNILLO PUNTA BROCA M8*2pulgadas', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9344, 9344, '200423', 'TORNILLO CAB PLANA M8 8*3/4 PUNTA BROCA', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9345, 9345, '200424', 'TORNILLO HEXAGONAL M8 8*3/4pulgadas', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9346, 9346,'200425', 'TUERCA M8', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9347, 9347, '200426', 'ARANDELA M8', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9348, 9348, '419', 'FLANCHE HIERRO 1/4 - 75 * 30 CON 6 PERFORACIONES', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 2, 140000);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9349, 9349, '926', 'FLANCHE HIERRO 1/4 - 10.0 * 8.0 TRIANGULAR', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 4, 8000);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9350, 9350,'927', 'FLANCHE HIERRO 1/4 - 8.0 * 5.0 CIRCULAR CON 1 PERFORACIÃ“N', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 8, 16000);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9351, 9351, '928', 'FLANCHE HIERRO 1/4 -12.0 * 5.0 CON 2 PERFORACIONES', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 4, 10000);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9352, 9352, '20573', 'BISAGRA BLANCA DE 2pulgadas/19/32pulgadas', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9353, 9353, '200451', 'TUERCA REMACHE 3/16', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9354, 9354,'200452', 'REMACHE POP 1/8', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9355, 9355, '202076', 'TUBO REDONDO HIERRO DIAMETRO DE 2pulgadas Y ESPESOR DE 2.5MM', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9356, 9356, '70171', 'GRAPA GALVANIZADA DOBLE ALETA DE 2pulgadas', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9357, 9357, '30464', 'TORNILLO BROCA HEX 1/4 * 1pulgadas', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9358, 9358,'70043', 'TORNILLO CAB PAN 316 * 3/4', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9359, 9359, '13453', 'ANGULO HIERRO 4*3/8', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9360, 9360, '2256038004', 'PINTURA ELECTROSTATICA - BEIGE CHAMPAGNE SEMIMATE (60% BRILLANTE) PANTONE 8004', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9361, 9361, '2256039016', 'PINTURA ELECTROSTATICA - BLANCO SEMIMATE (60% BRILLANTE) RAL 9016 CREAR', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 50, 1480000);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9362, 9362,'2073', 'VINILO LX LC2073M 0.61*50', 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 50, 315000);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9364, 9364,'200292', 'TORNILLO CABEZA PAN M4*3,5CM', 168, 6720, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9365, 9365,'200293', 'TORNILLO CABEZA PAN M4*2CM', 168, 5544, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9366, 9366,'200294', 'TUERCA PLASTICA CIEGA M4', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9367, 9367,'200295', 'TUERCA MARIPOSA M4', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9368, 9368,'200296', 'TTUERCA REMACHE M4', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9369, 9369,'200297', 'PERFIL CAUCHO U 10MM', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9370, 9370,'200298', 'BALDE PLASTICO GRIS', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9371, 9371,'610805441', 'FLANCHE HIERRO 3/16 - 13.0 * 8.0 CON 2 PERFORACIONES', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9372, 9372,'200445', 'TUERCA REMACHABLE M5', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9373, 9373,'201435', 'CHAZO EXPANSIVO 1/2 * 3', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9374, 9374,'202035', 'TORNILLO CABEZA PAN PHILLIPS M5*18MM', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9375, 9375,'20522', 'BISAGRA ESQUINERA SET MAGNETICO SOBLE XF-5211 BLANCO', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9376, 9376,'200375', 'TORNILLO AVELLAN 1/4pulgadas X 1-1/4pulgadas', 60, 9720, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9377, 9377,'200378', 'TORNILLO LAMINA HEX BROCA NEOFRENO 10 * 3/4', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9378, 9378,'190312', 'SOLDADURA EPOXICA TOPEX ULTRA FUERTE BLISTER * 16GR', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9379, 9379,'205311', 'BISAGRA FUERTE OMEGA B010', 69, 77418, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9380, 9380,'13222', 'ACM BLUE DE 1.50 * 5.80 4MM', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9381, 9381,'13223', 'ACM VERDE MANZANA MATE DE 1.50 * 5.50 3MM', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9382, 9382,'13224', 'ACM AZUL MATE DE 1.50 * 5.50 3MM', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9383, 9383,'610805428', 'FLANCHE HIERRO DE 7/8pulgadas - 50 * 50', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9384, 9384,'610805429', 'FLANCHE HIERRO DE 1/2pulgadas - 20 * 17', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9385, 9385,'610805430', 'FLANCHE HIERRO DE 1/2pulgadas - 20 * 7',0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9386, 9386,'610805431', 'FLANCHE HIERRO DE 1/2pulgadas - 20 * 7', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9387, 9387,'610805432', 'FLANCHE HIERRO DE 5/8pulgadas - 15 * 19.2', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9388, 9388,'1261', 'VINILO VAZ 675 AZUL CLARO DE1,22M', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9389, 9389,'200381', 'TORNILLO LAMINA BROCA HEX ZINC 10  * 3/4', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9390, 9390,'200384', 'TORNILLO HEX G2 ZINC DE 5/16 * 1', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9391, 9391,'200385', 'TORNILLO HEX AUTOPERFORANTE DE 1/4*3/4', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9392, 9392,'200386', 'TORNILLO HEXAGONAL G2 DE 1/4 * 3/4', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9393, 9393,'201811', 'TUBO RECTANGULAR HIERRO ESTRUCTURAL 300X100 5MM', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9394, 9394,'201812', 'TUBO RECTANGULAR HIERRO ESTRUCTURAL 200X100 5MM', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9395, 9395,'201813', 'TUBO CUADRADO HIERRO ESTRUCTURAL 3pulgadas CALIBRE 2.5MM', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9396, 9396,'200286', 'TORNILLO AUTOPERFORANTE PHILIPS 3/16pulgadas * 1-1/2', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9397, 9397,'30515', 'CHAZO EXPANSIVO 5/16 * 3', 69, 77418, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9398, 9398,'2256033543', 'TORNILLO HEXAG ZIN 1/4*3/4', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9399, 9399,'2256033546', 'TORNILLO  HEXAG 8 X 1pulgadas AUTOPERFORANTE', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9400, 9400,'2205603435', 'PROM TEMPLADO INCOLORO 4MM 1190 X 790', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9401, 9401,'130192', 'MALLA EXPANDIDA  IMT-20 LIVIANA  CALIBRE 18 LÃMINA 1.0M X 2.0M', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9402, 9402,'2205603433', 'VIDRIO TEMPLADO 4MM 1185 X 2310', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9403, 9403,'610800355', 'FLANCHE HIERRO 3/16pulgadas 85 * 100 MM S/PLANO', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9404, 9404,'610800356', 'FLANCHE HIERRO 3/16pulgadas 130 X 100 MM S/PLANO', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9405, 9405,'610800357', 'FLANCHE HIERRO 3/16pulgadas 70 X 85 MM S/PLANO', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9406, 9406,'610800358', 'FLANCHE HIERRO 3/16pulgadas 130 X 70 MM S/PLANO', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9407, 9407,'610800359', 'FLANCHE HIERRO 1/4pulgadas 150 X 170 MM S/PLANO', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9408, 9408,'600313395', 'FLANCHE HIERRO 3/16pulgadas 100 X 85 MM S/PLANO', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9409, 9409,'600313396', 'FLANCHE HIERRO 3/16pulgadas 100 X 130 MM S/PLANO', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9410, 9410,'201388', 'TUBO CUADRADO FE CAL 14 1 -1/2', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9411, 9411,'201389', 'TUBO RECTANGULAR FE ESTRUC 200*70 4MM', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9412, 9412,'201401', 'TUBO RECTANGULAR FE ESTRUC 150*50 5MM', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9413, 9413,'201402', 'TUBO CUADRADDO FE ESTRUCTU 2pulgadas DE CAL 2MM', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9414, 9414,'610203469', 'FLACHE HIERRO 1pulgadas - 40 * 40 CON 5 PERFORACIONES', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9415, 9415,'610203470', 'FLANCHE HIERRO 1/2pulgadas - 12,10*15,4', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9416, 9416,'610203471', 'FLANCHE HIERRO 5/8 - 15,0 * 30,0 CON 5 PERFORACIONES', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9417, 9417,'610203472', 'FLANCHE HIERRO 5/16 - 10,8* 10,0* 7,0', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9418, 9418,'610203473', 'FLANCHE HIERRO 5/16 -9,7*10,0 *4,5', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9419, 9419,'30533', 'BOCINA METALICA 3/16pulgadas', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9420, 9420,'190315', 'METAL LIQUIDO FE1 500GR', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9421, 9421,'1212500', 'L-DC-RY-2700 LUCOLINE RED / YELLOW 2700 MM 5 W P.M.', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9422, 9422,'1212501', 'L-DC-RY-BND LUCOLINE RED / YELLOW CORNER R 600', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9423, 9423,'1212502', 'L-DC-RY-BND LUCOLINE RED / YELLOW CORNER R 160', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9424, 9424,'1212503', 'L-CLIP-F LUCOLINE MOUNTING CLIP FIXED', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9425, 9425,'1212504', 'L-CLIP-S LUCOLINE MOUNTING CLIP SLIDING', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9426, 9426,'1212505', 'L-R-END LUCOLINE PMS 1797C RED ENDCAP', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9427, 9427,'1212506', 'L-GLUE FIELD ENDCAP GLUE 5 OZ', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9428, 9428,'1212507', 'L-CAB-F-500 LUCOLINE FEMALE CONNECTOR ASSEMBLY 500 MM', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9429, 9429,'1212508', 'L-CAB-M-500 LUCOLINE MALE CONNECTOR ASSEMBLY 500 MM', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9430, 9430,'1212509', 'L-CAB-Y-1.5 LUCOLINE CONNECTION CABLE 1.5 M M/F CONNECTOR', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9431, 9431,'1212510', 'L-CAB-1.0 LUCOLINE EXTENSION CABLE 1.0 M M/F CONNECTOR', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9432, 9432,'1212511', 'L-CAB-5.0 LUCOLINE EXTENSION CABLE 5.0 M M/F CONNECTOR', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9433, 9433,'1212512', 'L-CLIP-F LUCOLINE MOUNTING CLIP FIXED', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9434, 9434,'1212513', 'L-CON-BNK-M LUCOLINE BLANKING MALE CONNECTOR', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9435, 9435,'1212514', 'L-CON-BNK-F LUCOLINE BLANKING FEMALE CONNECTOR', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9436, 9436,'1212515', 'L-CON-Y-FFM LUCOLINE Y-CONNECTOR 2XF 1XM', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9437, 9437,'1212516', 'L-CON-MM LUCOLINE GENDERCHANGER CONNECTOR 2XM', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9438, 9438,'1212517', 'L-CON-FF LUCOLINE GENDERCHANGER CONNECTOR 2XF', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9439, 9439,'1212518', 'L-CON-Y-MMF LUCOLINE Y-CONNECTOR 2XM 1XF', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9440, 9440,'1212519', 'L-CON-Y-FFM LUCOLINE Y-CONNECTOR 2XF 1XM', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9441, 9441,'1212519', 'FUENTE 48V - 150W PP48150', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                
                INSERT INTO dt_kardex
                (id_kardex, id_inventario, codigo_prod, producto, enero_stock, enero_valor, febrero_stock, febrero_valor, marzo_stock, marzo_valor, abril_stock, abril_valor, mayo_stock, mayo_valor, junio_stock, junio_valor, julio_stock, julio_valor, agosto_stock, agosto_valor, septiembre_stock, septiembre_valor, octubre_stock, octubre_valor, noviembre_stock, noviembre_valor, diciembre_stock, diciembre_valor)
                VALUES(9442, 9442,'190088', 'POLIMEROMS ULTRA CLEAR TRANSPARENTE 280ML/285 G', 0, 0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0, 0);
                
                

                ");
            }catch(PDOException $e){
                echo "Hubo un error en la actualización de los registros nuevos de la tabla dt_kardex "."\n<br>".$e->getMessage();
            }

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Inclusión de los registros faltantes en dt_clientes,dt_inffac_cli,dt_macroproyecto,dt_proveedores,dt_inf_contable_prove,dt_codprodfinal,dt_inventario y dt_kardex. Insersión completa en ".$tiempo_transcurrido." segundos";

            return $mensaje;

          
   

        }

        public static function complementaInfoUsuariosActivos($conexion_migracion_prueba){

            //Iniciamos timer

            $tiempo_inicio = microtime(true);


            $array_data_activos = array(

                110 => array(
                     "id_cargo" => 24,
                     'id_empleado' => 289,
                     "auth_key" => "ApWTJXupwbXyzTP_aDbBqnUf03DUNtv-",
                     "password_hash" => '$2y$13$rtEbnr51YyeJkaTpDG3ALOHhhtQ1e3tkOtbWYXipsaoVsSd8oFxQW'
                 ),
             
             
                742=> array(
                        "id_cargo" => 5,
                        'id_empleado' => 1015,
                        "auth_key" => "5wz3zyJ4COUf5PjJQe2IFXveyhEbTtnv",
                        "password_hash" => '$2y$13$3h8Dq3QrH6sk3uzDhaq1t.hfhHfppXdBkemSUY3LKBSltwt9w.hEq'
                    ),
             
                1143 => array(
                        "id_cargo" => 38,
                        'id_empleado' => 1424,
                        "auth_key" =>"1ASRBg25PSGjBcJG_dnVsk8zXr3Pf0Vj",
                        "password_hash" => '$2y$13$ICuICYksUTPt7hyexSt3T.uL0axIhUbHqnTGkqj830TE2KuwM29dy'
                    ),
             
                12 => array(
                        "id_cargo" => 35,
                        'id_empleado' => 85,
                        "auth_key" => "LIHCnzQUQOuDVK-g6YVABUk0pOQV8OFu",
                        "password_hash" =>'$2y$13$oNXEtwqPtsf/guXqiU0yA.cMQZCkQzJDmfphNArW0i93Kb4pct8l6'
                    ),
                
                782 => array(
                        "id_cargo" => 78,
                        'id_empleado' => 1055,
                        "auth_key" =>"U8d3oTSuq_hMCOtvQ09JrK6Oi8iMvyXu",
                        "password_hash" => '$2y$13$eXx325dNbkBfHxWPnBgVe.wlgRsOa3yzEGOkQmc3u7NbR9VOP2fDK'
                    ),
                
                865 => array(
                        "id_cargo" =>49,
                        'id_empleado' => 1141,
                        "auth_key" =>"3RhPQ-g51W_s1idMG81Sf3a-AI90FD_d",
                        "password_hash" => '$2y$13$jvH0jVr8xiIueT.FZGQpROGuhXys45VH7q4XlWhSvQpl6WEycLzNS'
                    ),
             
             
                370 => array(
                        "id_cargo" => 88,
                        'id_empleado' => 596,
                        "auth_key" =>'b4_dviNJ72Qbfhqj6uLsh0UpZxLWjajR',
                        "password_hash" => '$2y$13$E8Qcyq.16aasY4H3tA8MZOPom7eEPWQYQaOZnNVExUxlM4LLKTcf6'
                    ),
                
                955 => array(
                        "id_cargo" => 17,
                        'id_empleado' => 1232,
                        "auth_key" =>"cZ7izz15zIHwJdeG3mFGwLKogU_eRw-Q",
                        "password_hash" => '$2y$13$/SpTNgZTRS8buYQBPifhMesWu.83VrTVfN/oLz/R.11YPksKVP7ua'
                    ),
                
                689 => array(
                        "id_cargo" =>18,
                        'id_empleado' => 689,
                        "auth_key" =>"P-9BlOloLuqK4Q05dHInM1VN_9W0HMag",
                        "password_hash" => '$2y$13$YF8uPif.G50vRdJcCGMP7.pahTR8UnOaTjlqi0/dkHJ87vJkq0xtG'
                    ),
                
                
                1120 => array(
                        "id_cargo" =>6,
                        'id_empleado' => 1401,
                        "auth_key" =>"6ob2C1c-S6L6gaO2wj94ZWMdDafFZQOx",
                        "password_hash" => '$2y$13$lBs2BVRnlqm7swGmneuI/OqfUa0gD3ms5UbZtQTQC949OjMFjyche'
                    ),
                
                55 => array(
                        "id_cargo" =>11 ,
                        'id_empleado' => 226,
                        "auth_key" =>"7w_JtTgVc3kZ5iML-vYLfgtDjDx1JL-E",
                        "password_hash" => '$2y$13$VfQpgQb47cjh0F1.T4JHmejRG0mphM0Geg3YpM8d7kuzndIISH7ke'
                    ),
             
             
                13 => array(
                        "id_cargo" =>34,
                        'id_empleado' => 86,
                        "auth_key" =>"d5IhCWZWhDb0Zb90sm0BP2TuhV_MnQu5",
                        "password_hash" => '$2y$13$es9/QTGXqv7cd.3pMCxrx.3eiMvV6Jsn4INM0Xvx/ylIGoHOGaUXS'
                    ),
                
                1141 => array(
                        "id_cargo" => 87,
                        'id_empleado' => 1422,
                        "auth_key" =>"P0cQj0_IgHntddXrnCGhTDeTWqjCQSnA",
                        "password_hash" => '$2y$13$unvcyMeX6yuLXqlB9Mw4j.4p6v9L6Tl5LQPVseAT1K.1FtCg69Nbi'
                    ),
                
                1124 => array(
                        "id_cargo" =>54,
                        'id_empleado' => 1405,
                        "auth_key" =>"pRxZvS1CAxZL_7Z7a9tgWsKIdiYCqOE6",
                        "password_hash" => '$2y$13$pwQFq0r3tkz.RhqTRhuvfulPwLv3LuFXWghL.3sCKT1wCPDymcp7C'
                    ),
             
             
                1145 => array(
                        "id_cargo" =>22,
                        'id_empleado' => 1426,
                        "auth_key" =>"aBnUhCke_TEbq0h1G1AzXQuj34SppsUf",
                        "password_hash" => '$2y$13$JLsOZGz8RdfB4NlcXlxVTuxrjF6UBV794ARK01el4BpefP4.aUh8.'
                    ),
                
                1153 => array(
                        "id_cargo" =>22,
                        'id_empleado' => 1434,
                        "auth_key" =>"9k-zM57xA41ByuMmwyE0w2i7iR7jsV1O",
                        "password_hash" => '$2y$13$8ZSrZX48pzFbTbT8wHdYGe5JlLaAAeNhaYfNQ7M55lrU.hs0/du8a'
                    ),
                
                1117 => array(
                        "id_cargo" =>22,
                        'id_empleado' => 1398,
                        "auth_key" =>"nv5jM9otofQRV6WjUbU6BjiWBPMvbvA0",
                        "password_hash" => '$2y$13$bQfKRq1FFBoP5mwZtKdhL.oVS2.boudarp/F3jNE7doCX9qR3RoaW'
                    ),
                
                1165 => array(
                        "id_cargo" =>5,
                        'id_empleado' => 1446,
                        "auth_key" =>"G6mVvSMQAlmK_vlDXaQmzu2wMeiAJv6t",
                        "password_hash" => '$2y$13$DvMHFNOjciUwYdM9NrxRpeTMYCnAoHiXmXIweR57UeNx6tQN3QJw6'
                    ),
                
                
                1172 => array(
                        "id_cargo" =>21,
                        'id_empleado' => 1453,
                        "auth_key" =>"VFtxVymDge8dH3HeEONsBSN_FQ2A74xQ",
                        "password_hash" => '$2y$13$CzzW3voB5EDUHvkMP0hX/O1ug6PfTIZ0ugQFiYDicVtpHBpKbj2v2'
                    ),
             
                1169  => array(
                        "id_cargo" =>68,
                        'id_empleado' => 1450,
                        "auth_key" =>"IBJIC1ddHPGNlgMStzOqyQKXHlUWnxui",
                        "password_hash" => '$2y$13$3BTSVeggBMdiSMYST4Eljuz6ftw7YXGjLGoL.m98fDjfSg6MHfYSW'
                    ),
                
                1106  => array(
                        "id_cargo" =>49,
                        'id_empleado' => 1387,
                        "auth_key" =>"zZlHhIt9wD00nCV5emHA7aII2fzvE25x",
                        "password_hash" => '$2y$13$G4s1ykJtsWPyvbG6ehWUOehxg577K7eL/szwZlDgNHb/tRzbNRB1i'
                    )

             
            );

            $registros_corregidos = 0;

            $conexion_migracion_prueba->beginTransaction();

            

                foreach ($array_data_activos as $id => $data_usuario){

                    try{

                        $update_user = $conexion_migracion_prueba->prepare("UPDATE user SET auth_key = :auth_key, password_hash = :password_hash WHERE id = :id");
        
                        $update_user->execute([
                            'auth_key' => $data_usuario['auth_key'],
                            'password_hash' => $data_usuario['password_hash'],
                            'id' => $id
                        ]);
        
                        $update_usuario = $conexion_migracion_prueba->prepare("UPDATE dt_usuarios SET id_cargo = :id_cargo WHERE id_usuario = :id_usuario");
        
                        $update_usuario->execute([
                            'id_cargo' => $data_usuario['id_cargo'],
                            'id_usuario' => $data_usuario['id_empleado']
                        ]);

                        

                    }catch(PDOException $e){
                        $conexion_migracion_prueba->rollBack();
                        echo "Hubo un error con el id ".$id."\n<br>".$e->getMessage();exit;
                    }    

                    $registros_corregidos++;
        
                }
                
            

            $conexion_migracion_prueba->commit();

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Actualización de credenciales de ingreso en user y id_cargo en id_usuarios completa, ".$registros_corregidos." usuarios actualizados en sus credenciales de ingreso y id_cargo ".$tiempo_transcurrido." segundos";

            return $mensaje;

            

        }

        public static function implementaLlavesComplementarias($conexion_migracion_prueba){
            try{
                $conexion_migracion_prueba->exec("
                
                    /*create index indx_cod_prod on dt_rotacion(cod_prod);*/
                    create index indx_id_tipo_rotacion on dt_rotacion(id_tipo_rotacion);
                    /*alter table dt_fechas_op 
                    add constraint dt_fechas_op_dt_ordenes_fk 
                    FOREIGN KEY (id_ordenes) references dt_ordenes(id_ordenes);*/
                    alter table dt_compras
                    add constraint dt_compras_dt_costos_fk 
                    FOREIGN KEY (id_costos) references dt_costos(id_costo);
                    alter table dt_compras  
                    add constraint dt_compras_dt_proveedores_fk 
                    FOREIGN KEY (id_proveedores) references dt_proveedores(id_proveedores);
                
                ");

            }catch(PDOException $e){
                echo "Hubo un error en la implementación de las llaves complementarias ".$e->getMessage();exit;
            }
        }

        public static function creaProcedimientosAlmacenados($conexion_migracion_prueba){

            try{

                $conexion_migracion_prueba->exec("
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`agendaOperadores`(id_area int)
                    select
                    t.id_tarea_costo as 'id_tarea_costo',
                    o.id_ordenes as 'id_ordenes',
                    o.n_ordenes as 'op',
                    c.nom_empresa as 'cliente',
                    o.referencia as 'producto',
                    o.item_op as 'item',
                    o.cantidad as 'cantidad',
                    uO.nombre_usuario as 'experto',
                    t.id_costo as 'id_costo',
                    t.fecha_inicio_real as 'fecha_inicio',
                    t.fecha_final as 'fecha_final',
                    t.nombre_costo as 'tarea',
                    t.can_horas as 'horas',
                    o.id_usuario as 'comercial_id',
                    o.id_coordinador as 'coordinador_id'
                    from dt_tareas_costo t 
                    inner join dt_ordenes o on t.id_ordenes = o.id_ordenes
                    inner join `user` uP on t.id_usuario = uP.id
                    inner join `user` uO on t.id_vendedor = uO.id
                    left join dt_clientes c on c.id_cliente = o.id_cliente where t.id_area = id_area and t.fecha_retro is null
                    order by o.n_ordenes asc, t.fecha_inicio asc,o.item_op asc;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`agendaOperadoresOP`(id_area int,n_ordenes int)
                    select
                    t.id_tarea_costo as 'id_tarea_costo',
                    o.id_ordenes as 'id_ordenes',
                    o.n_ordenes as 'op',
                    c.nom_empresa as 'cliente',
                    o.referencia as 'producto',
                    o.item_op as 'item',
                    o.cantidad as 'cantidad',
                    uO.nombre_usuario as 'experto',
                    t.id_costo as 'id_costo',
                    t.fecha_inicio_real as 'fecha_inicio',
                    t.fecha_final as 'fecha_final',
                    t.nombre_costo as 'tarea',
                    t.can_horas as 'horas',
                    o.id_usuario as 'comercial_id',
                    o.id_coordinador as 'coordinador_id'
                    from dt_tareas_costo t 
                    inner join dt_ordenes o on t.id_ordenes = o.id_ordenes
                    inner join `user` uP on t.id_usuario = uP.id
                    inner join `user` uO on t.id_vendedor = uO.id
                    left join dt_clientes c on c.id_cliente = o.id_cliente where t.id_area = id_area and t.fecha_retro is null and o.n_ordenes = n_ordenes
                    order by o.n_ordenes asc, t.fecha_inicio asc,o.item_op asc;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`buscadorDiseno`(n_ordenes int)
                    select 
                    n_ordenes,
                    id_ordenes,
                    foto
                    
                    from dt_diseno where n_ordenes = n_ordenes;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`ganttProduccion`(id int)
                    select * from dt_costos where id_tipo_costo = 4 and id_ordenes = id;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`generarInformeProduccion`(n_ordenes int)
                    select 
                        c.n_ordenes as 'op',
                        c.cod_material as 'codigo_material',
                        c.nombre_costo as 'Material', 
                        ROUND(sum(c.cant_sol),1) as 'cantidad_costeada',
                        sum(case when r.id_tipo_rotacion = 25 then r.cantidad else r.cantidad = 0 end) as 'entregado_por_almacen',
                        sum(case when r.id_tipo_rotacion = 26 then r.cantidad else r.cantidad = 0 end) as 'descargado_por_op',
                        ROUND(sum(c.cant_sol),1)- sum(case when r.id_tipo_rotacion = 26 then r.cantidad else r.cantidad = 0 end)as 'saldo'
                            
                    from dt_costos c 
                    left join dt_rotacion r on (c.id_costo = r.id_costo) 
                    
                    where c.id_tipo_costo = 1 and c.n_ordenes = n_ordenes
                    group by c.nombre_costo;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`informeRotacionesMaterial`(n_ordenes int)
                    SELECT 
                    dc.id_costo, 
                    dr.id_compra, 
                    dc.id_ordenes,
                    dc.n_ordenes,
                    dc.cod_material,
                    dc.comentarios,
                    dc.nombre_costo,
                    di.stock,
                    dc.cant_sol,  
                    round(sum(case when dr.id_tipo_rotacion = 9 then dr.cantidad else dr.cantidad = 0 end),2) as 'cantidad_entradas',
                    round(sum(case when dr.id_tipo_rotacion = 25 and dr.estado = 7 then dr.cantidad else dr.cantidad = 0 end),2) as 'traslado_a_producción_sin_aceptar',
                    round(sum(case when dr.id_tipo_rotacion = 25 and dr.estado = 1 then dr.cantidad else dr.cantidad = 0 end),2) as 'traslado_a_producción_aceptado',
                    round(sum(case when dr.id_tipo_rotacion = 26 and dr.estado = 1 then dr.cantidad else dr.cantidad = 0 end),2) as 'salidas_de_producción'
                    FROM dt_costos dc 
                    LEFT JOIN dt_inventarioxarea di on dc.id_inventario = di.id_inventario 
                    AND di.id_area = 12
                    LEFT JOIN dt_rotacion dr  on dc.id_costo = dr.id_costo 
                    AND dr.id_tipo_rotacion in (9,25,26) and dr.estado != 2
                    WHERE  dc.id_tipo_costo = 1 AND dc.n_ordenes = n_ordenes
                    GROUP BY dc.id_costo order by dc.id_ordenes,dc.nombre_costo;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`informeRotacionesMaterialAgrupado`(n_ordenes int)
                    SELECT 
                    dc.id_costo, 
                    dr.id_compra, 
                    dc.id_ordenes,
                    dc.n_ordenes,
                    dc.cod_material,
                    dc.comentarios,
                    dc.nombre_costo,
                    di.stock,
                    round(sum(dc.cant_sol),2) as 'cant_sol',  
                    round(sum(case when dr.id_tipo_rotacion = 9 then dr.cantidad else dr.cantidad = 0 end),2) as 'cantidad_entradas',
                    round(sum(case when dr.id_tipo_rotacion = 25 and dr.estado = 7 then dr.cantidad else dr.cantidad = 0 end),2) as 'traslado_a_producción_sin_aceptar',
                    round(sum(case when dr.id_tipo_rotacion = 25 and dr.estado = 1 then dr.cantidad else dr.cantidad = 0 end),2) as 'traslado_a_producción_aceptado',
                    round(sum(case when dr.id_tipo_rotacion = 26 and dr.estado = 1 then dr.cantidad else dr.cantidad = 0 end),2) as 'salidas_de_producción'
                    FROM dt_costos dc 
                    LEFT JOIN dt_inventarioxarea di on dc.id_inventario = di.id_inventario 
                    AND di.id_area = 12
                    LEFT JOIN dt_rotacion dr  on dc.id_costo = dr.id_costo 
                    AND dr.id_tipo_rotacion in (9,25,26) and dr.estado != 2
                    WHERE  dc.id_tipo_costo = 1 AND dc.n_ordenes = n_ordenes
                    GROUP BY dc.cod_material  order by dc.id_ordenes,dc.nombre_costo;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`informeRotacionMaterialxOP`(n_ordeness int)
                    select 
                    tablauno.cod_material,tablauno.comentarios,tablauno.nombre_costo,tablauno.cantidad_costeada,tablados.entradas_almacen,tablados.entrada_a_producción_sin_aprobar,
                    tablados.entrada_a_producción_aprobadas,tablados.salidas_de_producción
                    from
                    (select n_ordenes,comentarios,nombre_costo,cod_material,round(sum(cant_sol),1) as 'cantidad_costeada' 
                    from dt_costos where  n_ordenes = n_ordeness and id_tipo_costo = 1
                    group by nombre_costo order by nombre_costo) tablauno
                    join
                    (select 
                    c.nombre_costo,c.cod_material, 
                    round(sum(case when r.id_tipo_rotacion = 9 then r.cantidad else r.cantidad = 0 end),1)as 'entradas_almacen',
                    round(sum(case when r.id_tipo_rotacion = 25 and r.estado = 7 then r.cantidad else r.cantidad = 0 end),1) as 'entrada_a_producción_sin_aprobar',
                    round(sum(case when r.id_tipo_rotacion = 25 and r.estado = 1 then r.cantidad else r.cantidad = 0 end),1) as 'entrada_a_producción_aprobadas',
                    round(sum(case when r.id_tipo_rotacion = 26 and r.estado = 1 then r.cantidad else r.cantidad = 0 end),1) as 'salidas_de_producción'
                    from dt_rotacion  r 
                    right join dt_costos c on r.id_costo = c.id_costo where c.id_tipo_costo = 1  and c.n_ordenes = n_ordeness group by c.nombre_costo 
                    order by c.nombre_costo) tablados
                    on tablauno.nombre_costo = tablados.nombre_costo;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`itemsaProgramarconAreaOP`(id_area int,n_ordenes int)
                    select 
                    dt_acabados.id_area,
                    dt_costos.n_ordenes,
                    dt_ordenes.cod,
                    dt_ordenes.referencia,
                    dt_ordenes.id_ordenes,
                    dt_ordenes.item_op 
                    from dt_costos 
                    inner join dt_acabados on dt_costos.id_acabados =+ dt_acabados.id_acabados
                    left join dt_ordenes on dt_ordenes.id_ordenes = dt_costos.id_ordenes
                    left join dt_tareas_costo on dt_tareas_costo.id_costo = dt_costos.id_costo
                    left join dt_fechas_op on dt_ordenes.id_ordenes = dt_fechas_op.id_ordenes
                    where dt_ordenes.estado <> 0 and year(dt_fechas_op.fecha_ingreso) in (2022,2023,2024)and dt_costos.n_ordenes <> 0 and dt_costos.id_tipo_costo in (4,8) and   dt_costos.cierre = 0 
                    and dt_acabados.id_area = id_area and dt_ordenes.n_ordenes = n_ordenes
                    group by dt_ordenes.id_ordenes ORDER BY dt_costos.n_ordenes,dt_costos.id_ordenes,dt_costos.id_costo,dt_acabados.id_area,dt_acabados.cod;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`itemsaProgramarconOP`(n_ordenes int)
                    select 
                    dt_acabados.id_area,
                    dt_costos.n_ordenes,
                    dt_ordenes.cod,
                    dt_ordenes.referencia,
                    dt_ordenes.id_ordenes,
                    dt_ordenes.item_op 
                    from dt_costos 
                    inner join dt_acabados on dt_costos.id_acabados =+ dt_acabados.id_acabados
                    left join dt_ordenes on dt_ordenes.id_ordenes = dt_costos.id_ordenes
                    left join dt_tareas_costo on dt_tareas_costo.id_costo = dt_costos.id_costo
                    left join dt_fechas_op on dt_ordenes.id_ordenes = dt_fechas_op.id_ordenes
                    where dt_ordenes.estado <> 0 and year(dt_fechas_op.fecha_ingreso) in (2022,2023,2024)and dt_costos.n_ordenes <> 0 and dt_costos.id_tipo_costo in (4,8) and   dt_costos.cierre = 0 
                    and dt_ordenes.n_ordenes = n_ordenes
                    group by dt_ordenes.id_ordenes ORDER BY dt_costos.n_ordenes,dt_costos.id_ordenes,dt_costos.id_costo,dt_acabados.id_area,dt_acabados.cod;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`itemsProgramadosAreaOP`(id_area int,n_ordenes int)
                    select
                    t.id_area,
                    t.n_ordenes,
                    o.cod,
                    o.referencia,
                    o.id_ordenes,
                    o.item_op
                    from dt_tareas_costo t
                    inner join dt_ordenes o on t.id_ordenes = o.id_ordenes 
                    where t.id_area = id_area and o.n_ordenes = n_ordenes
                    group by o.id_ordenes;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`itemsProgramadosOP`(n_ordenes int)
                    select
                    t.id_area,
                    t.n_ordenes,
                    o.cod,
                    o.referencia,
                    o.id_ordenes,
                    o.item_op
                    from dt_tareas_costo t
                    inner join dt_ordenes o on t.id_ordenes = o.id_ordenes 
                    where o.n_ordenes = n_ordenes
                    group by o.id_ordenes;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`ordenesaProgramar`()
                    select 
                    
                    dt_costos.n_ordenes,
                    dt_ordenes.ref_general
                    
                    from dt_costos 
                    left join dt_ordenes on dt_ordenes.id_ordenes = dt_costos.id_ordenes
                    left join dt_fechas_op on dt_ordenes.id_ordenes = dt_fechas_op.id_ordenes
                    where dt_ordenes.estado <> 0 and year(dt_fechas_op.fecha_ingreso) in (2022,2023,2024) and dt_costos.n_ordenes <> 0 and dt_costos.id_tipo_costo in (4,8) and   dt_costos.cierre = 0 
                    
                    group by dt_ordenes.n_ordenes ORDER BY dt_costos.n_ordenes,dt_costos.id_ordenes,dt_costos.id_costo;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`ordenesaProgramarconAreaOP`()
                    select 
                    
                    dt_costos.n_ordenes
                    
                    from dt_costos 
                    left join dt_ordenes on dt_ordenes.id_ordenes = dt_costos.id_ordenes
                    left join dt_fechas_op on dt_ordenes.id_ordenes = dt_fechas_op.id_ordenes
                    where dt_ordenes.estado <> 0 and year(dt_fechas_op.fecha_ingreso) in (2022,2023,2024) and dt_costos.n_ordenes <> 0 and dt_costos.id_tipo_costo in (4,8) and   dt_costos.cierre = 0 
                    
                    group by dt_ordenes.n_ordenes ORDER BY dt_costos.n_ordenes,dt_costos.id_ordenes,dt_costos.id_costo;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`ordenesProgramadas`()
                    select 
                    
                    o.n_ordenes,
                    o.ref_general
                    
                    from dt_ordenes o right join dt_tareas_costo t on o.id_ordenes = t.id_ordenes 
                    
                    where o.estado<>0 group by o.n_ordenes;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`programacionAreaOPItem`(id_area int,n_ordenes int,id_ordenes int)
                    select 
                    dt_empresa.nombre_empresa,
                    dt_ordenes.ref_general,
                    dt_acabados.cod,
                    dt_acabados.acabado,
                    dt_costos.cant_sol,
                    dt_acabados.id_area, 
                    case when dt_acabados.id_area = 17 then 'IMPRESION DIGITAL'
                        when dt_acabados.id_area= 18 then 'DECORACION'
                        when dt_acabados.id_area=13 then 'METALMECANICA'
                        when dt_acabados.id_area=14 then 'PINTURA' 
                        when dt_acabados.id_area=15 then 'SUSTRATOS' 
                        when dt_acabados.id_area=16 then 'ENSAMBLE Y TERMINADO'
                        when dt_acabados.id_area=19 then 'DESPACHOS' 
                        else 'OTROS' end as 'area',
                    dt_costos.n_ordenes,
                    dt_costos.id_ordenes,
                    dt_costos.comentarios,
                    dt_costos.id_costo,
                    dt_costos.gantt_des,
                    dt_ordenes.cod,
                    dt_ordenes.referencia,
                    dt_costos.estado,
                    dt_ordenes.id_ordenes,
                    dt_ordenes.id_cotizacion,
                    dt_ordenes.item_op,
                    dt_ordenes.id_vend,
                    dt_fechas_op.fecha_ingreso 
                    from dt_costos 
                    inner join dt_acabados on dt_costos.id_acabados =+ dt_acabados.id_acabados
                    left join dt_ordenes on dt_ordenes.id_ordenes = dt_costos.id_ordenes
                    left join dt_tareas_costo on dt_tareas_costo.id_costo = dt_costos.id_costo
                    left join dt_fechas_op on dt_ordenes.id_ordenes = dt_fechas_op.id_ordenes
                    join dt_empresa on dt_ordenes.id_cliente=dt_empresa.id_cliente
                    where dt_ordenes.estado <> 0 and year(dt_fechas_op.fecha_ingreso) in (2022,2023,2024) and dt_costos.n_ordenes <> 0 and dt_costos.id_tipo_costo = 4 and   dt_costos.cierre = 0 
                    and dt_acabados.id_area = id_area and dt_ordenes.n_ordenes = n_ordenes and dt_ordenes.id_ordenes = id_ordenes
                    group by dt_costos.id_costo ORDER BY dt_costos.n_ordenes,dt_costos.id_ordenes,dt_costos.id_costo,dt_acabados.id_area,dt_acabados.cod;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`programacionxAreayItem`(id_area int,id_ordenes int)
                    select 
                    dt_acabados.cod,
                    dt_acabados.acabado,
                    dt_costos.cant_sol,
                    dt_acabados.id_area, 
                    case when dt_acabados.id_area = 17 then 'IMPRESION DIGITAL'
                        when dt_acabados.id_area= 18 then 'DECORACION'
                        when dt_acabados.id_area=13 then 'METALMECANICA'
                        when dt_acabados.id_area=14 then 'PINTURA' 
                        when dt_acabados.id_area=15 then 'SUSTRATOS' 
                        when dt_acabados.id_area=16 then 'ENSAMBLE Y TERMINADO'
                        when dt_acabados.id_area=19 then 'DESPACHOS' 
                        else 'OTROS' end as 'area',
                    dt_costos.n_ordenes,
                    dt_costos.n_cotiza,
                    dt_costos.id_ordenes,
                    dt_costos.comentarios,
                    dt_costos.id_costo,
                    dt_costos.gantt_des,
                    dt_ordenes.cod,
                    dt_ordenes.referencia,
                    dt_costos.estado,
                    dt_ordenes.id_ordenes,
                    dt_ordenes.id_cotizacion,
                    dt_ordenes.item_op,
                    dt_ordenes.id_vend,
                    dt_fechas_op.fecha_ingreso 
                    from dt_costos 
                    inner join dt_acabados on dt_costos.id_acabados =+ dt_acabados.id_acabados
                    left join dt_ordenes on dt_ordenes.id_ordenes = dt_costos.id_ordenes
                    left join dt_tareas_costo on dt_tareas_costo.id_costo = dt_costos.id_costo
                    left join dt_fechas_op on dt_ordenes.id_ordenes = dt_fechas_op.id_ordenes
                    where dt_ordenes.estado <> 0 and year(dt_fechas_op.fecha_ingreso) in (2022,2023,2024) and dt_costos.n_ordenes <> 0 and dt_costos.id_tipo_costo in (4,8) and   dt_costos.cierre = 0 
                    and dt_acabados.id_area = id_area and dt_ordenes.id_ordenes = id_ordenes
                    group by dt_costos.id_costo ORDER BY dt_costos.n_ordenes,dt_costos.id_ordenes,dt_costos.id_costo,dt_acabados.id_area,dt_acabados.cod;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`programacionxAreayOp`(id_area int,n_ordenes int)
                    select 
                    dt_acabados.cod,
                    dt_acabados.acabado,
                    dt_costos.cant_sol,
                    dt_acabados.id_area, 
                    case when dt_acabados.id_area = 17 then 'IMPRESION DIGITAL'
                        when dt_acabados.id_area= 18 then 'DECORACION'
                        when dt_acabados.id_area=13 then 'METALMECANICA'
                        when dt_acabados.id_area=14 then 'PINTURA' 
                        when dt_acabados.id_area=15 then 'SUSTRATOS' 
                        when dt_acabados.id_area=16 then 'ENSAMBLE Y TERMINADO'
                        when dt_acabados.id_area=19 then 'DESPACHOS' 
                        else 'OTROS' end as area,
                    dt_costos.n_ordenes,
                    dt_costos.n_cotiza,
                    dt_costos.id_ordenes,
                    dt_costos.comentarios,
                    dt_costos.id_costo,
                    dt_costos.gantt_des,
                    dt_ordenes.cod,
                    dt_ordenes.referencia,
                    dt_ordenes.id_cliente,
                    dt_ordenes.ref_general,
                    dt_costos.estado,
                    dt_ordenes.id_ordenes,
                    dt_ordenes.id_cotizacion,
                    dt_ordenes.item_op,
                    dt_ordenes.id_vend,
                    dt_fechas_op.fecha_ingreso 
                    from dt_costos 
                    inner join dt_acabados on dt_costos.id_acabados =+ dt_acabados.id_acabados
                    left join dt_ordenes on dt_ordenes.id_ordenes = dt_costos.id_ordenes
                    left join dt_tareas_costo on dt_tareas_costo.id_costo = dt_costos.id_costo
                    left join dt_fechas_op on dt_ordenes.id_ordenes = dt_fechas_op.id_ordenes
                    where dt_ordenes.estado <> 0 and year(dt_fechas_op.fecha_ingreso) in (2022,2023,2024) and dt_costos.n_ordenes <> 0 and dt_costos.id_tipo_costo in (4,8) and   dt_costos.estado <> 0 
                    and dt_acabados.id_area = id_area and dt_ordenes.n_ordenes = n_ordenes
                    group by dt_costos.id_costo ORDER BY dt_costos.n_ordenes,dt_costos.id_ordenes,dt_costos.id_costo,dt_acabados.id_area,dt_acabados.cod;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`programacionxItem`(id_ordenes int)
                    select 
                    dt_acabados.cod,
                    dt_acabados.acabado,
                    dt_costos.cant_sol,
                    dt_acabados.id_area, 
                    case when dt_acabados.id_area = 17 then 'IMPRESION DIGITAL'
                        when dt_acabados.id_area= 18 then 'DECORACION'
                        when dt_acabados.id_area=13 then 'METALMECANICA'
                        when dt_acabados.id_area=14 then 'PINTURA' 
                        when dt_acabados.id_area=15 then 'SUSTRATOS' 
                        when dt_acabados.id_area=16 then 'ENSAMBLE Y TERMINADO'
                        when dt_acabados.id_area=19 then 'DESPACHOS' 
                        else 'OTROS' end,
                    dt_costos.n_ordenes,
                    dt_costos.n_cotiza,
                    dt_costos.id_ordenes,
                    dt_costos.comentarios,
                    dt_costos.id_costo,
                    dt_costos.gantt_des,
                    dt_ordenes.cod,
                    dt_ordenes.referencia,
                    dt_costos.estado,
                    dt_ordenes.id_ordenes,
                    dt_ordenes.id_cotizacion,
                    dt_ordenes.item_op,
                    dt_ordenes.id_vend,
                    dt_fechas_op.fecha_ingreso 
                    from dt_costos 
                    inner join dt_acabados on dt_costos.id_acabados =+ dt_acabados.id_acabados
                    left join dt_ordenes on dt_ordenes.id_ordenes = dt_costos.id_ordenes
                    left join dt_tareas_costo on dt_tareas_costo.id_costo = dt_costos.id_costo
                    left join dt_fechas_op on dt_ordenes.id_ordenes = dt_fechas_op.id_ordenes
                    where dt_ordenes.estado <> 0 and year(dt_fechas_op.fecha_ingreso) in (2022,2023,2024) and dt_costos.n_ordenes <> 0 and dt_costos.id_tipo_costo in (4,8) and   dt_costos.cierre = 0 
                    and dt_ordenes.id_ordenes = id_ordenes
                    group by dt_costos.id_costo ORDER BY dt_costos.n_ordenes,dt_costos.id_ordenes,dt_costos.id_costo,dt_acabados.id_area,dt_acabados.cod;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`programacionxOp`(n_ordenes int)
                    select 
                    dt_acabados.cod,
                    dt_acabados.acabado,
                    dt_costos.cant_sol,
                    dt_acabados.id_area, 
                    case when dt_acabados.id_area = 17 then 'IMPRESION DIGITAL'
                        when dt_acabados.id_area= 18 then 'DECORACION'
                        when dt_acabados.id_area=13 then 'METALMECANICA'
                        when dt_acabados.id_area=14 then 'PINTURA' 
                        when dt_acabados.id_area=15 then 'SUSTRATOS' 
                        when dt_acabados.id_area=16 then 'ENSAMBLE Y TERMINADO'
                        when dt_acabados.id_area=19 then 'DESPACHOS' 
                        else 'OTROS' end as area,
                    dt_costos.n_ordenes,
                    dt_costos.n_cotiza,
                    dt_costos.id_ordenes,
                    dt_costos.comentarios,
                    dt_costos.id_costo,
                    dt_costos.gantt_des,
                    dt_ordenes.cod,
                    dt_ordenes.referencia,
                    dt_ordenes.id_cliente,
                    dt_ordenes.ref_general,
                    dt_costos.estado,
                    dt_ordenes.id_ordenes,
                    dt_ordenes.id_cotizacion,
                    dt_ordenes.item_op,
                    dt_ordenes.id_vend,
                    dt_fechas_op.fecha_ingreso 
                    from dt_costos 
                    inner join dt_acabados on dt_costos.id_acabados =+ dt_acabados.id_acabados
                    left join dt_ordenes on dt_ordenes.id_ordenes = dt_costos.id_ordenes
                    left join dt_tareas_costo on dt_tareas_costo.id_costo = dt_costos.id_costo
                    left join dt_fechas_op on dt_ordenes.id_ordenes = dt_fechas_op.id_ordenes
                    where dt_ordenes.estado <> 0 and year(dt_fechas_op.fecha_ingreso) in (2022,2023,2024)and dt_costos.n_ordenes <> 0 and dt_costos.id_tipo_costo = 4 and   dt_costos.estado <> 0 
                    and dt_ordenes.n_ordenes = n_ordenes
                    group by dt_costos.id_costo ORDER BY dt_costos.n_ordenes,dt_costos.id_ordenes,dt_costos.id_costo,dt_acabados.id_area,dt_acabados.cod;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`programacionxOPyItem`(n_ordenes int,id_ordenes int)
                    select 
                    dt_empresa.nombre_empresa,
                    dt_ordenes.ref_general,
                    dt_acabados.cod,
                    dt_acabados.acabado,
                    dt_costos.cant_sol,
                    dt_acabados.id_area, 
                    case when dt_acabados.id_area = 17 then 'IMPRESION DIGITAL'
                        when dt_acabados.id_area= 18 then 'DECORACION'
                        when dt_acabados.id_area=13 then 'METALMECANICA'
                        when dt_acabados.id_area=14 then 'PINTURA' 
                        when dt_acabados.id_area=15 then 'SUSTRATOS' 
                        when dt_acabados.id_area=16 then 'ENSAMBLE Y TERMINADO'
                        when dt_acabados.id_area=19 then 'DESPACHOS' 
                        else 'OTROS' end as 'area',
                    dt_costos.n_ordenes,
                    dt_costos.id_ordenes,
                    dt_costos.comentarios,
                    dt_costos.id_costo,
                    dt_costos.gantt_des,
                    dt_ordenes.cod,
                    dt_ordenes.referencia,
                    dt_costos.estado,
                    dt_ordenes.id_ordenes,
                    dt_ordenes.id_cotizacion,
                    dt_ordenes.item_op,
                    dt_ordenes.id_vend,
                    dt_fechas_op.fecha_ingreso 
                    from dt_costos 
                    inner join dt_acabados on dt_costos.id_acabados =+ dt_acabados.id_acabados
                    left join dt_ordenes on dt_ordenes.id_ordenes = dt_costos.id_ordenes
                    left join dt_tareas_costo on dt_tareas_costo.id_costo = dt_costos.id_costo
                    left join dt_fechas_op on dt_ordenes.id_ordenes = dt_fechas_op.id_ordenes
                    join dt_empresa on dt_ordenes.id_cliente=dt_empresa.id_cliente
                    where dt_ordenes.estado <> 0 and year(dt_fechas_op.fecha_ingreso) in (2022,2023,2024) and dt_costos.n_ordenes <> 0 and dt_costos.id_tipo_costo = 4 and   dt_costos.estado <> 0 
                    and dt_ordenes.n_ordenes = n_ordenes and dt_ordenes.id_ordenes = id_ordenes
                    group by dt_costos.id_costo ORDER BY dt_costos.n_ordenes,dt_costos.id_ordenes,dt_costos.id_costo,dt_acabados.id_area,dt_acabados.cod;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`reporteCostos`(fecha_inicio datetime,fecha_fin datetime)
                    select o.n_ordenes,cl.nom_empresa,o.nit,ca.nombre_categoria,u.nombre_usuario,
                    sum(case when c.id_tipo_costo = 9 and c.id_clase_costo != 2 or c.id_tipo_costo = 9 and c.id_clase_costo is null then c.valor_total else c.valor_total = 1 end) as 'viaticos_prod',
                    sum(case when c.id_tipo_costo = 9 and c.id_clase_costo = 2 then c.valor_total else c.valor_total = 1 end) as 'viaticos_log',
                    sum(case when c.id_tipo_costo = 3 and c.id_clase_costo != 2 or c.id_tipo_costo = 3 and c.id_clase_costo is null then c.valor_total else c.valor_total = 1 end) as 'insumos_prod',
                    sum(case when c.id_tipo_costo = 3 and c.id_clase_costo = 2 then c.valor_total else c.valor_total = 1 end) as 'insumos_log',
                    sum(case when c.id_tipo_costo = 1 then c.valor_total else c.valor_total = 1 end) as 'mp',
                    sum(case when c.id_tipo_costo = 4 and c.id_clase_costo != 2 or c.id_tipo_costo = 4 and c.id_clase_costo is null then c.valor_total else c.valor_total = 1 end) as 'mo_prod',
                    sum(case when c.id_tipo_costo = 4 and c.id_clase_costo = 2 then c.valor_total else c.valor_total = 1 end) as 'mo_log',
                    sum(case when c.id_tipo_costo = 5 and c.id_clase_costo != 2 or c.id_tipo_costo = 5 and c.id_clase_costo is null then c.valor_total else c.valor_total = 1 end) as 'transporte_prod',
                    sum(case when c.id_tipo_costo = 5 and c.id_clase_costo = 2 then c.valor_total else c.valor_total = 1 end) as 'transporte_log',
                    sum(case when c.id_tipo_costo = 8 and c.id_clase_costo != 2 or c.id_tipo_costo = 8 and c.id_clase_costo is null then c.valor_total else c.valor_total = 1 end) as 'terceros_prod',
                    sum(case when c.id_tipo_costo = 8 and c.id_clase_costo = 2 then c.valor_total else c.valor_total = 1 end) as 'terceros_log',
                    sum(case when c.id_tipo_costo = 6 then c.valor_total else c.valor_total = 1 end) as 'otros_directos',
                    sum(case when c.id_tipo_costo = 7 then c.valor_total else c.valor_total = 1 end) as 'otros_indirectos'
                    from dt_ordenes o 
                    inner join dt_fechas_op f on o.id_ordenes = f.id_ordenes
                    inner join dt_costos c on o.id_ordenes = c.id_ordenes
                    left join dt_clientes cl on o.id_cliente = cl.id_cliente 
                    left join dt_categoria ca on o.id_categoria = ca.id_categoria 
                    left join `user` u on o.id_vend = u.id
                    where f.fecha_ingreso between fecha_inicio and fecha_fin group by o.n_ordenes;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`tablaKardex`(ano int,mes int)
                    (select i.codigo_prod,i.producto,r.n_rotacion,r.cantidad,r.fecha,r.id_ordenes,r.id_tipo_rotacion,r.vr_total,null as 'id_kardex' from dt_inventario i  
                    right join dt_rotacion r on r.id_inventario = i.id_inventario
                    where r.id_tipo_rotacion in (9,26) and r.estado != 2 
                    and year(r.fecha) = ano  AND month(r.fecha) = mes)
                    union
                    (select codigo_prod,producto,1 as 'n_rotacion',null as 'cantidad',null as 'fecha',null as 'id_ordenes',null as 'id_tipo_rotacion',null as 'vr_total',id_kardex 
                    from dt_kardex)
                    order by producto,n_rotacion,fecha;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`tareasPxAreaOPItem`(id_area int,n_ordenes int, id_ordenes int)
                    select
                    
                    t.id_costo,
                    o.id_ordenes,
                    o.n_ordenes,
                    o.referencia,
                    c.nom_empresa,
                    o.ref_general,
                    t.id_area,
                    case when t.id_area = 17 then 'IMPRESION DIGITAL'
                        when t.id_area= 18 then 'DECORACION'
                        when t.id_area=13 then 'METALMECANICA'
                        when t.id_area=14 then 'PINTURA' 
                        when t.id_area=15 then 'SUSTRATOS' 
                        when t.id_area=16 then 'ENSAMBLE Y TERMINADO'
                        when t.id_area=19 then 'DESPACHOS' 
                        else 'OTROS' end as area,
                    t.nombre_costo,
                    t.can_horas,
                    t.fecha_inicio,
                    t.fecha_final,
                    u.nombre_usuario
                    
                    from dt_ordenes o 
                    inner join dt_clientes c on o.id_cliente = c.id_cliente
                    inner join dt_tareas_costo t on t.id_ordenes = o.id_ordenes 
                    inner join `user` u on u.id = t.id_vendedor
                    where t.id_area = id_area and o.n_ordenes = n_ordenes and o.id_ordenes = id_ordenes  group by t.id_costo;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`tareasPxAreayOP`(id_area int, n_ordenes int)
                    select
                    
                    t.id_costo,
                    o.id_ordenes,
                    o.n_ordenes,
                    o.referencia,
                    c.nom_empresa,
                    o.ref_general,
                    t.id_area,
                    case when t.id_area = 17 then 'IMPRESION DIGITAL'
                        when t.id_area= 18 then 'DECORACION'
                        when t.id_area=13 then 'METALMECANICA'
                        when t.id_area=14 then 'PINTURA' 
                        when t.id_area=15 then 'SUSTRATOS' 
                        when t.id_area=16 then 'ENSAMBLE Y TERMINADO'
                        when t.id_area=19 then 'DESPACHOS' 
                        else 'OTROS' end as area,
                    t.nombre_costo,
                    t.can_horas,
                    t.fecha_inicio,
                    t.fecha_final,
                    u.nombre_usuario
                    
                    from dt_ordenes o 
                    inner join dt_clientes c on o.id_cliente = c.id_cliente
                    inner join dt_tareas_costo t on t.id_ordenes = o.id_ordenes 
                    inner join `user` u on u.id = t.id_vendedor
                    where t.id_area = id_area and o.n_ordenes = n_ordenes  group by t.id_costo;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`tareasPxOP`(n_ordenes int)
                    select 
                    
                    t.id_costo,
                    o.id_ordenes,
                    o.n_ordenes,
                    o.referencia,
                    c.nom_empresa,
                    o.ref_general,
                    t.id_area,
                    case when t.id_area = 17 then 'IMPRESION DIGITAL'
                        when t.id_area= 18 then 'DECORACION'
                        when t.id_area=13 then 'METALMECANICA'
                        when t.id_area=14 then 'PINTURA' 
                        when t.id_area=15 then 'SUSTRATOS' 
                        when t.id_area=16 then 'ENSAMBLE Y TERMINADO'
                        when t.id_area=19 then 'DESPACHOS' 
                        else 'OTROS' end as area,
                    t.nombre_costo,
                    t.can_horas,
                    t.fecha_inicio,
                    t.fecha_final,
                    u.nombre_usuario
                    
                    from dt_ordenes o 
                    inner join dt_clientes c on o.id_cliente = c.id_cliente
                    inner join dt_tareas_costo t on t.id_ordenes = o.id_ordenes 
                    inner join `user` u on u.id = t.id_vendedor
                    where o.n_ordenes = n_ordenes  group by t.id_costo;
                    
                    CREATE DEFINER=`masterUS`@`%` PROCEDURE `migracion_prueba`.`tareasPxOPyItem`(n_ordenes int, id_ordenes int)
                    select
                    
                    t.id_costo,
                    o.id_ordenes,
                    o.n_ordenes,
                    o.referencia,
                    c.nom_empresa,
                    o.ref_general,
                    t.id_area,
                    case when t.id_area = 17 then 'IMPRESION DIGITAL'
                        when t.id_area= 18 then 'DECORACION'
                        when t.id_area=13 then 'METALMECANICA'
                        when t.id_area=14 then 'PINTURA' 
                        when t.id_area=15 then 'SUSTRATOS' 
                        when t.id_area=16 then 'ENSAMBLE Y TERMINADO'
                        when t.id_area=19 then 'DESPACHOS' 
                        else 'OTROS' end as area,
                    t.nombre_costo,
                    t.can_horas,
                    t.fecha_inicio,
                    t.fecha_final,
                    u.nombre_usuario
                    
                    from dt_ordenes o 
                    inner join dt_clientes c on o.id_cliente = c.id_cliente
                    inner join dt_tareas_costo t on t.id_ordenes = o.id_ordenes 
                    inner join `user` u on u.id = t.id_vendedor
                    where o.n_ordenes = n_ordenes and o.id_ordenes = id_ordenes  group by t.id_costo;
                ");

            }catch(PDOException $e){
                echo "Hubo un error en la creación de los procedimientos almacenados ".$e->getMessage();exit;
            }

            return "Se ha completado la creación de procedimientos almacenados";

        }
        public static function creaVistasBd($conexion_migracion_prueba){

            try{

                $conexion_migracion_prueba->exec("
                    -- migracion_prueba.vw_1meses_home source

                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_1meses_home` AS
                    select
                        `migracion_prueba`.`dt_factura`.`id_factura` AS `id_factura`,
                        `migracion_prueba`.`dt_factura`.`n_factura` AS `n_factura`,
                        `migracion_prueba`.`dt_factura`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_factura`.`id_usuario` AS `id_usuario`,
                        `migracion_prueba`.`dt_factura`.`id_usuario_act` AS `id_usuario_act`,
                        `migracion_prueba`.`dt_factura`.`id_vendedor` AS `id_vendedor`,
                        `migracion_prueba`.`dt_factura`.`id_cliente` AS `id_cliente`,
                        `migracion_prueba`.`dt_factura`.`valor_venta` AS `valor_venta`,
                        `migracion_prueba`.`dt_factura`.`valor` AS `valor`,
                        `migracion_prueba`.`dt_factura`.`fecha_creacion` AS `fecha_creacion`,
                        `migracion_prueba`.`dt_factura`.`fecha_actualizacion` AS `fecha_actualizacion`,
                        `migracion_prueba`.`dt_factura`.`fecha_factura` AS `fecha_factura`,
                        `migracion_prueba`.`dt_factura`.`fecha_vencimiento` AS `fecha_vencimiento`,
                        `migracion_prueba`.`dt_factura`.`fecha_recaudo` AS `fecha_recaudo`,
                        `migracion_prueba`.`dt_factura`.`cotizacion` AS `cotizacion`,
                        `migracion_prueba`.`dt_factura`.`id_forma_pago` AS `id_forma_pago`,
                        `migracion_prueba`.`dt_factura`.`concepto` AS `concepto`,
                        `migracion_prueba`.`dt_factura`.`estado` AS `estado`,
                        `migracion_prueba`.`dt_factura`.`plazo` AS `plazo`,
                        `migracion_prueba`.`dt_factura`.`iva` AS `iva`,
                        `migracion_prueba`.`dt_factura`.`r_fuente` AS `r_fuente`,
                        `migracion_prueba`.`dt_factura`.`r_iva` AS `r_iva`,
                        `migracion_prueba`.`dt_factura`.`r_ica` AS `r_ica`,
                        `migracion_prueba`.`dt_factura`.`nota_credito` AS `nota_credito`,
                        `migracion_prueba`.`dt_factura`.`puc_cuenta` AS `puc_cuenta`,
                        `migracion_prueba`.`dt_factura`.`cta_iva` AS `cta_iva`,
                        `migracion_prueba`.`dt_factura`.`cta_rfte` AS `cta_rfte`,
                        `migracion_prueba`.`dt_factura`.`cta_rtiva` AS `cta_rtiva`,
                        `migracion_prueba`.`dt_factura`.`cta_rtica` AS `cta_rtica`,
                        `migracion_prueba`.`dt_factura`.`comision` AS `comision`,
                        `migracion_prueba`.`dt_factura`.`anticipo` AS `anticipo`,
                        `migracion_prueba`.`dt_factura`.`cta_anticipo` AS `cta_anticipo`,
                        `migracion_prueba`.`dt_factura`.`rc_anticipo` AS `rc_anticipo`,
                        `migracion_prueba`.`dt_factura`.`contacto_factura` AS `contacto_factura`,
                        `migracion_prueba`.`dt_factura`.`aplica_vt` AS `aplica_vt`,
                        `migracion_prueba`.`dt_factura`.`estado_traza` AS `estado_traza`,
                        `migracion_prueba`.`dt_factura`.`ano_indicador` AS `ano_indicador`,
                        `migracion_prueba`.`dt_factura`.`estado_an` AS `estado_an`,
                        `migracion_prueba`.`dt_factura`.`observaciones` AS `observaciones`,
                        `migracion_prueba`.`dt_factura`.`items` AS `items`,
                        `migracion_prueba`.`dt_factura`.`valor_bruto` AS `valor_bruto`,
                        `migracion_prueba`.`dt_factura`.`orden_compra` AS `orden_compra`,
                        `migracion_prueba`.`dt_factura`.`cantidad` AS `cantidad`,
                        `migracion_prueba`.`dt_factura`.`codigo` AS `codigo`,
                        `migracion_prueba`.`dt_factura`.`referencia` AS `referencia`,
                        `migracion_prueba`.`dt_factura`.`id_codigo_categoria` AS `id_codigo_categoria`,
                        `migracion_prueba`.`dt_factura`.`vr_unidad` AS `vr_unidad`,
                        `migracion_prueba`.`dt_factura`.`descuento` AS `descuento`,
                        `migracion_prueba`.`dt_factura`.`vr_total` AS `vr_total`,
                        `migracion_prueba`.`dt_factura`.`id_puc_oc` AS `id_puc_oc`,
                        `migracion_prueba`.`dt_factura`.`abonos` AS `abonos`,
                        `migracion_prueba`.`dt_factura`.`saldo` AS `saldo`,
                        `migracion_prueba`.`dt_factura`.`letra` AS `letra`,
                        `migracion_prueba`.`dt_factura`.`letra_cta` AS `letra_cta`,
                        `migracion_prueba`.`dt_factura`.`puc_contra` AS `puc_contra`,
                        `migracion_prueba`.`dt_factura`.`anuladas` AS `anuladas`,
                        `migracion_prueba`.`dt_factura`.`id_remision` AS `id_remision`,
                        `migracion_prueba`.`dt_factura`.`nit` AS `nit`
                    from
                        `migracion_prueba`.`dt_factura`
                    where
                        ((month(`migracion_prueba`.`dt_factura`.`fecha_factura`) = (
                        select
                            extract(month from (select curdate()))))
                            and (year(`migracion_prueba`.`dt_factura`.`fecha_factura`) = (
                            select
                                extract(year from (select curdate())))))
                    group by
                        `migracion_prueba`.`dt_factura`.`n_factura`
                    order by
                        `migracion_prueba`.`dt_factura`.`n_factura`;
                    
                    
                    -- migracion_prueba.vw_1meses_home_barrazul source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_1meses_home_barrazul` AS
                    select
                        sum(`o`.`v_total`) AS `barra_azul`
                    from
                        (`migracion_prueba`.`dt_ordenes` `o`
                    join `migracion_prueba`.`dt_fechas_op` `f` on
                        ((`o`.`id_ordenes` = `f`.`id_ordenes`)))
                    where
                        ((`o`.`cobro` <> 0)
                            and (month(`f`.`fecha_ingreso`) = (
                            select
                                extract(month from (select curdate()))))
                                and (year(`f`.`fecha_ingreso`) = (
                                select
                                    extract(year from (select curdate())))));
                    
                    
                    -- migracion_prueba.vw_2meses_home source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_2meses_home` AS
                    select
                        `migracion_prueba`.`dt_factura`.`id_factura` AS `id_factura`,
                        `migracion_prueba`.`dt_factura`.`n_factura` AS `n_factura`,
                        `migracion_prueba`.`dt_factura`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_factura`.`id_usuario` AS `id_usuario`,
                        `migracion_prueba`.`dt_factura`.`id_usuario_act` AS `id_usuario_act`,
                        `migracion_prueba`.`dt_factura`.`id_vendedor` AS `id_vendedor`,
                        `migracion_prueba`.`dt_factura`.`id_cliente` AS `id_cliente`,
                        `migracion_prueba`.`dt_factura`.`valor_venta` AS `valor_venta`,
                        `migracion_prueba`.`dt_factura`.`valor` AS `valor`,
                        `migracion_prueba`.`dt_factura`.`fecha_creacion` AS `fecha_creacion`,
                        `migracion_prueba`.`dt_factura`.`fecha_actualizacion` AS `fecha_actualizacion`,
                        `migracion_prueba`.`dt_factura`.`fecha_factura` AS `fecha_factura`,
                        `migracion_prueba`.`dt_factura`.`fecha_vencimiento` AS `fecha_vencimiento`,
                        `migracion_prueba`.`dt_factura`.`fecha_recaudo` AS `fecha_recaudo`,
                        `migracion_prueba`.`dt_factura`.`cotizacion` AS `cotizacion`,
                        `migracion_prueba`.`dt_factura`.`id_forma_pago` AS `id_forma_pago`,
                        `migracion_prueba`.`dt_factura`.`concepto` AS `concepto`,
                        `migracion_prueba`.`dt_factura`.`estado` AS `estado`,
                        `migracion_prueba`.`dt_factura`.`plazo` AS `plazo`,
                        `migracion_prueba`.`dt_factura`.`iva` AS `iva`,
                        `migracion_prueba`.`dt_factura`.`r_fuente` AS `r_fuente`,
                        `migracion_prueba`.`dt_factura`.`r_iva` AS `r_iva`,
                        `migracion_prueba`.`dt_factura`.`r_ica` AS `r_ica`,
                        `migracion_prueba`.`dt_factura`.`nota_credito` AS `nota_credito`,
                        `migracion_prueba`.`dt_factura`.`puc_cuenta` AS `puc_cuenta`,
                        `migracion_prueba`.`dt_factura`.`cta_iva` AS `cta_iva`,
                        `migracion_prueba`.`dt_factura`.`cta_rfte` AS `cta_rfte`,
                        `migracion_prueba`.`dt_factura`.`cta_rtiva` AS `cta_rtiva`,
                        `migracion_prueba`.`dt_factura`.`cta_rtica` AS `cta_rtica`,
                        `migracion_prueba`.`dt_factura`.`comision` AS `comision`,
                        `migracion_prueba`.`dt_factura`.`anticipo` AS `anticipo`,
                        `migracion_prueba`.`dt_factura`.`cta_anticipo` AS `cta_anticipo`,
                        `migracion_prueba`.`dt_factura`.`rc_anticipo` AS `rc_anticipo`,
                        `migracion_prueba`.`dt_factura`.`contacto_factura` AS `contacto_factura`,
                        `migracion_prueba`.`dt_factura`.`aplica_vt` AS `aplica_vt`,
                        `migracion_prueba`.`dt_factura`.`estado_traza` AS `estado_traza`,
                        `migracion_prueba`.`dt_factura`.`ano_indicador` AS `ano_indicador`,
                        `migracion_prueba`.`dt_factura`.`estado_an` AS `estado_an`,
                        `migracion_prueba`.`dt_factura`.`observaciones` AS `observaciones`,
                        `migracion_prueba`.`dt_factura`.`items` AS `items`,
                        `migracion_prueba`.`dt_factura`.`valor_bruto` AS `valor_bruto`,
                        `migracion_prueba`.`dt_factura`.`orden_compra` AS `orden_compra`,
                        `migracion_prueba`.`dt_factura`.`cantidad` AS `cantidad`,
                        `migracion_prueba`.`dt_factura`.`codigo` AS `codigo`,
                        `migracion_prueba`.`dt_factura`.`referencia` AS `referencia`,
                        `migracion_prueba`.`dt_factura`.`id_codigo_categoria` AS `id_codigo_categoria`,
                        `migracion_prueba`.`dt_factura`.`vr_unidad` AS `vr_unidad`,
                        `migracion_prueba`.`dt_factura`.`descuento` AS `descuento`,
                        `migracion_prueba`.`dt_factura`.`vr_total` AS `vr_total`,
                        `migracion_prueba`.`dt_factura`.`id_puc_oc` AS `id_puc_oc`,
                        `migracion_prueba`.`dt_factura`.`abonos` AS `abonos`,
                        `migracion_prueba`.`dt_factura`.`saldo` AS `saldo`,
                        `migracion_prueba`.`dt_factura`.`letra` AS `letra`,
                        `migracion_prueba`.`dt_factura`.`letra_cta` AS `letra_cta`,
                        `migracion_prueba`.`dt_factura`.`puc_contra` AS `puc_contra`,
                        `migracion_prueba`.`dt_factura`.`anuladas` AS `anuladas`,
                        `migracion_prueba`.`dt_factura`.`id_remision` AS `id_remision`,
                        `migracion_prueba`.`dt_factura`.`nit` AS `nit`
                    from
                        `migracion_prueba`.`dt_factura`
                    where
                        ((month(`migracion_prueba`.`dt_factura`.`fecha_factura`) = (
                        select
                            extract(month from (select (curdate() - interval 1 month)))))
                            and (year(`migracion_prueba`.`dt_factura`.`fecha_factura`) = (
                            select
                                extract(year from (select (curdate() - interval 1 month))))))
                    group by
                        `migracion_prueba`.`dt_factura`.`n_factura`
                    order by
                        `migracion_prueba`.`dt_factura`.`n_factura`;
                    
                    
                    -- migracion_prueba.vw_2meses_home_barrazul source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_2meses_home_barrazul` AS
                    select
                        sum(`o`.`v_total`) AS `barra_azul`
                    from
                        (`migracion_prueba`.`dt_ordenes` `o`
                    join `migracion_prueba`.`dt_fechas_op` `f` on
                        ((`o`.`id_ordenes` = `f`.`id_ordenes`)))
                    where
                        ((`o`.`cobro` <> 0)
                            and (month(`f`.`fecha_ingreso`) = (
                            select
                                extract(month from (select (curdate() - interval 1 month)))))
                                and (year(`f`.`fecha_ingreso`) = (
                                select
                                    extract(year from (select (curdate() - interval 1 month))))));
                    
                    
                    -- migracion_prueba.vw_3meses_home source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_3meses_home` AS
                    select
                        `migracion_prueba`.`dt_factura`.`id_factura` AS `id_factura`,
                        `migracion_prueba`.`dt_factura`.`n_factura` AS `n_factura`,
                        `migracion_prueba`.`dt_factura`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_factura`.`id_usuario` AS `id_usuario`,
                        `migracion_prueba`.`dt_factura`.`id_usuario_act` AS `id_usuario_act`,
                        `migracion_prueba`.`dt_factura`.`id_vendedor` AS `id_vendedor`,
                        `migracion_prueba`.`dt_factura`.`id_cliente` AS `id_cliente`,
                        `migracion_prueba`.`dt_factura`.`valor_venta` AS `valor_venta`,
                        `migracion_prueba`.`dt_factura`.`valor` AS `valor`,
                        `migracion_prueba`.`dt_factura`.`fecha_creacion` AS `fecha_creacion`,
                        `migracion_prueba`.`dt_factura`.`fecha_actualizacion` AS `fecha_actualizacion`,
                        `migracion_prueba`.`dt_factura`.`fecha_factura` AS `fecha_factura`,
                        `migracion_prueba`.`dt_factura`.`fecha_vencimiento` AS `fecha_vencimiento`,
                        `migracion_prueba`.`dt_factura`.`fecha_recaudo` AS `fecha_recaudo`,
                        `migracion_prueba`.`dt_factura`.`cotizacion` AS `cotizacion`,
                        `migracion_prueba`.`dt_factura`.`id_forma_pago` AS `id_forma_pago`,
                        `migracion_prueba`.`dt_factura`.`concepto` AS `concepto`,
                        `migracion_prueba`.`dt_factura`.`estado` AS `estado`,
                        `migracion_prueba`.`dt_factura`.`plazo` AS `plazo`,
                        `migracion_prueba`.`dt_factura`.`iva` AS `iva`,
                        `migracion_prueba`.`dt_factura`.`r_fuente` AS `r_fuente`,
                        `migracion_prueba`.`dt_factura`.`r_iva` AS `r_iva`,
                        `migracion_prueba`.`dt_factura`.`r_ica` AS `r_ica`,
                        `migracion_prueba`.`dt_factura`.`nota_credito` AS `nota_credito`,
                        `migracion_prueba`.`dt_factura`.`puc_cuenta` AS `puc_cuenta`,
                        `migracion_prueba`.`dt_factura`.`cta_iva` AS `cta_iva`,
                        `migracion_prueba`.`dt_factura`.`cta_rfte` AS `cta_rfte`,
                        `migracion_prueba`.`dt_factura`.`cta_rtiva` AS `cta_rtiva`,
                        `migracion_prueba`.`dt_factura`.`cta_rtica` AS `cta_rtica`,
                        `migracion_prueba`.`dt_factura`.`comision` AS `comision`,
                        `migracion_prueba`.`dt_factura`.`anticipo` AS `anticipo`,
                        `migracion_prueba`.`dt_factura`.`cta_anticipo` AS `cta_anticipo`,
                        `migracion_prueba`.`dt_factura`.`rc_anticipo` AS `rc_anticipo`,
                        `migracion_prueba`.`dt_factura`.`contacto_factura` AS `contacto_factura`,
                        `migracion_prueba`.`dt_factura`.`aplica_vt` AS `aplica_vt`,
                        `migracion_prueba`.`dt_factura`.`estado_traza` AS `estado_traza`,
                        `migracion_prueba`.`dt_factura`.`ano_indicador` AS `ano_indicador`,
                        `migracion_prueba`.`dt_factura`.`estado_an` AS `estado_an`,
                        `migracion_prueba`.`dt_factura`.`observaciones` AS `observaciones`,
                        `migracion_prueba`.`dt_factura`.`items` AS `items`,
                        `migracion_prueba`.`dt_factura`.`valor_bruto` AS `valor_bruto`,
                        `migracion_prueba`.`dt_factura`.`orden_compra` AS `orden_compra`,
                        `migracion_prueba`.`dt_factura`.`cantidad` AS `cantidad`,
                        `migracion_prueba`.`dt_factura`.`codigo` AS `codigo`,
                        `migracion_prueba`.`dt_factura`.`referencia` AS `referencia`,
                        `migracion_prueba`.`dt_factura`.`id_codigo_categoria` AS `id_codigo_categoria`,
                        `migracion_prueba`.`dt_factura`.`vr_unidad` AS `vr_unidad`,
                        `migracion_prueba`.`dt_factura`.`descuento` AS `descuento`,
                        `migracion_prueba`.`dt_factura`.`vr_total` AS `vr_total`,
                        `migracion_prueba`.`dt_factura`.`id_puc_oc` AS `id_puc_oc`,
                        `migracion_prueba`.`dt_factura`.`abonos` AS `abonos`,
                        `migracion_prueba`.`dt_factura`.`saldo` AS `saldo`,
                        `migracion_prueba`.`dt_factura`.`letra` AS `letra`,
                        `migracion_prueba`.`dt_factura`.`letra_cta` AS `letra_cta`,
                        `migracion_prueba`.`dt_factura`.`puc_contra` AS `puc_contra`,
                        `migracion_prueba`.`dt_factura`.`anuladas` AS `anuladas`,
                        `migracion_prueba`.`dt_factura`.`id_remision` AS `id_remision`,
                        `migracion_prueba`.`dt_factura`.`nit` AS `nit`
                    from
                        `migracion_prueba`.`dt_factura`
                    where
                        ((month(`migracion_prueba`.`dt_factura`.`fecha_factura`) = (
                        select
                            extract(month from (select (curdate() - interval 2 month)))))
                            and (year(`migracion_prueba`.`dt_factura`.`fecha_factura`) = (
                            select
                                extract(year from (select (curdate() - interval 2 month))))))
                    group by
                        `migracion_prueba`.`dt_factura`.`n_factura`
                    order by
                        `migracion_prueba`.`dt_factura`.`n_factura`;
                    
                    
                    -- migracion_prueba.vw_3meses_home_barrazul source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_3meses_home_barrazul` AS
                    select
                        sum(`o`.`v_total`) AS `barra_azul`
                    from
                        (`migracion_prueba`.`dt_ordenes` `o`
                    join `migracion_prueba`.`dt_fechas_op` `f` on
                        ((`o`.`id_ordenes` = `f`.`id_ordenes`)))
                    where
                        ((`o`.`cobro` <> 0)
                            and (month(`f`.`fecha_ingreso`) = (
                            select
                                extract(month from (select (curdate() - interval 2 month)))))
                                and (year(`f`.`fecha_ingreso`) = (
                                select
                                    extract(year from (select (curdate() - interval 2 month))))));
                    
                    
                    -- migracion_prueba.vw_acumulado_ops_x_comprar source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_acumulado_ops_x_comprar` AS
                    select
                        sum(`migracion_prueba`.`dt_costos`.`valor_total`) AS `valor_total`,
                        year(`migracion_prueba`.`dt_fechas_op`.`fecha_ingreso`) AS `year`,
                        `migracion_prueba`.`dt_fechas_op`.`fecha_ingreso` AS `fecha_ingreso`
                    from
                        (`migracion_prueba`.`dt_costos`
                    left join `migracion_prueba`.`dt_fechas_op` on
                        ((`migracion_prueba`.`dt_costos`.`id_ordenes` = `migracion_prueba`.`dt_fechas_op`.`id_ordenes`)))
                    where
                        ((`migracion_prueba`.`dt_fechas_op`.`fecha_ingreso` is not null)
                            and (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 1)
                                and (`migracion_prueba`.`dt_costos`.`estado` in (1, 8, 4)))
                    group by
                        year(`migracion_prueba`.`dt_fechas_op`.`fecha_ingreso`);
                    
                    
                    -- migracion_prueba.vw_acumulado_ter source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_acumulado_ter` AS
                    select
                        sum(`migracion_prueba`.`dt_costos`.`valor_total`) AS `total`,
                        year(`migracion_prueba`.`dt_fechas_op`.`fecha_ingreso`) AS `year`
                    from
                        ((`migracion_prueba`.`dt_costos`
                    left join `migracion_prueba`.`dt_ordenes` on
                        ((`migracion_prueba`.`dt_costos`.`id_ordenes` = `migracion_prueba`.`dt_ordenes`.`id_ordenes`)))
                    left join `migracion_prueba`.`dt_fechas_op` on
                        ((`migracion_prueba`.`dt_fechas_op`.`id_ordenes` = `migracion_prueba`.`dt_ordenes`.`id_ordenes`)))
                    where
                        ((`migracion_prueba`.`dt_costos`.`id_tipo_costo` in (3, 9, 6, 7, 8))
                            and (`migracion_prueba`.`dt_costos`.`estado` in (1, 8, 4))
                                and (`migracion_prueba`.`dt_costos`.`n_ordenes` <> 0)
                                    and (`migracion_prueba`.`dt_costos`.`cierre` = 0)
                                        and (`migracion_prueba`.`dt_ordenes`.`estado` in (1, 10, 12, 13))
                                            and (`migracion_prueba`.`dt_ordenes`.`conciliado` <> 1)
                                                and (year(`migracion_prueba`.`dt_fechas_op`.`fecha_ingreso`) >= 2018)
                                                    and (not((`migracion_prueba`.`dt_costos`.`nombre_costo` like '%viatico%'))))
                    group by
                        year(`migracion_prueba`.`dt_fechas_op`.`fecha_ingreso`)
                    order by
                        `migracion_prueba`.`dt_costos`.`nombre_costo`;
                    
                    
                    -- migracion_prueba.vw_acumulado_terceros_x_comprar source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_acumulado_terceros_x_comprar` AS
                    select
                        sum(`migracion_prueba`.`dt_costos`.`valor_total`) AS `valor_total`,
                        year(`migracion_prueba`.`dt_fechas_op`.`fecha_ingreso`) AS `year`,
                        `migracion_prueba`.`dt_fechas_op`.`fecha_ingreso` AS `fecha_ingreso`
                    from
                        (`migracion_prueba`.`dt_costos`
                    left join `migracion_prueba`.`dt_fechas_op` on
                        ((`migracion_prueba`.`dt_costos`.`id_ordenes` = `migracion_prueba`.`dt_fechas_op`.`id_ordenes`)))
                    where
                        ((`migracion_prueba`.`dt_fechas_op`.`fecha_ingreso` is not null)
                            and (`migracion_prueba`.`dt_costos`.`id_tipo_costo` in (3, 9, 6, 7, 8))
                                and (`migracion_prueba`.`dt_costos`.`estado` in (1, 8, 4))
                                    and ((`migracion_prueba`.`dt_costos`.`nombre_costo` like '%LASER%')
                                        or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%POLIZA%')
                                            or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%PERMISO%')
                                                or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%PUNZONADO%')
                                                    or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%VIDRIO%')
                                                        or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%BRAILE%')
                                                            or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%ROLADO%')))
                    group by
                        year(`migracion_prueba`.`dt_fechas_op`.`fecha_ingreso`);
                    
                    
                    -- migracion_prueba.vw_acumulado_terceros_x_comprar_p source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_acumulado_terceros_x_comprar_p` AS
                    select
                        sum(`migracion_prueba`.`dt_costos`.`valor_total`) AS `valor_total`,
                        year(`migracion_prueba`.`dt_fechas_op`.`fecha_ingreso`) AS `year`,
                        `migracion_prueba`.`dt_fechas_op`.`fecha_ingreso` AS `fecha_ingreso`
                    from
                        (`migracion_prueba`.`dt_costos`
                    left join `migracion_prueba`.`dt_fechas_op` on
                        ((`migracion_prueba`.`dt_costos`.`id_ordenes` = `migracion_prueba`.`dt_fechas_op`.`id_ordenes`)))
                    where
                        ((`migracion_prueba`.`dt_fechas_op`.`fecha_ingreso` is not null)
                            and (`migracion_prueba`.`dt_costos`.`id_tipo_costo` in (3, 9, 6, 7, 8))
                                and (`migracion_prueba`.`dt_costos`.`estado` in (1, 8, 4))
                                    and (`migracion_prueba`.`dt_costos`.`cierre` = 0)
                                        and ((`migracion_prueba`.`dt_costos`.`nombre_costo` like '%01A%')
                                            or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%01B%')
                                                or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%01C%')
                                                    or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%01D2%')
                                                        or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%01E%')
                                                            or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%01F%')
                                                                or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%01I%')
                                                                    or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%01P1%')
                                                                        or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%01z%')
                                                                            or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%021C%')
                                                                                or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%02A%')
                                                                                    or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%02B%')
                                                                                        or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%02C%')
                                                                                            or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%02D%')
                                                                                                or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%02E%')
                                                                                                    or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%02F%')
                                                                                                        or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%02H%')
                                                                                                            or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%02I%')
                                                                                                                or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%03D%')
                                                                                                                    or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%05D%')
                                                                                                                        or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%06A%')
                                                                                                                            or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%07B%')
                                                                                                                                or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%07C%')
                                                                                                                                    or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%09A%')
                                                                                                                                        or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%09C%')
                                                                                                                                            or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%09F%')
                                                                                                                                                or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%09I%')
                                                                                                                                                    or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%09K%')
                                                                                                                                                        or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%09L%')
                                                                                                                                                            or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%09M%')
                                                                                                                                                                or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%09z%')
                                                                                                                                                                    or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%10F%')
                                                                                                                                                                        or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%12A%')
                                                                                                                                                                            or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%12C%')
                                                                                                                                                                                or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%12D%')
                                                                                                                                                                                    or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%12N%')
                                                                                                                                                                                        or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%12P%')
                                                                                                                                                                                            or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%12z%')
                                                                                                                                                                                                or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%14ZD%')
                                                                                                                                                                                                    or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%14ZE%')
                                                                                                                                                                                                        or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%16C%')
                                                                                                                                                                                                            or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%17A%')
                                                                                                                                                                                                                or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%17AC%')
                                                                                                                                                                                                                    or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%17GE%')
                                                                                                                                                                                                                        or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%17GK%')
                                                                                                                                                                                                                            or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%22H6%')
                                                                                                                                                                                                                                or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%22M5%')
                                                                                                                                                                                                                                    or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%2da%')
                                                                                                                                                                                                                                        or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%6Z%')
                                                                                                                                                                                                                                            or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%SUSTRATOS%')
                                                                                                                                                                                                                                                or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%ENSAMBLE%')
                                                                                                                                                                                                                                                    or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%IMPRESION%')
                                                                                                                                                                                                                                                        or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%DECORACION%')
                                                                                                                                                                                                                                                            or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%METALMECANICA%')
                                                                                                                                                                                                                                                                or (`migracion_prueba`.`dt_costos`.`nombre_costo` like '%PINTURA%')))
                    group by
                        year(`migracion_prueba`.`dt_fechas_op`.`fecha_ingreso`);
                    
                    
                    -- migracion_prueba.vw_agenda_diseno source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_agenda_diseno` AS
                    select
                        `e`.`id_estructura_p_diseno` AS `id_estructura_p_diseno`,
                        `cp`.`nom_codigo` AS `nom_codigo`,
                        `u`.`nombre_usuario` AS `nombre_usuario`,
                        `e`.`grupo` AS `grupo`,
                        `e`.`fecha_inicio` AS `fecha_inicio`,
                        `e`.`fecha_fin` AS `fecha_fin`
                    from
                        (((`migracion_prueba`.`dt_estructura_p_diseno` `e`
                    join `migracion_prueba`.`user` `u` on
                        ((`u`.`id` = `e`.`responsable`)))
                    join `migracion_prueba`.`dt_programacion_diseno` `p` on
                        ((`p`.`n_programacion` = `e`.`id_programacion_diseno`)))
                    join `migracion_prueba`.`dt_codprodfinal` `cp` on
                        ((`cp`.`id_codprodfinal` = `p`.`id_codprodfinal`)));
                    
                    
                    -- migracion_prueba.vw_aprobacion_g_r source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_aprobacion_g_r` AS
                    select
                        `migracion_prueba`.`dt_solicitud_g_r`.`id_solicitud_g_r` AS `id_solicitud_g_r`,
                        `migracion_prueba`.`dt_solicitud_g_r`.`n_solicitud` AS `n_solicitud`,
                        `migracion_prueba`.`dt_clientes`.`nom_empresa` AS `nom_empresa`,
                        `migracion_prueba`.`dt_macro_proyecto`.`nombre_proyecto` AS `macro_proyecto`,
                        `migracion_prueba`.`dt_proyecto_op`.`nombre_proyecto` AS `proyecto`,
                        `migracion_prueba`.`dt_ordenes`.`ref_general` AS `nombre_op`,
                        `migracion_prueba`.`dt_solicitud_g_r`.`nombre_g_r` AS `nombre_g_r`,
                        `migracion_prueba`.`dt_solicitud_g_r`.`fecha_registro` AS `fecha_registro`,
                        `migracion_prueba`.`dt_causas`.`descripcion` AS `causas_descripcion`,
                        concat(`migracion_prueba`.`dt_usuarios`.`nombre_usuario`, ' ', `migracion_prueba`.`dt_usuarios`.`apellido_usuario`) AS `nombre_usuario`,
                        (case
                            when (`migracion_prueba`.`dt_solicitud_g_r`.`tipo_g_r` = 1) then 'Garantía'
                            when (`migracion_prueba`.`dt_solicitud_g_r`.`tipo_g_r` = 0) then 'Reproceso'
                            else 'n/a'
                        end) AS `tipo_g_r`,
                        `migracion_prueba`.`dt_solicitud_g_r`.`valor_g_r` AS `valor_g_r`,
                        (case
                            when (`migracion_prueba`.`dt_solicitud_g_r`.`estado` = 1) then 'En Proceso'
                            when (`migracion_prueba`.`dt_solicitud_g_r`.`estado` = 2) then 'Rechazado'
                            when (`migracion_prueba`.`dt_solicitud_g_r`.`estado` = 3) then 'Aprobado'
                            else 'n/a'
                        end) AS `estado_nom`,
                        `migracion_prueba`.`dt_solicitud_g_r`.`estado` AS `estado`
                    from
                        (((((((`migracion_prueba`.`dt_solicitud_g_r`
                    join `migracion_prueba`.`user` on
                        ((`migracion_prueba`.`dt_solicitud_g_r`.`user_id` = `migracion_prueba`.`user`.`id`)))
                    join `migracion_prueba`.`dt_usuarios` on
                        ((`migracion_prueba`.`dt_usuarios`.`id_usuario` = `migracion_prueba`.`user`.`id_empleado`)))
                    join `migracion_prueba`.`dt_causas` on
                        ((`migracion_prueba`.`dt_causas`.`id_causas` = `migracion_prueba`.`dt_solicitud_g_r`.`id_causas`)))
                    left join `migracion_prueba`.`dt_ordenes` on
                        ((`migracion_prueba`.`dt_solicitud_g_r`.`id_ordenes` = `migracion_prueba`.`dt_ordenes`.`id_ordenes`)))
                    left join `migracion_prueba`.`dt_clientes` on
                        ((`migracion_prueba`.`dt_ordenes`.`id_cliente` = `migracion_prueba`.`dt_clientes`.`id_cliente`)))
                    left join `migracion_prueba`.`dt_proyecto_op` on
                        ((`migracion_prueba`.`dt_proyecto_op`.`id_proyecto_op` = `migracion_prueba`.`dt_ordenes`.`id_proyecto_op`)))
                    left join `migracion_prueba`.`dt_macro_proyecto` on
                        ((`migracion_prueba`.`dt_macro_proyecto`.`id_macro_proyecto` = `migracion_prueba`.`dt_proyecto_op`.`id_macro_proyecto`)))
                    group by
                        `migracion_prueba`.`dt_solicitud_g_r`.`n_solicitud`;
                    
                    
                    -- migracion_prueba.vw_area_materia source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_area_materia` AS
                    select
                        `migracion_prueba`.`dt_area`.`id_area` AS `id_area`,
                        `migracion_prueba`.`dt_area`.`nombre` AS `nombre`
                    from
                        `migracion_prueba`.`dt_area`
                    where
                        (`migracion_prueba`.`dt_area`.`id_area` in (11, 12, 13, 14, 15, 16, 17, 18, 19, 7));
                    
                    
                    -- migracion_prueba.vw_big_data source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_big_data` AS
                    select
                        `o`.`id_ordenes` AS `id_ordenes`,
                        `o`.`ref_general` AS `ref_general`,
                        `cl`.`nom_empresa` AS `cliente`,
                        `ma`.`nombre_proyecto` AS `macroproyecto`,
                        `pr`.`nombre_proyecto` AS `proyecto`,
                        `fo`.`fecha_ingreso` AS `fecha_ingreso`,
                        `o`.`n_ordenes` AS `n_ordenes`,
                        `o`.`item_op` AS `item_op`,
                        `o`.`cantidad` AS `cantidad`,
                        `o`.`cobro` AS `cobro`,
                        `s`.`nombre_subcategoria` AS `nombre_subcategoria`,
                        `o`.`referencia` AS `referencia`,
                        `p`.`total_mano_obra` AS `presupuesto_mo`,
                        `p`.`total_materia_prima` AS `presupuesto_pmp`,
                        `p`.`total_terceros` AS `presupuesto_pter`,
                        `p`.`total_transporte` AS `presupuesto_ptr`,
                        `p`.`total_viaticos` AS `presupuesto_pvi`,
                        `p`.`total_otros_directos` AS `presupuesto_pot`,
                        round(sum((case when (`c`.`id_tipo_costo` = 4) then `c`.`valor_total` when ((`c`.`valor_total` = NULL) or (0 <> 1)) then (`c`.`valor_total` = 2) else (`c`.`valor_total` = 0) end)), 2) AS `costo_mo`,
                        round(sum((case when (`c`.`id_tipo_costo` = 1) then `c`.`valor_total` when ((`c`.`valor_total` = NULL) or (0 <> 1)) then (`c`.`valor_total` = 2) else (`c`.`valor_total` = 0) end)), 2) AS `costo_mp`,
                        round(sum((case when (`c`.`id_tipo_costo` = 8) then `c`.`valor_total` when ((`c`.`valor_total` = NULL) or (0 <> 1)) then (`c`.`valor_total` = 2) else (`c`.`valor_total` = 0) end)), 2) AS `costo_ter`,
                        round(sum((case when (`c`.`id_tipo_costo` = 5) then `c`.`valor_total` when ((`c`.`valor_total` = NULL) or (0 <> 1)) then (`c`.`valor_total` = 2) else (`c`.`valor_total` = 0) end)), 2) AS `costo_tra`,
                        round(sum((case when (`c`.`id_tipo_costo` = 9) then `c`.`valor_total` when ((`c`.`valor_total` = NULL) or (0 <> 1)) then (`c`.`valor_total` = 2) else (`c`.`valor_total` = 0) end)), 2) AS `costo_via`,
                        round(sum((case when (`c`.`id_tipo_costo` in (6, 7, 2, 3)) then `c`.`valor_total` when ((`c`.`valor_total` = NULL) or (0 <> 1)) then (`c`.`valor_total` = 2) else (`c`.`valor_total` = 0) end)), 2) AS `costo_otros`
                    from
                        (((((((`migracion_prueba`.`dt_ordenes` `o`
                    join `migracion_prueba`.`dt_clientes` `cl` on
                        ((`o`.`id_cliente` = `cl`.`id_cliente`)))
                    join `migracion_prueba`.`dt_proyecto_op` `pr` on
                        ((`o`.`id_proyecto_op` = `pr`.`id_proyecto_op`)))
                    join `migracion_prueba`.`dt_macro_proyecto` `ma` on
                        ((`pr`.`id_macro_proyecto` = `ma`.`id_macro_proyecto`)))
                    join `migracion_prueba`.`dt_fechas_op` `fo` on
                        ((`o`.`id_ordenes` = `fo`.`id_ordenes`)))
                    join `migracion_prueba`.`dt_subcategoria` `s` on
                        ((`o`.`id_subcategoria` = `s`.`id_subcategoria`)))
                    left join `migracion_prueba`.`dt_presupuesto_inicial` `p` on
                        ((`o`.`id_ordenes` = `p`.`id_ordenes`)))
                    left join `migracion_prueba`.`dt_costos` `c` on
                        ((`o`.`id_ordenes` = `c`.`id_ordenes`)))
                    group by
                        `o`.`id_ordenes`;
                    
                    
                    -- migracion_prueba.vw_big_data_compras source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_big_data_compras` AS
                    select
                        `c`.`id_ordenes` AS `id_ordenes`,
                        `c`.`vr_total` AS `valor_total`,
                        `co`.`id_tipo_costo` AS `id_tipo_costo`
                    from
                        (`migracion_prueba`.`dt_compras` `c`
                    join `migracion_prueba`.`dt_costos` `co` on
                        ((`c`.`id_costos` = `co`.`id_costo`)));
                    
                    
                    -- migracion_prueba.vw_big_data_costos source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_big_data_costos` AS
                    select
                        `migracion_prueba`.`dt_costos`.`id_ordenes` AS `id_ordenes`,
                        truncate(sum(`migracion_prueba`.`dt_costos`.`valor_total`), 2) AS `valor_total`,
                        `migracion_prueba`.`dt_costos`.`id_tipo_costo` AS `id_tipo_costo`,
                        `migracion_prueba`.`dt_tipo_costo`.`tipo` AS `tipo`
                    from
                        (`migracion_prueba`.`dt_costos`
                    join `migracion_prueba`.`dt_tipo_costo` on
                        ((`migracion_prueba`.`dt_tipo_costo`.`id_tipo_costo` = `migracion_prueba`.`dt_costos`.`id_tipo_costo`)))
                    group by
                        `migracion_prueba`.`dt_costos`.`id_tipo_costo`,
                        `migracion_prueba`.`dt_costos`.`id_ordenes`;
                    
                    
                    -- migracion_prueba.vw_big_data_sub_costos source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_big_data_sub_costos` AS
                    select
                        `migracion_prueba`.`dt_costos`.`id_costo` AS `id_costo`,
                        (case
                            when (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 1) then `migracion_prueba`.`dt_costos`.`valor_total`
                            else 0
                        end) AS `costos_mp`,
                        (case
                            when (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 4) then `migracion_prueba`.`dt_costos`.`valor_total`
                            else 0
                        end) AS `costos_mo`,
                        (case
                            when (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 5) then `migracion_prueba`.`dt_costos`.`valor_total`
                            else 0
                        end) AS `costos_trans`,
                        (case
                            when (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 8) then `migracion_prueba`.`dt_costos`.`valor_total`
                            else 0
                        end) AS `costos_ter`,
                        (case
                            when ((`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 6)
                            or (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 7)) then `migracion_prueba`.`dt_costos`.`valor_total`
                            else 0
                        end) AS `costos_otros`,
                        (case
                            when (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 9) then `migracion_prueba`.`dt_costos`.`valor_total`
                            else 0
                        end) AS `costos_via`,
                        `migracion_prueba`.`dt_costos`.`id_tipo_costo` AS `id_tipo_costo`,
                        `migracion_prueba`.`dt_costos`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_costos`.`id_ordenes` AS `id_ordenes`
                    from
                        `migracion_prueba`.`dt_costos`;
                    
                    
                    -- migracion_prueba.vw_bigdata_costo_total source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_bigdata_costo_total` AS
                    select
                        `migracion_prueba`.`dt_costos`.`id_ordenes` AS `id_ordenes`,
                        sum(`migracion_prueba`.`dt_costos`.`valor_total`) AS `valor_total`
                    from
                        `migracion_prueba`.`dt_costos`
                    where
                        (`migracion_prueba`.`dt_costos`.`id_inventario` is null)
                    group by
                        `migracion_prueba`.`dt_costos`.`id_ordenes`;
                    
                    
                    -- migracion_prueba.vw_cabina_costo_total source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_cabina_costo_total` AS
                    select
                        sum(`migracion_prueba`.`dt_costos`.`valor_total`) AS `costo_total`,
                        `migracion_prueba`.`dt_costos`.`id_ordenes` AS `id_ordenes`
                    from
                        `migracion_prueba`.`dt_costos`
                    group by
                        `migracion_prueba`.`dt_costos`.`id_ordenes`;
                    
                    
                    -- migracion_prueba.vw_cabina_diseno source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_cabina_diseno` AS
                    select
                        `migracion_prueba`.`dt_diseno`.`id_ordenes` AS `id_ordenes`,
                        `migracion_prueba`.`dt_diseno`.`id_disenolista` AS `id_disenolista`,
                        (case
                            `migracion_prueba`.`dt_diseno`.`grupo` when 1 then 'COMITE_TECNICO'
                            when 2 then 'COSTOS'
                            when 3 then 'TERCEROS_1'
                            when 4 then 'TERCEROS_2'
                            when 5 then 'TERCEROS_3'
                            when 6 then 'METALMECANICA'
                            when 7 then 'CNC'
                            when 8 then 'MADERAS'
                            when 9 then 'PLASTICOS'
                            when 10 then 'PINTURA'
                            when 11 then 'IMPRESION_DECORACION'
                            when 12 then 'ENSAMBLE'
                            when 13 then 'INSTALACION'
                        end) AS `grupo`,
                        `migracion_prueba`.`dt_diseno`.`archivo` AS `archivo`,
                        `migracion_prueba`.`dt_diseno`.`foto` AS `foto`,
                        `migracion_prueba`.`dt_diseno`.`fecha_inicio` AS `fecha_inicio`,
                        `migracion_prueba`.`dt_diseno`.`fecha_final_cli` AS `fecha_final_cli`,
                        `migracion_prueba`.`user`.`nombre_usuario` AS `nombre_usuario`,
                        `migracion_prueba`.`dt_diseno`.`id_usuario` AS `id_usuario`,
                        (case
                            when (`migracion_prueba`.`dt_diseno`.`id_disenolista` is null) then 'NoAplica.jpg'
                            else (case
                                when ((`migracion_prueba`.`dt_diseno`.`grupo` = 2)
                                and (`migracion_prueba`.`dt_diseno`.`creacion_gantt` = 1)) then 'Realizado.jpg'
                                when ((`migracion_prueba`.`dt_diseno`.`archivo` is not null)
                                and (`migracion_prueba`.`dt_diseno`.`archivo` <> '')
                                and (`migracion_prueba`.`dt_diseno`.`foto` is not null)
                                and (`migracion_prueba`.`dt_diseno`.`foto` <> '')) then 'Realizado.jpg'
                                when (`migracion_prueba`.`dt_diseno`.`fecha_inicio` is null) then 'PendienteP.jpg'
                                when (((cast(`migracion_prueba`.`dt_diseno`.`fecha_final` as datetime) + interval (0 + 30) minute) - now()) < 0) then 'NoRealizado.png'
                                else 'Programado.jpg'
                            end)
                        end) AS `estado`
                    from
                        (`migracion_prueba`.`dt_diseno`
                    left join `migracion_prueba`.`user` on
                        ((`migracion_prueba`.`dt_diseno`.`id_usuario` = `migracion_prueba`.`user`.`id`)));
                    
                    
                    -- migracion_prueba.vw_cabina_entregables source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_cabina_entregables` AS
                    select
                        `migracion_prueba`.`dt_entregables`.`id_ordenes` AS `id_ordenes`,
                        (case
                            `migracion_prueba`.`dt_entregables`.`id_check_list` when 15 then 'COMITE_INICIO'
                            when 16 then 'COMITE_INICIO_L'
                            when 8 then 'VISITA_TECNICA'
                            when 17 then 'DOCUMENTACION'
                            when 18 then 'DOCUMENTACION'
                            when 19 then 'DOCUMENTACION'
                            when 20 then 'DOCUMENTACION'
                            when 21 then 'DOCUMENTACION'
                            when 22 then 'DOCUMENTACION'
                            when 23 then 'DOCUMENTACION'
                            when 24 then 'DOCUMENTACION'
                            when 25 then 'DOCUMENTACION'
                            when 26 then 'FORMA_PAGO'
                            when 27 then 'AVANCE'
                            when 28 then 'AVANCE'
                            when 29 then 'AVANCE'
                            when 30 then 'AVANCE'
                            when 31 then 'FORMA_PAGO'
                            when 32 then 'FACTURADO_100'
                            when 33 then 'RECAUDADO_100'
                            when 34 then 'ARTE_GUIA_SUMINISTRADA_CLIENTE'
                            when 35 then 'ARTE_FINAL_APROBADO_CLIENTE'
                            when 36 then 'COLORES_ESTUDIO_CLIENTE'
                            when 37 then 'COLORES_APROBADOS_CLIENTE'
                            when 38 then 'MUESTRA_PROCESO_PRODUCCION'
                            when 39 then 'MUESTRA_EVALUACION_CLIENTE'
                            when 40 then 'MUESTRA_APROBADA_CLIENTE'
                            when 41 then 'REQUISITOS_ENTREGA'
                            when 42 then 'ENCUESTA'
                            when 43 then 'REQUISITOS_ENTREGA'
                            when 44 then 'REQUISITOS_ENTREGA'
                            when 45 then 'REQUISITOS_ENTREGA'
                            when 46 then 'REQUISITOS_ENTREGA'
                            when 48 then 'COMITE_CIERRE'
                            when 67 then 'REQUISITO_RETEGARANTIA'
                        end) AS `grupo`,
                        (case
                            when (`migracion_prueba`.`dt_entregables`.`estado` = 0) then 'NoAplica.jpg'
                            when (`migracion_prueba`.`dt_entregables`.`estado` = 1) then 'Realizado.jpg'
                            when (((`migracion_prueba`.`dt_entregables`.`estado` is null)
                            or (`migracion_prueba`.`dt_entregables`.`estado` = 2)
                            or (`migracion_prueba`.`dt_entregables`.`estado` = ''))
                            and ((`migracion_prueba`.`dt_entregables`.`fecha_inicio` is null)
                            or (`migracion_prueba`.`dt_entregables`.`fecha_inicio` is null))) then 'PendienteP.jpg'
                            when ((`migracion_prueba`.`dt_entregables`.`estado` = 2)
                            and (((cast(`migracion_prueba`.`dt_entregables`.`fecha_inicio` as datetime) + interval 30 minute) - now()) < 0)) then 'NoRealizado.png'
                            else 'Programado.jpg'
                        end) AS `estado`,
                        `migracion_prueba`.`dt_entregables`.`fecha_inicio` AS `fecha_inicio`,
                        `migracion_prueba`.`user`.`nombre_usuario` AS `nombre_usuario`
                    from
                        (`migracion_prueba`.`dt_entregables`
                    left join `migracion_prueba`.`user` on
                        ((`migracion_prueba`.`dt_entregables`.`id_usuario` = `migracion_prueba`.`user`.`id`)));
                    
                    
                    -- migracion_prueba.vw_cabina_materia_prima source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_cabina_materia_prima` AS
                    select
                        'MATERIA_PRIMA' AS `grupo`,
                        (case
                            when (`migracion_prueba`.`dt_compras`.`id_ordenes` is null) then 'NoAplica.jpg'
                            when (`migracion_prueba`.`dt_compras`.`id_proveedores` = 750) then 'Realizado.jpg'
                            when (`migracion_prueba`.`dt_rotacion`.`id_rotacion` is not null) then 'Realizado.jpg'
                            when (`migracion_prueba`.`dt_compras`.`id_costos` is null) then 'PendienteP.jpg'
                            when (((`migracion_prueba`.`dt_compras`.`fecha_compromiso` - curdate()) < 0)
                            and (`migracion_prueba`.`dt_compras`.`id_proveedores` <> 750)) then 'NoRealizado.png'
                            else 'NoAplica.jpg'
                        end) AS `estado`,
                        `migracion_prueba`.`dt_compras`.`fecha_compromiso` AS `fecha_inicio`,
                        `migracion_prueba`.`dt_compras`.`id_ordenes` AS `id_ordenes`
                    from
                        (`migracion_prueba`.`dt_compras`
                    left join `migracion_prueba`.`dt_rotacion` on
                        ((`migracion_prueba`.`dt_compras`.`id_compras` = `migracion_prueba`.`dt_rotacion`.`id_compra`)))
                    where
                        ((`migracion_prueba`.`dt_compras`.`tipo_inv` = 1)
                            and (`migracion_prueba`.`dt_compras`.`id_ordenes` is not null)
                                and (`migracion_prueba`.`dt_compras`.`id_costos` is not null)
                                    and (`migracion_prueba`.`dt_compras`.`estado` <> 2));
                    
                    
                    -- migracion_prueba.vw_cabina_presupuesto_inicial source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_cabina_presupuesto_inicial` AS
                    select
                        (((((`migracion_prueba`.`dt_presupuesto_inicial`.`total_materia_prima` + `migracion_prueba`.`dt_presupuesto_inicial`.`total_mano_obra`) + `migracion_prueba`.`dt_presupuesto_inicial`.`total_transporte`) + `migracion_prueba`.`dt_presupuesto_inicial`.`total_terceros`) + `migracion_prueba`.`dt_presupuesto_inicial`.`total_viaticos`) + `migracion_prueba`.`dt_presupuesto_inicial`.`total_otros_directos`) AS `total_presupuesto`,
                        `migracion_prueba`.`dt_presupuesto_inicial`.`id_ordenes` AS `id_ordenes`
                    from
                        `migracion_prueba`.`dt_presupuesto_inicial`
                    group by
                        `migracion_prueba`.`dt_presupuesto_inicial`.`id_ordenes`;
                    
                    
                    -- migracion_prueba.vw_cabina_produccion source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_cabina_produccion` AS
                    select
                        `dc`.`n_ordenes` AS `n_ordenes`,
                        `dc`.`id_ordenes` AS `id_ordenes`,
                        `dc`.`cod_material` AS `cod_material`,
                        `dc`.`nombre_costo` AS `nombre_costo`,
                        `da`.`id_area` AS `id_area`,
                        `da`.`id_clase_costo` AS `id_clase_costo`,
                        `dtc`.`id_vendedor` AS `id_vendedor`,
                        `dtc`.`fecha_inicio` AS `fecha_inicio`,
                        `dtc`.`fecha_final` AS `fecha_final`,
                        `dtc`.`fecha_retro` AS `fecha_retro`,
                        (case
                            when (`dtc`.`id_tarea_costo` is null) then 'PendienteP.jpg'
                            when (`dtc`.`fecha_retro` is not null) then 'Realizado.jpg'
                            else (case
                                when (((cast(`dtc`.`fecha_inicio` as datetime) + interval ((`dtc`.`can_horas` * 60) + 30) minute) - now()) < 0) then 'NoRealizado.png'
                                else 'Programado.jpg'
                            end)
                        end) AS `estado`,
                        count(0) AS `cantidad_estado`
                    from
                        ((`migracion_prueba`.`dt_costos` `dc`
                    join `migracion_prueba`.`dt_acabados` `da` on
                        ((`dc`.`id_acabados` = `da`.`id_acabados`)))
                    left join `migracion_prueba`.`dt_tareas_costo` `dtc` on
                        ((`dc`.`id_costo` = `dtc`.`id_costo`)))
                    where
                        (`dc`.`id_tipo_costo` = 4)
                    group by
                        `dc`.`id_ordenes`,
                        `da`.`id_area`,
                        `da`.`id_clase_costo`,
                        (case
                            when (`dtc`.`id_tarea_costo` is null) then 'PendienteP.jpg'
                            when (`dtc`.`fecha_retro` is not null) then 'Realizado.jpg'
                            else (case
                                when (((cast(`dtc`.`fecha_inicio` as datetime) + interval ((`dtc`.`can_horas` * 60) + 30) minute) - now()) < 0) then 'NoRealizado.png'
                                else 'Programado.jpg'
                            end)
                        end);
                    
                    
                    -- migracion_prueba.vw_cabina_requisicion source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_cabina_requisicion` AS
                    select
                        'REQUISICION' AS `grupo`,
                        (case
                            when ((`migracion_prueba`.`dt_remision`.`id_remision` is not null)
                            and (`migracion_prueba`.`dt_remision`.`id_remision` <> '')) then 'Realizado.jpg'
                            else 'Pendiente.jpg'
                        end) AS `estado`,
                        `migracion_prueba`.`dt_remision`.`fecha_creacion` AS `fecha_inicio`,
                        `migracion_prueba`.`dt_remision`.`id_ordenes` AS `id_ordenes`
                    from
                        `migracion_prueba`.`dt_remision`;
                    
                    
                    -- migracion_prueba.vw_cabina_terceros source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_cabina_terceros` AS
                    select
                        'TERCEROS' AS `grupo`,
                        (case
                            when (`migracion_prueba`.`dt_tareas_costo`.`id_tarea_costo` is null) then 'PendienteP.jpg'
                            else (case
                                when (`migracion_prueba`.`dt_compras`.`id_compras` is not null) then 'Realizado.jpg'
                                when (((cast(`migracion_prueba`.`dt_tareas_costo`.`fecha_inicio` as datetime) + interval ((`migracion_prueba`.`dt_tareas_costo`.`can_horas` * 60) + 30) minute) - now()) < 0) then 'NoRealizado.png'
                                else 'Programado.jpg'
                            end)
                        end) AS `estado`,
                        `migracion_prueba`.`dt_tareas_costo`.`fecha_inicio` AS `fecha_inicio`,
                        `migracion_prueba`.`user`.`nombre_usuario` AS `responsable`,
                        `migracion_prueba`.`dt_tareas_costo`.`fecha_final` AS `fecha_final`,
                        `migracion_prueba`.`dt_tareas_costo`.`id_ordenes` AS `id_ordenes`,
                        `migracion_prueba`.`dt_tareas_costo`.`cod_material` AS `cod`
                    from
                        ((`migracion_prueba`.`dt_tareas_costo`
                    left join `migracion_prueba`.`dt_compras` on
                        ((`migracion_prueba`.`dt_tareas_costo`.`id_costo` = `migracion_prueba`.`dt_compras`.`id_costos`)))
                    left join `migracion_prueba`.`user` on
                        (((`migracion_prueba`.`dt_tareas_costo`.`id_vendedor` = `migracion_prueba`.`user`.`id`)
                            and ((`migracion_prueba`.`dt_tareas_costo`.`cod_material` like 'TBR%')
                                or (`migracion_prueba`.`dt_tareas_costo`.`cod_material` like 'TCP%')
                                    or (`migracion_prueba`.`dt_tareas_costo`.`cod_material` like 'SUB%')
                                        or (`migracion_prueba`.`dt_tareas_costo`.`cod_material` like 'TCL%')
                                            or (`migracion_prueba`.`dt_tareas_costo`.`cod_material` like 'TCN%')
                                                or (`migracion_prueba`.`dt_tareas_costo`.`cod_material` like 'TET%')))));
                    
                    
                    -- migracion_prueba.vw_certicamara_factura source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_certicamara_factura` AS
                    select
                        `migracion_prueba`.`dt_factura`.`id_factura` AS `id_factura`,
                        `migracion_prueba`.`dt_factura`.`puc_cuenta` AS `puc_cuenta`,
                        `migracion_prueba`.`dt_factura`.`n_factura` AS `n_factura`,
                        `migracion_prueba`.`dt_factura`.`cantidad` AS `cantidad`,
                        `migracion_prueba`.`dt_factura`.`referencia` AS `referencia`,
                        `migracion_prueba`.`dt_factura`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_factura`.`fecha_factura` AS `fecha_factura`,
                        date_format(`migracion_prueba`.`dt_factura`.`fecha_creacion`, '%H:%I:%S') AS `hora`,
                        `migracion_prueba`.`dt_factura`.`fecha_vencimiento` AS `fecha_vencimiento`,
                        `migracion_prueba`.`dt_factura`.`valor_bruto` AS `valor_bruto`,
                        `migracion_prueba`.`dt_factura`.`vr_total` AS `vr_total`,
                        `migracion_prueba`.`dt_factura`.`vr_unidad` AS `vr_unidad`,
                        `migracion_prueba`.`dt_factura`.`id_vendedor` AS `id_vendedor`,
                        `migracion_prueba`.`dt_factura`.`iva` AS `iva`,
                        `migracion_prueba`.`dt_clientes`.`id_regimen` AS `id_regimen`,
                        `migracion_prueba`.`dt_clientes`.`nom_empresa` AS `nom_empresa`,
                        `migracion_prueba`.`dt_clientes`.`nit` AS `nit`,
                        `migracion_prueba`.`dt_clientes`.`dig_verificacion` AS `dig_verificacion`,
                        `migracion_prueba`.`dt_clientes`.`telefono` AS `telefono`,
                        `migracion_prueba`.`dt_clientes`.`email_empresa` AS `email_empresa`,
                        `migracion_prueba`.`dt_clientes`.`direccion` AS `direccion`
                    from
                        (`migracion_prueba`.`dt_factura`
                    join `migracion_prueba`.`dt_clientes` on
                        ((`migracion_prueba`.`dt_factura`.`id_cliente` = `migracion_prueba`.`dt_clientes`.`id_cliente`)));
                    
                    
                    -- migracion_prueba.vw_codigo_plantilla source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_codigo_plantilla` AS
                    select
                        `migracion_prueba`.`dt_codprodfinal`.`cod` AS `cod`,
                        `migracion_prueba`.`dt_codprodfinal`.`nom_codigo` AS `nom_codigo`,
                        `migracion_prueba`.`dt_plantilla`.`id_plantilla` AS `id_plantilla`,
                        `migracion_prueba`.`dt_plantilla`.`id_codprodfinal` AS `id_codprodfinal`
                    from
                        (`migracion_prueba`.`dt_codprodfinal`
                    join `migracion_prueba`.`dt_plantilla` on
                        ((`migracion_prueba`.`dt_codprodfinal`.`id_codprodfinal` = `migracion_prueba`.`dt_plantilla`.`id_codprodfinal`)));
                    
                    
                    -- migracion_prueba.vw_codigo_producto_almacen source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_codigo_producto_almacen` AS
                    select
                        `ia`.`id_inventarioxarea` AS `id_inventarioxarea`,
                        `ia`.`codigo_prod` AS `codigo_prod`,
                        `ia`.`stock` AS `stock`,
                        concat_ws(' - ', convert(`ia`.`codigo_prod` using utf8mb3), `i`.`producto`) AS `producto`,
                        `ia`.`id_area` AS `id_area`,
                        `ia`.`id_inventario` AS `id_inventario`
                    from
                        (`migracion_prueba`.`dt_inventarioxarea` `ia`
                    join `migracion_prueba`.`dt_inventario` `i` on
                        ((`ia`.`id_inventario` = `i`.`id_inventario`)))
                    where
                        (`ia`.`stock` > 0);
                    
                    
                    -- migracion_prueba.vw_codprodfinal_sin_plantilla source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_codprodfinal_sin_plantilla` AS
                    select
                        `migracion_prueba`.`dt_codprodfinal`.`id_codprodfinal` AS `id_codprodfinal`,
                        `migracion_prueba`.`dt_codprodfinal`.`cod` AS `cod`,
                        `migracion_prueba`.`dt_codprodfinal`.`id_categoria` AS `id_categoria`,
                        `migracion_prueba`.`dt_codprodfinal`.`nom_codigo` AS `nom_codigo`,
                        `migracion_prueba`.`dt_codprodfinal`.`tam_x` AS `tam_x`,
                        `migracion_prueba`.`dt_codprodfinal`.`tam_y` AS `tam_y`,
                        `migracion_prueba`.`dt_codprodfinal`.`tam_z` AS `tam_z`,
                        `migracion_prueba`.`dt_codprodfinal`.`tam_l` AS `tam_l`,
                        `migracion_prueba`.`dt_codprodfinal`.`id_cliente` AS `id_cliente`,
                        `migracion_prueba`.`dt_codprodfinal`.`id_grupo_inventario` AS `id_grupo_inventario`,
                        `migracion_prueba`.`dt_codprodfinal`.`iluminacion` AS `iluminacion`,
                        `migracion_prueba`.`dt_codprodfinal`.`acabados` AS `acabados`,
                        `migracion_prueba`.`dt_codprodfinal`.`decoracion` AS `decoracion`,
                        `migracion_prueba`.`dt_codprodfinal`.`tipo_producto` AS `tipo_producto`,
                        `migracion_prueba`.`dt_codprodfinal`.`marca` AS `marca`,
                        `migracion_prueba`.`dt_codprodfinal`.`tipo_presupuesto` AS `tipo_presupuesto`,
                        `migracion_prueba`.`dt_codprodfinal`.`nit` AS `nit`
                    from
                        `migracion_prueba`.`dt_codprodfinal`
                    where
                        `migracion_prueba`.`dt_codprodfinal`.`id_codprodfinal` in (
                        select
                            `migracion_prueba`.`dt_plantilla`.`id_codprodfinal`
                        from
                            `migracion_prueba`.`dt_plantilla`
                        group by
                            `migracion_prueba`.`dt_plantilla`.`id_codprodfinal`) is false
                    order by
                        `migracion_prueba`.`dt_codprodfinal`.`id_codprodfinal` desc;
                    
                    
                    -- migracion_prueba.vw_comercial source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_comercial` AS
                    select
                        `migracion_prueba`.`user`.`id` AS `id`,
                        `migracion_prueba`.`user`.`id_empleado` AS `id_empleado`,
                        `migracion_prueba`.`user`.`username` AS `username`,
                        concat(`migracion_prueba`.`dt_usuarios`.`nombre_usuario`, ' ', `migracion_prueba`.`dt_usuarios`.`apellido_usuario`) AS `nombre_usuario`
                    from
                        (`migracion_prueba`.`user`
                    join `migracion_prueba`.`dt_usuarios` on
                        ((`migracion_prueba`.`dt_usuarios`.`id_usuario` = `migracion_prueba`.`user`.`id_empleado`)))
                    where
                        ((`migracion_prueba`.`user`.`status` = 1)
                            and (`migracion_prueba`.`dt_usuarios`.`id_cargo` in (24, 88, 78, 9)));
                    
                    
                    -- migracion_prueba.vw_compras_home source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_compras_home` AS
                    select
                        `migracion_prueba`.`dt_costos`.`id_costo` AS `id_costo`,
                        `migracion_prueba`.`dt_clientes`.`nom_empresa` AS `cliente`,
                        `migracion_prueba`.`dt_macro_proyecto`.`nombre_proyecto` AS `macro_proyecto`,
                        `migracion_prueba`.`dt_proyecto_op`.`nombre_proyecto` AS `nombre_proyecto`,
                        `migracion_prueba`.`dt_ordenes`.`ref_general` AS `nombre_op`,
                        `migracion_prueba`.`dt_ordenes`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_costos`.`id_ordenes` AS `id_ordenes`,
                        `migracion_prueba`.`dt_ordenes`.`cod` AS `cod`,
                        `migracion_prueba`.`dt_ordenes`.`item_op` AS `item_op`,
                        `migracion_prueba`.`dt_grupoinventario`.`grupo` AS `familia`,
                        `migracion_prueba`.`dt_proveedores`.`empresa` AS `proveedor`,
                        `migracion_prueba`.`dt_fechas_op`.`fecha_ingreso` AS `fecha_ingreso`,
                        `migracion_prueba`.`dt_fechas_op`.`fecha_produccion` AS `fecha_produccion`,
                        `migracion_prueba`.`dt_costos`.`nombre_costo` AS `material`,
                        `migracion_prueba`.`dt_costos`.`cod_material` AS `cod_material`,
                        `migracion_prueba`.`dt_costos`.`comentarios` AS `comentarios`,
                        `migracion_prueba`.`dt_costos`.`cant_sol` AS `cant_sol`,
                        `migracion_prueba`.`dt_costos`.`valor_total` AS `valor_total`,
                        `migracion_prueba`.`dt_costos`.`saldo_compra` AS `saldo_compra`,
                        `migracion_prueba`.`dt_costos`.`valor_unit` AS `valor_unit`,
                        `migracion_prueba`.`dt_costos`.`estado` AS `estado`,
                        `migracion_prueba`.`dt_inventario`.`id_proveedor` AS `id_proveedor`,
                        `migracion_prueba`.`dt_inventario`.`stock` AS `stock`,
                        `migracion_prueba`.`dt_inventarioxarea`.`stock` AS `stock_alm`,
                        `migracion_prueba`.`dt_costos`.`n_cotiza` AS `n_cotiza`,
                        `migracion_prueba`.`dt_costos`.`id_inventario` AS `id_inventario`
                    from
                        ((((((((((`migracion_prueba`.`dt_costos`
                    left join `migracion_prueba`.`dt_inventario` on
                        ((`migracion_prueba`.`dt_costos`.`id_inventario` = `migracion_prueba`.`dt_inventario`.`id_inventario`)))
                    left join `migracion_prueba`.`dt_inventarioxarea` on
                        ((`migracion_prueba`.`dt_inventarioxarea`.`id_inventario` = `migracion_prueba`.`dt_inventario`.`id_inventario`)))
                    left join `migracion_prueba`.`dt_ordenes` on
                        ((`migracion_prueba`.`dt_ordenes`.`id_ordenes` = `migracion_prueba`.`dt_costos`.`id_ordenes`)))
                    left join `migracion_prueba`.`dt_proyecto_op` on
                        ((`migracion_prueba`.`dt_ordenes`.`id_proyecto_op` = `migracion_prueba`.`dt_proyecto_op`.`id_proyecto_op`)))
                    left join `migracion_prueba`.`dt_macro_proyecto` on
                        ((`migracion_prueba`.`dt_proyecto_op`.`id_macro_proyecto` = `migracion_prueba`.`dt_macro_proyecto`.`id_macro_proyecto`)))
                    left join `migracion_prueba`.`dt_clientes` on
                        ((`migracion_prueba`.`dt_macro_proyecto`.`id_cliente` = `migracion_prueba`.`dt_clientes`.`id_cliente`)))
                    left join `migracion_prueba`.`dt_subgrupo` on
                        ((`migracion_prueba`.`dt_subgrupo`.`id_subgrupo` = `migracion_prueba`.`dt_inventario`.`id_subgrupo`)))
                    left join `migracion_prueba`.`dt_grupoinventario` on
                        ((`migracion_prueba`.`dt_subgrupo`.`id_grupo_inventario` = `migracion_prueba`.`dt_grupoinventario`.`id_grupo_inventario`)))
                    left join `migracion_prueba`.`dt_proveedores` on
                        ((`migracion_prueba`.`dt_inventario`.`id_proveedor` = `migracion_prueba`.`dt_proveedores`.`id_proveedores`)))
                    left join `migracion_prueba`.`dt_fechas_op` on
                        ((`migracion_prueba`.`dt_fechas_op`.`id_ordenes` = `migracion_prueba`.`dt_ordenes`.`id_ordenes`)))
                    where
                        ((`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 1)
                            and (`migracion_prueba`.`dt_inventarioxarea`.`id_area` = 12)
                                and (`migracion_prueba`.`dt_costos`.`cierre` = 0)
                                    and (`migracion_prueba`.`dt_costos`.`estado` in (1, 4, 7))
                                        and (`migracion_prueba`.`dt_ordenes`.`estado` in (1, 10, 12, 13))
                                            and (year(`migracion_prueba`.`dt_fechas_op`.`fecha_ingreso`) >= 2017)
                                                and (`migracion_prueba`.`dt_costos`.`cant_sol` > 0))
                    group by
                        `migracion_prueba`.`dt_costos`.`id_costo`,
                        `migracion_prueba`.`dt_fechas_op`.`id_ordenes`
                    order by
                        `migracion_prueba`.`dt_costos`.`id_costo`,
                        `migracion_prueba`.`dt_costos`.`nombre_costo`,
                        `migracion_prueba`.`dt_costos`.`cod_material`;
                    
                    
                    -- migracion_prueba.vw_compras_logistica source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_compras_logistica` AS
                    select
                        sum(`migracion_prueba`.`dt_compras`.`vr_total`) AS `vr_total`,
                        `migracion_prueba`.`dt_tipo_pago`.`descripcion` AS `descripcion`,
                        `migracion_prueba`.`dt_compras`.`fecha_compromiso` AS `fecha_compromiso`
                    from
                        ((`migracion_prueba`.`dt_compras`
                    left join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_compras`.`id_costos` = `migracion_prueba`.`dt_costos`.`id_costo`)))
                    left join `migracion_prueba`.`dt_tipo_pago` on
                        ((`migracion_prueba`.`dt_compras`.`id_tipo_pago` = `migracion_prueba`.`dt_tipo_pago`.`id_tipo_pago`)))
                    where
                        ((`migracion_prueba`.`dt_compras`.`id_proveedores` <> 750)
                            and (`migracion_prueba`.`dt_costos`.`id_tipo_costo` <> 1)
                                and ((`migracion_prueba`.`dt_compras`.`detalle_oc` like '%ALQUILER%')
                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%FLETES%')
                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%fac%')))
                    group by
                        `migracion_prueba`.`dt_compras`.`id_tipo_pago`;
                    
                    
                    -- migracion_prueba.vw_compras_mp source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_compras_mp` AS
                    select
                        sum(`migracion_prueba`.`dt_compras`.`vr_total`) AS `vr_total`,
                        `migracion_prueba`.`dt_tipo_pago`.`descripcion` AS `descripcion`,
                        `migracion_prueba`.`dt_compras`.`fecha_compromiso` AS `fecha_compromiso`
                    from
                        ((`migracion_prueba`.`dt_compras`
                    left join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_compras`.`id_costos` = `migracion_prueba`.`dt_costos`.`id_costo`)))
                    left join `migracion_prueba`.`dt_tipo_pago` on
                        ((`migracion_prueba`.`dt_compras`.`id_tipo_pago` = `migracion_prueba`.`dt_tipo_pago`.`id_tipo_pago`)))
                    where
                        ((`migracion_prueba`.`dt_compras`.`id_proveedores` <> 750)
                            and (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 1))
                    group by
                        `migracion_prueba`.`dt_compras`.`id_tipo_pago`;
                    
                    
                    -- migracion_prueba.vw_compras_realizadas source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_compras_realizadas` AS
                    select
                        (case
                            when (`migracion_prueba`.`dt_rotacion`.`factura_proveedor` is not null) then 'OK cont'
                            when (`migracion_prueba`.`dt_rotacion`.`n_rotacion` is not null) then 'Entrada'
                            when (`migracion_prueba`.`dt_rotacion`.`id_rotacion` is null) then 'Sin Entrada'
                            else 'N/A'
                        end) AS `estado`,
                        (case
                            when (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 1) then 'MP'
                            when (`migracion_prueba`.`dt_costos`.`id_tipo_costo` in ('3', '9', '6', '7', '8')) then 'Terceros'
                            else 'N/A'
                        end) AS `tipo`,
                        `migracion_prueba`.`dt_rotacion`.`n_rotacion` AS `n_rotacion`,
                        `migracion_prueba`.`dt_rotacion`.`fecha` AS `fecha`,
                        sum(`migracion_prueba`.`dt_compras`.`saldo_salida`) AS `cant`,
                        sum(`migracion_prueba`.`dt_compras`.`vr_total`) AS `valort`,
                        `migracion_prueba`.`dt_proveedores`.`empresa` AS `empresa`,
                        `migracion_prueba`.`dt_costos`.`cod_material` AS `cod_material`,
                        `migracion_prueba`.`dt_compras`.`detalle_oc` AS `detalle_oc`,
                        `migracion_prueba`.`dt_compras`.`n_compra` AS `n_compra`,
                        `migracion_prueba`.`dt_compras`.`fecha_oc` AS `fecha_oc`,
                        `migracion_prueba`.`dt_clientes`.`nom_empresa` AS `nom_empresa`,
                        `migracion_prueba`.`dt_ordenes`.`nombre_proyecto` AS `nombre_proyecto`,
                        `migracion_prueba`.`dt_ordenes`.`n_ordenes` AS `n_ordenes`
                    from
                        (((((`migracion_prueba`.`dt_compras`
                    left join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_compras`.`id_costos` = `migracion_prueba`.`dt_costos`.`id_costo`)))
                    left join `migracion_prueba`.`dt_rotacion` on
                        ((`migracion_prueba`.`dt_rotacion`.`id_compra` = `migracion_prueba`.`dt_compras`.`id_compras`)))
                    left join `migracion_prueba`.`dt_proveedores` on
                        ((`migracion_prueba`.`dt_compras`.`id_proveedores` = `migracion_prueba`.`dt_proveedores`.`id_proveedores`)))
                    left join `migracion_prueba`.`dt_ordenes` on
                        ((`migracion_prueba`.`dt_compras`.`id_ordenes` = `migracion_prueba`.`dt_ordenes`.`id_ordenes`)))
                    left join `migracion_prueba`.`dt_clientes` on
                        ((`migracion_prueba`.`dt_clientes`.`id_cliente` = `migracion_prueba`.`dt_ordenes`.`id_cliente`)))
                    group by
                        `migracion_prueba`.`dt_compras`.`n_compra`,
                        `migracion_prueba`.`dt_costos`.`cod_material`
                    order by
                        `migracion_prueba`.`dt_compras`.`n_compra`,
                        `migracion_prueba`.`dt_costos`.`cod_material`;
                    
                    
                    -- migracion_prueba.vw_compras_saviv source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_compras_saviv` AS
                    select
                        sum(`migracion_prueba`.`dt_compras`.`vr_total`) AS `vr_total`,
                        `migracion_prueba`.`dt_tipo_pago`.`descripcion` AS `descripcion`,
                        `migracion_prueba`.`dt_compras`.`fecha_compromiso` AS `fecha_compromiso`
                    from
                        ((`migracion_prueba`.`dt_compras`
                    left join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_compras`.`id_costos` = `migracion_prueba`.`dt_costos`.`id_costo`)))
                    left join `migracion_prueba`.`dt_tipo_pago` on
                        ((`migracion_prueba`.`dt_compras`.`id_tipo_pago` = `migracion_prueba`.`dt_tipo_pago`.`id_tipo_pago`)))
                    where
                        (`migracion_prueba`.`dt_compras`.`id_proveedores` = 750)
                    group by
                        `migracion_prueba`.`dt_compras`.`id_tipo_pago`;
                    
                    
                    -- migracion_prueba.vw_compras_ter source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_compras_ter` AS
                    select
                        sum(`migracion_prueba`.`dt_compras`.`vr_total`) AS `valor_total`,
                        `migracion_prueba`.`dt_tipo_pago`.`descripcion` AS `descripcion`,
                        `migracion_prueba`.`dt_compras`.`fecha_oc` AS `fecha_oc`
                    from
                        ((`migracion_prueba`.`dt_compras`
                    left join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_compras`.`id_costos` = `migracion_prueba`.`dt_costos`.`id_costo`)))
                    left join `migracion_prueba`.`dt_tipo_pago` on
                        ((`migracion_prueba`.`dt_compras`.`id_tipo_pago` = `migracion_prueba`.`dt_tipo_pago`.`id_tipo_pago`)))
                    where
                        ((`migracion_prueba`.`dt_compras`.`id_proveedores` <> 750)
                            and (`migracion_prueba`.`dt_costos`.`id_tipo_costo` <> 1)
                                and (not((`migracion_prueba`.`dt_compras`.`detalle_oc` like '%viatico%'))))
                    group by
                        `migracion_prueba`.`dt_compras`.`id_tipo_pago`;
                    
                    
                    -- migracion_prueba.vw_compras_ter_p source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_compras_ter_p` AS
                    select
                        sum(`migracion_prueba`.`dt_compras`.`vr_total`) AS `vr_total`,
                        `migracion_prueba`.`dt_tipo_pago`.`descripcion` AS `descripcion`,
                        `migracion_prueba`.`dt_compras`.`fecha_compromiso` AS `fecha_compromiso`
                    from
                        ((`migracion_prueba`.`dt_compras`
                    left join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_compras`.`id_costos` = `migracion_prueba`.`dt_costos`.`id_costo`)))
                    left join `migracion_prueba`.`dt_tipo_pago` on
                        ((`migracion_prueba`.`dt_compras`.`id_tipo_pago` = `migracion_prueba`.`dt_tipo_pago`.`id_tipo_pago`)))
                    where
                        ((`migracion_prueba`.`dt_compras`.`id_proveedores` <> 750)
                            and (`migracion_prueba`.`dt_costos`.`id_tipo_costo` <> 1)
                                and ((`migracion_prueba`.`dt_compras`.`detalle_oc` like '%01A%')
                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%01B%')
                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%01C%')
                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%01D2%')
                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%01E%')
                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%01F%')
                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%01I%')
                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%01P1%')
                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%01z%')
                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%021C%')
                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%02A%')
                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%02B%')
                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%02C%')
                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%02D%')
                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%02E%')
                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%02F%')
                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%02H%')
                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%02I%')
                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%03D%')
                                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%05D%')
                                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%06A%')
                                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%07B%')
                                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%07C%')
                                                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%09A%')
                                                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%09C%')
                                                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%09F%')
                                                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%09I%')
                                                                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%09K%')
                                                                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%09L%')
                                                                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%09M%')
                                                                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%09z%')
                                                                                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%10F%')
                                                                                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%12A%')
                                                                                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%12C%')
                                                                                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%12D%')
                                                                                                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%12N%')
                                                                                                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%12P%')
                                                                                                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%12z%')
                                                                                                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%14ZD%')
                                                                                                                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%14ZE%')
                                                                                                                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%16C%')
                                                                                                                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%17A%')
                                                                                                                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%17AC%')
                                                                                                                                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%17GE%')
                                                                                                                                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%17GK%')
                                                                                                                                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%22H6%')
                                                                                                                                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%22M5%')
                                                                                                                                                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%2da%')
                                                                                                                                                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%6Z%')
                                                                                                                                                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%SUSTRATOS%')
                                                                                                                                                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%ENSAMBLE%')
                                                                                                                                                                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%IMPRESION%')
                                                                                                                                                                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%DECORACION%')
                                                                                                                                                                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%METALMECANICA%')
                                                                                                                                                                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%PINTURA%')))
                    group by
                        `migracion_prueba`.`dt_compras`.`id_tipo_pago`;
                    
                    
                    -- migracion_prueba.vw_compras_transporte source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_compras_transporte` AS
                    select
                        sum(`migracion_prueba`.`dt_compras`.`vr_total`) AS `vr_total`,
                        `migracion_prueba`.`dt_tipo_pago`.`descripcion` AS `descripcion`,
                        `migracion_prueba`.`dt_compras`.`fecha_compromiso` AS `fecha_compromiso`
                    from
                        ((`migracion_prueba`.`dt_compras`
                    left join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_compras`.`id_costos` = `migracion_prueba`.`dt_costos`.`id_costo`)))
                    left join `migracion_prueba`.`dt_tipo_pago` on
                        ((`migracion_prueba`.`dt_compras`.`id_tipo_pago` = `migracion_prueba`.`dt_tipo_pago`.`id_tipo_pago`)))
                    where
                        ((`migracion_prueba`.`dt_compras`.`id_proveedores` <> 750)
                            and (`migracion_prueba`.`dt_costos`.`id_tipo_costo` <> 1)
                                and ((`migracion_prueba`.`dt_compras`.`detalle_oc` like '%viatico%')
                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%transporte%')))
                    group by
                        `migracion_prueba`.`dt_compras`.`id_tipo_pago`;
                    
                    
                    -- migracion_prueba.vw_compras_x_hacer source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_compras_x_hacer` AS
                    select
                        `migracion_prueba`.`dt_costos`.`nombre_costo` AS `nombre_costo`,
                        `migracion_prueba`.`dt_costos`.`cod_material` AS `cod_material`,
                        sum(`migracion_prueba`.`dt_costos`.`valor_total`) AS `total`,
                        `migracion_prueba`.`dt_inventario`.`stock` AS `stock`,
                        sum(`migracion_prueba`.`dt_costos`.`cant_sol`) AS `totalc`,
                        (case
                            when (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 1) then 'MP'
                            when (`migracion_prueba`.`dt_costos`.`id_tipo_costo` in (3, 9, 6, 7, 8)) then 'Terc'
                            else 'N/A'
                        end) AS `tipo`,
                        `migracion_prueba`.`dt_costos`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_grupoinventario`.`grupo` AS `grupo`,
                        `migracion_prueba`.`dt_subgrupo`.`subgrupo` AS `subgrupo`,
                        `migracion_prueba`.`dt_clientes`.`nom_empresa` AS `nom_empresa`,
                        `migracion_prueba`.`dt_ordenes`.`nombre_proyecto` AS `nombre_proyecto`,
                        `migracion_prueba`.`dt_fechas_op`.`fecha_ingreso` AS `fecha_ingreso`
                    from
                        ((((((`migracion_prueba`.`dt_costos`
                    join `migracion_prueba`.`dt_inventario` on
                        ((`migracion_prueba`.`dt_costos`.`id_inventario` = `migracion_prueba`.`dt_inventario`.`id_inventario`)))
                    join `migracion_prueba`.`dt_subgrupo` on
                        ((`migracion_prueba`.`dt_subgrupo`.`id_subgrupo` = `migracion_prueba`.`dt_inventario`.`id_subgrupo`)))
                    join `migracion_prueba`.`dt_grupoinventario` on
                        ((`migracion_prueba`.`dt_grupoinventario`.`id_grupo_inventario` = `migracion_prueba`.`dt_subgrupo`.`id_subgrupo`)))
                    left join `migracion_prueba`.`dt_ordenes` on
                        ((`migracion_prueba`.`dt_ordenes`.`id_ordenes` = `migracion_prueba`.`dt_costos`.`id_ordenes`)))
                    left join `migracion_prueba`.`dt_clientes` on
                        ((`migracion_prueba`.`dt_clientes`.`id_cliente` = `migracion_prueba`.`dt_ordenes`.`id_cliente`)))
                    left join `migracion_prueba`.`dt_fechas_op` on
                        ((`migracion_prueba`.`dt_fechas_op`.`id_ordenes` = `migracion_prueba`.`dt_ordenes`.`id_ordenes`)))
                    where
                        ((`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 1)
                            and (`migracion_prueba`.`dt_costos`.`estado` in (1, 4, 7))
                                and (`migracion_prueba`.`dt_costos`.`n_ordenes` <> 0)
                                    and (`migracion_prueba`.`dt_ordenes`.`estado` in (1, 10, 12, 13))
                                        and (`migracion_prueba`.`dt_ordenes`.`conciliado` <> 1)
                                            and (`migracion_prueba`.`dt_costos`.`cant_sol` > 0)
                                                and (`migracion_prueba`.`dt_costos`.`cierre` = 0))
                    group by
                        `migracion_prueba`.`dt_costos`.`cod_material`,
                        `migracion_prueba`.`dt_ordenes`.`n_ordenes`
                    order by
                        `migracion_prueba`.`dt_costos`.`nombre_costo`;
                    
                    
                    -- migracion_prueba.vw_coordinador source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_coordinador` AS
                    select
                        `migracion_prueba`.`user`.`id` AS `id`,
                        `migracion_prueba`.`user`.`id_empleado` AS `id_empleado`,
                        `migracion_prueba`.`user`.`username` AS `username`,
                        concat(`migracion_prueba`.`dt_usuarios`.`nombre_usuario`, ' ', `migracion_prueba`.`dt_usuarios`.`apellido_usuario`) AS `nombre_usuario`
                    from
                        (`migracion_prueba`.`user`
                    join `migracion_prueba`.`dt_usuarios` on
                        ((`migracion_prueba`.`dt_usuarios`.`id_usuario` = `migracion_prueba`.`user`.`id_empleado`)))
                    where
                        ((`migracion_prueba`.`user`.`status` = 1)
                            and (`migracion_prueba`.`dt_usuarios`.`id_cargo` in (5, 9, 7, 74)));
                    
                    
                    -- migracion_prueba.vw_detalle_compra_logistica source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_detalle_compra_logistica` AS
                    select
                        `migracion_prueba`.`dt_proveedores`.`empresa` AS `empresa`,
                        `migracion_prueba`.`dt_compras`.`fecha_oc` AS `fecha_oc`,
                        `migracion_prueba`.`dt_compras`.`n_compra` AS `n_compra`,
                        `migracion_prueba`.`dt_compras`.`detalle_oc` AS `detalle_oc`,
                        `migracion_prueba`.`dt_compras`.`saldo_salida` AS `saldo_salida`,
                        `migracion_prueba`.`dt_compras`.`vr_unidad` AS `vr_unidad`,
                        `migracion_prueba`.`dt_compras`.`vr_total` AS `vr_total`
                    from
                        ((`migracion_prueba`.`dt_compras`
                    join `migracion_prueba`.`dt_proveedores` on
                        ((`migracion_prueba`.`dt_compras`.`id_proveedores` = `migracion_prueba`.`dt_proveedores`.`id_proveedores`)))
                    left join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_compras`.`id_costos` = `migracion_prueba`.`dt_costos`.`id_costo`)))
                    where
                        ((`migracion_prueba`.`dt_costos`.`id_tipo_costo` <> 1)
                            and (`migracion_prueba`.`dt_compras`.`id_proveedores` <> 750)
                                and ((`migracion_prueba`.`dt_compras`.`detalle_oc` like '%ALQUILER%')
                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%FLETES%')
                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%fac%')))
                    order by
                        `migracion_prueba`.`dt_compras`.`vr_total` desc;
                    
                    
                    -- migracion_prueba.vw_detalle_compra_mp source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_detalle_compra_mp` AS
                    select
                        `migracion_prueba`.`dt_proveedores`.`empresa` AS `empresa`,
                        `migracion_prueba`.`dt_compras`.`fecha_oc` AS `fecha_oc`,
                        `migracion_prueba`.`dt_compras`.`n_compra` AS `n_compra`,
                        `migracion_prueba`.`dt_compras`.`detalle_oc` AS `detalle_oc`,
                        `migracion_prueba`.`dt_compras`.`saldo_salida` AS `saldo_salida`,
                        `migracion_prueba`.`dt_compras`.`vr_unidad` AS `vr_unidad`,
                        `migracion_prueba`.`dt_compras`.`vr_total` AS `vr_total`
                    from
                        ((`migracion_prueba`.`dt_compras`
                    join `migracion_prueba`.`dt_proveedores` on
                        ((`migracion_prueba`.`dt_compras`.`id_proveedores` = `migracion_prueba`.`dt_proveedores`.`id_proveedores`)))
                    left join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_compras`.`id_costos` = `migracion_prueba`.`dt_costos`.`id_costo`)))
                    where
                        ((`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 1)
                            and (`migracion_prueba`.`dt_compras`.`id_proveedores` <> 750));
                    
                    
                    -- migracion_prueba.vw_detalle_compra_saviv source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_detalle_compra_saviv` AS
                    select
                        `migracion_prueba`.`dt_proveedores`.`empresa` AS `empresa`,
                        `migracion_prueba`.`dt_compras`.`fecha_oc` AS `fecha_oc`,
                        `migracion_prueba`.`dt_compras`.`n_compra` AS `n_compra`,
                        `migracion_prueba`.`dt_compras`.`detalle_oc` AS `detalle_oc`,
                        `migracion_prueba`.`dt_compras`.`saldo_salida` AS `saldo_salida`,
                        `migracion_prueba`.`dt_compras`.`vr_unidad` AS `vr_unidad`,
                        `migracion_prueba`.`dt_compras`.`vr_total` AS `vr_total`
                    from
                        (`migracion_prueba`.`dt_compras`
                    join `migracion_prueba`.`dt_proveedores` on
                        ((`migracion_prueba`.`dt_compras`.`id_proveedores` = `migracion_prueba`.`dt_proveedores`.`id_proveedores`)))
                    where
                        (`migracion_prueba`.`dt_compras`.`id_proveedores` = 750)
                    order by
                        `migracion_prueba`.`dt_compras`.`vr_total` desc;
                    
                    
                    -- migracion_prueba.vw_detalle_compra_ter_com source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_detalle_compra_ter_com` AS
                    select
                        `migracion_prueba`.`dt_proveedores`.`empresa` AS `empresa`,
                        `migracion_prueba`.`dt_compras`.`fecha_oc` AS `fecha_oc`,
                        `migracion_prueba`.`dt_compras`.`n_compra` AS `n_compra`,
                        `migracion_prueba`.`dt_compras`.`detalle_oc` AS `detalle_oc`,
                        `migracion_prueba`.`dt_compras`.`saldo_salida` AS `saldo_salida`,
                        `migracion_prueba`.`dt_compras`.`vr_unidad` AS `vr_unidad`,
                        `migracion_prueba`.`dt_compras`.`vr_total` AS `vr_total`
                    from
                        ((`migracion_prueba`.`dt_compras`
                    join `migracion_prueba`.`dt_proveedores` on
                        ((`migracion_prueba`.`dt_compras`.`id_proveedores` = `migracion_prueba`.`dt_proveedores`.`id_proveedores`)))
                    left join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_compras`.`id_costos` = `migracion_prueba`.`dt_costos`.`id_costo`)))
                    where
                        ((`migracion_prueba`.`dt_costos`.`id_tipo_costo` <> 1)
                            and (`migracion_prueba`.`dt_compras`.`id_proveedores` <> 750)
                                and ((`migracion_prueba`.`dt_compras`.`detalle_oc` like '%LASER%')
                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%POLIZA%')
                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%PERMISO%')
                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%PUNZONADO%')
                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%VIDRIO%')
                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%BRAILE%')
                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%ROLADO%')))
                    order by
                        `migracion_prueba`.`dt_compras`.`vr_total` desc;
                    
                    
                    -- migracion_prueba.vw_detalle_compra_ter_pro source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_detalle_compra_ter_pro` AS
                    select
                        `migracion_prueba`.`dt_proveedores`.`empresa` AS `empresa`,
                        `migracion_prueba`.`dt_compras`.`fecha_oc` AS `fecha_oc`,
                        `migracion_prueba`.`dt_compras`.`n_compra` AS `n_compra`,
                        `migracion_prueba`.`dt_compras`.`detalle_oc` AS `detalle_oc`,
                        `migracion_prueba`.`dt_compras`.`saldo_salida` AS `saldo_salida`,
                        `migracion_prueba`.`dt_compras`.`vr_unidad` AS `vr_unidad`,
                        `migracion_prueba`.`dt_compras`.`vr_total` AS `vr_total`
                    from
                        ((`migracion_prueba`.`dt_compras`
                    join `migracion_prueba`.`dt_proveedores` on
                        ((`migracion_prueba`.`dt_compras`.`id_proveedores` = `migracion_prueba`.`dt_proveedores`.`id_proveedores`)))
                    left join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_compras`.`id_costos` = `migracion_prueba`.`dt_costos`.`id_costo`)))
                    where
                        ((`migracion_prueba`.`dt_costos`.`id_tipo_costo` <> 1)
                            and (`migracion_prueba`.`dt_compras`.`id_proveedores` <> 750)
                                and ((`migracion_prueba`.`dt_compras`.`detalle_oc` like '%01A%')
                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%01B%')
                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%01C%')
                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%01D2%')
                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%01E%')
                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%01F%')
                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%01I%')
                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%01P1%')
                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%01z%')
                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%021C%')
                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%02A%')
                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%02B%')
                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%02C%')
                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%02D%')
                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%02E%')
                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%02F%')
                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%02H%')
                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%02I%')
                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%03D%')
                                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%05D%')
                                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%06A%')
                                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%07B%')
                                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%07C%')
                                                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%09A%')
                                                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%09C%')
                                                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%09F%')
                                                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%09I%')
                                                                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%09K%')
                                                                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%09L%')
                                                                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%09M%')
                                                                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%09z%')
                                                                                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%10F%')
                                                                                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%12A%')
                                                                                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%12C%')
                                                                                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%12D%')
                                                                                                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%12N%')
                                                                                                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%12P%')
                                                                                                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%12z%')
                                                                                                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%14ZD%')
                                                                                                                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%14ZE%')
                                                                                                                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%16C%')
                                                                                                                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%17A%')
                                                                                                                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%17AC%')
                                                                                                                                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%17GE%')
                                                                                                                                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%17GK%')
                                                                                                                                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%22H6%')
                                                                                                                                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%22M5%')
                                                                                                                                                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%2da%')
                                                                                                                                                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%6Z%')
                                                                                                                                                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%SUSTRATOS%')
                                                                                                                                                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%ENSAMBLE%')
                                                                                                                                                                                                                                            or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%IMPRESION%')
                                                                                                                                                                                                                                                or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%DECORACION%')
                                                                                                                                                                                                                                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%METALMECANICA%')
                                                                                                                                                                                                                                                        or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%PINTURA%')))
                    order by
                        `migracion_prueba`.`dt_compras`.`vr_total` desc;
                    
                    
                    -- migracion_prueba.vw_detalle_compra_transporte source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_detalle_compra_transporte` AS
                    select
                        `migracion_prueba`.`dt_proveedores`.`empresa` AS `empresa`,
                        `migracion_prueba`.`dt_compras`.`fecha_oc` AS `fecha_oc`,
                        `migracion_prueba`.`dt_compras`.`n_compra` AS `n_compra`,
                        `migracion_prueba`.`dt_compras`.`detalle_oc` AS `detalle_oc`,
                        `migracion_prueba`.`dt_compras`.`saldo_salida` AS `saldo_salida`,
                        `migracion_prueba`.`dt_compras`.`vr_unidad` AS `vr_unidad`,
                        `migracion_prueba`.`dt_compras`.`vr_total` AS `vr_total`
                    from
                        ((`migracion_prueba`.`dt_compras`
                    join `migracion_prueba`.`dt_proveedores` on
                        ((`migracion_prueba`.`dt_compras`.`id_proveedores` = `migracion_prueba`.`dt_proveedores`.`id_proveedores`)))
                    left join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_compras`.`id_costos` = `migracion_prueba`.`dt_costos`.`id_costo`)))
                    where
                        ((`migracion_prueba`.`dt_costos`.`id_tipo_costo` <> 1)
                            and (`migracion_prueba`.`dt_compras`.`id_proveedores` <> 750)
                                and ((`migracion_prueba`.`dt_compras`.`detalle_oc` like '%viatico%')
                                    or (`migracion_prueba`.`dt_compras`.`detalle_oc` like '%transporte%')))
                    order by
                        `migracion_prueba`.`dt_compras`.`vr_total` desc;
                    
                    
                    -- migracion_prueba.vw_documento_factura source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_documento_factura` AS
                    select
                        `migracion_prueba`.`dt_clientes`.`nom_empresa` AS `nom_empresa`,
                        `migracion_prueba`.`dt_clientes`.`nit` AS `nit`,
                        `migracion_prueba`.`dt_clientes`.`dig_verificacion` AS `dig_verificacion`,
                        `migracion_prueba`.`dt_factura`.`id_factura` AS `id_factura`,
                        `migracion_prueba`.`dt_factura`.`n_factura` AS `n_factura`,
                        `migracion_prueba`.`dt_factura`.`observaciones` AS `observaciones`,
                        `migracion_prueba`.`dt_clientes`.`direccion` AS `direccion`,
                        `migracion_prueba`.`dt_geografia`.`nombre` AS `nombre`,
                        `migracion_prueba`.`dt_clientes`.`telefono` AS `telefono`,
                        `migracion_prueba`.`dt_factura`.`fecha_factura` AS `fecha_factura`,
                        `migracion_prueba`.`dt_factura`.`fecha_vencimiento` AS `fecha_vencimiento`,
                        `migracion_prueba`.`dt_forma_pago`.`descripcion` AS `descripcion`,
                        `migracion_prueba`.`dt_factura`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_factura`.`cantidad` AS `cantidad`,
                        `migracion_prueba`.`dt_factura`.`referencia` AS `referencia`,
                        `migracion_prueba`.`dt_factura`.`vr_unidad` AS `vr_unidad`,
                        `migracion_prueba`.`dt_factura`.`vr_total` AS `vr_total`,
                        `migracion_prueba`.`dt_factura`.`valor_bruto` AS `valor_bruto`,
                        `migracion_prueba`.`dt_factura`.`iva` AS `iva`,
                        `migracion_prueba`.`dt_factura`.`anticipo` AS `anticipo`,
                        `migracion_prueba`.`dt_factura`.`r_fuente` AS `r_fuente`,
                        `migracion_prueba`.`dt_factura`.`r_iva` AS `r_iva`,
                        `migracion_prueba`.`dt_factura`.`r_ica` AS `r_ica`
                    from
                        (((`migracion_prueba`.`dt_factura`
                    join `migracion_prueba`.`dt_clientes` on
                        ((`migracion_prueba`.`dt_factura`.`id_cliente` = `migracion_prueba`.`dt_clientes`.`id_cliente`)))
                    left join `migracion_prueba`.`dt_geografia` on
                        ((`migracion_prueba`.`dt_clientes`.`id_geografia` = `migracion_prueba`.`dt_geografia`.`id_geografia`)))
                    left join `migracion_prueba`.`dt_forma_pago` on
                        ((`migracion_prueba`.`dt_factura`.`id_forma_pago` = `migracion_prueba`.`dt_forma_pago`.`id_forma_pago`)))
                    order by
                        `migracion_prueba`.`dt_factura`.`n_factura`,
                        `migracion_prueba`.`dt_factura`.`id_factura`;
                    
                    
                    -- migracion_prueba.vw_entradas_alm source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_entradas_alm` AS
                    select
                        `r`.`id_rotacion` AS `id_rotacion`,
                        `r`.`id_tipo_rotacion` AS `id_tipo_rotacion`,
                        `r`.`n_rotacion` AS `n_rotacion`,
                        `c`.`n_compra` AS `n_compra`,
                        `r`.`factura` AS `factura`,
                        `r`.`n_remision_prov` AS `n_remision_prov`,
                        `c`.`n_ordenes` AS `n_ordenes`,
                        `i`.`producto` AS `producto`,
                        `r`.`estado` AS `estado`,
                        format(sum(`r`.`cantidad`), 2) AS `cantidad`
                    from
                        ((`migracion_prueba`.`dt_rotacion` `r`
                    left join `migracion_prueba`.`dt_compras` `c` on
                        ((`r`.`id_compra` = `c`.`id_compras`)))
                    join `migracion_prueba`.`dt_inventario` `i` on
                        ((`r`.`cod_prod` = `i`.`codigo_prod`)))
                    where
                        (`r`.`id_tipo_rotacion` in (9, 25, 26))
                    group by
                        `c`.`n_ordenes`,
                        `r`.`n_rotacion`
                    order by
                        `r`.`n_rotacion` desc;
                    
                    
                    
                    
                    
                    -- migracion_prueba.vw_existencias_almacen source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_existencias_almacen` AS
                    select
                        `ia`.`id_inventarioxarea` AS `id_inventarioxarea`,
                        `ia`.`stock` AS `stock`,
                        `m`.`medida` AS `medida`,
                        `i`.`codigo_prod` AS `codigo_prod`,
                        `i`.`producto` AS `producto`,
                        `i`.`valor_total` AS `valor_total`,
                        `i`.`tiempo_compra` AS `tiempo_compra`
                    from
                        ((`migracion_prueba`.`dt_inventario` `i`
                    join `migracion_prueba`.`dt_medida` `m` on
                        ((`i`.`id_medida` = `m`.`id_medida`)))
                    join `migracion_prueba`.`dt_inventarioxarea` `ia` on
                        ((`ia`.`id_inventario` = `i`.`id_inventario`)))
                    where
                        ((`ia`.`id_area` = 12)
                            and (`i`.`kardex_estado` <> 0)
                                and (`ia`.`stock` > '0'))
                    order by
                        `i`.`producto`;
                    
                    
                    -- migracion_prueba.vw_facturacion_clientes source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_facturacion_clientes` AS
                    select
                        `migracion_prueba`.`dt_factura`.`id_factura` AS `id_factura`,
                        `migracion_prueba`.`dt_factura`.`n_factura` AS `n_factura`,
                        `migracion_prueba`.`dt_factura`.`fecha_factura` AS `fecha_factura`,
                        `migracion_prueba`.`dt_factura`.`fecha_vencimiento` AS `fecha_vencimiento`,
                        `migracion_prueba`.`dt_factura`.`puc_cuenta` AS `puc_cuenta`,
                        `migracion_prueba`.`dt_clientes`.`nom_empresa` AS `nom_empresa`,
                        `migracion_prueba`.`dt_factura`.`letra` AS `letra`,
                        `migracion_prueba`.`dt_factura`.`letra_cta` AS `letra_cta`,
                        sum(`migracion_prueba`.`dt_factura`.`vr_total`) AS `vr_total`,
                        sum(`migracion_prueba`.`dt_factura`.`iva`) AS `iva`,
                        sum(`migracion_prueba`.`dt_factura`.`r_fuente`) AS `r_fuente`,
                        sum(`migracion_prueba`.`dt_factura`.`r_iva`) AS `r_iva`,
                        sum(`migracion_prueba`.`dt_factura`.`r_ica`) AS `r_ica`
                    from
                        (`migracion_prueba`.`dt_factura`
                    join `migracion_prueba`.`dt_clientes` on
                        ((`migracion_prueba`.`dt_clientes`.`id_cliente` = `migracion_prueba`.`dt_factura`.`id_cliente`)))
                    group by
                        `migracion_prueba`.`dt_factura`.`n_factura`;
                    
                    
                    -- migracion_prueba.vw_facturas_provedores source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_facturas_provedores` AS
                    select
                        `migracion_prueba`.`dt_rotacion`.`id_rotacion` AS `id_rotacion`,
                        `migracion_prueba`.`dt_factura_proveedor`.`id_factura_proveedor` AS `id_factura_proveedor`,
                        `migracion_prueba`.`dt_proveedores`.`nit` AS `nit`,
                        `migracion_prueba`.`dt_rotacion`.`cons_contable` AS `cons_contable`,
                        `migracion_prueba`.`dt_rotacion`.`letra` AS `letra`,
                        `migracion_prueba`.`dt_rotacion`.`letra_cta` AS `letra_cta`,
                        `migracion_prueba`.`dt_factura_proveedor`.`factura` AS `factura`,
                        `migracion_prueba`.`dt_factura_proveedor`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_proveedores`.`empresa` AS `empresa`,
                        `migracion_prueba`.`dt_factura_proveedor`.`puc_prodrt` AS `puc_prodrt`,
                        `migracion_prueba`.`dt_factura_proveedor`.`puc_ivart` AS `puc_ivart`,
                        `migracion_prueba`.`dt_factura_proveedor`.`puc_rtftert` AS `puc_rtftert`,
                        `migracion_prueba`.`dt_factura_proveedor`.`puc_rtivart` AS `puc_rtivart`,
                        `migracion_prueba`.`dt_factura_proveedor`.`puc_rticart` AS `puc_rticart`,
                        sum(`migracion_prueba`.`dt_factura_proveedor`.`valor`) AS `valor`,
                        sum(`migracion_prueba`.`dt_factura_proveedor`.`iva_rt`) AS `iva_rt`,
                        sum(`migracion_prueba`.`dt_factura_proveedor`.`rtfte_rt`) AS `rtfte_rt`,
                        sum(`migracion_prueba`.`dt_factura_proveedor`.`rtiva_rt`) AS `rtiva_rt`,
                        `migracion_prueba`.`dt_factura_proveedor`.`fecha_factura` AS `fecha_factura`,
                        `migracion_prueba`.`dt_factura_proveedor`.`fecha_vencimiento` AS `fecha_vencimiento`,
                        `migracion_prueba`.`dt_compras`.`detalle_oc` AS `detalle_oc`,
                        sum(`migracion_prueba`.`dt_rotacion`.`vr_total`) AS `vr_total`,
                        `migracion_prueba`.`dt_compras`.`puc_id` AS `puc_id`,
                        `migracion_prueba`.`dt_factura_proveedor`.`fecha_creacion` AS `fecha_creacion`
                    from
                        (((`migracion_prueba`.`dt_rotacion`
                    join `migracion_prueba`.`dt_factura_proveedor` on
                        ((`migracion_prueba`.`dt_rotacion`.`factura_proveedor` = `migracion_prueba`.`dt_factura_proveedor`.`factura`)))
                    join `migracion_prueba`.`dt_compras` on
                        ((`migracion_prueba`.`dt_compras`.`id_compras` = `migracion_prueba`.`dt_rotacion`.`id_compra`)))
                    join `migracion_prueba`.`dt_proveedores` on
                        ((`migracion_prueba`.`dt_compras`.`id_proveedores` = `migracion_prueba`.`dt_proveedores`.`id_proveedores`)))
                    where
                        (`migracion_prueba`.`dt_factura_proveedor`.`estado` <> 2)
                    group by
                        `migracion_prueba`.`dt_factura_proveedor`.`id_factura_proveedor`,
                        `migracion_prueba`.`dt_compras`.`detalle_oc`
                    order by
                        `migracion_prueba`.`dt_rotacion`.`cons_contable`,
                        `migracion_prueba`.`dt_rotacion`.`fecha_legalizacion`;
                    
                    
                    -- migracion_prueba.vw_gantt_g_r source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_gantt_g_r` AS
                    select
                        `migracion_prueba`.`dt_actividades`.`actividad` AS `actividad`,
                        `migracion_prueba`.`dt_actividades`.`fecha_inicio` AS `fecha_inicio`,
                        `migracion_prueba`.`dt_actividades`.`fecha_fin` AS `fecha_fin`,
                        `migracion_prueba`.`dt_actividades`.`orden` AS `orden`,
                        `migracion_prueba`.`dt_actividades`.`id_comite_g_r` AS `id_comite_g_r`,
                        (case
                            when (`migracion_prueba`.`dt_actividades`.`tipo` = 1) then 'FORMA'
                            when (`migracion_prueba`.`dt_actividades`.`tipo` = 2) then 'FONDO'
                            else 'N/A'
                        end) AS `tipo`,
                        concat(`migracion_prueba`.`dt_usuarios`.`nombre_usuario`, ' ', `migracion_prueba`.`dt_usuarios`.`apellido_usuario`) AS `nombre_usuario`
                    from
                        ((`migracion_prueba`.`dt_actividades`
                    join `migracion_prueba`.`user` on
                        ((`migracion_prueba`.`dt_actividades`.`responsable` = `migracion_prueba`.`user`.`id`)))
                    join `migracion_prueba`.`dt_usuarios` on
                        ((`migracion_prueba`.`user`.`id_empleado` = `migracion_prueba`.`dt_usuarios`.`id_usuario`)))
                    order by
                        `migracion_prueba`.`dt_actividades`.`tipo`,
                        `migracion_prueba`.`dt_actividades`.`fecha_inicio`;
                    
                    
                    -- migracion_prueba.vw_gantt_g_r_f source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_gantt_g_r_f` AS
                    select
                        `migracion_prueba`.`dt_actividades_f`.`actividad` AS `actividad`,
                        `migracion_prueba`.`dt_actividades_f`.`fecha_inicio` AS `fecha_inicio`,
                        `migracion_prueba`.`dt_actividades_f`.`fecha_fin` AS `fecha_fin`,
                        `migracion_prueba`.`dt_actividades_f`.`orden` AS `orden`,
                        `migracion_prueba`.`dt_actividades_f`.`id_comite_g_r_f` AS `id_comite_g_r`,
                        (case
                            when (`migracion_prueba`.`dt_actividades_f`.`tipo` = 1) then 'FORMA'
                            when (`migracion_prueba`.`dt_actividades_f`.`tipo` = 2) then 'FONDO'
                            else 'N/A'
                        end) AS `tipo`,
                        concat(`migracion_prueba`.`dt_usuarios`.`nombre_usuario`, ' ', `migracion_prueba`.`dt_usuarios`.`apellido_usuario`) AS `nombre_usuario`
                    from
                        ((`migracion_prueba`.`dt_actividades_f`
                    join `migracion_prueba`.`user` on
                        ((`migracion_prueba`.`dt_actividades_f`.`responsable` = `migracion_prueba`.`user`.`id`)))
                    join `migracion_prueba`.`dt_usuarios` on
                        ((`migracion_prueba`.`user`.`id_empleado` = `migracion_prueba`.`dt_usuarios`.`id_usuario`)))
                    order by
                        `migracion_prueba`.`dt_actividades_f`.`tipo`,
                        `migracion_prueba`.`dt_actividades_f`.`fecha_inicio`;
                    
                    
                    -- migracion_prueba.vw_historico_ft source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_historico_ft` AS
                    select
                        `migracion_prueba`.`dt_historico_ft`.`id_historico_ft` AS `id_historico_ft`,
                        `migracion_prueba`.`dt_programacion_diseno`.`cod` AS `cod`,
                        `migracion_prueba`.`dt_estructura_p_diseno`.`grupo` AS `grupo`,
                        `migracion_prueba`.`dt_historico_ft`.`tipo` AS `tipo`,
                        `migracion_prueba`.`dt_programacion_diseno`.`n_programacion` AS `n_programacion`,
                        (case
                            when (`migracion_prueba`.`dt_historico_ft`.`tipo` = 1) then 'Foto'
                            when (`migracion_prueba`.`dt_historico_ft`.`tipo` = 2) then 'Archivo'
                            else 'N/A'
                        end) AS `tipo_nombre`,
                        `migracion_prueba`.`dt_historico_ft`.`fecha_registro` AS `fecha_registro`,
                        `migracion_prueba`.`dt_historico_ft`.`ruta` AS `ruta`,
                        `migracion_prueba`.`dt_historico_ft`.`recurso` AS `recurso`,
                        `migracion_prueba`.`dt_historico_ft`.`observaciones` AS `observaciones`,
                        `migracion_prueba`.`user`.`nombre_usuario` AS `nombre_usuario`
                    from
                        (((`migracion_prueba`.`dt_estructura_p_diseno`
                    join `migracion_prueba`.`dt_programacion_diseno` on
                        ((`migracion_prueba`.`dt_estructura_p_diseno`.`id_programacion_diseno` = `migracion_prueba`.`dt_programacion_diseno`.`id_programacion_diseno`)))
                    join `migracion_prueba`.`dt_historico_ft` on
                        ((`migracion_prueba`.`dt_historico_ft`.`id_estructura_p_diseno` = `migracion_prueba`.`dt_estructura_p_diseno`.`id_estructura_p_diseno`)))
                    join `migracion_prueba`.`user` on
                        ((`migracion_prueba`.`dt_historico_ft`.`id_user` = `migracion_prueba`.`user`.`id`)));
                    
                    
                    -- migracion_prueba.vw_home_materiales source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_home_materiales` AS
                    select
                        `c`.`id_costo` AS `id_costo`,
                        `c`.`n_ordenes` AS `n_ordenes`,
                        `g`.`grupo` AS `grupo`,
                        `c`.`cod_material` AS `cod_material`,
                        `c`.`nombre_costo` AS `nombre_costo`,
                        `c`.`cant_sol` AS `cant_sol`,
                        `i`.`id_inventario` AS `id_inventario`,
                        `o`.`id_ordenes` AS `id_ordenes`,
                        `o`.`id_proyecto_op` AS `id_proyecto_op`,
                        `p`.`id_macro_proyecto` AS `id_macro_proyecto`
                    from
                        ((((`migracion_prueba`.`dt_costos` `c`
                    join `migracion_prueba`.`dt_inventario` `i` on
                        ((`c`.`cod_material` = `i`.`codigo_prod`)))
                    join `migracion_prueba`.`dt_grupoinventario` `g` on
                        ((`i`.`id_subgrupo` = `g`.`id_grupo_inventario`)))
                    join `migracion_prueba`.`dt_ordenes` `o` on
                        ((`o`.`id_ordenes` = `c`.`id_ordenes`)))
                    join `migracion_prueba`.`dt_proyecto_op` `p` on
                        ((`o`.`id_proyecto_op` = `p`.`id_proyecto_op`)))
                    where
                        ((`c`.`id_tipo_costo` = 1)
                            and (`c`.`estado` <> 0))
                    group by
                        `c`.`id_costo`
                    order by
                        `c`.`nombre_costo`;
                    
                    
                    -- migracion_prueba.vw_informe_codproducto source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_informe_codproducto` AS
                    select
                        `migracion_prueba`.`dt_codprodfinal`.`id_codprodfinal` AS `id_codprodfinal`,
                        `migracion_prueba`.`dt_codprodfinal`.`cod` AS `cod`,
                        `migracion_prueba`.`dt_categoria`.`nombre_categoria` AS `nombre_categoria`,
                        `migracion_prueba`.`dt_codprodfinal`.`nom_codigo` AS `nom_codigo`,
                        `migracion_prueba`.`dt_codprodfinal`.`tam_x` AS `tam_x`,
                        `migracion_prueba`.`dt_codprodfinal`.`tam_y` AS `tam_y`,
                        `migracion_prueba`.`dt_codprodfinal`.`tam_z` AS `tam_z`,
                        `migracion_prueba`.`dt_codprodfinal`.`tam_l` AS `tam_l`,
                        (case
                            when (`migracion_prueba`.`dt_codprodfinal`.`tipo_producto` = 1) then 'A'
                            when (`migracion_prueba`.`dt_codprodfinal`.`tipo_producto` = 2) then 'B'
                            when (`migracion_prueba`.`dt_codprodfinal`.`tipo_producto` = 3) then 'C'
                            else 'N/A'
                        end) AS `tipo_producto`,
                        (case
                            when (`migracion_prueba`.`dt_codprodfinal`.`tipo_presupuesto` = 0) then 'Cantidad'
                            when (`migracion_prueba`.`dt_codprodfinal`.`tipo_presupuesto` = 1) then 'Metro Cuadrado'
                            when (`migracion_prueba`.`dt_codprodfinal`.`tipo_presupuesto` = 2) then 'Metro Lineal'
                            when (`migracion_prueba`.`dt_codprodfinal`.`tipo_presupuesto` = 3) then 'Metro Cúbico'
                            else 'N/A'
                        end) AS `tipo_presupuesto`,
                        `migracion_prueba`.`dt_clientes`.`nom_empresa` AS `nom_empresa`
                    from
                        ((`migracion_prueba`.`dt_codprodfinal`
                    join `migracion_prueba`.`dt_categoria` on
                        ((`migracion_prueba`.`dt_codprodfinal`.`id_categoria` = `migracion_prueba`.`dt_codprodfinal`.`id_categoria`)))
                    join `migracion_prueba`.`dt_clientes` on
                        ((`migracion_prueba`.`dt_clientes`.`id_cliente` = `migracion_prueba`.`dt_codprodfinal`.`id_cliente`)));
                    
                    
                    -- migracion_prueba.vw_informe_factura source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_informe_factura` AS
                    select
                        `migracion_prueba`.`dt_factura`.`fecha_creacion` AS `fecha_creacion`,
                        `migracion_prueba`.`dt_factura`.`n_factura` AS `n_factura`,
                        `migracion_prueba`.`dt_clientes`.`nom_empresa` AS `nom_empresa`,
                        `migracion_prueba`.`dt_clientes`.`nit` AS `nit`,
                        `migracion_prueba`.`dt_clientes`.`dig_verificacion` AS `dig_verificacion`,
                        `migracion_prueba`.`user`.`nombre_usuario` AS `nombre_usuario`,
                        `migracion_prueba`.`dt_factura`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_factura`.`cantidad` AS `cantidad`,
                        `migracion_prueba`.`dt_factura`.`valor_bruto` AS `valor_bruto`,
                        sum(`migracion_prueba`.`dt_factura`.`iva`) AS `iva`,
                        sum(`migracion_prueba`.`dt_factura`.`r_fuente`) AS `r_fuente`,
                        sum(`migracion_prueba`.`dt_factura`.`r_ica`) AS `r_ica`,
                        sum(`migracion_prueba`.`dt_factura`.`r_iva`) AS `r_iva`,
                        sum(`migracion_prueba`.`dt_factura`.`descuento`) AS `descuento`,
                        sum(`migracion_prueba`.`dt_factura`.`anticipo`) AS `anticipo`
                    from
                        ((`migracion_prueba`.`dt_factura`
                    join `migracion_prueba`.`dt_clientes` on
                        ((`migracion_prueba`.`dt_factura`.`id_cliente` = `migracion_prueba`.`dt_clientes`.`id_cliente`)))
                    join `migracion_prueba`.`user` on
                        ((`migracion_prueba`.`dt_factura`.`id_vendedor` = `migracion_prueba`.`user`.`id`)))
                    group by
                        `migracion_prueba`.`dt_factura`.`n_factura`;
                    
                    
                    -- migracion_prueba.vw_informe_general_cabina source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_informe_general_cabina` AS
                    select
                        `migracion_prueba`.`dt_ordenes`.`id_ordenes` AS `id_ordenes`,
                        `migracion_prueba`.`dt_ordenes`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_ordenes`.`referencia` AS `referencia`,
                        `migracion_prueba`.`dt_ordenes`.`cod` AS `cod`,
                        `migracion_prueba`.`dt_ordenes`.`item_op` AS `item_op`,
                        `migracion_prueba`.`dt_ordenes`.`id_codprodfinal` AS `id_codprodfinal`,
                        `migracion_prueba`.`dt_ordenes`.`id_categoria` AS `id_categoria`,
                        `migracion_prueba`.`dt_ordenes`.`id_subcategoria` AS `id_subcategoria`,
                        `migracion_prueba`.`dt_ordenes`.`cobro` AS `cobro`,
                        `migracion_prueba`.`dt_ordenes`.`archivo` AS `archivo`,
                        `migracion_prueba`.`dt_ordenes`.`cantidad` AS `cantidad`,
                        `migracion_prueba`.`dt_proyecto_op`.`nombre_proyecto` AS `nombre_proyecto`,
                        `migracion_prueba`.`dt_macro_proyecto`.`nombre_proyecto` AS `macro_proyecto`,
                        `migracion_prueba`.`dt_ordenes`.`ref_general` AS `nombre_op`,
                        `migracion_prueba`.`dt_clientes`.`nom_empresa` AS `nom_empresa`,
                        date_format(`migracion_prueba`.`dt_fechas_op`.`fecha_registro`, '%d - %b - %Y') AS `fecha_registro`,
                        date_format(`migracion_prueba`.`dt_fechas_op`.`fecha_ft`, '%d - %b - %Y') AS `fecha_ft`,
                        date_format(`migracion_prueba`.`dt_fechas_op`.`fecha_gantt`, '%d - %b - %Y') AS `fecha_gantt`,
                        date_format(`migracion_prueba`.`dt_fechas_op`.`fecha_costos`, '%d - %b - %Y') AS `fecha_costos`,
                        date_format(`migracion_prueba`.`dt_fechas_op`.`fecha_produccion`, '%d - %b - %Y') AS `fecha_produccion`,
                        date_format(`migracion_prueba`.`dt_fechas_op`.`fecha_contractual`, '%d - %b - %Y') AS `fecha_contractual`,
                        date_format(`migracion_prueba`.`dt_fechas_op`.`fecha_trans_inst`, '%d - %b - %Y') AS `fecha_trans_inst`,
                        date_format(`migracion_prueba`.`dt_fechas_op`.`fecha_instalacion`, '%d - %b - %Y') AS `fecha_instalacion`,
                        date_format(`migracion_prueba`.`dt_fechas_op`.`fecha_finstalacion`, '%d - %b - %Y') AS `fecha_finstalacion`,
                        date_format(`migracion_prueba`.`dt_fechas_op`.`fecha_aprobacion_admi`, '%d - %b - %Y') AS `fecha_aprobacion_admi`,
                        `migracion_prueba`.`user`.`nombre_usuario` AS `nombre_usuario`,
                        `migracion_prueba`.`dt_ordenes`.`estado` AS `estado_op`,
                        `migracion_prueba`.`dt_ordenes`.`v_total` AS `v_total`,
                        `migracion_prueba`.`dt_costos`.`cierre` AS `cierre`
                    from
                        ((((((`migracion_prueba`.`dt_ordenes`
                    join `migracion_prueba`.`dt_clientes` on
                        ((`migracion_prueba`.`dt_clientes`.`id_cliente` = `migracion_prueba`.`dt_ordenes`.`id_cliente`)))
                    left join `migracion_prueba`.`dt_proyecto_op` on
                        ((`migracion_prueba`.`dt_proyecto_op`.`id_proyecto_op` = `migracion_prueba`.`dt_ordenes`.`id_proyecto_op`)))
                    left join `migracion_prueba`.`dt_macro_proyecto` on
                        ((`migracion_prueba`.`dt_macro_proyecto`.`id_macro_proyecto` = `migracion_prueba`.`dt_proyecto_op`.`id_macro_proyecto`)))
                    left join `migracion_prueba`.`dt_fechas_op` on
                        ((`migracion_prueba`.`dt_fechas_op`.`id_ordenes` = `migracion_prueba`.`dt_ordenes`.`id_ordenes`)))
                    left join `migracion_prueba`.`user` on
                        ((`migracion_prueba`.`user`.`id` = `migracion_prueba`.`dt_ordenes`.`id_coordinador`)))
                    left join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_costos`.`id_ordenes` = `migracion_prueba`.`dt_ordenes`.`id_ordenes`)));
                    
                    
                    -- migracion_prueba.vw_informe_presupuesto source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_informe_presupuesto` AS
                    select
                        `migracion_prueba`.`dt_presupuesto_inicial`.`id_presupuesto_inicial` AS `id_presupuesto_inicial`,
                        `migracion_prueba`.`dt_presupuesto_inicial`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_ordenes`.`referencia` AS `referencia`,
                        `migracion_prueba`.`dt_ordenes`.`item_op` AS `item_op`,
                        `migracion_prueba`.`dt_ordenes`.`localizacion` AS `localizacion`,
                        `migracion_prueba`.`dt_ordenes`.`cantidad` AS `cantidad`,
                        `migracion_prueba`.`dt_macro_proyecto`.`nombre_proyecto` AS `macro_proyecto`,
                        `migracion_prueba`.`dt_proyecto_op`.`nombre_proyecto` AS `nombre_proyecto`,
                        `migracion_prueba`.`dt_ordenes`.`ref_general` AS `nombre_op`,
                        `migracion_prueba`.`dt_fechas_op`.`fecha_ingreso` AS `fecha_ingreso`,
                        (case
                            when ((`migracion_prueba`.`dt_proyecto_op`.`id_proyecto_op` is null)
                            or (((((`migracion_prueba`.`dt_presupuesto_inicial`.`total_materia_prima` + `migracion_prueba`.`dt_presupuesto_inicial`.`total_mano_obra`) + `migracion_prueba`.`dt_presupuesto_inicial`.`total_terceros`) + `migracion_prueba`.`dt_presupuesto_inicial`.`total_viaticos`) + `migracion_prueba`.`dt_presupuesto_inicial`.`total_otros_directos`) <= 0)) then 'Pendiente'
                            else 'OK'
                        end) AS `estado`,
                        `migracion_prueba`.`dt_presupuesto_inicial`.`fecha_creacion` AS `fecha_creacion`,
                        `migracion_prueba`.`dt_presupuesto_inicial`.`total_materia_prima` AS `total_materia_prima`,
                        `migracion_prueba`.`dt_presupuesto_inicial`.`total_mano_obra` AS `total_mano_obra`,
                        `migracion_prueba`.`dt_presupuesto_inicial`.`total_transporte` AS `total_transporte`,
                        `migracion_prueba`.`dt_presupuesto_inicial`.`total_terceros` AS `total_terceros`,
                        `migracion_prueba`.`dt_presupuesto_inicial`.`total_viaticos` AS `total_viaticos`,
                        `migracion_prueba`.`dt_presupuesto_inicial`.`total_otros_directos` AS `total_otros_directos`,
                        `migracion_prueba`.`dt_presupuesto_inicial`.`total_materia_prima_p` AS `total_materia_prima_p`,
                        `migracion_prueba`.`dt_presupuesto_inicial`.`total_mano_obra_p` AS `total_mano_obra_p`,
                        `migracion_prueba`.`dt_presupuesto_inicial`.`total_transporte_p` AS `total_transporte_p`,
                        `migracion_prueba`.`dt_presupuesto_inicial`.`total_terceros_p` AS `total_terceros_p`,
                        `migracion_prueba`.`dt_presupuesto_inicial`.`total_viaticos_p` AS `total_viaticos_p`,
                        `migracion_prueba`.`dt_presupuesto_inicial`.`total_otros_directos_p` AS `total_otros_directos_p`,
                        `migracion_prueba`.`dt_presupuesto_inicial`.`estado` AS `estado_ppto`
                    from
                        ((((`migracion_prueba`.`dt_presupuesto_inicial`
                    left join `migracion_prueba`.`dt_ordenes` on
                        ((`migracion_prueba`.`dt_presupuesto_inicial`.`id_ordenes` = `migracion_prueba`.`dt_ordenes`.`id_ordenes`)))
                    left join `migracion_prueba`.`dt_fechas_op` on
                        ((`migracion_prueba`.`dt_fechas_op`.`id_ordenes` = `migracion_prueba`.`dt_ordenes`.`id_ordenes`)))
                    left join `migracion_prueba`.`dt_proyecto_op` on
                        ((`migracion_prueba`.`dt_proyecto_op`.`id_proyecto_op` = `migracion_prueba`.`dt_ordenes`.`id_proyecto_op`)))
                    left join `migracion_prueba`.`dt_macro_proyecto` on
                        ((`migracion_prueba`.`dt_macro_proyecto`.`id_macro_proyecto` = `migracion_prueba`.`dt_proyecto_op`.`id_macro_proyecto`)));
                    
                    
                    -- migracion_prueba.vw_informe_produccion source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_informe_produccion` AS
                    select
                        `c`.`n_ordenes` AS `OP`,
                        `c`.`cod_material` AS `Codigo Material`,
                        `c`.`nombre_costo` AS `Material`,
                        round(sum(`c`.`cant_sol`), 3) AS `Cantidad Costeada`,
                        sum((case when (`r`.`id_tipo_rotacion` = 25) then `r`.`cantidad` else (`r`.`cantidad` = 0) end)) AS `Entregado_por_Almacen`,
                        sum((case when (`r`.`id_tipo_rotacion` = 26) then `r`.`cantidad` else (`r`.`cantidad` = 0) end)) AS `DescargadoporOP`,
                        (round(sum(`c`.`cant_sol`), 3) - sum((case when (`r`.`id_tipo_rotacion` = 26) then `r`.`cantidad` else (`r`.`cantidad` = 0) end))) AS `Saldo`
                    from
                        (`migracion_prueba`.`dt_costos` `c`
                    left join `migracion_prueba`.`dt_rotacion` `r` on
                        ((`c`.`id_costo` = `r`.`id_costo`)));
                    
                    
                    -- migracion_prueba.vw_informe_produccion3 source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_informe_produccion3` AS
                    select
                        `c`.`n_ordenes` AS `op`,
                        `c`.`cod_material` AS `codigo_material`,
                        `c`.`nombre_costo` AS `Material`,
                        round(sum(`c`.`cant_sol`), 3) AS `cantidad_costeada`,
                        sum((case when (`r`.`id_tipo_rotacion` = 25) then `r`.`cantidad` else (`r`.`cantidad` = 0) end)) AS `entregado_por_almacen`,
                        sum((case when (`r`.`id_tipo_rotacion` = 26) then `r`.`cantidad` else (`r`.`cantidad` = 0) end)) AS `descargado_por_op`,
                        (round(sum(`c`.`cant_sol`), 3) - sum((case when (`r`.`id_tipo_rotacion` = 26) then `r`.`cantidad` else (`r`.`cantidad` = 0) end))) AS `saldo`
                    from
                        (`migracion_prueba`.`dt_costos` `c`
                    left join `migracion_prueba`.`dt_rotacion` `r` on
                        ((`c`.`id_costo` = `r`.`id_costo`)))
                    where
                        (`c`.`id_tipo_costo` = 1)
                    group by
                        `c`.`nombre_costo`;
                    
                    
                    -- migracion_prueba.vw_legalizacion_acabados source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_legalizacion_acabados` AS
                    select
                        `dc`.`id_costo` AS `id_costo`,
                        `do`.`id_cliente` AS `id_cliente`,
                        `cl`.`nom_empresa` AS `cliente`,
                        `mc`.`nombre_proyecto` AS `macro_proyecto`,
                        `dpo`.`id_proyecto_op` AS `id_proyecto_op`,
                        `dpo`.`nombre_proyecto` AS `nombre_proyecto`,
                        `tc`.`tipo` AS `tipo_costo`,
                        `do`.`ref_general` AS `nombre_op`,
                        `do`.`n_ordenes` AS `n_ordenes`,
                        `do`.`estado` AS `estado`,
                        `do`.`id_ordenes` AS `id_ordenes`,
                        `dc`.`nombre_costo` AS `nombre_costo`,
                        `dc`.`id_clase_costo` AS `id_clase_costo`,
                        `dc`.`cant_sol` AS `cant_sol`,
                        `dc`.`id_tipo_costo` AS `id_tipo_costo`,
                        `dc`.`valor_total` AS `valor_total`,
                        `dc`.`comentarios` AS `comentarios`,
                        `dc`.`saldo_compra` AS `saldo_compra`,
                        `dc`.`valor_unit` AS `valor_unit`,
                        `dc`.`vr_unid` AS `vr_unid`,
                        `do`.`item_op` AS `item_op`,
                        `fc`.`fecha_ingreso` AS `fecha_ingreso`,
                        `fc`.`fecha_produccion` AS `fecha_produccion`,
                        `dc`.`cierre` AS `cierre`
                    from
                        ((((((`migracion_prueba`.`dt_costos` `dc`
                    left join `migracion_prueba`.`dt_ordenes` `do` on
                        ((`dc`.`id_ordenes` = `do`.`id_ordenes`)))
                    join `migracion_prueba`.`dt_proyecto_op` `dpo` on
                        ((`do`.`id_proyecto_op` = `dpo`.`id_proyecto_op`)))
                    join `migracion_prueba`.`dt_macro_proyecto` `mc` on
                        ((`dpo`.`id_macro_proyecto` = `mc`.`id_macro_proyecto`)))
                    join `migracion_prueba`.`dt_tipo_costo` `tc` on
                        ((`dc`.`id_tipo_costo` = `tc`.`id_tipo_costo`)))
                    join `migracion_prueba`.`dt_clientes` `cl` on
                        ((`cl`.`id_cliente` = `do`.`id_cliente`)))
                    left join `migracion_prueba`.`dt_fechas_op` `fc` on
                        ((`fc`.`id_ordenes` = `do`.`id_ordenes`)))
                    where
                        ((`dc`.`id_tipo_costo` <> 1)
                            and (`dc`.`saldo_compra` > 0)
                                and (year(`dc`.`fecha_ingreso`) in (2022, 2023, 2024)))
                    group by
                        `dc`.`id_costo`;
                    
                    
                    -- migracion_prueba.vw_materia_prima_area source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_materia_prima_area` AS
                    select
                        `migracion_prueba`.`dt_inventarioxarea`.`codigo_prod` AS `codigo_prod`,
                        `migracion_prueba`.`dt_inventario`.`producto` AS `producto`,
                        `migracion_prueba`.`dt_inventarioxarea`.`stock` AS `stock`,
                        `migracion_prueba`.`dt_inventarioxarea`.`id_area` AS `id_area`,
                        `migracion_prueba`.`dt_area`.`nombre` AS `nombre`
                    from
                        ((`migracion_prueba`.`dt_inventarioxarea`
                    join `migracion_prueba`.`dt_inventario` on
                        ((`migracion_prueba`.`dt_inventarioxarea`.`codigo_prod` = `migracion_prueba`.`dt_inventario`.`codigo_prod`)))
                    join `migracion_prueba`.`dt_area` on
                        ((`migracion_prueba`.`dt_inventarioxarea`.`id_area` = `migracion_prueba`.`dt_area`.`id_area`)));
                    
                    
                    -- migracion_prueba.vw_materiales_item source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_materiales_item` AS
                    select
                        `migracion_prueba`.`dt_ordenes`.`referencia` AS `referencia`,
                        `migracion_prueba`.`dt_ordenes`.`cantidad` AS `cantidad_op`,
                        `migracion_prueba`.`dt_ordenes`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_ordenes`.`item_op` AS `item_op`,
                        `migracion_prueba`.`dt_costos`.`id_ordenes` AS `id_ordenes`,
                        `migracion_prueba`.`dt_costos`.`cod_material` AS `cod_material`,
                        `migracion_prueba`.`dt_costos`.`nombre_costo` AS `nombre_costo`,
                        truncate(sum(`migracion_prueba`.`dt_costos`.`cant_sol`), 2) AS `cantidad`
                    from
                        (`migracion_prueba`.`dt_costos`
                    join `migracion_prueba`.`dt_ordenes` on
                        ((`migracion_prueba`.`dt_costos`.`id_ordenes` = `migracion_prueba`.`dt_ordenes`.`id_ordenes`)))
                    where
                        (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 1)
                    group by
                        `migracion_prueba`.`dt_costos`.`id_ordenes`,
                        `migracion_prueba`.`dt_costos`.`cod_material`
                    order by
                        `migracion_prueba`.`dt_costos`.`id_ordenes`,
                        `migracion_prueba`.`dt_costos`.`nombre_costo`;
                    
                    
                    -- migracion_prueba.vw_materiales_op source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_materiales_op` AS
                    select
                        `migracion_prueba`.`dt_ordenes`.`ref_general` AS `ref_general`,
                        `migracion_prueba`.`dt_costos`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_costos`.`cod_material` AS `cod_material`,
                        `migracion_prueba`.`dt_costos`.`nombre_costo` AS `nombre_costo`,
                        truncate(sum(`migracion_prueba`.`dt_costos`.`cant_sol`), 2) AS `cantidad`
                    from
                        (`migracion_prueba`.`dt_costos`
                    join `migracion_prueba`.`dt_ordenes` on
                        ((`migracion_prueba`.`dt_costos`.`id_ordenes` = `migracion_prueba`.`dt_ordenes`.`id_ordenes`)))
                    where
                        (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 1)
                    group by
                        `migracion_prueba`.`dt_costos`.`cod_material`,
                        `migracion_prueba`.`dt_costos`.`n_ordenes`
                    order by
                        `migracion_prueba`.`dt_costos`.`nombre_costo`;
                    
                    
                    -- migracion_prueba.vw_movimientos_x_mp source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_movimientos_x_mp` AS
                    select
                        `migracion_prueba`.`dt_rotacion`.`cod_prod` AS `cod_prod`,
                        `migracion_prueba`.`dt_rotacion`.`n_rotacion` AS `n_rotacion`,
                        `migracion_prueba`.`dt_compras`.`n_compra` AS `n_compra`,
                        `migracion_prueba`.`dt_rotacion`.`factura_proveedor` AS `factura_proveedor`,
                        `migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` AS `id_tipo_rotacion`,
                        (case
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 1) then 'ENTRADA'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 2) then 'REPOSICION'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 3) then 'SALIDA'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 4) then 'ENTRADA PROPIEDAD CLIENTE'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 5) then 'REPOSICION PROPIEDAD CLIENTE'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 6) then 'SALIDA PROPIEDAD CLIENTE'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 7) then 'TRASLADO X OP AL AREA'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 8) then 'ENTRADA ACTIVO FIJO'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 9) then 'ENTRADA CON OC'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 10) then 'SALIDA ACTIVO FIJO'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 11) then 'BAJAS ACTIVO FIJO'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 12) then 'REPOSICION ACTIVO FIJO'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 13) then 'ORDEN DE SERVICIO'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 14) then 'ENTRADA AJUSTE INVENTARIO'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 15) then 'SALIDA AJUSTE INVENTARIO'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 16) then 'DEVOLUCION MATERIAL OK'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 17) then 'DEVOLUCION MATERIAL DEFECTUOSO'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 19) then 'SALIDA X Nota Cr&eacute;dito'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 20) then 'SALIDA OTRAS BODEGAS'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 21) then 'ENTRADA OTRAS BODEGAS'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 22) then 'ENTRADA X CONVERSION'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 23) then 'SALIDA CONVERSION'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 24) then 'ENTRADA CON OC X CONVERSOR'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 25) then 'ENTRADA X OP AL AREA'
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 26) then 'SALIDA X OP DEL AREA'
                            else 'N/A'
                        end) AS `tipo`,
                        (case
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 1) then 1
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 2) then 1
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 3) then 2
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 4) then 1
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 5) then 1
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 6) then 2
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 7) then 2
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 8) then 1
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 9) then 1
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 10) then 2
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 11) then 2
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 12) then 1
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 13) then 2
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 14) then 1
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 15) then 2
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 16) then 1
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 17) then 2
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 19) then 2
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 20) then 2
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 21) then 1
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 22) then 1
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 23) then 1
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 24) then 2
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 25) then 1
                            when (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` = 26) then 2
                            else '0'
                        end) AS `tipo_en`,
                        `migracion_prueba`.`dt_area`.`nombre` AS `nombre`,
                        `migracion_prueba`.`dt_rotacion`.`fecha` AS `fecha`,
                        `migracion_prueba`.`dt_proveedores`.`empresa` AS `empresa`,
                        `migracion_prueba`.`dt_rotacion`.`n_ordenes` AS `n_ordenes`,
                        '' AS `rm`,
                        `migracion_prueba`.`dt_rotacion`.`cantidad` AS `cantidad`,
                        `migracion_prueba`.`dt_rotacion`.`vr_unidad` AS `vr_unidad`
                    from
                        (((`migracion_prueba`.`dt_rotacion`
                    left join `migracion_prueba`.`dt_compras` on
                        ((`migracion_prueba`.`dt_rotacion`.`id_compra` = `migracion_prueba`.`dt_compras`.`id_compras`)))
                    left join `migracion_prueba`.`dt_proveedores` on
                        ((`migracion_prueba`.`dt_compras`.`id_proveedores` = `migracion_prueba`.`dt_proveedores`.`id_proveedores`)))
                    left join `migracion_prueba`.`dt_area` on
                        ((`migracion_prueba`.`dt_rotacion`.`id_area` = `migracion_prueba`.`dt_area`.`id_area`)))
                    where
                        (`migracion_prueba`.`dt_rotacion`.`id_tipo_rotacion` not in (2, 7))
                    order by
                        `migracion_prueba`.`dt_rotacion`.`fecha` desc,
                        `migracion_prueba`.`dt_rotacion`.`n_rotacion` desc;
                    
                    
                    -- migracion_prueba.vw_new_ops_ter source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_new_ops_ter` AS
                    select
                        `migracion_prueba`.`dt_costos`.`valor_total` AS `valor_total`,
                        `migracion_prueba`.`dt_fechas_op`.`fecha_ingreso` AS `fecha_ingreso`
                    from
                        ((`migracion_prueba`.`dt_ordenes`
                    left join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_costos`.`id_ordenes` = `migracion_prueba`.`dt_ordenes`.`id_ordenes`)))
                    left join `migracion_prueba`.`dt_fechas_op` on
                        ((`migracion_prueba`.`dt_fechas_op`.`id_ordenes` = `migracion_prueba`.`dt_ordenes`.`id_ordenes`)))
                    where
                        (`migracion_prueba`.`dt_costos`.`id_tipo_costo` in (3, 9, 6, 7, 8));
                    
                    
                    -- migracion_prueba.vw_orden_servicio source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_orden_servicio` AS
                    select
                        `migracion_prueba`.`dt_compras`.`n_ordenes` AS `n_ordenes`,
                        sum(`migracion_prueba`.`dt_compras`.`saldo_salida`) AS `cantidad`,
                        `migracion_prueba`.`dt_proveedores`.`empresa` AS `empresa`,
                        `migracion_prueba`.`dt_clientes`.`nom_empresa` AS `nom_empresa`,
                        `migracion_prueba`.`dt_compras`.`consecutivo` AS `consecutivo`,
                        `migracion_prueba`.`dt_ordenes`.`referencia` AS `referencia`,
                        `migracion_prueba`.`dt_compras`.`n_compra` AS `n_compra`,
                        `migracion_prueba`.`dt_area`.`nombre` AS `area_entrega`,
                        `migracion_prueba`.`dt_compras`.`fecha_inicio` AS `fecha_inicio`,
                        `da`.`nombre` AS `area_realiza`,
                        `migracion_prueba`.`dt_compras`.`fecha_compromiso` AS `fecha_compromiso`,
                        `migracion_prueba`.`dt_compras`.`observaciones_os` AS `observaciones_os`,
                        sum(`migracion_prueba`.`dt_compras`.`vr_total`) AS `presupuesto`
                    from
                        (((((`migracion_prueba`.`dt_compras`
                    join `migracion_prueba`.`dt_proveedores` on
                        ((`migracion_prueba`.`dt_proveedores`.`id_proveedores` = `migracion_prueba`.`dt_compras`.`id_proveedores`)))
                    left join `migracion_prueba`.`dt_ordenes` on
                        ((`migracion_prueba`.`dt_ordenes`.`id_ordenes` = `migracion_prueba`.`dt_compras`.`id_ordenes`)))
                    left join `migracion_prueba`.`dt_clientes` on
                        ((`migracion_prueba`.`dt_ordenes`.`id_cliente` = `migracion_prueba`.`dt_clientes`.`id_cliente`)))
                    left join `migracion_prueba`.`dt_area` on
                        ((`migracion_prueba`.`dt_area`.`id_area` = `migracion_prueba`.`dt_compras`.`area_entrega`)))
                    left join `migracion_prueba`.`dt_area` `da` on
                        ((`da`.`id_area` = `migracion_prueba`.`dt_compras`.`area_realiza`)))
                    group by
                        `migracion_prueba`.`dt_compras`.`n_compra`;
                    
                    
                    -- migracion_prueba.vw_ordenes_gb source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_ordenes_gb` AS
                    select
                        `migracion_prueba`.`dt_ordenes`.`n_ordenes` AS `n_ordenes`,
                        concat(`migracion_prueba`.`dt_ordenes`.`n_ordenes`, ' - ', `migracion_prueba`.`dt_ordenes`.`ref_general`) AS `ref_general`
                    from
                        `migracion_prueba`.`dt_ordenes`
                    where
                        (`migracion_prueba`.`dt_ordenes`.`estado` <> 11)
                    group by
                        `migracion_prueba`.`dt_ordenes`.`n_ordenes`
                    order by
                        `migracion_prueba`.`dt_ordenes`.`n_ordenes`;
                    
                    
                    -- migracion_prueba.vw_pen_c_new_ops_ter source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_pen_c_new_ops_ter` AS
                    select
                        `migracion_prueba`.`dt_costos`.`valor_total` AS `valor_total`,
                        `migracion_prueba`.`dt_fechas_op`.`fecha_ingreso` AS `fecha_ingreso`
                    from
                        ((`migracion_prueba`.`dt_ordenes`
                    left join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_costos`.`id_ordenes` = `migracion_prueba`.`dt_ordenes`.`id_ordenes`)))
                    left join `migracion_prueba`.`dt_fechas_op` on
                        ((`migracion_prueba`.`dt_fechas_op`.`id_ordenes` = `migracion_prueba`.`dt_ordenes`.`id_ordenes`)))
                    where
                        ((`migracion_prueba`.`dt_costos`.`id_tipo_costo` in (3, 9, 6, 7, 8))
                            and (`migracion_prueba`.`dt_costos`.`estado` in (1, 4, 7))
                                and (`migracion_prueba`.`dt_costos`.`n_ordenes` <> 0)
                                    and (`migracion_prueba`.`dt_ordenes`.`estado` in (1, 10, 12, 13))
                                        and (`migracion_prueba`.`dt_ordenes`.`conciliado` <> 1)
                                            and (`migracion_prueba`.`dt_costos`.`cant_sol` > 0)
                                                and (`migracion_prueba`.`dt_costos`.`cierre` = 0));
                    
                    
                    -- migracion_prueba.vw_precio_lista_materiales source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_precio_lista_materiales` AS
                    select
                        `migracion_prueba`.`dt_inventario`.`id_inventario` AS `id_inventario`,
                        `migracion_prueba`.`dt_inventario`.`codigo_prod` AS `codigo_prod`,
                        `migracion_prueba`.`dt_inventario`.`producto` AS `producto`,
                        `migracion_prueba`.`dt_inventario`.`valor_unidad_compra` AS `valor_unidad_compra`,
                        `migracion_prueba`.`dt_inventario`.`lista_precio` AS `lista_precio`
                    from
                        `migracion_prueba`.`dt_inventario`
                    where
                        (`migracion_prueba`.`dt_inventario`.`estado` = 1)
                    order by
                        `migracion_prueba`.`dt_inventario`.`producto`;
                    
                    
                    -- migracion_prueba.vw_presupuesto_programada source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_presupuesto_programada` AS
                    select
                        `c`.`id_ordenes` AS `id_ordenes`,
                        `c`.`id_tipo_costo` AS `id_tipo_costo`,
                        sum(`c`.`valor_total`) AS `valor_total`
                    from
                        (`migracion_prueba`.`dt_tareas_costo` `tc`
                    join `migracion_prueba`.`dt_costos` `c` on
                        ((`tc`.`id_costos` = `c`.`id_costos`)))
                    group by
                        `tc`.`id_ordenes`;
                    
                    
                    -- migracion_prueba.vw_programacion_diseno source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_programacion_diseno` AS
                    select
                        `migracion_prueba`.`dt_programacion_diseno`.`id_codprodfinal` AS `id_codprodfinal`,
                        `migracion_prueba`.`dt_programacion_diseno`.`id_programacion_diseno` AS `id_programacion_diseno`,
                        `migracion_prueba`.`dt_programacion_diseno`.`cod` AS `cod`,
                        `migracion_prueba`.`dt_programacion_diseno`.`n_programacion` AS `n_programacion`,
                        `migracion_prueba`.`dt_ordenes`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_ordenes`.`item_op` AS `item_op`,
                        `migracion_prueba`.`dt_ordenes`.`nombre_proyecto` AS `nombre_proyecto`,
                        `migracion_prueba`.`dt_historico_diseno`.`tipo` AS `tipo`,
                        `migracion_prueba`.`dt_historico_diseno`.`fecha_registro` AS `fecha_registro`,
                        `migracion_prueba`.`dt_historico_diseno`.`observacion` AS `observacion`,
                        `migracion_prueba`.`user`.`nombre_usuario` AS `nombre_usuario`,
                        `migracion_prueba`.`dt_historico_diseno`.`id_historico_diseno` AS `id_historico_diseno`
                    from
                        ((((`migracion_prueba`.`dt_programacion_diseno`
                    left join `migracion_prueba`.`dt_historico_diseno` on
                        ((`migracion_prueba`.`dt_historico_diseno`.`id_programacion_diseno` = `migracion_prueba`.`dt_programacion_diseno`.`id_programacion_diseno`)))
                    left join `migracion_prueba`.`dt_programacion_diseno_dt_ordenes` on
                        ((`migracion_prueba`.`dt_programacion_diseno`.`id_programacion_diseno` = `migracion_prueba`.`dt_programacion_diseno_dt_ordenes`.`id_programacion_diseno`)))
                    left join `migracion_prueba`.`dt_ordenes` on
                        ((`migracion_prueba`.`dt_ordenes`.`id_ordenes` = `migracion_prueba`.`dt_programacion_diseno_dt_ordenes`.`dt_ordenes_id_ordenes`)))
                    left join `migracion_prueba`.`user` on
                        ((`migracion_prueba`.`dt_historico_diseno`.`id_user` = `migracion_prueba`.`user`.`id`)))
                    where
                        (`migracion_prueba`.`dt_programacion_diseno`.`estado` = 1);
                    
                    
                    -- migracion_prueba.vw_proveedores source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_proveedores` AS
                    select
                        `migracion_prueba`.`dt_proveedores`.`nit` AS `nit`,
                        `migracion_prueba`.`dt_proveedores`.`id_proveedores` AS `id_proveedores`,
                        `migracion_prueba`.`dt_proveedores`.`empresa` AS `empresa`
                    from
                        `migracion_prueba`.`dt_proveedores`
                    order by
                        `migracion_prueba`.`dt_proveedores`.`empresa`;
                    
                    
                    -- migracion_prueba.vw_proyectos_clientes source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_proyectos_clientes` AS
                    select
                        `g`.`nombre` AS `nombre_ciudad`,
                        `u`.`nombre_usuario` AS `nombre_usuario`,
                        `mp`.`nombre_proyecto` AS `nombre_macro_proyecto`,
                        `p`.`id_proyecto_op` AS `id_proyecto_op`,
                        `p`.`nombre_proyecto` AS `nombre_proyecto`,
                        `p`.`fecha` AS `fecha`,
                        `p`.`estado` AS `estado`,
                        `p`.`obs_proyecto` AS `obs_proyecto`,
                        `p`.`id_user` AS `id_user`,
                        `p`.`id_macro_proyecto` AS `id_macro_proyecto`,
                        `c`.`nom_empresa` AS `nom_empresa`
                    from
                        ((((`migracion_prueba`.`dt_proyecto_op` `p`
                    left join `migracion_prueba`.`dt_macro_proyecto` `mp` on
                        ((`p`.`id_macro_proyecto` = `mp`.`id_macro_proyecto`)))
                    left join `migracion_prueba`.`dt_clientes` `c` on
                        ((`mp`.`id_cliente` = `c`.`id_cliente`)))
                    left join `migracion_prueba`.`user` `u` on
                        ((`p`.`id_user` = `u`.`id`)))
                    left join `migracion_prueba`.`dt_geografia` `g` on
                        ((`p`.`id_geografia` = `g`.`id_geografia`)));
                    
                    
                    -- migracion_prueba.vw_prueba_home source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_prueba_home` AS
                    select
                        `migracion_prueba`.`dt_factura`.`id_factura` AS `id_factura`,
                        `migracion_prueba`.`dt_factura`.`n_factura` AS `n_factura`,
                        `migracion_prueba`.`dt_factura`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_factura`.`id_usuario` AS `id_usuario`,
                        `migracion_prueba`.`dt_factura`.`id_usuario_act` AS `id_usuario_act`,
                        `migracion_prueba`.`dt_factura`.`id_vendedor` AS `id_vendedor`,
                        `migracion_prueba`.`dt_factura`.`id_cliente` AS `id_cliente`,
                        `migracion_prueba`.`dt_factura`.`valor_venta` AS `valor_venta`,
                        `migracion_prueba`.`dt_factura`.`valor` AS `valor`,
                        `migracion_prueba`.`dt_factura`.`fecha_creacion` AS `fecha_creacion`,
                        `migracion_prueba`.`dt_factura`.`fecha_actualizacion` AS `fecha_actualizacion`,
                        `migracion_prueba`.`dt_factura`.`fecha_factura` AS `fecha_factura`,
                        `migracion_prueba`.`dt_factura`.`fecha_vencimiento` AS `fecha_vencimiento`,
                        `migracion_prueba`.`dt_factura`.`fecha_recaudo` AS `fecha_recaudo`,
                        `migracion_prueba`.`dt_factura`.`cotizacion` AS `cotizacion`,
                        `migracion_prueba`.`dt_factura`.`id_forma_pago` AS `id_forma_pago`,
                        `migracion_prueba`.`dt_factura`.`concepto` AS `concepto`,
                        `migracion_prueba`.`dt_factura`.`estado` AS `estado`,
                        `migracion_prueba`.`dt_factura`.`plazo` AS `plazo`,
                        `migracion_prueba`.`dt_factura`.`iva` AS `iva`,
                        `migracion_prueba`.`dt_factura`.`r_fuente` AS `r_fuente`,
                        `migracion_prueba`.`dt_factura`.`r_iva` AS `r_iva`,
                        `migracion_prueba`.`dt_factura`.`r_ica` AS `r_ica`,
                        `migracion_prueba`.`dt_factura`.`nota_credito` AS `nota_credito`,
                        `migracion_prueba`.`dt_factura`.`puc_cuenta` AS `puc_cuenta`,
                        `migracion_prueba`.`dt_factura`.`cta_iva` AS `cta_iva`,
                        `migracion_prueba`.`dt_factura`.`cta_rfte` AS `cta_rfte`,
                        `migracion_prueba`.`dt_factura`.`cta_rtiva` AS `cta_rtiva`,
                        `migracion_prueba`.`dt_factura`.`cta_rtica` AS `cta_rtica`,
                        `migracion_prueba`.`dt_factura`.`comision` AS `comision`,
                        `migracion_prueba`.`dt_factura`.`anticipo` AS `anticipo`,
                        `migracion_prueba`.`dt_factura`.`cta_anticipo` AS `cta_anticipo`,
                        `migracion_prueba`.`dt_factura`.`rc_anticipo` AS `rc_anticipo`,
                        `migracion_prueba`.`dt_factura`.`contacto_factura` AS `contacto_factura`,
                        `migracion_prueba`.`dt_factura`.`aplica_vt` AS `aplica_vt`,
                        `migracion_prueba`.`dt_factura`.`estado_traza` AS `estado_traza`,
                        `migracion_prueba`.`dt_factura`.`ano_indicador` AS `ano_indicador`,
                        `migracion_prueba`.`dt_factura`.`estado_an` AS `estado_an`,
                        `migracion_prueba`.`dt_factura`.`observaciones` AS `observaciones`,
                        `migracion_prueba`.`dt_factura`.`items` AS `items`,
                        `migracion_prueba`.`dt_factura`.`valor_bruto` AS `valor_bruto`,
                        `migracion_prueba`.`dt_factura`.`orden_compra` AS `orden_compra`,
                        `migracion_prueba`.`dt_factura`.`cantidad` AS `cantidad`,
                        `migracion_prueba`.`dt_factura`.`codigo` AS `codigo`,
                        `migracion_prueba`.`dt_factura`.`referencia` AS `referencia`,
                        `migracion_prueba`.`dt_factura`.`id_codigo_categoria` AS `id_codigo_categoria`,
                        `migracion_prueba`.`dt_factura`.`vr_unidad` AS `vr_unidad`,
                        `migracion_prueba`.`dt_factura`.`descuento` AS `descuento`,
                        `migracion_prueba`.`dt_factura`.`vr_total` AS `vr_total`,
                        `migracion_prueba`.`dt_factura`.`id_puc_oc` AS `id_puc_oc`,
                        `migracion_prueba`.`dt_factura`.`abonos` AS `abonos`,
                        `migracion_prueba`.`dt_factura`.`saldo` AS `saldo`,
                        `migracion_prueba`.`dt_factura`.`letra` AS `letra`,
                        `migracion_prueba`.`dt_factura`.`letra_cta` AS `letra_cta`,
                        `migracion_prueba`.`dt_factura`.`puc_contra` AS `puc_contra`,
                        `migracion_prueba`.`dt_factura`.`anuladas` AS `anuladas`,
                        `migracion_prueba`.`dt_factura`.`id_remision` AS `id_remision`,
                        `migracion_prueba`.`dt_factura`.`nit` AS `nit`
                    from
                        `migracion_prueba`.`dt_factura`
                    where
                        ((month(`migracion_prueba`.`dt_factura`.`fecha_factura`) = '06')
                            and (year(`migracion_prueba`.`dt_factura`.`fecha_factura`) = '2021'))
                    group by
                        `migracion_prueba`.`dt_factura`.`n_factura`
                    order by
                        `migracion_prueba`.`dt_factura`.`n_factura`;
                    
                    
                    -- migracion_prueba.vw_referencias_proveedor source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_referencias_proveedor` AS
                    select
                        `migracion_prueba`.`dt_proveedores`.`empresa` AS `empresa`,
                        `migracion_prueba`.`dt_proveeref`.`id_proveeref` AS `id_proveeref`,
                        `migracion_prueba`.`dt_proveeref`.`id_proveedores` AS `id_proveedores`,
                        `migracion_prueba`.`dt_inventario`.`id_inventario` AS `id_inventario`,
                        `migracion_prueba`.`dt_inventario`.`producto` AS `producto`,
                        `migracion_prueba`.`dt_inventario`.`codigo_prod` AS `codigo_prod`,
                        `migracion_prueba`.`dt_proveeref`.`ref_color` AS `ref_color`,
                        `migracion_prueba`.`dt_proveeref`.`cod_color` AS `cod_color`
                    from
                        ((`migracion_prueba`.`dt_proveeref`
                    left join `migracion_prueba`.`dt_proveedores` on
                        ((`migracion_prueba`.`dt_proveeref`.`id_proveedores` = `migracion_prueba`.`dt_proveedores`.`id_proveedores`)))
                    left join `migracion_prueba`.`dt_inventario` on
                        ((`migracion_prueba`.`dt_proveeref`.`id_inventario` = `migracion_prueba`.`dt_inventario`.`id_inventario`)));
                    
                    
                    -- migracion_prueba.vw_rotacion_materiales source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_rotacion_materiales` AS
                    select
                        `dc`.`id_costo` AS `id_costo`,
                        `dc`.`id_ordenes` AS `id_ordenes`,
                        `dc`.`n_ordenes` AS `n_ordenes`,
                        `dc`.`cod_material` AS `cod_material`,
                        `dc`.`comentarios` AS `comentarios`,
                        `dc`.`nombre_costo` AS `nombre_costo`,
                        `di`.`stock` AS `stock`,
                        `dc`.`cant_sol` AS `cant_sol`,
                        round(sum((case when (`dr`.`id_tipo_rotacion` = 9) then `dr`.`cantidad` else (`dr`.`cantidad` = 0) end)), 2) AS `cantidad_entradas`,
                        round(sum((case when ((`dr`.`id_tipo_rotacion` = 25) and (`dr`.`estado` = 7)) then `dr`.`cantidad` else (`dr`.`cantidad` = 0) end)), 2) AS `traslado_a_producción_sin_aceptar`,
                        round(sum((case when ((`dr`.`id_tipo_rotacion` = 25) and (`dr`.`estado` = 1)) then `dr`.`cantidad` else (`dr`.`cantidad` = 0) end)), 2) AS `traslado_a_producción_aceptado`,
                        round(sum((case when ((`dr`.`id_tipo_rotacion` = 26) and (`dr`.`estado` = 1)) then `dr`.`cantidad` else (`dr`.`cantidad` = 0) end)), 2) AS `salidas_de_producción`
                    from
                        ((`migracion_prueba`.`dt_costos` `dc`
                    left join `migracion_prueba`.`dt_inventarioxarea` `di` on
                        (((`dc`.`id_inventario` = `di`.`id_inventario`)
                            and (`di`.`id_area` = 12))))
                    left join `migracion_prueba`.`dt_rotacion` `dr` on
                        (((`dc`.`id_costo` = `dr`.`id_costo`)
                            and (`dr`.`id_tipo_rotacion` in (9, 25, 26))
                                and (`dr`.`estado` <> 2))))
                    where
                        (`dc`.`id_tipo_costo` = 1)
                    group by
                        `dc`.`id_costo`
                    order by
                        `dc`.`id_ordenes`,
                        `dc`.`nombre_costo`;
                    
                    
                    -- migracion_prueba.vw_salidas_sin_op source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_salidas_sin_op` AS
                    select
                        `ia`.`id_inventarioxarea` AS `id_inventarioxarea`,
                        `ia`.`stock` AS `stock`,
                        `ia`.`codigo_prod` AS `codigo_prod`,
                        `i`.`producto` AS `producto`,
                        `m`.`medida` AS `medida`,
                        `i`.`id_inventario` AS `id_inventario`,
                        `ia`.`id_area` AS `id_area`,
                        `a`.`nombre` AS `nombre`,
                        concat_ws(' - ', convert(`ia`.`codigo_prod` using utf8mb3), `i`.`producto`) AS `nombre_y_codigo`
                    from
                        (((`migracion_prueba`.`dt_inventarioxarea` `ia`
                    join `migracion_prueba`.`dt_inventario` `i` on
                        ((`ia`.`id_inventario` = `i`.`id_inventario`)))
                    join `migracion_prueba`.`dt_medida` `m` on
                        ((`m`.`id_medida` = `i`.`id_medida`)))
                    join `migracion_prueba`.`dt_area` `a` on
                        ((`ia`.`id_area` = `a`.`id_area`)))
                    where
                        (`ia`.`stock` > 0);
                    
                    
                    -- migracion_prueba.vw_sub_compras source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_sub_compras` AS
                    select
                        `migracion_prueba`.`dt_compras`.`id_ordenes` AS `id_ordenes`,
                        (case
                            when (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 1) then `migracion_prueba`.`dt_compras`.`vr_total`
                            else 0
                        end) AS `compras_mp`,
                        (case
                            when (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 4) then `migracion_prueba`.`dt_compras`.`vr_total`
                            else 0
                        end) AS `compras_mo`,
                        (case
                            when (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 5) then `migracion_prueba`.`dt_compras`.`vr_total`
                            else 0
                        end) AS `compras_trans`,
                        (case
                            when (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 8) then `migracion_prueba`.`dt_compras`.`vr_total`
                            else 0
                        end) AS `compras_ter`,
                        (case
                            when ((`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 6)
                            or (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 7)) then `migracion_prueba`.`dt_compras`.`vr_total`
                            else 0
                        end) AS `compras_otros`,
                        (case
                            when (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 9) then `migracion_prueba`.`dt_compras`.`vr_total`
                            else 0
                        end) AS `compras_via`,
                        `migracion_prueba`.`dt_costos`.`id_tipo_costo` AS `id_tipo_costo`,
                        `migracion_prueba`.`dt_compras`.`n_ordenes` AS `n_ordenes`
                    from
                        (`migracion_prueba`.`dt_compras`
                    left join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_compras`.`id_costos` = `migracion_prueba`.`dt_costos`.`id_costo`)));
                    
                    
                    -- migracion_prueba.vw_sub_existencia_area source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_sub_existencia_area` AS
                    select
                        `migracion_prueba`.`dt_inventarioxarea`.`id_inventarioxarea` AS `id_inventarioxarea`,
                        `migracion_prueba`.`dt_inventarioxarea`.`codigo_prod` AS `codigo_prod`,
                        `migracion_prueba`.`dt_inventarioxarea`.`id_inventario` AS `id_inventario`,
                        `migracion_prueba`.`dt_inventario`.`producto` AS `producto`,
                        `migracion_prueba`.`dt_area`.`id_area` AS `id_area`,
                        `migracion_prueba`.`dt_area`.`nombre` AS `nombre`,
                        `migracion_prueba`.`dt_inventarioxarea`.`stock` AS `stock`,
                        `migracion_prueba`.`dt_inventario`.`valor_unidad` AS `valor_unidad`,
                        (`migracion_prueba`.`dt_inventarioxarea`.`stock` * `migracion_prueba`.`dt_inventario`.`valor_unidad`) AS `valor_total`,
                        (case
                            `migracion_prueba`.`dt_inventarioxarea`.`id_area` when '7' then `migracion_prueba`.`dt_inventarioxarea`.`stock`
                            else '0'
                        end) AS `stock_instalacion`,
                        (case
                            `migracion_prueba`.`dt_inventarioxarea`.`id_area` when '7' then (`migracion_prueba`.`dt_inventario`.`valor_unidad` * `migracion_prueba`.`dt_inventarioxarea`.`stock`)
                            else '0'
                        end) AS `valor_instalacion`,
                        (case
                            `migracion_prueba`.`dt_inventarioxarea`.`id_area` when '12' then `migracion_prueba`.`dt_inventarioxarea`.`stock`
                            else '0'
                        end) AS `stock_almacen`,
                        (case
                            `migracion_prueba`.`dt_inventarioxarea`.`id_area` when '12' then (`migracion_prueba`.`dt_inventario`.`valor_unidad` * `migracion_prueba`.`dt_inventarioxarea`.`stock`)
                            else '0'
                        end) AS `valor_almacen`,
                        (case
                            `migracion_prueba`.`dt_inventarioxarea`.`id_area` when '13' then `migracion_prueba`.`dt_inventarioxarea`.`stock`
                            else '0'
                        end) AS `stock_metalmecanica`,
                        (case
                            `migracion_prueba`.`dt_inventarioxarea`.`id_area` when '13' then (`migracion_prueba`.`dt_inventario`.`valor_unidad` * `migracion_prueba`.`dt_inventarioxarea`.`stock`)
                            else '0'
                        end) AS `valor_metalmecanica`,
                        (case
                            `migracion_prueba`.`dt_inventarioxarea`.`id_area` when '14' then `migracion_prueba`.`dt_inventarioxarea`.`stock`
                            else '0'
                        end) AS `stock_pintura`,
                        (case
                            `migracion_prueba`.`dt_inventarioxarea`.`id_area` when '14' then (`migracion_prueba`.`dt_inventario`.`valor_unidad` * `migracion_prueba`.`dt_inventarioxarea`.`stock`)
                            else '0'
                        end) AS `valor_pintura`,
                        (case
                            `migracion_prueba`.`dt_inventarioxarea`.`id_area` when '15' then `migracion_prueba`.`dt_inventarioxarea`.`stock`
                            else '0'
                        end) AS `stock_sustratos`,
                        (case
                            `migracion_prueba`.`dt_inventarioxarea`.`id_area` when '15' then (`migracion_prueba`.`dt_inventario`.`valor_unidad` * `migracion_prueba`.`dt_inventarioxarea`.`stock`)
                            else '0'
                        end) AS `valor_sustratos`,
                        (case
                            `migracion_prueba`.`dt_inventarioxarea`.`id_area` when '16' then `migracion_prueba`.`dt_inventarioxarea`.`stock`
                            else '0'
                        end) AS `stock_ensamble`,
                        (case
                            `migracion_prueba`.`dt_inventarioxarea`.`id_area` when '16' then (`migracion_prueba`.`dt_inventario`.`valor_unidad` * `migracion_prueba`.`dt_inventarioxarea`.`stock`)
                            else '0'
                        end) AS `valor_ensamble`,
                        (case
                            `migracion_prueba`.`dt_inventarioxarea`.`id_area` when '17' then `migracion_prueba`.`dt_inventarioxarea`.`stock`
                            else '0'
                        end) AS `stock_impresion`,
                        (case
                            `migracion_prueba`.`dt_inventarioxarea`.`id_area` when '17' then (`migracion_prueba`.`dt_inventario`.`valor_unidad` * `migracion_prueba`.`dt_inventarioxarea`.`stock`)
                            else '0'
                        end) AS `valor_impresion`,
                        (case
                            `migracion_prueba`.`dt_inventarioxarea`.`id_area` when '18' then `migracion_prueba`.`dt_inventarioxarea`.`stock`
                            else '0'
                        end) AS `stock_decoracion`,
                        (case
                            `migracion_prueba`.`dt_inventarioxarea`.`id_area` when '18' then (`migracion_prueba`.`dt_inventario`.`valor_unidad` * `migracion_prueba`.`dt_inventarioxarea`.`stock`)
                            else '0'
                        end) AS `valor_decoracion`,
                        (case
                            `migracion_prueba`.`dt_inventarioxarea`.`id_area` when '19' then `migracion_prueba`.`dt_inventarioxarea`.`stock`
                            else '0'
                        end) AS `stock_despachos`,
                        (case
                            `migracion_prueba`.`dt_inventarioxarea`.`id_area` when '19' then (`migracion_prueba`.`dt_inventario`.`valor_unidad` * `migracion_prueba`.`dt_inventarioxarea`.`stock`)
                            else '0'
                        end) AS `valor_despachos`
                    from
                        ((`migracion_prueba`.`dt_inventarioxarea`
                    left join `migracion_prueba`.`dt_inventario` on
                        ((`migracion_prueba`.`dt_inventarioxarea`.`id_inventario` = `migracion_prueba`.`dt_inventario`.`id_inventario`)))
                    left join `migracion_prueba`.`dt_area` on
                        ((`migracion_prueba`.`dt_area`.`id_area` = `migracion_prueba`.`dt_inventarioxarea`.`id_area`)))
                    where
                        (`migracion_prueba`.`dt_inventarioxarea`.`id_area` in (10, 12, 18, 19, 16, 17, 7, 13, 14, 15))
                    order by
                        `migracion_prueba`.`dt_inventario`.`producto`,
                        `migracion_prueba`.`dt_area`.`nombre`;
                    
                    
                    -- migracion_prueba.vw_sub_informe_pedidos source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_sub_informe_pedidos` AS
                    select
                        `migracion_prueba`.`dt_ordenes`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_fechas_op`.`fecha_ingreso` AS `fecha_ingreso`,
                        `migracion_prueba`.`dt_clientes`.`nom_empresa` AS `nom_empresa`,
                        `migracion_prueba`.`dt_macro_proyecto`.`nombre_proyecto` AS `macro_proyecto`,
                        `migracion_prueba`.`dt_proyecto_op`.`nombre_proyecto` AS `nombre_proyecto`,
                        `migracion_prueba`.`dt_ordenes`.`nombre_proyecto` AS `nombre_op`,
                        concat(`migracion_prueba`.`dt_usuarios`.`nombre_usuario`, ' ', `migracion_prueba`.`dt_usuarios`.`apellido_usuario`) AS `nombre_usuario`,
                        `migracion_prueba`.`dt_ordenes`.`cantidad` AS `cantidad`,
                        `migracion_prueba`.`dt_subcategoria`.`nombre_subcategoria` AS `nombre_subcategoria`,
                        (case
                            when (`migracion_prueba`.`dt_ordenes`.`cobro` = 1) then `migracion_prueba`.`dt_ordenes`.`v_total`
                            else 0
                        end) AS `vCobro`,
                        (case
                            when (`migracion_prueba`.`dt_ordenes`.`cobro` = 0) then `migracion_prueba`.`dt_ordenes`.`v_total`
                            else 0
                        end) AS `vnoCobro`,
                        `migracion_prueba`.`dt_ordenes`.`v_total` AS `v_total`
                    from
                        (((((((`migracion_prueba`.`dt_ordenes`
                    join `migracion_prueba`.`dt_clientes` on
                        ((`migracion_prueba`.`dt_clientes`.`id_cliente` = `migracion_prueba`.`dt_ordenes`.`id_cliente`)))
                    left join `migracion_prueba`.`dt_fechas_op` on
                        ((`migracion_prueba`.`dt_ordenes`.`id_ordenes` = `migracion_prueba`.`dt_fechas_op`.`id_ordenes`)))
                    left join `migracion_prueba`.`dt_proyecto_op` on
                        ((`migracion_prueba`.`dt_proyecto_op`.`id_proyecto_op` = `migracion_prueba`.`dt_ordenes`.`id_proyecto_op`)))
                    left join `migracion_prueba`.`dt_macro_proyecto` on
                        ((`migracion_prueba`.`dt_macro_proyecto`.`id_macro_proyecto` = `migracion_prueba`.`dt_proyecto_op`.`id_macro_proyecto`)))
                    left join `migracion_prueba`.`user` on
                        ((`migracion_prueba`.`dt_ordenes`.`id_coordinador` = `migracion_prueba`.`user`.`id`)))
                    left join `migracion_prueba`.`dt_usuarios` on
                        ((`migracion_prueba`.`dt_usuarios`.`id_usuario` = `migracion_prueba`.`user`.`id_empleado`)))
                    left join `migracion_prueba`.`dt_subcategoria` on
                        ((`migracion_prueba`.`dt_ordenes`.`id_subcategoria` = `migracion_prueba`.`dt_subcategoria`.`id_subcategoria`)));
                    
                    
                    -- migracion_prueba.vw_sub_tareas source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_sub_tareas` AS
                    select
                        `migracion_prueba`.`dt_costos`.`id_ordenes` AS `id_ordenes`,
                        `migracion_prueba`.`dt_costos`.`valor_total` AS `valor_programado`
                    from
                        ((`migracion_prueba`.`dt_tareas_costo`
                    left join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_tareas_costo`.`id_costo` = `migracion_prueba`.`dt_costos`.`id_costo`)))
                    left join `migracion_prueba`.`dt_compras` on
                        ((`migracion_prueba`.`dt_tareas_costo`.`id_costo` = `migracion_prueba`.`dt_compras`.`id_costos`)))
                    where
                        (`migracion_prueba`.`dt_compras`.`id_compras` is null);
                    
                    
                    -- migracion_prueba.vw_tareas_agenda1 source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_tareas_agenda1` AS
                    select
                        `a`.`nombre` AS `nombre_area`,
                        `u`.`nombre_usuario` AS `nombre_vendedor`,
                        `o`.`referencia` AS `referencia`,
                        `o`.`cod` AS `cod`,
                        `t`.`id_tarea_costo` AS `id_tarea_costo`,
                        `t`.`id_vendedor` AS `id_vendedor`,
                        `t`.`id_usuario` AS `id_usuario`,
                        `t`.`id_costo` AS `id_costo`,
                        `t`.`n_ordenes` AS `n_ordenes`,
                        `t`.`id_ordenes` AS `id_ordenes`,
                        `t`.`can_horas` AS `can_horas`,
                        `t`.`fecha_inicio` AS `fecha_inicio`,
                        `t`.`cod_material` AS `cod_material`,
                        `t`.`nombre_costo` AS `nombre_costo`,
                        `t`.`id_area` AS `id_area`,
                        `t`.`recurso` AS `recurso`,
                        `t`.`fecha_inicio_real` AS `fecha_inicio_real`,
                        `t`.`fecha_final` AS `fecha_final`,
                        `t`.`observaciones` AS `observaciones`,
                        `t`.`fecha_pro` AS `fecha_pro`,
                        `t`.`fecha_retro` AS `fecha_retro`,
                        `t`.`id_costos` AS `id_costos`,
                        `t`.`id_tareas` AS `id_tareas`,
                        `t`.`id_orden` AS `id_orden`
                    from
                        (((`migracion_prueba`.`dt_tareas_costo` `t`
                    join `migracion_prueba`.`dt_area` `a` on
                        ((`t`.`id_area` = `a`.`id_area`)))
                    join `migracion_prueba`.`user` `u` on
                        ((`t`.`id_vendedor` = `u`.`id`)))
                    join `migracion_prueba`.`dt_ordenes` `o` on
                        ((`t`.`id_ordenes` = `o`.`id_ordenes`)));
                    
                    
                    -- migracion_prueba.vw_terceros_home source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_terceros_home` AS
                    select
                        distinct `migracion_prueba`.`dt_costos`.`id_costo` AS `id_costo`,
                        `migracion_prueba`.`dt_clientes`.`nom_empresa` AS `cliente`,
                        `migracion_prueba`.`dt_macro_proyecto`.`nombre_proyecto` AS `macro_proyecto`,
                        `migracion_prueba`.`dt_proyecto_op`.`nombre_proyecto` AS `nombre_proyecto`,
                        `migracion_prueba`.`dt_ordenes`.`ref_general` AS `nombre_op`,
                        `migracion_prueba`.`dt_costos`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_costos`.`id_ordenes` AS `id_ordenes`,
                        `migracion_prueba`.`dt_costos`.`nombre_costo` AS `nombre_costo`,
                        `migracion_prueba`.`dt_costos`.`cant_sol` AS `cant_sol`,
                        `migracion_prueba`.`dt_costos`.`id_clase_costo` AS `id_clase_costo`,
                        `migracion_prueba`.`dt_tipo_costo`.`tipo` AS `tipo_costo`,
                        `migracion_prueba`.`dt_costos`.`id_tipo_costo` AS `id_tipo_costo`,
                        `migracion_prueba`.`dt_costos`.`valor_total` AS `valor_total`,
                        `migracion_prueba`.`dt_costos`.`comentarios` AS `comentarios`,
                        `migracion_prueba`.`dt_fechas_op`.`fecha_ingreso` AS `fecha_real`,
                        `migracion_prueba`.`dt_costos`.`saldo_compra` AS `saldo_compra`,
                        `migracion_prueba`.`dt_costos`.`vr_unid` AS `vr_unid`,
                        `migracion_prueba`.`dt_costos`.`valor_unit` AS `valor_unit`,
                        `migracion_prueba`.`dt_costos`.`estado` AS `estado`,
                        `migracion_prueba`.`dt_ordenes`.`cod` AS `cod`,
                        `migracion_prueba`.`dt_ordenes`.`item_op` AS `item_op`,
                        `migracion_prueba`.`dt_fechas_op`.`fecha_ingreso` AS `fecha_ingreso`,
                        `migracion_prueba`.`dt_fechas_op`.`fecha_produccion` AS `fecha_produccion`
                    from
                        ((((((`migracion_prueba`.`dt_costos`
                    join `migracion_prueba`.`dt_ordenes` on
                        ((`migracion_prueba`.`dt_ordenes`.`id_ordenes` = `migracion_prueba`.`dt_costos`.`id_ordenes`)))
                    join `migracion_prueba`.`dt_proyecto_op` on
                        ((`migracion_prueba`.`dt_ordenes`.`id_proyecto_op` = `migracion_prueba`.`dt_proyecto_op`.`id_proyecto_op`)))
                    join `migracion_prueba`.`dt_macro_proyecto` on
                        ((`migracion_prueba`.`dt_proyecto_op`.`id_macro_proyecto` = `migracion_prueba`.`dt_macro_proyecto`.`id_macro_proyecto`)))
                    join `migracion_prueba`.`dt_clientes` on
                        ((`migracion_prueba`.`dt_macro_proyecto`.`id_cliente` = `migracion_prueba`.`dt_clientes`.`id_cliente`)))
                    join `migracion_prueba`.`dt_tipo_costo` on
                        ((`migracion_prueba`.`dt_tipo_costo`.`id_tipo_costo` = `migracion_prueba`.`dt_costos`.`id_tipo_costo`)))
                    left join `migracion_prueba`.`dt_fechas_op` on
                        ((`migracion_prueba`.`dt_fechas_op`.`id_ordenes` = `migracion_prueba`.`dt_ordenes`.`id_ordenes`)))
                    where
                        ((`migracion_prueba`.`dt_costos`.`cierre` = 0)
                            and (`migracion_prueba`.`dt_costos`.`id_tipo_costo` in (8, 9, 5, 6, 3, 7))
                                and (`migracion_prueba`.`dt_costos`.`estado` in (1, 8, 4))
                                    and (`migracion_prueba`.`dt_ordenes`.`estado` in (1, 10, 12, 13)))
                    group by
                        `migracion_prueba`.`dt_costos`.`id_costo`,
                        `migracion_prueba`.`dt_fechas_op`.`id_ordenes`
                    order by
                        `migracion_prueba`.`dt_costos`.`id_costo` desc;
                    
                    
                    -- migracion_prueba.vw_total_compra_mp source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_total_compra_mp` AS
                    select
                        sum(`migracion_prueba`.`dt_compras`.`vr_total`) AS `vr_total`,
                        `migracion_prueba`.`dt_compras`.`fecha_oc` AS `fecha_oc`
                    from
                        ((`migracion_prueba`.`dt_compras`
                    join `migracion_prueba`.`dt_proveedores` on
                        ((`migracion_prueba`.`dt_compras`.`id_proveedores` = `migracion_prueba`.`dt_proveedores`.`id_proveedores`)))
                    left join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_compras`.`id_costos` = `migracion_prueba`.`dt_costos`.`id_costo`)))
                    where
                        ((`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 1)
                            and (`migracion_prueba`.`dt_compras`.`id_proveedores` <> 750));
                    
                    
                    -- migracion_prueba.vw_total_ops_new source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_total_ops_new` AS
                    select
                        `migracion_prueba`.`dt_costos`.`valor_total` AS `total`,
                        cast(`migracion_prueba`.`dt_fechas_op`.`fecha_ingreso` as date) AS `fecha_ingreso`
                    from
                        ((`migracion_prueba`.`dt_ordenes`
                    join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_ordenes`.`id_ordenes` = `migracion_prueba`.`dt_costos`.`id_ordenes`)))
                    left join `migracion_prueba`.`dt_fechas_op` on
                        ((`migracion_prueba`.`dt_ordenes`.`id_ordenes` = `migracion_prueba`.`dt_fechas_op`.`id_ordenes`)))
                    where
                        (`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 1)
                    order by
                        `migracion_prueba`.`dt_fechas_op`.`fecha_ingreso` desc;
                    
                    
                    -- migracion_prueba.vw_total_ops_pen_c source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_total_ops_pen_c` AS
                    select
                        `migracion_prueba`.`dt_costos`.`valor_total` AS `total`,
                        cast(`migracion_prueba`.`dt_fechas_op`.`fecha_ingreso` as date) AS `fecha_ingreso`
                    from
                        ((`migracion_prueba`.`dt_ordenes`
                    join `migracion_prueba`.`dt_costos` on
                        ((`migracion_prueba`.`dt_ordenes`.`id_ordenes` = `migracion_prueba`.`dt_costos`.`id_ordenes`)))
                    left join `migracion_prueba`.`dt_fechas_op` on
                        ((`migracion_prueba`.`dt_ordenes`.`id_ordenes` = `migracion_prueba`.`dt_fechas_op`.`id_ordenes`)))
                    where
                        ((`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 1)
                            and (`migracion_prueba`.`dt_costos`.`estado` in (1, 4, 7))
                                and (`migracion_prueba`.`dt_costos`.`n_ordenes` <> 0)
                                    and (`migracion_prueba`.`dt_ordenes`.`estado` in (1, 10, 12, 13))
                                        and (`migracion_prueba`.`dt_ordenes`.`conciliado` <> 1)
                                            and (`migracion_prueba`.`dt_costos`.`cant_sol` > 0)
                                                and (`migracion_prueba`.`dt_costos`.`cierre` = 0));
                    
                    
                    -- migracion_prueba.vw_user_activos source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_user_activos` AS
                    select
                        `migracion_prueba`.`user`.`id` AS `id`,
                        `migracion_prueba`.`user`.`id_empleado` AS `id_empleado`,
                        `migracion_prueba`.`user`.`username` AS `username`,
                        concat(`migracion_prueba`.`dt_usuarios`.`nombre_usuario`, ' ', `migracion_prueba`.`dt_usuarios`.`apellido_usuario`) AS `nombre_usuario`
                    from
                        (`migracion_prueba`.`user`
                    join `migracion_prueba`.`dt_usuarios` on
                        ((`migracion_prueba`.`dt_usuarios`.`id_usuario` = `migracion_prueba`.`user`.`id_empleado`)))
                    where
                        (`migracion_prueba`.`user`.`status` = 1);
                    
                    
                    -- migracion_prueba.vw_user_costos source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_user_costos` AS
                    select
                        `migracion_prueba`.`user`.`id` AS `id`,
                        `migracion_prueba`.`user`.`id_empleado` AS `id_empleado`,
                        `migracion_prueba`.`user`.`username` AS `username`,
                        concat(`migracion_prueba`.`dt_usuarios`.`nombre_usuario`, ' ', `migracion_prueba`.`dt_usuarios`.`apellido_usuario`) AS `nombre_usuario`
                    from
                        (`migracion_prueba`.`user`
                    join `migracion_prueba`.`dt_usuarios` on
                        ((`migracion_prueba`.`dt_usuarios`.`id_usuario` = `migracion_prueba`.`user`.`id_empleado`)))
                    where
                        (`migracion_prueba`.`user`.`status` = 1);
                    
                    
                    -- migracion_prueba.vw_user_diseno source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_user_diseno` AS
                    select
                        `migracion_prueba`.`user`.`id` AS `id`,
                        `migracion_prueba`.`user`.`id_empleado` AS `id_empleado`,
                        `migracion_prueba`.`user`.`username` AS `username`,
                        concat(`migracion_prueba`.`dt_usuarios`.`nombre_usuario`, ' ', `migracion_prueba`.`dt_usuarios`.`apellido_usuario`) AS `nombre_usuario`
                    from
                        (`migracion_prueba`.`user`
                    join `migracion_prueba`.`dt_usuarios` on
                        ((`migracion_prueba`.`dt_usuarios`.`id_usuario` = `migracion_prueba`.`user`.`id_empleado`)))
                    where
                        (`migracion_prueba`.`user`.`status` = 1);
                    
                    
                    -- migracion_prueba.vw_valores_compras source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_valores_compras` AS
                    select
                        `migracion_prueba`.`dt_costos`.`id_costo` AS `id_costo`,
                        `migracion_prueba`.`dt_ordenes`.`conciliado` AS `conciliado`,
                        `migracion_prueba`.`dt_ordenes`.`n_ordenes` AS `n_ordenes`,
                        `migracion_prueba`.`dt_fechas_op`.`fecha_ingreso` AS `fecha_ingreso`,
                        `migracion_prueba`.`dt_costos`.`nombre_costo` AS `nombre_costo`,
                        `migracion_prueba`.`dt_costos`.`cod_material` AS `cod_material`,
                        `migracion_prueba`.`dt_costos`.`cant_sol` AS `cant_sol`,
                        `migracion_prueba`.`dt_costos`.`valor_unit` AS `valor_unit`,
                        `migracion_prueba`.`dt_costos`.`valor_total` AS `valor_total`
                    from
                        ((`migracion_prueba`.`dt_costos`
                    left join `migracion_prueba`.`dt_ordenes` on
                        ((`migracion_prueba`.`dt_costos`.`id_ordenes` = `migracion_prueba`.`dt_ordenes`.`id_ordenes`)))
                    left join `migracion_prueba`.`dt_fechas_op` on
                        ((`migracion_prueba`.`dt_ordenes`.`id_ordenes` = `migracion_prueba`.`dt_fechas_op`.`id_ordenes`)))
                    where
                        ((`migracion_prueba`.`dt_costos`.`id_tipo_costo` = 1)
                            and (`migracion_prueba`.`dt_costos`.`estado` in ('1', '4', '7'))
                                and (`migracion_prueba`.`dt_costos`.`n_ordenes` <> 0)
                                    and (`migracion_prueba`.`dt_ordenes`.`estado` in ('1', '10', '12', '13'))
                                        and (`migracion_prueba`.`dt_costos`.`cant_sol` > 0)
                                            and (`migracion_prueba`.`dt_costos`.`cierre` = 0))
                    group by
                        `migracion_prueba`.`dt_costos`.`id_costo`
                    order by
                        `migracion_prueba`.`dt_costos`.`valor_total` desc;
                        
                    -- migracion_prueba.vw_existencia_area source
                    
                    CREATE OR REPLACE
                    ALGORITHM = UNDEFINED VIEW `migracion_prueba`.`vw_existencia_area` AS
                    select
                        `migracion_prueba`.`vw`.`id_inventarioxarea` AS `id_inventarioxarea`,
                        `migracion_prueba`.`vw`.`codigo_prod` AS `codigo_prod`,
                        `migracion_prueba`.`vw`.`producto` AS `producto`,
                        `migracion_prueba`.`vw`.`id_inventario` AS `id_inventario`,
                        `migracion_prueba`.`vw`.`id_area` AS `id_area`,
                        `migracion_prueba`.`vw`.`nombre` AS `nombre`,
                        truncate(sum(`migracion_prueba`.`vw`.`stock`), 2) AS `stock_total`,
                        truncate(sum(`migracion_prueba`.`vw`.`valor_total`), 2) AS `valor_total`,
                        sum(`migracion_prueba`.`vw`.`stock_instalacion`) AS `stock_instalacion`,
                        truncate(sum(`migracion_prueba`.`vw`.`valor_instalacion`), 2) AS `valor_instalacion`,
                        sum(`migracion_prueba`.`vw`.`stock_almacen`) AS `stock_almacen`,
                        truncate(sum(`migracion_prueba`.`vw`.`valor_almacen`), 2) AS `valor_almacen`,
                        sum(`migracion_prueba`.`vw`.`stock_metalmecanica`) AS `stock_metalmecanica`,
                        truncate(sum(`migracion_prueba`.`vw`.`valor_metalmecanica`), 2) AS `valor_metalmecanica`,
                        sum(`migracion_prueba`.`vw`.`stock_pintura`) AS `stock_pintura`,
                        truncate(sum(`migracion_prueba`.`vw`.`valor_pintura`), 2) AS `valor_pintura`,
                        sum(`migracion_prueba`.`vw`.`stock_sustratos`) AS `stock_sustratos`,
                        truncate(sum(`migracion_prueba`.`vw`.`valor_sustratos`), 2) AS `valor_sustratos`,
                        sum(`migracion_prueba`.`vw`.`stock_ensamble`) AS `stock_ensamble`,
                        truncate(sum(`migracion_prueba`.`vw`.`valor_ensamble`), 2) AS `valor_ensamble`,
                        sum(`migracion_prueba`.`vw`.`stock_impresion`) AS `stock_impresion`,
                        truncate(sum(`migracion_prueba`.`vw`.`valor_impresion`), 2) AS `valor_impresion`,
                        sum(`migracion_prueba`.`vw`.`stock_decoracion`) AS `stock_decoracion`,
                        truncate(sum(`migracion_prueba`.`vw`.`valor_decoracion`), 2) AS `valor_decoracion`,
                        sum(`migracion_prueba`.`vw`.`stock_despachos`) AS `stock_despachos`,
                        truncate(sum(`migracion_prueba`.`vw`.`valor_despachos`), 2) AS `valor_despachos`
                    from
                        `migracion_prueba`.`vw_sub_existencia_area` `vw`
                    group by
                        `migracion_prueba`.`vw`.`codigo_prod`;   
                ");

            }catch(PDOException $e){
                echo "Hubo un error en la creación de las vistas bd ".$e->getMessage();exit;
            }

            return "Se ha completado la creación de vistas bd ";

        }

    }

?>

