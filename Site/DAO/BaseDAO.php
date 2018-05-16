<?php

    class DAO 
    {
        
        private $server ="localhost";
        private $username="root";
        private $password="";
        private $db ="ejstpi";
        function connect()
        {
            $conn = new mysqli($this->server,$this->username,$this->password,$this->db);
            if($conn->connect_error)
            {
                die("Connection failed");
                return null;
            }
            else
            {
                return $conn;
            }
        }    
        
    
    }
?>