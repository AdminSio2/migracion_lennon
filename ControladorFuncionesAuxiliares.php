<?php

    class ControladorFuncionesAuxiliares{

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
            elseif(strpos($string_formatear, '├│') !== false){
                $string_formateado = str_replace('├│', 'ó', $string_formatear);
            }
            elseif(strpos($string_formatear, '├Ü') !== false){
                $string_formateado = str_replace('├Ü', 'Ú', $string_formatear);
            }
            elseif(strpos($string_formatear, '├ì') !== false){
                $string_formateado = str_replace('├ì', 'Í', $string_formatear);
            }
            else{
                $string_formateado = $string_formatear;
            }

            return $string_formateado;

        }

        public static function creaTablasGarantia($conexion_migracion_prueba){

            try{

                $conexion_migracion_prueba->exec("
                
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

            return "Se crearon las tablas dt_actividades, dt_actividades_f y dt_aprobado_g_r complemetarias a dt_solicitud_g_r";


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
                    echo "Hubo un problema con el id_proveedor ".$registro_prove['id_proveedores']."<br>".$e->getMessage();;
                    exit;
                }

                $registros_corregidos++;
            }

            $conexion_migracion_prueba->commit();

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Corrección dt_inf_contable_prove completada ".$registros_corregidos." registros corregidos en ".$tiempo_transcurrido." segundos"."\n<br>";

            return $mensaje;

        }

        public static function corrijeDtCodprodfinal($conexion_migracion_prueba,$array_info_global){
            
            //Iniciamos timer

            $tiempo_inicio = microtime(true);

            $consulta_dt_codprodfinal = $conexion_migracion_prueba->query("SELECT id_codprodfinal,tam_x,tam_y,tam_z,tam_l FROM dt_codprodfinal");

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
                    

                    $update_codprodfinal = $conexion_migracion_prueba->prepare("UPDATE dt_codprodfinal SET tam_x = :tam_x,tam_y = :tam_y,tam_z = :tam_z,tam_l = :tam_l WHERE id_codprodfinal = :id_codprodfinal");

                    $update_codprodfinal->execute([
                        'tam_x' => $tam_x,
                        'tam_y' => $tam_y,
                        'tam_z' => $tam_z,
                        'tam_l' => $tam_l,
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

            $mensaje = "Corrección dt_codprodfinal completada ".$registros_corregidos." registros corregidos en ".$tiempo_transcurrido." segundos"."\n<br>";

            return $mensaje;

        }

    }

?>

