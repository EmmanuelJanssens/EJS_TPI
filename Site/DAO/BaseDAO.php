<?php

    class DAO 
    {
        private $dsn = 'mysql:host=172.17.101.246;dbname=ejstpi;charset=utf8';
        private $server ="localhost";
        private $username="root";
        private $password='Pa$$w0rd';
        private $db ="ejstpi";

        public $error;
        function connect()
        {
            $conn = new PDO('mysql:host=192.168.154.130;dbname=EJSTPI;charset=utf8','emmanuel','Pa$$w0rd');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
            return $conn;

        }    
        
    
    }
?>