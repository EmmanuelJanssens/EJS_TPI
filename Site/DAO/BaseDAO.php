<?php

    class DAO 
    {

        public $error;
        function connect()
        {
                $conn = new PDO('mysql:host=192.168.154.132;dbname=emmanue4_TPI;charset=utf8','emmanuel','Pa$$w0rd');

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
            return $conn;

        }    
        
    
    }
?>