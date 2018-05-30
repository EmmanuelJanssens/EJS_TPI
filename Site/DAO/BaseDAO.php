<?php

    class DAO 
    {

        public $error;
        function connect()
        {
            //$conn = new PDO('mysql:host=emmanue4.mysql.db.hostpoint.ch;dbname=emmanue4_TPI;charset=utf8;port=3306','emmanue4_tpi','19-Madagascar-94');
            $conn = new PDO('mysql:host=192.168.154.131;dbname=emmanue4_TPI;charset=utf8','emmanuel','Pa$$w0rd');
            //$conn = new PDO('mysql:host=192.168.8.116;dbname=EJSTPI;charset=utf8','emmanuel','Pa$$w0rd');

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
            return $conn;

        }    
        
    
    }
?>