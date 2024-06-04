<?php

class Database{

    function contectarBDSio1(){

        try{

            $usuario = "masterUS";
            $password = 'z2p5usaQl_UpR$Sp&v6K';
            $dsn = 'mysql:host=savivpdndb.chcfkkmlwrdq.us-east-1.rds.amazonaws.com;dbname=SioBackup10Mayo2024'; //SioBackup12Abril2024 (backup 2024 abril) Sio1BackupFeb2024(backup 2024 febr) Sio1BackupSept(backup 2023 sept) 
            $conexion = new PDO($dsn,$usuario,$password);

            return $conexion;

        }catch(PDOException $e){
            echo "Error en la base de datos Sio 1: ".$e->getMessage();exit;
        }
        
    }
    function contectarBDSemanaPrueba(){

        try{

            $usuario = "masterUS";
            $password = 'z2p5usaQl_UpR$Sp&v6K';
            $dsn = 'mysql:host=savivpdndb.chcfkkmlwrdq.us-east-1.rds.amazonaws.com;dbname=revision';
            $conexion = new PDO($dsn,$usuario,$password);

            return $conexion;

        }catch(PDOException $e){
            echo "Error en la base de datos Semana de Prueba: ".$e->getMessage();exit;
        }
    

    }

    function contectarBDMigracionPrueba(){

        try{

            $usuario = "masterUS";
            $password = 'z2p5usaQl_UpR$Sp&v6K';
            $dsn = 'mysql:host=savivpdndb.chcfkkmlwrdq.us-east-1.rds.amazonaws.com;dbname=Sio2Db_Mayo';
            $conexion = new PDO($dsn,$usuario,$password);

            return $conexion;

        }catch(PDOException $e){
            echo "Error en la base de datos Migración prueba: ".$e->getMessage();exit;
        }

    }

}  

?>