<?php

    class DAO 
    {
        private $dsn = 'mysql:host=localhost;dbname=ejstpi;charset=utf8';
        private $server ="localhost";
        private $username="root";
        private $password="";
        private $db ="ejstpi";

        function connect()
        {
            $conn = new PDO('mysql:host=localhost;dbname=ejstpi;charset=utf8','root','');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
            return $conn;

        }    
        
    
    }
?>