<?php

    include 'ControladorInformacionGlobal.php';
    require 'ControladorFuncionesAuxiliares.php';


    class ControladorMigracion{

        public static function migraDtClientesDtInffacCli($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Inicia timer

            $tiempo_inicio = microtime(true);

            //Consultamos dt_clientes

            $consulta_dt_clientes = $conexion_sio1->query("
                SELECT id_cliente,activo,potencial,objetivo,empresa,codvended,nit,digVeri,fecha_ingreso,fechaActualizacion,
                actualizadoPor,direccion,tel1,email,www,contacto,actEconomica,celCont,cargoCont,gerente,celular,pais,codciudad,regimen,fPago,cta_puc,cupo,cupoCont,tipoCupo,
                codTributario,tipoIdent,tipoPersona,declarante,AgRetenedor,benRTIVA,AgRETIVA,rtegarantia,vrReteG,rtefuente_renta,entiPublica,codEntidadPublica,razonSocial,
                comisionCor FROM dt_clientes
            ");

            $array_dt_clientes = $consulta_dt_clientes->fetchAll(PDO::FETCH_OBJ);

            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_macro_proyecto
                DROP FOREIGN KEY dt_macro_proyecto_ibfk_1;

                DROP TABLE dt_clientes;
                DROP TABLE dt_inffac_cli;
            ");

            //Creamos nuevamente dt_clientes(Sin llave primaria) y dt_inffac_cli

            $conexion_migracion_prueba->exec("
                -- Sio2Db_Junio.dt_clientes definition

                CREATE TABLE `dt_clientes` (
                `id_cliente` int,
                `estado` smallint DEFAULT NULL,
                `potencial` smallint DEFAULT NULL,
                `objetivo` smallint DEFAULT NULL,
                `nom_empresa` varchar(100) NOT NULL,
                `id_usuario` int NOT NULL,
                `nit` varchar(50) DEFAULT NULL,
                `dig_verificacion` int DEFAULT NULL,
                `fecha_ingreso` datetime DEFAULT NULL,
                `fecha_actualizacion` datetime DEFAULT NULL,
                `usuario_actualizador` int DEFAULT NULL,
                `direccion` varchar(300) DEFAULT NULL,
                `telefono` varchar(30) DEFAULT NULL,
                `email_empresa` varchar(76) DEFAULT NULL,
                `pagina_web` longtext,
                `contacto` varchar(100) DEFAULT NULL,
                `sector` varchar(150) DEFAULT NULL,
                `area` varchar(50) DEFAULT NULL,
                `telefono_contacto` varchar(30) DEFAULT NULL,
                `cargo_contacto` varchar(100) DEFAULT NULL,
                `email_contacto` varchar(76) DEFAULT NULL,
                `fecha_nac_contacto` date DEFAULT NULL,
                `direccion_contacto` varchar(100) DEFAULT NULL,
                `gustos` longtext,
                `representante_legal` varchar(100) DEFAULT NULL,
                `cedula_representante_legal` bigint DEFAULT NULL,
                `celular_representante_legal` bigint DEFAULT NULL,
                `facturacion` varchar(50) DEFAULT NULL,
                `id_pais` int DEFAULT NULL,
                `importancia_1` smallint DEFAULT NULL,
                `importancia_2` smallint DEFAULT NULL,
                `importancia_3` smallint DEFAULT NULL,
                `importancia_4` smallint DEFAULT NULL,
                `intereses_compras` varchar(100) DEFAULT NULL,
                `intereses_mercadeo` varchar(100) DEFAULT NULL,
                `intereses_proyectos` varchar(100) DEFAULT NULL,
                `id_ciudad` int DEFAULT NULL,
                `id_regimen` int DEFAULT NULL,
                `id_forma_pago` int DEFAULT NULL,
                `id_geografia` int DEFAULT NULL,
                KEY `id_geografia` (`id_geografia`),
                KEY `id_cliente` (`id_cliente`),
                CONSTRAINT `dt_clientes_ibfk_1` FOREIGN KEY (`id_geografia`) REFERENCES `dt_geografia` (`id_geografia`)
                ) ENGINE=InnoDB AUTO_INCREMENT=2750 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
            ");

            $conexion_migracion_prueba->exec("
                -- Sio2Db_Junio.dt_inffac_cli definition

                CREATE TABLE `dt_inffac_cli` (
                `id_inffac_cli` int NOT NULL AUTO_INCREMENT,
                `cuenta_contable` varchar(45) DEFAULT NULL,
                `descuento_ica` varchar(45) DEFAULT NULL,
                `cupo_credito` varchar(45) DEFAULT NULL,
                `cupo_contrato` varchar(45) DEFAULT NULL,
                `aprobado_por` smallint DEFAULT NULL,
                `cod_clasitri` varchar(45) DEFAULT NULL,
                `tipo_identificacion` smallint DEFAULT NULL,
                `tipo_persona` smallint DEFAULT NULL,
                `declarante` smallint DEFAULT NULL,
                `agente_retenedor` smallint DEFAULT NULL,
                `benefactor_rtiva` smallint DEFAULT NULL,
                `agente_rtiva` smallint DEFAULT NULL,
                `rete_garantia` smallint DEFAULT NULL,
                `meses_garantia` smallint DEFAULT NULL,
                `valor_rt_garantia` varchar(100) DEFAULT NULL,
                `rt_fuente_renta` smallint DEFAULT NULL,
                `entidad_publica` smallint DEFAULT NULL,
                `cod_entidad_publica` varchar(45) DEFAULT NULL,
                `razon_social` smallint DEFAULT NULL,
                `comision_coorporativa` varchar(45) DEFAULT NULL,
                `id_cliente` int NOT NULL,
                PRIMARY KEY (`id_inffac_cli`),
                KEY `fk_dt_inffac_cli_dt_clientes1` (`id_cliente`)
                ) ENGINE=InnoDB AUTO_INCREMENT=1905 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
            ");

            $array_potencial = [
                'Alto' => 1,
                'Bajo' => 3,
                'Medio' => 2,
                'Nulo' => 0,
                '' => null,
                '0' => 0
            ];

            $array_objetivo = [
                'Atraer' => 3,
                'Fidelizar' => 2,
                'Recuperar' => 4,
                'Rentabilizar' => 1,
                '' => null
            ];

            $array_regimen = [
                'C' => 2,
                'G' => 4,
                'I' => 5, //No responsable de IVA
                'N' => NULL,
                'S' => 3
            ];

            $array_forma_pago = [
                'fp1' => 22,
                'fp10' => 31,
                'fp14' => 35,
                'fp15' => 36,
                'fp16' => 39,
                'fp2' => 23,
                'fp3' => 24,
                'fp6' => 27,
                'fp7' => 28,
                'fp8' => 29
            ];


            $array_usuarios = $array_info_global['codVendedor=>id'];

            $array_usuarios2 = $array_info_global['vendedor=>id'];

            $array_tipo_identificacion = ['NIT' => 1, 'CC' => 2];

            $array_tipo_persona = ['Juridica' => 1,'Natural' => 2]; 

            $array_agente_retenedor = ['Si' => 1,'No' => 2];

            $array_declarante = ['Si' => 1,'No' => 2];

            $array_benefactor_rteiva = ['Si' => 1,'No' => 2];

            $array_agente_rteiva = ['Si' => 1,'No' => 2];
            
            $array_retegarantia = ['Si' => 1,'No' => 2];

            $array_retefuenterenta = ['Si' => 1,'No' => 2];

            $array_entidad_publica = ['Si' => 1,'No' => 2];

            $array_razon_social = ['Si' => 1,'No' => 2];
            /*
            id_ciudad = Es el pais y viene de dt_geografia
            id_geografica = Es la ciudad y viene de dt_geografia
            */ 

            //Ciudad [pais,ciudad]
            $array_cod_ciudad = [
                '0' => [1,1283],
                '1' => [1,1283],
                'ACACIAS@META@Colombi' => [1,785],
                'AIPE@HUILA@Colombia' => [1,703],
                'ARAUCA@ARAUCA@Colomb' => [1,178],
                'ARUBA' => [1284,1286],
                'BARANOA@ATLANTICO@Co' => [1,185],
                'BARRANCABERMEJA' => [1,963],
                'BARRANQUILLA' => [1,185],
                'BARRANQUILLA@ATLANTI' => [1,185],
                'BENTON VILLE' => [1287,1289],
                'BOGOTA' => [1,1283],
                'BogotÃ¡' => [1,1283],
                'BOGOTA@D.C@Colombia' => [1,1283],
                'BUCARAMANGA' => [1,966],
                'CAJICA@CUNDINAMARCA@' => [1,639],
                'CALI' =>  [1,1127],
                'CARACAS' => [2,1292],
                'CARTAGENA' => [1,224],
                'CARTAGENA DEL CHAIRA' => [1,413],
                'CHIA' => [1,640],
                'CIUDAD DE MEXICO' => [8,1262],
                'CUCUTA' => [1,885],
                'ENVIGADO' => [1,101],
                'FACATATIVA' => [1,652],
                'FLORENCIA' => [1,417],
                'FUNZA' => [1,653],
                'FUNZA@CUNDINAMARCA@C' => [1,653],
                'HIA' => [1,640],
                'IBAGUE' => [1,1092],
                'ITAGUI' => [1,113],
                'LA DORADA' => [1,403],
                'LA ESTRELLA' => [1,118],
                'LA VEGA' => [1,470],
                'MARIQUITA' => [1,1111],
                'MDE' => [1,124],
                'MEDELLIN' => [1,124],
                'MONTERIA' => [1,556],
                'MOSQUERA' => [1,655],
                'NEIVA' => [1,710],
                'NEIVA@HUILA@Colombia' => [1,710],
                'New York' =>  [1287,1291],
                'NO CATALOGAD' => [null,null],
                'OTRAS CIUDAD' => [null,null],
                'PASTO' => [1,859],
                'PEREIRA' => [1,952],
                'POPAYAN@CAUCA@Colomb' => [1,461],
                'PUERTO COLOMBIA' => [1,198],
                'RESTREPO' => [1,807],
                'SABANA DE TORRES' => [1,1024],
                'SABANETA' => [1,140],
                'SAN JUAN NEPUMUCENO' => [1,246],
                'SANTA MARTA' => [1,779],
                'SANTO DOMINGO DE GUZ' => [7,1610],
                'SIBATE' => [1,658],
                'SIBERIA' => [1,610],
                'SINCELEJO' => [1,1052],
                'SOACHA' => [1,659],
                'SOPO' => [1,645],
                'TABIO' => [1,646],
                'TACOTA' => [1,905],
                'TENJO' => [1,647],
                'TOCANCIPA' => [1,648],
                'TUNJA' => [1,273],
                'UBATE' => [1,689],
                'V/CENCIO' => [1,812],
                'VALLEDUPAR' => [1,488],
                'VILLAVICENCIO' => [1,812],
                'YOPAL' => [1,445],
                'YUM' => [1,1158]
            ];

            $registros_insertados = 0;

            $conexion_migracion_prueba->beginTransaction();

            foreach($array_dt_clientes as $registro_ft_clientes){

                try{

                    $potencial = array_key_exists($registro_ft_clientes->potencial,$array_potencial)?$array_potencial[$registro_ft_clientes->potencial]:null;

                    $objetivo = array_key_exists($registro_ft_clientes->objetivo,$array_objetivo)?$array_objetivo[$registro_ft_clientes->objetivo]:null;

                    $id_usuario = array_key_exists(trim($registro_ft_clientes->codvended),$array_usuarios)?$array_usuarios[trim($registro_ft_clientes->codvended)]:1;

                    $actualizadoPor = array_key_exists(trim($registro_ft_clientes->actualizadoPor),$array_usuarios2)?$array_usuarios2[trim($registro_ft_clientes->actualizadoPor)]:null;

                    $nom_empresa = ControladorFuncionesAuxiliares::formateaString($registro_ft_clientes->empresa);

                    if(array_key_exists(trim($registro_ft_clientes->codciudad),$array_cod_ciudad)){
                        $id_ciudad = $array_cod_ciudad[trim($registro_ft_clientes->codciudad)][0];
                        $id_geografia = $array_cod_ciudad[trim($registro_ft_clientes->codciudad)][1];
                    }else{
                        $id_ciudad = null;
                        $id_geografia = null;
                    }

                    $id_regimen = array_key_exists(trim($registro_ft_clientes->regimen),$array_regimen)?$array_regimen[trim($registro_ft_clientes->regimen)]:null;

                    $id_forma_pago = array_key_exists(trim($registro_ft_clientes->fPago),$array_forma_pago)?$array_forma_pago[trim($registro_ft_clientes->fPago)]:null;

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_clientes(id_cliente,estado,potencial,objetivo,nom_empresa,id_usuario,nit,dig_verificacion,fecha_ingreso,fecha_actualizacion,
                        usuario_actualizador,direccion,telefono,email_empresa,pagina_web,contacto,sector,area,telefono_contacto,cargo_contacto,email_contacto,
                        fecha_nac_contacto,direccion_contacto,gustos,representante_legal,cedula_representante_legal,celular_representante_legal,facturacion,id_pais,
                        importancia_1,importancia_2,importancia_3,importancia_4,intereses_compras,intereses_mercadeo,intereses_proyectos,id_ciudad,id_regimen,
                        id_forma_pago,id_geografia)VALUES(:id_cliente,:estado,:potencial,:objetivo,:nom_empresa,:id_usuario,:nit,:dig_verificacion,:fecha_ingreso,
                        :fecha_actualizacion,:usuario_actualizador,:direccion,:telefono,:email_empresa,:pagina_web,:contacto,:sector,:area,:telefono_contacto,
                        :cargo_contacto,:email_contacto,:fecha_nac_contacto,:direccion_contacto,:gustos,:representante_legal,:cedula_representante_legal,
                        :celular_representante_legal,:facturacion,:id_pais,:importancia_1,:importancia_2,:importancia_3,:importancia_4,:intereses_compras,
                        :intereses_mercadeo,:intereses_proyectos,:id_ciudad,:id_regimen,:id_forma_pago,:id_geografia)
                    ");

                    $insert_registro->execute([
                        'id_cliente' => $registro_ft_clientes->id_cliente,
                        'estado'  => $registro_ft_clientes->activo,
                        'potencial'  => $potencial,
                        'objetivo' => $objetivo,
                        'nom_empresa' => $nom_empresa,
                        'id_usuario' => $id_usuario,
                        'nit' => $registro_ft_clientes->nit,
                        'dig_verificacion' => $registro_ft_clientes->digVeri,
                        'fecha_ingreso' => $registro_ft_clientes->fecha_ingreso,
                        'fecha_actualizacion' => $registro_ft_clientes->fechaActualizacion,
                        'usuario_actualizador' => $actualizadoPor,
                        'direccion' => $registro_ft_clientes->direccion,
                        'telefono' => $registro_ft_clientes->tel1,
                        'email_empresa' => $registro_ft_clientes->email, 
                        'pagina_web' => $registro_ft_clientes->www,
                        'contacto' => $registro_ft_clientes->contacto,
                        'sector' => $registro_ft_clientes->actEconomica,
                        'area' => null,
                        'telefono_contacto' => $registro_ft_clientes->celCont,
                        'cargo_contacto' => $registro_ft_clientes->cargoCont,
                        'email_contacto' => null,
                        'fecha_nac_contacto' => null,
                        'direccion_contacto' => null,
                        'gustos' => null,
                        'representante_legal' => $registro_ft_clientes->gerente,
                        'cedula_representante_legal' => null,
                        'celular_representante_legal' => $registro_ft_clientes->celular, 
                        'facturacion' => null,
                        'id_pais' =>  null,
                        'importancia_1' =>  null,
                        'importancia_2' =>  null,
                        'importancia_3' =>  null,
                        'importancia_4' =>  null,
                        'intereses_compras' =>  null,
                        'intereses_mercadeo' =>  null,
                        'intereses_proyectos' =>  null,
                        'id_ciudad' => $id_ciudad, 
                        'id_regimen' => $id_regimen,
                        'id_forma_pago' => $id_forma_pago,
                        'id_geografia' => $id_geografia
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollback();
                    echo "Error en el id_cliente: ".$registro_ft_clientes->id_cliente."<br>".$e->getMessage();exit;
                }

                try{

                    $tipo_identificacion = array_key_exists(trim($registro_ft_clientes->tipoIdent),$array_tipo_identificacion)?$array_tipo_identificacion[trim($registro_ft_clientes->tipoIdent)]:null; 

                    $tipo_persona = array_key_exists(trim($registro_ft_clientes->tipoPersona),$array_tipo_persona)?$array_tipo_persona[trim($registro_ft_clientes->tipoPersona)]:null;

                    $agente_retenedor = array_key_exists(trim($registro_ft_clientes->AgRetenedor),$array_agente_retenedor)?$array_agente_retenedor[$registro_ft_clientes->AgRetenedor]:0;

                    $declarante = array_key_exists(trim($registro_ft_clientes->declarante),$array_declarante)?$array_declarante[trim($registro_ft_clientes->declarante)]:0;
                    
                    $benefactor_rtiva = array_key_exists(trim($registro_ft_clientes->benRTIVA),$array_benefactor_rteiva)?$array_benefactor_rteiva[trim($registro_ft_clientes->benRTIVA)]:0;
                    
                    $agente_rtiva = array_key_exists(trim($registro_ft_clientes->AgRETIVA),$array_agente_rteiva)?$array_agente_rteiva[trim($registro_ft_clientes->AgRETIVA)]:0;
                    
                    $rete_garantia = array_key_exists(trim($registro_ft_clientes->rtegarantia),$array_retegarantia)?$array_retegarantia[trim($registro_ft_clientes->rtegarantia)]:0;
                    
                    $rt_fuente_renta = array_key_exists(trim($registro_ft_clientes->rtefuente_renta),$array_retefuenterenta)?$array_retefuenterenta[trim($registro_ft_clientes->rtefuente_renta)]:0;
  
                    $entidad_publica = array_key_exists(trim($registro_ft_clientes->entiPublica),$array_entidad_publica)?$array_entidad_publica[trim($registro_ft_clientes->entiPublica)]:0;
                    
                    $razon_social = array_key_exists(trim($registro_ft_clientes->razonSocial),$array_razon_social)?$array_razon_social[trim($registro_ft_clientes->razonSocial)]:0;



                    $insert_registro2 = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_inffac_cli(cuenta_contable,descuento_ica,cupo_credito,cupo_contrato,aprobado_por,cod_clasitri,tipo_identificacion,
                        tipo_persona,declarante,agente_retenedor,benefactor_rtiva,agente_rtiva,rete_garantia,meses_garantia,valor_rt_garantia,rt_fuente_renta,
                        entidad_publica,cod_entidad_publica,razon_social,comision_coorporativa,id_cliente) VALUES(:cuenta_contable,:descuento_ica,
                        :cupo_credito,:cupo_contrato,:aprobado_por,:cod_clasitri,:tipo_identificacion,:tipo_persona,:declarante,:agente_retenedor,:benefactor_rtiva,
                        :agente_rtiva,:rete_garantia,:meses_garantia,:valor_rt_garantia,:rt_fuente_renta,:entidad_publica,:cod_entidad_publica,:razon_social,
                        :comision_coorporativa,:id_cliente)
                    ");

                    $insert_registro2->execute([
                        'cuenta_contable' => $registro_ft_clientes->cta_puc,
                        'descuento_ica' => null,
                        'cupo_credito' => $registro_ft_clientes->cupo,
                        'cupo_contrato' => $registro_ft_clientes->cupoCont,
                        'aprobado_por' => null,
                        'cod_clasitri' => null,
                        'tipo_identificacion' => $tipo_identificacion,
                        'tipo_persona' => $tipo_persona,
                        'declarante' => $declarante,
                        'agente_retenedor' => $agente_retenedor,
                        'benefactor_rtiva' => $benefactor_rtiva,
                        'agente_rtiva' => $agente_rtiva,
                        'rete_garantia' => $rete_garantia,
                        'meses_garantia' => null,
                        'valor_rt_garantia' => 0,
                        'rt_fuente_renta' => $rt_fuente_renta,
                        'entidad_publica' => $entidad_publica,
                        'cod_entidad_publica' => null,
                        'razon_social' => $razon_social,
                        'comision_coorporativa' => null,
                        'id_cliente' =>  $registro_ft_clientes->id_cliente
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollback();
                    echo "Error en el id_cliente: ".$registro_ft_clientes->id_cliente."<br>".$e->getMessage();exit;
                }

                $registros_insertados++;
                
            }
            $conexion_migracion_prueba->commit();
            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_clientes
                MODIFY id_cliente INT AUTO_INCREMENT PRIMARY KEY;

                ALTER TABLE dt_macro_proyecto
                ADD CONSTRAINT dt_macro_proyecto_ibfk_1 FOREIGN KEY (id_cliente)
                REFERENCES dt_clientes (id_cliente);
            ");

            // Finaliza timer y entregamos mensaje 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_clientes y dt_inffac_cli completada ".$registros_insertados." registros insertados en ambas tablas en ".$tiempo_transcurrido." segundos";

            return $mensaje;

        }

        public static function migraDtInventarioDtKardex($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Inicia timer

            $tiempo_inicio = microtime(true);

            //Consultamos dt_inventario en Sio 1

            $consulta_dt_inventario = $conexion_sio1->query("
                SELECT id_inventario,codigo_prod,cod_transito,cod_barras,producto,medida,
                stock,kardex,valor_unidad,vrUnidad_compra,lista_precio,valor_total,proveedor,
                x,y,activo,tiempoCompra,observaciones,fechaCreacion,grupo,subgrupo,
                minimo,marca,eneC,eneV,febC,febV,marC,marV,abrC,abrV,mayC,mayV,junC,junV,
                julC,julV,agoC,agoV,sepC,sepV,octC,octV,novC,novV,dicC,dicV  FROM dt_inventario
            ");

            $array_dt_inventario = $consulta_dt_inventario->fetchAll(PDO::FETCH_OBJ);

            //Borramos el dt_inventario de Oz

            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_proveeref
                DROP FOREIGN KEY fk_dt_proveeref_dt_inventario1;

                DROP TABLE dt_inventario;
                DROP TABLE dt_kardex;
            ");

            //Creamos nuevamente dt_inventario(Sin llave primaria) y dt_kardex

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_inventario` (
                `id_inventario` int,
                `codigo_prod` varchar(180) DEFAULT NULL,
                `cod_transito` varchar(180) DEFAULT NULL,
                `cod_barras` varchar(50) DEFAULT NULL,
                `producto` varchar(256) DEFAULT NULL,
                `id_medida` int DEFAULT NULL,
                `stock` DECIMAL(10, 2) DEFAULT NULL,
                `kardex_estado` char(1) DEFAULT NULL,
                `valor_unidad` DECIMAL(10, 2) DEFAULT NULL,
                `valor_unidad_compra` DECIMAL(10, 2) DEFAULT NULL,
                `lista_precio` DECIMAL(10, 2) DEFAULT NULL,
                `valor_total` DECIMAL(10, 2) DEFAULT NULL,
                `id_proveedor` int DEFAULT NULL,
                `tam_x` float DEFAULT NULL,
                `tam_y` float DEFAULT NULL,
                `estado` smallint DEFAULT NULL,
                `tiempo_compra` int DEFAULT NULL,
                `observaciones_mat` longtext,
                `fecha_creacion` date DEFAULT NULL,
                `id_grupo_inventario` int DEFAULT NULL,
                `id_subgrupo` int DEFAULT NULL,
                `cantidad_min` int DEFAULT NULL,
                `material_crit` int DEFAULT NULL,
                `marca` varchar(100) DEFAULT NULL
                ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
            ");

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_kardex` (
                `id_kardex` int NOT NULL AUTO_INCREMENT,
                `id_inventario` int DEFAULT NULL,
                `codigo_prod` varchar(180) DEFAULT NULL,
                `producto` varchar(256) DEFAULT NULL,
                `enero_stock` double(12,2) DEFAULT NULL,
                `enero_valor` double(12,2) DEFAULT NULL,
                `febrero_stock` double(12,2) DEFAULT NULL,
                `febrero_valor` double(12,2) DEFAULT NULL,
                `marzo_stock` double(12,2) DEFAULT NULL,
                `marzo_valor` double(12,2) DEFAULT NULL,
                `abril_stock` double(12,2) DEFAULT NULL,
                `abril_valor` double(12,2) DEFAULT NULL,
                `mayo_stock` double(12,2) DEFAULT NULL,
                `mayo_valor` double(12,2) DEFAULT NULL,
                `junio_stock` double(12,2) DEFAULT NULL,
                `junio_valor` double(12,2) DEFAULT NULL,
                `julio_stock` double(12,2) DEFAULT NULL,
                `julio_valor` double(12,2) DEFAULT NULL,
                `agosto_stock` double(12,2) DEFAULT NULL,
                `agosto_valor` double(12,2) DEFAULT NULL,
                `septiembre_stock` double(12,2) DEFAULT NULL,
                `septiembre_valor` double(12,2) DEFAULT NULL,
                `octubre_stock` double(12,2) DEFAULT NULL,
                `octubre_valor` double(12,2) DEFAULT NULL,
                `noviembre_stock` double(12,2) DEFAULT NULL,
                `noviembre_valor` double(12,2) DEFAULT NULL,
                `diciembre_stock` double(12,2) DEFAULT NULL,
                `diciembre_valor` double(12,2) DEFAULT NULL,
                PRIMARY KEY (`id_kardex`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
            ");

            $array_medidas = $array_info_global['medidas=>id_medida'];
            $array_proveedores = $array_info_global['empresa=>id_proveedores'];
            $array_grupo_inventario_moni = [
                1 => 19,
                3 => 9,
                4 => 9,
                5 => 9,
                6 => 9,
                7 => 9,
                8 => 9,
                9 => 9,
                10 => 9,
                13 => 19,
                14 => 9,
                15 => 9,
                16 => 9,
                17 => 9,
                19 => 9,
                24 => 19,
                26 => 12,
                27 => 9,
                28 => 9,
                29 => 18,
                30 => 19,
                31 => 19,
                32 => 19,
                33 => 19,
                34 => 6,
                35 => 19,
                36 => 6,
                37 => 6,
                38 => 6,
                39 => 6,
                40 => 6,
                42 => 6,
                43 => 6,
                44 => 6,
                45 => 18,
                46 => 6,
                47 => 6,
                48 => 6,
                49 => 6,
                50 => 6,
                55 => 11,
                56 => 18,
                57 => 11,
                59 => 11,
                60 => 11,
                61 => 11,
                7328 => 11,
                62 => 6,
                64 => 11,
                66 => 11,
                67 => 18,
                69 => 11,
                70 => 6,
                71 => 6,
                72 => 6,
                7437 => 15,
                73 => 6,
                6600 => 6,
                74 => 6,
                75 => 6,
                76 => 6,
                77 => 6,
                78 => 18,
                79 => 6,
                80 => 6,
                81 => 6,
                82 => 6,
                83 => 6,
                84 => 6,
                85 => 6,
                86 => 6,
                7595 => 19,
                87 => 6,
                88 => 6,
                4609 => 11,
                89 => 19,
                90 => 6,
                91 => 6,
                93 => 6,
                94 => 6,
                95 => 6,
                96 => 6,
                97 => 6,
                7694 => 18,
                98 => 6,
                99 => 6,
                100 => 18,
                101 => 6,
                7523 => 6,
                102 => 6,
                103 => 6,
                5585 => 15,
                104 => 6,
                105 => 6,
                106 => 6,
                107 => 6,
                108 => 6,
                109 => 6,
                110 => 6,
                111 => 19,
                112 => 18,
                113 => 6,
                114 => 6,
                115 => 6,
                116 => 6,
                117 => 6,
                120 => 6,
                121 => 6,
                122 => 18,
                123 => 19,
                131 => 6,
                7506 => 18,
                132 => 6,
                133 => 18,
                135 => 6,
                136 => 6,
                139 => 6,
                140 => 6,
                141 => 6,
                142 => 6,
                143 => 11,
                144 => 18,
                145 => 11,
                146 => 11,
                147 => 11,
                148 => 11,
                149 => 11,
                150 => 11,
                9213 => 5,
                2402 => 6,
                153 => 11,
                154 => 18,
                2400 => 19,
                2401 => 6,
                2398 => 21,
                158 => 11,
                159 => 11,
                7457 => 11,
                161 => 11,
                163 => 11,
                164 => 11,
                168 => 11,
                169 => 11,
                170 => 11,
                171 => 11,
                172 => 11,
                9318 => 9,
                173 => 11,
                174 => 11,
                175 => 18,
                176 => 11,
                177 => 11,
                178 => 11,
                3502 => 13,
                179 => 11,
                7399 => 5,
                7379 => 9,
                2797 => 5,
                180 => 4,
                181 => 19,
                182 => 11,
                7446 => 11,
                183 => 11,
                184 => 11,
                185 => 11,
                186 => 18,
                187 => 11,
                188 => 11,
                189 => 11,
                190 => 11,
                191 => 11,
                192 => 11,
                193 => 11,
                194 => 11,
                195 => 11,
                196 => 11,
                197 => 18,
                7448 => 19,
                198 => 11,
                199 => 11,
                4607 => 11,
                200 => 11,
                201 => 11,
                202 => 11,
                203 => 11,
                204 => 11,
                8959 => 5,
                205 => 11,
                206 => 11,
                207 => 11,
                208 => 18,
                209 => 11,
                210 => 11,
                7326 => 11,
                211 => 11,
                212 => 11,
                213 => 11,
                214 => 11,
                215 => 11,
                216 => 11,
                217 => 11,
                7417 => 11,
                219 => 19,
                220 => 18,
                221 => 11,
                222 => 11,
                4599 => 6,
                223 => 11,
                4600 => 6,
                224 => 11,
                225 => 11,
                8703 => 21,
                229 => 11,
                230 => 11,
                231 => 18,
                232 => 11,
                233 => 11,
                234 => 11,
                8951 => 15,
                235 => 11,
                236 => 11,
                237 => 11,
                238 => 11,
                9304 => 9,
                239 => 11,
                240 => 11,
                241 => 11,
                242 => 18,
                7325 => 11,
                243 => 11,
                244 => 11,
                245 => 11,
                7969 => 11,
                246 => 11,
                247 => 11,
                249 => 12,
                251 => 12,
                253 => 18,
                264 => 18,
                268 => 5,
                275 => 18,
                3242 => 5,
                3243 => 19,
                3236 => 19,
                286 => 18,
                302 => 5,
                305 => 5,
                308 => 18,
                313 => 5,
                315 => 5,
                316 => 5,
                319 => 18,
                3247 => 9,
                330 => 19,
                331 => 18,
                336 => 5,
                342 => 18,
                7466 => 19,
                352 => 5,
                353 => 18,
                361 => 5,
                367 => 5,
                3244 => 19,
                3245 => 11,
                375 => 10,
                383 => 5,
                387 => 5,
                389 => 5,
                394 => 5,
                5576 => 11,
                3246 => 13,
                396 => 5,
                397 => 18,
                398 => 5,
                5633 => 11,
                400 => 5,
                403 => 5,
                404 => 5,
                406 => 5,
                407 => 18,
                408 => 5,
                413 => 5,
                414 => 5,
                418 => 18,
                426 => 5,
                427 => 5,
                429 => 18,
                430 => 5,
                432 => 5,
                2903 => 16,
                437 => 5,
                440 => 18,
                441 => 5,
                443 => 5,
                444 => 5,
                445 => 5,
                446 => 5,
                449 => 5,
                451 => 18,
                452 => 5,
                454 => 5,
                7323 => 11,
                455 => 5,
                4367 => 21,
                456 => 5,
                457 => 5,
                459 => 5,
                7440 => 15,
                460 => 5,
                462 => 9,
                463 => 5,
                465 => 5,
                466 => 5,
                467 => 5,
                471 => 5,
                473 => 9,
                474 => 5,
                479 => 5,
                482 => 5,
                5632 => 11,
                484 => 9,
                4614 => 6,
                486 => 5,
                489 => 5,
                491 => 5,
                495 => 9,
                506 => 9,
                517 => 9,
                4615 => 15,
                518 => 5,
                528 => 9,
                7322 => 11,
                536 => 5,
                540 => 5,
                542 => 5,
                544 => 5,
                545 => 5,
                548 => 5,
                7505 => 15,
                551 => 9,
                552 => 5,
                553 => 5,
                555 => 5,
                557 => 5,
                558 => 5,
                562 => 9,
                571 => 5,
                573 => 9,
                575 => 5,
                577 => 5,
                579 => 5,
                582 => 5,
                584 => 9,
                588 => 5,
                590 => 5,
                592 => 5,
                594 => 14,
                595 => 9,
                597 => 17,
                598 => 17,
                599 => 17,
                600 => 17,
                601 => 17,
                602 => 17,
                603 => 17,
                7321 => 19,
                604 => 17,
                605 => 17,
                606 => 9,
                607 => 17,
                608 => 17,
                609 => 17,
                612 => 14,
                614 => 12,
                7697 => 21,
                615 => 14,
                616 => 14,
                617 => 9,
                619 => 14,
                620 => 14,
                621 => 14,
                623 => 14,
                7602 => 5,
                3410 => 15,
                7503 => 15,
                7319 => 5,
                624 => 14,
                625 => 12,
                626 => 14,
                627 => 14,
                628 => 9,
                629 => 14,
                630 => 12,
                9448 => 9,
                631 => 14,
                632 => 12,
                633 => 12,
                7698 => 18,
                635 => 12,
                636 => 14,
                8956 => 15,
                637 => 14,
                638 => 14,
                639 => 9,
                650 => 9,
                655 => 13,
                656 => 13,
                657 => 13,
                658 => 13,
                659 => 13,
                660 => 13,
                662 => 9,
                665 => 14,
                673 => 9,
                680 => 13,
                681 => 13,
                682 => 24,
                684 => 9,
                685 => 17,
                4597 => 6,
                686 => 8,
                687 => 8,
                688 => 19,
                689 => 24,
                690 => 15,
                7327 => 15,
                691 => 12,
                692 => 15,
                693 => 15,
                694 => 15,
                696 => 15,
                697 => 15,
                698 => 15,
                699 => 15,
                700 => 15,
                706 => 9,
                707 => 15,
                709 => 15,
                710 => 15,
                4402 => 21,
                711 => 15,
                4366 => 21,
                712 => 15,
                713 => 15,
                715 => 15,
                716 => 15,
                7502 => 11,
                717 => 9,
                7317 => 15,
                718 => 15,
                719 => 15,
                721 => 15,
                722 => 15,
                724 => 24,
                725 => 24,
                726 => 24,
                727 => 24,
                728 => 9,
                729 => 24,
                730 => 24,
                731 => 24,
                737 => 24,
                739 => 9,
                750 => 9,
                761 => 9,
                768 => 15,
                773 => 9,
                776 => 21,
                777 => 21,
                778 => 21,
                784 => 9,
                789 => 21,
                790 => 21,
                791 => 21,
                792 => 21,
                793 => 21,
                795 => 9,
                7501 => 11,
                797 => 8,
                799 => 21,
                800 => 21,
                801 => 21,
                803 => 19,
                806 => 9,
                808 => 12,
                809 => 12,
                810 => 12,
                811 => 12,
                812 => 12,
                813 => 12,
                9080 => 15,
                814 => 12,
                815 => 12,
                816 => 12,
                817 => 9,
                818 => 12,
                819 => 12,
                820 => 19,
                821 => 12,
                822 => 12,
                823 => 19,
                824 => 12,
                825 => 12,
                826 => 12,
                827 => 12,
                828 => 9,
                829 => 19,
                831 => 12,
                832 => 24,
                7500 => 11,
                833 => 12,
                834 => 12,
                835 => 8,
                8775 => 18,
                837 => 19,
                838 => 19,
                839 => 9,
                841 => 19,
                842 => 19,
                7316 => 11,
                843 => 19,
                844 => 19,
                4596 => 6,
                845 => 12,
                9038 => 15,
                846 => 12,
                847 => 12,
                848 => 12,
                849 => 12,
                850 => 9,
                851 => 8,
                852 => 12,
                853 => 12,
                854 => 12,
                855 => 12,
                856 => 12,
                858 => 12,
                859 => 12,
                860 => 12,
                861 => 9,
                8838 => 15,
                862 => 9,
                864 => 6,
                865 => 11,
                866 => 9,
                867 => 9,
                868 => 9,
                869 => 9,
                870 => 9,
                871 => 9,
                873 => 9,
                875 => 9,
                876 => 9,
                877 => 11,
                7499 => 11,
                895 => 24,
                897 => 6,
                898 => 6,
                900 => 5,
                901 => 5,
                903 => 13,
                5584 => 21,
                905 => 13,
                906 => 13,
                907 => 13,
                908 => 13,
                909 => 13,
                910 => 13,
                911 => 13,
                916 => 13,
                917 => 13,
                918 => 13,
                919 => 13,
                920 => 13,
                921 => 13,
                922 => 18,
                923 => 19,
                924 => 18,
                7464 => 19,
                925 => 18,
                926 => 19,
                928 => 19,
                929 => 8,
                3615 => 17,
                930 => 18,
                931 => 18,
                932 => 9,
                933 => 9,
                934 => 9,
                7315 => 11,
                935 => 19,
                936 => 11,
                937 => 11,
                938 => 19,
                940 => 9,
                941 => 18,
                942 => 15,
                7498 => 11,
                943 => 18,
                944 => 18,
                945 => 15,
                3578 => 9,
                957 => 15,
                958 => 12,
                963 => 11,
                975 => 11,
                1008 => 11,
                1010 => 11,
                1015 => 11,
                1016 => 14,
                1017 => 14,
                1018 => 14,
                1019 => 14,
                1020 => 14,
                8667 => 15,
                1021 => 14,
                1022 => 14,
                1023 => 14,
                1024 => 14,
                1029 => 19,
                1030 => 19,
                7438 => 11,
                1031 => 14,
                1032 => 14,
                1035 => 13,
                1037 => 13,
                1038 => 13,
                1039 => 13,
                1040 => 13,
                1042 => 13,
                1043 => 13,
                1044 => 13,
                1045 => 6,
                1046 => 6,
                9267 => 18,
                9266 => 18,
                1047 => 6,
                1048 => 6,
                1049 => 6,
                1050 => 6,
                1051 => 6,
                7314 => 11,
                3586 => 9,
                3587 => 19,
                7680 => 5,
                1053 => 5,
                1054 => 5,
                1055 => 5,
                1056 => 5,
                1057 => 5,
                1058 => 5,
                8835 => 11,
                1059 => 5,
                1060 => 5,
                1061 => 5,
                7497 => 11,
                1062 => 5,
                1063 => 5,
                1064 => 5,
                1065 => 5,
                1066 => 5,
                1067 => 13,
                1068 => 13,
                1069 => 13,
                1070 => 13,
                1071 => 13,
                1072 => 13,
                1073 => 13,
                1074 => 13,
                1075 => 13,
                1076 => 13,
                1077 => 13,
                1078 => 13,
                1079 => 13,
                1080 => 13,
                1081 => 13,
                1082 => 4,
                1083 => 15,
                1084 => 19,
                1089 => 9,
                1090 => 9,
                1091 => 6,
                1093 => 6,
                1095 => 6,
                1096 => 6,
                1097 => 6,
                1099 => 6,
                1101 => 6,
                1102 => 6,
                1103 => 6,
                1106 => 15,
                1107 => 17,
                1109 => 17,
                1110 => 21,
                1111 => 15,
                1112 => 11,
                1113 => 17,
                1114 => 8,
                1118 => 19,
                1119 => 9,
                1120 => 12,
                1121 => 9,
                1122 => 12,
                8990 => 9,
                1123 => 13,
                1124 => 13,
                1125 => 13,
                1126 => 13,
                7496 => 11,
                1127 => 13,
                1128 => 13,
                4852 => 6,
                1129 => 13,
                7313 => 11,
                1130 => 13,
                1131 => 24,
                1132 => 24,
                1134 => 14,
                1135 => 14,
                1136 => 14,
                1137 => 14,
                1138 => 11,
                1139 => 11,
                1140 => 11,
                4611 => 15,
                1141 => 11,
                1142 => 11,
                1143 => 11,
                7311 => 11,
                4610 => 15,
                1144 => 11,
                1145 => 11,
                7495 => 11,
                1146 => 11,
                1147 => 11,
                1148 => 11,
                1149 => 11,
                1150 => 11,
                1151 => 11,
                1152 => 11,
                1153 => 11,
                1154 => 11,
                1155 => 11,
                1156 => 11,
                4598 => 6,
                1157 => 4,
                1158 => 11,
                1159 => 18,
                7309 => 19,
                1160 => 24,
                1161 => 11,
                1162 => 18,
                1163 => 18,
                1164 => 9,
                1165 => 9,
                1166 => 9,
                1167 => 9,
                4613 => 15,
                1168 => 18,
                1169 => 6,
                1170 => 19,
                7494 => 19,
                1171 => 11,
                1172 => 11,
                1173 => 9,
                1174 => 9,
                1175 => 11,
                1176 => 21,
                1179 => 5,
                1180 => 5,
                1181 => 5,
                1182 => 5,
                1183 => 5,
                1184 => 5,
                1185 => 5,
                1186 => 5,
                1187 => 5,
                7493 => 19,
                1188 => 21,
                1189 => 21,
                1190 => 21,
                1191 => 21,
                1192 => 21,
                1193 => 21,
                1194 => 21,
                1195 => 21,
                1196 => 21,
                1197 => 21,
                7308 => 19,
                1198 => 21,
                1199 => 21,
                1201 => 21,
                1202 => 21,
                1203 => 21,
                1204 => 21,
                1205 => 21,
                1206 => 21,
                1207 => 21,
                1208 => 21,
                1209 => 21,
                1210 => 21,
                1213 => 21,
                1214 => 21,
                1215 => 21,
                1218 => 21,
                1219 => 21,
                1220 => 21,
                1221 => 21,
                1222 => 21,
                1230 => 21,
                1231 => 21,
                1232 => 21,
                1233 => 21,
                1234 => 21,
                1235 => 21,
                1236 => 21,
                1239 => 21,
                1241 => 21,
                1242 => 21,
                8314 => 6,
                1245 => 11,
                1247 => 11,
                1250 => 11,
                1251 => 20,
                1252 => 15,
                1253 => 11,
                1260 => 11,
                1262 => 5,
                5660 => 18,
                5589 => 5,
                1263 => 12,
                3579 => 17,
                3580 => 17,
                3614 => 13,
                3611 => 14,
                3610 => 14,
                3609 => 6,
                3608 => 11,
                4603 => 9,
                3607 => 21,
                3606 => 5,
                2407 => 17,
                2412 => 5,
                2413 => 5,
                2418 => 15,
                7490 => 15,
                2421 => 6,
                2422 => 12,
                2423 => 16,
                2424 => 17,
                2425 => 17,
                2426 => 9,
                2427 => 19,
                2428 => 19,
                2429 => 19,
                2430 => 9,
                2431 => 19,
                2434 => 11,
                2435 => 11,
                2436 => 11,
                2437 => 11,
                2438 => 19,
                2439 => 11,
                7489 => 15,
                2440 => 11,
                2441 => 11,
                2443 => 11,
                4605 => 19,
                2444 => 11,
                2447 => 4,
                2449 => 9,
                2450 => 14,
                2452 => 19,
                2456 => 5,
                2458 => 5,
                2459 => 5,
                2461 => 13,
                2462 => 13,
                2464 => 9,
                8943 => 11,
                2468 => 9,
                2469 => 9,
                2471 => 9,
                2474 => 16,
                2476 => 17,
                2478 => 17,
                2479 => 17,
                2480 => 17,
                5645 => 5,
                2481 => 17,
                2482 => 11,
                2488 => 17,
                5577 => 11,
                2489 => 17,
                2491 => 17,
                7307 => 19,
                7305 => 20,
                2492 => 17,
                2493 => 17,
                2494 => 9,
                2495 => 9,
                2496 => 9,
                7488 => 15,
                2501 => 13,
                2502 => 19,
                2503 => 19,
                2504 => 13,
                2505 => 13,
                3605 => 14,
                3570 => 17,
                3612 => 5,
                3576 => 8,
                3569 => 17,
                2584 => 11,
                2586 => 11,
                2591 => 9,
                3581 => 15,
                3603 => 16,
                3601 => 8,
                3600 => 12,
                3599 => 11,
                3598 => 6,
                3602 => 6,
                3597 => 11,
                3596 => 14,
                3595 => 19,
                3594 => 19,
                2626 => 17,
                2629 => 17,
                3593 => 14,
                2634 => 19,
                2635 => 5,
                2636 => 5,
                2637 => 5,
                2638 => 5,
                2639 => 5,
                8842 => 11,
                2640 => 5,
                3583 => 12,
                2642 => 5,
                2643 => 9,
                2644 => 6,
                2645 => 13,
                2646 => 13,
                2647 => 13,
                2648 => 13,
                2649 => 13,
                2650 => 13,
                2651 => 13,
                2652 => 13,
                2653 => 13,
                2654 => 13,
                2655 => 13,
                2656 => 13,
                2657 => 9,
                2658 => 8,
                2659 => 19,
                2660 => 19,
                2661 => 14,
                2662 => 14,
                2663 => 14,
                2664 => 14,
                2665 => 19,
                2666 => 4,
                2667 => 4,
                2668 => 6,
                2669 => 11,
                2670 => 16,
                7455 => 19,
                8960 => 5,
                2671 => 11,
                2672 => 14,
                2673 => 12,
                2674 => 19,
                2675 => 13,
                2677 => 9,
                2678 => 6,
                2679 => 6,
                2680 => 6,
                2681 => 6,
                2682 => 16,
                2683 => 16,
                2684 => 16,
                2685 => 16,
                2686 => 16,
                2687 => 16,
                2688 => 16,
                2689 => 16,
                2690 => 16,
                2691 => 16,
                2692 => 16,
                2693 => 16,
                2695 => 17,
                2696 => 17,
                2697 => 17,
                2698 => 17,
                2699 => 17,
                2700 => 17,
                5455 => 20,
                2701 => 5,
                2702 => 5,
                2703 => 5,
                2704 => 12,
                2705 => 18,
                2706 => 6,
                2707 => 6,
                2708 => 6,
                2709 => 11,
                2710 => 4,
                2711 => 9,
                2712 => 9,
                4590 => 5,
                2713 => 19,
                7442 => 18,
                2714 => 21,
                2715 => 17,
                2716 => 9,
                2718 => 9,
                2719 => 9,
                2720 => 19,
                2721 => 9,
                7485 => 15,
                2722 => 9,
                2743 => 9,
                2742 => 20,
                3592 => 11,
                2756 => 11,
                7302 => 15,
                4612 => 15,
                2755 => 19,
                2727 => 11,
                2728 => 11,
                2729 => 11,
                4608 => 11,
                2730 => 11,
                2731 => 15,
                2732 => 19,
                7484 => 15,
                2733 => 15,
                2734 => 15,
                2735 => 15,
                7301 => 15,
                2736 => 18,
                2737 => 19,
                2738 => 12,
                2739 => 19,
                2744 => 9,
                2745 => 9,
                2746 => 15,
                2747 => 17,
                2748 => 18,
                3591 => 9,
                2750 => 13,
                2751 => 17,
                2752 => 5,
                2753 => 11,
                2754 => 17,
                2757 => 11,
                2758 => 9,
                7483 => 18,
                9170 => 11,
                2759 => 5,
                2760 => 13,
                2761 => 13,
                2762 => 6,
                2763 => 15,
                2765 => 9,
                2766 => 9,
                7300 => 15,
                5580 => 21,
                2767 => 9,
                2768 => 5,
                2769 => 20,
                2770 => 17,
                2771 => 17,
                2773 => 12,
                2775 => 9,
                2774 => 9,
                2776 => 9,
                2778 => 9,
                2779 => 20,
                2780 => 5,
                2781 => 11,
                2782 => 16,
                2783 => 16,
                2784 => 4,
                7441 => 19,
                2785 => 17,
                2786 => 8,
                2787 => 18,
                2789 => 5,
                2790 => 19,
                2791 => 6,
                2792 => 11,
                3585 => 12,
                2796 => 13,
                2802 => 19,
                2798 => 13,
                2799 => 11,
                7297 => 15,
                7324 => 15,
                2800 => 18,
                2801 => 19,
                2803 => 17,
                3616 => 17,
                2804 => 11,
                2805 => 12,
                2806 => 11,
                2807 => 18,
                2808 => 11,
                2809 => 11,
                2810 => 18,
                2811 => 5,
                2812 => 14,
                2813 => 4,
                2814 => 19,
                9206 => 9,
                7507 => 18,
                3574 => 19,
                7491 => 11,
                2817 => 17,
                2819 => 9,
                2820 => 4,
                2821 => 9,
                2822 => 19,
                2823 => 17,
                3567 => 9,
                2825 => 9,
                2826 => 17,
                2827 => 17,
                2828 => 13,
                2829 => 14,
                2830 => 17,
                2831 => 9,
                2832 => 5,
                2833 => 5,
                2834 => 5,
                2835 => 18,
                2836 => 6,
                2837 => 17,
                5644 => 5,
                9167 => 17,
                5562 => 15,
                2838 => 6,
                2839 => 16,
                2840 => 14,
                2841 => 21,
                2842 => 15,
                2843 => 17,
                2844 => 4,
                2845 => 5,
                7298 => 15,
                2846 => 12,
                2848 => 19,
                2849 => 11,
                2850 => 18,
                2851 => 19,
                2852 => 19,
                2854 => 11,
                2855 => 17,
                2856 => 17,
                2857 => 19,
                2858 => 16,
                2859 => 14,
                2860 => 8,
                2861 => 19,
                2865 => 15,
                2867 => 9,
                2868 => 19,
                2869 => 19,
                2870 => 19,
                2871 => 19,
                2872 => 19,
                2873 => 19,
                2874 => 11,
                2875 => 18,
                2876 => 9,
                2878 => 13,
                2879 => 14,
                2880 => 9,
                2881 => 9,
                2883 => 19,
                2884 => 9,
                2885 => 8,
                2887 => 6,
                2886 => 17,
                2888 => 20,
                2890 => 4,
                2891 => 9,
                2892 => 19,
                2893 => 19,
                2894 => 19,
                2896 => 15,
                2895 => 15,
                9076 => 8,
                3604 => 14,
                2899 => 9,
                2900 => 9,
                2901 => 9,
                2904 => 16,
                2905 => 16,
                2907 => 19,
                2908 => 11,
                2909 => 11,
                2910 => 17,
                2911 => 8,
                7299 => 15,
                2912 => 17,
                2913 => 11,
                2914 => 5,
                9019 => 19,
                2915 => 5,
                2916 => 5,
                2917 => 13,
                2919 => 16,
                2920 => 19,
                2921 => 19,
                7436 => 11,
                2922 => 19,
                2923 => 11,
                2924 => 13,
                2925 => 5,
                2926 => 17,
                2927 => 17,
                2928 => 17,
                2929 => 17,
                2930 => 13,
                2931 => 13,
                2932 => 18,
                2933 => 15,
                2934 => 13,
                2935 => 17,
                2936 => 13,
                7516 => 11,
                2937 => 13,
                2938 => 13,
                2941 => 17,
                2942 => 5,
                7709 => 20,
                7435 => 19,
                2952 => 13,
                2944 => 16,
                2945 => 5,
                2946 => 16,
                2947 => 16,
                2948 => 16,
                2949 => 16,
                7304 => 20,
                2950 => 15,
                2951 => 16,
                2953 => 18,
                2954 => 11,
                2955 => 11,
                2956 => 14,
                2957 => 16,
                2958 => 9,
                2959 => 19,
                2962 => 8,
                2963 => 13,
                2964 => 6,
                4601 => 6,
                2965 => 17,
                2966 => 16,
                2967 => 16,
                2968 => 16,
                2969 => 16,
                2970 => 17,
                2971 => 17,
                2972 => 11,
                2973 => 17,
                2974 => 19,
                2975 => 19,
                2976 => 11,
                2977 => 16,
                2978 => 16,
                2979 => 19,
                2980 => 13,
                2981 => 9,
                2982 => 11,
                2983 => 18,
                2984 => 14,
                2985 => 19,
                2986 => 6,
                2987 => 14,
                2988 => 5,
                2989 => 17,
                2990 => 17,
                2991 => 16,
                2992 => 16,
                8645 => 19,
                2993 => 16,
                2994 => 16,
                2996 => 16,
                2997 => 17,
                2998 => 17,
                2999 => 17,
                3000 => 17,
                3001 => 17,
                3002 => 17,
                3004 => 19,
                3003 => 18,
                3005 => 17,
                3006 => 5,
                3007 => 21,
                3008 => 21,
                3009 => 15,
                3010 => 17,
                3011 => 17,
                3012 => 17,
                3013 => 17,
                3014 => 17,
                3015 => 17,
                3016 => 17,
                3017 => 19,
                3019 => 18,
                3020 => 18,
                3021 => 17,
                3022 => 17,
                3023 => 17,
                3024 => 17,
                3025 => 16,
                3026 => 16,
                3027 => 6,
                3028 => 16,
                3029 => 16,
                3030 => 16,
                3031 => 16,
                3032 => 16,
                3033 => 16,
                3034 => 11,
                3582 => 15,
                3584 => 12,
                3037 => 17,
                3038 => 16,
                3039 => 13,
                3040 => 11,
                4592 => 5,
                3041 => 17,
                3042 => 19,
                3043 => 14,
                3044 => 14,
                3045 => 14,
                3046 => 14,
                3047 => 6,
                3048 => 17,
                3049 => 17,
                4150 => 17,
                3050 => 17,
                3051 => 17,
                3052 => 17,
                3053 => 21,
                3054 => 21,
                3055 => 21,
                3056 => 21,
                3057 => 13,
                5631 => 11,
                3063 => 19,
                3058 => 12,
                3059 => 17,
                7512 => 18,
                3060 => 19,
                3061 => 19,
                3064 => 9,
                3069 => 18,
                3068 => 18,
                3067 => 11,
                3070 => 20,
                3066 => 11,
                3065 => 13,
                9454 => 18,
                3071 => 4,
                3072 => 4,
                3073 => 16,
                3074 => 19,
                3571 => 17,
                3081 => 11,
                3079 => 11,
                3088 => 19,
                3102 => 17,
                3118 => 12,
                3080 => 9,
                3094 => 11,
                3083 => 14,
                3082 => 9,
                3086 => 13,
                9263 => 18,
                3084 => 14,
                3085 => 4,
                3087 => 9,
                5643 => 15,
                3089 => 9,
                3091 => 9,
                3266 => 19,
                3092 => 9,
                3117 => 9,
                3095 => 11,
                7716 => 11,
                3097 => 11,
                3098 => 11,
                3099 => 9,
                3100 => 9,
                3101 => 9,
                7377 => 19,
                3103 => 17,
                3104 => 17,
                3105 => 17,
                3106 => 17,
                3107 => 17,
                3108 => 16,
                3109 => 16,
                3110 => 16,
                3111 => 9,
                3112 => 9,
                3369 => 9,
                3113 => 9,
                3114 => 16,
                3115 => 6,
                8939 => 11,
                3116 => 19,
                7431 => 18,
                3119 => 9,
                3120 => 9,
                3121 => 17,
                3122 => 17,
                3123 => 17,
                3124 => 17,
                3125 => 19,
                3126 => 12,
                3129 => 12,
                3130 => 17,
                3131 => 17,
                3132 => 17,
                3133 => 11,
                3135 => 11,
                3136 => 9,
                3137 => 19,
                3138 => 11,
                3139 => 17,
                3140 => 16,
                7518 => 11,
                9082 => 15,
                3141 => 19,
                3143 => 8,
                5642 => 15,
                3142 => 17,
                3144 => 16,
                3145 => 19,
                3146 => 17,
                3147 => 8,
                3148 => 6,
                3149 => 14,
                3150 => 9,
                3151 => 9,
                3152 => 6,
                3153 => 12,
                3154 => 17,
                3157 => 18,
                3155 => 19,
                3156 => 5,
                3161 => 17,
                3158 => 11,
                3160 => 9,
                3159 => 17,
                3162 => 17,
                3164 => 11,
                3165 => 19,
                3166 => 19,
                3167 => 19,
                3168 => 19,
                4304 => 15,
                3169 => 12,
                3171 => 14,
                8918 => 11,
                3172 => 9,
                3173 => 18,
                3174 => 18,
                3175 => 9,
                3176 => 14,
                3177 => 12,
                3178 => 12,
                3179 => 12,
                7428 => 11,
                3181 => 19,
                3182 => 11,
                3183 => 19,
                3184 => 19,
                3185 => 19,
                3187 => 4,
                3188 => 4,
                3189 => 11,
                3190 => 6,
                3191 => 19,
                3192 => 19,
                3193 => 11,
                3207 => 19,
                3194 => 11,
                3195 => 5,
                3196 => 11,
                3197 => 11,
                3202 => 4,
                3198 => 13,
                3199 => 12,
                3203 => 4,
                3205 => 12,
                3206 => 19,
                3208 => 20,
                3209 => 16,
                3210 => 16,
                3212 => 4,
                3213 => 12,
                7427 => 11,
                3214 => 4,
                3215 => 4,
                3216 => 4,
                3217 => 17,
                3218 => 11,
                9189 => 9,
                7429 => 14,
                7889 => 18,
                3219 => 17,
                3221 => 9,
                3222 => 14,
                3223 => 21,
                3224 => 19,
                3225 => 19,
                3226 => 19,
                3227 => 21,
                7492 => 18,
                3228 => 13,
                3229 => 9,
                3230 => 9,
                3231 => 11,
                3235 => 13,
                3237 => 17,
                7425 => 11,
                3233 => 11,
                3234 => 21,
                3238 => 18,
                3239 => 12,
                3240 => 12,
                3258 => 19,
                3256 => 5,
                3248 => 5,
                3249 => 14,
                3251 => 11,
                3252 => 11,
                3254 => 11,
                3255 => 19,
                3259 => 9,
                3260 => 19,
                3261 => 11,
                3262 => 11,
                3263 => 9,
                3264 => 12,
                3265 => 17,
                3267 => 16,
                3268 => 19,
                3269 => 14,
                3270 => 11,
                3271 => 11,
                3272 => 5,
                3274 => 19,
                3275 => 21,
                3276 => 14,
                3277 => 14,
                3279 => 11,
                3280 => 9,
                3281 => 19,
                3282 => 12,
                3283 => 12,
                3284 => 5,
                3285 => 13,
                3287 => 18,
                3290 => 4,
                3288 => 19,
                3289 => 14,
                3292 => 11,
                7378 => 19,
                3293 => 13,
                3295 => 5,
                3294 => 5,
                3296 => 15,
                3297 => 19,
                3299 => 11,
                6978 => 5,
                3300 => 16,
                3302 => 5,
                3303 => 14,
                3305 => 15,
                3306 => 21,
                4360 => 21,
                3307 => 5,
                3309 => 5,
                3310 => 11,
                3312 => 9,
                3313 => 11,
                3314 => 11,
                8032 => 18,
                3316 => 11,
                3318 => 11,
                3317 => 9,
                7433 => 15,
                3319 => 5,
                3320 => 5,
                3321 => 5,
                3322 => 5,
                3323 => 5,
                3324 => 5,
                3325 => 17,
                3326 => 17,
                3327 => 17,
                3345 => 5,
                4364 => 21,
                3328 => 17,
                7422 => 11,
                3330 => 6,
                3331 => 21,
                3332 => 9,
                3333 => 9,
                6979 => 5,
                3334 => 9,
                3335 => 9,
                3336 => 9,
                3337 => 11,
                3338 => 11,
                3339 => 16,
                3340 => 16,
                3341 => 14,
                3342 => 5,
                3343 => 5,
                3344 => 5,
                3346 => 6,
                3347 => 11,
                3348 => 11,
                3349 => 21,
                7421 => 19,
                3350 => 11,
                3351 => 11,
                3353 => 15,
                6865 => 11,
                3356 => 14,
                3361 => 9,
                3363 => 18,
                3358 => 11,
                3359 => 11,
                3360 => 15,
                3362 => 19,
                3364 => 9,
                8191 => 5,
                3365 => 9,
                3367 => 16,
                3368 => 5,
                3372 => 18,
                3370 => 9,
                7420 => 19,
                6747 => 15,
                3371 => 19,
                3373 => 18,
                3374 => 11,
                3375 => 18,
                3376 => 18,
                3377 => 19,
                3378 => 19,
                3379 => 11,
                3380 => 18,
                3381 => 11,
                3383 => 19,
                3382 => 12,
                3384 => 5,
                3386 => 5,
                3387 => 21,
                3388 => 19,
                3389 => 24,
                3390 => 17,
                3391 => 14,
                3392 => 14,
                3393 => 14,
                3394 => 17,
                7419 => 19,
                3395 => 9,
                3396 => 9,
                3397 => 5,
                3401 => 16,
                3398 => 9,
                3399 => 21,
                3402 => 12,
                3403 => 19,
                3404 => 19,
                3405 => 19,
                3406 => 19,
                7418 => 19,
                3407 => 16,
                3411 => 19,
                3415 => 9,
                3416 => 9,
                3417 => 9,
                3418 => 12,
                3419 => 9,
                3420 => 21,
                3421 => 5,
                3452 => 5,
                3424 => 17,
                3423 => 11,
                3422 => 18,
                3425 => 17,
                3426 => 17,
                3427 => 17,
                3428 => 17,
                3429 => 17,
                3430 => 17,
                3431 => 17,
                3432 => 17,
                3433 => 17,
                3434 => 17,
                3435 => 17,
                3436 => 17,
                3437 => 17,
                3438 => 17,
                3439 => 17,
                3440 => 17,
                3441 => 17,
                3442 => 17,
                3443 => 17,
                3444 => 17,
                3445 => 17,
                3446 => 17,
                3447 => 17,
                5641 => 11,
                3448 => 17,
                3449 => 17,
                3450 => 17,
                3453 => 5,
                3454 => 5,
                3455 => 5,
                3456 => 5,
                3457 => 5,
                3459 => 5,
                3460 => 5,
                3461 => 5,
                3462 => 5,
                3463 => 5,
                3464 => 5,
                3465 => 5,
                3466 => 5,
                3470 => 19,
                3467 => 13,
                3468 => 19,
                3469 => 11,
                3471 => 9,
                3472 => 16,
                3473 => 16,
                3572 => 17,
                3475 => 9,
                3476 => 9,
                3477 => 5,
                3478 => 5,
                3479 => 11,
                3480 => 14,
                3481 => 9,
                4591 => 5,
                3482 => 9,
                6695 => 18,
                3483 => 5,
                3484 => 11,
                3485 => 6,
                3486 => 6,
                3488 => 5,
                3489 => 11,
                3490 => 5,
                3491 => 9,
                3493 => 11,
                3492 => 11,
                3494 => 5,
                3495 => 8,
                3496 => 4,
                3497 => 11,
                3498 => 17,
                3500 => 11,
                3501 => 11,
                3503 => 11,
                3510 => 5,
                3590 => 14,
                3589 => 14,
                3588 => 11,
                6981 => 5,
                3515 => 21,
                3519 => 17,
                3511 => 19,
                3512 => 21,
                3514 => 9,
                3522 => 19,
                3516 => 17,
                3517 => 9,
                3518 => 11,
                3520 => 17,
                3521 => 17,
                3526 => 14,
                3524 => 11,
                3525 => 19,
                3527 => 6,
                3528 => 6,
                3529 => 6,
                3530 => 13,
                3531 => 4,
                3532 => 14,
                3533 => 18,
                3534 => 14,
                7416 => 15,
                3535 => 18,
                3536 => 19,
                3537 => 19,
                3538 => 6,
                7695 => 18,
                6980 => 5,
                3539 => 11,
                3540 => 19,
                3543 => 11,
                3548 => 15,
                3544 => 11,
                3545 => 11,
                3550 => 17,
                3542 => 21,
                3541 => 19,
                3551 => 9,
                3546 => 6,
                3552 => 5,
                3547 => 8,
                3553 => 21,
                3554 => 11,
                3555 => 17,
                3556 => 17,
                3560 => 11,
                3557 => 17,
                3558 => 19,
                3559 => 12,
                3561 => 21,
                3562 => 17,
                3564 => 16,
                3568 => 12,
                3575 => 11,
                3573 => 12,
                3566 => 14,
                3577 => 13,
                3617 => 19,
                3618 => 4,
                3619 => 9,
                3620 => 9,
                3621 => 16,
                3622 => 15,
                3627 => 14,
                3624 => 14,
                6765 => 9,
                3625 => 17,
                3626 => 17,
                3648 => 19,
                3628 => 14,
                3629 => 12,
                3630 => 20,
                3631 => 14,
                3632 => 5,
                3639 => 17,
                3646 => 20,
                3633 => 17,
                3634 => 17,
                3635 => 17,
                3636 => 17,
                3637 => 17,
                3638 => 17,
                3640 => 17,
                3641 => 17,
                3642 => 17,
                3643 => 17,
                3644 => 17,
                3645 => 17,
                3647 => 17,
                3649 => 14,
                3650 => 17,
                3651 => 6,
                3652 => 11,
                3653 => 20,
                3687 => 14,
                6764 => 9,
                3654 => 5,
                3655 => 4,
                3656 => 4,
                3657 => 9,
                3682 => 9,
                7415 => 19,
                3678 => 9,
                3658 => 9,
                3659 => 9,
                3660 => 9,
                3661 => 9,
                3662 => 9,
                7414 => 19,
                3663 => 9,
                3664 => 9,
                3665 => 9,
                3666 => 9,
                3667 => 9,
                3668 => 9,
                3669 => 9,
                3670 => 9,
                3671 => 9,
                3672 => 9,
                3673 => 9,
                3674 => 9,
                3675 => 9,
                7412 => 19,
                3676 => 9,
                3677 => 9,
                3679 => 9,
                3680 => 9,
                3681 => 9,
                7411 => 19,
                3683 => 9,
                3684 => 9,
                3685 => 9,
                3686 => 9,
                3688 => 9,
                3689 => 9,
                3690 => 9,
                7410 => 19,
                6762 => 15,
                3691 => 9,
                3692 => 9,
                3693 => 15,
                3694 => 9,
                7667 => 21,
                3695 => 9,
                3696 => 9,
                8051 => 11,
                3697 => 9,
                3698 => 9,
                3699 => 9,
                3700 => 12,
                3701 => 9,
                3702 => 9,
                3703 => 16,
                3704 => 16,
                3705 => 16,
                3706 => 16,
                3707 => 11,
                3708 => 5,
                3709 => 11,
                3710 => 11,
                3711 => 11,
                3712 => 11,
                3713 => 11,
                3714 => 20,
                3715 => 12,
                3716 => 11,
                3728 => 5,
                8913 => 15,
                3717 => 5,
                3718 => 17,
                3719 => 17,
                3720 => 17,
                3721 => 17,
                3722 => 17,
                3723 => 17,
                3724 => 17,
                3725 => 17,
                3726 => 14,
                7719 => 18,
                3727 => 9,
                6761 => 15,
                7717 => 5,
                3729 => 4,
                3730 => 9,
                3731 => 9,
                3732 => 9,
                7413 => 19,
                9028 => 9,
                7409 => 19,
                3733 => 9,
                5640 => 21,
                3734 => 9,
                3735 => 9,
                3736 => 9,
                3737 => 9,
                3738 => 9,
                3739 => 5,
                3740 => 5,
                3743 => 19,
                3749 => 19,
                3745 => 19,
                3750 => 11,
                8668 => 9,
                3741 => 13,
                7408 => 19,
                3744 => 13,
                6760 => 15,
                3742 => 13,
                3759 => 14,
                3747 => 18,
                3746 => 15,
                3748 => 19,
                3751 => 18,
                3752 => 16,
                3753 => 16,
                3754 => 6,
                3755 => 6,
                3756 => 6,
                3757 => 6,
                3758 => 6,
                3760 => 20,
                3765 => 7,
                3761 => 13,
                3763 => 11,
                3762 => 5,
                3764 => 13,
                7407 => 11,
                3769 => 14,
                3768 => 5,
                3770 => 13,
                3771 => 13,
                3772 => 18,
                3773 => 9,
                3774 => 24,
                3775 => 24,
                3776 => 24,
                7406 => 18,
                3777 => 24,
                3778 => 24,
                3779 => 24,
                3780 => 24,
                3781 => 24,
                3782 => 24,
                3783 => 24,
                7405 => 19,
                3784 => 24,
                3785 => 24,
                3786 => 24,
                3787 => 24,
                3788 => 5,
                3789 => 5,
                6758 => 15,
                3790 => 5,
                3791 => 5,
                3792 => 17,
                3793 => 17,
                3838 => 5,
                3794 => 17,
                3795 => 17,
                3796 => 5,
                3797 => 5,
                3798 => 5,
                3799 => 5,
                7403 => 19,
                6757 => 15,
                3800 => 17,
                3801 => 17,
                3802 => 17,
                8054 => 6,
                3803 => 9,
                3804 => 21,
                3805 => 9,
                3806 => 9,
                3807 => 15,
                3808 => 17,
                3809 => 5,
                3810 => 5,
                3811 => 17,
                3812 => 17,
                3813 => 17,
                3814 => 5,
                3815 => 5,
                3816 => 17,
                3817 => 5,
                3818 => 17,
                3819 => 5,
                3820 => 17,
                3821 => 17,
                3822 => 17,
                3823 => 5,
                7400 => 14,
                3824 => 17,
                3825 => 5,
                3826 => 5,
                3827 => 17,
                3828 => 17,
                5639 => 21,
                3829 => 17,
                3830 => 17,
                3831 => 5,
                3832 => 5,
                8881 => 12,
                8839 => 9,
                6755 => 15,
                3835 => 17,
                3836 => 17,
                3834 => 17,
                3837 => 17,
                3839 => 5,
                3840 => 5,
                3841 => 5,
                7398 => 20,
                3842 => 5,
                3843 => 17,
                5460 => 17,
                3844 => 5,
                3845 => 17,
                3846 => 17,
                6754 => 15,
                3847 => 5,
                3848 => 5,
                9079 => 15,
                3849 => 18,
                3850 => 5,
                3851 => 5,
                3852 => 5,
                3853 => 5,
                3854 => 5,
                3855 => 5,
                3856 => 5,
                8225 => 21,
                3857 => 5,
                3858 => 5,
                3859 => 5,
                3860 => 5,
                3861 => 5,
                7397 => 20,
                3862 => 5,
                3863 => 5,
                3864 => 5,
                3865 => 5,
                3866 => 5,
                3867 => 15,
                3868 => 15,
                3869 => 5,
                3870 => 5,
                3871 => 5,
                3872 => 5,
                3873 => 5,
                7510 => 15,
                3874 => 15,
                7396 => 20,
                3875 => 15,
                6763 => 9,
                3876 => 15,
                4595 => 9,
                3877 => 15,
                3878 => 15,
                3879 => 15,
                3880 => 15,
                3881 => 15,
                3882 => 5,
                7395 => 20,
                3883 => 15,
                3884 => 5,
                3885 => 15,
                3886 => 15,
                3887 => 5,
                3888 => 15,
                3889 => 5,
                3890 => 15,
                3891 => 15,
                3892 => 6,
                3893 => 5,
                3894 => 5,
                3895 => 5,
                3896 => 5,
                5630 => 19,
                3897 => 5,
                3898 => 5,
                7394 => 20,
                3899 => 5,
                3900 => 5,
                3901 => 5,
                3902 => 5,
                3903 => 5,
                3904 => 5,
                3914 => 21,
                3905 => 21,
                3906 => 21,
                3907 => 21,
                3908 => 21,
                3909 => 21,
                3910 => 21,
                3911 => 21,
                3912 => 21,
                3913 => 21,
                3915 => 21,
                3916 => 21,
                3917 => 21,
                3918 => 21,
                8936 => 18,
                3919 => 21,
                3920 => 21,
                3921 => 21,
                3922 => 21,
                3923 => 21,
                6748 => 15,
                3924 => 21,
                3925 => 21,
                4070 => 18,
                3926 => 21,
                3941 => 15,
                3927 => 21,
                6749 => 15,
                3928 => 21,
                3940 => 13,
                3939 => 15,
                3938 => 18,
                3937 => 18,
                7432 => 15,
                3936 => 18,
                8923 => 15,
                4616 => 21,
                3929 => 21,
                3930 => 21,
                3931 => 5,
                6750 => 15,
                3932 => 5,
                3933 => 5,
                3934 => 5,
                3935 => 5,
                3942 => 15,
                3943 => 15,
                3944 => 15,
                3945 => 15,
                3946 => 15,
                6751 => 15,
                3947 => 15,
                3948 => 15,
                3949 => 15,
                3950 => 15,
                3951 => 15,
                3952 => 15,
                4753 => 15,
                3954 => 15,
                3955 => 15,
                6752 => 15,
                3956 => 15,
                3957 => 15,
                3958 => 15,
                3959 => 15,
                3960 => 15,
                3961 => 15,
                3962 => 15,
                6753 => 15,
                3963 => 15,
                6925 => 15,
                5657 => 5,
                3968 => 14,
                4007 => 5,
                3964 => 15,
                3965 => 15,
                3966 => 15,
                9308 => 21,
                7392 => 11,
                3967 => 15,
                9081 => 15,
                3969 => 14,
                3970 => 14,
                3971 => 14,
                3972 => 14,
                3973 => 14,
                3974 => 14,
                3975 => 14,
                3976 => 14,
                3977 => 14,
                3978 => 14,
                3979 => 14,
                7391 => 11,
                3980 => 14,
                3981 => 14,
                3982 => 14,
                3983 => 14,
                3984 => 14,
                3985 => 13,
                3986 => 13,
                3987 => 13,
                3988 => 14,
                4037 => 9,
                4008 => 15,
                4043 => 5,
                4045 => 21,
                4072 => 15,
                3993 => 21,
                4076 => 21,
                3990 => 9,
                3991 => 19,
                4035 => 15,
                3992 => 6,
                4036 => 20,
                3994 => 21,
                3995 => 21,
                3996 => 21,
                7390 => 11,
                3997 => 21,
                3998 => 21,
                4589 => 5,
                3999 => 21,
                4000 => 5,
                4001 => 9,
                4002 => 15,
                7504 => 15,
                4003 => 15,
                4004 => 15,
                4005 => 15,
                4006 => 21,
                4009 => 12,
                4010 => 12,
                4011 => 12,
                4012 => 5,
                7389 => 11,
                4013 => 18,
                4044 => 5,
                4014 => 14,
                4015 => 6,
                4016 => 9,
                4017 => 9,
                4018 => 9,
                4019 => 9,
                4020 => 9,
                4021 => 9,
                4022 => 9,
                4023 => 9,
                4024 => 9,
                4025 => 9,
                4026 => 9,
                4027 => 9,
                4030 => 21,
                4031 => 21,
                4032 => 15,
                6690 => 9,
                4594 => 15,
                4033 => 11,
                4034 => 18,
                4038 => 6,
                4039 => 6,
                4040 => 6,
                4041 => 6,
                4042 => 6,
                4046 => 21,
                4047 => 21,
                4048 => 21,
                4049 => 15,
                4050 => 15,
                4051 => 9,
                4052 => 9,
                4053 => 9,
                4054 => 9,
                4055 => 9,
                4056 => 4,
                4057 => 15,
                4058 => 15,
                4059 => 6,
                4060 => 21,
                4061 => 5,
                4074 => 15,
                4075 => 19,
                4071 => 19,
                4062 => 15,
                4073 => 17,
                4063 => 11,
                4064 => 11,
                4065 => 11,
                4066 => 11,
                4067 => 21,
                4068 => 5,
                4069 => 21,
                8915 => 11,
                6694 => 15,
                4078 => 19,
                4085 => 21,
                4112 => 20,
                4102 => 11,
                4106 => 21,
                4091 => 5,
                4083 => 17,
                4081 => 17,
                4093 => 5,
                4079 => 19,
                7467 => 9,
                4082 => 17,
                4087 => 19,
                4086 => 21,
                4080 => 17,
                4111 => 11,
                4094 => 5,
                4084 => 19,
                7554 => 21,
                4101 => 11,
                4100 => 11,
                4104 => 12,
                4096 => 21,
                4089 => 12,
                4097 => 6,
                4077 => 5,
                4103 => 12,
                7461 => 18,
                4095 => 21,
                4099 => 15,
                7388 => 11,
                6693 => 21,
                7710 => 20,
                4090 => 14,
                4098 => 19,
                4088 => 5,
                4092 => 5,
                4105 => 21,
                4110 => 5,
                4107 => 11,
                4108 => 11,
                4109 => 11,
                4113 => 15,
                4114 => 11,
                4115 => 11,
                4116 => 11,
                4117 => 19,
                4124 => 19,
                4125 => 21,
                4129 => 15,
                4138 => 21,
                4120 => 19,
                4127 => 16,
                4118 => 9,
                4119 => 21,
                4121 => 19,
                4122 => 13,
                4123 => 13,
                4126 => 6,
                7460 => 11,
                4140 => 5,
                4128 => 11,
                4134 => 21,
                4130 => 15,
                4131 => 15,
                4132 => 15,
                4133 => 11,
                6691 => 9,
                4135 => 21,
                4136 => 21,
                4137 => 21,
                4139 => 21,
                4141 => 15,
                7459 => 15,
                4142 => 15,
                4143 => 21,
                4144 => 5,
                7387 => 5,
                4467 => 21,
                4468 => 19,
                4888 => 21,
                4166 => 15,
                4175 => 5,
                4171 => 11,
                4145 => 14,
                4179 => 24,
                4159 => 5,
                4181 => 21,
                4158 => 17,
                4185 => 15,
                4169 => 15,
                4146 => 14,
                4147 => 17,
                4148 => 17,
                4149 => 17,
                4151 => 17,
                4153 => 16,
                4152 => 11,
                7458 => 11,
                4154 => 16,
                4155 => 16,
                4156 => 16,
                4157 => 16,
                4160 => 5,
                4161 => 14,
                4162 => 21,
                4163 => 21,
                4164 => 21,
                4165 => 21,
                4167 => 5,
                4168 => 5,
                4170 => 15,
                4174 => 15,
                4172 => 11,
                4173 => 11,
                4176 => 5,
                4177 => 5,
                4178 => 5,
                4180 => 24,
                4182 => 9,
                4183 => 19,
                4184 => 5,
                4186 => 15,
                4187 => 15,
                4188 => 15,
                4189 => 15,
                4190 => 15,
                4191 => 15,
                4194 => 5,
                4193 => 15,
                4195 => 5,
                4192 => 15,
                4197 => 21,
                4198 => 21,
                4199 => 6,
                4200 => 5,
                4201 => 5,
                4202 => 5,
                4203 => 5,
                4204 => 5,
                4219 => 11,
                6688 => 21,
                4205 => 21,
                4206 => 21,
                7401 => 19,
                4207 => 21,
                4223 => 21,
                4208 => 11,
                4209 => 11,
                4210 => 11,
                4211 => 11,
                4212 => 11,
                4213 => 11,
                4214 => 11,
                4274 => 21,
                4215 => 19,
                4216 => 12,
                4217 => 15,
                4218 => 15,
                9139 => 11,
                4363 => 21,
                4220 => 5,
                4221 => 21,
                4222 => 21,
                4224 => 21,
                4225 => 21,
                4226 => 21,
                4227 => 21,
                4353 => 11,
                4228 => 21,
                4229 => 21,
                4230 => 21,
                4231 => 21,
                4257 => 21,
                4261 => 21,
                4232 => 21,
                4233 => 21,
                4234 => 21,
                4235 => 21,
                4267 => 21,
                4236 => 21,
                4237 => 21,
                4238 => 21,
                4239 => 21,
                4240 => 21,
                4241 => 21,
                4242 => 15,
                4243 => 15,
                4244 => 15,
                4245 => 15,
                4246 => 15,
                4372 => 20,
                4247 => 15,
                4248 => 15,
                4249 => 15,
                4250 => 15,
                4251 => 15,
                4252 => 15,
                4253 => 15,
                4254 => 21,
                4255 => 21,
                4256 => 21,
                4258 => 21,
                4259 => 21,
                4260 => 21,
                4262 => 21,
                4263 => 21,
                4264 => 21,
                7454 => 19,
                4265 => 21,
                4266 => 21,
                4268 => 21,
                4269 => 21,
                4270 => 21,
                4271 => 21,
                4272 => 21,
                4352 => 11,
                4273 => 21,
                4275 => 21,
                4276 => 21,
                4277 => 21,
                4278 => 21,
                4279 => 21,
                6684 => 15,
                4280 => 21,
                4281 => 5,
                4282 => 21,
                4283 => 21,
                4284 => 21,
                4285 => 21,
                7453 => 19,
                4286 => 21,
                4287 => 21,
                4288 => 11,
                4289 => 11,
                4290 => 11,
                4291 => 11,
                4293 => 15,
                4294 => 5,
                4369 => 21,
                6683 => 15,
                4359 => 21,
                4361 => 21,
                7449 => 19,
                4308 => 9,
                4312 => 11,
                4313 => 11,
                4303 => 20,
                4302 => 21,
                4295 => 21,
                4296 => 21,
                4297 => 21,
                4298 => 15,
                4299 => 15,
                4300 => 15,
                4301 => 15,
                6681 => 15,
                4305 => 15,
                4306 => 15,
                4307 => 15,
                4351 => 11,
                4356 => 11,
                4355 => 11,
                4309 => 17,
                4310 => 19,
                4311 => 19,
                4409 => 6,
                4317 => 21,
                4318 => 21,
                4319 => 21,
                4320 => 15,
                6680 => 15,
                4321 => 6,
                4322 => 6,
                4323 => 6,
                4324 => 21,
                4368 => 21,
                4357 => 16,
                4335 => 21,
                4336 => 21,
                4337 => 21,
                4373 => 21,
                4350 => 21,
                4390 => 5,
                4410 => 5,
                4338 => 21,
                4339 => 21,
                4340 => 21,
                4341 => 21,
                4342 => 21,
                4343 => 21,
                4344 => 15,
                4345 => 15,
                4346 => 12,
                4347 => 15,
                4348 => 15,
                4349 => 15,
                4365 => 21,
                4371 => 15,
                4354 => 11,
                4326 => 15,
                4370 => 5,
                4362 => 21,
                4358 => 21,
                4377 => 6,
                4325 => 21,
                4327 => 15,
                6677 => 11,
                4328 => 15,
                4329 => 15,
                6678 => 9,
                8937 => 5,
                4330 => 15,
                4331 => 15,
                4332 => 15,
                4333 => 5,
                4334 => 6,
                4374 => 21,
                4375 => 21,
                4376 => 5,
                4378 => 5,
                4379 => 21,
                4389 => 15,
                4380 => 15,
                5586 => 5,
                4381 => 11,
                4382 => 5,
                4383 => 11,
                6676 => 11,
                4384 => 5,
                4385 => 21,
                4386 => 21,
                4387 => 20,
                4388 => 20,
                4406 => 21,
                4412 => 5,
                4427 => 8,
                4394 => 19,
                4442 => 21,
                4391 => 15,
                4392 => 6,
                4393 => 18,
                4395 => 19,
                4396 => 18,
                4397 => 14,
                4398 => 9,
                4399 => 9,
                4400 => 5,
                4401 => 20,
                4403 => 21,
                4404 => 21,
                4405 => 21,
                4407 => 21,
                4408 => 21,
                4437 => 15,
                4411 => 21,
                4413 => 6,
                4414 => 6,
                4415 => 6,
                4416 => 6,
                4417 => 6,
                4418 => 6,
                4419 => 6,
                4420 => 6,
                4421 => 6,
                4422 => 6,
                4423 => 6,
                4424 => 6,
                4425 => 6,
                4426 => 6,
                4428 => 8,
                4429 => 8,
                4430 => 8,
                4431 => 8,
                4432 => 8,
                4433 => 8,
                4434 => 8,
                4435 => 17,
                4436 => 17,
                4438 => 15,
                4439 => 21,
                6675 => 11,
                4440 => 15,
                4441 => 6,
                4443 => 21,
                4444 => 14,
                4445 => 21,
                4446 => 15,
                4447 => 15,
                4448 => 15,
                4449 => 15,
                4450 => 14,
                4466 => 21,
                4451 => 7,
                4452 => 5,
                4453 => 5,
                4454 => 5,
                6674 => 11,
                4455 => 5,
                4456 => 5,
                4457 => 5,
                4458 => 5,
                4459 => 21,
                4460 => 15,
                4461 => 14,
                4463 => 11,
                4462 => 18,
                7452 => 19,
                4464 => 11,
                4465 => 11,
                4469 => 21,
                4470 => 15,
                4471 => 21,
                7385 => 20,
                4472 => 20,
                4473 => 15,
                4474 => 15,
                4475 => 15,
                4476 => 15,
                4477 => 15,
                4478 => 15,
                4479 => 15,
                4480 => 15,
                4481 => 5,
                4482 => 21,
                4483 => 11,
                4484 => 11,
                4485 => 21,
                4486 => 6,
                4487 => 15,
                4536 => 20,
                6685 => 21,
                4488 => 21,
                4497 => 17,
                4490 => 6,
                4532 => 21,
                4528 => 5,
                4491 => 6,
                4492 => 6,
                4493 => 11,
                4494 => 11,
                4495 => 11,
                4496 => 11,
                4498 => 11,
                4499 => 11,
                4500 => 19,
                4501 => 6,
                4502 => 5,
                4503 => 5,
                4504 => 5,
                4505 => 5,
                4506 => 5,
                4507 => 5,
                4508 => 5,
                4509 => 5,
                4510 => 5,
                4511 => 5,
                4512 => 5,
                4513 => 5,
                4514 => 5,
                4515 => 5,
                4516 => 11,
                4517 => 11,
                4518 => 11,
                4519 => 11,
                4520 => 11,
                4521 => 11,
                4522 => 11,
                4523 => 11,
                4524 => 11,
                4525 => 11,
                4526 => 11,
                4527 => 11,
                4529 => 5,
                4530 => 5,
                4531 => 21,
                4533 => 21,
                4534 => 15,
                4535 => 15,
                4537 => 21,
                6672 => 18,
                4538 => 21,
                4539 => 15,
                4540 => 5,
                4541 => 5,
                7384 => 19,
                4542 => 15,
                4543 => 15,
                4544 => 5,
                4545 => 6,
                4546 => 15,
                4547 => 18,
                6679 => 15,
                4548 => 9,
                4549 => 19,
                4550 => 9,
                4902 => 5,
                4551 => 21,
                4552 => 5,
                4553 => 5,
                4554 => 5,
                4555 => 5,
                4556 => 5,
                4557 => 5,
                4558 => 5,
                4559 => 5,
                4560 => 5,
                4561 => 5,
                4562 => 5,
                4563 => 5,
                4564 => 5,
                7383 => 19,
                4565 => 5,
                6671 => 21,
                4566 => 5,
                8875 => 15,
                4567 => 5,
                4568 => 5,
                4569 => 5,
                4570 => 5,
                4571 => 5,
                4572 => 15,
                4573 => 15,
                4574 => 6,
                4575 => 5,
                4576 => 5,
                4577 => 11,
                4578 => 11,
                4606 => 11,
                4604 => 6,
                4602 => 9,
                4579 => 15,
                4580 => 20,
                4617 => 15,
                4581 => 11,
                4582 => 11,
                4583 => 11,
                4584 => 21,
                4585 => 15,
                4586 => 9,
                4587 => 12,
                4588 => 12,
                4618 => 6,
                4619 => 6,
                4620 => 15,
                4621 => 15,
                4641 => 21,
                4647 => 6,
                7662 => 11,
                7382 => 19,
                4648 => 6,
                4656 => 5,
                4624 => 9,
                4622 => 6,
                4646 => 7,
                4623 => 15,
                4625 => 6,
                4629 => 11,
                4626 => 6,
                4627 => 6,
                4628 => 6,
                4630 => 11,
                4631 => 11,
                4632 => 11,
                4633 => 11,
                4634 => 11,
                4635 => 11,
                4636 => 11,
                4637 => 11,
                4638 => 11,
                4639 => 11,
                4640 => 11,
                4642 => 21,
                4643 => 21,
                4644 => 21,
                4645 => 21,
                4649 => 6,
                4650 => 6,
                7303 => 15,
                4651 => 6,
                8159 => 15,
                4652 => 9,
                4653 => 5,
                4654 => 5,
                4655 => 5,
                4657 => 5,
                4658 => 5,
                4660 => 21,
                4659 => 15,
                4671 => 21,
                4661 => 21,
                4662 => 15,
                4663 => 15,
                4664 => 15,
                4667 => 5,
                4665 => 6,
                4678 => 5,
                4668 => 15,
                4669 => 5,
                4672 => 21,
                4673 => 21,
                4674 => 21,
                4675 => 21,
                4676 => 21,
                4677 => 21,
                4679 => 21,
                4680 => 5,
                7381 => 19,
                4702 => 15,
                4720 => 21,
                4698 => 15,
                4732 => 6,
                4681 => 20,
                4699 => 17,
                4682 => 17,
                4683 => 20,
                4684 => 20,
                4685 => 21,
                4690 => 4,
                4695 => 5,
                5556 => 5,
                4686 => 18,
                4687 => 18,
                4688 => 18,
                4689 => 18,
                4691 => 5,
                4704 => 11,
                4692 => 6,
                4693 => 21,
                4694 => 21,
                4696 => 15,
                4697 => 5,
                4700 => 18,
                7380 => 19,
                4701 => 18,
                4703 => 11,
                4705 => 15,
                4706 => 5,
                4707 => 20,
                4708 => 5,
                4709 => 5,
                4710 => 15,
                4711 => 15,
                4712 => 18,
                4713 => 18,
                4714 => 15,
                4715 => 15,
                4716 => 15,
                4717 => 15,
                4718 => 15,
                4719 => 15,
                4721 => 6,
                4722 => 6,
                4723 => 15,
                4724 => 19,
                4725 => 19,
                4726 => 20,
                4727 => 20,
                4728 => 6,
                4734 => 15,
                4733 => 5,
                4735 => 5,
                4729 => 11,
                4742 => 15,
                4744 => 20,
                4730 => 9,
                4731 => 18,
                4736 => 15,
                4737 => 11,
                4738 => 15,
                4739 => 15,
                4740 => 15,
                7520 => 11,
                4741 => 24,
                4743 => 15,
                4745 => 18,
                4746 => 11,
                4747 => 11,
                4748 => 24,
                4749 => 21,
                4750 => 6,
                4756 => 21,
                4751 => 15,
                4752 => 15,
                4754 => 15,
                4755 => 18,
                4757 => 21,
                4758 => 11,
                4759 => 11,
                4760 => 11,
                4761 => 11,
                4762 => 11,
                4763 => 21,
                4764 => 21,
                4765 => 15,
                4766 => 15,
                4767 => 15,
                4768 => 15,
                4769 => 15,
                4770 => 15,
                4771 => 20,
                4772 => 21,
                4773 => 11,
                4774 => 15,
                4775 => 20,
                7376 => 15,
                4776 => 20,
                6669 => 19,
                4777 => 18,
                4778 => 18,
                4779 => 18,
                4780 => 5,
                4932 => 14,
                4926 => 19,
                4795 => 11,
                4853 => 6,
                4868 => 20,
                4796 => 15,
                4948 => 15,
                4930 => 19,
                4923 => 19,
                4782 => 11,
                4928 => 19,
                4925 => 19,
                4787 => 18,
                4872 => 15,
                4865 => 11,
                4783 => 11,
                4871 => 18,
                4933 => 5,
                4781 => 12,
                4939 => 11,
                4784 => 11,
                4785 => 11,
                4786 => 11,
                4789 => 5,
                4790 => 5,
                4788 => 15,
                4791 => 15,
                4792 => 6,
                4793 => 21,
                7439 => 15,
                4794 => 16,
                4797 => 15,
                4798 => 15,
                4799 => 15,
                4800 => 15,
                4936 => 5,
                4951 => 5,
                4950 => 15,
                4859 => 6,
                4901 => 5,
                4861 => 15,
                4937 => 14,
                4849 => 21,
                4807 => 5,
                4842 => 14,
                4844 => 14,
                4867 => 11,
                4857 => 15,
                7451 => 11,
                4874 => 15,
                4921 => 15,
                4854 => 6,
                4845 => 15,
                4929 => 19,
                4801 => 12,
                4803 => 11,
                4802 => 16,
                4804 => 11,
                4805 => 11,
                4806 => 15,
                4940 => 20,
                4905 => 19,
                4829 => 15,
                4812 => 15,
                4816 => 5,
                4815 => 5,
                4895 => 6,
                4851 => 11,
                4843 => 14,
                4862 => 11,
                4860 => 6,
                4856 => 15,
                4824 => 20,
                4855 => 20,
                4848 => 24,
                7450 => 11,
                8872 => 11,
                4949 => 15,
                4847 => 24,
                4999 => 15,
                4863 => 11,
                4864 => 11,
                4810 => 5,
                4808 => 5,
                4809 => 5,
                8972 => 5,
                4866 => 11,
                4858 => 15,
                4811 => 19,
                4813 => 15,
                4817 => 15,
                4814 => 15,
                4818 => 15,
                4819 => 5,
                4870 => 19,
                4927 => 19,
                5000 => 15,
                4820 => 16,
                7524 => 11,
                4850 => 15,
                4869 => 11,
                4846 => 11,
                4821 => 12,
                4822 => 15,
                4823 => 15,
                4825 => 5,
                4826 => 5,
                4827 => 15,
                4828 => 15,
                4830 => 9,
                4831 => 20,
                4832 => 9,
                4833 => 21,
                4834 => 18,
                4835 => 18,
                4836 => 15,
                4837 => 15,
                4838 => 15,
                4839 => 15,
                4840 => 15,
                4841 => 15,
                4873 => 15,
                4875 => 15,
                4876 => 15,
                4877 => 15,
                4878 => 15,
                4912 => 19,
                4906 => 19,
                4918 => 19,
                4915 => 19,
                4882 => 15,
                4938 => 14,
                4924 => 19,
                4881 => 21,
                4943 => 20,
                4941 => 19,
                4914 => 19,
                4919 => 19,
                4922 => 15,
                4942 => 20,
                4913 => 19,
                4920 => 19,
                4908 => 19,
                4931 => 19,
                4900 => 21,
                4935 => 5,
                4909 => 19,
                4916 => 19,
                4910 => 19,
                4903 => 5,
                4934 => 5,
                4911 => 19,
                4907 => 19,
                4879 => 16,
                4880 => 12,
                4883 => 15,
                4884 => 15,
                4885 => 15,
                4886 => 15,
                4899 => 15,
                4887 => 11,
                4889 => 21,
                4890 => 11,
                4891 => 11,
                4892 => 11,
                4894 => 21,
                4893 => 5,
                8831 => 11,
                4979 => 11,
                4896 => 15,
                4904 => 5,
                4897 => 15,
                4898 => 15,
                4944 => 20,
                4945 => 20,
                4946 => 20,
                4947 => 20,
                5456 => 20,
                4952 => 11,
                4953 => 21,
                4954 => 21,
                4955 => 21,
                4956 => 21,
                4957 => 21,
                4958 => 21,
                4959 => 21,
                4960 => 21,
                4961 => 21,
                4962 => 5,
                4963 => 21,
                4964 => 21,
                4965 => 14,
                4966 => 19,
                4967 => 19,
                4968 => 21,
                4969 => 5,
                4970 => 5,
                4971 => 15,
                4972 => 15,
                4989 => 15,
                4973 => 17,
                4974 => 17,
                4975 => 17,
                4976 => 17,
                4977 => 12,
                4978 => 19,
                4980 => 11,
                4981 => 11,
                4982 => 11,
                4983 => 11,
                4984 => 11,
                4985 => 6,
                4986 => 6,
                4987 => 15,
                4988 => 5,
                9175 => 11,
                4990 => 5,
                4991 => 7,
                4992 => 21,
                4993 => 5,
                4994 => 5,
                4995 => 5,
                4996 => 5,
                4997 => 21,
                4998 => 21,
                5001 => 11,
                5002 => 11,
                5003 => 20,
                5004 => 20,
                5005 => 20,
                5006 => 11,
                5007 => 11,
                5008 => 5,
                5009 => 15,
                5135 => 5,
                5136 => 5,
                5137 => 5,
                8151 => 11,
                5138 => 5,
                5139 => 11,
                5140 => 11,
                5141 => 11,
                5142 => 11,
                5143 => 11,
                5144 => 11,
                5145 => 15,
                5146 => 15,
                5149 => 5,
                5150 => 21,
                5151 => 21,
                5152 => 21,
                5153 => 21,
                5154 => 21,
                5155 => 15,
                5156 => 5,
                8398 => 11,
                8154 => 6,
                5157 => 5,
                5158 => 5,
                5159 => 5,
                5160 => 15,
                5161 => 11,
                5162 => 15,
                5163 => 15,
                5277 => 11,
                5164 => 12,
                5165 => 19,
                5166 => 21,
                5167 => 21,
                7699 => 18,
                5168 => 21,
                5169 => 15,
                8821 => 11,
                5170 => 15,
                5171 => 20,
                5172 => 14,
                5357 => 15,
                5358 => 15,
                5359 => 15,
                5581 => 5,
                5365 => 4,
                5255 => 5,
                5606 => 20,
                5605 => 20,
                5604 => 20,
                5603 => 20,
                5602 => 20,
                5601 => 20,
                5600 => 20,
                5599 => 20,
                5598 => 20,
                5596 => 20,
                5597 => 20,
                5595 => 20,
                5656 => 4,
                5655 => 19,
                5654 => 20,
                5653 => 20,
                5614 => 19,
                5613 => 19,
                5612 => 18,
                5610 => 19,
                8692 => 17,
                5256 => 5,
                5257 => 5,
                5258 => 19,
                5636 => 21,
                5634 => 21,
                5593 => 15,
                5611 => 9,
                5637 => 21,
                5659 => 6,
                5278 => 11,
                5279 => 11,
                5356 => 15,
                5283 => 14,
                5284 => 14,
                5629 => 20,
                5550 => 11,
                5635 => 21,
                5638 => 21,
                5592 => 19,
                8704 => 21,
                5652 => 18,
                5650 => 18,
                5651 => 5,
                5658 => 18,
                5627 => 15,
                5626 => 14,
                5628 => 15,
                5624 => 11,
                5622 => 19,
                5623 => 20,
                5625 => 20,
                5620 => 5,
                5619 => 14,
                5618 => 20,
                5621 => 18,
                5616 => 19,
                5617 => 20,
                5454 => 5,
                5457 => 20,
                8784 => 11,
                5458 => 15,
                5459 => 15,
                5461 => 15,
                5462 => 11,
                5463 => 11,
                5464 => 11,
                5465 => 20,
                5466 => 20,
                5467 => 20,
                5468 => 15,
                5469 => 15,
                5470 => 15,
                5471 => 15,
                5668 => 6,
                5665 => 5,
                5664 => 18,
                5663 => 18,
                5662 => 18,
                5661 => 18,
                5482 => 15,
                5552 => 19,
                5553 => 15,
                5554 => 20,
                5557 => 19,
                5558 => 5,
                5559 => 20,
                5560 => 20,
                5563 => 4,
                5565 => 19,
                5566 => 19,
                5567 => 20,
                5568 => 20,
                5569 => 15,
                5570 => 19,
                5571 => 19,
                5572 => 11,
                5573 => 11,
                5574 => 11,
                5646 => 5,
                5587 => 5,
                5588 => 18,
                5590 => 15,
                5591 => 15,
                5594 => 20,
                5551 => 11,
                5666 => 15,
                5667 => 15,
                6581 => 5,
                6011 => 11,
                8044 => 20,
                6462 => 21,
                6342 => 16,
                8868 => 9,
                6596 => 6,
                5834 => 15,
                6597 => 6,
                6012 => 21,
                6107 => 15,
                6343 => 9,
                6154 => 5,
                6408 => 15,
                5868 => 14,
                6344 => 16,
                6345 => 6,
                6346 => 19,
                6598 => 6,
                6108 => 15,
                6347 => 19,
                6105 => 9,
                6106 => 15,
                6407 => 15,
                6406 => 15,
                6436 => 21,
                6460 => 21,
                6461 => 21,
                9071 => 19,
                6599 => 6,
                6645 => 20,
                6602 => 21,
                6603 => 21,
                6604 => 21,
                6605 => 21,
                6606 => 21,
                6607 => 21,
                6608 => 6,
                6638 => 5,
                6668 => 11,
                6639 => 11,
                6637 => 15,
                6636 => 11,
                7375 => 19,
                6640 => 11,
                6641 => 21,
                6642 => 21,
                6643 => 21,
                6644 => 11,
                6646 => 15,
                7456 => 6,
                7404 => 19,
                7337 => 19,
                7443 => 15,
                9294 => 11,
                6766 => 15,
                6666 => 11,
                7426 => 6,
                9277 => 6,
                7509 => 15,
                6841 => 19,
                7430 => 15,
                6654 => 21,
                7445 => 15,
                6651 => 15,
                6682 => 15,
                7515 => 18,
                7517 => 11,
                7513 => 18,
                7320 => 19,
                7514 => 18,
                7318 => 5,
                6667 => 19,
                7487 => 11,
                6670 => 21,
                7296 => 15,
                6673 => 11,
                6692 => 21,
                7526 => 11,
                7444 => 18,
                7423 => 11,
                7522 => 11,
                8948 => 11,
                7312 => 11,
                7525 => 11,
                7332 => 19,
                7330 => 19,
                7508 => 18,
                6759 => 11,
                7519 => 11,
                8947 => 11,
                7306 => 20,
                7333 => 19,
                7511 => 15,
                6715 => 9,
                7331 => 19,
                6746 => 15,
                7447 => 11,
                7521 => 11,
                8932 => 9,
                7368 => 15,
                6686 => 21,
                6652 => 11,
                6653 => 15,
                7329 => 19,
                8961 => 5,
                6655 => 21,
                6656 => 21,
                6657 => 21,
                7663 => 11,
                6658 => 21,
                6659 => 21,
                6660 => 21,
                6661 => 21,
                6663 => 5,
                6687 => 21,
                7434 => 4,
                7393 => 21,
                8869 => 9,
                6665 => 11,
                6689 => 11,
                6977 => 9,
                7334 => 19,
                7335 => 19,
                7336 => 15,
                7338 => 19,
                7339 => 19,
                7340 => 19,
                7386 => 11,
                7341 => 11,
                7342 => 11,
                7343 => 11,
                7344 => 11,
                7345 => 11,
                7346 => 11,
                7347 => 11,
                8945 => 11,
                7348 => 11,
                7349 => 11,
                7350 => 11,
                7351 => 11,
                7352 => 11,
                7402 => 19,
                7353 => 15,
                7354 => 15,
                7355 => 15,
                7356 => 15,
                7357 => 15,
                7358 => 15,
                7359 => 15,
                7360 => 11,
                7361 => 20,
                7362 => 20,
                7363 => 20,
                7364 => 20,
                7365 => 20,
                7366 => 21,
                7367 => 15,
                7369 => 15,
                7370 => 15,
                7371 => 20,
                7372 => 20,
                7373 => 19,
                7374 => 20,
                7527 => 11,
                7528 => 11,
                7529 => 11,
                7530 => 11,
                7531 => 18,
                7532 => 18,
                7533 => 18,
                7534 => 18,
                7535 => 18,
                7536 => 18,
                7537 => 18,
                7538 => 18,
                7539 => 14,
                7540 => 11,
                7541 => 19,
                7542 => 15,
                7543 => 15,
                7544 => 17,
                7546 => 11,
                7545 => 15,
                8402 => 11,
                7547 => 11,
                7548 => 11,
                7549 => 11,
                7550 => 18,
                7555 => 15,
                7551 => 19,
                7552 => 9,
                7553 => 13,
                7563 => 11,
                8944 => 11,
                7561 => 11,
                7570 => 5,
                7557 => 11,
                7558 => 11,
                7559 => 11,
                7560 => 11,
                7562 => 11,
                7564 => 18,
                7565 => 16,
                7566 => 16,
                7567 => 16,
                7568 => 16,
                7569 => 16,
                7571 => 19,
                7572 => 16,
                7573 => 16,
                7670 => 15,
                7596 => 11,
                7659 => 5,
                7599 => 19,
                7720 => 18,
                7592 => 14,
                7597 => 20,
                7608 => 13,
                7581 => 5,
                7583 => 19,
                7593 => 11,
                7606 => 13,
                7607 => 13,
                7605 => 18,
                7578 => 12,
                7658 => 5,
                7603 => 13,
                7598 => 20,
                7609 => 13,
                7594 => 11,
                7589 => 14,
                7715 => 11,
                7684 => 15,
                7579 => 5,
                7700 => 19,
                7701 => 5,
                7590 => 14,
                7693 => 11,
                7660 => 11,
                7586 => 18,
                7580 => 5,
                7575 => 21,
                7576 => 21,
                7577 => 21,
                7582 => 5,
                7600 => 9,
                7591 => 14,
                7587 => 15,
                7588 => 15,
                7711 => 4,
                7585 => 15,
                7584 => 18,
                7604 => 18,
                7601 => 11,
                7675 => 15,
                7672 => 15,
                7665 => 11,
                9059 => 4,
                7669 => 9,
                7623 => 19,
                9083 => 18,
                8161 => 5,
                7682 => 19,
                7666 => 11,
                7681 => 5,
                7679 => 15,
                7678 => 15,
                7677 => 18,
                7683 => 19,
                7674 => 15,
                7664 => 21,
                7645 => 11,
                7676 => 18,
                7696 => 19,
                7661 => 15,
                8908 => 15,
                7673 => 15,
                7718 => 20,
                7671 => 15,
                7721 => 20,
                7610 => 21,
                7611 => 21,
                7612 => 21,
                7613 => 21,
                7614 => 21,
                7615 => 21,
                7616 => 11,
                7617 => 11,
                7618 => 11,
                7619 => 11,
                7620 => 11,
                7621 => 11,
                7622 => 11,
                7657 => 5,
                7624 => 19,
                7625 => 5,
                7626 => 19,
                7627 => 19,
                7628 => 19,
                7629 => 6,
                7630 => 19,
                7631 => 19,
                7632 => 19,
                7633 => 19,
                7634 => 19,
                7635 => 19,
                7636 => 5,
                7637 => 5,
                7638 => 5,
                7639 => 5,
                7640 => 5,
                7641 => 5,
                7642 => 5,
                7643 => 5,
                7644 => 5,
                7646 => 9,
                7647 => 9,
                7648 => 9,
                7650 => 5,
                7651 => 19,
                7652 => 5,
                7653 => 18,
                7654 => 18,
                7843 => 11,
                8805 => 11,
                8182 => 18,
                8214 => 9,
                8810 => 11,
                8637 => 9,
                8774 => 18,
                7727 => 5,
                8934 => 9,
                8977 => 15,
                8029 => 18,
                8152 => 11,
                7726 => 15,
                8119 => 11,
                8043 => 15,
                8040 => 18,
                8039 => 18,
                8148 => 18,
                8659 => 15,
                8975 => 5,
                7874 => 15,
                8037 => 18,
                8661 => 11,
                8034 => 18,
                8035 => 18,
                8036 => 18,
                9050 => 9,
                9045 => 11,
                8666 => 15,
                7724 => 5,
                8860 => 11,
                8020 => 19,
                8033 => 18,
                8829 => 11,
                8120 => 11,
                9003 => 11,
                9035 => 11,
                8799 => 11,
                8057 => 11,
                8059 => 18,
                8882 => 9,
                8047 => 11,
                8565 => 15,
                8014 => 9,
                8993 => 15,
                7975 => 11,
                8825 => 18,
                9012 => 5,
                8941 => 11,
                7722 => 9,
                7725 => 18,
                8864 => 19,
                9020 => 19,
                8830 => 11,
                9084 => 21,
                8694 => 11,
                8874 => 15,
                8075 => 18,
                8067 => 11,
                8150 => 11,
                9300 => 11,
                8926 => 15,
                8160 => 15,
                7745 => 9,
                8064 => 18,
                8813 => 19,
                8776 => 9,
                8072 => 9,
                8153 => 18,
                7734 => 5,
                9043 => 11,
                8593 => 9,
                8619 => 16,
                8815 => 15,
                8983 => 11,
                9025 => 11,
                8062 => 11,
                8978 => 14,
                8914 => 11,
                8660 => 15,
                8156 => 18,
                8121 => 6,
                9009 => 20,
                9022 => 19,
                9011 => 5,
                8682 => 18,
                8657 => 9,
                7741 => 19,
                7742 => 9,
                7729 => 20,
                7730 => 11,
                7731 => 11,
                7732 => 11,
                7733 => 11,
                8708 => 11,
                7735 => 5,
                7736 => 5,
                7737 => 18,
                7738 => 12,
                7739 => 20,
                7744 => 11,
                7746 => 9,
                7747 => 6,
                7748 => 6,
                7749 => 19,
                7750 => 11,
                7751 => 5,
                7752 => 5,
                7753 => 15,
                8817 => 11,
                8725 => 21,
                7883 => 18,
                9031 => 9,
                8794 => 15,
                8796 => 11,
                8028 => 15,
                8030 => 11,
                7890 => 15,
                8042 => 15,
                7971 => 9,
                7895 => 9,
                9291 => 11,
                8058 => 11,
                9073 => 9,
                7893 => 11,
                7884 => 18,
                9055 => 15,
                8867 => 9,
                8946 => 11,
                8013 => 6,
                8015 => 9,
                9062 => 11,
                7882 => 11,
                8073 => 15,
                8024 => 14,
                7919 => 18,
                8017 => 11,
                8016 => 15,
                8022 => 14,
                9046 => 11,
                9159 => 9,
                8828 => 18,
                8060 => 18,
                7896 => 9,
                7888 => 15,
                7879 => 15,
                7983 => 18,
                9002 => 11,
                8227 => 14,
                8401 => 11,
                8069 => 11,
                7773 => 11,
                7754 => 15,
                7755 => 15,
                7756 => 6,
                7757 => 4,
                7758 => 5,
                7759 => 9,
                7897 => 20,
                7780 => 9,
                8880 => 19,
                7760 => 9,
                7761 => 9,
                7762 => 9,
                7763 => 9,
                7764 => 9,
                7765 => 9,
                7766 => 18,
                7767 => 18,
                7768 => 12,
                7891 => 11,
                8183 => 9,
                7769 => 18,
                7770 => 18,
                7771 => 5,
                7772 => 5,
                7774 => 11,
                8795 => 11,
                7775 => 5,
                7776 => 11,
                7777 => 11,
                7778 => 20,
                7779 => 20,
                7781 => 5,
                7782 => 5,
                8833 => 11,
                8706 => 21,
                8628 => 15,
                7787 => 11,
                7875 => 15,
                8689 => 18,
                8819 => 11,
                8779 => 19,
                8826 => 18,
                8050 => 11,
                8063 => 11,
                7878 => 15,
                9058 => 9,
                8807 => 11,
                8052 => 11,
                9018 => 5,
                8049 => 11,
                8048 => 11,
                8053 => 9,
                7973 => 11,
                7974 => 11,
                7812 => 21,
                8969 => 6,
                8045 => 15,
                7811 => 5,
                8055 => 6,
                9064 => 11,
                8149 => 11,
                8982 => 11,
                8018 => 11,
                8041 => 18,
                8158 => 15,
                7790 => 11,
                8038 => 9,
                8027 => 18,
                8200 => 11,
                7972 => 18,
                8025 => 14,
                9069 => 11,
                9211 => 17,
                7978 => 11,
                7979 => 19,
                7880 => 15,
                8023 => 14,
                8836 => 11,
                7920 => 15,
                7921 => 21,
                8798 => 11,
                7976 => 11,
                7783 => 5,
                7784 => 18,
                7785 => 18,
                7786 => 11,
                8070 => 11,
                7788 => 11,
                7789 => 9,
                8935 => 18,
                7791 => 20,
                7792 => 11,
                8938 => 11,
                8793 => 8,
                7793 => 5,
                7794 => 18,
                7795 => 15,
                7796 => 15,
                7797 => 16,
                7798 => 16,
                7799 => 16,
                7800 => 16,
                7801 => 16,
                7802 => 16,
                7803 => 16,
                7804 => 16,
                7805 => 16,
                7806 => 16,
                7807 => 8,
                7808 => 18,
                7809 => 21,
                7810 => 21,
                7886 => 21,
                9047 => 11,
                8011 => 11,
                7881 => 11,
                8797 => 11,
                8012 => 15,
                8026 => 18,
                8678 => 11,
                7842 => 21,
                7829 => 11,
                8832 => 11,
                8696 => 6,
                9074 => 8,
                8930 => 6,
                7877 => 19,
                8827 => 18,
                9063 => 11,
                7823 => 19,
                8071 => 9,
                8712 => 11,
                8010 => 18,
                7813 => 11,
                7814 => 11,
                7815 => 11,
                7816 => 11,
                7817 => 21,
                7818 => 11,
                7819 => 11,
                7820 => 11,
                7821 => 15,
                7822 => 11,
                7824 => 19,
                7825 => 19,
                7826 => 18,
                7828 => 20,
                7827 => 21,
                7830 => 11,
                7831 => 11,
                7832 => 18,
                7833 => 18,
                7834 => 15,
                7835 => 19,
                7836 => 19,
                7837 => 11,
                7838 => 21,
                7839 => 21,
                7840 => 11,
                7841 => 5,
                7887 => 15,
                9024 => 11,
                8870 => 15,
                8061 => 18,
                8687 => 15,
                7894 => 15,
                7892 => 11,
                8031 => 18,
                7885 => 11,
                9247 => 6,
                8139 => 11,
                7868 => 15,
                7876 => 20,
                8021 => 18,
                8074 => 21,
                7844 => 11,
                7845 => 11,
                7867 => 12,
                7847 => 11,
                8974 => 11,
                7849 => 9,
                7850 => 19,
                7851 => 9,
                7852 => 9,
                7853 => 9,
                7854 => 9,
                7855 => 9,
                7856 => 6,
                7857 => 6,
                7858 => 15,
                7859 => 15,
                7860 => 15,
                7861 => 18,
                7862 => 16,
                7863 => 11,
                7864 => 11,
                7865 => 11,
                7866 => 16,
                7869 => 18,
                7870 => 11,
                7871 => 11,
                7872 => 11,
                7873 => 6,
                8802 => 11,
                8700 => 15,
                8701 => 15,
                8065 => 11,
                8066 => 11,
                8929 => 6,
                8068 => 11,
                8823 => 11,
                7970 => 11,
                8754 => 11,
                8699 => 15,
                8566 => 15,
                8155 => 6,
                7898 => 11,
                9207 => 11,
                9010 => 20,
                8019 => 11,
                7982 => 18,
                7977 => 18,
                9006 => 11,
                9265 => 14,
                8056 => 11,
                8824 => 9,
                8862 => 11,
                8046 => 15,
                7899 => 11,
                7900 => 11,
                7901 => 11,
                7902 => 11,
                7903 => 11,
                7904 => 11,
                7905 => 6,
                7906 => 11,
                7907 => 11,
                7908 => 11,
                7909 => 11,
                7910 => 11,
                7911 => 11,
                7912 => 19,
                7913 => 19,
                7914 => 15,
                9072 => 9,
                7915 => 11,
                7916 => 11,
                7917 => 11,
                7918 => 15,
                8873 => 18,
                8162 => 18,
                9015 => 11,
                8979 => 14,
                8811 => 11,
                8750 => 11,
                8163 => 18,
                8164 => 11,
                8165 => 11,
                8166 => 11,
                8167 => 11,
                8168 => 11,
                8169 => 11,
                8170 => 11,
                8171 => 15,
                8172 => 15,
                8173 => 15,
                8174 => 15,
                8175 => 15,
                8176 => 15,
                8177 => 15,
                8178 => 21,
                8180 => 9,
                8181 => 9,
                8184 => 11,
                8185 => 11,
                8681 => 11,
                8695 => 11,
                8195 => 6,
                8199 => 15,
                8266 => 19,
                8753 => 11,
                8231 => 9,
                8591 => 9,
                9057 => 15,
                8777 => 9,
                8822 => 11,
                8697 => 15,
                8189 => 11,
                8962 => 5,
                8234 => 5,
                8235 => 5,
                9450 => 18,
                9066 => 18,
                8230 => 11,
                9049 => 11,
                9093 => 11,
                8406 => 11,
                8567 => 6,
                8395 => 6,
                8624 => 9,
                8228 => 14,
                8986 => 21,
                8272 => 19,
                9036 => 15,
                8187 => 5,
                8656 => 15,
                8767 => 18,
                8224 => 11,
                8713 => 11,
                8238 => 11,
                9000 => 15,
                8770 => 18,
                8803 => 11,
                8623 => 9,
                8186 => 9,
                8837 => 13,
                8188 => 19,
                8447 => 20,
                8190 => 9,
                8192 => 11,
                8193 => 15,
                8194 => 11,
                8757 => 11,
                8196 => 11,
                8197 => 11,
                8198 => 11,
                8783 => 11,
                8592 => 9,
                8334 => 9,
                8403 => 11,
                8622 => 9,
                8315 => 15,
                8921 => 9,
                9021 => 19,
                8658 => 11,
                8669 => 9,
                8313 => 15,
                8702 => 21,
                8226 => 18,
                8749 => 9,
                8397 => 20,
                8766 => 18,
                8215 => 11,
                8589 => 18,
                8236 => 5,
                8665 => 6,
                8588 => 19,
                8405 => 20,
                8785 => 11,
                8233 => 16,
                8994 => 15,
                8239 => 9,
                8412 => 9,
                9044 => 11,
                8865 => 19,
                8621 => 9,
                9293 => 11,
                8820 => 11,
                8229 => 14,
                8237 => 11,
                8786 => 8,
                9030 => 9,
                8705 => 13,
                8765 => 11,
                8655 => 21,
                8769 => 18,
                8204 => 9,
                8711 => 18,
                8709 => 11,
                8787 => 11,
                8997 => 15,
                8998 => 15,
                8590 => 18,
                8232 => 21,
                8751 => 11,
                8626 => 9,
                8399 => 11,
                9449 => 5,
                8400 => 11,
                8205 => 20,
                8201 => 15,
                8202 => 15,
                8203 => 11,
                8928 => 15,
                8707 => 21,
                8206 => 9,
                8207 => 9,
                8208 => 9,
                8209 => 9,
                8210 => 19,
                8211 => 19,
                8212 => 19,
                8213 => 9,
                8216 => 11,
                8217 => 11,
                8218 => 11,
                8219 => 11,
                8220 => 11,
                8221 => 11,
                8222 => 11,
                8223 => 11,
                8617 => 15,
                8263 => 11,
                9447 => 9,
                8627 => 9,
                8976 => 11,
                8396 => 20,
                8250 => 5,
                8269 => 11,
                8768 => 18,
                8404 => 19,
                8410 => 11,
                8240 => 5,
                9094 => 9,
                8925 => 15,
                9026 => 11,
                8242 => 12,
                8985 => 9,
                8995 => 15,
                8876 => 11,
                8789 => 19,
                9051 => 9,
                8618 => 9,
                8691 => 17,
                8241 => 5,
                8243 => 18,
                8244 => 18,
                8245 => 18,
                8246 => 18,
                8249 => 5,
                8247 => 20,
                8772 => 11,
                8248 => 11,
                8999 => 15,
                8271 => 19,
                8629 => 15,
                8268 => 11,
                8251 => 19,
                8267 => 11,
                8262 => 11,
                8261 => 15,
                9061 => 11,
                8863 => 20,
                8264 => 11,
                8276 => 9,
                8275 => 20,
                8698 => 15,
                8654 => 21,
                8690 => 20,
                8866 => 11,
                8411 => 11,
                8755 => 15,
                8270 => 11,
                8620 => 19,
                8317 => 11,
                8409 => 11,
                8335 => 9,
                8373 => 19,
                8756 => 11,
                8927 => 15,
                8594 => 9,
                8693 => 11,
                8407 => 9,
                8625 => 9,
                9007 => 5,
                8814 => 15,
                8683 => 11,
                8333 => 6,
                8273 => 6,
                8274 => 5,
                8987 => 21,
                8260 => 11,
                8663 => 15,
                8662 => 11,
                8879 => 11,
                8716 => 17,
                9054 => 15,
                8303 => 11,
                8304 => 15,
                8664 => 6,
                8408 => 11,
                8258 => 11,
                8336 => 6,
                8812 => 11,
                8265 => 11,
                8252 => 21,
                8253 => 21,
                8254 => 21,
                8255 => 21,
                8414 => 14,
                8259 => 11,
                8748 => 9,
                8394 => 19,
                8393 => 15,
                8984 => 6,
                8710 => 11,
                8630 => 11,
                8631 => 11,
                8632 => 11,
                8633 => 18,
                8634 => 18,
                8635 => 11,
                8636 => 11,
                8723 => 18,
                8792 => 11,
                8638 => 18,
                8639 => 18,
                8640 => 19,
                8641 => 18,
                8642 => 18,
                8643 => 11,
                8644 => 11,
                8646 => 11,
                8647 => 11,
                8648 => 11,
                8649 => 5,
                8650 => 5,
                8651 => 11,
                8652 => 11,
                8653 => 11,
                8714 => 21,
                8670 => 11,
                9001 => 11,
                8671 => 11,
                9169 => 9,
                8672 => 11,
                8673 => 11,
                8674 => 11,
                8675 => 11,
                8676 => 11,
                8677 => 11,
                8804 => 11,
                8679 => 11,
                8680 => 11,
                9237 => 11,
                9017 => 16,
                9008 => 21,
                8684 => 11,
                8685 => 11,
                8686 => 15,
                8688 => 15,
                9039 => 9,
                8940 => 11,
                8834 => 11,
                8773 => 11,
                8861 => 11,
                8885 => 19,
                8790 => 19,
                8973 => 11,
                8722 => 18,
                8721 => 18,
                9013 => 15,
                8991 => 20,
                8720 => 11,
                8758 => 15,
                9077 => 8,
                8878 => 18,
                8715 => 11,
                8717 => 21,
                8718 => 17,
                9033 => 9,
                8724 => 18,
                8759 => 21,
                9052 => 9,
                8780 => 11,
                8791 => 16,
                8727 => 12,
                8745 => 19,
                8761 => 9,
                8763 => 11,
                9041 => 9,
                8764 => 11,
                9075 => 8,
                8800 => 11,
                9461 => 9,
                8841 => 11,
                8840 => 9,
                8788 => 19,
                8808 => 15,
                8778 => 9,
                8988 => 9,
                8731 => 11,
                9176 => 11,
                8809 => 11,
                9065 => 18,
                8816 => 9,
                8980 => 11,
                8981 => 6,
                8782 => 11,
                8781 => 11,
                8818 => 11,
                8806 => 11,
                8801 => 11,
                8728 => 15,
                8903 => 15,
                8735 => 15,
                8752 => 11,
                8726 => 6,
                8762 => 9,
                8729 => 11,
                8730 => 11,
                8732 => 11,
                8733 => 17,
                9184 => 18,
                8734 => 11,
                8771 => 9,
                8736 => 15,
                8737 => 15,
                8738 => 15,
                8739 => 15,
                8740 => 15,
                8741 => 15,
                8742 => 15,
                8743 => 15,
                8744 => 19,
                8760 => 9,
                8746 => 19,
                8747 => 19,
                9042 => 11,
                9060 => 18,
                8859 => 19,
                8909 => 11,
                8858 => 4,
                8871 => 11,
                8992 => 20,
                8942 => 11,
                9216 => 9,
                8877 => 18,
                8843 => 11,
                8844 => 5,
                8845 => 5,
                8846 => 5,
                8847 => 5,
                8848 => 5,
                8849 => 5,
                8850 => 11,
                8851 => 11,
                8852 => 5,
                8853 => 11,
                8854 => 11,
                8855 => 17,
                8856 => 11,
                8857 => 11,
                9068 => 9,
                9067 => 18,
                8949 => 11,
                9160 => 11,
                9032 => 9,
                8906 => 18,
                9078 => 15,
                8898 => 9,
                8883 => 9,
                8884 => 9,
                8886 => 19,
                8953 => 11,
                8897 => 9,
                8889 => 11,
                8887 => 11,
                8888 => 11,
                8890 => 9,
                8891 => 11,
                8892 => 11,
                8955 => 15,
                8893 => 11,
                8894 => 11,
                8895 => 11,
                8896 => 11,
                8907 => 9,
                9056 => 15,
                9004 => 11,
                9005 => 11,
                8917 => 11,
                8900 => 9,
                8901 => 9,
                8931 => 6,
                8899 => 9,
                9048 => 11,
                8924 => 15,
                8919 => 6,
                9027 => 11,
                9037 => 15,
                8958 => 5,
                8950 => 15,
                8902 => 15,
                8904 => 9,
                8957 => 15,
                8933 => 9,
                8952 => 11,
                9070 => 9,
                9029 => 9,
                9271 => 9,
                8954 => 11,
                9040 => 9,
                8996 => 15,
                8922 => 15,
                8920 => 11,
                8905 => 9,
                8916 => 11,
                8963 => 5,
                8964 => 5,
                8965 => 5,
                8966 => 15,
                8967 => 15,
                8968 => 5,
                8970 => 6,
                8971 => 5,
                9145 => 16,
                9089 => 11,
                9133 => 9,
                9091 => 11,
                9173 => 18,
                9194 => 9,
                9149 => 9,
                9086 => 11,
                9212 => 17,
                9166 => 15,
                9141 => 15,
                9142 => 19,
                9148 => 9,
                9085 => 5,
                9140 => 18,
                9144 => 9,
                9210 => 9,
                9136 => 18,
                9087 => 11,
                9088 => 11,
                9269 => 11,
                9090 => 11,
                9092 => 18,
                9107 => 9,
                9117 => 6,
                9209 => 11,
                9156 => 9,
                9137 => 18,
                9109 => 11,
                9126 => 9,
                9186 => 9,
                9108 => 5,
                9106 => 11,
                9095 => 11,
                9105 => 11,
                9171 => 11,
                9165 => 9,
                9208 => 11,
                9270 => 11,
                9158 => 11,
                9154 => 15,
                9114 => 15,
                9168 => 9,
                9110 => 9,
                9276 => 6,
                9192 => 11,
                9200 => 9,
                9096 => 9,
                9132 => 19,
                9222 => 11,
                9162 => 11,
                9155 => 15,
                9157 => 11,
                9151 => 9,
                9104 => 9,
                9097 => 9,
                9099 => 9,
                9098 => 16,
                9100 => 9,
                9101 => 9,
                9102 => 9,
                9103 => 9,
                9153 => 15,
                9249 => 5,
                9147 => 16,
                9272 => 15,
                9163 => 11,
                9161 => 11,
                9214 => 9,
                9152 => 15,
                9164 => 11,
                9215 => 9,
                9172 => 11,
                9138 => 11,
                9174 => 11,
                9146 => 5,
                9134 => 19,
                9116 => 6,
                9403 => 11,
                9122 => 11,
                9115 => 15,
                9127 => 9,
                9111 => 9,
                9112 => 9,
                9113 => 9,
                9118 => 6,
                9119 => 17,
                9217 => 19,
                9292 => 11,
                9125 => 11,
                9177 => 11,
                9218 => 19,
                9131 => 15,
                9202 => 5,
                9123 => 11,
                9130 => 6,
                9121 => 11,
                9129 => 11,
                9120 => 18,
                9135 => 5,
                9180 => 18,
                9128 => 9,
                9279 => 9,
                9193 => 5,
                9220 => 9,
                9143 => 9,
                9455 => 9,
                9150 => 11,
                9124 => 11,
                9178 => 11,
                9179 => 18,
                9181 => 9,
                9182 => 9,
                9183 => 11,
                9185 => 18,
                9187 => 9,
                9188 => 9,
                9190 => 11,
                9191 => 12,
                9195 => 9,
                9196 => 15,
                9197 => 9,
                9198 => 9,
                9199 => 11,
                9201 => 9,
                9203 => 15,
                9204 => 5,
                9205 => 5,
                9273 => 21,
                9219 => 21,
                9221 => 9,
                9225 => 5,
                9223 => 18,
                9224 => 18,
                9236 => 21,
                9245 => 21,
                9239 => 11,
                9248 => 18,
                9262 => 18,
                9258 => 20,
                9242 => 15,
                9241 => 21,
                9238 => 11,
                9240 => 9,
                9471 => 9,
                9243 => 9,
                9261 => 15,
                9275 => 15,
                9264 => 18,
                9246 => 9,
                9244 => 21,
                9256 => 19,
                9228 => 11,
                9226 => 11,
                9227 => 11,
                9229 => 11,
                9230 => 11,
                9231 => 9,
                9232 => 5,
                9233 => 6,
                9234 => 6,
                9235 => 6,
                9259 => 20,
                9260 => 15,
                9257 => 20,
                9278 => 11,
                9274 => 9,
                9250 => 18,
                9251 => 11,
                9252 => 18,
                9253 => 19,
                9254 => 19,
                9268 => 21,
                9255 => 19,
                9280 => 9,
                9281 => 6,
                9282 => 6,
                9283 => 6,
                9284 => 6,
                9285 => 6,
                9286 => 6,
                9287 => 6,
                9288 => 15,
                9289 => 9,
                9290 => 12,
                9295 => 13,
                9296 => 15,
                9297 => 9,
                9298 => 6,
                9299 => 6,
                9301 => 11,
                9302 => 11,
                9303 => 11,
                9305 => 9,
                9306 => 15,
                9307 => 21,
                9309 => 9,
                9310 => 18,
                9311 => 11,
                9312 => 11,
                9313 => 11,
                9314 => 9,
                9315 => 9,
                9316 => 6,
                9317 => 6,
                9319 => 9,
                9320 => 9,
                9360 => 15,
                9321 => 9,
                9322 => 9,
                9323 => 20,
                9324 => 18,
                9325 => 12,
                9326 => 11,
                9327 => 11,
                9328 => 11,
                9329 => 11,
                9330 => 11,
                9331 => 11,
                9332 => 11,
                9333 => 5,
                9334 => 5,
                9335 => 19,
                9336 => 9,
                9337 => 9,
                9338 => 16,
                9339 => 9,
                9340 => 16,
                9341 => 15,
                9342 => 6,
                9343 => 18,
                9344 => 18,
                9345 => 18,
                9346 => 18,
                9347 => 18,
                9348 => 11,
                9349 => 11,
                9350 => 11,
                9351 => 11,
                9352 => 19,
                9353 => 18,
                9354 => 18,
                9355 => 11,
                9356 => 19,
                9357 => 18,
                9358 => 18,
                9359 => 11,
                9361 => 15,
                9470 => 9,
                9464 => 9,
                9467 => 9,
                9463 => 9,
                9465 => 9,
                9468 => 9,
                9362 => 21,
                9469 => 9,
                9442 => 19,
                9453 => 21,
                9451 => 9,
                9402 => 20,
                9462 => 9,
                9452 => 9,
                9383 => 11,
                9364 => 18,
                9365 => 18,
                9366 => 18,
                9367 => 18,
                9368 => 18,
                9369 => 19,
                9370 => 19,
                9371 => 11,
                9372 => 18,
                9373 => 18,
                9374 => 18,
                9375 => 19,
                9376 => 18,
                9377 => 18,
                9378 => 19,
                9379 => 19,
                9380 => 6,
                9381 => 6,
                9382 => 6,
                9384 => 11,
                9385 => 11,
                9386 => 11,
                9387 => 11,
                9388 => 21,
                9389 => 18,
                9390 => 18,
                9391 => 18,
                9392 => 18,
                9393 => 11,
                9394 => 11,
                9395 => 11,
                9396 => 18,
                9397 => 18,
                9398 => 18,
                9399 => 18,
                9400 => 19,
                9401 => 19,
                9404 => 11,
                9405 => 11,
                9406 => 11,
                9407 => 11,
                9408 => 11,
                9409 => 11,
                9410 => 11,
                9411 => 11,
                9412 => 11,
                9413 => 11,
                9414 => 11,
                9415 => 11,
                9416 => 11,
                9417 => 11,
                9418 => 11,
                9419 => 11,
                9420 => 12,
                9421 => 9,
                9422 => 9,
                9423 => 9,
                9424 => 9,
                9425 => 9,
                9426 => 9,
                9427 => 9,
                9428 => 9,
                9429 => 9,
                9430 => 9,
                9431 => 9,
                9432 => 9,
                9433 => 9,
                9434 => 9,
                9435 => 9,
                9436 => 9,
                9437 => 9,
                9438 => 9,
                9439 => 9,
                9440 => 9,
                9441 => 9,
                9443 => 19,
                9444 => 11,
                9445 => 11,
                9446 => 11,
                9466 => 9,
                9459 => 21,
                9456 => 9,
                9457 => 6,
                9458 => 6,
                9460 => 21
            ];
            $array_grupo_inventario = $array_info_global['grupo=>id_grupo_inventario'];

            $array_subgrupo = $array_info_global['subgrupo=>id_subgrupo'];

            $array_medidas_duplicadas =
                    [
                        'CentiLitros' => 3,
                        'Centímetro' => 15,
                        'Galones' => 4,
                        'Gramos' => 6,
                        'kilogramos' => 7,
                        'Pulgadas' => 13,
                        'Rollos' => 14,
                        'Unidades' => 15,
                        'Metro lineal' => 11
                    ];
            


            $registros_insertados = 0;

            $conexion_migracion_prueba->beginTransaction();

            foreach($array_dt_inventario as $registro_dt_inventario){

                try{
                    if(array_key_exists(trim($registro_dt_inventario->medida),$array_medidas_duplicadas)){
                        $id_medidas = $array_medidas_duplicadas[trim($registro_dt_inventario->medida)];
                    }elseif(array_key_exists(trim($registro_dt_inventario->medida),$array_medidas)){
                        $id_medidas = $array_medidas[trim($registro_dt_inventario->medida)];
                    }else{
                        $id_medidas = null;
                    }
                    $id_proveedor = array_key_exists($registro_dt_inventario->proveedor,$array_proveedores)?$array_proveedores[$registro_dt_inventario->proveedor]:null;
                    if(array_key_exists($registro_dt_inventario->id_inventario,$array_grupo_inventario_moni)){
                        $id_grupo_inventario = $array_grupo_inventario_moni[$registro_dt_inventario->id_inventario];
                    }elseif(array_key_exists($registro_dt_inventario->grupo,$array_grupo_inventario)){
                        $id_grupo_inventario = $array_grupo_inventario[$registro_dt_inventario->grupo];
                    }else{
                        $id_grupo_inventario = null;
                    }
                    $id_subgrupo = array_key_exists($registro_dt_inventario->subgrupo,$array_subgrupo)?$array_subgrupo[$registro_dt_inventario->subgrupo]:null;

                    $producto = ControladorFuncionesAuxiliares::formateaString($registro_dt_inventario->producto);

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_inventario(id_inventario,codigo_prod,cod_transito,cod_barras,producto,id_medida,stock,kardex_estado,valor_unidad,valor_unidad_compra,
                        lista_precio,valor_total,id_proveedor,tam_x,tam_y,estado,tiempo_compra,observaciones_mat,fecha_creacion,id_grupo_inventario,id_subgrupo,cantidad_min,material_crit,marca)
                        VALUES(:id_inventario,:codigo_prod,:cod_transito,:cod_barras,:producto,:id_medida,:stock,:kardex_estado,:valor_unidad,:valor_unidad_compra,
                        :lista_precio,:valor_total,:id_proveedor,:tam_x,:tam_y,:estado,:tiempo_compra,:observaciones_mat,:fecha_creacion,:id_grupo_inventario,:id_subgrupo,
                        :cantidad_min,:material_crit,:marca)
                    ");

                    $insert_registro->execute([
                        'id_inventario' => $registro_dt_inventario->id_inventario,
                        'codigo_prod' => $registro_dt_inventario->codigo_prod,
                        'cod_transito' => $registro_dt_inventario->cod_transito,
                        'cod_barras' => $registro_dt_inventario->cod_barras,
                        'producto' => $producto,
                        'id_medida' => $id_medidas,
                        'stock' => $registro_dt_inventario->stock,
                        'kardex_estado' => $registro_dt_inventario->kardex,
                        'valor_unidad' => $registro_dt_inventario->valor_unidad,
                        'valor_unidad_compra' => $registro_dt_inventario->vrUnidad_compra,
                        'lista_precio' => $registro_dt_inventario->lista_precio,
                        'valor_total' => $registro_dt_inventario->valor_total,
                        'id_proveedor' => $id_proveedor,
                        'tam_x' => $registro_dt_inventario->x,
                        'tam_y' => $registro_dt_inventario->y,
                        'estado' => $registro_dt_inventario->activo,
                        'tiempo_compra' => $registro_dt_inventario->tiempoCompra,
                        'observaciones_mat' => $registro_dt_inventario->observaciones,
                        'fecha_creacion' => $registro_dt_inventario->fechaCreacion,
                        'id_grupo_inventario' => $id_grupo_inventario,
                        'id_subgrupo' => $id_subgrupo,
                        'cantidad_min' => $registro_dt_inventario->minimo,
                        'material_crit' => 0,
                        'marca' => $registro_dt_inventario->marca
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollback();
                    echo "Error en el id_inventario: ".$registro_dt_inventario->id_inventario."<br>".$e->getMessage();exit;
                }

                try{
                    $insert_registro2 = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_kardex(id_inventario,codigo_prod,producto,enero_stock,enero_valor,febrero_stock,febrero_valor,marzo_stock,marzo_valor,abril_stock,
                        abril_valor,mayo_stock,mayo_valor,junio_stock,junio_valor,julio_stock,julio_valor,agosto_stock,agosto_valor,septiembre_stock,septiembre_valor,octubre_stock,
                        octubre_valor,noviembre_stock, noviembre_valor,diciembre_stock,diciembre_valor)VALUES(:id_inventario,:codigo_prod,:producto,:enero_stock,
                        :enero_valor,:febrero_stock,:febrero_valor,:marzo_stock,:marzo_valor,:abril_stock,:abril_valor,:mayo_stock,:mayo_valor,:junio_stock,:junio_valor,:julio_stock,
                        :julio_valor,:agosto_stock,:agosto_valor,:septiembre_stock,:septiembre_valor,:octubre_stock,:octubre_valor,:noviembre_stock,:noviembre_valor,:diciembre_stock,
                        :diciembre_valor)
                    ");

                    $insert_registro2->execute([
                        'id_inventario' => $registro_dt_inventario->id_inventario,
                        'codigo_prod' => $registro_dt_inventario->codigo_prod,
                        'producto' => $producto,
                        'enero_stock' => $registro_dt_inventario->eneC,
                        'enero_valor' => $registro_dt_inventario->eneV,
                        'febrero_stock' => $registro_dt_inventario->febC,
                        'febrero_valor' => $registro_dt_inventario->febV,
                        'marzo_stock' => $registro_dt_inventario->marC,
                        'marzo_valor' => $registro_dt_inventario->marV,
                        'abril_stock' => $registro_dt_inventario->abrC,
                        'abril_valor' => $registro_dt_inventario->abrV,
                        'mayo_stock' => $registro_dt_inventario->mayC,
                        'mayo_valor' => $registro_dt_inventario->mayV,
                        'junio_stock' => $registro_dt_inventario->junC,
                        'junio_valor' => $registro_dt_inventario->junV,
                        'julio_stock' => $registro_dt_inventario->julC,
                        'julio_valor' => $registro_dt_inventario->julV,
                        'agosto_stock' => $registro_dt_inventario->agoC,
                        'agosto_valor' => $registro_dt_inventario->agoV,
                        'septiembre_stock' => $registro_dt_inventario->sepC,
                        'septiembre_valor' => $registro_dt_inventario->sepV,
                        'octubre_stock' => $registro_dt_inventario->octC,
                        'octubre_valor' => $registro_dt_inventario->octV,
                        'noviembre_stock' => $registro_dt_inventario->novC,
                        'noviembre_valor' => $registro_dt_inventario->novV,
                        'diciembre_stock' => $registro_dt_inventario->dicC,
                        'diciembre_valor' => $registro_dt_inventario->dicV
                    ]);
                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollback();
                    echo "Error en el id_inventario para dt_kardex: ".$registro_dt_inventario->id_inventario."<br>".$e->getMessage();exit;
                }

                $registros_insertados++;

            }

            $conexion_migracion_prueba->commit();
            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_inventario
                MODIFY id_inventario INT AUTO_INCREMENT PRIMARY KEY;

                update dt_grupoinventario SET grupo = 'COBRE' WHERE id_grupo_inventario = 10;
                update dt_grupoinventario SET grupo = 'TINTAS' WHERE id_grupo_inventario = 24;  

                /*ALTER TABLE dt_proveeref
                ADD CONSTRAINT fk_dt_proveeref_dt_inventario1 FOREIGN KEY (id_inventario)
                REFERENCES dt_inventario (id_inventario);*/
            ");

            // Finaliza timer y entregamos mensaje 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_inventario y dt_kardex completada ".$registros_insertados." registros insertados en ambas tablas en ".$tiempo_transcurrido." segundos";

            return $mensaje;
            
        }

        public static function migraDtCodprodfinal($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Inicia timer

            $tiempo_inicio = microtime(true);

            //Consultamos dt_inventario en Sio 1

            $consulta_dt_codprodfinal = $conexion_sio1->query("
                SELECT id_cod,cod,nom_grupo,nom_producto,tamX,
                tamY,tamZ,tamL,sublineaneg,cliente,predominante,
                TipoProducto,presupuesto,nit_cliente  from dt_codprodfinal order by id_cod
            ");

            $array_dt_codprodfinal = $consulta_dt_codprodfinal->fetchAll(PDO::FETCH_OBJ);

            //Borramos el dt_inventario de Oz

            $conexion_migracion_prueba->exec("
                DROP TABLE dt_codprodfinal;
            ");

            //Creamos dt_codprodfinal sin llave primaria. Con las columnas adicionales y sin las columnas sobrantes
            //En base a la propuesta de Moni

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_codprodfinal` (
                    `id_codprodfinal` int NOT NULL AUTO_INCREMENT,
                    `fecha_creacion` datetime DEFAULT NULL,
                    `id_usuario_crea` int DEFAULT NULL,
                    `cod` varchar(50) NOT NULL,
                    `id_categoria` int DEFAULT NULL COMMENT 'Linea de negocio',
                    `id_sublinea` int DEFAULT NULL COMMENT 'Sublinea de negocio',
                    `nom_codigo` longtext,
                    `tam_x` decimal(10,2) DEFAULT NULL,
                    `tam_y` decimal(10,2) DEFAULT NULL,
                    `tam_z` decimal(10,2) DEFAULT NULL,
                    `tam_l` decimal(10,2) DEFAULT NULL,
                    `id_cliente` int DEFAULT NULL,
                    /*`id_grupo_inventario` int DEFAULT NULL,
                    `iluminacion` varchar(45) DEFAULT NULL,
                    `acabados` varchar(45) DEFAULT NULL,
                    `decoracion` varchar(45) DEFAULT NULL,*/
                    `tipo_producto` char(1) DEFAULT NULL,
                    /*`marca` varchar(100) DEFAULT NULL,*/
                    `tipo_presupuesto` int DEFAULT NULL COMMENT '0 = Cantidad , 1 = Metro Cuadrado, 2 = Metro lineal, 3 = Metro Cubico',
                    `nit` bigint DEFAULT NULL,
                    `estado` char(1) DEFAULT NULL,
                    KEY `id_codprodfinal` (`id_codprodfinal`)
                ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
            ");


            $array_clientes = $array_info_global['nit=>id_cliente'];

            $array_categorias = [
                'ADICIONALES' => 6,
                'AVISOS' => 1,
                'CONTABLE' => null,
                'MOBILIARIO' => 4, 
                'P.O.P' => 2,
                'SEÑALIZACION' => 3,
                'SERVICIOS' => 5
            ];

            $array_tipo_producto = [
                'A' => 1,
                'B' => 2,
                'C' => 3
            ];

            // $array_codigos_activos = [13585,13586,13587,13401,13386,13417,13418,13419,13420,13427,13432,13433,13434,13435,13436,13422,13423,13424,13425,13426,13437,13438,13439,
            // 13440,13441,13428,13429,13430,13431,13421,13442,13443,13444,13445,13446,13414,13415,13416,13447,13448,13449,13450,13451,12811,12824,13589,13588,13266,13314];
            
            $array_codigos_activos = [13491,13492,13528,13529,13704,13705,13706,13707,13708,13530,13525,13523,13526,13709,13710,13711,13712,13713,13524,13531,13493,13494,13495,
            13564,13512,13513,13573,13593,13594,13496,13565,13566,13590,13591,13592,13567,13568,13569,13570,13571,13572,13499,13500,13507,13518,13519,13520,13521,13508,13511,13522,
            13359,13509,13510,13548,13562,13550,13553,13551,13552,13559,13557,13558,13556,13549,13561,13560,13554,13555,13532,13533,13534,13537,13538,13539,13546,13543,13544,13545,
            13542,13536,13535,13360,13540,13541,13585,13586,13587,13401,13386,13417,13418,13419,13420,13427,13432,13433,13434,13435,13436,13422,13423,13424,13425,13426,13437,13438,
            13439,13440,13441,13428,13429,13430,13431,13421,13442,13443,13444,13445,13446,13414,13415,13416,13447,13448,13449,13450,13451,12811,12824,13589,13588,13266,13314,13670,
            13671,13672,13673,13674,13675,13676,13677,13678,13679,13680,13681,13682,13683,13714,13715,13716,13717,13718,13719,13720,13721,13722,13723,13724,13725,13726,13727,13728,
            13729,13731,13732,13733];
            
            $registros_insertados = 0;

            $conexion_migracion_prueba->beginTransaction();

            foreach($array_dt_codprodfinal as $registro_dt_codprodfinal){

                try{

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_codprodfinal (id_codprodfinal,fecha_creacion,id_usuario_crea,cod,id_categoria,id_sublinea,nom_codigo,tam_x,tam_y,tam_z,tam_l,id_cliente,tipo_producto,tipo_presupuesto,
                        nit,estado) VALUES(:id_codprodfinal,:fecha_creacion,:id_usuario_crea,:cod,:id_categoria,:id_sublinea,:nom_codigo,:tam_x,:tam_y,:tam_z,:tam_l,:id_cliente,:tipo_producto,:tipo_presupuesto,
                        :nit,:estado)
                    ");

                    $id_categoria = array_key_exists(trim($registro_dt_codprodfinal->nom_grupo),$array_categorias)?$array_categorias[trim($registro_dt_codprodfinal->nom_grupo)]:null;
                    $tipo_producto = array_key_exists(trim($registro_dt_codprodfinal->TipoProducto),$array_tipo_producto)?$array_tipo_producto[trim($registro_dt_codprodfinal->TipoProducto)]:null;
                    $nom_codigo = ControladorFuncionesAuxiliares::formateaString($registro_dt_codprodfinal->nom_producto);
                    $estado = in_array($registro_dt_codprodfinal->id_cod,$array_codigos_activos)?1:0;
                    $id_cliente = array_key_exists($registro_dt_codprodfinal->nit_cliente,$array_clientes)?$array_clientes[$registro_dt_codprodfinal->nit_cliente]['id_cliente']:null;

                    $insert_registro->execute([
                        'id_codprodfinal' => $registro_dt_codprodfinal->id_cod,
                        'fecha_creacion' => null,
                        'id_usuario_crea' => null,
                        'cod' => $registro_dt_codprodfinal->cod,
                        'id_categoria' => $id_categoria,
                        'id_sublinea' => null,
                        'nom_codigo' => $nom_codigo,
                        'tam_x' => $registro_dt_codprodfinal->tamY,
                        'tam_y' => $registro_dt_codprodfinal->tamX,
                        'tam_z' => $registro_dt_codprodfinal->tamZ,
                        'tam_l' => $registro_dt_codprodfinal->tamL,
                        'id_cliente' => $id_cliente,
                        'tipo_producto' => $tipo_producto,
                        'tipo_presupuesto' => null,
                        'nit' => $registro_dt_codprodfinal->nit_cliente,
                        'estado' => $estado
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollback();
                    echo "Error en el id_cod: ".$registro_dt_codprodfinal->id_cod."<br>".$e->getMessage();exit;
                }

                $registros_insertados++;

            }

            $conexion_migracion_prueba->commit();
            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_codprodfinal
                MODIFY id_codprodfinal INT AUTO_INCREMENT PRIMARY KEY
            ");

            // Finaliza timer y entregamos mensaje 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_codprodfinal completada ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos";

            return $mensaje;




        }

        public static function migraDtAcabados($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

           //Inicia timer

           $tiempo_inicio = microtime(true);
           
           //Consultamos dt_acabados en Sio 1

           $consulta_dt_acabados = $conexion_sio1->query("
            SELECT id_acabado,cod,acabado,tipo,clase,grupo,medida,unidadMin,
            vr_hora_hombre,xMin,xMax,yMin,yMax,grupo  from dt_acabados  order by id_acabado
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
            $registros_no_incluidos = 0;
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

                    if(in_array($registro_dt_acabados->grupo,['TRASFORMACION DE PLASTICOS','CORTE CNC MULTICAM RIGIDOS'])){
                        if($registro_dt_acabados->grupo == 'TRASFORMACION DE PLASTICOS'){
                            $id_clase_costo = 27;
                        }
                        if($registro_dt_acabados->grupo == 'CORTE CNC MULTICAM RIGIDOS'){
                            $id_clase_costo = 25;
                        }
                    }else{
                        $id_clase_costo = $registro_dt_acabados->clase != null?$registro_dt_acabados->clase:1;
                    }

                    if(!strpos($registro_dt_acabados->cod,'.')){
                        if($registro_dt_acabados->tipo == 0 || $registro_dt_acabados->tipo == 1){
                            $id_tipo_costo = 4;
                        }else{
                            $id_tipo_costo = $registro_dt_acabados->tipo;
                        }
                    }else{
                        $registros_no_incluidos++;
                        continue;
                    }

                    $acabado = ControladorFuncionesAuxiliares::formateaString($registro_dt_acabados->acabado);

                    

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_acabados(id_acabados,cod,acabado,id_tipo_costo,id_clase_costo,id_area,id_medida,unidad_minima,vr_hora_hombre,x_min,
                        x_max,y_min,y_max) VALUES(:id_acabados,:cod,:acabado,:id_tipo_costo,:id_clase_costo,:id_area,:id_medida,:unidad_minima,:vr_hora_hombre,
                        :x_min,:x_max,:y_min,:y_max)
                    ");

                    $insert_registro->execute([
                        'id_acabados' => $registro_dt_acabados->id_acabado,
                        'cod' => $registro_dt_acabados->cod,
                        'acabado' => $acabado,
                        'id_tipo_costo' => $id_tipo_costo,
                        'id_clase_costo' => $id_clase_costo,
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

            $mensaje = "Migración dt_acabados completada ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos"."\n<br>".$registros_no_incluidos." no incluidos por tener . en el código (nunca se usan en el sio 1 están excluidos en los filtros)";

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

            $array_areas = [
                "ALMACEN" => 12,
                "DECORACION" => 18,
                "DESPACHOS" => 19,
                "ENSAMBLE Y TERMINADO" => 16,
                "IMPRESION DIGITAL" => 17,
                "METALMECANICA" => 13,
                "PINTURA" => 14,
                "SUSTRATOS" => 15
            ];

            $array_materiales = $array_info_global['codigo_prod=>id_inventario'];
            
            $registros_insertados = 0;
            $registros_no_incluidos = 0;
            $registros_no_incluidos2 = 0;
            $conexion_migracion_prueba->beginTransaction();

        
            foreach($array_dt_inventarioxarea as $registro_dt_inventarioxarea){

                try{ 

                    $codigo_prod = $registro_dt_inventarioxarea->codigo_prod;

                    if($codigo_prod == null || $codigo_prod == ''){
                        $registros_no_incluidos++;
                        continue;
                    }

                    if(array_key_exists($registro_dt_inventarioxarea->nomArea,$array_areas)){
                        $id_area = $array_areas[$registro_dt_inventarioxarea->nomArea];
                    }else{
                        $registros_no_incluidos2++;
                        continue;
                    }

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_inventarioxarea(id_inventarioxarea,codigo_prod,stock,id_inventario,id_area)
                        VALUES(:id_inventarioxarea,:codigo_prod,:stock,:id_inventario,:id_area)
                    ");
                    $insert_registro->execute([
                        'id_inventarioxarea' => $registro_dt_inventarioxarea->id_inventxarea,
                        'codigo_prod' => $registro_dt_inventarioxarea->codigo_prod,
                        'stock' => $registro_dt_inventarioxarea->stock_area != null ?$registro_dt_inventarioxarea->stock_area:0,
                        'id_inventario' => array_key_exists($registro_dt_inventarioxarea->codigo_prod,$array_materiales)?$array_materiales[$registro_dt_inventarioxarea->codigo_prod]['id_inventario']:1,
                        'id_area' => $id_area
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

            $mensaje = "Migración dt_inventarioxarea completada ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos"."\n<br>".$registros_no_incluidos." no incluidos por no tener codigo_prod"."\n<br>".$registros_no_incluidos2." no incluidos por no pertenecer a las áreas de producción";

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
                    'fecha_ingreso_usuario' => date('Y-m-d H:i:s'),
                    'id_cargo' => 12,
                    'id_tipo_empleado' => 1,
                    'fecha_nacimiento_usuario' => date('Y-m-d H:i:s'),
                    'salario' => 'Vm0wd2VFMUdiRmRpUm1SWFYwZG9WRmx0ZUV0V01WbDNXa1pPVlUxV2NIcFdNakZIVm1zeFYySkVUbGho',
                    'eps_entidad' => '',
                    'pension_entidad' => '',
                    'cesantias' => '',
                    'cuenta' => '',
                    'banco' => '',
                    'id_horario' => 24,
                    'sexo' => 1,
                    'rh' => 3,
                    'fecha_retiro' => null,
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
                        'huella' => $registro_dt_vendedores->huella != ''?$registro_dt_vendedores->huella:0,
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

                    $nombre_proyecto = ControladorFuncionesAuxiliares::formateaString($nombre_proyecto);
                    
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
                tamanoY,tamanoZ,vUnidad,vTotal,id_proyecto_op,id_Coordinador,nOrden,ArchivoSCOD,a_pvo,u_pvo,cotizacion,item_ct,conciliado,
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

            //$array_subcategorias = $array_info_global['nOrden=>cod'];

            $array_data_subcategoria = $array_info_global['nOrden|item_ct=>dataSubcategoria'];

            //subcategorias desde el modulo de la op

            $subcategorias = [
                'EZT'=>2,
                'AEX'=>2,
                'EST'=>2,
                'DEP'=>1,
                'INS'=>3,
                'VEX'=>4,
                'GRT'=>6,
                'RPC'=>5,
                'DGT'=>7,
                'RGC'=>8,
                'MOB'=>9,
                'MBR'=>9,
                'OPC'=>10
            ];


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

                    if(array_key_exists($registro_dt_ordenes->nOrden,$array_data_subcategoria)&&array_key_exists($registro_dt_ordenes->item_ct,$array_data_subcategoria[$registro_dt_ordenes->nOrden])) {
                        $array_cobro_subcategoria = $array_data_subcategoria[$registro_dt_ordenes->nOrden][$registro_dt_ordenes->item_ct];
                    }else{
                        $array_cobro_subcategoria = null;
                    }

                    //Asignamos el cobro

                    $cobro = $array_cobro_subcategoria?$array_cobro_subcategoria['cobro']:null;

                    //Asignamos subcategoria

                    $id_subcategoria = $array_cobro_subcategoria&&array_key_exists($array_cobro_subcategoria['cod_subcategoria'],$subcategorias)?$subcategorias[$array_cobro_subcategoria['cod_subcategoria']]:null;


                    /*

                    if(array_key_exists($registro_dt_ordenes->nOrden,$array_subcategorias)&&array_key_exists($array_subcategorias[$registro_dt_ordenes->nOrden],$subcategorias)){
                        $id_subcategoria = $subcategorias[$array_subcategorias[$registro_dt_ordenes->nOrden]];
                    }elseif(array_key_exists($registro_dt_ordenes->modulo, $subcategorias) && $registro_dt_ordenes->modulo != null){
                        $id_subcategoria = $subcategorias[$registro_dt_ordenes->modulo];
                    }
                    else{
                        $id_subcategoria = null;
                    }*/

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
                        }elseif($registro_dt_ordenes->modulo == 'POP'){
                            $id_categoria = 2;
                        }
                        else{
                            $id_categoria = null;
                        }

                    }else{$id_categoria = null;}

                    //Buscamos id_cliente

                    if($registro_dt_ordenes->nit_op && array_key_exists($registro_dt_ordenes->nit_op,$array_clientes)){
                        $id_cliente = $array_clientes[$registro_dt_ordenes->nit_op]['id_cliente'];
                    }else{
                        $id_cliente = null;
                    }

                    

                    //Asignamos id_usuario 

                    $elaboro = trim($registro_dt_ordenes->elaboro);

                    $id_usuario = array_key_exists($elaboro,$array_info_global['vendedor=>id'])?$array_info_global['vendedor=>id'][$elaboro]:null;
                    
                    $id_vend = array_key_exists($registro_dt_ordenes->idVend,$array_info_global['codVendedor=>id'])?$array_info_global['codVendedor=>id'][$registro_dt_ordenes->idVend]:null;

                    $id_coordinador = array_key_exists($registro_dt_ordenes->id_Coordinador,$array_info_global['codVendedor=>id'])?$array_info_global['codVendedor=>id'][$registro_dt_ordenes->id_Coordinador]:null;

                    $referencia = $registro_dt_ordenes->referencia != null?$registro_dt_ordenes->referencia :null;

                    $referencia = ControladorFuncionesAuxiliares::formateaString($referencia);

                    $ref_general = ControladorFuncionesAuxiliares::formateaString($registro_dt_ordenes->ref_general);

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
                        'referencia' => $referencia,
                        'cod' => $var66,
                        'id_codprodfinal' =>$id_codprodfinal != null?$id_codprodfinal:null,
                        'id_subcategoria' => $id_subcategoria,
                        'id_categoria' => $id_categoria,
                        'cobro' => $cobro,
                        'id_cliente' => $id_cliente,
                        'ref_general' => $ref_general,
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
                        'nombre_proyecto' => $ref_general,
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

            try{
                $conexion_migracion_prueba->exec("
                  
                    UPDATE dt_ordenes
                    SET referencia = REPLACE(referencia, '├ô', 'Ó');
                    UPDATE dt_ordenes
                    SET referencia = REPLACE(referencia, '├│', 'ó');
                    UPDATE dt_ordenes
                    SET referencia = REPLACE(referencia, '├¡', 'í');
                    UPDATE dt_ordenes
                    SET referencia = REPLACE(referencia, '├ì', 'Í');
                    UPDATE dt_ordenes
                    SET referencia = REPLACE(referencia, '├ü', 'Á');
                    UPDATE dt_ordenes
                    SET referencia = REPLACE(referencia, '├í', 'á');
                    UPDATE dt_ordenes
                    SET referencia = REPLACE(referencia, '├®', 'é');
                
                    UPDATE dt_ordenes
                    SET ref_general = REPLACE(ref_general, '├ô', 'Ó');
                    UPDATE dt_ordenes
                    SET ref_general = REPLACE(ref_general, '├│', 'ó');
                    UPDATE dt_ordenes
                    SET ref_general = REPLACE(ref_general, '├¡', 'í');
                    UPDATE dt_ordenes
                    SET ref_general = REPLACE(ref_general, '├ì', 'Í');
                    UPDATE dt_ordenes
                    SET ref_general = REPLACE(ref_general, '├ü', 'Á');
                    UPDATE dt_ordenes
                    SET ref_general = REPLACE(ref_general, '├í', 'á');
                    UPDATE dt_ordenes
                    SET ref_general = REPLACE(ref_general, '├®', 'é');

                ");

            }catch(PDOException $e){
                echo "Hubo un error en el formateo de las columnas referencia y ref general ".$e->getMessage();
            }

            


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
                `id_area` int DEFAULT NULL,
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
                `id_tipo_costo` int DEFAULT NULL,
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

                if(array_key_exists($registro_dt_plantillas->nom_guia,$array_inventario)){
                    $nom_guia = $array_inventario[$registro_dt_plantillas->nom_guia]['producto'];
           

                    $vr_unid_g = $array_inventario[$registro_dt_plantillas->nom_guia]['valor_unidad_compra'] != 0 ? $array_inventario[$registro_dt_plantillas->nom_guia]['valor_unidad_compra']:$registro_dt_plantillas->vr_unid_G;
                }else{
                    $nom_guia = $registro_dt_plantillas->nom_guia;

                    $vr_unid_g = $registro_dt_plantillas->vr_unid_G;
                }
                
                $nom_guia = ControladorFuncionesAuxiliares::formateaString($nom_guia);

                $id_clase_costo = $registro_dt_plantillas->clase_guia;
                $id_tipo_costo = $registro_dt_plantillas->tipo_guia;

                $formula = str_replace(['x', 'y'], ['temp', 'x'], $registro_dt_plantillas->formula);
                $formula = str_replace('temp', 'y', $formula);

                if(!array_key_exists($registro_dt_plantillas->cod_guia,$array_codprodfinal)){
                    $registros_no_incluidos++;
                    continue;
                } //Las plantillas con codigo borrado se van
                try{
                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_plantilla(id_plantilla,nom_guia,cod_guia,cant_xun_g,vr_unid_g,vr_unit_g,estado,id_codprodfinal,
                        id_inventario,cierre,posicion,formula,comentarios,acepta_script,tipo_script,id_acabados,id_tipo_costo,id_clase_costo,id_medida,
                        tam_x,tam_y,tam_z,tam_l,factor_inicial,factor_dependiente,duracion)
                        VALUES(:id_plantilla,:nom_guia,:cod_guia,:cant_xun_g,:vr_unid_g,:vr_unit_g,:estado,:id_codprodfinal,
                        :id_inventario,:cierre,:posicion,:formula,:comentarios,:acepta_script,:tipo_script,:id_acabados,:id_tipo_costo,:id_clase_costo,:id_medida,
                        :tam_x,:tam_y,:tam_z,:tam_l,:factor_inicial,:factor_dependiente,:duracion)
                    ");
                    $insert_registro->execute([
                        'id_plantilla' =>$registro_dt_plantillas->id_guia,
                        'nom_guia' => $nom_guia,
                        'cod_guia' => $registro_dt_plantillas->codigo,
                        'cant_xun_g' => $registro_dt_plantillas->cantXun_G,
                        'vr_unid_g' => $vr_unid_g,
                        'vr_unit_g' => $registro_dt_plantillas->vr_unit_G,
                        'estado' => $registro_dt_plantillas->gestion,
                        'id_codprodfinal' => $array_codprodfinal[$registro_dt_plantillas->cod_guia]['id_cod'],
                        'id_inventario' => array_key_exists($registro_dt_plantillas->codigo,$array_inventario)?$array_inventario[$registro_dt_plantillas->codigo]['id_inventario']:null,
                        'cierre' => $registro_dt_plantillas->cierre,
                        'posicion' => $registro_dt_plantillas->posicion,
                        'formula' => $formula,
                        'comentarios' => $registro_dt_plantillas->comenGeneral,
                        'acepta_script' => $registro_dt_plantillas->aceptScript == 'SI' ? 1 : 2,
                        'tipo_script' => array_key_exists($registro_dt_plantillas->tipoScript,$array_tipo_script)?$array_tipo_script[$registro_dt_plantillas->tipoScript]:null,
                        'id_acabados' => array_key_exists($registro_dt_plantillas->codigo,$array_acabados)?$array_acabados[$registro_dt_plantillas->codigo]:null,
                        'id_tipo_costo' => $id_tipo_costo,
                        'id_clase_costo'=> $id_clase_costo,
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

                    $descripcion = ControladorFuncionesAuxiliares::formateaString($registro_tareasnew->Descripcion);

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
                        'descripcion' => $descripcion,
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

                    $nom_producto =  ControladorFuncionesAuxiliares::formateaString($registro_cotiza->producto_trm);
                    $descripcion =  ControladorFuncionesAuxiliares::formateaString($registro_cotiza->descripcion);

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
                        'nom_producto' => $nom_producto,
                        'n_cotiza' => $registro_cotiza->nCotiza,
                        'estado' => $estado,
                        'fecha_ingreso' => $registro_cotiza->fechaCot,
                        'fecha_compromiso' => $registro_cotiza->fechaEntregar,
                        'item' => $registro_cotiza->items,
                        'cantidad' => $registro_cotiza->cantidad1,
                        'v_unidad' => $registro_cotiza->vUnidad1,
                        'v_total' => $registro_cotiza->vTotal1,
                        'descripcion' => $descripcion,
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

                    $nombre_costo = ControladorFuncionesAuxiliares::formateaString($registro_dt_costos->nom_costo);

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
                        'nombre_costo' => $nombre_costo,
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
                `id_disenolista` int NOT NULL AUTO_INCREMENT,
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
                PRIMARY KEY (`id_disenolista`),
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

                    $archivo = ControladorFuncionesAuxiliares::formateaString($registro_disenolista->archivo);

                    $foto = ControladorFuncionesAuxiliares::formateaString($registro_disenolista->foto);

                    $ruta = ControladorFuncionesAuxiliares::formateaString($registro_disenolista->ruta);

                    if($id_ordenes == null){
                        $registros_no_incluidos++;
                        continue;
                    }

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_diseno(/*id_disenolista,*/grupo,uniones,explosivo_procesos_ant,fotomontajes,modulacion,
                        modulacion_lam_perf,archivos_impr,detalles_cons,sistemas_ins,archivos_corte,corte_dobleces,
                        explosivo_mat,detalles_ilum,plantilla_insta,plano_coordenadas,plano_electrico,plano_cargue,
                        plano_especial,archivo,fecha_inicio,id_usuario,n_ordenes,id_ordenes,fecha_final,otros,
                        otros_observaciones,fecha_inicio_real,fecha_final_real,foto,ruta,fecha_final_cli,estado,ok,
                        creacion_codigos,presupuesto_mo,definir_mp,creacion_gantt)
                        VALUES(/*:id_disenolista,*/:grupo,:uniones,:explosivo_procesos_ant,:fotomontajes,:modulacion,
                        :modulacion_lam_perf,:archivos_impr,:detalles_cons,:sistemas_ins,:archivos_corte,:corte_dobleces,
                        :explosivo_mat,:detalles_ilum,:plantilla_insta,:plano_coordenadas,:plano_electrico,:plano_cargue,
                        :plano_especial,:archivo,:fecha_inicio,:id_usuario,:n_ordenes,:id_ordenes,:fecha_final,:otros,
                        :otros_observaciones,:fecha_inicio_real,:fecha_final_real,:foto,:ruta,:fecha_final_cli,:estado,:ok,
                        :creacion_codigos,:presupuesto_mo,:definir_mp,:creacion_gantt) 
                    ");

                    

                    $insert_registro->execute([
                        //'id_disenolista' => $registro_disenolista->id_diseno,
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
                        'archivo' => $archivo,
                        'fecha_inicio' => $registro_disenolista->fechaInicio,
                        'id_usuario' => $id_usuario,
                        'n_ordenes' => $registro_disenolista->nOrden,
                        'id_ordenes' => $id_ordenes,
                        'fecha_final' => $registro_disenolista->fechaFinal,
                        'otros' => $registro_disenolista->otros,
                        'otros_observaciones' => $registro_disenolista->otrosObser,
                        'fecha_inicio_real' => $registro_disenolista->fechaIncioR,
                        'fecha_final_real' => $registro_disenolista->fechaFinalR,
                        'foto' => $foto,
                        'ruta' => $ruta,
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

            // $conexion_migracion_prueba->exec("
            //     ALTER TABLE dt_diseno
            //     MODIFY id_disenolista INT AUTO_INCREMENT PRIMARY KEY
            // ");

            try{
                $conexion_migracion_prueba->exec("
                  
                    UPDATE dt_diseno
                    SET archivo = REPLACE(archivo, '├│', 'ó');
                    UPDATE dt_diseno
                    SET archivo = REPLACE(archivo, '├¡', 'í');
                    UPDATE dt_diseno
                    SET archivo = REPLACE(archivo, '├ì', 'Í');
                    UPDATE dt_diseno
                    SET archivo = REPLACE(archivo, '├ü', 'Á');
                    UPDATE dt_diseno
                    SET archivo = REPLACE(archivo, '├í', 'á');
                    UPDATE dt_diseno
                    SET archivo = REPLACE(archivo, '├®', 'é');
                    
                    UPDATE dt_diseno
                    SET foto = REPLACE(foto, '├│', 'ó');
                    UPDATE dt_diseno
                    SET foto = REPLACE(foto, '├¡', 'í');
                    UPDATE dt_diseno
                    SET foto = REPLACE(foto, '├ì', 'Í');
                    UPDATE dt_diseno
                    SET foto = REPLACE(foto, '├ü', 'Á');
                    UPDATE dt_diseno
                    SET foto = REPLACE(foto, '├í', 'á');
                    UPDATE dt_diseno
                    SET foto = REPLACE(foto, '├®', 'é');
                    
                    UPDATE dt_diseno
                    SET ruta = REPLACE(ruta, '├│', 'ó');
                    UPDATE dt_diseno
                    SET ruta = REPLACE(ruta, '├¡', 'í');
                    UPDATE dt_diseno
                    SET ruta = REPLACE(ruta, '├ì', 'Í');
                    UPDATE dt_diseno
                    SET ruta = REPLACE(ruta, '├ü', 'Á');
                    UPDATE dt_diseno
                    SET ruta = REPLACE(ruta, '├í', 'á');
                    UPDATE dt_diseno
                    SET ruta = REPLACE(ruta, '├®', 'é');

                ");

            }catch(PDOException $e){
                echo "Hubo un error en el formateo de las columnas archivo, foto y ruta ".$e->getMessage();
            }

            // Finaliza timer y entregamos mensaje 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_diseno completada ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos"."\n<br>".$registros_no_incluidos." registros no incluidos por no tener id_ordenes relacionado"."\n<br>"."adicionalmente no se incluyeron ".$registros_vacios." por estar completamente vacios";

            return $mensaje;


        }

        public static function migraDtProgramacionDiseno($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Iniciamos timer

            $tiempo_inicio = microtime(true);
            

            //Hacemos el array con la información del dt_programacion_diseno del Sio 1

            $consulta_dt_programacion_diseno = $conexion_sio1->query("
                SELECT id_programacion_diseno,id_cod,cod,estado,n_programacion  from dt_programacion_diseno
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

            

            //$array_codprodfinal = $array_info_global['cod=>id_codpdrodfinal'];

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
                        'id_codprodfinal' => $registro_dt_programacion_diseno->id_cod, //array_key_exists($cod,$array_codprodfinal)?$array_codprodfinal[$cod]['id_cod']:null,
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
                ) ENGINE=InnoDB AUTO_INCREMENT=448 DEFAULT CHARSET=utf8mb3;
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

                    $foto = ControladorFuncionesAuxiliares::formateaString($registro_dt_programacion_diseno->foto);

                    $ruta = ControladorFuncionesAuxiliares::formateaString($registro_dt_programacion_diseno->ruta);

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
                        'ruta' => $ruta,
                        'foto' => $foto,
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

            try{
                $conexion_migracion_prueba->exec("
                  
                    UPDATE dt_estructura_p_diseno
                    SET archivo = REPLACE(archivo, '├│', 'ó');
                    UPDATE dt_estructura_p_diseno
                    SET archivo = REPLACE(archivo, '├¡', 'í');
                    UPDATE dt_estructura_p_diseno
                    SET archivo = REPLACE(archivo, '├ì', 'Í');
                    UPDATE dt_estructura_p_diseno
                    SET archivo = REPLACE(archivo, '├ü', 'Á');
                    UPDATE dt_estructura_p_diseno
                    SET archivo = REPLACE(archivo, '├®', 'é');
                    
                    UPDATE dt_estructura_p_diseno
                    SET foto = REPLACE(foto, '├│', 'ó');
                    UPDATE dt_estructura_p_diseno
                    SET foto = REPLACE(foto, '├¡', 'í');
                    UPDATE dt_estructura_p_diseno
                    SET foto = REPLACE(foto, '├ì', 'Í');
                    UPDATE dt_estructura_p_diseno
                    SET foto = REPLACE(foto, '├ü', 'Á');
                    UPDATE dt_estructura_p_diseno
                    SET foto = REPLACE(foto, '├®', 'é');
                    
                    UPDATE dt_estructura_p_diseno
                    SET ruta = REPLACE(ruta, '├│', 'ó');
                    UPDATE dt_estructura_p_diseno
                    SET ruta = REPLACE(ruta, '├¡', 'í');
                    UPDATE dt_estructura_p_diseno
                    SET ruta = REPLACE(ruta, '├ì', 'Í');
                    UPDATE dt_estructura_p_diseno
                    SET ruta = REPLACE(ruta, '├ü', 'Á');
                    UPDATE dt_estructura_p_diseno
                    SET ruta = REPLACE(ruta, '├®', 'é');

                ");

            }catch(PDOException $e){
                echo "Hubo un error en el formateo de las columnas archivo, foto y ruta ".$e->getMessage();
            }

            
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
                    
                    if($registro_dt_estructura_p_diseno->archivo != null && $registro_dt_estructura_p_diseno->foto == null){
                        $recurso = ControladorFuncionesAuxiliares::formateaString($registro_dt_estructura_p_diseno->archivo);
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
                    }
                    elseif($registro_dt_estructura_p_diseno->foto != null && $registro_dt_estructura_p_diseno->archivo == null){
                        $recurso = ControladorFuncionesAuxiliares::formateaString($registro_dt_estructura_p_diseno->foto);
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
                    elseif($registro_dt_estructura_p_diseno->archivo != null && $registro_dt_estructura_p_diseno->foto != null){
                        $recurso = ControladorFuncionesAuxiliares::formateaString($registro_dt_estructura_p_diseno->archivo);
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
                        $recurso = ControladorFuncionesAuxiliares::formateaString($registro_dt_estructura_p_diseno->foto);
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
                        $registros_insertados++;
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
                    $nombre_costo = ControladorFuncionesAuxiliares::formateaString($registro_tareas->nom_costo);

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
                        'nombre_costo' => $nombre_costo,
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

            $consulta_compras_item_op_borrado = $conexion_sio1->query("
                SELECT ids_despiece  
                FROM dt_compras
                WHERE ids_despiece NOT IN (SELECT id_costo FROM dt_costos) and ids_despiece != 0
            ");

            $array_compras_item_op_borrado = $consulta_compras_item_op_borrado->fetchAll(PDO::FETCH_COLUMN); //var_dump($array_compras_item_op_borrado);exit;


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

                    $detalle_oc = ControladorFuncionesAuxiliares::formateaString($registro_compras->detalle_oc);

                    $id_proveedores = array_key_exists($registro_compras->proveedor,$array_proveedores)?$array_proveedores[$registro_compras->proveedor]:null;

                    $n_ordenes = array_key_exists($registro_compras->ids_despiece,$array_costos)?$array_costos[$registro_compras->ids_despiece]['n_ordenes']:null;
                    $id_ordenes = array_key_exists($registro_compras->ids_despiece,$array_costos)?$array_costos[$registro_compras->ids_despiece]['id_ordenes']:null;
                    $id_usuario = array_key_exists($elaboro_oc,$array_usuarios)?$array_usuarios[$elaboro_oc]:null;
                    $id_tipo_pago = array_key_exists($registro_compras->formaPago,$array_tipo_pago)?$array_tipo_pago[$registro_compras->formaPago]:null;
                    $area_entrega = array_key_exists($registro_compras->Compromiso,$array_areas)?$array_areas[$registro_compras->Compromiso]:null;
                    $observa_oc =  ControladorFuncionesAuxiliares::formateaString($registro_compras->observa_oc);
                    $observaciones_os =  ControladorFuncionesAuxiliares::formateaString($registro_compras->descripcionT);

                    if($registro_compras->ids_despiece == 0){
                        $id_costos = null;
                        $id_costo_alternativo = null;
                    }elseif(in_array($registro_compras->ids_despiece,$array_compras_item_op_borrado)){
                        $id_costos = null;
                        $id_costo_alternativo = $registro_compras->ids_despiece;
                    }else{
                        $id_costos = $registro_compras->ids_despiece;
                        $id_costo_alternativo = null;
                    }
                 

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
                        iva_oc,puc_iva,rtfte_oc,puc_rtfte,rtiva_oc,puc_rtiva,rtica_oc,puc_rtica,dto_fin,observa_oc,estado,id_usuario,
                        id_tipo_pago,tipo_inv,fecha_inicio,area_realiza,area_entrega,cantidad,observaciones_os,consecutivo,nit,n_actualizaciones,id_costo) VALUES(:id_compras,:item_oc,:id_proveedores,:n_compra,:fecha_oc,:fecha_compromiso,
                        :fecha_aprobacion,:n_ordenes,:id_ordenes,:id_costos,:cant_sol,:saldo_salida,:cod_producto,:detalle_oc,:vr_unidad,
                        :vr_total,:puc_id,:puc_prod,:puc_contra,:iva_oc,:puc_iva,:rtfte_oc,:puc_rtfte,:rtiva_oc,:puc_rtiva,:rtica_oc,:puc_rtica,
                        :dto_fin,:observa_oc,:estado,:id_usuario,:id_tipo_pago,:tipo_inv,:fecha_inicio,:area_realiza,:area_entrega,
                        :cantidad,:observaciones_os,:consecutivo,:nit,:n_actualizaciones,:id_costo)
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
                        'id_costos' => $id_costos,
                        'cant_sol' => $registro_compras->cantidad_sol,
                        'saldo_salida' => $registro_compras->saldo_salida,
                        'cod_producto' => $registro_compras->cod_producto,
                        'detalle_oc' => $detalle_oc,
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
                        'observa_oc' => $observa_oc,
                        'estado' => $registro_compras->estado_oc,
                        'id_usuario' => $id_usuario,
                        'id_tipo_pago' => $id_tipo_pago,
                        'tipo_inv' => $registro_compras->tipo_inv,
                        'fecha_inicio' => $registro_compras->FechaInicio,
                        'area_realiza' => null,
                        'area_entrega' => $area_entrega,
                        'cantidad' => $registro_compras->cantidadT,
                        'observaciones_os' => $observaciones_os,
                        'consecutivo' => $registro_compras->contratosP,
                        'nit' => $registro_compras->nit_provee,
                        'n_actualizaciones' => $registro_compras->version,
                        'id_costo' => $id_costo_alternativo
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
            
            try{
                $conexion_migracion_prueba->exec("
                    update dt_compras set id_costo = id_costos
                    WHERE id_costos NOT IN (SELECT id_costo FROM dt_costos) and id_costos != 0;
                    
                    update dt_compras set id_costos = null
                    WHERE id_costos NOT IN (SELECT id_costo FROM dt_costos) and id_costos != 0;
                ");
            }catch(PDOException $e){
                echo "Error al quitar los id_costos huerfanos y colocarlos en id_costo ".$e->getMessage();
            }

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
                cons_contable,fechaReal from dt_rotacion dr  order by id_rotacion 
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
                `fecha_pre_act` datetime DEFAULT NULL,
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
                /*`id_costos` int DEFAULT NULL,
                `id_compras` int DEFAULT NULL,
                `id_orden` int DEFAULT NULL,
                `id_rotaciones` int DEFAULT NULL,*/
                `id_inventario` int DEFAULT NULL,
                KEY `fk_inventario` (`id_inventario`),
                KEY `indx_n_rotacion` (`n_rotacion`),
                KEY `indx_cod_prod` (`cod_prod`),
                CONSTRAINT `dt_rotacion_ibfk_1` FOREIGN KEY (`id_inventario`) REFERENCES `dt_inventario` (`id_inventario`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
            ");

            $array_areas = $array_info_global['id_area'];

            $array_usuarios = $array_info_global['vendedor=>id'];

            $array_codigos = $array_info_global['codigo_prod=>id_inventario'];

            $array_data_compras = $array_info_global['n_compra|cod_producto=>data_compras'];

            $array_id_compras = $array_info_global['id_costos=>id_compras'];

            $array_data_costos = $array_info_global['id_costo=>data_costos'];

            $array_materiales = $array_info_global['codigo_prod=>id_inventario'];

            $array_pucs = $array_info_global['cuenta=>id_pucs_oc'];

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
                    if($registro_rotaciones->puc_prodrt != null && $registro_rotaciones->puc_prodrt != ''){
                        $puc_id = array_key_exists($registro_rotaciones->puc_prodrt,$array_pucs)?$array_pucs[$registro_rotaciones->puc_prodrt]:null;
                    }else{
                        $puc_id = null;
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
                            
                        }else{

                            $id_ordenes = null;
                            $id_costo = null;
                            $id_compra = null;
                            $n_ordenes = null;

                        }

                    }

                    $id_inventario = array_key_exists($registro_rotaciones->cod_prod,$array_materiales)?$array_materiales[$registro_rotaciones->cod_prod]['id_inventario']:null;

                    if($registro_rotaciones->tipo == 13){
                        $id_area = 1;
                    }else{
                        $id_area = array_key_exists(trim($registro_rotaciones->recibido),$array_areas)?$array_areas[trim($registro_rotaciones->recibido)]:null;
                    }

                    if($registro_rotaciones->tipo == 26){
                        $id_encargado = null;
                    }else{
                        $id_encargado = array_key_exists(trim($registro_rotaciones->enviado_a),$array_usuarios)?$array_usuarios[trim($registro_rotaciones->enviado_a)]:null;
                    }

                    if(trim($registro_rotaciones->elaboro) == 'DESARROLLADOR SAVIV'){
                        $id_usuario = 1; 
                    }else{
                        $id_usuario = array_key_exists(trim($registro_rotaciones->elaboro),$array_usuarios)?$array_usuarios[trim($registro_rotaciones->elaboro)]:null;
                    }

                    

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_rotacion(id_rotacion,cantidad,cod_prod,cons_contable,estado,factura,factura_proveedor,fecha,fecha_pre_act,fecha_factura,fecha_legalizacion,
                        fecha_vencimiento,id_area,id_compra,id_costo,id_encargado,id_ordenes,id_puc,id_tipo_rotacion,id_usuario,item_rotacion,letra,letra_cta,n_compra,
                        n_ordenes,n_remision_prov,n_rotacion,observaciones,puc_contra,puc_ivart,puc_prodrt,puc_rticart,puc_rtftert,puc_rtivart,rtfte_rt,rtica_rt,rtiva_rt,
                        vr_total,vr_unidad,id_inventario)
                        VALUES(:id_rotacion,:cantidad,:cod_prod,:cons_contable,:estado,:factura,:factura_proveedor,:fecha,:fecha_pre_act,:fecha_factura,:fecha_legalizacion,
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
                        'fecha_pre_act' => $registro_rotaciones->fechaReal,
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

        public static function migraDtSolicitudGR($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Iniciamos timer

            $tiempo_inicio = microtime(true);
            

            //Hacemos el array con la información del dt_solicitud_g_r del Sio 1

            $consulta_dt_solicitud_g_r = $conexion_sio1->query("
                SELECT id_solicitudgr,fecha_registro,garantia,descripcion,n_solicitud,estado,nombre_g_r,
                archivo,archivo_2,archivo_3,valor_g_r,sub_causa,reporta,id_orden  from dt_solicitud_g_r dsgr 
            ");

            $array_dt_solicitud_g_r = $consulta_dt_solicitud_g_r->fetchAll(PDO::FETCH_OBJ);

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_solicitud_g_r` (
                `id_solicitud_g_r` int NOT NULL AUTO_INCREMENT,
                `fecha_registro` datetime(6) NOT NULL,
                `tipo_g_r` int NOT NULL COMMENT 'Garantía  =  1 , Reproceso = 0',
                `descripcion` varchar(608) NOT NULL,
                `n_solicitud` int NOT NULL,
                `estado` int NOT NULL,
                `nombre_g_r` varchar(256) NOT NULL,
                `archivo_1` varchar(256) NOT NULL,
                `archivo_2` varchar(256) DEFAULT NULL,
                `archivo_3` varchar(256) DEFAULT NULL,
                `valor_g_r` double DEFAULT NULL,
                `id_causas` int NOT NULL,
                `user_id` int NOT NULL,
                `id_ordenes` int NOT NULL,
                `id_orden` int DEFAULT NULL,
                `id_solicitudgr` int DEFAULT NULL,
                PRIMARY KEY (`id_solicitud_g_r`),
                KEY `fk_dt_solicitud_g_r_dt_causas1` (`id_causas`),
                KEY `fk_dt_solicitud_g_r_user1` (`user_id`),
                KEY `fk_dt_solicitud_g_r_dt_ordenes1` (`id_ordenes`),
                CONSTRAINT `fk_dt_solicitud_g_r_dt_causas1` FOREIGN KEY (`id_causas`) REFERENCES `dt_causas` (`id_causas`),
                CONSTRAINT `fk_dt_solicitud_g_r_dt_ordenes1` FOREIGN KEY (`id_ordenes`) REFERENCES `dt_ordenes` (`id_ordenes`),
                CONSTRAINT `fk_dt_solicitud_g_r_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
            ");

            $array_usuarios = $array_info_global['codVendedor=>id'];

            $array_ordenes = $array_info_global['n_ordenes|item_op=>id_ordenes'];

            $registros_insertados = 0;

            $registros_no_incluidos = 0;

            $conexion_migracion_prueba->beginTransaction();

            foreach($array_dt_solicitud_g_r as $registro_solicitud_g_r){

                try{

                    if(in_array($registro_solicitud_g_r->id_orden,$array_ordenes['lista_id_ordenes'])){
                        $id_orden = $registro_solicitud_g_r->id_orden;
                    }else{
                        $registros_no_incluidos++;
                        continue;
                    }

                    $user_id = array_key_exists($registro_solicitud_g_r->reporta,$array_usuarios)?$array_usuarios[$registro_solicitud_g_r->reporta]:null;
                    $nombre_g_r = ControladorFuncionesAuxiliares::formateaString($registro_solicitud_g_r->nombre_g_r);

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_solicitud_g_r(fecha_registro,tipo_g_r,descripcion,n_solicitud,estado,nombre_g_r,archivo_1,archivo_2,archivo_3,
                        valor_g_r,id_causas,user_id,id_ordenes) VALUES(:fecha_registro,:tipo_g_r,:descripcion,:n_solicitud,:estado,
                        :nombre_g_r,:archivo_1,:archivo_2,:archivo_3,:valor_g_r,:id_causas,:user_id,:id_ordenes)
                    ");

                    $insert_registro->execute([
                        'fecha_registro' => $registro_solicitud_g_r->fecha_registro,
                        'tipo_g_r' => $registro_solicitud_g_r->garantia,
                        'descripcion' => $registro_solicitud_g_r->descripcion,
                        'n_solicitud' => $registro_solicitud_g_r->n_solicitud,
                        'estado' => $registro_solicitud_g_r->estado,
                        'nombre_g_r' => $nombre_g_r,
                        'archivo_1' => $registro_solicitud_g_r->archivo,
                        'archivo_2' => $registro_solicitud_g_r->archivo_2,
                        'archivo_3' => $registro_solicitud_g_r->archivo_3,
                        'valor_g_r' => $registro_solicitud_g_r->valor_g_r,
                        'id_causas' => $registro_solicitud_g_r->sub_causa,
                        'user_id' => $user_id,
                        'id_ordenes' => $registro_solicitud_g_r->id_orden
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "<pre>";
                    echo "Hay un problema con el id_solicitudgr ".$registro_solicitud_g_r->id_solicitudgr."<br> ".$e->getMessage();exit;
                }

                $registros_insertados++;

            }

            $conexion_migracion_prueba->commit();

            
            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_solicitud_g_r completada, ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos"."\n<br>".$registros_no_incluidos." registros no incluidos por estar ligadas a id_ordenes que ya no existen o fueron borrados";

            return $mensaje;

        }

        public static function migraDtHistoricoGR($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Iniciamos timer

            $tiempo_inicio = microtime(true);
            

            //Hacemos el array con la información del dt_historico_g_r del Sio 1

            $consulta_dt_historico_g_r = $conexion_sio1->query("
                SELECT * FROM dt_historico_g_r
            ");

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_historico_g_r` (
                `id_historico_g_r` int NOT NULL AUTO_INCREMENT,
                `fecha_registro` date NOT NULL,
                `observacion` varchar(256) NOT NULL,
                `observacion_apro` varchar(256) NOT NULL,
                `id_solicitud_g_r` int NOT NULL,
                `id_user` int NOT NULL,
                PRIMARY KEY (`id_historico_g_r`),
                KEY `fk_dt_historico_g_r_dt_solicitud_g_r1` (`id_solicitud_g_r`),
                KEY `fk_dt_historico_g_r_user1` (`id_user`),
                CONSTRAINT `fk_dt_historico_g_r_dt_solicitud_g_r1` FOREIGN KEY (`id_solicitud_g_r`) REFERENCES `dt_solicitud_g_r` (`id_solicitud_g_r`),
                CONSTRAINT `fk_dt_historico_g_r_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
            ");

            $array_dt_historico_g_r = $consulta_dt_historico_g_r->fetchAll(PDO::FETCH_OBJ);

            $array_usuarios = $array_info_global['codVendedor=>id'];

            $array_solicitud = $array_info_global['n_solicitud=>id_solicitud_g_r'];

            $registros_insertados = 0;

            $registros_no_incluidos = 0;

            $conexion_migracion_prueba->beginTransaction();

            foreach($array_dt_historico_g_r as $registro_historico_g_r){

                try{

                    $id_user = array_key_exists($registro_historico_g_r->idUser,$array_usuarios)?$array_usuarios[$registro_historico_g_r->idUser]:989;

                    if(array_key_exists($registro_historico_g_r->n_solicitud,$array_solicitud)){
                        $id_solicitud_g_r = $array_solicitud[$registro_historico_g_r->n_solicitud];
                    }else{
                        $registros_no_incluidos++;
                        continue;
                    }

                    

                    $observacion_apro = $registro_historico_g_r->observacion_apro != null ? $registro_historico_g_r->observacion_apro:'Sin comentarios desde el Sio1';

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_historico_g_r(fecha_registro,observacion,observacion_apro,id_solicitud_g_r,id_user)
                        VALUES(:fecha_registro,:observacion,:observacion_apro,:id_solicitud_g_r,:id_user)
                    ");

                    $insert_registro->execute([
                        'fecha_registro' => $registro_historico_g_r->fecha,
                        'observacion' => $registro_historico_g_r->observacion, 
                        'observacion_apro' => $observacion_apro,
                        'id_solicitud_g_r' => $id_solicitud_g_r,
                        'id_user' => $id_user
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "<pre>";
                    echo "Hay un problema con el id_historico_g_r ".$registro_historico_g_r->id_historico_g_r."<br> ".$e->getMessage();exit;
                }

                $registros_insertados++;

            }

            $conexion_migracion_prueba->commit();

            
            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_historico_g_r completada, ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos"."\n<br>".$registros_no_incluidos." no incluidos por pertenecer a solicitudes que no se migraron, probablemente porque la op a la que se ligó fue borrada";

            return $mensaje;

        }

        public static function migraDtFacturaProveedor($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Iniciamos timer

            $tiempo_inicio = microtime(true);
            

            //Hacemos el array con la información del dt_fa_provee del Sio 1

            $consulta_dt_fa_provee = $conexion_sio1->query("
                SELECT id_fa,cons_contab,factura,fecha_ref,fecha_FA,fecha_vence,nit_fa,autoriza,
                valor,factura,rc,oc,op,puc_valor,ivaVr,rtFteVr,rtIvaVr,rtIcaVr,puc_ivaVr,puc_rtFteVr,
                puc_rtIvaVr,puc_rtIcaVr from dt_fa_provee order by id_fa
            ");

            $array_dt_fa_provee = $consulta_dt_fa_provee->fetchAll(PDO::FETCH_OBJ);

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_factura_proveedor` (
                `id_factura_proveedor` int NOT NULL AUTO_INCREMENT,
                `n_factura` int DEFAULT NULL,
                `factura` varchar(100) DEFAULT NULL,
                `fecha_creacion` datetime DEFAULT NULL,
                `fecha_factura` date DEFAULT NULL,
                `fecha_vencimiento` date DEFAULT NULL,
                `id_proveedor` int NOT NULL,
                `id_usuario` int NOT NULL,
                `valor` double DEFAULT NULL,
                `estado` smallint DEFAULT NULL,
                `n_rotaciones` varchar(50) DEFAULT NULL,
                `id_compras` varchar(50) DEFAULT NULL,
                `n_ordenes` varchar(50) DEFAULT NULL,
                `id_tipo_factura` smallint NOT NULL,
                `puc_prodrt` varchar(30) DEFAULT NULL,
                `iva_rt` double DEFAULT NULL,
                `rtfte_rt` double DEFAULT NULL,
                `rtiva_rt` double DEFAULT NULL,
                `rtica_rt` double DEFAULT NULL,
                `puc_ivart` varchar(30) DEFAULT NULL,
                `puc_rtftert` varchar(30) DEFAULT NULL,
                `puc_rtivart` varchar(30) DEFAULT NULL,
                `puc_rticart` varchar(30) DEFAULT NULL,
                PRIMARY KEY (`id_factura_proveedor`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
            ");

            $array_proveedores;

            $array_usuarios = $array_info_global['vendedor=>id'];

            $array_proveedores = $array_info_global['nit=>id_proveedores'];

            $registros_insertados = 0;
            $registros_no_incluidos = 0;

            $conexion_migracion_prueba->beginTransaction();

            foreach($array_dt_fa_provee as $registro_fa_prove){

                try{
                    if($registro_fa_prove->nit_fa == 444444625){
                        $id_proveedor = 1945;
                    }
                    elseif(array_key_exists($registro_fa_prove->nit_fa,$array_proveedores)){
                        $id_proveedor = $array_proveedores[$registro_fa_prove->nit_fa];
                    }else{
                        $registros_no_incluidos++;
                        continue;
                    }

                    if($registro_fa_prove->autoriza == 'NELSON FORERO'){
                        $id_usuarios = 55;
                    }else{
                        $id_usuarios = array_key_exists($registro_fa_prove->autoriza,$array_usuarios)?$array_usuarios[$registro_fa_prove->autoriza]:1;
                    }
                    if(strpos($registro_fa_prove->factura,'@')){
                        $estado = 2; //anulada
                    }else{
                        $estado = 1; //activa
                    }
                    

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_factura_proveedor(n_factura,factura,fecha_creacion,fecha_factura,fecha_vencimiento,id_proveedor,id_usuario,
                        valor,estado,n_rotaciones,id_compras,n_ordenes,id_tipo_factura,puc_prodrt,iva_rt,rtfte_rt,rtiva_rt,rtica_rt,puc_ivart,puc_rtftert,
                        puc_rtivart,puc_rticart) VALUES (:n_factura,:factura,:fecha_creacion,:fecha_factura,:fecha_vencimiento,:id_proveedor,:id_usuario,
                        :valor,:estado,:n_rotaciones,:id_compras,:n_ordenes,:id_tipo_factura,:puc_prodrt,:iva_rt,:rtfte_rt,:rtiva_rt,:rtica_rt,:puc_ivart,
                        :puc_rtftert,:puc_rtivart,:puc_rticart)
                    ");

                    $insert_registro->execute([
                        'n_factura' => $registro_fa_prove->cons_contab,
                        'factura' => $registro_fa_prove->factura,
                        'fecha_creacion' => $registro_fa_prove->fecha_ref,
                        'fecha_factura' => $registro_fa_prove->fecha_FA,
                        'fecha_vencimiento' => $registro_fa_prove->fecha_vence,
                        'id_proveedor' => $id_proveedor,
                        'id_usuario' => $id_usuarios,
                        'valor' => $registro_fa_prove->valor,
                        'estado' => $estado,
                        'n_rotaciones' => $registro_fa_prove->rc,
                        'id_compras' => $registro_fa_prove->oc,
                        'n_ordenes' => $registro_fa_prove->op,
                        'id_tipo_factura' => 1,
                        'puc_prodrt' => $registro_fa_prove->puc_valor,
                        'iva_rt' => $registro_fa_prove->ivaVr,
                        'rtfte_rt' => $registro_fa_prove->rtFteVr,
                        'rtiva_rt' => $registro_fa_prove->rtIvaVr,
                        'rtica_rt' => $registro_fa_prove->rtIcaVr,
                        'puc_ivart' => $registro_fa_prove->puc_ivaVr,
                        'puc_rtftert' => $registro_fa_prove->puc_rtFteVr,
                        'puc_rtivart' => $registro_fa_prove->puc_rtIvaVr,
                        'puc_rticart' => $registro_fa_prove->puc_rtIcaVr
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "<pre>";
                    echo "Hay un problema con el id_fa ".$registro_fa_prove->id_fa."<br> ".$e->getMessage();exit;
                }

                $registros_insertados++;

            }

            $conexion_migracion_prueba->commit();

            
            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_factura_proveedor completada, ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos"."\n<br>".$registros_no_incluidos." registros no incluidos por pertenecer a proveedores borrados de la bd, no puede haber registro sin id_proveedor creado";

            return $mensaje;


        }

        public static function migraDtFactura($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Iniciamos timer

            $tiempo_inicio = microtime(true);
            

            //Hacemos el array con la información del dt_remisiones(Solo remisiones relacionadas con facturas) del Sio 1

            $consulta_dt_remisiones_fac = $conexion_sio1->query("
                SELECT r.id_remision,c.nFactura,r.nOrden,c.elaboro,c.actualiza,c.idVend,c.idCliente,c.valorVenta,c.valor,c.fechaElaboro,c.fechactualiza,c.fechaFactura,c.fechaVence,c.fechaRecaudo,c.cotizacion,
                c.forma_pago,c.concepto,c.estado,c.plazo,r.iva,r.rFuente,r.rIva,r.rIca,c.notaCredito,r.puc_cuenta,r.cta_iva,r.cta_rfte,r.cta_rtiva,r.cta_rtica,c.comision,c.anticipo,c.cta_anticipo,c.RC_anticipo,
                c.contactoFA,c.aplicaVT,c.estadoTraza,c.anoIndicador,c.estadoAn,c.observaFA,r.item_rm,c.ordenCompra,r.cantidad,r.cod_prod,r.cod_itemop,r.ref,r.vrUnidad,r.descuento,r.vrTotal,r.puc_id,c.saldo,
                r.letra,r.letra_cta,r.puc_contra,c.anuladas,r.idCliente FROM dt_cartera c INNER JOIN dt_remisiones r ON c.nFactura = r.factura
                and r.factura != 0 order by c.nFactura
            ");

            $array_dt_remisiones = $consulta_dt_remisiones_fac->fetchAll(PDO::FETCH_OBJ);

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_factura` (
                `id_factura` int NOT NULL AUTO_INCREMENT,
                `n_factura` int NOT NULL,
                `n_ordenes` int DEFAULT NULL,
                `id_usuario` int NOT NULL,
                `id_usuario_act` int DEFAULT NULL,
                `id_vendedor` int DEFAULT NULL,
                `id_cliente` int NOT NULL,
                `valor_venta` double DEFAULT NULL,
                `valor` double DEFAULT NULL,
                `fecha_creacion` datetime DEFAULT NULL,
                `fecha_actualizacion` datetime DEFAULT NULL,
                `fecha_factura` date DEFAULT NULL,
                `fecha_vencimiento` date DEFAULT NULL,
                `fecha_recaudo` datetime DEFAULT NULL,
                `cotizacion` varchar(30) DEFAULT NULL,
                `id_forma_pago` int DEFAULT NULL,
                `concepto` varchar(50) DEFAULT NULL,
                `estado` smallint DEFAULT NULL,
                `plazo` int DEFAULT NULL,
                `iva` double DEFAULT NULL,
                `r_fuente` double DEFAULT NULL,
                `r_iva` double DEFAULT NULL,
                `r_ica` double DEFAULT NULL,
                `nota_credito` varchar(50) DEFAULT NULL,
                `puc_cuenta` varchar(20) DEFAULT NULL,
                `cta_iva` varchar(20) DEFAULT NULL,
                `cta_rfte` varchar(20) DEFAULT NULL,
                `cta_rtiva` varchar(20) DEFAULT NULL,
                `cta_rtica` varchar(20) DEFAULT NULL,
                `comision` double DEFAULT NULL,
                `anticipo` double DEFAULT NULL,
                `cta_anticipo` varchar(20) DEFAULT NULL,
                `rc_anticipo` varchar(30) DEFAULT NULL,
                `contacto_factura` varchar(100) DEFAULT NULL,
                `aplica_vt` smallint DEFAULT NULL,
                `estado_traza` smallint DEFAULT NULL,
                `ano_indicador` int DEFAULT NULL,
                `estado_an` smallint DEFAULT NULL,
                `observaciones` varchar(556) DEFAULT NULL,
                `items` int DEFAULT NULL,
                `valor_bruto` double DEFAULT NULL,
                `orden_compra` varchar(110) DEFAULT NULL,
                `cantidad` float DEFAULT NULL,
                `codigo` varchar(50) DEFAULT NULL,
                `referencia` varchar(556) DEFAULT NULL,
                `id_codigo_categoria` int DEFAULT NULL,
                `vr_unidad` double DEFAULT NULL,
                `descuento` double DEFAULT NULL,
                `vr_total` double DEFAULT NULL,
                `id_puc_oc` int DEFAULT NULL,
                `abonos` double DEFAULT NULL,
                `saldo` double DEFAULT NULL,
                `letra` varchar(2) DEFAULT 'F',
                `letra_cta` varchar(10) DEFAULT '001',
                `puc_contra` varchar(16) DEFAULT NULL,
                `anuladas` tinyint DEFAULT '0',
                `id_remision` int DEFAULT NULL,
                `nit` varchar(100) DEFAULT NULL,
                PRIMARY KEY (`id_factura`)
                ) ENGINE=InnoDB AUTO_INCREMENT=8276 DEFAULT CHARSET=utf8mb3;
            ");

            $array_vendedor = $array_info_global['vendedor=>id'];

            $array_vendedor_secundario = [
                'HERRERA AMAYA MARTHA LUCIA' => 1135,
                'SANDRA MARCELA ESPA├æOL MARROQUIN' => 474,
                'Ret. MILENA OLARTE' => 37,
                'ING. HERRERA LEON H. YESID' => 134,
                'VASQUEZ LOPEZ BRIAN ALEXIS' => 533,
                'FORERO ARTUNDUAGA LAURA NATALIA' => 517,
                'MARTINEZ PRADA JEFFERSON ALEXANDER' => 1084,
                'MARIBEL MOLINA COLLAZOS' => 265
            ];

            $array_cod_vendedor = $array_info_global['codVendedor=>id'];

            $array_cliente = $array_info_global['nit=>id_cliente'];

            $array_forma_pago = $array_info_global['id_forma_pago'];

            $registros_insertados = 0;

            $registros_no_incluidos = 0;

            $conexion_migracion_prueba->beginTransaction();


            foreach($array_dt_remisiones as $registro_dt_remisiones){

                try{

                    if(!array_key_exists($registro_dt_remisiones->idCliente,$array_cliente)){$registros_no_incluidos++; continue;}

                    if(array_key_exists(trim($registro_dt_remisiones->elaboro),$array_vendedor)){
                        $id_usuario = array_key_exists(trim($registro_dt_remisiones->elaboro),$array_vendedor);
                    }
                    elseif(array_key_exists(trim($registro_dt_remisiones->elaboro),$array_vendedor_secundario)){
                        $id_usuario = $array_vendedor_secundario[trim($registro_dt_remisiones->elaboro)];
                    }else{
                        $registros_no_incluidos++;
                        continue;
                    }

                    
                    $id_usuario_act = array_key_exists(trim($registro_dt_remisiones->actualiza),$array_vendedor)?$array_vendedor[trim($registro_dt_remisiones->actualiza)]:null;
                    $id_vendedor = array_key_exists($registro_dt_remisiones->idVend,$array_cod_vendedor)?$array_cod_vendedor[$registro_dt_remisiones->idVend]:null;
                    $id_cliente = array_key_exists($registro_dt_remisiones->idCliente,$array_cliente)?$array_cliente[$registro_dt_remisiones->idCliente]['id_cliente']:null;
                    $id_forma_pago = array_key_exists($registro_dt_remisiones->forma_pago,$array_forma_pago)?$array_forma_pago[$registro_dt_remisiones->forma_pago]:null;
                

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_factura(n_factura,n_ordenes,id_usuario,id_usuario_act,id_vendedor,id_cliente,valor_venta,valor,
                        fecha_creacion,fecha_actualizacion,fecha_factura,fecha_vencimiento,fecha_recaudo,cotizacion,id_forma_pago,concepto,estado,
                        plazo,iva,r_fuente,r_iva,r_ica,nota_credito,puc_cuenta,cta_iva,cta_rfte,cta_rtiva,cta_rtica,comision,anticipo,cta_anticipo,
                        rc_anticipo,contacto_factura,aplica_vt,estado_traza,ano_indicador,estado_an,observaciones,items,valor_bruto,orden_compra,
                        cantidad,codigo,referencia,id_codigo_categoria,vr_unidad,descuento,vr_total,id_puc_oc,abonos,saldo,letra,letra_cta,
                        puc_contra,anuladas,id_remision,nit) VALUES(:n_factura,:n_ordenes,:id_usuario,:id_usuario_act,:id_vendedor,:id_cliente,
                        :valor_venta,:valor,:fecha_creacion,:fecha_actualizacion,:fecha_factura,:fecha_vencimiento,:fecha_recaudo,:cotizacion,:id_forma_pago,
                        :concepto,:estado,:plazo,:iva,:r_fuente,:r_iva,:r_ica,:nota_credito,:puc_cuenta,:cta_iva,:cta_rfte,:cta_rtiva,:cta_rtica,:comision,:anticipo,
                        :cta_anticipo,:rc_anticipo,:contacto_factura,:aplica_vt,:estado_traza,:ano_indicador,:estado_an,:observaciones,:items,:valor_bruto,
                        :orden_compra,:cantidad,:codigo,:referencia,:id_codigo_categoria,:vr_unidad,:descuento,:vr_total,:id_puc_oc,:abonos,:saldo,:letra,:letra_cta,
                        :puc_contra,:anuladas,:id_remision,:nit)
                    ");

                    $insert_registro->execute([
                        'n_factura' => $registro_dt_remisiones->nFactura,
                        'n_ordenes' => $registro_dt_remisiones->nOrden,
                        'id_usuario' => $id_usuario,
                        'id_usuario_act' => $id_usuario_act,
                        'id_vendedor' => $id_vendedor,
                        'id_cliente' => $id_cliente,
                        'valor_venta' => $registro_dt_remisiones->valorVenta,
                        'valor' => $registro_dt_remisiones->valor,
                        'fecha_creacion' => $registro_dt_remisiones->fechaElaboro, 
                        'fecha_actualizacion' => $registro_dt_remisiones->fechactualiza,
                        'fecha_factura' => $registro_dt_remisiones->fechaFactura,
                        'fecha_vencimiento' => $registro_dt_remisiones->fechaVence,
                        'fecha_recaudo' => $registro_dt_remisiones->fechaRecaudo,
                        'cotizacion' => $registro_dt_remisiones->cotizacion,
                        'id_forma_pago' => $id_forma_pago,
                        'concepto' => $registro_dt_remisiones->concepto,
                        'estado' => $registro_dt_remisiones->estado,
                        'plazo' => $registro_dt_remisiones->plazo,
                        'iva' => $registro_dt_remisiones->iva,
                        'r_fuente' => $registro_dt_remisiones->rFuente,
                        'r_iva' => $registro_dt_remisiones->rIva,
                        'r_ica' => $registro_dt_remisiones->rIca,
                        'nota_credito' => $registro_dt_remisiones->notaCredito,
                        'puc_cuenta' => $registro_dt_remisiones->puc_cuenta,
                        'cta_iva' => $registro_dt_remisiones->cta_iva,
                        'cta_rfte' => $registro_dt_remisiones->cta_rfte,
                        'cta_rtiva' => $registro_dt_remisiones->cta_rtiva,
                        'cta_rtica' => $registro_dt_remisiones->cta_rtica,
                        'comision' => $registro_dt_remisiones->comision,
                        'anticipo' => $registro_dt_remisiones->anticipo,
                        'cta_anticipo' => $registro_dt_remisiones->cta_anticipo,
                        'rc_anticipo' => $registro_dt_remisiones->RC_anticipo,
                        'contacto_factura' => $registro_dt_remisiones->contactoFA,
                        'aplica_vt' => 1,
                        'estado_traza' => $registro_dt_remisiones->estadoTraza,
                        'ano_indicador' => $registro_dt_remisiones->anoIndicador,
                        'estado_an' => $registro_dt_remisiones->estadoAn,
                        'observaciones' => $registro_dt_remisiones->observaFA,
                        'items' => $registro_dt_remisiones->item_rm,
                        'valor_bruto' => $registro_dt_remisiones->valor,
                        'orden_compra' => $registro_dt_remisiones->ordenCompra,
                        'cantidad' => $registro_dt_remisiones->cantidad,
                        'codigo' => $registro_dt_remisiones->cod_prod,
                        'referencia' => $registro_dt_remisiones->ref,
                        'id_codigo_categoria' => null,
                        'vr_unidad' => $registro_dt_remisiones->vrUnidad,
                        'descuento' => $registro_dt_remisiones->descuento,
                        'vr_total' => $registro_dt_remisiones->vrTotal,
                        'id_puc_oc' => $registro_dt_remisiones->puc_id,
                        'abonos' => null,
                        'saldo' => $registro_dt_remisiones->saldo,
                        'letra' => $registro_dt_remisiones->letra,
                        'letra_cta' => $registro_dt_remisiones->letra_cta,
                        'puc_contra' => $registro_dt_remisiones->puc_contra,
                        'anuladas' => $registro_dt_remisiones->anuladas,
                        'id_remision' => $registro_dt_remisiones->id_remision,
                        'nit' => $registro_dt_remisiones->idCliente
                    ]);



                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "<pre>";
                    echo "Hay un problema con el id_remision ".$registro_dt_remisiones->id_remision."<br> ".$e->getMessage();exit;
                }

                $registros_insertados++;

            }//foreach($array_dt_remisiones as $registro_dt_remisiones)

            $conexion_migracion_prueba->commit();

            
            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_factura completada, ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos"."\n<br>".$registros_no_incluidos." registros no incluidos por no tener usuario que elabora o un cliente borrado de la bd(registros anteriores al 2013)";

            return $mensaje;

        }

        public static function migraDtRemision($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Iniciamos timer

            $tiempo_inicio = microtime(true);
            

            //Hacemos el array con la información del dt_remisiones(Sin las de factura) del Sio 1

            $consulta_dt_remisiones = $conexion_sio1->query("
                SELECT id_remision,ref,remision,item_rm,nOrden,dir_factura,tel_factura,cantidad,adicionales,
                elaboro,fecha,entregarEn,entregaCiud,factura,cod_itemop,contacto_rem from dt_remisiones
                WHERE factura = 0 AND factura not REGEXP'[a-zA-Z]' AND  nOrden not in (0,'',1)
                AND nOrden is not null AND remision is not NULL 
            ");

            $array_dt_remisiones = $consulta_dt_remisiones->fetchAll(PDO::FETCH_OBJ);

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_remision` (
                `id_remision` int,
                `n_remision` int NOT NULL,
                `n_ordenes` int NOT NULL,
                `id_ordenes` int NOT NULL,
                `direccion_factura` varchar(50) DEFAULT NULL,
                `telefono` varchar(50) DEFAULT NULL,
                `nombre_contacto` varchar(50) DEFAULT NULL,
                `cantidad` int DEFAULT NULL,
                `id_usuario` int NOT NULL,
                `fecha_creacion` datetime DEFAULT NULL,
                `observaciones` varchar(100) DEFAULT NULL,
                `adicionales` varchar(100) DEFAULT NULL,
                `direccion_entrega` varchar(50) DEFAULT NULL,
                `id_ciudad` int DEFAULT NULL,
                `estado` smallint DEFAULT NULL,
                `descripcion_anulacion` varchar(100) DEFAULT NULL,
                `salida` smallint DEFAULT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
            ");

            $array_vendedor = $array_info_global['vendedor=>id'];

            $array_vendedor_secundario = [
                'HERRERA AMAYA MARTHA LUCIA' => 1135,
                'SANDRA MARCELA ESPA├æOL MARROQUIN' => 474,
                'Ret. MILENA OLARTE' => 37,
                'ING. HERRERA LEON H. YESID' => 134,
                'VASQUEZ LOPEZ BRIAN ALEXIS' => 533,
                'FORERO ARTUNDUAGA LAURA NATALIA' => 517,
                'MARTINEZ PRADA JEFFERSON ALEXANDER' => 1084,
                'MARIBEL MOLINA COLLAZOS' => 265,
                'ALEJANDRO BOHORQUEZ' => 109,
                'PABLO VASQUEZ' => 154,
                'GP7 AP BELTRAN PEREZ CARLOS JAVIER' => 804,
                'GP7 AP BUITRAGO CONTRERAS JOHAN CANER' => 752,
                'GP7 AP TEJADA GRISALES SANTIAGO' => 790,
                'GP7 AP MELO TABARES VICTOR ALFONSO' => 815,
                'GP8 PINZON SANCHEZ DAVID ANDRES' => 764,
                'GP8 AP ROZO ALARCON SERGIO JULIAN' => 695,
                'GP7 AP GALEANO GUERRERO EDISON' => 726,
                'GP7 AP CARVAJAL GONZALEZ CARLOS ANDRES' => 694,
                'GP7 AP OSORIO SEQUEDA VANESSA' => 644,
                'GP4 AP CARRILLO VELASQUEZ' => 645,
                'GP4 DI AUCIQUE SABOGAL KAREN JIMENA' => 407,
                'GP7 AP CARRILLO VELASQUEZ ALEJANDRO' =>  645
            ];


            $array_ordenes = $array_info_global['nOrden|referencia=>id_orden'];

            $array_ordenes_item_rem = $array_info_global['n_ordenes|item_op=>id_ordenes'];

            $registros_insertados = 0;

            $registros_no_incluidos = 0;

            $conexion_migracion_prueba->beginTransaction();

            foreach($array_dt_remisiones as $registro_dt_remisiones){

                try{
                    $codigo_producto_remision = strtok($registro_dt_remisiones->ref, " ");
                    $observaciones = null;

                    if(array_key_exists($registro_dt_remisiones->nOrden,$array_ordenes)&&array_key_exists($registro_dt_remisiones->ref,$array_ordenes[$registro_dt_remisiones->nOrden])){
                        $id_ordenes = $array_ordenes[$registro_dt_remisiones->nOrden][$registro_dt_remisiones->ref];
                    }elseif(array_key_exists($registro_dt_remisiones->nOrden,$array_ordenes)&&array_key_exists($codigo_producto_remision,$array_ordenes[$registro_dt_remisiones->nOrden])){
                        $id_ordenes = $array_ordenes[$registro_dt_remisiones->nOrden][$codigo_producto_remision];
                    }
                    elseif(array_key_exists($registro_dt_remisiones->nOrden,$array_ordenes_item_rem)&&array_key_exists($registro_dt_remisiones->item_rm,$array_ordenes_item_rem[$registro_dt_remisiones->nOrden])){
                        $id_ordenes = $array_ordenes_item_rem[$registro_dt_remisiones->nOrden][$registro_dt_remisiones->item_rm]['id_ordenes'];
                        $observaciones = "Referencia original: ".$registro_dt_remisiones->ref;
                    }
                    else{
                        $registros_no_incluidos++;
                        continue;
                    }

                    $nombre_contacto = ControladorFuncionesAuxiliares::formateaString($registro_dt_remisiones->contacto_rem);

                    if(array_key_exists(trim($registro_dt_remisiones->elaboro),$array_vendedor)){
                        $id_usuario = $array_vendedor[trim($registro_dt_remisiones->elaboro)];
                    }
                    elseif(array_key_exists(trim($registro_dt_remisiones->elaboro),$array_vendedor_secundario)){
                        $id_usuario = $array_vendedor_secundario[trim($registro_dt_remisiones->elaboro)];
                    }else{
                        $registros_no_incluidos++;
                        continue;
                    }
                    

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_remision(id_remision,n_remision,n_ordenes,id_ordenes,direccion_factura,telefono,nombre_contacto,
                        cantidad,id_usuario,fecha_creacion,observaciones,adicionales,direccion_entrega,id_ciudad,estado,descripcion_anulacion,
                        salida) VALUES(:id_remision,:n_remision,:n_ordenes,:id_ordenes,:direccion_factura,:telefono,:nombre_contacto,
                        :cantidad,:id_usuario,:fecha_creacion,:observaciones,:adicionales,:direccion_entrega,:id_ciudad,:estado,:descripcion_anulacion,
                        :salida)
                    ");

                    $insert_registro->execute([
                        'id_remision' => $registro_dt_remisiones->id_remision,
                        'n_remision' => $registro_dt_remisiones->remision,
                        'n_ordenes' => $registro_dt_remisiones->nOrden,
                        'id_ordenes' => $id_ordenes,
                        'direccion_factura' => $registro_dt_remisiones->dir_factura,
                        'telefono' => $registro_dt_remisiones->tel_factura,
                        'nombre_contacto' => $nombre_contacto,
                        'cantidad' => $registro_dt_remisiones->cantidad,
                        'id_usuario' => $id_usuario,
                        'fecha_creacion' => $registro_dt_remisiones->fecha,
                        'observaciones' => $observaciones."Ciudad: ".$registro_dt_remisiones->entregaCiud,
                        'adicionales' => $registro_dt_remisiones->adicionales,
                        'direccion_entrega' => $registro_dt_remisiones->entregarEn,
                        'id_ciudad' => null,
                        'estado' => null,
                        'descripcion_anulacion' => null,
                        'salida' => null
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "<pre>";
                    echo "Hay un problema con el id_remision ".$registro_dt_remisiones->id_remision."<br> ".$e->getMessage();exit;
                }

                $registros_insertados++;

            }

            $conexion_migracion_prueba->commit();

            //Asignamos la llave primaria con autoincremental 

            $conexion_migracion_prueba->exec("
                ALTER TABLE dt_remision
                MODIFY id_remision INT AUTO_INCREMENT PRIMARY KEY
            ");

            // Finaliza timer y entregamos mensaje 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_remision completada ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos"."\n<br>".$registros_no_incluidos." registros no incluidos por ser elaborados por usuarios borrados de la bd o no tener una conexión clara con el item de la op a la que pertenece";

            return $mensaje;

        }

        public static function migraDtEntregables($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            //Iniciamos timer

            $tiempo_inicio = microtime(true);
            

            //Hacemos el array con la información del dt_entregables  del Sio 1

            $consulta_dt_entregables = $conexion_sio1->query("
                SELECT id_ent,nOrden,item,indice,estado,fecha_inicio,codVendedor,
                producto,nom_costo from dt_entregables
            ");

            

            $conexion_migracion_prueba->exec("
                CREATE TABLE `dt_entregables` (
                `id_entregables` int NOT NULL AUTO_INCREMENT,
                `id_ordenes` int DEFAULT NULL,
                `n_ordenes` int NOT NULL,
                `id_area` int DEFAULT NULL,
                `id_check_list` int DEFAULT NULL,
                `id_check_list_padre` int DEFAULT NULL,
                `indice` int DEFAULT NULL,
                `descripcion` longtext,
                `estado` smallint DEFAULT NULL,
                `fecha_inicio` datetime DEFAULT NULL,
                `id_usuario` int DEFAULT NULL,
                `archivo` varchar(100) DEFAULT NULL,
                `diseno` smallint DEFAULT NULL,
                `comite_realizado` smallint DEFAULT NULL,
                `id_orden` int DEFAULT NULL,
                PRIMARY KEY (`id_entregables`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
            ");

            $registros_insertados = 0;

            $array_usuarios = $array_info_global['codVendedor=>id'];

            $array_ordenes = $array_info_global['nOrden|referencia=>id_orden'];

            $array_check_list = $array_info_global['id_check_list'];

            $array_checklist_padre = [
                15 => 1,
                16 => 2,
                17 => 3,
                26 => 4,
                34 => 5,
                41 => 6,
                48 => 7
            ];

            $conexion_migracion_prueba->beginTransaction();

            while($registro_entregables = $consulta_dt_entregables->fetch(PDO::FETCH_OBJ)){

                try{

                    $id_ordenes = array_key_exists($registro_entregables->nOrden,$array_ordenes)&&array_key_exists($registro_entregables->producto,$array_ordenes[$registro_entregables->nOrden])?$array_ordenes[$registro_entregables->nOrden][$registro_entregables->producto]:null;
                    $id_check_list = array_key_exists($registro_entregables->nom_costo,$array_check_list)?$array_check_list[$registro_entregables->nom_costo]:null;
                    if($id_check_list){
                        $id_check_list_padre = array_key_exists($id_check_list,$array_checklist_padre)?$array_checklist_padre[$id_check_list]:null;
                    }else{
                        $id_check_list_padre = null;
                    }
                    $id_usuario = array_key_exists($registro_entregables->codVendedor,$array_usuarios)?$array_usuarios[$registro_entregables->codVendedor]:null;
                    

                    $insert_registro = $conexion_migracion_prueba->prepare("
                        INSERT INTO dt_entregables(id_ordenes,n_ordenes,id_area,id_check_list,
                        id_check_list_padre,estado,id_usuario,fecha_inicio) VALUES(:id_ordenes,
                        :n_ordenes,:id_area,:id_check_list,:id_check_list_padre,:estado,:id_usuario,
                        :fecha_inicio)
                    ");

                    $insert_registro->execute([
                        'id_ordenes' => $id_ordenes,
                        'n_ordenes' => $registro_entregables->nOrden,
                        'id_area' => 1,
                        'id_check_list' => $id_check_list,
                        'id_check_list_padre' => $id_check_list_padre,
                        'estado' => $registro_entregables->estado,
                        'id_usuario' => $id_usuario,
                        'fecha_inicio' => $registro_entregables->fecha_inicio
                    ]);

                }catch(PDOException $e){
                    $conexion_migracion_prueba->rollBack();
                    echo "<pre>";
                    echo "Hay un problema con el id_ent ".$registro_dt_remisiones->id_remision."<br> ".$e->getMessage();exit;
                }

                $registros_insertados++;

            }

            $conexion_migracion_prueba->commit();


            // Finaliza timer y entregamos mensaje 

            $tiempo_fin = microtime(true);
            $tiempo_transcurrido = $tiempo_fin - $tiempo_inicio;

            $mensaje = "Migración dt_entregables completada ".$registros_insertados." registros insertados en ".$tiempo_transcurrido." segundos"."\n<br>";

            return $mensaje;

        }

        public static function migraDtHistorialCostos($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            try{ 
                $conexion_migracion_prueba->exec("

                    CREATE TABLE `dt_historial_costos` (
                    `id_historial_costos` int NOT NULL AUTO_INCREMENT,
                    `fecha_registro` datetime(6) DEFAULT NULL,
                    `id_tipo_accion` int DEFAULT NULL,
                    `accion` varchar(40) DEFAULT NULL,
                    `id_usuario` int DEFAULT NULL,
                    `observaciones` varchar(100) DEFAULT NULL,
                    `id_codprodfinal` int DEFAULT NULL,
                    `id_plantilla_implicado` int DEFAULT NULL,
                    `nombre_costo_implicado` varchar(556) DEFAULT NULL,
                    `cantidad_registros_implicados` int DEFAULT NULL,
                    `id_ordenes` int DEFAULT NULL,
                    PRIMARY KEY (`id_historial_costos`)
                    ) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=latin1;

                ");
            }catch(PDOException $e){
                echo "Hubo un error en la creación de la tabla dt_historial_costos ".$e->getMessage();exit;
            }

            return "Creación de la tabla dt_historial_costos completada";

        }

        public static function migraDtHistoricoCierres($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            try{ 
                $conexion_migracion_prueba->exec("

                    CREATE TABLE `dt_historico_cierres` (
                    `id_historico_cierre` int NOT NULL AUTO_INCREMENT,
                    `fecha_registro` datetime(6) NOT NULL,
                    `tipo` smallint NOT NULL COMMENT '1 = Abierto, 0 = Cerrado',
                    `id_user` int NOT NULL,
                    `id_ordenes` int NOT NULL,
                    `cantidad_costos` int NOT NULL,
                    PRIMARY KEY (`id_historico_cierre`),
                    KEY `fk_dt_historico_cierres_user1` (`id_user`),
                    /*KEY `dt_historico_cierres_id_ordenes_idx` (`id_ordenes`) USING BTREE,*/
                    CONSTRAINT `fk_dt_historico_cierres_user1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
                    ) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

                ");
            }catch(PDOException $e){
                echo "Hubo un error en la creación de la tabla dt_historico_cierres ".$e->getMessage();exit;
            }

            return "Creación de la tabla dt_historico_cierres completada";

        }

        public static function migraDtTrazaOp($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            try{ 
                $conexion_migracion_prueba->exec("

                        CREATE TABLE `dt_traza_op` (
                        `id_traza_op` int NOT NULL AUTO_INCREMENT,
                        `tipo` int NOT NULL,
                        `descripcion` longtext,
                        `comentarios` longtext,
                        `fecha_registro` datetime NOT NULL,
                        `id_usuario` int NOT NULL,
                        `id_ordenes` int NOT NULL,
                        PRIMARY KEY (`id_traza_op`)
                        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb3;

                ");
            }catch(PDOException $e){
                echo "Hubo un error en la creación de la tabla dt_traza_op ".$e->getMessage();exit;
            }

            return "Creación de la tabla dt_traza_op completada";

        }

        public static function migraDtHistoricoTareasCosto($conexion_sio1,$conexion_migracion_prueba,$array_info_global){

            try{ 
                $conexion_migracion_prueba->exec("

                    CREATE TABLE `dt_historico_tareas_costo` (
                    `id_historico_tareas_costo` int NOT NULL AUTO_INCREMENT,
                    `tipo` int NOT NULL DEFAULT '1' COMMENT '1 = Actualizacion',
                    `fecha_registro` datetime(6) NOT NULL,
                    `id_tarea_costo` int NOT NULL,
                    `user_id` int NOT NULL,
                    PRIMARY KEY (`id_historico_tareas_costo`),
                    KEY `fk_dt_historico_tareas_costo_dt_tareas_costo1` (`id_tarea_costo`),
                    KEY `fk_dt_historico_tareas_costo_user1` (`user_id`),
                    /*CONSTRAINT `fk_dt_historico_tareas_costo_dt_tareas_costo1` FOREIGN KEY (`id_tarea_costo`) REFERENCES `dt_tareas_costo` (`id_tarea_costo`),*/
                    CONSTRAINT `fk_dt_historico_tareas_costo_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                ");
            }catch(PDOException $e){
                echo "Hubo un error en la creación de la tabla dt_historico_tareas_costo ".$e->getMessage();exit;
            }

            return "Creación de la tabla dt_historico_tareas_costo completada";

        }

    }

?>