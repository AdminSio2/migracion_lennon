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
                    echo "Hubo un problema con el id_proveedor ".$registro_prove['id_proveedores']."<br>".$e->getMessage();
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



    }

?>

